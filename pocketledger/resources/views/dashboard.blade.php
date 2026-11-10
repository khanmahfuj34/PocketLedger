<!DOCTYPE html>
<html lang="en">
<head>
    <title>PocketLedger - Dashboard</title>
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

                <!-- Dashboard (Active) -->
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3.5 px-3.5 py-3 rounded-2xl text-sm font-semibold bg-emerald-50 dark:bg-emerald-950/60 text-emerald-700 dark:text-emerald-400 transition-colors">
                    <svg class="w-5 h-5 text-emerald-600 dark:text-emerald-400" viewBox="0 0 24 24" fill="currentColor">
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

                <!-- Reports -->
                <a href="#analytics" class="flex items-center gap-3.5 px-3.5 py-3 rounded-2xl text-sm font-medium text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors">
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

            <!-- Quick Add Action in Sidebar -->
            <div class="p-4 border-t border-slate-100 dark:border-slate-800">
                <a href="{{ route('transactions.create') }}" class="w-full flex items-center justify-center gap-2 py-3 px-4 rounded-2xl bg-emerald-500 hover:bg-emerald-600 text-white font-bold text-sm shadow-md shadow-emerald-500/20 transition-all hover:shadow-lg hover:shadow-emerald-500/30 ios-press">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="12" y1="5" x2="12" y2="19"></line>
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                    <span>Add Transaction</span>
                </a>
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
        <!-- MAIN DASHBOARD CONTENT AREA                              -->
        <!-- ======================================================== -->
        <div class="flex-1 min-w-0 flex flex-col">

            <!-- TOP NAVBAR (Responsive: Mobile & Desktop with Safe Area Spacing) -->
            <header class="bg-white/80 dark:bg-slate-900/80 backdrop-blur-xl border-b border-slate-200/80 dark:border-slate-800/80 sticky top-0 z-30 pt-[env(safe-area-inset-top,0px)] transition-colors">
                <div class="max-w-7xl mx-auto px-3.5 sm:px-6 lg:px-8 h-14 sm:h-16 flex items-center justify-between gap-3">
                    
                    <!-- Mobile Brand Logo -->
                    <div class="flex items-center gap-2.5 lg:hidden">
                        <a href="{{ route('dashboard') }}" class="flex items-center gap-2 ios-press">
                            <div class="w-8 h-8 rounded-xl bg-gradient-to-tr from-emerald-600 to-teal-500 flex items-center justify-center text-white shadow-sm shadow-emerald-500/30">
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="2" y="5" width="20" height="15" rx="3"/>
                                    <path d="M2 9h20"/>
                                    <circle cx="16" cy="14" r="1.5" fill="currentColor"/>
                                </svg>
                            </div>
                            <span class="text-base sm:text-lg font-extrabold tracking-tight text-slate-900 dark:text-white">
                                Pocket<span class="text-emerald-500">Ledger</span>
                            </span>
                        </a>
                    </div>

                    <!-- Desktop Greeting -->
                    <div class="hidden lg:flex items-center gap-2">
                        <span class="text-xs text-slate-400 dark:text-slate-500">Welcome back,</span>
                        <span class="text-sm font-bold text-slate-900 dark:text-white">{{ Auth::user()->name ?? 'User' }}</span>
                    </div>

                    <!-- Top Bar Right Actions -->
                    <div class="flex items-center gap-1.5 sm:gap-3">
                        <x-theme-toggle />

                        <!-- Date Selector Pill -->
                        <div class="flex items-center gap-1">
                            <button
                                class="w-7 h-7 sm:w-8 sm:h-8 rounded-full border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 hover:bg-slate-50 dark:hover:bg-slate-700 flex items-center justify-center text-slate-600 dark:text-slate-300 transition-colors shadow-xs ios-press"
                                title="Previous Month"
                            >
                                <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="15 18 9 12 15 6"></polyline>
                                </svg>
                            </button>

                            <button
                                class="h-7 sm:h-8 px-2.5 sm:px-3 rounded-full border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 hover:border-emerald-500 flex items-center gap-1.5 text-xs font-semibold text-slate-800 dark:text-slate-200 shadow-xs transition-colors ios-press"
                            >
                                <svg class="w-3 h-3 text-emerald-500 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                    <line x1="16" y1="2" x2="16" y2="6"></line>
                                    <line x1="8" y1="2" x2="8" y2="6"></line>
                                    <line x1="3" y1="10" x2="21" y2="10"></line>
                                </svg>
                                <span>{{ now()->format('M Y') }}</span>
                            </button>

                            <button
                                class="w-7 h-7 sm:w-8 sm:h-8 rounded-full border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 hover:bg-slate-50 dark:hover:bg-slate-700 flex items-center justify-center text-slate-600 dark:text-slate-300 transition-colors shadow-xs ios-press"
                                title="Next Month"
                            >
                                <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="9 18 15 12 9 6"></polyline>
                                </svg>
                            </button>
                        </div>

                        <!-- Notification Bell -->
                        <button
                            class="relative w-8 h-8 rounded-full hover:bg-slate-100 dark:hover:bg-slate-800 flex items-center justify-center text-slate-600 dark:text-slate-300 transition-colors ios-press"
                            aria-label="Notifications"
                        >
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                                <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                            </svg>
                            <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-emerald-500 rounded-full ring-2 ring-white dark:ring-slate-900"></span>
                        </button>

                        <!-- Profile Avatar -->
                        <div class="w-7 h-7 sm:w-8 sm:h-8 rounded-full bg-violet-100 dark:bg-violet-950/80 text-violet-600 dark:text-violet-400 font-bold flex items-center justify-center text-xs border border-violet-200 dark:border-violet-900 shadow-xs">
                            {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 1)) }}
                        </div>
                    </div>
                </div>
            </header>

            <!-- SCROLLABLE PAGE CONTAINER WITH IPHONE SAFE AREA INSETS -->
            <main class="flex-1 p-3.5 sm:p-6 lg:p-8 max-w-7xl w-full mx-auto space-y-5 sm:space-y-8 pb-[calc(5.5rem+env(safe-area-inset-bottom,0px))] lg:pb-12">

                <!-- Page Title Header -->
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 pt-1">
                    <div>
                        <h1 class="text-2xl sm:text-3xl font-black text-slate-900 dark:text-white tracking-tight">Dashboard</h1>
                        <p class="text-xs sm:text-sm text-slate-500 dark:text-slate-400 font-medium mt-0.5">Real-time financial overview and ledger analytics</p>
                    </div>

                    <!-- Desktop Action Buttons -->
                    <div class="hidden sm:flex items-center gap-3">
                        <a href="{{ route('transactions.index') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-2xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-700 dark:text-slate-200 font-bold text-sm hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors shadow-xs ios-press">
                            View Transactions
                        </a>
                        <a href="{{ route('transactions.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-2xl bg-emerald-500 hover:bg-emerald-600 text-white font-bold text-sm transition-all shadow-md shadow-emerald-500/25 ios-press">
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                            </svg>
                            <span>Add Transaction</span>
                        </a>
                    </div>
                </div>

                <!-- ======================================================== -->
                <!-- THREE SUMMARY CARDS (Dynamic Database Values)            -->
                <!-- ======================================================== -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3.5 sm:gap-6">
                    
                    <!-- Total Income Card -->
                    <div class="bg-emerald-50/80 dark:bg-emerald-950/30 border border-emerald-100 dark:border-emerald-900/50 rounded-3xl p-4.5 sm:p-6 flex flex-col justify-between shadow-xs hover:shadow-md transition-all">
                        <div class="flex items-center justify-between mb-3 sm:mb-4">
                            <span class="text-xs sm:text-sm font-bold text-emerald-800 dark:text-emerald-300">Total Income</span>
                            <div class="w-10 h-10 rounded-2xl bg-emerald-200/80 dark:bg-emerald-800/40 text-emerald-800 dark:text-emerald-300 flex items-center justify-center shadow-xs">
                                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <line x1="7" y1="17" x2="17" y2="7"></line>
                                    <polyline points="7 7 17 7 17 17"></polyline>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <div class="text-2xl sm:text-3xl font-black text-slate-900 dark:text-white tracking-tight">
                                ৳ {{ number_format((float) ($income ?? 0), 2) }}
                            </div>
                            <span class="text-[11px] font-semibold text-emerald-600 dark:text-emerald-400 mt-1 inline-block">Overall earnings recorded</span>
                        </div>
                    </div>

                    <!-- Total Expense Card -->
                    <div class="bg-rose-50/80 dark:bg-rose-950/30 border border-rose-100 dark:border-rose-900/50 rounded-3xl p-4.5 sm:p-6 flex flex-col justify-between shadow-xs hover:shadow-md transition-all">
                        <div class="flex items-center justify-between mb-3 sm:mb-4">
                            <span class="text-xs sm:text-sm font-bold text-rose-800 dark:text-rose-300">Total Expense</span>
                            <div class="w-10 h-10 rounded-2xl bg-rose-200/80 dark:bg-rose-800/40 text-rose-800 dark:text-rose-300 flex items-center justify-center shadow-xs">
                                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <line x1="12" y1="5" x2="12" y2="19"></line>
                                    <polyline points="19 12 12 19 5 12"></polyline>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <div class="text-2xl sm:text-3xl font-black text-rose-600 dark:text-rose-400 tracking-tight">
                                ৳ {{ number_format((float) ($expense ?? 0), 2) }}
                            </div>
                            <span class="text-[11px] font-semibold text-rose-500 mt-1 inline-block">All-time expenses tracked</span>
                        </div>
                    </div>

                    <!-- Monthly Total Expense Card -->
                    <div class="bg-violet-50/80 dark:bg-violet-950/30 border border-violet-100 dark:border-violet-900/50 rounded-3xl p-4.5 sm:p-6 flex flex-col justify-between shadow-xs hover:shadow-md transition-all sm:col-span-2 lg:col-span-1">
                        <div class="flex items-center justify-between mb-3 sm:mb-4">
                            <span class="text-xs sm:text-sm font-bold text-violet-800 dark:text-violet-300">Monthly Total Expense</span>
                            <div class="w-10 h-10 rounded-2xl bg-violet-200/80 dark:bg-violet-800/40 text-violet-800 dark:text-violet-300 flex items-center justify-center shadow-xs">
                                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                    <line x1="16" y1="2" x2="16" y2="6"></line>
                                    <line x1="8" y1="2" x2="8" y2="6"></line>
                                    <line x1="3" y1="10" x2="21" y2="10"></line>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <div class="text-2xl sm:text-3xl font-black text-slate-900 dark:text-white tracking-tight">
                                ৳ {{ number_format((float) ($monthlyExpense ?? 0), 2) }}
                            </div>
                            <span class="text-[11px] font-semibold text-violet-600 dark:text-violet-400 mt-1 inline-block">Current month spending</span>
                        </div>
                    </div>

                </div>

                <!-- ======================================================== -->
                <!-- CHARTS ROW (Responsive Grid: Trend & Category Analytics) -->
                <!-- ======================================================== -->
                <div id="analytics" class="grid grid-cols-1 lg:grid-cols-5 gap-4 sm:gap-6">

                    <!-- Monthly Expense Trend Card (3 cols on desktop) -->
                    <div class="lg:col-span-3 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl p-4.5 sm:p-6 shadow-xs hover:shadow-md transition-all flex flex-col justify-between">
                        <div class="flex items-center justify-between mb-5 sm:mb-6">
                            <div class="flex items-center gap-2.5">
                                <div class="w-8 h-8 rounded-xl bg-emerald-50 dark:bg-emerald-950/60 text-emerald-600 dark:text-emerald-400 flex items-center justify-center">
                                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                        <line x1="18" y1="20" x2="18" y2="10"></line>
                                        <line x1="12" y1="20" x2="12" y2="4"></line>
                                        <line x1="6" y1="20" x2="6" y2="14"></line>
                                    </svg>
                                </div>
                                <h2 class="text-base sm:text-lg font-bold text-slate-900 dark:text-white">Monthly Expense Trend</h2>
                            </div>
                            <span class="text-[11px] font-bold text-emerald-600 dark:text-emerald-400 bg-emerald-50 dark:bg-emerald-950/60 px-2.5 py-1 rounded-full">Past 6 Months</span>
                        </div>

                        <!-- Bar Chart Container -->
                        <div class="w-full h-48 sm:h-56 pt-2 pb-6 relative flex items-end">
                            <!-- Y-Axis labels (Dynamic Scale) -->
                            <div class="absolute left-0 top-0 bottom-6 w-8 flex flex-col justify-between text-[11px] font-semibold text-slate-400 dark:text-slate-500 text-right pr-2">
                                @foreach ($trendScale as $marker)
                                    <span>{{ $marker }}</span>
                                @endforeach
                            </div>

                            <!-- Horizontal Gridlines -->
                            <div class="absolute left-8 right-0 top-0 bottom-6 flex flex-col justify-between pointer-events-none">
                                <div class="w-full border-b border-slate-100 dark:border-slate-800"></div>
                                <div class="w-full border-b border-slate-100 dark:border-slate-800"></div>
                                <div class="w-full border-b border-slate-100 dark:border-slate-800"></div>
                                <div class="w-full border-b border-slate-100 dark:border-slate-800"></div>
                                <div class="w-full border-b border-slate-200 dark:border-slate-700"></div>
                            </div>

                            <!-- Dynamic Bars Container -->
                            <div class="w-full h-full pl-8 flex items-end justify-around relative z-10">
                                @foreach ($trendData as $trend)
                                    <div class="flex flex-col items-center h-full justify-end group flex-1 max-w-[48px] relative ios-press cursor-pointer">
                                        <!-- Tooltip Hover Bubble -->
                                        <div class="opacity-0 group-hover:opacity-100 transition-opacity absolute -top-8 bg-slate-900 dark:bg-slate-800 text-white text-[10px] font-bold py-1 px-2 rounded-lg shadow-md pointer-events-none whitespace-nowrap z-20">
                                            ৳ {{ number_format($trend['amount'], 2) }}
                                        </div>

                                        <!-- Bar Fill -->
                                        <div
                                            class="w-full max-w-[24px] sm:max-w-[28px] {{ $trend['is_current'] ? 'bg-gradient-to-t from-emerald-600 to-teal-400 shadow-md shadow-emerald-500/30' : 'bg-emerald-200 dark:bg-emerald-900/60 group-hover:bg-emerald-300 dark:group-hover:bg-emerald-700/60' }} rounded-t-lg transition-all"
                                            style="height: {{ $trend['height_pct'] }}%; min-height: {{ $trend['amount'] > 0 ? '4px' : '0' }};"
                                        ></div>

                                        <!-- Month Label -->
                                        <span class="absolute -bottom-6 text-[11px] sm:text-xs {{ $trend['is_current'] ? 'font-bold text-slate-900 dark:text-white' : 'font-semibold text-slate-400 dark:text-slate-500' }}">
                                            {{ $trend['label'] }}
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Expense by Category Card (2 cols on desktop) -->
                    <div class="lg:col-span-2 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl p-4.5 sm:p-6 shadow-xs hover:shadow-md transition-all flex flex-col justify-between">
                        <div class="flex items-center gap-2.5 mb-5">
                            <div class="w-8 h-8 rounded-xl bg-emerald-50 dark:bg-emerald-950/60 text-emerald-600 dark:text-emerald-400 flex items-center justify-center">
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21.21 15.89A10 10 0 1 1 8 2.83"></path>
                                    <path d="M22 12A10 10 0 0 0 12 2v10z"></path>
                                </svg>
                            </div>
                            <h2 class="text-base sm:text-lg font-bold text-slate-900 dark:text-white">Expense by Category</h2>
                        </div>

                        <!-- Donut + Legend Layout -->
                        <div class="flex flex-col sm:flex-row items-center gap-5 sm:gap-6">
                            
                            @if (empty($categoryData) || $categoryTotal <= 0)
                                <!-- Empty Category Donut State -->
                                <div class="relative w-32 h-32 sm:w-36 sm:h-36 shrink-0 flex items-center justify-center">
                                    <svg class="w-full h-full -rotate-90" viewBox="0 0 42 42">
                                        <circle cx="21" cy="21" r="15.91549430918954" fill="transparent" stroke="currentColor" class="text-slate-100 dark:text-slate-800" stroke-width="5"></circle>
                                    </svg>
                                    <div class="absolute inset-0 flex flex-col items-center justify-center pointer-events-none">
                                        <span class="text-sm font-extrabold text-slate-400">৳ 0.00</span>
                                        <span class="text-[10px] uppercase font-semibold text-slate-400">Total</span>
                                    </div>
                                </div>

                                <div class="flex-1 w-full text-center py-4 text-xs text-slate-400 dark:text-slate-500 font-medium">
                                    No expense categories recorded yet.
                                </div>
                            @else
                                <!-- Dynamic SVG Donut Chart with real slices -->
                                <div class="relative w-32 h-32 sm:w-36 sm:h-36 shrink-0 flex items-center justify-center">
                                    <svg class="w-full h-full -rotate-90" viewBox="0 0 42 42">
                                        <circle cx="21" cy="21" r="15.91549430918954" fill="transparent" stroke="currentColor" class="text-slate-100 dark:text-slate-800" stroke-width="5"></circle>
                                        @foreach ($categoryData as $cat)
                                            <circle
                                                cx="21"
                                                cy="21"
                                                r="15.91549430918954"
                                                fill="transparent"
                                                stroke="{{ $cat['color'] }}"
                                                stroke-width="5"
                                                stroke-dasharray="{{ $cat['dash_array'] }}"
                                                stroke-dashoffset="{{ $cat['dash_offset'] }}"
                                            ></circle>
                                        @endforeach
                                    </svg>
                                    <div class="absolute inset-0 flex flex-col items-center justify-center pointer-events-none text-center px-1">
                                        <span class="text-xs sm:text-sm font-black text-slate-900 dark:text-white tracking-tight truncate max-w-[80px]">৳ {{ number_format($categoryTotal, 0) }}</span>
                                        <span class="text-[9px] uppercase font-bold text-slate-400">Total</span>
                                    </div>
                                </div>

                                <!-- Dynamic Category Breakdown List -->
                                <div class="flex-1 w-full space-y-2.5 max-h-48 overflow-y-auto pr-1">
                                    @foreach ($categoryData as $cat)
                                        <div class="flex items-center justify-between text-xs py-0.5">
                                            <div class="flex items-center gap-2 min-w-0">
                                                <span class="w-2.5 h-2.5 rounded-full shrink-0 shadow-xs" style="background-color: {{ $cat['color'] }};"></span>
                                                <span class="font-medium text-slate-700 dark:text-slate-300 truncate max-w-[110px]">{{ $cat['name'] }}</span>
                                            </div>
                                            <span class="font-bold text-slate-900 dark:text-white shrink-0">৳ {{ number_format($cat['amount'], 2) }} <span class="font-normal text-slate-400 text-[11px]">({{ $cat['percent'] }}%)</span></span>
                                        </div>
                                    @endforeach
                                </div>
                            @endif

                        </div>
                    </div>

                </div>

                <!-- ======================================================== -->
                <!-- RECENT TRANSACTIONS SECTION (Dynamic Database Records)   -->
                <!-- ======================================================== -->
                <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl p-4.5 sm:p-6 shadow-xs hover:shadow-md transition-all">
                    <div class="flex items-center justify-between mb-4 sm:mb-5">
                        <div class="flex items-center gap-2.5">
                            <div class="w-8 h-8 rounded-xl bg-emerald-50 dark:bg-emerald-950/60 text-emerald-600 dark:text-emerald-400 flex items-center justify-center">
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <line x1="8" y1="6" x2="21" y2="6"></line>
                                    <line x1="8" y1="12" x2="21" y2="12"></line>
                                    <line x1="8" y1="18" x2="21" y2="18"></line>
                                    <line x1="3" y1="6" x2="3.01" y2="6"></line>
                                    <line x1="3" y1="12" x2="3.01" y2="12"></line>
                                    <line x1="3" y1="18" x2="3.01" y2="18"></line>
                                </svg>
                            </div>
                            <h2 class="text-base sm:text-lg font-bold text-slate-900 dark:text-white">Recent Transactions</h2>
                        </div>
                        <a href="{{ route('transactions.index') }}" class="text-xs sm:text-sm font-bold text-emerald-600 dark:text-emerald-400 hover:text-emerald-700 inline-flex items-center gap-1 transition-colors ios-press">
                            View All
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                <polyline points="12 5 19 12 12 19"></polyline>
                            </svg>
                        </a>
                    </div>

                    <!-- Dynamic Recent Transactions List -->
                    @if ($recentTransactions->isEmpty())
                        <div class="py-8 text-center">
                            <p class="text-xs sm:text-sm text-slate-400 dark:text-slate-500 font-medium">No recent transactions recorded yet.</p>
                            <a href="{{ route('transactions.create') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-emerald-600 dark:text-emerald-400 hover:text-emerald-700 mt-2 transition-colors ios-press">
                                + Add Your First Transaction
                            </a>
                        </div>
                    @else
                        <div class="divide-y divide-slate-100 dark:divide-slate-800/80">
                            @foreach ($recentTransactions as $tx)
                                @php
                                    $isIncome = $tx->category?->type === 'income';
                                @endphp
                                <div class="py-3.5 sm:py-4 flex items-center justify-between gap-3 sm:gap-4 hover:bg-slate-50/80 dark:hover:bg-slate-800/50 rounded-2xl px-2 sm:px-3 -mx-2 sm:-mx-3 transition-colors ios-press">
                                    <div class="flex items-center gap-3 sm:gap-4 min-w-0">
                                        <div class="w-10 h-10 sm:w-11 sm:h-11 rounded-2xl {{ $isIncome ? 'bg-emerald-50 dark:bg-emerald-950/60 text-emerald-600 dark:text-emerald-400' : 'bg-rose-50 dark:bg-rose-950/60 text-rose-600 dark:text-rose-400' }} flex items-center justify-center shrink-0">
                                            @if ($isIncome)
                                                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3">
                                                    <line x1="7" y1="17" x2="17" y2="7"></line>
                                                    <polyline points="7 7 17 7 17 17"></polyline>
                                                </svg>
                                            @else
                                                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3">
                                                    <line x1="12" y1="5" x2="12" y2="19"></line>
                                                    <polyline points="19 12 12 19 5 12"></polyline>
                                                </svg>
                                            @endif
                                        </div>
                                        <div class="min-w-0">
                                            <p class="text-xs sm:text-sm font-bold text-slate-900 dark:text-white truncate">{{ $tx->title }}</p>
                                            <div class="flex items-center gap-1.5 sm:gap-2 text-[11px] sm:text-xs text-slate-400 dark:text-slate-500 mt-0.5">
                                                <span>{{ $tx->transaction_date ? $tx->transaction_date->format('M d, Y') : '' }}</span>
                                                <span>•</span>
                                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] sm:text-[11px] font-semibold {{ $isIncome ? 'bg-emerald-50 dark:bg-emerald-950/80 text-emerald-700 dark:text-emerald-300' : 'bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300' }}">
                                                    {{ $tx->category?->name ?? 'Uncategorized' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-right shrink-0">
                                        <p class="text-xs sm:text-base font-black {{ $isIncome ? 'text-emerald-600 dark:text-emerald-400' : 'text-rose-600 dark:text-rose-400' }}">
                                            {{ $isIncome ? '+' : '-' }} ৳ {{ number_format((float) $tx->amount, 2) }}
                                        </p>
                                        <p class="text-[10px] sm:text-[11px] font-medium text-slate-400 dark:text-slate-500">{{ ucfirst($tx->payment_method) }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

            </main>

        </div>

    </div>

    <!-- iOS Translucent Bottom Tab Bar with Raised FAB -->
    <x-bottom-nav active="dashboard" />

</body>
</html>
