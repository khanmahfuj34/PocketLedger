<!DOCTYPE html>
<html lang="en">
<head>
    <title>PocketLedger - Transactions</title>
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

                <!-- Transactions (Active) -->
                <a href="{{ route('transactions.index') }}" class="flex items-center gap-3.5 px-3.5 py-3 rounded-2xl text-sm font-semibold bg-emerald-50 dark:bg-emerald-950/60 text-emerald-700 dark:text-emerald-400 transition-colors">
                    <svg class="w-5 h-5 text-emerald-600 dark:text-emerald-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
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
        <!-- MAIN TRANSACTIONS CONTENT AREA                           -->
        <!-- ======================================================== -->
        <div class="flex-1 min-w-0 flex flex-col">

            <!-- TOP NAVBAR WITH SAFE AREA SPACING -->
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

                    <!-- Breadcrumb (Desktop) -->
                    <div class="hidden lg:flex items-center gap-2 text-sm text-slate-500 dark:text-slate-400">
                        <a href="{{ route('dashboard') }}" class="hover:text-emerald-600 transition-colors">Home</a>
                        <svg class="w-4 h-4 text-slate-300 dark:text-slate-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                        <span class="font-bold text-slate-900 dark:text-white">Transactions</span>
                    </div>

                    <!-- Right Quick Actions -->
                    <div class="flex items-center gap-2 sm:gap-3">
                        <div class="hidden lg:block">
                            <x-theme-toggle />
                        </div>

                        <a href="{{ route('transactions.create') }}" class="hidden sm:inline-flex items-center gap-2 px-3.5 py-2 rounded-2xl bg-emerald-500 hover:bg-emerald-600 text-white font-bold text-xs sm:text-sm shadow-sm shadow-emerald-500/20 transition-all ios-press">
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                            </svg>
                            <span>Add Transaction</span>
                        </a>

                        <!-- Profile Dropdown -->
                        <x-profile-dropdown />
                    </div>
                </div>
            </header>

            <!-- SCROLLABLE CONTENT BODY -->
            <main class="flex-1 p-3.5 sm:p-6 lg:p-8 max-w-7xl w-full mx-auto space-y-5 sm:space-y-6 pb-[calc(5.5rem+env(safe-area-inset-bottom,0px))] lg:pb-12">

                <!-- Page Title -->
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 pt-1">
                    <div>
                        <h1 class="text-2xl sm:text-3xl font-black text-slate-900 dark:text-white tracking-tight">Transactions</h1>
                        <p class="text-xs sm:text-sm text-slate-500 dark:text-slate-400 font-medium mt-0.5">Filter, search, and manage your financial records</p>
                    </div>
                    
                    <a href="{{ route('transactions.create') }}" class="sm:hidden w-full flex items-center justify-center gap-2 py-3 px-4 rounded-2xl bg-emerald-500 hover:bg-emerald-600 text-white font-bold text-sm shadow-md shadow-emerald-500/25 transition-all ios-press">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                        <span>Add New Transaction</span>
                    </a>
                </div>

                <!-- ======================================================== -->
                <!-- SUMMARY CARDS ROW                                        -->
                <!-- ======================================================== -->
                @php
                    $incomeSum = $transactions->filter(fn($t) => $t->category?->type === 'income')->sum('amount');
                    $expenseSum = $transactions->filter(fn($t) => $t->category?->type === 'expense' || !$t->category)->sum('amount');
                    $totalCount = $transactions->total();
                @endphp

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3.5 sm:gap-6">
                    <!-- Page Income -->
                    <div class="bg-emerald-50/80 dark:bg-emerald-950/30 border border-emerald-100 dark:border-emerald-900/50 rounded-3xl p-4 sm:p-5 flex items-center justify-between shadow-xs">
                        <div>
                            <span class="text-xs font-bold text-emerald-800 dark:text-emerald-300">Total Income (Page)</span>
                            <div class="text-xl sm:text-2xl font-black text-slate-900 dark:text-white mt-1">
                                ৳ {{ number_format((float) $incomeSum, 2) }}
                            </div>
                        </div>
                        <div class="w-10 h-10 rounded-2xl bg-emerald-200/80 dark:bg-emerald-800/40 text-emerald-800 dark:text-emerald-300 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="7" y1="17" x2="17" y2="7"></line>
                                <polyline points="7 7 17 7 17 17"></polyline>
                            </svg>
                        </div>
                    </div>

                    <!-- Page Expense -->
                    <div class="bg-rose-50/80 dark:bg-rose-950/30 border border-rose-100 dark:border-rose-900/50 rounded-3xl p-4 sm:p-5 flex items-center justify-between shadow-xs">
                        <div>
                            <span class="text-xs font-bold text-rose-800 dark:text-rose-300">Total Expense (Page)</span>
                            <div class="text-xl sm:text-2xl font-black text-rose-600 dark:text-rose-400 mt-1">
                                ৳ {{ number_format((float) $expenseSum, 2) }}
                            </div>
                        </div>
                        <div class="w-10 h-10 rounded-2xl bg-rose-200/80 dark:bg-rose-800/40 text-rose-800 dark:text-rose-300 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                <polyline points="19 12 12 19 5 12"></polyline>
                            </svg>
                        </div>
                    </div>

                    <!-- Total Records Count -->
                    <div class="bg-violet-50/80 dark:bg-violet-950/30 border border-violet-100 dark:border-violet-900/50 rounded-3xl p-4 sm:p-5 flex items-center justify-between shadow-xs">
                        <div>
                            <span class="text-xs font-bold text-violet-800 dark:text-violet-300">Total Transactions</span>
                            <div class="text-xl sm:text-2xl font-black text-slate-900 dark:text-white mt-1">
                                {{ $totalCount }} {{ Str::plural('record', $totalCount) }}
                            </div>
                        </div>
                        <div class="w-10 h-10 rounded-2xl bg-violet-200/80 dark:bg-violet-800/40 text-violet-800 dark:text-violet-300 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="8" y1="6" x2="21" y2="6"></line>
                                <line x1="8" y1="12" x2="21" y2="12"></line>
                                <line x1="8" y1="18" x2="21" y2="18"></line>
                                <line x1="3" y1="6" x2="3.01" y2="6"></line>
                                <line x1="3" y1="12" x2="3.01" y2="12"></line>
                                <line x1="3" y1="18" x2="3.01" y2="18"></line>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- ======================================================== -->
                <!-- SEARCH & FILTER TOOLBAR                                  -->
                <!-- ======================================================== -->
                <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl p-4 sm:p-5 shadow-xs space-y-4">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4">
                        
                        <!-- Search Input -->
                        <div class="relative sm:col-span-2">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="11" cy="11" r="8"></circle>
                                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                </svg>
                            </div>
                            <input
                                type="text"
                                id="transactionSearch"
                                oninput="filterClientTransactions()"
                                placeholder="Search by title, note, or amount..."
                                class="w-full pl-10 pr-4 py-2.5 rounded-2xl border border-slate-200 dark:border-slate-700 text-sm focus:outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 bg-slate-50/50 dark:bg-slate-800 text-slate-900 dark:text-white hover:bg-white dark:hover:bg-slate-800/80 transition-colors"
                            >
                        </div>

                        <!-- Date Filter -->
                        <div>
                            <input
                                type="date"
                                id="dateFilter"
                                onchange="filterClientTransactions()"
                                class="w-full px-3.5 py-2.5 rounded-2xl border border-slate-200 dark:border-slate-700 text-sm focus:outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 bg-slate-50/50 dark:bg-slate-800 hover:bg-white text-slate-700 dark:text-slate-200 transition-colors"
                            >
                        </div>

                        <!-- Payment Method Filter -->
                        <div>
                            <select
                                id="paymentFilter"
                                onchange="filterClientTransactions()"
                                class="w-full px-3.5 py-2.5 rounded-2xl border border-slate-200 dark:border-slate-700 text-sm focus:outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 bg-slate-50/50 dark:bg-slate-800 hover:bg-white text-slate-700 dark:text-slate-200 transition-colors appearance-none cursor-pointer"
                            >
                                <option value="">All Payment Methods</option>
                                <option value="cash">💵 Cash</option>
                                <option value="bkash">📱 bKash</option>
                                <option value="nagad">📱 Nagad</option>
                                <option value="bank">🏦 Bank</option>
                                <option value="card">💳 Card</option>
                            </select>
                        </div>

                    </div>

                    <!-- Type Filter Tabs (iOS Segmented Style) -->
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between border-t border-slate-100 dark:border-slate-800/80 pt-3 gap-2">
                        <div class="inline-flex p-1 bg-slate-100 dark:bg-slate-800 rounded-2xl text-xs font-bold" id="typeSegmented">
                            <button
                                type="button"
                                onclick="setTypeFilter('all')"
                                id="btnFilterAll"
                                class="px-3.5 py-1.5 rounded-xl bg-white dark:bg-slate-700 text-emerald-700 dark:text-emerald-400 shadow-xs transition-all ios-press"
                            >
                                All
                            </button>
                            <button
                                type="button"
                                onclick="setTypeFilter('expense')"
                                id="btnFilterExpense"
                                class="px-3.5 py-1.5 rounded-xl text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white transition-all ios-press"
                            >
                                Expenses
                            </button>
                            <button
                                type="button"
                                onclick="setTypeFilter('income')"
                                id="btnFilterIncome"
                                class="px-3.5 py-1.5 rounded-xl text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white transition-all ios-press"
                            >
                                Income
                            </button>
                        </div>

                        <span id="recordCountLabel" class="text-xs text-slate-400 dark:text-slate-500 font-semibold">
                            Showing {{ $transactions->count() }} of {{ $transactions->total() }} records
                        </span>
                    </div>
                </div>

                <!-- ======================================================== -->
                <!-- TRANSACTION LIST (Responsive: Mobile Cards + Desktop Table) -->
                <!-- ======================================================== -->
                <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl shadow-xs overflow-hidden">
                    
                    @if ($transactions->isEmpty())
                        <!-- Empty State -->
                        <div class="py-16 px-4 text-center">
                            <div class="w-16 h-16 rounded-3xl bg-emerald-50 dark:bg-emerald-950/60 text-emerald-600 dark:text-emerald-400 flex items-center justify-center mx-auto mb-4 shadow-xs">
                                <svg class="w-8 h-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="2" y="5" width="20" height="15" rx="3"/>
                                    <line x1="2" y1="9" x2="22" y2="9"/>
                                    <line x1="12" y1="13" x2="12" y2="17"/>
                                    <line x1="10" y1="15" x2="14" y2="15"/>
                                </svg>
                            </div>
                            <h3 class="text-lg font-bold text-slate-900 dark:text-white">No transactions recorded yet</h3>
                            <p class="text-sm text-slate-500 dark:text-slate-400 max-w-sm mx-auto mt-1 mb-6">
                                Start organizing your finances by adding your first transaction.
                            </p>
                            <a href="{{ route('transactions.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-2xl bg-emerald-500 hover:bg-emerald-600 text-white font-bold text-sm shadow-md shadow-emerald-500/20 transition-all ios-press">
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <line x1="12" y1="5" x2="12" y2="19"></line>
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                </svg>
                                <span>Add First Transaction</span>
                            </a>
                        </div>
                    @else

                        <!-- DESKTOP DATA TABLE (Visible on lg: screens) -->
                        <div class="hidden lg:block overflow-x-auto">
                            <table class="w-full text-left text-sm" id="desktopTxTable">
                                <thead class="bg-slate-50 dark:bg-slate-800/60 border-b border-slate-200 dark:border-slate-800 text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">
                                    <tr>
                                        <th class="py-4 px-6">Date</th>
                                        <th class="py-4 px-6">Title</th>
                                        <th class="py-4 px-6">Category</th>
                                        <th class="py-4 px-6">Payment Method</th>
                                        <th class="py-4 px-6">Amount</th>
                                        <th class="py-4 px-6">Note</th>
                                        <th class="py-4 px-6 text-right">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100 dark:divide-slate-800/80">
                                    @foreach ($transactions as $transaction)
                                        @php
                                            $isIncome = $transaction->category?->type === 'income';
                                        @endphp
                                        <tr
                                            class="hover:bg-slate-50/80 dark:hover:bg-slate-800/50 transition-colors group tx-row"
                                            data-type="{{ $transaction->category?->type ?? 'expense' }}"
                                            data-payment="{{ strtolower($transaction->payment_method) }}"
                                            data-date="{{ $transaction->transaction_date ? $transaction->transaction_date->format('Y-m-d') : '' }}"
                                            data-title="{{ strtolower($transaction->title . ' ' . $transaction->note) }}"
                                        >
                                            <!-- Date -->
                                            <td class="py-4 px-6 text-slate-500 dark:text-slate-400 whitespace-nowrap font-medium text-xs">
                                                {{ $transaction->transaction_date ? $transaction->transaction_date->format('M d, Y') : '-' }}
                                            </td>

                                            <!-- Title -->
                                            <td class="py-4 px-6">
                                                <div class="flex items-center gap-3">
                                                    <div class="w-9 h-9 rounded-2xl {{ $isIncome ? 'bg-emerald-50 dark:bg-emerald-950/60 text-emerald-600 dark:text-emerald-400' : 'bg-rose-50 dark:bg-rose-950/60 text-rose-600 dark:text-rose-400' }} flex items-center justify-center shrink-0">
                                                        @if ($isIncome)
                                                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3">
                                                                <line x1="7" y1="17" x2="17" y2="7"></line>
                                                                <polyline points="7 7 17 7 17 17"></polyline>
                                                            </svg>
                                                        @else
                                                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3">
                                                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                                                <polyline points="19 12 12 19 5 12"></polyline>
                                                            </svg>
                                                        @endif
                                                    </div>
                                                    <span class="font-bold text-slate-900 dark:text-white">{{ $transaction->title }}</span>
                                                </div>
                                            </td>

                                            <!-- Category -->
                                            <td class="py-4 px-6 whitespace-nowrap">
                                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold {{ $isIncome ? 'bg-emerald-50 dark:bg-emerald-950/80 text-emerald-700 dark:text-emerald-300 border border-emerald-200 dark:border-emerald-800' : 'bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300' }}">
                                                    {{ $transaction->category?->name ?? 'Uncategorized' }}
                                                </span>
                                            </td>

                                            <!-- Payment Method -->
                                            <td class="py-4 px-6 whitespace-nowrap">
                                                <span class="text-xs font-semibold text-slate-600 dark:text-slate-300 bg-slate-100 dark:bg-slate-800 px-2.5 py-1 rounded-xl">
                                                    {{ ucfirst($transaction->payment_method) }}
                                                </span>
                                            </td>

                                            <!-- Amount -->
                                            <td class="py-4 px-6 whitespace-nowrap">
                                                <span class="text-sm font-black {{ $isIncome ? 'text-emerald-600 dark:text-emerald-400' : 'text-rose-600 dark:text-rose-400' }}">
                                                    {{ $isIncome ? '+' : '-' }} ৳ {{ number_format((float) $transaction->amount, 2) }}
                                                </span>
                                            </td>

                                            <!-- Note -->
                                            <td class="py-4 px-6 text-slate-500 dark:text-slate-400 text-xs max-w-xs truncate">
                                                {{ $transaction->note ?? '—' }}
                                            </td>

                                            <!-- Actions -->
                                            <td class="py-4 px-6 text-right whitespace-nowrap">
                                                <div class="inline-flex items-center gap-2">
                                                    <a href="{{ route('transactions.edit', $transaction->id) }}" class="p-1.5 text-slate-400 hover:text-emerald-600 dark:hover:text-emerald-400 hover:bg-emerald-50 dark:hover:bg-emerald-950/40 rounded-xl transition-colors ios-press" title="Edit">
                                                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                                        </svg>
                                                    </a>

                                                    <form action="{{ route('transactions.destroy', $transaction->id) }}" method="POST" class="inline" onsubmit="return confirm('Delete this transaction?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="p-1.5 text-slate-400 hover:text-rose-600 hover:bg-rose-50 dark:hover:bg-rose-950/40 rounded-xl transition-colors ios-press" title="Delete">
                                                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
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

                        <!-- MOBILE CARDS LIST (Optimized for iPhone Screens) -->
                        <div class="lg:hidden divide-y divide-slate-100 dark:divide-slate-800/80" id="mobileTxList">
                            @foreach ($transactions as $transaction)
                                @php
                                    $isIncome = $transaction->category?->type === 'income';
                                @endphp
                                <div
                                    class="p-3.5 sm:p-4 flex items-center justify-between gap-3 hover:bg-slate-50/80 dark:hover:bg-slate-800/50 transition-colors tx-card ios-press"
                                    data-type="{{ $transaction->category?->type ?? 'expense' }}"
                                    data-payment="{{ strtolower($transaction->payment_method) }}"
                                    data-date="{{ $transaction->transaction_date ? $transaction->transaction_date->format('Y-m-d') : '' }}"
                                    data-title="{{ strtolower($transaction->title . ' ' . $transaction->note) }}"
                                >
                                    <div class="flex items-center gap-3 min-w-0">
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
                                            <p class="text-xs sm:text-sm font-bold text-slate-900 dark:text-white truncate">{{ $transaction->title }}</p>
                                            <div class="flex items-center gap-1.5 text-[10px] sm:text-[11px] text-slate-400 dark:text-slate-500 mt-0.5">
                                                <span>{{ $transaction->transaction_date ? $transaction->transaction_date->format('M d') : '' }}</span>
                                                <span>•</span>
                                                <span class="font-semibold text-slate-600 dark:text-slate-300 truncate">{{ $transaction->category?->name ?? 'Uncategorized' }}</span>
                                                <span>•</span>
                                                <span>{{ ucfirst($transaction->payment_method) }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-right shrink-0 flex flex-col items-end gap-1">
                                        <span class="text-xs sm:text-sm font-black {{ $isIncome ? 'text-emerald-600 dark:text-emerald-400' : 'text-rose-600 dark:text-rose-400' }}">
                                            {{ $isIncome ? '+' : '-' }} ৳ {{ number_format((float) $transaction->amount, 2) }}
                                        </span>
                                        
                                        <!-- Mobile Actions -->
                                        <div class="flex items-center gap-1">
                                            <a href="{{ route('transactions.edit', $transaction->id) }}" class="p-1.5 text-slate-400 hover:text-emerald-600 dark:hover:text-emerald-400 rounded-lg" title="Edit">
                                                <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                                </svg>
                                            </a>

                                            <form action="{{ route('transactions.destroy', $transaction->id) }}" method="POST" class="inline" onsubmit="return confirm('Delete this transaction?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="p-1.5 text-slate-400 hover:text-rose-600 dark:hover:text-rose-400 rounded-lg" title="Delete">
                                                    <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                        <polyline points="3 6 5 6 21 6"></polyline>
                                                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    @endif

                </div>

                <!-- Pagination Container -->
                <div class="mt-6 flex justify-center">
                    {{ $transactions->links() }}
                </div>

            </main>

        </div>

    </div>

    <!-- iOS Translucent Bottom Tab Bar with Raised FAB -->
    <x-bottom-nav active="transactions" />

    <script>
        var currentTypeFilter = 'all';

        window.setTypeFilter = function(type) {
            currentTypeFilter = type;
            const btnAll = document.getElementById('btnFilterAll');
            const btnExp = document.getElementById('btnFilterExpense');
            const btnInc = document.getElementById('btnFilterIncome');

            const inactiveCls = "px-3.5 py-1.5 rounded-xl text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white transition-all ios-press";
            const activeCls = "px-3.5 py-1.5 rounded-xl bg-white dark:bg-slate-700 text-emerald-700 dark:text-emerald-400 shadow-xs transition-all ios-press";

            if (btnAll) btnAll.className = type === 'all' ? activeCls : inactiveCls;
            if (btnExp) btnExp.className = type === 'expense' ? activeCls : inactiveCls;
            if (btnInc) btnInc.className = type === 'income' ? activeCls : inactiveCls;

            filterClientTransactions();
        };

        window.filterClientTransactions = function() {
            const query = (document.getElementById('transactionSearch')?.value || '').toLowerCase().trim();
            const date = document.getElementById('dateFilter')?.value || '';
            const payment = (document.getElementById('paymentFilter')?.value || '').toLowerCase();

            const rows = document.querySelectorAll('.tx-row, .tx-card');
            let visibleCount = 0;

            rows.forEach(item => {
                const itemType = item.getAttribute('data-type') || '';
                const itemPayment = item.getAttribute('data-payment') || '';
                const itemDate = item.getAttribute('data-date') || '';
                const itemTitle = item.getAttribute('data-title') || '';

                const matchesType = (currentTypeFilter === 'all') || (itemType === currentTypeFilter);
                const matchesPayment = !payment || (itemPayment === payment);
                const matchesDate = !date || (itemDate === date);
                const matchesQuery = !query || itemTitle.includes(query);

                if (matchesType && matchesPayment && matchesDate && matchesQuery) {
                    item.style.display = '';
                    visibleCount++;
                } else {
                    item.style.display = 'none';
                }
            });

            const countEl = document.getElementById('recordCountLabel');
            if (countEl) {
                countEl.textContent = `Showing ${visibleCount} visible records`;
            }
        };
    </script>

</body>
</html>
