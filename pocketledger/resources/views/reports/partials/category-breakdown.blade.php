<!-- Category Breakdowns: Expense & Income Distribution -->
@php
    $expenseCats = $report['expenseByCategory'] ?? collect();
    $incomeCats = $report['incomeByCategory'] ?? collect();
    $totalExpense = (float) ($report['summary']['totalExpense'] ?? 0);
    $totalIncome = (float) ($report['summary']['totalIncome'] ?? 0);

    // Prepare SVG Donut Segments for Expense
    $cumulativePercent = 0.0;
    $donutSegments = [];
    $circumference = 2 * pi() * 15.9155; // ~100
    foreach ($expenseCats as $cat) {
        $pct = (float) ($cat->percentage ?? 0);
        $dashArray = "{$pct} " . (100 - $pct);
        $dashOffset = 100 - $cumulativePercent;
        $cumulativePercent += $pct;
        $donutSegments[] = [
            'color' => $cat->color ?? '#EF4444',
            'dashArray' => $dashArray,
            'dashOffset' => $dashOffset,
        ];
    }
@endphp

<div class="grid grid-cols-1 lg:grid-cols-2 gap-4 sm:gap-6">

    <!-- 1. Expense by Category Card -->
    <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl p-4.5 sm:p-6 shadow-xs hover:shadow-md transition-all flex flex-col justify-between">
        <div class="flex items-center justify-between mb-5">
            <div class="flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-xl bg-rose-50 dark:bg-rose-950/60 text-rose-600 dark:text-rose-400 flex items-center justify-center shrink-0">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21.21 15.89A10 10 0 1 1 8 2.83"></path>
                        <path d="M22 12A10 10 0 0 0 12 2v10z"></path>
                    </svg>
                </div>
                <div>
                    <h2 class="text-base font-bold text-slate-900 dark:text-white">Expense by Category</h2>
                    <p class="text-[11px] text-slate-400 dark:text-slate-500 font-medium">Spending breakdown by category</p>
                </div>
            </div>
            <span class="text-xs font-black text-rose-600 dark:text-rose-400">
                ৳ {{ number_format($totalExpense, 2) }}
            </span>
        </div>

        @if ($expenseCats->isEmpty() || $totalExpense <= 0)
            <div class="py-10 text-center">
                <p class="text-xs font-semibold text-slate-400 dark:text-slate-500">No expense transactions recorded in this period.</p>
            </div>
        @else
            <div class="flex flex-col sm:flex-row items-center gap-6">
                <!-- SVG Donut -->
                <div class="relative w-36 h-36 shrink-0 flex items-center justify-center">
                    <svg class="w-full h-full -rotate-90" viewBox="0 0 42 42">
                        <circle cx="21" cy="21" r="15.9155" fill="transparent" stroke="currentColor" stroke-width="5" class="text-slate-100 dark:text-slate-800"></circle>
                        @foreach ($donutSegments as $seg)
                            <circle
                                cx="21"
                                cy="21"
                                r="15.9155"
                                fill="transparent"
                                stroke="{{ $seg['color'] }}"
                                stroke-width="5"
                                stroke-dasharray="{{ $seg['dashArray'] }}"
                                stroke-dashoffset="{{ $seg['dashOffset'] }}"
                                stroke-linecap="round"
                            ></circle>
                        @endforeach
                    </svg>
                    <div class="absolute inset-0 flex flex-col items-center justify-center pointer-events-none text-center">
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Top Share</span>
                        <span class="text-sm font-black text-slate-900 dark:text-white">
                            {{ $expenseCats->first()->percentage ?? 0 }}%
                        </span>
                    </div>
                </div>

                <!-- Category List with Progress Bars -->
                <div class="flex-1 w-full space-y-2.5 max-h-56 overflow-y-auto pr-1">
                    @foreach ($expenseCats as $c)
                        <div>
                            <div class="flex items-center justify-between text-xs mb-1">
                                <div class="flex items-center gap-2 min-w-0">
                                    <span class="w-2.5 h-2.5 rounded-full shrink-0" style="background-color: {{ $c->color ?? '#EF4444' }}"></span>
                                    <span class="font-bold text-slate-800 dark:text-slate-200 truncate">{{ $c->category_name }}</span>
                                </div>
                                <div class="flex items-center gap-2 shrink-0">
                                    <span class="font-bold text-slate-900 dark:text-white">৳ {{ number_format((float) $c->total, 2) }}</span>
                                    <span class="text-[10px] font-semibold text-slate-400 dark:text-slate-500 w-8 text-right">{{ $c->percentage }}%</span>
                                </div>
                            </div>
                            <div class="w-full bg-slate-100 dark:bg-slate-800 h-1.5 rounded-full overflow-hidden">
                                <div class="h-full rounded-full transition-all" style="width: {{ $c->percentage }}%; background-color: {{ $c->color ?? '#EF4444' }}"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>

    <!-- 2. Income by Category Card -->
    <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl p-4.5 sm:p-6 shadow-xs hover:shadow-md transition-all flex flex-col justify-between">
        <div class="flex items-center justify-between mb-5">
            <div class="flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-xl bg-emerald-50 dark:bg-emerald-950/60 text-emerald-600 dark:text-emerald-400 flex items-center justify-center shrink-0">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="12" y1="19" x2="12" y2="5"></line>
                        <polyline points="5 12 12 5 19 12"></polyline>
                    </svg>
                </div>
                <div>
                    <h2 class="text-base font-bold text-slate-900 dark:text-white">Income by Category</h2>
                    <p class="text-[11px] text-slate-400 dark:text-slate-500 font-medium">Earnings and income stream distribution</p>
                </div>
            </div>
            <span class="text-xs font-black text-emerald-600 dark:text-emerald-400">
                ৳ {{ number_format($totalIncome, 2) }}
            </span>
        </div>

        @if ($incomeCats->isEmpty() || $totalIncome <= 0)
            <div class="py-10 text-center">
                <p class="text-xs font-semibold text-slate-400 dark:text-slate-500">No income transactions recorded in this period.</p>
            </div>
        @else
            <div class="space-y-3 max-h-60 overflow-y-auto pr-1">
                @foreach ($incomeCats as $ic)
                    <div class="p-3 rounded-2xl bg-slate-50 dark:bg-slate-800/60 border border-slate-100 dark:border-slate-700/60 flex items-center justify-between">
                        <div class="flex items-center gap-2.5 min-w-0">
                            <div class="w-8 h-8 rounded-xl flex items-center justify-center shrink-0" style="background-color: {{ $ic->color ? $ic->color . '20' : '#10B98120' }}; color: {{ $ic->color ?? '#10B981' }}">
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
                                    <line x1="12" y1="5" x2="12" y2="19"></line>
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                </svg>
                            </div>
                            <div class="min-w-0">
                                <p class="text-xs font-bold text-slate-900 dark:text-white truncate">{{ $ic->category_name }}</p>
                                <p class="text-[10px] font-semibold text-slate-400 dark:text-slate-500">{{ $ic->percentage }}% of total income</p>
                            </div>
                        </div>

                        <div class="text-right shrink-0">
                            <span class="text-sm font-black text-emerald-600 dark:text-emerald-400">
                                +৳ {{ number_format((float) $ic->total, 2) }}
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

</div>

