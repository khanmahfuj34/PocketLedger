<?php

namespace App\Services;

use App\Models\Budget;
use App\Models\Transaction;
use App\Models\User;
use Carbon\CarbonInterface;
use Illuminate\Support\Collection;

class BudgetService
{
    /**
     * Get category-wise budget progress for a selected month.
     */
    public function getMonthlyProgress(
        User $user,
        CarbonInterface $month
    ): Collection {
        $startDate = $month->startOfMonth()->toDateString();
        $endDate = $month->endOfMonth()->toDateString();
        $endDateTime = $month->endOfMonth()->format('Y-m-d 23:59:59');

        // Get all budgets for this user and selected month.
        $budgets = Budget::query()
            ->where('user_id', $user->id)
            ->whereDate('budget_month', $startDate)
            ->with('category')
            ->orderBy('category_id')
            ->get();

        if ($budgets->isEmpty()) {
            return collect();
        }

        // Calculate total expenses grouped by category.
        $expenses = Transaction::query()
            ->selectRaw('category_id, SUM(amount) as total_spent')
            ->where('user_id', $user->id)
            ->where('transaction_date', '>=', $startDate)
            ->where('transaction_date', '<=', $endDateTime)
            ->whereHas('category', function ($query) {
                $query->where('type', 'expense');
            })
            ->groupBy('category_id')
            ->pluck('total_spent', 'category_id');

        // Calculate progress for each budget.
        return $budgets->map(function (Budget $budget) use ($expenses) {
            $budgetCents = $this->toCents($budget->amount);

            $spentCents = $this->toCents(
                $expenses->get($budget->category_id, '0')
            );

            $remainingCents = $budgetCents - $spentCents;

            $percentage = $budgetCents > 0
                ? round(($spentCents / $budgetCents) * 100, 2)
                : 0;

            // Determine budget status.
            if ($spentCents >= $budgetCents) {
                $status = 'exceeded';
            } elseif (($spentCents * 100) >= ($budgetCents * 80)) {
                $status = 'warning';
            } else {
                $status = 'normal';
            }

            return [
                'id' => $budget->id,
                'category_id' => $budget->category_id,
                'category_name' => $budget->category?->name,
                'budget_amount' => $this->formatCents($budgetCents),
                'spent_amount' => $this->formatCents($spentCents),
                'remaining_amount' => $this->formatCents($remainingCents),
                'usage_percentage' => $percentage,
                'status' => $status,
            ];
        });
    }

    /**
     * Convert a decimal amount into integer cents.
     */
    private function toCents(mixed $amount): int
    {
        $amount = trim((string) $amount);
        $isNegative = str_starts_with($amount, '-');
        if ($isNegative) {
            $amount = substr($amount, 1);
        }

        if (! preg_match('/^(\d+)(?:\.(\d+))?$/', $amount, $matches)) {
            return 0;
        }

        $whole = (int) $matches[1];

        $fraction = str_pad(
            substr($matches[2] ?? '', 0, 2),
            2,
            '0'
        );

        $cents = ($whole * 100) + (int) $fraction;

        return $isNegative ? -$cents : $cents;
    }

    /**
     * Convert integer cents into a decimal string.
     */
    private function formatCents(int $cents): string
    {
        $negative = $cents < 0;

        $cents = abs($cents);

        $formatted = intdiv($cents, 100)
            . '.'
            . str_pad((string) ($cents % 100), 2, '0', STR_PAD_LEFT);

        return $negative ? '-' . $formatted : $formatted;
    }
}
