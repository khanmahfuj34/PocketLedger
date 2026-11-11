<!DOCTYPE html>
<html lang="en">
<head>
    <title>PocketLedger - Edit Transaction</title>
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
        <div class="flex-1 min-w-0 flex flex-col">

            <!-- TOP NAVBAR WITH SAFE AREA -->
            <header class="bg-white/80 dark:bg-slate-900/80 backdrop-blur-xl border-b border-slate-200/80 dark:border-slate-800/80 sticky top-0 z-30 pt-[env(safe-area-inset-top,0px)] transition-colors">
                <div class="max-w-7xl mx-auto px-3.5 sm:px-6 lg:px-8 h-14 sm:h-16 flex items-center justify-between gap-3">
                    
                    <!-- Back Link / Mobile Logo -->
                    <div class="flex items-center gap-3">
                        <a href="{{ route('transactions.index') }}" class="inline-flex items-center gap-1.5 text-xs sm:text-sm font-bold text-slate-600 dark:text-slate-300 hover:text-emerald-600 dark:hover:text-emerald-400 transition-colors ios-press">
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="19" y1="12" x2="5" y2="12"></line>
                                <polyline points="12 19 5 12 12 5"></polyline>
                            </svg>
                            <span>Back to Transactions</span>
                        </a>
                    </div>

                    <!-- Profile / Theme Actions -->
                    <div class="flex items-center gap-2 sm:gap-3">
                        <div class="hidden lg:block">
                            <x-theme-toggle />
                        </div>
                        <x-profile-dropdown />
                    </div>
                </div>
            </header>

            <!-- SCROLLABLE FORM CONTAINER -->
            <main class="flex-1 p-3.5 sm:p-6 lg:p-8 max-w-3xl w-full mx-auto space-y-5 sm:space-y-6 pb-[calc(5.5rem+env(safe-area-inset-bottom,0px))] lg:pb-12">

                <!-- Header Title -->
                <div class="pt-1">
                    <h1 class="text-2xl sm:text-3xl font-black text-slate-900 dark:text-white tracking-tight">Edit Transaction</h1>
                    <p class="text-xs sm:text-sm text-slate-500 dark:text-slate-400 font-medium mt-0.5">Update details for "{{ $transaction->title }}"</p>
                </div>

                <!-- Validation Error Banner -->
                @if ($errors->any())
                    <div class="p-4 rounded-3xl bg-rose-50 dark:bg-rose-950/40 border border-rose-200 dark:border-rose-800 text-rose-800 dark:text-rose-300 shadow-xs space-y-1">
                        <div class="flex items-center gap-2 font-bold text-sm">
                            <svg class="w-4 h-4 text-rose-600 dark:text-rose-400 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                <circle cx="12" cy="12" r="10"></circle>
                                <line x1="12" y1="8" x2="12" y2="12"></line>
                                <line x1="12" y1="16" x2="12.01" y2="16"></line>
                            </svg>
                            <span>Please fix the following errors:</span>
                        </div>
                        <ul class="list-disc list-inside text-xs space-y-0.5 pl-6 text-rose-700 dark:text-rose-400">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- MAIN EDIT FORM CARD -->
                <form action="{{ route('transactions.update', $transaction->id) }}" method="POST" class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl p-4 sm:p-8 shadow-xs space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- 1. Amount Input with BDT (৳) Symbol -->
                    <div>
                        <label for="amount" class="block text-xs font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider mb-2">
                            Amount <span class="text-rose-500">*</span>
                        </label>
                        <div class="relative rounded-2xl shadow-xs">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 font-black text-xl sm:text-2xl">
                                ৳
                            </div>
                            <input
                                type="number"
                                id="amount"
                                name="amount"
                                step="0.01"
                                min="0.01"
                                value="{{ old('amount', $transaction->amount) }}"
                                required
                                class="w-full pl-11 pr-4 py-3.5 sm:py-4 rounded-2xl border @error('amount') border-rose-400 ring-2 ring-rose-100 @else border-slate-200 dark:border-slate-700 @enderror text-xl sm:text-2xl font-black text-slate-900 dark:text-white focus:outline-none focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/15 bg-slate-50/50 dark:bg-slate-800 hover:bg-white dark:hover:bg-slate-800/80 transition-all placeholder:text-slate-300 dark:placeholder:text-slate-600"
                            >
                        </div>
                    </div>

                    <!-- 2. Category & Title Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-5">
                        
                        <!-- Category Dropdown -->
                        <div>
                            <label for="category_id" class="block text-xs font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider mb-2">
                                Category <span class="text-rose-500">*</span>
                            </label>
                            <div class="relative">
                                <select
                                    id="category_id"
                                    name="category_id"
                                    required
                                    class="w-full px-4 py-3 rounded-2xl border @error('category_id') border-rose-400 ring-2 ring-rose-100 @else border-slate-200 dark:border-slate-700 @enderror text-sm font-semibold text-slate-800 dark:text-slate-100 focus:outline-none focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/15 bg-slate-50/50 dark:bg-slate-800 hover:bg-white dark:hover:bg-slate-800/80 transition-all appearance-none cursor-pointer"
                                >
                                    <option value="">Select Category</option>
                                    @foreach ($categories as $category)
                                        <option
                                            value="{{ $category->id }}"
                                            @selected(old('category_id', $transaction->category_id) == $category->id)
                                        >
                                            {{ $category->name }} ({{ ucfirst($category->type) }})
                                        </option>
                                    @endforeach
                                </select>
                                <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none text-slate-400">
                                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                        <polyline points="6 9 12 15 18 9"></polyline>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Title Input -->
                        <div>
                            <label for="title" class="block text-xs font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider mb-2">
                                Title / Description <span class="text-rose-500">*</span>
                            </label>
                            <input
                                type="text"
                                id="title"
                                name="title"
                                value="{{ old('title', $transaction->title) }}"
                                required
                                class="w-full px-4 py-3 rounded-2xl border @error('title') border-rose-400 ring-2 ring-rose-100 @else border-slate-200 dark:border-slate-700 @enderror text-sm font-semibold text-slate-800 dark:text-slate-100 focus:outline-none focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/15 bg-slate-50/50 dark:bg-slate-800 hover:bg-white dark:hover:bg-slate-800/80 transition-all"
                            >
                        </div>

                    </div>

                    <!-- 3. Date & Payment Method Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-5">
                        
                        <!-- Transaction Date -->
                        <div>
                            <label for="transaction_date" class="block text-xs font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider mb-2">
                                Transaction Date <span class="text-rose-500">*</span>
                            </label>
                            <input
                                type="date"
                                id="transaction_date"
                                name="transaction_date"
                                value="{{ old('transaction_date', $transaction->transaction_date ? $transaction->transaction_date->format('Y-m-d') : '') }}"
                                required
                                class="w-full px-4 py-3 rounded-2xl border @error('transaction_date') border-rose-400 ring-2 ring-rose-100 @else border-slate-200 dark:border-slate-700 @enderror text-sm font-semibold text-slate-800 dark:text-slate-100 focus:outline-none focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/15 bg-slate-50/50 dark:bg-slate-800 hover:bg-white dark:hover:bg-slate-800/80 transition-all cursor-pointer"
                            >
                        </div>

                        <!-- Payment Method -->
                        <div>
                            <label for="payment_method" class="block text-xs font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider mb-2">
                                Payment Method <span class="text-rose-500">*</span>
                            </label>
                            <div class="relative">
                                <select
                                    id="payment_method"
                                    name="payment_method"
                                    required
                                    class="w-full px-4 py-3 rounded-2xl border @error('payment_method') border-rose-400 ring-2 ring-rose-100 @else border-slate-200 dark:border-slate-700 @enderror text-sm font-semibold text-slate-800 dark:text-slate-100 focus:outline-none focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/15 bg-slate-50/50 dark:bg-slate-800 hover:bg-white dark:hover:bg-slate-800/80 transition-all appearance-none cursor-pointer"
                                >
                                    @foreach (['cash' => '💵 Cash', 'bkash' => '📱 bKash', 'nagad' => '📱 Nagad', 'bank' => '🏦 Bank Transfer', 'card' => '💳 Debit / Credit Card'] as $val => $label)
                                        <option value="{{ $val }}" @selected(old('payment_method', $transaction->payment_method) === $val)>
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none text-slate-400">
                                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                        <polyline points="6 9 12 15 18 9"></polyline>
                                    </svg>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- 4. Optional Note Textarea -->
                    <div>
                        <label for="note" class="block text-xs font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider mb-2">
                            Note <span class="text-xs font-normal text-slate-400 lowercase">(optional)</span>
                        </label>
                        <textarea
                            id="note"
                            name="note"
                            rows="3"
                            class="w-full px-4 py-3 rounded-2xl border border-slate-200 dark:border-slate-700 text-sm font-medium text-slate-800 dark:text-slate-100 focus:outline-none focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/15 bg-slate-50/50 dark:bg-slate-800 hover:bg-white dark:hover:bg-slate-800/80 transition-all resize-none"
                        >{{ old('note', $transaction->note) }}</textarea>
                    </div>

                    <!-- 5. Update & Cancel Buttons -->
                    <div class="pt-4 flex flex-col-reverse sm:flex-row items-center justify-end gap-3 border-t border-slate-100 dark:border-slate-800/80">
                        <a
                            href="{{ route('transactions.index') }}"
                            class="w-full sm:w-auto px-6 py-3 rounded-2xl border border-slate-200 dark:border-slate-700 text-slate-700 dark:text-slate-300 font-bold text-sm text-center hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors ios-press"
                        >
                            Cancel
                        </a>

                        <button
                            type="submit"
                            onclick="if (typeof triggerHaptic === 'function') triggerHaptic(15);"
                            class="w-full sm:w-auto px-8 py-3 rounded-2xl bg-emerald-500 hover:bg-emerald-600 text-white font-bold text-sm text-center shadow-lg shadow-emerald-500/25 transition-all hover:shadow-xl hover:shadow-emerald-500/30 ios-press"
                        >
                            Update Transaction
                        </button>
                    </div>

                </form>

            </main>

        </div>

    </div>

    <!-- iOS Translucent Bottom Tab Bar with Raised FAB -->
    <x-bottom-nav active="transactions" />

</body>
</html>
