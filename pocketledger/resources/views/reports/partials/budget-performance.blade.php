<!-- Budget vs Actual Performance Section -->
@php
    $startMonth = \Carbon\Carbon::parse($report['period']['startDate'])->format('Y-m-01');
    $endMonth = \Carbon\Carbon::parse($report['period']['endDate'])->format('Y-m-01');

    // Retrieve budgets within this period
    $budgets = Auth::user()->budgets()
        ->with('category')
        ->whereBetween('budget_month', [$startMonth, $endMonth])
        ->get();

    // Map spent amounts from expenseByCategory
    $expenseByCatId = ($report['expenseByCategory'] ?? collect())->keyBy('category_id');
@endphp

<div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl p-4.5 sm:p-6 shadow-xs hover:shadow-md transition-all">
    <div class="flex items-center justify-between mb-5">
        <div class="flex items-center gap-2.5">
            <div class="w-8 h-8 rounded-xl bg-teal-50 dark:bg-teal-950/60 text-teal-600 dark:text-teal-400 flex items-center justify-center shrink-0">
                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 12V7H5a2 2 0 0 1 0-4h14v4"></path>
                    <path d="M3 5v14a2 2 0 0 0 2 2h16v-5"></path>
                    <path d="M18 12a2 2 0 0 0 0 4h4v-4z"></path>
                </svg>
            </div>
            <div>
                <h2 class="text-base font-bold text-slate-900 dark:text-white">Budget vs Actual Performance</h2>
                <p class="text-[11px] text-slate-400 dark:text-slate-500 font-medium">Tracking allocated limits against realized spending</p>
            </div>
        </div>

        <a href="{{ route('budgets.index') }}" class="text-xs font-bold text-emerald-600 dark:text-emerald-400 hover:text-emerald-700 inline-flex items-center gap-1 transition-colors ios-press">
            <span>Manage Budgets</span>
            <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                <polyline points="9 18 15 12 9 6"></polyline>
            </svg>
        </a>
    </div>

    @if ($budgets->isEmpty())
        <div class="py-10 text-center">
            <div class="w-12 h-12 mx-auto rounded-2xl bg-slate-100 dark:bg-slate-800 text-slate-400 flex items-center justify-center mb-3">
                <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M21 12V7H5a2 2 0 0 1 0-4h14v4"></path>
                    <path d="M3 5v14a2 2 0 0 0 2 2h16v-5"></path>
                    <path d="M18 12a2 2 0 0 0 0 4h4v-4z"></path>
                </svg>
            </div>
            <p class="text-xs sm:text-sm font-semibold text-slate-400 dark:text-slate-500">No active category budgets configured for this timeframe.</p>
            <a href="{{ route('budgets.create') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-emerald-600 dark:text-emerald-400 hover:text-emerald-700 mt-2 transition-colors ios-press">
                + Create a Monthly Budget
            </a>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3.5 sm:gap-4">
            @foreach ($budgets as $b)
                @php
                    $catSpend = (float) ($expenseByCatId->get($b->category_id)?->total ?? 0);
                    $budgetLimit = (float) $b->amount;
                    $pct = $budgetLimit > 0 ? round(($catSpend / $budgetLimit) * 100, 1) : 0;
                    $remaining = $budgetLimit - $catSpend;

                    if ($catSpend >= $budgetLimit) {
                        $badgeClass = 'bg-rose-100 text-rose-800 dark:bg-rose-950 dark:text-rose-300';
                        $statusText = 'Exceeded';
                        $barColor = 'bg-rose-500';
                    } elseif ($pct >= 80) {
                        $badgeClass = 'bg-amber-100 text-amber-800 dark:bg-amber-950 dark:text-amber-300';
                        $statusText = 'Warning';
                        $barColor = 'bg-amber-500';
                    } else {
                        $badgeClass = 'bg-emerald-100 text-emerald-800 dark:bg-emerald-950 dark:text-emerald-300';
                        $statusText = 'On Track';
                        $barColor = 'bg-emerald-500';
                    }
                @endphp
                <div class="p-4 rounded-2xl bg-slate-50 dark:bg-slate-800/60 border border-slate-100 dark:border-slate-700/60 flex flex-col justify-between space-y-3">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2 min-w-0">
                            <span class="w-3 h-3 rounded-full shrink-0" style="background-color: {{ $b->category?->color ?? '#10B981' }}"></span>
                            <span class="text-xs font-bold text-slate-900 dark:text-white truncate">
                                {{ $b->category?->name ?? 'General' }}
                            </span>
                        </div>
                        <span class="text-[10px] font-extrabold px-2 py-0.5 rounded-full {{ $badgeClass }}">
                            {{ $statusText }}
                        </span>
                    </div>

                    <div>
                        <div class="flex items-baseline justify-between text-xs mb-1">
                            <span class="text-slate-500 dark:text-slate-400 font-medium">Spent: <b class="text-slate-900 dark:text-white">৳{{ number_format($catSpend, 0) }}</b></span>
                            <span class="text-slate-500 dark:text-slate-400 font-medium">Limit: ৳{{ number_format($budgetLimit, 0) }}</span>
                        </div>
                        <div class="w-full bg-slate-200 dark:bg-slate-700 h-2 rounded-full overflow-hidden">
                            <div class="{{ $barColor }} h-full rounded-full transition-all duration-300" style="width: {{ min(100, $pct) }}%"></div>
                        </div>
                        <div class="flex items-center justify-between text-[11px] font-semibold mt-1.5">
                            <span class="text-slate-400">{{ $pct }}% utilized</span>
                            <span class="{{ $remaining >= 0 ? 'text-emerald-600 dark:text-emerald-400' : 'text-rose-500' }}">
                                {{ $remaining >= 0 ? '৳' . number_format($remaining, 0) . ' left' : '-৳' . number_format(abs($remaining), 0) . ' over' }}
                            </span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

