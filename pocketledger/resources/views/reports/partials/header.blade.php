<!-- Header: Title, Description & Active Period Badge -->
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 pt-1">
    <div>
        <div class="flex items-center gap-2.5">
            <h1 class="text-2xl sm:text-3xl font-black text-slate-900 dark:text-white tracking-tight">Financial Reports</h1>
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 dark:bg-emerald-950/80 dark:text-emerald-300 border border-emerald-200 dark:border-emerald-800/60 capitalize">
                {{ $reportType }}
            </span>
        </div>
        <p class="text-xs sm:text-sm text-slate-500 dark:text-slate-400 font-medium mt-0.5">
            Comprehensive financial breakdown, category distribution, and spending trends
        </p>
    </div>

    <!-- Active Range Display Badge -->
    <div class="flex items-center gap-2">
        <div class="inline-flex items-center gap-2 px-3.5 py-2 rounded-2xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-xs font-semibold text-slate-700 dark:text-slate-200 shadow-xs">
            <svg class="w-4 h-4 text-emerald-500 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                <line x1="16" y1="2" x2="16" y2="6"></line>
                <line x1="8" y1="2" x2="8" y2="6"></line>
                <line x1="3" y1="10" x2="21" y2="10"></line>
            </svg>
            <span>
                @if ($reportType === 'yearly')
                    Year {{ $selectedYear }}
                @elseif ($reportType === 'custom')
                    {{ \Carbon\Carbon::parse($startDate)->format('M d, Y') }} – {{ \Carbon\Carbon::parse($endDate)->format('M d, Y') }}
                @else
                    {{ \Carbon\Carbon::createFromFormat('Y-m', $selectedMonth)->format('F Y') }}
                @endif
            </span>
        </div>

        <button
            type="button"
            onclick="window.print()"
            class="hidden sm:inline-flex items-center gap-1.5 px-3.5 py-2 rounded-2xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-700 dark:text-slate-200 hover:bg-slate-50 dark:hover:bg-slate-700 text-xs font-bold transition-colors shadow-xs ios-press"
            title="Print or Save PDF"
        >
            <svg class="w-4 h-4 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="6 9 6 2 18 2 18 9"></polyline>
                <path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path>
                <rect x="6" y="14" width="12" height="8"></rect>
            </svg>
            <span>Export</span>
        </button>
    </div>
</div>

