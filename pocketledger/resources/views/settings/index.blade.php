<!DOCTYPE html>
<html lang="en">
<head>
    <title>PocketLedger - Settings</title>
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

                <!-- Profile -->
                <a href="{{ route('profile.edit') }}" class="flex items-center gap-3.5 px-3.5 py-3 rounded-2xl text-sm font-medium text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors">
                    <svg class="w-5 h-5 text-slate-400 dark:text-slate-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                    <span>My Profile</span>
                </a>

                <!-- Settings (Active) -->
                <a href="{{ route('settings.index') }}" class="flex items-center gap-3.5 px-3.5 py-3 rounded-2xl text-sm font-semibold bg-emerald-50 dark:bg-emerald-950/60 text-emerald-700 dark:text-emerald-400 transition-colors">
                    <svg class="w-5 h-5 text-emerald-600 dark:text-emerald-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="3"></circle>
                        <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path>
                    </svg>
                    <span>Settings</span>
                </a>

                <!-- Profile / Theme Mode in sidebar -->
                <div class="px-3.5 py-2.5 rounded-2xl flex items-center justify-between text-sm text-slate-600 dark:text-slate-400">
                    <span class="font-medium">Theme Mode</span>
                    <x-theme-toggle />
                </div>
            </div>

            <!-- Logout Bottom Button in Sidebar -->
            <div class="p-4 border-t border-slate-100 dark:border-slate-800">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center gap-2 py-2.5 px-4 rounded-xl text-slate-600 dark:text-slate-400 hover:text-rose-600 dark:hover:text-rose-400 hover:bg-rose-50 dark:hover:bg-rose-950/30 text-xs font-bold transition-colors cursor-pointer">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                            <polyline points="16 17 21 12 16 7"></polyline>
                            <line x1="21" y1="12" x2="9" y2="12"></line>
                        </svg>
                        <span>Log Out</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- ======================================================== -->
        <!-- MAIN CONTENT AREA                                        -->
        <!-- ======================================================== -->
        <div class="flex-1 min-w-0 flex flex-col">

            <!-- TOP NAVBAR -->
            <header class="bg-white/80 dark:bg-slate-900/80 backdrop-blur-xl border-b border-slate-200/80 dark:border-slate-800/80 sticky top-0 z-30 pt-[env(safe-area-inset-top,0px)] transition-colors">
                <div class="max-w-5xl mx-auto px-3.5 sm:px-6 lg:px-8 h-14 sm:h-16 flex items-center justify-between gap-3">
                    
                    <!-- Mobile Brand -->
                    <div class="flex items-center gap-2.5 lg:hidden">
                        <a href="{{ route('dashboard') }}" class="flex items-center gap-2 ios-press">
                            <div class="w-8 h-8 rounded-xl bg-gradient-to-tr from-emerald-600 to-teal-500 flex items-center justify-center text-white shadow-sm shadow-emerald-500/30">
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3">
                                    <rect x="2" y="5" width="20" height="15" rx="3"/>
                                    <path d="M2 9h20"/>
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
                        <span class="font-bold text-slate-900 dark:text-white">Settings</span>
                    </div>

                    <!-- Top Bar Right: Desktop Theme Toggle + Profile Dropdown -->
                    <div class="flex items-center gap-2 sm:gap-3">
                        <div class="hidden lg:block">
                            <x-theme-toggle />
                        </div>
                        <x-profile-dropdown />
                    </div>
                </div>
            </header>

            <!-- SCROLLABLE CONTENT BODY -->
            <main class="flex-1 p-3.5 sm:p-6 lg:p-8 max-w-5xl w-full mx-auto space-y-6 pb-[calc(5.5rem+env(safe-area-inset-bottom,0px))] lg:pb-12">

                <!-- Page Header -->
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 pt-1">
                    <div>
                        <h1 class="text-2xl sm:text-3xl font-black text-slate-900 dark:text-white tracking-tight">Settings</h1>
                        <p class="text-xs sm:text-sm text-slate-500 dark:text-slate-400 font-medium mt-0.5">
                            Manage application preferences, system defaults, and financial data
                        </p>
                    </div>

                    <a href="{{ route('profile.edit') }}" class="inline-flex items-center gap-2 px-3.5 py-2 rounded-2xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 text-slate-700 dark:text-slate-300 text-xs font-bold hover:border-emerald-500/60 transition-colors shadow-xs ios-press w-fit">
                        <svg class="w-3.5 h-3.5 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                        <span>Edit Profile</span>
                    </a>
                </div>

                <!-- Feedback Notifications -->
                @if (session('success'))
                    <div class="p-4 rounded-2xl bg-emerald-50 dark:bg-emerald-950/60 border border-emerald-200 dark:border-emerald-800/80 text-emerald-800 dark:text-emerald-300 flex items-center gap-3 text-xs sm:text-sm font-semibold animate-in fade-in">
                        <svg class="w-5 h-5 text-emerald-600 dark:text-emerald-400 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <polyline points="20 6 9 17 4 12"></polyline>
                        </svg>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="p-4 rounded-2xl bg-rose-50 dark:bg-rose-950/60 border border-rose-200 dark:border-rose-800/80 text-rose-800 dark:text-rose-300 space-y-1 text-xs sm:text-sm font-semibold animate-in fade-in">
                        @foreach ($errors->all() as $error)
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-rose-600 dark:text-rose-400 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <line x1="12" y1="8" x2="12" y2="12"></line>
                                    <line x1="12" y1="16" x2="12.01" y2="16"></line>
                                </svg>
                                <span>{{ $error }}</span>
                            </div>
                        @endforeach
                    </div>
                @endif

                <!-- Application Preferences Overview Card -->
                <div class="p-5 sm:p-6 rounded-3xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-xs space-y-4">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-xl bg-emerald-50 dark:bg-emerald-950/60 text-emerald-600 dark:text-emerald-400 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3">
                                <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                <line x1="9" y1="3" x2="9" y2="21"></line>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-base font-bold text-slate-900 dark:text-white">Application Defaults</h3>
                            <p class="text-[11px] text-slate-400 dark:text-slate-500 font-medium">Configured locale, currency, and timezone details</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 pt-2">
                        <!-- Currency -->
                        <div class="p-3.5 rounded-2xl bg-slate-50 dark:bg-slate-800/60 border border-slate-100 dark:border-slate-700/60">
                            <p class="text-[10px] uppercase font-bold text-slate-400 dark:text-slate-500 tracking-wider">Default Currency</p>
                            <p class="text-sm font-black text-slate-900 dark:text-white mt-1">Bangladeshi Taka (৳ BDT)</p>
                        </div>

                        <!-- Timezone -->
                        <div class="p-3.5 rounded-2xl bg-slate-50 dark:bg-slate-800/60 border border-slate-100 dark:border-slate-700/60">
                            <p class="text-[10px] uppercase font-bold text-slate-400 dark:text-slate-500 tracking-wider">App Timezone</p>
                            <p class="text-sm font-black text-slate-900 dark:text-white mt-1">Asia/Dhaka (GMT+6)</p>
                        </div>

                        <!-- Theme Control -->
                        <div class="p-3.5 rounded-2xl bg-slate-50 dark:bg-slate-800/60 border border-slate-100 dark:border-slate-700/60 flex items-center justify-between">
                            <div>
                                <p class="text-[10px] uppercase font-bold text-slate-400 dark:text-slate-500 tracking-wider">Theme Mode</p>
                                <p class="text-xs font-bold text-emerald-600 dark:text-emerald-400 mt-1">Light / Dark</p>
                            </div>
                            <x-theme-toggle />
                        </div>
                    </div>
                </div>

                <!-- Financial Data Footprint Card -->
                <div class="p-5 sm:p-6 rounded-3xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-xs space-y-4">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-xl bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                <polyline points="14 2 14 8 20 8"></polyline>
                                <line x1="16" y1="13" x2="8" y2="13"></line>
                                <line x1="16" y1="17" x2="8" y2="17"></line>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-base font-bold text-slate-900 dark:text-white">Financial Data Footprint</h3>
                            <p class="text-[11px] text-slate-400 dark:text-slate-500 font-medium">Total financial records linked to your account</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 pt-2">
                        <div class="p-3.5 rounded-2xl bg-slate-50 dark:bg-slate-800/60 border border-slate-100 dark:border-slate-700/60">
                            <p class="text-[10px] uppercase font-bold text-slate-400 dark:text-slate-500 tracking-wider">Transactions</p>
                            <p class="text-xl font-black text-slate-900 dark:text-white mt-1">{{ $dataStats['transactionsCount'] }} <span class="text-xs font-semibold text-slate-400">items</span></p>
                        </div>

                        <div class="p-3.5 rounded-2xl bg-slate-50 dark:bg-slate-800/60 border border-slate-100 dark:border-slate-700/60">
                            <p class="text-[10px] uppercase font-bold text-slate-400 dark:text-slate-500 tracking-wider">Budgets</p>
                            <p class="text-xl font-black text-slate-900 dark:text-white mt-1">{{ $dataStats['budgetsCount'] }} <span class="text-xs font-semibold text-slate-400">targets</span></p>
                        </div>

                        <div class="p-3.5 rounded-2xl bg-slate-50 dark:bg-slate-800/60 border border-slate-100 dark:border-slate-700/60">
                            <p class="text-[10px] uppercase font-bold text-slate-400 dark:text-slate-500 tracking-wider">Attachments</p>
                            <p class="text-xl font-black text-slate-900 dark:text-white mt-1">{{ $dataStats['attachmentsCount'] }} <span class="text-xs font-semibold text-slate-400">files</span></p>
                        </div>
                    </div>
                </div>

                <!-- ======================================================== -->
                <!-- DANGER ZONE: CLEAR ALL MY DATA                           -->
                <!-- ======================================================== -->
                <div class="p-5 sm:p-6 rounded-3xl bg-rose-50/50 dark:bg-rose-950/20 border border-rose-200 dark:border-rose-900/60 shadow-xs space-y-4">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-xl bg-rose-100 dark:bg-rose-950/80 text-rose-600 dark:text-rose-400 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3">
                                <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path>
                                <line x1="12" y1="9" x2="12" y2="13"></line>
                                <line x1="12" y1="17" x2="12.01" y2="17"></line>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-base font-bold text-rose-700 dark:text-rose-400">Danger Zone — Clear All My Data</h3>
                            <p class="text-[11px] text-rose-600/80 dark:text-rose-400/80 font-medium">Irreversible deletion of your personal financial records</p>
                        </div>
                    </div>

                    <div class="p-4 rounded-2xl bg-white/80 dark:bg-slate-900/80 border border-rose-100 dark:border-rose-900/40 text-xs sm:text-sm text-slate-600 dark:text-slate-300 leading-relaxed space-y-2">
                        <p class="font-bold text-rose-600 dark:text-rose-400">
                            Warning: This action cannot be reversed!
                        </p>
                        <p>
                            Clicking the button below will permanently wipe all your:
                        </p>
                        <ul class="list-disc list-inside space-y-1 text-slate-500 dark:text-slate-400 pl-1 text-xs">
                            <li>All financial transactions (both active and soft-deleted)</li>
                            <li>All monthly category budgets and spending limits</li>
                            <li>All transaction receipt attachments and uploaded storage files</li>
                        </ul>
                        <p class="text-[11px] text-slate-400 dark:text-slate-500 pt-1">
                            Note: Your account login credentials, password, and registered email address will <strong>not</strong> be deleted.
                        </p>
                    </div>

                    <!-- Trigger Wipe Confirmation Modal Button -->
                    <div>
                        <button
                            type="button"
                            onclick="openWipeModal()"
                            class="inline-flex items-center gap-2 px-5 py-2.5 rounded-2xl bg-rose-600 hover:bg-rose-700 text-white font-bold text-xs sm:text-sm shadow-sm shadow-rose-600/25 transition-all ios-press cursor-pointer"
                        >
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3">
                                <polyline points="3 6 5 6 21 6"></polyline>
                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                            </svg>
                            <span>Clear All My Financial Data...</span>
                        </button>
                    </div>
                </div>

            </main>

        </div>

    </div>

    <!-- ======================================================== -->
    <!-- PASSWORD CONFIRMATION MODAL FOR CLEARING DATA            -->
    <!-- ======================================================== -->
    <div
        id="wipeDataModal"
        class="hidden fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/70 backdrop-blur-md animate-in fade-in duration-200"
        role="dialog"
        aria-modal="true"
        aria-labelledby="wipeModalTitle"
    >
        <div class="relative w-full max-w-md rounded-3xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-2xl p-5 sm:p-6 space-y-4">
            
            <div class="flex items-start gap-3.5">
                <div class="w-10 h-10 rounded-2xl bg-rose-100 dark:bg-rose-950/80 text-rose-600 dark:text-rose-400 flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3">
                        <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path>
                        <line x1="12" y1="9" x2="12" y2="13"></line>
                        <line x1="12" y1="17" x2="12.01" y2="17"></line>
                    </svg>
                </div>
                <div>
                    <h3 id="wipeModalTitle" class="text-base sm:text-lg font-bold text-slate-900 dark:text-white">
                        Confirm Data Purge
                    </h3>
                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">
                        Please re-enter your account password to confirm that you want to delete all your financial records.
                    </p>
                </div>
            </div>

            <!-- Confirmation Form -->
            <form method="POST" action="{{ route('settings.clear-data') }}" class="space-y-4 pt-1">
                @csrf

                <!-- Current Password -->
                <div>
                    <label for="modalPassword" class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">
                        Your Account Password <span class="text-rose-500">*</span>
                    </label>
                    <input
                        type="password"
                        name="password"
                        id="modalPassword"
                        required
                        autocomplete="current-password"
                        class="w-full px-4 py-2.5 rounded-2xl border border-slate-200 dark:border-slate-700 bg-slate-50/50 dark:bg-slate-800/50 text-slate-900 dark:text-white text-xs sm:text-sm font-medium focus:ring-2 focus:ring-rose-500/40 focus:border-rose-500 outline-none transition-all"
                        placeholder="Enter password"
                    >
                </div>

                <!-- Type CLEAR confirmation -->
                <div>
                    <label for="modalConfirmation" class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">
                        Type <span class="font-mono text-rose-600 dark:text-rose-400 font-black">CLEAR</span> to confirm <span class="text-rose-500">*</span>
                    </label>
                    <input
                        type="text"
                        name="confirmation"
                        id="modalConfirmation"
                        required
                        class="w-full px-4 py-2.5 rounded-2xl border border-slate-200 dark:border-slate-700 bg-slate-50/50 dark:bg-slate-800/50 text-slate-900 dark:text-white text-xs sm:text-sm font-medium focus:ring-2 focus:ring-rose-500/40 focus:border-rose-500 outline-none transition-all uppercase"
                        placeholder="CLEAR"
                    >
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center justify-end gap-2.5 pt-2">
                    <button
                        type="button"
                        onclick="closeWipeModal()"
                        class="px-4 py-2.5 rounded-2xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-700 dark:text-slate-300 font-bold text-xs sm:text-sm hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors ios-press cursor-pointer"
                    >
                        Cancel
                    </button>
                    <button
                        type="submit"
                        class="px-5 py-2.5 rounded-2xl bg-rose-600 hover:bg-rose-700 text-white font-bold text-xs sm:text-sm shadow-md shadow-rose-600/30 transition-all ios-press cursor-pointer"
                    >
                        Yes, Permanently Clear Data
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Mobile Bottom Navigation -->
    <x-bottom-nav active="" />

    <!-- Modal Controller Script -->
    <script>
        window.openWipeModal = function() {
            const modal = document.getElementById('wipeDataModal');
            if (modal) {
                modal.classList.remove('hidden');
                document.getElementById('modalPassword')?.focus();
            }
        };

        window.closeWipeModal = function() {
            const modal = document.getElementById('wipeDataModal');
            if (modal) {
                modal.classList.add('hidden');
            }
        };

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeWipeModal();
            }
        });
    </script>

</body>
</html>

