<?php

namespace App\Services;

use App\Models\Transaction;
use App\Models\User;
use Carbon\CarbonImmutable;
use Carbon\CarbonInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ReportService
{
    /**
     * Monthly report.
     */
    public function getMonthlyReport(
        User $user,
        CarbonInterface $month
    ): array {
        $startDate = $month->startOfMonth();
        $endDate = $month->endOfMonth();

        return $this->buildReport(
            $user,
            $startDate,
            $endDate,
            'day'
        );
    }

    /**
     * Yearly report.
     */
    public function getYearlyReport(
        User $user,
        int $year
    ): array {
        $timezone = config('app.timezone', 'Asia/Dhaka');
        $startDate = CarbonImmutable::create(
            $year, 1, 1, 0, 0, 0, $timezone
        )->startOfYear();

        $endDate = $startDate->endOfYear();

        return $this->buildReport(
            $user,
            $startDate,
            $endDate,
            'month'
        );
    }

    /**
     * Custom date range report.
     */
    public function getCustomReport(
        User $user,
        CarbonInterface $startDate,
        CarbonInterface $endDate
    ): array {
        $days = $startDate->startOfDay()
            ->diffInDays($endDate->startOfDay()) + 1;

        $groupBy = $days <= 31 ? 'day' : 'month';

        return $this->buildReport(
            $user,
            $startDate->startOfDay(),
            $endDate->endOfDay(),
            $groupBy
        );
    }

    /**
     * Shared report calculations.
     */
    private function buildReport(
        User $user,
        CarbonInterface $startDate,
        CarbonInterface $endDate,
        string $groupBy
    ): array {
        $categoryData = $this->getCategoryAndSummaryData(
            $user,
            $startDate,
            $endDate
        );

        return [
            'summary' => $categoryData['summary'],

            'expenseByCategory' => $categoryData['expenseByCategory'],

            'incomeByCategory' => $categoryData['incomeByCategory'],

            'trend' => $this->getTrend(
                $user,
                $startDate,
                $endDate,
                $groupBy
            ),

            'recentTransactions' => $this->getRecentTransactions(
                $user,
                $startDate,
                $endDate
            ),

            'period' => [
                'startDate' => $startDate->toDateString(),
                'endDate' => $endDate->toDateString(),
            ],
        ];
    }

    /**
     * Consolidated category breakdown and summary in a single query.
     */
    public function getCategoryAndSummaryData(
        User $user,
        CarbonInterface $startDate,
        CarbonInterface $endDate
    ): array {
        $startStr = $startDate->toDateString();
        $endStr = $endDate->format('Y-m-d 23:59:59');

        $rows = Transaction::query()
            ->join(
                'categories',
                'transactions.category_id',
                '=',
                'categories.id'
            )
            ->where('transactions.user_id', $user->id)
            ->where('categories.user_id', $user->id)
            ->where('transactions.transaction_date', '>=', $startStr)
            ->where('transactions.transaction_date', '<=', $endStr)
            ->groupBy(
                'categories.id',
                'categories.name',
                'categories.type',
                'categories.color',
                'categories.icon'
            )
            ->selectRaw('
                categories.id as category_id,
                categories.name as category_name,
                categories.type as category_type,
                categories.color,
                categories.icon,
                SUM(transactions.amount) as total
            ')
            ->orderByDesc('total')
            ->get();

        $expenseRows = $rows->where('category_type', 'expense')->values();
        $incomeRows = $rows->where('category_type', 'income')->values();

        $totalExpense = (float) $expenseRows->sum('total');
        $totalIncome = (float) $incomeRows->sum('total');
        $netSavings = $totalIncome - $totalExpense;

        $expenseByCategory = $expenseRows->map(function ($item) use ($totalExpense) {
            $amount = (float) $item->total;
            $item->total = round($amount, 2);
            $item->percentage = $totalExpense > 0
                ? round(($amount / $totalExpense) * 100, 2)
                : 0.0;
            return $item;
        });

        $incomeByCategory = $incomeRows->map(function ($item) use ($totalIncome) {
            $amount = (float) $item->total;
            $item->total = round($amount, 2);
            $item->percentage = $totalIncome > 0
                ? round(($amount / $totalIncome) * 100, 2)
                : 0.0;
            return $item;
        });

        $summary = [
            'totalIncome' => round($totalIncome, 2),
            'totalExpense' => round($totalExpense, 2),
            'netSavings' => round($netSavings, 2),
            'savingsRate' => $totalIncome > 0
                ? round(($netSavings / $totalIncome) * 100, 2)
                : 0.0,
        ];

        return [
            'summary' => $summary,
            'expenseByCategory' => $expenseByCategory,
            'incomeByCategory' => $incomeByCategory,
        ];
    }

    /**
     * Total income, expense and savings.
     */
    public function getSummary(
        User $user,
        CarbonInterface $startDate,
        CarbonInterface $endDate
    ): array {
        return $this->getCategoryAndSummaryData($user, $startDate, $endDate)['summary'];
    }

    /**
     * Expense grouped by category.
     */
    public function getExpenseByCategory(
        User $user,
        CarbonInterface $startDate,
        CarbonInterface $endDate
    ): Collection {
        return $this->getCategoryAndSummaryData($user, $startDate, $endDate)['expenseByCategory'];
    }

    /**
     * Income grouped by category.
     */
    public function getIncomeByCategory(
        User $user,
        CarbonInterface $startDate,
        CarbonInterface $endDate
    ): Collection {
        return $this->getCategoryAndSummaryData($user, $startDate, $endDate)['incomeByCategory'];
    }

    /**
     * Income and expense trend (database-driver agnostic).
     */
    private function getTrend(
        User $user,
        CarbonInterface $startDate,
        CarbonInterface $endDate,
        string $groupBy
    ): Collection {
        $startStr = $startDate->toDateString();
        $endStr = $endDate->format('Y-m-d 23:59:59');

        $isSqlite = DB::getDriverName() === 'sqlite';

        if ($groupBy === 'day') {
            $dateExpression = $isSqlite
                ? "strftime('%Y-%m-%d', transactions.transaction_date)"
                : 'DATE(transactions.transaction_date)';
        } else {
            $dateExpression = $isSqlite
                ? "strftime('%Y-%m', transactions.transaction_date)"
                : "DATE_FORMAT(transactions.transaction_date, '%Y-%m')";
        }

        return Transaction::query()
            ->join(
                'categories',
                'transactions.category_id',
                '=',
                'categories.id'
            )
            ->where('transactions.user_id', $user->id)
            ->where('transactions.transaction_date', '>=', $startStr)
            ->where('transactions.transaction_date', '<=', $endStr)
            ->groupByRaw($dateExpression)
            ->selectRaw("
                {$dateExpression} as period,
                SUM(
                    CASE WHEN categories.type = 'income'
                    THEN transactions.amount ELSE 0 END
                ) as income,
                SUM(
                    CASE WHEN categories.type = 'expense'
                    THEN transactions.amount ELSE 0 END
                ) as expense
            ")
            ->orderBy('period')
            ->get()
            ->map(function ($row) {
                $inc = (float) ($row->income ?? 0);
                $exp = (float) ($row->expense ?? 0);
                $row->income = round($inc, 2);
                $row->expense = round($exp, 2);
                $row->net = round($inc - $exp, 2);
                return $row;
            });
    }

    /**
     * Latest transactions within selected period.
     */
    private function getRecentTransactions(
        User $user,
        CarbonInterface $startDate,
        CarbonInterface $endDate
    ): Collection {
        $startStr = $startDate->toDateString();
        $endStr = $endDate->format('Y-m-d 23:59:59');

        return Transaction::query()
            ->with('category:id,name,type,color,icon')
            ->where('transactions.user_id', $user->id)
            ->where('transactions.transaction_date', '>=', $startStr)
            ->where('transactions.transaction_date', '<=', $endStr)
            ->orderByDesc('transactions.transaction_date')
            ->orderByDesc('transactions.id')
            ->limit(10)
            ->get();
    }
}
