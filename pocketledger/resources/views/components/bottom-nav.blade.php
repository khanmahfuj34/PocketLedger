@props(['active' => 'dashboard'])

<!-- ======================================================== -->
<!-- iOS BLURRED BOTTOM TAB BAR WITH FLOATING ACTION BUTTON   -->
<!-- ======================================================== -->
<nav
    class="lg:hidden fixed bottom-0 left-0 right-0 z-40 bg-white/80 dark:bg-slate-900/80 backdrop-blur-2xl border-t border-slate-200/80 dark:border-slate-800/80 px-3 sm:px-6 flex items-center justify-around transition-colors"
    style="padding-bottom: max(0.6rem, env(safe-area-inset-bottom, 0.6rem)); height: calc(3.75rem + max(0.6rem, env(safe-area-inset-bottom, 0.6rem)));"
>
    <!-- 1. Home / Dashboard Tab -->
    <a
        href="{{ route('dashboard') }}"
        class="flex flex-col items-center justify-center flex-1 py-1 ios-press group {{ $active === 'dashboard' ? 'text-emerald-600 dark:text-emerald-400 font-bold' : 'text-slate-400 dark:text-slate-500 hover:text-slate-600 dark:hover:text-slate-300 font-medium' }}"
    >
        <div class="relative w-6 h-6 flex items-center justify-center">
            @if($active === 'dashboard')
                <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                    <path d="M10.707 2.293a1 1 0 0 1 1.414 0l8 8A1 1 0 0 1 20 11v9a2 2 0 0 1-2 2h-4a1 1 0 0 1-1-1v-5a1 1 0 0 0-1-1h-2a1 1 0 0 0-1 1v5a1 1 0 0 1-1 1H6a2 2 0 0 1-2-2v-9a1 1 0 0 1 .293-.707l8-8z"/>
                </svg>
                <span class="absolute -bottom-1 w-1 h-1 rounded-full bg-emerald-500"></span>
            @else
                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M10.707 2.293a1 1 0 0 1 1.414 0l8 8A1 1 0 0 1 20 11v9a2 2 0 0 1-2 2h-4a1 1 0 0 1-1-1v-5a1 1 0 0 0-1-1h-2a1 1 0 0 0-1 1v5a1 1 0 0 1-1 1H6a2 2 0 0 1-2-2v-9a1 1 0 0 1 .293-.707l8-8z"/>
                </svg>
            @endif
        </div>
        <span class="text-[10px] tracking-tight mt-0.5">Home</span>
    </a>

    <!-- 2. Transactions Tab -->
    <a
        href="{{ route('transactions.index') }}"
        class="flex flex-col items-center justify-center flex-1 py-1 ios-press group {{ $active === 'transactions' ? 'text-emerald-600 dark:text-emerald-400 font-bold' : 'text-slate-400 dark:text-slate-500 hover:text-slate-600 dark:hover:text-slate-300 font-medium' }}"
    >
        <div class="relative w-6 h-6 flex items-center justify-center">
            @if($active === 'transactions')
                <svg class="w-5 h-5 stroke-current" viewBox="0 0 24 24" fill="none" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="17 1 21 5 17 9"></polyline>
                    <path d="M3 11V9a4 4 0 0 1 4-4h14"></path>
                    <polyline points="7 23 3 19 7 15"></polyline>
                    <path d="M21 13v2a4 4 0 0 1-4 4H3"></path>
                </svg>
                <span class="absolute -bottom-1 w-1 h-1 rounded-full bg-emerald-500"></span>
            @else
                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="17 1 21 5 17 9"></polyline>
                    <path d="M3 11V9a4 4 0 0 1 4-4h14"></path>
                    <polyline points="7 23 3 19 7 15"></polyline>
                    <path d="M21 13v2a4 4 0 0 1-4 4H3"></path>
                </svg>
            @endif
        </div>
        <span class="text-[10px] tracking-tight mt-0.5">Ledger</span>
    </a>

    <!-- 3. Center Raised Floating Action Button (+) -->
    <div class="flex-1 flex items-center justify-center -mt-6">
        <a
            href="{{ route('transactions.create') }}"
            class="relative w-13 h-13 rounded-full bg-gradient-to-tr from-emerald-600 to-teal-500 text-white flex items-center justify-center shadow-lg shadow-emerald-500/40 ring-4 ring-white dark:ring-slate-900 transition-transform active:scale-90"
            aria-label="Add New Transaction"
            title="Add Transaction"
        >
            <svg class="w-6 h-6 stroke-current" viewBox="0 0 24 24" fill="none" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round">
                <line x1="12" y1="5" x2="12" y2="19"></line>
                <line x1="5" y1="12" x2="19" y2="12"></line>
            </svg>
        </a>
    </div>

    <!-- 4. Reports Tab -->
    <a
        href="{{ route('dashboard') }}#analytics"
        class="flex flex-col items-center justify-center flex-1 py-1 ios-press group text-slate-400 dark:text-slate-500 hover:text-slate-600 dark:hover:text-slate-300 font-medium"
    >
        <div class="relative w-6 h-6 flex items-center justify-center">
            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="18" y1="20" x2="18" y2="10"></line>
                <line x1="12" y1="20" x2="12" y2="4"></line>
                <line x1="6" y1="20" x2="6" y2="14"></line>
            </svg>
        </div>
        <span class="text-[10px] tracking-tight mt-0.5">Reports</span>
    </a>

    <!-- 5. Theme / Profile Tab -->
    <button
        type="button"
        onclick="toggleAppTheme()"
        class="flex flex-col items-center justify-center flex-1 py-1 ios-press group text-slate-400 dark:text-slate-500 hover:text-slate-600 dark:hover:text-slate-300 font-medium"
    >
        <div class="relative w-6 h-6 flex items-center justify-center">
            <!-- Dynamic Sun / Moon -->
            <svg class="hidden dark:block w-5 h-5 text-amber-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="5"></circle>
                <line x1="12" y1="1" x2="12" y2="3"></line>
                <line x1="12" y1="21" x2="12" y2="23"></line>
                <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line>
                <line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line>
                <line x1="1" y1="12" x2="3" y2="12"></line>
                <line x1="21" y1="12" x2="23" y2="12"></line>
            </svg>
            <svg class="block dark:hidden w-5 h-5 text-slate-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
            </svg>
        </div>
        <span class="text-[10px] tracking-tight mt-0.5">Theme</span>
    </button>
</nav>

