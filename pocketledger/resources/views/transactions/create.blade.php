<!DOCTYPE html>
<html lang="en">
<head>
    <title>PocketLedger - Add Transaction</title>
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

                <!-- Reports -->
                <a href="{{ route('dashboard') }}#analytics" class="flex items-center gap-3.5 px-3.5 py-3 rounded-2xl text-sm font-medium text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors">
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
                        <x-theme-toggle />
                        <div class="w-7 h-7 sm:w-8 sm:h-8 rounded-full bg-violet-100 dark:bg-violet-950/80 text-violet-600 dark:text-violet-400 font-bold flex items-center justify-center text-xs border border-violet-200 dark:border-violet-900 shadow-xs">
                            {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 1)) }}
                        </div>
                    </div>
                </div>
            </header>

            <!-- SCROLLABLE FORM CONTAINER -->
            <main class="flex-1 p-3.5 sm:p-6 lg:p-8 max-w-3xl w-full mx-auto space-y-5 sm:space-y-6 pb-[calc(5.5rem+env(safe-area-inset-bottom,0px))] lg:pb-12">

                <!-- Header Title -->
                <div class="pt-1">
                    <h1 class="text-2xl sm:text-3xl font-black text-slate-900 dark:text-white tracking-tight">Add Transaction</h1>
                    <p class="text-xs sm:text-sm text-slate-500 dark:text-slate-400 font-medium mt-0.5">Record and categorize a new income or expense</p>
                </div>

                <!-- Session Flash Success Banner -->
                @if (session('success'))
                    <div class="p-4 rounded-3xl bg-emerald-50 dark:bg-emerald-950/40 border border-emerald-200 dark:border-emerald-800 text-emerald-800 dark:text-emerald-300 shadow-xs flex items-center gap-3">
                        <div class="w-9 h-9 rounded-2xl bg-emerald-500 text-white flex items-center justify-center shrink-0">
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-emerald-900 dark:text-emerald-200">{{ session('success') }}</p>
                            <p class="text-xs text-emerald-700 dark:text-emerald-400">Your record has been logged in your ledger.</p>
                        </div>
                    </div>
                @endif

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

                <!-- MAIN FORM CARD -->
                <form action="{{ route('transactions.store') }}" method="POST" class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl p-4 sm:p-8 shadow-xs space-y-6">
                    @csrf

                    <!-- 1. Income / Expense Type Toggle (iOS Segmented Control) -->
                    <div>
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider mb-2">Transaction Type</label>
                        <div class="grid grid-cols-2 gap-2 p-1.5 bg-slate-100 dark:bg-slate-800 rounded-2xl">
                            <!-- Expense Button -->
                            <button
                                type="button"
                                id="btnTypeExpense"
                                onclick="setType('expense')"
                                class="flex items-center justify-center gap-2 py-3 px-4 rounded-xl font-bold text-sm transition-all shadow-xs bg-white dark:bg-slate-700 text-rose-600 dark:text-rose-400 border border-slate-200 dark:border-slate-600 ios-press"
                            >
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <line x1="12" y1="5" x2="12" y2="19"></line>
                                    <polyline points="19 12 12 19 5 12"></polyline>
                                </svg>
                                <span>Expense</span>
                            </button>

                            <!-- Income Button -->
                            <button
                                type="button"
                                id="btnTypeIncome"
                                onclick="setType('income')"
                                class="flex items-center justify-center gap-2 py-3 px-4 rounded-xl font-bold text-sm transition-all text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white border border-transparent ios-press"
                            >
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <line x1="7" y1="17" x2="17" y2="7"></line>
                                    <polyline points="7 7 17 7 17 17"></polyline>
                                </svg>
                                <span>Income</span>
                            </button>
                        </div>
                    </div>

                    <!-- 2. Amount Input with BDT (৳) Symbol -->
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
                                placeholder="0.00"
                                value="{{ old('amount') }}"
                                required
                                class="w-full pl-11 pr-4 py-3.5 sm:py-4 rounded-2xl border @error('amount') border-rose-400 ring-2 ring-rose-100 @else border-slate-200 dark:border-slate-700 @enderror text-xl sm:text-2xl font-black text-slate-900 dark:text-white focus:outline-none focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/15 bg-slate-50/50 dark:bg-slate-800 hover:bg-white dark:hover:bg-slate-800/80 transition-all placeholder:text-slate-300 dark:placeholder:text-slate-600"
                            >
                        </div>
                    </div>

                    <!-- 3. Category & Title Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-5">
                        
                        <!-- Category Dropdown -->
                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <label for="category_id" class="block text-xs font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider">
                                    Category <span class="text-rose-500">*</span>
                                </label>
                                <span id="categoryCountBadge" class="text-[11px] font-semibold text-slate-400"></span>
                            </div>
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
                                            data-type="{{ $category->type }}"
                                            @selected(old('category_id') == $category->id)
                                        >
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none text-slate-400">
                                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                        <polyline points="6 9 12 15 18 9"></polyline>
                                    </svg>
                                </div>
                            </div>

                            <!-- Friendly Empty State if no categories exist for active type -->
                            <div id="noCategoriesAlert" class="hidden mt-2 p-3 bg-amber-50 dark:bg-amber-950/40 border border-amber-200 dark:border-amber-800 rounded-2xl flex items-center gap-2 text-xs text-amber-800 dark:text-amber-300 font-medium">
                                <svg class="w-4 h-4 text-amber-600 dark:text-amber-400 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <line x1="12" y1="8" x2="12" y2="12"></line>
                                    <line x1="12" y1="16" x2="12.01" y2="16"></line>
                                </svg>
                                <span id="noCategoriesMsg">No categories found for this type.</span>
                            </div>

                            @error('category_id')
                                <p class="text-xs text-rose-600 font-semibold mt-1.5">{{ $message }}</p>
                            @enderror
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
                                placeholder="e.g. Lunch with Friends, Groceries..."
                                value="{{ old('title') }}"
                                required
                                class="w-full px-4 py-3 rounded-2xl border @error('title') border-rose-400 ring-2 ring-rose-100 @else border-slate-200 dark:border-slate-700 @enderror text-sm font-semibold text-slate-800 dark:text-slate-100 focus:outline-none focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/15 bg-slate-50/50 dark:bg-slate-800 hover:bg-white dark:hover:bg-slate-800/80 transition-all placeholder:text-slate-400 dark:placeholder:text-slate-500"
                            >
                        </div>

                    </div>

                    <!-- 4. Date & Payment Method Grid -->
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
                                value="{{ old('transaction_date', now()->toDateString()) }}"
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
                                    <option value="cash" @selected(old('payment_method') == 'cash')>💵 Cash</option>
                                    <option value="bkash" @selected(old('payment_method') == 'bkash')>📱 bKash</option>
                                    <option value="nagad" @selected(old('payment_method') == 'nagad')>📱 Nagad</option>
                                    <option value="bank" @selected(old('payment_method') == 'bank')>🏦 Bank Transfer</option>
                                    <option value="card" @selected(old('payment_method') == 'card')>💳 Debit / Credit Card</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none text-slate-400">
                                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                        <polyline points="6 9 12 15 18 9"></polyline>
                                    </svg>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- 5. Optional Note Textarea -->
                    <div>
                        <label for="note" class="block text-xs font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider mb-2">
                            Note <span class="text-xs font-normal text-slate-400 lowercase">(optional)</span>
                        </label>
                        <textarea
                            id="note"
                            name="note"
                            rows="3"
                            placeholder="Add additional notes, invoice numbers, or details..."
                            class="w-full px-4 py-3 rounded-2xl border border-slate-200 dark:border-slate-700 text-sm font-medium text-slate-800 dark:text-slate-100 focus:outline-none focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/15 bg-slate-50/50 dark:bg-slate-800 hover:bg-white dark:hover:bg-slate-800/80 transition-all placeholder:text-slate-400 dark:placeholder:text-slate-500 resize-none"
                        >{{ old('note') }}</textarea>
                    </div>

                    <!-- 6. Optional Receipt Upload UI -->
                    <div>
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider mb-2">
                            Receipt / Invoice <span class="text-xs font-normal text-slate-400 lowercase">(optional)</span>
                        </label>
                        <div class="border-2 border-dashed border-slate-200 dark:border-slate-700 hover:border-emerald-500/60 rounded-3xl p-6 text-center bg-slate-50/50 dark:bg-slate-800/40 hover:bg-emerald-50/30 dark:hover:bg-emerald-950/20 transition-all cursor-pointer group ios-press">
                            <div class="w-10 h-10 rounded-2xl bg-slate-100 dark:bg-slate-800 group-hover:bg-emerald-100 dark:group-hover:bg-emerald-900/60 group-hover:text-emerald-700 text-slate-400 dark:text-slate-500 flex items-center justify-center mx-auto mb-2 transition-colors">
                                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="17 8 12 3 7 8"></polyline>
                                    <line x1="12" y1="3" x2="12" y2="15"></line>
                                </svg>
                            </div>
                            <p class="text-xs font-bold text-slate-700 dark:text-slate-300 group-hover:text-emerald-700 dark:group-hover:text-emerald-400 transition-colors">Click or drag receipt image to upload</p>
                            <p class="text-[11px] text-slate-400 mt-0.5">Supports PNG, JPG, or PDF up to 5MB</p>
                        </div>
                    </div>

                    <!-- 7. Save & Cancel Action Buttons -->
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
                            Save Transaction
                        </button>
                    </div>

                </form>

            </main>

        </div>

    </div>

    <!-- iOS Translucent Bottom Tab Bar with Raised FAB -->
    <x-bottom-nav active="create" />

    <!-- Client-Side Dynamic Category & Type Toggle Script -->
    <script>
        const userCategories = @json($categories);
        const initialSelectedId = "{{ old('category_id', '') }}";

        let currentType = 'expense';
        if (initialSelectedId) {
            const matched = userCategories.find(c => String(c.id) === String(initialSelectedId));
            if (matched && matched.type) {
                currentType = matched.type;
            }
        }

        function setType(type, targetCatId = null) {
            if (typeof triggerHaptic === 'function') triggerHaptic(10);
            currentType = type;
            const btnExpense = document.getElementById('btnTypeExpense');
            const btnIncome = document.getElementById('btnTypeIncome');
            const categorySelect = document.getElementById('category_id');
            const noCategoriesAlert = document.getElementById('noCategoriesAlert');
            const noCategoriesMsg = document.getElementById('noCategoriesMsg');
            const categoryCountBadge = document.getElementById('categoryCountBadge');

            const activeExpenseCls = "flex items-center justify-center gap-2 py-3 px-4 rounded-xl font-bold text-sm transition-all shadow-xs bg-white dark:bg-slate-700 text-rose-600 dark:text-rose-400 border border-slate-200 dark:border-slate-600 ios-press";
            const activeIncomeCls = "flex items-center justify-center gap-2 py-3 px-4 rounded-xl font-bold text-sm transition-all shadow-xs bg-white dark:bg-slate-700 text-emerald-600 dark:text-emerald-400 border border-slate-200 dark:border-slate-600 ios-press";
            const inactiveCls = "flex items-center justify-center gap-2 py-3 px-4 rounded-xl font-bold text-sm transition-all text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white border border-transparent ios-press";

            if (type === 'expense') {
                btnExpense.className = activeExpenseCls;
                btnIncome.className = inactiveCls;
            } else {
                btnIncome.className = activeIncomeCls;
                btnExpense.className = inactiveCls;
            }

            if (!categorySelect) return;

            const filtered = userCategories.filter(cat => cat.type === type);
            categorySelect.innerHTML = '';

            const placeholder = document.createElement('option');
            placeholder.value = '';
            placeholder.textContent = filtered.length > 0
                ? `Select ${type.charAt(0).toUpperCase() + type.slice(1)} Category`
                : `No ${type} categories available`;
            categorySelect.appendChild(placeholder);

            if (filtered.length === 0) {
                if (noCategoriesAlert && noCategoriesMsg) {
                    noCategoriesMsg.textContent = `No active ${type} categories found for your account.`;
                    noCategoriesAlert.classList.remove('hidden');
                }
                if (categoryCountBadge) {
                    categoryCountBadge.textContent = '0 available';
                }
                placeholder.selected = true;
            } else {
                if (noCategoriesAlert) {
                    noCategoriesAlert.classList.add('hidden');
                }
                if (categoryCountBadge) {
                    categoryCountBadge.textContent = `${filtered.length} available`;
                }

                let isSelected = false;
                filtered.forEach(cat => {
                    const opt = document.createElement('option');
                    opt.value = cat.id;
                    opt.textContent = cat.name;
                    opt.setAttribute('data-type', cat.type);
                    if (targetCatId && String(cat.id) === String(targetCatId)) {
                        opt.selected = true;
                        isSelected = true;
                    }
                    categorySelect.appendChild(opt);
                });

                if (!isSelected) {
                    placeholder.selected = true;
                }
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            setType(currentType, initialSelectedId);
        });
    </script>

</body>
</html>
