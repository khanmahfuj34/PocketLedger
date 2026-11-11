<!-- Reports Filter Bar (Monthly, Yearly, Custom) -->
<div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl p-4 sm:p-5 shadow-xs transition-colors">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        
        <!-- Type Pill Selector -->
        <div class="inline-flex p-1 rounded-2xl bg-slate-100 dark:bg-slate-800/80 border border-slate-200/60 dark:border-slate-700/60 self-start">
            <a
                href="{{ route('reports.index', ['type' => 'monthly', 'month' => $selectedMonth ?? now()->format('Y-m')]) }}"
                class="px-3.5 py-1.5 rounded-xl text-xs font-bold transition-all ios-press {{ $reportType === 'monthly' ? 'bg-white dark:bg-slate-900 text-emerald-600 dark:text-emerald-400 shadow-xs' : 'text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white' }}"
            >
                Monthly
            </a>
            <a
                href="{{ route('reports.index', ['type' => 'yearly', 'year' => $selectedYear ?? now()->year]) }}"
                class="px-3.5 py-1.5 rounded-xl text-xs font-bold transition-all ios-press {{ $reportType === 'yearly' ? 'bg-white dark:bg-slate-900 text-emerald-600 dark:text-emerald-400 shadow-xs' : 'text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white' }}"
            >
                Yearly
            </a>
            <a
                href="{{ route('reports.index', ['type' => 'custom', 'start_date' => $startDate ?? now()->startOfMonth()->toDateString(), 'end_date' => $endDate ?? now()->endOfMonth()->toDateString()]) }}"
                class="px-3.5 py-1.5 rounded-xl text-xs font-bold transition-all ios-press {{ $reportType === 'custom' ? 'bg-white dark:bg-slate-900 text-emerald-600 dark:text-emerald-400 shadow-xs' : 'text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white' }}"
            >
                Custom Range
            </a>
        </div>

        <!-- Filter Input Controls -->
        <form method="GET" action="{{ route('reports.index') }}" class="flex flex-wrap items-center gap-2 sm:gap-3">
            <input type="hidden" name="type" value="{{ $reportType }}">

            @if ($reportType === 'yearly')
                <!-- Yearly Selector -->
                <div class="flex items-center gap-2">
                    <label for="reportYear" class="text-xs font-bold text-slate-500 dark:text-slate-400">Select Year:</label>
                    <select
                        id="reportYear"
                        name="year"
                        onchange="this.form.submit()"
                        class="px-3.5 py-2 rounded-2xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-900 dark:text-white font-bold text-xs focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all cursor-pointer shadow-xs"
                    >
                        @php
                            $currentYear = (int) now()->year;
                            $userRegYear = Auth::user()->created_at ? (int) Auth::user()->created_at->year : $currentYear;
                            $minYear = min($userRegYear, $currentYear - 4);
                        @endphp
                        @for ($y = $currentYear; $y >= $minYear; $y--)
                            <option value="{{ $y }}" {{ (int) $selectedYear === $y ? 'selected' : '' }}>
                                {{ $y }}
                            </option>
                        @endfor
                    </select>
                </div>

            @elseif ($reportType === 'custom')
                <!-- Custom Date Range -->
                <div class="flex flex-wrap items-center gap-2">
                    <div class="flex items-center gap-1.5">
                        <span class="text-xs font-bold text-slate-500 dark:text-slate-400">From</span>
                        <input
                            type="date"
                            name="start_date"
                            value="{{ $startDate }}"
                            required
                            class="px-3 py-1.5 rounded-2xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-900 dark:text-white font-semibold text-xs focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all shadow-xs"
                        />
                    </div>

                    <div class="flex items-center gap-1.5">
                        <span class="text-xs font-bold text-slate-500 dark:text-slate-400">To</span>
                        <input
                            type="date"
                            name="end_date"
                            value="{{ $endDate }}"
                            required
                            class="px-3 py-1.5 rounded-2xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-900 dark:text-white font-semibold text-xs focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all shadow-xs"
                        />
                    </div>

                    <button
                        type="submit"
                        class="px-4 py-2 rounded-2xl bg-emerald-500 hover:bg-emerald-600 text-white font-bold text-xs shadow-sm shadow-emerald-500/20 transition-all ios-press cursor-pointer"
                    >
                        Apply
                    </button>
                </div>

            @else
                <!-- Monthly Selector -->
                <div class="flex items-center gap-2">
                    <label for="reportMonth" class="text-xs font-bold text-slate-500 dark:text-slate-400">Reporting Month:</label>
                    <input
                        type="month"
                        id="reportMonth"
                        name="month"
                        value="{{ $selectedMonth }}"
                        onchange="this.form.submit()"
                        class="px-3.5 py-1.5 rounded-2xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-900 dark:text-white font-bold text-xs focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all cursor-pointer shadow-xs"
                    />
                </div>
            @endif
        </form>

    </div>
</div>

