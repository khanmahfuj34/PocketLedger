<!DOCTYPE html>
<html lang="en">
<head>
    <title>PocketLedger - Monthly Budgets</title>
    <x-head-meta />
</head>
<body class="bg-slate-50 dark:bg-slate-950 text-slate-800 dark:text-slate-100 antialiased min-h-screen">

    <div class="min-h-screen flex flex-col lg:flex-row">

        <!-- ======================================================== -->
        <!-- DESKTOP SIDEBAR NAVIGATION                               -->
        <!-- ======================================================== -->
        <aside class="hidden lg:flex lg:flex-col lg:w-64 xl:w-72 bg-white dark:bg-slate-900 border-r border-slate-200 dark:border-slate-800 shrink-0 sticky top-0 h-screen z-30 transition-colors">
            <!-- Brand Logo -->
            <div class="h-20 flex items-center px-6 border-b border-slate-100 dark:border-slate-800">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 group">
                    <div class="w-10 h-10 rounded-2xl bg-gradient-to-tr from-emerald-600 to-teal-500 flex items-center justify-center text-white shadow-md shadow-emerald-500/20 group-hover:scale-105 transition-transform">
                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="2" y="5" width="20" height="15" rx="3"/>
                            <path d="M2 9h20"/>
                            <circle cx="16" cy="14" r="1.5" fill="currentColor"/>
                        </svg>
                    </div>
                    <span class="text-xl font-extrabold tracking-tight text-slate-900 dark:text-white">
                        Pocket<span class="text-emerald-500">Ledger</span>
                    </span>
                </a>
            </div>

            <!-- Navigation Links -->
            <div class="flex-1 px-4 py-6 space-y-1.5 overflow-y-auto">
                <p class="px-3 text-xs font-semibold text-slate-400 dark:text-slate-500 uppercase tracking-wider mb-2">Main Menu</p>

                <!-- Dashboard -->
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3.5 px-3.5 py-3 rounded-2xl text-sm font-medium text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors">
                    <svg class="w-5 h-5 text-slate-400 dark:text-slate-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M10.707 2.293a1 1 0 0 1 1.414 0l8 8A1 1 0 0 1 20 11v9a2 2 0 0 1-2 2h-4a1 1 0 0 1-1-1v-5a1 1 0 0 0-1-1h-2a1 1 0 0 0-1 1v5a1 1 0 0 1-1 1H6a2 2 0 0 1-2-2v-9a1 1 0 0 1 .293-.707l8-8z"/>
                    </svg>
                    <span>Dashboard</span>
                </a>

                <!-- Transactions -->
                <a href="{{ route('transactions.index') }}" class="flex items-center gap-3.5 px-3.5 py-3 rounded-2xl text-sm font-medium text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors">
                    <svg class="w-5 h-5 text-slate-400 dark:text-slate-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="17 1 21 5 17 9"></polyline>
                        <path d="M3 11V9a4 4 0 0 1 4-4h14"></path>
                        <polyline points="7 23 3 19 7 15"></polyline>
                        <path d="M21 13v2a4 4 0 0 1-4 4H3"></path>
                    </svg>
                    <span>Transactions</span>
                </a>

                <!-- Budgets (Active) -->
                <a href="{{ route('budgets.index') }}" class="flex items-center gap-3.5 px-3.5 py-3 rounded-2xl text-sm font-semibold bg-emerald-50 dark:bg-emerald-950/60 text-emerald-700 dark:text-emerald-400 transition-colors">
                    <svg class="w-5 h-5 text-emerald-600 dark:text-emerald-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 12V7H5a2 2 0 0 1 0-4h14v4"></path>
                        <path d="M3 5v14a2 2 0 0 0 2 2h16v-5"></path>
                        <path d="M18 12a2 2 0 0 0 0 4h4v-4z"></path>
                    </svg>
                    <span>Budgets</span>
                </a>

                <!-- Reports -->
                <a href="{{ route('reports.index') }}" class="flex items-center gap-3.5 px-3.5 py-3 rounded-2xl text-sm font-medium text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors">
                    <svg class="w-5 h-5 text-slate-400 dark:text-slate-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="20" x2="18" y2="10"></line>
                        <line x1="12" y1="20" x2="12" y2="4"></line>
                        <line x1="6" y1="20" x2="6" y2="14"></line>
                    </svg>
                    <span>Reports</span>
                </a>

                <p class="px-3 pt-6 text-xs font-semibold text-slate-400 dark:text-slate-500 uppercase tracking-wider mb-2">Preferences</p>

                <!-- Profile / Theme -->
                <div class="px-3.5 py-2.5 rounded-2xl flex items-center justify-between text-sm text-slate-600 dark:text-slate-400">
                    <span class="font-medium">Theme Mode</span>
                    <x-theme-toggle />
                </div>
            </div>

            <!-- User Info & Logout Card -->
            <div class="p-4 bg-slate-50 dark:bg-slate-900/60 border-t border-slate-100 dark:border-slate-800 flex items-center justify-between">
                <div class="flex items-center gap-3 min-w-0">
                    <div class="w-9 h-9 rounded-full bg-violet-100 dark:bg-violet-950/80 text-violet-600 dark:text-violet-400 font-bold flex items-center justify-center text-sm shrink-0">
                        {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 1)) }}
                    </div>
                    <div class="min-w-0">
                        <p class="text-xs font-bold text-slate-800 dark:text-slate-200 truncate">{{ Auth::user()->name ?? 'Pocket User' }}</p>
                        <p class="text-[11px] text-slate-400 dark:text-slate-500 truncate">{{ Auth::user()->email ?? 'user@example.com' }}</p>
                    </div>
                </div>

                @auth
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" title="Logout" class="p-2 text-slate-400 hover:text-red-500 hover:bg-red-50 dark:hover:bg-red-950/30 rounded-xl transition-colors ios-press">
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                <polyline points="16 17 21 12 16 7"></polyline>
                                <line x1="21" y1="12" x2="9" y2="12"></line>
                            </svg>
                        </button>
                    </form>
                @endauth
            </div>
        </aside>

        <!-- ======================================================== -->
        <!-- MAIN CONTENT AREA                                        -->
        <!-- ======================================================== -->
        <div class="flex-1 flex flex-col min-w-0 overflow-y-auto">

            <!-- TOP NAVBAR (Mobile View) -->
            <header class="lg:hidden sticky top-0 z-30 bg-white/80 dark:bg-slate-900/80 backdrop-blur-xl border-b border-slate-200/80 dark:border-slate-800/80 pt-[max(env(safe-area-inset-top,0px),0.75rem)] pb-3 px-4 sm:px-6 transition-colors">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2.5">
                        <div class="w-8 h-8 rounded-xl bg-gradient-to-tr from-emerald-600 to-teal-500 flex items-center justify-center text-white shadow-xs">
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3">
                                <path d="M21 12V7H5a2 2 0 0 1 0-4h14v4"></path>
                                <path d="M3 5v14a2 2 0 0 0 2 2h16v-5"></path>
                                <path d="M18 12a2 2 0 0 0 0 4h4v-4z"></path>
                            </svg>
                        </div>
                        <span class="text-base font-extrabold tracking-tight text-slate-900 dark:text-white">
                            Budgets
                        </span>
                    </div>

                    <div class="flex items-center gap-2">
                        <div class="hidden lg:block">
                            <x-theme-toggle />
                        </div>

                        <a href="{{ route('budgets.create') }}" class="p-2 rounded-xl bg-emerald-500 hover:bg-emerald-600 text-white font-bold transition-all shadow-xs ios-press" title="Create Budget">
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                            </svg>
                        </a>

                        <x-profile-dropdown />
                    </div>
                </div>
            </header>

            <!-- SCROLLABLE CONTENT BODY -->
            <main class="flex-1 p-3.5 sm:p-6 lg:p-8 max-w-7xl w-full mx-auto space-y-5 sm:space-y-6 pb-[calc(5.5rem+env(safe-area-inset-bottom,0px))] lg:pb-12">

                <!-- Page Title Row -->
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 pt-1">
                    <div>
                        <h1 class="text-2xl sm:text-3xl font-black text-slate-900 dark:text-white tracking-tight">Monthly Budgets</h1>
                        <p class="text-xs sm:text-sm text-slate-500 dark:text-slate-400 font-medium mt-0.5">Manage and review your monthly category spending targets</p>
                    </div>

                    <div class="flex items-center gap-2.5">
                        <div class="hidden lg:block">
                            <x-theme-toggle />
                        </div>

                        <a href="{{ route('budgets.create') }}" class="w-full sm:w-auto flex items-center justify-center gap-2 py-3 px-5 rounded-2xl bg-gradient-to-tr from-emerald-600 to-teal-500 hover:from-emerald-700 hover:to-teal-600 text-white font-bold text-sm shadow-md shadow-emerald-500/25 transition-all ios-press">
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                            </svg>
                            <span>Create Budget</span>
                        </a>
                    </div>
                </div>

                <!-- Flash Success Notification -->
                @if (session('success'))
                    <div class="p-4 rounded-3xl bg-emerald-50 dark:bg-emerald-950/40 border border-emerald-200 dark:border-emerald-800 text-emerald-800 dark:text-emerald-300 shadow-xs flex items-center justify-between gap-3">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-2xl bg-emerald-500 text-white flex items-center justify-center shrink-0">
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-bold text-emerald-900 dark:text-emerald-200">{{ session('success') }}</p>
                                <p class="text-xs text-emerald-700 dark:text-emerald-400">Your budget settings have been updated.</p>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- ======================================================== -->
                <!-- SUMMARY CARDS ROW                                        -->
                <!-- ======================================================== -->
                @php
                    $pageBudgetSum = $budgets->sum('amount');
                    $totalCount = $budgets->total();
                    $latestBudget = $budgets->first();
                @endphp

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3.5 sm:gap-6">
                    <!-- Total Budgeted Amount (Page) -->
                    <div class="bg-emerald-50/80 dark:bg-emerald-950/30 border border-emerald-100 dark:border-emerald-900/50 rounded-3xl p-4 sm:p-5 flex items-center justify-between shadow-xs">
                        <div>
                            <span class="text-xs font-bold text-emerald-800 dark:text-emerald-300">Total Budgeted (Page)</span>
                            <div class="text-xl sm:text-2xl font-black text-slate-900 dark:text-white mt-1">
                                ৳ {{ number_format((float) $pageBudgetSum, 2) }}
                            </div>
                        </div>
                        <div class="w-10 h-10 rounded-2xl bg-emerald-200/80 dark:bg-emerald-800/40 text-emerald-800 dark:text-emerald-300 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                            </svg>
                        </div>
                    </div>

                    <!-- Active Budgets Count -->
                    <div class="bg-teal-50/80 dark:bg-teal-950/30 border border-teal-100 dark:border-teal-900/50 rounded-3xl p-4 sm:p-5 flex items-center justify-between shadow-xs">
                        <div>
                            <span class="text-xs font-bold text-teal-800 dark:text-teal-300">Active Budgets</span>
                            <div class="text-xl sm:text-2xl font-black text-slate-900 dark:text-white mt-1">
                                {{ $totalCount }} {{ Str::plural('record', $totalCount) }}
                            </div>
                        </div>
                        <div class="w-10 h-10 rounded-2xl bg-teal-200/80 dark:bg-teal-800/40 text-teal-800 dark:text-teal-300 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                <line x1="16" y1="2" x2="16" y2="6"></line>
                                <line x1="8" y1="2" x2="8" y2="6"></line>
                                <line x1="3" y1="10" x2="21" y2="10"></line>
                            </svg>
                        </div>
                    </div>

                    <!-- Latest Budget Month -->
                    <div class="bg-violet-50/80 dark:bg-violet-950/30 border border-violet-100 dark:border-violet-900/50 rounded-3xl p-4 sm:p-5 flex items-center justify-between shadow-xs">
                        <div>
                            <span class="text-xs font-bold text-violet-800 dark:text-violet-300">Latest Budget Month</span>
                            <div class="text-xl sm:text-2xl font-black text-slate-900 dark:text-white mt-1">
                                {{ $latestBudget && $latestBudget->budget_month ? $latestBudget->budget_month->format('M Y') : 'None' }}
                            </div>
                        </div>
                        <div class="w-10 h-10 rounded-2xl bg-violet-200/80 dark:bg-violet-800/40 text-violet-800 dark:text-violet-300 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"></circle>
                                <polyline points="12 6 12 12 16 14"></polyline>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- ======================================================== -->
                <!-- BUDGET LIST (Desktop Table + Mobile Cards)               -->
                <!-- ======================================================== -->
                @if ($budgets->isEmpty())
                    <!-- EMPTY STATE -->
                    <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl p-8 sm:p-14 text-center shadow-xs">
                        <div class="w-16 h-16 sm:w-20 sm:h-20 mx-auto rounded-3xl bg-emerald-50 dark:bg-emerald-950/60 text-emerald-600 dark:text-emerald-400 flex items-center justify-center shadow-inner mb-4">
                            <svg class="w-8 h-8 sm:w-10 sm:h-10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 12V7H5a2 2 0 0 1 0-4h14v4"></path>
                                <path d="M3 5v14a2 2 0 0 0 2 2h16v-5"></path>
                                <path d="M18 12a2 2 0 0 0 0 4h4v-4z"></path>
                            </svg>
                        </div>
                        <h2 class="text-lg sm:text-xl font-black text-slate-900 dark:text-white tracking-tight">No monthly budgets found</h2>
                        <p class="text-xs sm:text-sm text-slate-500 dark:text-slate-400 font-medium max-w-md mx-auto mt-1 mb-6">
                            Start taking control of your financial goals by establishing monthly spending limits for your active expense categories.
                        </p>
                        <a href="{{ route('budgets.create') }}" class="inline-flex items-center gap-2 py-3.5 px-6 rounded-2xl bg-gradient-to-tr from-emerald-600 to-teal-500 hover:from-emerald-700 hover:to-teal-600 text-white font-bold text-sm shadow-md shadow-emerald-500/25 transition-all ios-press">
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                            </svg>
                            <span>Create Your First Budget</span>
                        </a>
                    </div>
                @else
                    <!-- DESKTOP TABLE VIEW (lg:block) -->
                    <div class="hidden lg:block bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl overflow-hidden shadow-xs">
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="border-b border-slate-100 dark:border-slate-800 text-[11px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider bg-slate-50/50 dark:bg-slate-900/50">
                                        <th class="py-4 px-6">Expense Category</th>
                                        <th class="py-4 px-6">Budget Month</th>
                                        <th class="py-4 px-6">Monthly Limit</th>
                                        <th class="py-4 px-6 text-right">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100 dark:divide-slate-800/80">
                                    @foreach ($budgets as $budget)
                                        <tr class="hover:bg-slate-50/80 dark:hover:bg-slate-800/50 transition-colors group">
                                            <!-- Category -->
                                            <td class="py-4 px-6 whitespace-nowrap">
                                                <div class="flex items-center gap-3">
                                                    <div class="w-10 h-10 rounded-2xl bg-emerald-50 dark:bg-emerald-950/60 text-emerald-600 dark:text-emerald-400 flex items-center justify-center shrink-0">
                                                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                                            <path d="M21 12V7H5a2 2 0 0 1 0-4h14v4"></path>
                                                            <path d="M3 5v14a2 2 0 0 0 2 2h16v-5"></path>
                                                            <path d="M18 12a2 2 0 0 0 0 4h4v-4z"></path>
                                                        </svg>
                                                    </div>
                                                    <div>
                                                        <span class="font-bold text-sm text-slate-900 dark:text-white">
                                                            {{ $budget->category?->name ?? 'Uncategorized' }}
                                                        </span>
                                                        <p class="text-[11px] text-slate-400 dark:text-slate-500">
                                                            Expense Category
                                                        </p>
                                                    </div>
                                                </div>
                                            </td>

                                            <!-- Budget Month -->
                                            <td class="py-4 px-6 whitespace-nowrap">
                                                <div class="flex items-center gap-2">
                                                    <span class="font-semibold text-sm text-slate-800 dark:text-slate-200">
                                                        {{ $budget->budget_month ? $budget->budget_month->format('F Y') : '-' }}
                                                    </span>
                                                    <span class="text-[10px] font-bold text-slate-500 dark:text-slate-400 bg-slate-100 dark:bg-slate-800 px-2 py-0.5 rounded-lg">
                                                        {{ $budget->budget_month ? $budget->budget_month->format('Y-m') : '' }}
                                                    </span>
                                                </div>
                                            </td>

                                            <!-- Formatted Amount -->
                                            <td class="py-4 px-6 whitespace-nowrap">
                                                <span class="text-base font-black text-slate-900 dark:text-white">
                                                    ৳ {{ number_format((float) $budget->amount, 2) }}
                                                </span>
                                            </td>

                                            <!-- Actions -->
                                            <td class="py-4 px-6 whitespace-nowrap text-right">
                                                <div class="flex items-center justify-end gap-2">
                                                    {{-- Edit Button --}}
                                                    <a
                                                        href="{{ route('budgets.edit', $budget) }}"
                                                        class="p-2 rounded-xl text-slate-400 hover:text-emerald-600 dark:hover:text-emerald-400 hover:bg-emerald-50 dark:hover:bg-emerald-950/40 transition-colors ios-press"
                                                        title="Edit Budget"
                                                    >
                                                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                                        </svg>
                                                    </a>

                                                    {{-- Delete Button Form --}}
                                                    <form
                                                        action="{{ route('budgets.destroy', $budget) }}"
                                                        method="POST"
                                                        onsubmit="return confirm('Are you sure you want to delete this monthly budget for {{ addslashes($budget->category?->name ?? 'this category') }} ({{ $budget->budget_month ? $budget->budget_month->format('M Y') : '' }})?');"
                                                        class="inline-block"
                                                    >
                                                        @csrf
                                                        @method('DELETE')
                                                        <button
                                                            type="submit"
                                                            class="p-2 rounded-xl text-slate-400 hover:text-rose-600 dark:hover:text-rose-400 hover:bg-rose-50 dark:hover:bg-rose-950/40 transition-colors ios-press"
                                                            title="Delete Budget"
                                                        >
                                                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                                                <line x1="10" y1="11" x2="10" y2="17"></line>
                                                                <line x1="14" y1="11" x2="14" y2="17"></line>
                                                            </svg>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- MOBILE CARD VIEW (lg:hidden) -->
                    <div class="lg:hidden space-y-3">
                        @foreach ($budgets as $budget)
                            <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl p-4 sm:p-5 shadow-xs space-y-3">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-2xl bg-emerald-50 dark:bg-emerald-950/60 text-emerald-600 dark:text-emerald-400 flex items-center justify-center shrink-0">
                                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M21 12V7H5a2 2 0 0 1 0-4h14v4"></path>
                                                <path d="M3 5v14a2 2 0 0 0 2 2h16v-5"></path>
                                                <path d="M18 12a2 2 0 0 0 0 4h4v-4z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <h3 class="font-bold text-sm text-slate-900 dark:text-white">
                                                {{ $budget->category?->name ?? 'Uncategorized' }}
                                            </h3>
                                            <p class="text-xs text-slate-400 dark:text-slate-500">
                                                {{ $budget->budget_month ? $budget->budget_month->format('F Y') : '-' }}
                                            </p>
                                        </div>
                                    </div>

                                    <div class="text-right">
                                        <div class="text-base font-black text-slate-900 dark:text-white">
                                            ৳ {{ number_format((float) $budget->amount, 2) }}
                                        </div>
                                        <span class="text-[10px] font-bold text-slate-400 dark:text-slate-500">
                                            Monthly Limit
                                        </span>
                                    </div>
                                </div>

                                <div class="flex items-center justify-between pt-2 border-t border-slate-100 dark:border-slate-800/80">
                                    <span class="text-[11px] font-semibold text-slate-400 dark:text-slate-500 bg-slate-100 dark:bg-slate-800 px-2.5 py-1 rounded-xl">
                                        {{ $budget->budget_month ? $budget->budget_month->format('Y-m') : '' }}
                                    </span>

                                    <div class="flex items-center gap-1.5">
                                        <a
                                            href="{{ route('budgets.edit', $budget) }}"
                                            class="inline-flex items-center gap-1 text-xs font-semibold px-3 py-1.5 rounded-xl text-slate-600 dark:text-slate-300 hover:text-emerald-600 dark:hover:text-emerald-400 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors ios-press"
                                        >
                                            <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                            </svg>
                                            <span>Edit</span>
                                        </a>

                                        <form
                                            action="{{ route('budgets.destroy', $budget) }}"
                                            method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this monthly budget for {{ addslashes($budget->category?->name ?? 'this category') }}?');"
                                            class="inline-block"
                                        >
                                            @csrf
                                            @method('DELETE')
                                            <button
                                                type="submit"
                                                class="inline-flex items-center gap-1 text-xs font-semibold px-3 py-1.5 rounded-xl text-rose-600 dark:text-rose-400 hover:bg-rose-50 dark:hover:bg-rose-950/40 transition-colors ios-press"
                                            >
                                                <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                    <polyline points="3 6 5 6 21 6"></polyline>
                                                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                                </svg>
                                                <span>Delete</span>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- PAGINATION -->
                    @if ($budgets->hasPages())
                        <div class="pt-2">
                            {{ $budgets->links() }}
                        </div>
                    @endif
                @endif

            </main>

        </div>

    </div>

    <!-- iOS Bottom Navigation Bar -->
    <x-bottom-nav active="budgets" />

</body>
</html>

