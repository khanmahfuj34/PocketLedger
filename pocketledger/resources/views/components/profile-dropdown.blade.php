<!-- ======================================================== -->
<!-- POCKETLEDGER USER PROFILE DROPDOWN COMPONENT               -->
<!-- ======================================================== -->
<div class="relative" id="profileDropdownContainer">
    <!-- Trigger Button -->
    <button
        type="button"
        id="profileDropdownButton"
        onclick="toggleProfileDropdown()"
        class="flex items-center gap-2 p-0.5 sm:p-1 rounded-full border border-slate-200 dark:border-slate-700/80 bg-white/80 dark:bg-slate-800/80 hover:border-emerald-500/60 dark:hover:border-emerald-500/60 shadow-xs transition-all ios-press cursor-pointer group"
        aria-haspopup="true"
        aria-expanded="false"
        title="Open Profile Menu"
    >
        <div class="w-7 h-7 sm:w-8 sm:h-8 rounded-full bg-gradient-to-tr from-emerald-500 to-teal-500 text-white font-extrabold flex items-center justify-center text-xs shadow-xs group-hover:scale-105 transition-transform">
            {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 1)) }}
        </div>
        <svg class="hidden sm:block w-3.5 h-3.5 text-slate-400 group-hover:text-slate-600 dark:group-hover:text-slate-200 transition-transform duration-200 mr-1" id="profileChevron" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="6 9 12 15 18 9"></polyline>
        </svg>
    </button>

    <!-- Dropdown Menu -->
    <div
        id="profileDropdownMenu"
        class="hidden absolute right-0 mt-2.5 w-64 sm:w-72 rounded-2xl bg-white/95 dark:bg-slate-900/95 backdrop-blur-2xl border border-slate-200 dark:border-slate-800 shadow-ios-lg z-50 p-2 transition-all origin-top-right focus:outline-none"
        role="menu"
        aria-orientation="vertical"
        aria-labelledby="profileDropdownButton"
    >
        <!-- User Header Info -->
        <div class="px-3 py-2.5 border-b border-slate-100 dark:border-slate-800/80 mb-1">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-2xl bg-gradient-to-tr from-emerald-500 to-teal-500 text-white font-black flex items-center justify-center text-sm shadow-sm shadow-emerald-500/25 shrink-0">
                    {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 1)) }}
                </div>
                <div class="min-w-0 flex-1">
                    <p class="text-xs sm:text-sm font-bold text-slate-900 dark:text-white truncate">
                        {{ Auth::user()->name ?? 'User' }}
                    </p>
                    <p class="text-[11px] text-slate-400 dark:text-slate-500 truncate">
                        {{ Auth::user()->email ?? '' }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Navigation Links -->
        <div class="py-1 space-y-0.5">
            <!-- 1. My Profile -->
            <a
                href="{{ route('profile.edit') }}"
                class="flex items-center gap-3 px-3 py-2 rounded-xl text-xs font-semibold text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-800/80 transition-colors ios-press group"
                role="menuitem"
            >
                <div class="w-7 h-7 rounded-lg bg-emerald-50 dark:bg-emerald-950/60 text-emerald-600 dark:text-emerald-400 flex items-center justify-center shrink-0 group-hover:scale-105 transition-transform">
                    <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                </div>
                <span>My Profile</span>
            </a>

            <!-- 2. Settings -->
            <a
                href="{{ route('settings.index') }}"
                class="flex items-center gap-3 px-3 py-2 rounded-xl text-xs font-semibold text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-800/80 transition-colors ios-press group"
                role="menuitem"
            >
                <div class="w-7 h-7 rounded-lg bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 flex items-center justify-center shrink-0 group-hover:scale-105 transition-transform">
                    <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="3"></circle>
                        <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path>
                    </svg>
                </div>
                <span>Settings</span>
            </a>
        </div>

        <!-- Theme Switching Options Inside Dropdown -->
        <div class="px-3 py-2 border-t border-slate-100 dark:border-slate-800/80 my-1">
            <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500 mb-2">Theme Mode</p>
            <div class="grid grid-cols-2 gap-1.5 p-1 rounded-xl bg-slate-100 dark:bg-slate-800/80">
                <!-- Light Mode Button -->
                <button
                    type="button"
                    onclick="selectThemeMode('light')"
                    id="btnThemeLight"
                    class="flex items-center justify-center gap-1.5 py-1.5 px-2 rounded-lg text-xs font-semibold transition-all ios-press cursor-pointer"
                >
                    <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3">
                        <circle cx="12" cy="12" r="5"></circle>
                        <line x1="12" y1="1" x2="12" y2="3"></line>
                        <line x1="12" y1="21" x2="12" y2="23"></line>
                        <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line>
                        <line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line>
                        <line x1="1" y1="12" x2="3" y2="12"></line>
                        <line x1="21" y1="12" x2="23" y2="12"></line>
                        <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line>
                        <line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line>
                    </svg>
                    <span>Light</span>
                </button>

                <!-- Dark Mode Button -->
                <button
                    type="button"
                    onclick="selectThemeMode('dark')"
                    id="btnThemeDark"
                    class="flex items-center justify-center gap-1.5 py-1.5 px-2 rounded-lg text-xs font-semibold transition-all ios-press cursor-pointer"
                >
                    <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3">
                        <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
                    </svg>
                    <span>Dark</span>
                </button>
            </div>
        </div>

        <!-- Logout Action -->
        <div class="pt-1 border-t border-slate-100 dark:border-slate-800/80">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button
                    type="submit"
                    class="w-full flex items-center gap-3 px-3 py-2 rounded-xl text-xs font-semibold text-rose-600 dark:text-rose-400 hover:bg-rose-50 dark:hover:bg-rose-950/40 transition-colors ios-press cursor-pointer"
                    role="menuitem"
                >
                    <div class="w-7 h-7 rounded-lg bg-rose-50 dark:bg-rose-950/60 text-rose-600 dark:text-rose-400 flex items-center justify-center shrink-0">
                        <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                            <polyline points="16 17 21 12 16 7"></polyline>
                            <line x1="21" y1="12" x2="9" y2="12"></line>
                        </svg>
                    </div>
                    <span>Log Out</span>
                </button>
            </form>
        </div>
    </div>
</div>

<!-- Profile Dropdown & Theme Synchronizer Script -->
<script>
    window.toggleProfileDropdown = function() {
        const menu = document.getElementById('profileDropdownMenu');
        const chevron = document.getElementById('profileChevron');
        const btn = document.getElementById('profileDropdownButton');
        if (!menu) return;

        const isHidden = menu.classList.contains('hidden');
        if (isHidden) {
            menu.classList.remove('hidden');
            btn?.setAttribute('aria-expanded', 'true');
            chevron?.classList.add('rotate-180');
            updateThemeButtonState();
        } else {
            menu.classList.add('hidden');
            btn?.setAttribute('aria-expanded', 'false');
            chevron?.classList.remove('rotate-180');
        }
    };

    window.selectThemeMode = function(mode) {
        if (typeof triggerHaptic === 'function') triggerHaptic(15);
        const html = document.documentElement;
        if (mode === 'dark') {
            html.classList.add('dark');
            html.style.backgroundColor = '#020617';
            html.style.colorScheme = 'dark';
            localStorage.theme = 'dark';
        } else {
            html.classList.remove('dark');
            html.style.backgroundColor = '#f8fafc';
            html.style.colorScheme = 'light';
            localStorage.theme = 'light';
        }

        updateThemeButtonState();
        window.dispatchEvent(new CustomEvent('themeChanged', { detail: { isDark: mode === 'dark' } }));
    };

    function updateThemeButtonState() {
        const isDark = document.documentElement.classList.contains('dark');
        const btnLight = document.getElementById('btnThemeLight');
        const btnDark = document.getElementById('btnThemeDark');
        if (!btnLight || !btnDark) return;

        const activeCls = "bg-white dark:bg-slate-700 text-emerald-600 dark:text-emerald-400 shadow-xs font-bold";
        const inactiveCls = "text-slate-500 dark:text-slate-400 hover:text-slate-800 dark:hover:text-slate-200 font-semibold";

        if (isDark) {
            btnDark.className = "flex items-center justify-center gap-1.5 py-1.5 px-2 rounded-lg text-xs transition-all ios-press cursor-pointer " + activeCls;
            btnLight.className = "flex items-center justify-center gap-1.5 py-1.5 px-2 rounded-lg text-xs transition-all ios-press cursor-pointer " + inactiveCls;
        } else {
            btnLight.className = "flex items-center justify-center gap-1.5 py-1.5 px-2 rounded-lg text-xs transition-all ios-press cursor-pointer " + activeCls;
            btnDark.className = "flex items-center justify-center gap-1.5 py-1.5 px-2 rounded-lg text-xs transition-all ios-press cursor-pointer " + inactiveCls;
        }
    }

    if (!window._profileDropdownListenersAdded) {
        window._profileDropdownListenersAdded = true;

        document.addEventListener('click', function(e) {
            const container = document.getElementById('profileDropdownContainer');
            const menu = document.getElementById('profileDropdownMenu');
            const chevron = document.getElementById('profileChevron');
            const btn = document.getElementById('profileDropdownButton');
            if (container && !container.contains(e.target)) {
                if (menu && !menu.classList.contains('hidden')) {
                    menu.classList.add('hidden');
                    btn?.setAttribute('aria-expanded', 'false');
                    chevron?.classList.remove('rotate-180');
                }
            }
        });

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                const menu = document.getElementById('profileDropdownMenu');
                const chevron = document.getElementById('profileChevron');
                const btn = document.getElementById('profileDropdownButton');
                if (menu && !menu.classList.contains('hidden')) {
                    menu.classList.add('hidden');
                    btn?.setAttribute('aria-expanded', 'false');
                    chevron?.classList.remove('rotate-180');
                }
            }
        });

        window.addEventListener('pocketledger:navigated', function() {
            const menu = document.getElementById('profileDropdownMenu');
            const chevron = document.getElementById('profileChevron');
            const btn = document.getElementById('profileDropdownButton');
            if (menu && !menu.classList.contains('hidden')) {
                menu.classList.add('hidden');
                btn?.setAttribute('aria-expanded', 'false');
                chevron?.classList.remove('rotate-180');
            }
        });
    }

    // Initialize state
    updateThemeButtonState();
</script>

