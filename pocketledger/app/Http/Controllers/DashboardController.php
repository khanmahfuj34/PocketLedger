<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        /** @var User $user */
        $user = Auth::user();
        $userId = $user->id;

        // 1. Total Income (All-Time, non-deleted, only income categories)
        $income = (float) (DB::table('transactions')
            ->join('categories', 'transactions.category_id', '=', 'categories.id')
            ->where('transactions.user_id', $userId)
            ->whereNull('transactions.deleted_at')
            ->where('categories.type', 'income')
            ->sum('transactions.amount') ?? 0);

        // 2. Total Expense (All-Time, non-deleted, only expense categories)
        $expense = (float) (DB::table('transactions')
            ->join('categories', 'transactions.category_id', '=', 'categories.id')
            ->where('transactions.user_id', $userId)
            ->whereNull('transactions.deleted_at')
            ->where('categories.type', 'expense')
            ->sum('transactions.amount') ?? 0);

        // 3. Monthly Total Expense (Current Month and Current Year)
        $currentYear = now()->year;
        $currentMonth = now()->month;

        $monthlyExpense = (float) (DB::table('transactions')
            ->join('categories', 'transactions.category_id', '=', 'categories.id')
            ->where('transactions.user_id', $userId)
            ->whereNull('transactions.deleted_at')
            ->where('categories.type', 'expense')
            ->whereYear('transactions.transaction_date', $currentYear)
            ->whereMonth('transactions.transaction_date', $currentMonth)
            ->sum('transactions.amount') ?? 0);

        // 4. Monthly Expense Trend (Past 6 months ending with current month)
        $trendData = [];
        $maxTrendAmount = 0.0;

        for ($i = 5; $i >= 0; $i--) {
            $monthDate = now()->subMonths($i);
            $year = $monthDate->year;
            $month = $monthDate->month;
            $monthName = $monthDate->format('M');
            $isCurrent = ($i === 0);

            $spent = (float) (DB::table('transactions')
                ->join('categories', 'transactions.category_id', '=', 'categories.id')
                ->where('transactions.user_id', $userId)
                ->whereNull('transactions.deleted_at')
                ->where('categories.type', 'expense')
                ->whereYear('transactions.transaction_date', $year)
                ->whereMonth('transactions.transaction_date', $month)
                ->sum('transactions.amount') ?? 0);

            if ($spent > $maxTrendAmount) {
                $maxTrendAmount = $spent;
            }

            $trendData[] = [
                'label' => $monthName,
                'amount' => $spent,
                'is_current' => $isCurrent,
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

        // 5. Expense by Category (Grouped by user's categories)
        $palette = ['#10B981', '#F59E0B', '#EF4444', '#3B82F6', '#8B5CF6', '#EC4899', '#06B6D4', '#64748B'];

        $categoryExpenses = DB::table('transactions')
            ->join('categories', 'transactions.category_id', '=', 'categories.id')
            ->where('transactions.user_id', $userId)
            ->whereNull('transactions.deleted_at')
            ->where('categories.type', 'expense')
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

        // 6. Recent Transactions (User's latest 5 transactions)
        $recentTransactions = $user->transactions()
            ->with('category')
            ->latest('transaction_date')
            ->latest('id')
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'income',
            'expense',
            'monthlyExpense',
            'trendData',
            'trendScale',
            'maxTrendAmount',
            'categoryData',
            'categoryTotal',
            'recentTransactions'
        ));
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