<!-- Financial Summary Cards (Income, Expense, Net Savings, Savings Rate) -->
@php
    $income = (float) ($report['summary']['totalIncome'] ?? 0);
    $expense = (float) ($report['summary']['totalExpense'] ?? 0);
    $netSavings = (float) ($report['summary']['netSavings'] ?? 0);
    $savingsRate = (float) ($report['summary']['savingsRate'] ?? 0);
@endphp

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3.5 sm:gap-5">

    <!-- 1. Total Income Card -->
    <div class="bg-emerald-50/80 dark:bg-emerald-950/30 border border-emerald-100 dark:border-emerald-900/50 rounded-3xl p-4.5 sm:p-5 flex flex-col justify-between shadow-xs hover:shadow-md transition-all">
        <div class="flex items-center justify-between mb-3">
            <span class="text-xs font-bold text-emerald-800 dark:text-emerald-300">Total Income</span>
            <div class="w-10 h-10 rounded-2xl bg-emerald-200/80 dark:bg-emerald-800/40 text-emerald-800 dark:text-emerald-300 flex items-center justify-center shadow-xs">
                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="7" y1="17" x2="17" y2="7"></line>
                    <polyline points="7 7 17 7 17 17"></polyline>
                </svg>
            </div>
        </div>
        <div>
            <div class="text-2xl sm:text-3xl font-black text-slate-900 dark:text-white tracking-tight">
                ৳ {{ number_format($income, 2) }}
            </div>
            <span class="text-[11px] font-semibold text-emerald-600 dark:text-emerald-400 mt-1 inline-block">
                Gross inflows for period
            </span>
        </div>
    </div>

    <!-- 2. Total Expense Card -->
    <div class="bg-rose-50/80 dark:bg-rose-950/30 border border-rose-100 dark:border-rose-900/50 rounded-3xl p-4.5 sm:p-5 flex flex-col justify-between shadow-xs hover:shadow-md transition-all">
        <div class="flex items-center justify-between mb-3">
            <span class="text-xs font-bold text-rose-800 dark:text-rose-300">Total Expense</span>
            <div class="w-10 h-10 rounded-2xl bg-rose-200/80 dark:bg-rose-800/40 text-rose-800 dark:text-rose-300 flex items-center justify-center shadow-xs">
                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <polyline points="19 12 12 19 5 12"></polyline>
                </svg>
            </div>
        </div>
        <div>
            <div class="text-2xl sm:text-3xl font-black text-rose-600 dark:text-rose-400 tracking-tight">
                ৳ {{ number_format($expense, 2) }}
            </div>
            <span class="text-[11px] font-semibold text-rose-500 mt-1 inline-block">
                Total spending across categories
            </span>
        </div>
    </div>

    <!-- 3. Net Savings Card -->
    <div class="{{ $netSavings >= 0 ? 'bg-teal-50/80 dark:bg-teal-950/30 border-teal-100 dark:border-teal-900/50' : 'bg-rose-50/80 dark:bg-rose-950/30 border-rose-100 dark:border-rose-900/50' }} border rounded-3xl p-4.5 sm:p-5 flex flex-col justify-between shadow-xs hover:shadow-md transition-all">
        <div class="flex items-center justify-between mb-3">
            <span class="text-xs font-bold {{ $netSavings >= 0 ? 'text-teal-800 dark:text-teal-300' : 'text-rose-800 dark:text-rose-300' }}">Net Savings</span>
            <div class="w-10 h-10 rounded-2xl {{ $netSavings >= 0 ? 'bg-teal-200/80 dark:bg-teal-800/40 text-teal-800 dark:text-teal-300' : 'bg-rose-200/80 dark:bg-rose-800/40 text-rose-800 dark:text-rose-300' }} flex items-center justify-center shadow-xs">
                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"></path>
                </svg>
            </div>
        </div>
        <div>
            <div class="text-2xl sm:text-3xl font-black {{ $netSavings >= 0 ? 'text-teal-700 dark:text-teal-400' : 'text-rose-600 dark:text-rose-400' }} tracking-tight">
                {{ $netSavings < 0 ? '-' : '' }}৳ {{ number_format(abs($netSavings), 2) }}
            </div>
            <span class="text-[11px] font-semibold {{ $netSavings >= 0 ? 'text-teal-600 dark:text-teal-400' : 'text-rose-500' }} mt-1 inline-block">
                {{ $netSavings >= 0 ? 'Surplus (Income - Expense)' : 'Deficit in selected period' }}
            </span>
        </div>
    </div>

    <!-- 4. Savings Rate Card -->
    <div class="bg-indigo-50/80 dark:bg-indigo-950/30 border border-indigo-100 dark:border-indigo-900/50 rounded-3xl p-4.5 sm:p-5 flex flex-col justify-between shadow-xs hover:shadow-md transition-all">
        <div class="flex items-center justify-between mb-3">
            <span class="text-xs font-bold text-indigo-800 dark:text-indigo-300">Savings Rate</span>
            <div class="w-10 h-10 rounded-2xl bg-indigo-200/80 dark:bg-indigo-800/40 text-indigo-800 dark:text-indigo-300 flex items-center justify-center shadow-xs">
                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="19" y1="5" x2="5" y2="19"></line>
                    <circle cx="6.5" cy="6.5" r="2.5"></circle>
                    <circle cx="17.5" cy="17.5" r="2.5"></circle>
                </svg>
            </div>
        </div>
        <div>
            <div class="text-2xl sm:text-3xl font-black text-indigo-700 dark:text-indigo-300 tracking-tight">
                {{ $savingsRate }}%
            </div>
            <div class="w-full bg-slate-200 dark:bg-slate-700 h-1.5 rounded-full overflow-hidden mt-2.5">
                <div
                    class="bg-indigo-500 h-full rounded-full transition-all duration-500"
                    style="width: {{ min(100, max(0, $savingsRate)) }}%"
                ></div>
            </div>
        </div>
    </div>

</div>

