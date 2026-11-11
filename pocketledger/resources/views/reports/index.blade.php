<!DOCTYPE html>
<html lang="en">
<head>
    <title>PocketLedger - Financial Reports</title>
    <x-head-meta />
</head>
<body class="bg-slate-50 dark:bg-slate-950 text-slate-800 dark:text-slate-100 antialiased min-h-screen">

    <div class="min-h-screen flex flex-col lg:flex-row">

        <!-- ======================================================== -->
        <!-- DESKTOP SIDEBAR NAVIGATION (Visible on lg: 1024px+)       -->
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

                <!-- Budgets -->
                <a href="{{ route('budgets.index') }}" class="flex items-center gap-3.5 px-3.5 py-3 rounded-2xl text-sm font-medium text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors">
                    <svg class="w-5 h-5 text-slate-400 dark:text-slate-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 12V7H5a2 2 0 0 1 0-4h14v4"></path>
                        <path d="M3 5v14a2 2 0 0 0 2 2h16v-5"></path>
                        <path d="M18 12a2 2 0 0 0 0 4h4v-4z"></path>
                    </svg>
                    <span>Budgets</span>
                </a>

                <!-- Reports (Active) -->
                <a href="{{ route('reports.index') }}" class="flex items-center gap-3.5 px-3.5 py-3 rounded-2xl text-sm font-semibold bg-emerald-50 dark:bg-emerald-950/60 text-emerald-700 dark:text-emerald-400 transition-colors">
                    <svg class="w-5 h-5 text-emerald-600 dark:text-emerald-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round">
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
        <div class="flex-1 flex flex-col min-w-0 pb-20 lg:pb-12">

            <!-- Top Header Bar (Desktop & Mobile) -->
            <header class="h-16 sm:h-20 bg-white/80 dark:bg-slate-900/80 backdrop-blur-md border-b border-slate-200/80 dark:border-slate-800/80 px-4 sm:px-8 flex items-center justify-between sticky top-0 z-20 transition-colors">
                <!-- Mobile Brand (hidden on lg: screens) -->
                <div class="flex items-center gap-2.5 lg:hidden">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2.5">
                        <div class="w-8 h-8 rounded-xl bg-gradient-to-tr from-emerald-600 to-teal-500 flex items-center justify-center text-white shadow-sm shadow-emerald-500/20">
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3">
                                <rect x="2" y="5" width="20" height="15" rx="3"/>
                                <path d="M2 9h20"/>
                            </svg>
                        </div>
                        <span class="text-base font-extrabold tracking-tight text-slate-900 dark:text-white">
                            Pocket<span class="text-emerald-500">Ledger</span>
                        </span>
                    </a>
                </div>

                <!-- Desktop Greeting (hidden on mobile) -->
                <div class="hidden lg:flex items-center gap-2">
                    <span class="text-xs text-slate-400 dark:text-slate-500">Reports Dashboard •</span>
                    <span class="text-sm font-bold text-slate-900 dark:text-white">{{ Auth::user()->name ?? 'User' }}</span>
                </div>

                <!-- Top Bar Right Actions -->
                <div class="flex items-center gap-2 sm:gap-3">
                    <div class="hidden lg:block">
                        <x-theme-toggle />
                    </div>

                    <a
                        href="{{ route('transactions.create') }}"
                        class="hidden sm:inline-flex items-center gap-1.5 px-3 sm:px-4 py-2 rounded-2xl bg-emerald-500 hover:bg-emerald-600 text-white font-bold text-xs shadow-md shadow-emerald-500/25 transition-all ios-press"
                    >
                        <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                        <span>Add Transaction</span>
                    </a>

                    <x-profile-dropdown />
                </div>
            </header>

            <!-- Main Page Container -->
            <main class="flex-1 px-4 sm:px-8 py-5 sm:py-8 max-w-7xl w-full mx-auto space-y-6 sm:space-y-8">

                <!-- 1. Header Section -->
                @include('reports.partials.header')

                <!-- 2. Filter Bar -->
                @include('reports.partials.filters')

                <!-- 3. Summary Cards -->
                @include('reports.partials.summary-cards')

                <!-- 4. Income vs Expense Trend Chart -->
                @include('reports.partials.income-expense-chart')

                <!-- 5. Category Breakdowns (Expense & Income) -->
                @include('reports.partials.category-breakdown')

                <!-- 6. Budget Performance -->
                @include('reports.partials.budget-performance')

                <!-- 7. Recent Transactions Table / Card List -->
                @include('reports.partials.recent-transactions')

            </main>

        </div>

    </div>

    <!-- iOS Translucent Bottom Tab Bar with Raised FAB -->
    <x-bottom-nav active="reports" />

</body>
</html>

