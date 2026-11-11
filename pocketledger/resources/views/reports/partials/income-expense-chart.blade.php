<!-- Income vs Expense Trend Comparison Chart -->
@php
    $trend = $report['trend'] ?? collect();
    $maxVal = 0.0;
    foreach ($trend as $t) {
        $maxVal = max($maxVal, (float) ($t->income ?? 0), (float) ($t->expense ?? 0));
    }
@endphp

<div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl p-4.5 sm:p-6 shadow-xs hover:shadow-md transition-all">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-6">
        <div class="flex items-center gap-2.5">
            <div class="w-8 h-8 rounded-xl bg-emerald-50 dark:bg-emerald-950/60 text-emerald-600 dark:text-emerald-400 flex items-center justify-center shrink-0">
                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="20" x2="18" y2="10"></line>
                    <line x1="12" y1="20" x2="12" y2="4"></line>
                    <line x1="6" y1="20" x2="6" y2="14"></line>
                </svg>
            </div>
            <div>
                <h2 class="text-base sm:text-lg font-bold text-slate-900 dark:text-white">Income vs Expense Trend</h2>
                <p class="text-[11px] sm:text-xs text-slate-400 dark:text-slate-500 font-medium">Timeline comparison over the selected reporting window</p>
            </div>
        </div>

        <!-- Legend -->
        <div class="flex items-center gap-4 text-xs font-semibold">
            <div class="flex items-center gap-1.5">
                <span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span>
                <span class="text-slate-600 dark:text-slate-300">Income</span>
            </div>
            <div class="flex items-center gap-1.5">
                <span class="w-2.5 h-2.5 rounded-full bg-rose-500"></span>
                <span class="text-slate-600 dark:text-slate-300">Expense</span>
            </div>
        </div>
    </div>

    @if ($trend->isEmpty() || $maxVal <= 0)
        <!-- Empty State -->
        <div class="py-12 text-center">
            <div class="w-12 h-12 mx-auto rounded-2xl bg-slate-100 dark:bg-slate-800 text-slate-400 flex items-center justify-center mb-3">
                <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="18" y1="20" x2="18" y2="10"></line>
                    <line x1="12" y1="20" x2="12" y2="4"></line>
                    <line x1="6" y1="20" x2="6" y2="14"></line>
                </svg>
            </div>
            <p class="text-xs sm:text-sm font-semibold text-slate-400 dark:text-slate-500">No timeline trend data recorded for this period.</p>
        </div>
    @else
        <!-- Multi-bar Chart Layout -->
        <div class="relative pt-6 pb-2">
            <!-- Grid Lines -->
            <div class="absolute inset-x-0 top-6 bottom-8 flex flex-col justify-between pointer-events-none opacity-40">
                <div class="border-b border-dashed border-slate-200 dark:border-slate-800 w-full"></div>
                <div class="border-b border-dashed border-slate-200 dark:border-slate-800 w-full"></div>
                <div class="border-b border-dashed border-slate-200 dark:border-slate-800 w-full"></div>
            </div>

            <!-- Scrollable Bar Canvas -->
            <div class="overflow-x-auto pb-2">
                <div class="min-w-[480px] h-48 flex items-end justify-around gap-2 px-2">
                    @foreach ($trend as $t)
                        @php
                            $incAmt = (float) ($t->income ?? 0);
                            $expAmt = (float) ($t->expense ?? 0);
                            $incHeight = $maxVal > 0 ? max(4, round(($incAmt / $maxVal) * 100)) : 0;
                            $expHeight = $maxVal > 0 ? max(4, round(($expAmt / $maxVal) * 100)) : 0;
                            
                            // Format period label: '2026-11' -> 'Nov', '2026-11-05' -> 'Nov 05'
                            $periodLabel = $t->period;
                            if (strlen($t->period) === 7) {
                                $periodLabel = \Carbon\Carbon::createFromFormat('Y-m', $t->period)->format('M');
                            } elseif (strlen($t->period) === 10) {
                                $periodLabel = \Carbon\Carbon::parse($t->period)->format('d M');
                            }
                        @endphp
                        
                        <div class="flex-1 flex flex-col items-center gap-1.5 h-full justify-end group">
                            <!-- Tooltip on hover -->
                            <div class="opacity-0 group-hover:opacity-100 transition-opacity text-[10px] bg-slate-900 text-white dark:bg-slate-800 px-2 py-1 rounded-lg pointer-events-none shadow-md mb-1 whitespace-nowrap z-10">
                                <div>+৳{{ number_format($incAmt, 0) }}</div>
                                <div>-৳{{ number_format($expAmt, 0) }}</div>
                            </div>

                            <!-- Paired Bars -->
                            <div class="flex items-end gap-1 w-full justify-center h-36">
                                <!-- Income Bar -->
                                <div
                                    class="w-2.5 sm:w-3.5 bg-gradient-to-t from-emerald-600 to-teal-400 rounded-t-md transition-all duration-300"
                                    style="height: {{ $incAmt > 0 ? $incHeight : 4 }}%"
                                    title="Income: ৳ {{ number_format($incAmt, 2) }}"
                                ></div>

                                <!-- Expense Bar -->
                                <div
                                    class="w-2.5 sm:w-3.5 bg-gradient-to-t from-rose-600 to-rose-400 rounded-t-md transition-all duration-300"
                                    style="height: {{ $expAmt > 0 ? $expHeight : 4 }}%"
                                    title="Expense: ৳ {{ number_format($expAmt, 2) }}"
                                ></div>
                            </div>

                            <!-- Label -->
                            <span class="text-[10px] font-bold text-slate-500 dark:text-slate-400 tracking-tight truncate max-w-[45px] text-center">
                                {{ $periodLabel }}
                            </span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
</div>

