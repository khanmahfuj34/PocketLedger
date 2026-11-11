<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();
        $userId = $user->id;

        // 1. Resolve Application Timezone and Current / Account Boundaries
        $tz = config('app.timezone', 'Asia/Dhaka');
        $nowInTz = Carbon::now($tz);
        $currentDate = $nowInTz->copy()->startOfMonth();
        $currentMonthKey = $currentDate->format('Y-m');

        // Account creation boundary (start of month user registered)
        $userCreatedAt = $user->created_at
            ? $user->created_at->copy()->setTimezone($tz)->startOfMonth()
            : $currentDate->copy();

        // Guard against clock skew where created_at is in the future
        if ($userCreatedAt->greaterThan($currentDate)) {
            $userCreatedAt = $currentDate->copy();
        }

        // Dynamically build available months descending: Current Month down to Registration Month
        $availableMonths = [];
        $cursor = $currentDate->copy();
        while ($cursor->greaterThanOrEqualTo($userCreatedAt)) {
            $availableMonths[] = [
                'key' => $cursor->format('Y-m'),
                'label' => $cursor->format('F Y'),
                'short_label' => $cursor->format('M Y'),
                'year' => $cursor->year,
                'month' => $cursor->month,
                'is_current' => ($cursor->format('Y-m') === $currentMonthKey),
            ];
            $cursor->subMonth();
        }

        // 2. Validate Selected Month Parameter (must be valid format, not in future, not before created_at)
        $monthInput = $request->query('month');
        if (!is_string($monthInput) || !preg_match('/^\d{4}-(0[1-9]|1[0-2])$/', $monthInput)) {
            $selectedDate = $currentDate->copy();
        } else {
            try {
                $parsedDate = Carbon::createFromFormat('!Y-m', $monthInput, $tz)->startOfMonth();
                if ($parsedDate->greaterThan($currentDate) || $parsedDate->lessThan($userCreatedAt)) {
                    $selectedDate = $currentDate->copy();
                } else {
                    $selectedDate = $parsedDate;
                }
            } catch (\Throwable $e) {
                $selectedDate = $currentDate->copy();
            }
        }

        $selectedMonth = $selectedDate->format('Y-m');
        $startDate = $selectedDate->copy()->startOfMonth()->toDateString();
        $endDate = $selectedDate->copy()->endOfMonth()->toDateString();
        $endDateTime = $selectedDate->copy()->endOfMonth()->format('Y-m-d 23:59:59');
        $prevMonth = $selectedDate->copy()->subMonth()->format('Y-m');
        $nextMonth = $selectedDate->copy()->addMonth()->format('Y-m');
        $isCurrentMonth = ($selectedMonth === $currentMonthKey);

        // 2. Consolidated Income & Expense Totals (Selected Month & All-Time in 1 single query)
        $totals = DB::table('transactions')
            ->join('categories', 'transactions.category_id', '=', 'categories.id')
            ->where('transactions.user_id', $userId)
            ->whereNull('transactions.deleted_at')
            ->selectRaw("
                COALESCE(SUM(CASE WHEN categories.type = 'income' AND transactions.transaction_date >= ? AND transactions.transaction_date <= ? THEN transactions.amount ELSE 0 END), 0) as monthly_income,
                COALESCE(SUM(CASE WHEN categories.type = 'expense' AND transactions.transaction_date >= ? AND transactions.transaction_date <= ? THEN transactions.amount ELSE 0 END), 0) as monthly_expense,
                COALESCE(SUM(CASE WHEN categories.type = 'income' THEN transactions.amount ELSE 0 END), 0) as all_time_income,
                COALESCE(SUM(CASE WHEN categories.type = 'expense' THEN transactions.amount ELSE 0 END), 0) as all_time_expense
            ", [$startDate, $endDateTime, $startDate, $endDateTime])
            ->first();

        $monthlyIncome = (float) ($totals->monthly_income ?? 0);
        $monthlyExpense = (float) ($totals->monthly_expense ?? 0);
        $allTimeIncome = (float) ($totals->all_time_income ?? 0);
        $allTimeExpense = (float) ($totals->all_time_expense ?? 0);

        // 3. Net Monthly Savings
        $netSavings = $monthlyIncome - $monthlyExpense;
        $savingsRate = $monthlyIncome > 0 ? round(($netSavings / $monthlyIncome) * 100, 1) : 0;

        // 4. Monthly Budget Overview for the Selected Month
        $budgetMonthDate = $selectedDate->format('Y-m-01');
        $monthlyBudget = (float) ($user->budgets()
            ->where('budget_month', $budgetMonthDate)
            ->sum('amount') ?? 0);
        $budgetRemaining = $monthlyBudget > 0 ? ($monthlyBudget - $monthlyExpense) : 0;
        $budgetProgress = $monthlyBudget > 0 ? min(100, round(($monthlyExpense / $monthlyBudget) * 100)) : 0;

        // 5. Monthly Expense Trend (6-month rolling window consolidated in 1 single query)
        $trendStartDate = $selectedDate->copy()->subMonths(5)->startOfMonth()->toDateString();
        $trendEndDate = $selectedDate->copy()->endOfMonth()->toDateString();

        $isSqlite = DB::connection()->getDriverName() === 'sqlite';
        $monthExpr = $isSqlite
            ? "strftime('%Y-%m', transactions.transaction_date)"
            : "DATE_FORMAT(transactions.transaction_date, '%Y-%m')";

        $trendExpenses = DB::table('transactions')
            ->join('categories', 'transactions.category_id', '=', 'categories.id')
            ->where('transactions.user_id', $userId)
            ->whereNull('transactions.deleted_at')
            ->where('categories.type', 'expense')
            ->where('transactions.transaction_date', '>=', $trendStartDate)
            ->where('transactions.transaction_date', '<=', $trendEndDate)
            ->selectRaw("{$monthExpr} as ym, SUM(transactions.amount) as total")
            ->groupBy('ym')
            ->pluck('total', 'ym')
            ->toArray();

        $trendData = [];
        $maxTrendAmount = 0.0;

        for ($i = 5; $i >= 0; $i--) {
            $monthDate = $selectedDate->copy()->subMonths($i);
            $monthKey = $monthDate->format('Y-m');
            $spent = (float) ($trendExpenses[$monthKey] ?? 0);

            if ($spent > $maxTrendAmount) {
                $maxTrendAmount = $spent;
            }

            $trendData[] = [
                'label' => $monthDate->format('M'),
                'amount' => $spent,
                'is_current' => ($i === 0),
                'month_key' => $monthKey,
            ];
        }

        // Calculate height percentages for each bar
        foreach ($trendData as &$item) {
            if ($maxTrendAmount > 0 && $item['amount'] > 0) {
                $item['height_pct'] = max(6, min(100, (int) round(($item['amount'] / $maxTrendAmount) * 88)));
            } else {
                $item['height_pct'] = 0;
            }
        }
        unset($item);

        $trendScale = $this->generateTrendScale($maxTrendAmount);

        // 7. Expense by Category (Scoped strictly to the selected month)
        $palette = ['#10B981', '#F59E0B', '#EF4444', '#3B82F6', '#8B5CF6', '#EC4899', '#06B6D4', '#64748B'];

        $categoryExpenses = DB::table('transactions')
            ->join('categories', 'transactions.category_id', '=', 'categories.id')
            ->where('transactions.user_id', $userId)
            ->whereNull('transactions.deleted_at')
            ->where('categories.type', 'expense')
            ->where('transactions.transaction_date', '>=', $startDate)
            ->where('transactions.transaction_date', '<=', $endDateTime)
            ->select(
                'categories.id',
                'categories.name',
                'categories.color',
                'categories.icon',
                DB::raw('SUM(transactions.amount) as total_amount')
            )
            ->groupBy('categories.id', 'categories.name', 'categories.color', 'categories.icon')
            ->orderByDesc('total_amount')
            ->get();

        $categoryTotal = (float) $categoryExpenses->sum('total_amount');

        $categoryData = [];
        $accumulatedPercent = 0.0;

        foreach ($categoryExpenses as $index => $cat) {
            $catAmount = (float) $cat->total_amount;
            $percent = $categoryTotal > 0 ? round(($catAmount / $categoryTotal) * 100, 1) : 0;
            $color = !empty($cat->color) ? $cat->color : ($palette[$index % count($palette)]);

            // SVG Donut calculation with r=15.9155 (circumference = 100)
            $dashArray = "{$percent} " . (100 - $percent);
            $dashOffset = -$accumulatedPercent;
            $accumulatedPercent += $percent;

            $categoryData[] = [
                'id' => $cat->id,
                'name' => $cat->name,
                'amount' => $catAmount,
                'percent' => $percent,
                'color' => $color,
                'dash_array' => $dashArray,
                'dash_offset' => $dashOffset,
            ];
        }

        // 8. Recent Transactions (Scoped to the selected month, latest 5)
        $recentTransactions = $user->transactions()
            ->with('category')
            ->where('transaction_date', '>=', $startDate)
            ->where('transaction_date', '<=', $endDateTime)
            ->latest('transaction_date')
            ->latest('id')
            ->take(5)
            ->get();

        return view('dashboard', [
            'selectedDate' => $selectedDate,
            'selectedMonth' => $selectedMonth,
            'availableMonths' => $availableMonths,
            'currentMonthKey' => $currentMonthKey,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'prevMonth' => $prevMonth,
            'nextMonth' => $nextMonth,
            'isCurrentMonth' => $isCurrentMonth,
            'monthlyIncome' => $monthlyIncome,
            'monthlyExpense' => $monthlyExpense,
            'netSavings' => $netSavings,
            'savingsRate' => $savingsRate,
            'monthlyBudget' => $monthlyBudget,
            'budgetRemaining' => $budgetRemaining,
            'budgetProgress' => $budgetProgress,
            'trendData' => $trendData,
            'trendScale' => $trendScale,
            'maxTrendAmount' => $maxTrendAmount,
            'categoryData' => $categoryData,
            'categoryTotal' => $categoryTotal,
            'recentTransactions' => $recentTransactions,
            'allTimeIncome' => $allTimeIncome,
            'allTimeExpense' => $allTimeExpense,
            // Backwards compatibility keys
            'income' => $monthlyIncome,
            'expense' => $monthlyExpense,
        ]);
    }

    private function generateTrendScale(float $max): array
    {
        if ($max <= 0) {
            return ['12K', '9K', '6K', '3K', '0'];
        }

        $magnitude = pow(10, max(0, floor(log10($max))));
        $normalized = ceil($max / $magnitude) * $magnitude;
        $step = $normalized / 4;

        $format = function ($val) {
            if ($val >= 1000000) {
                return round($val / 1000000, 1) . 'M';
            }
            if ($val >= 1000) {
                return round($val / 1000, $val >= 10000 ? 0 : 1) . 'K';
            }
            return (string) round($val);
        };

        return [
            $format($normalized),
            $format($step * 3),
            $format($step * 2),
            $format($step * 1),
            '0',
        ];
    }
}
