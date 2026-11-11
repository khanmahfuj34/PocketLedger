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

    <!-- 4. Budgets Tab -->
    <a
        href="{{ route('budgets.index') }}"
        class="flex flex-col items-center justify-center flex-1 py-1 ios-press group {{ $active === 'budgets' ? 'text-emerald-600 dark:text-emerald-400 font-bold' : 'text-slate-400 dark:text-slate-500 hover:text-slate-600 dark:hover:text-slate-300 font-medium' }}"
    >
        <div class="relative w-6 h-6 flex items-center justify-center">
            @if($active === 'budgets')
                <svg class="w-5 h-5 stroke-current" viewBox="0 0 24 24" fill="none" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 12V7H5a2 2 0 0 1 0-4h14v4"></path>
                    <path d="M3 5v14a2 2 0 0 0 2 2h16v-5"></path>
                    <path d="M18 12a2 2 0 0 0 0 4h4v-4z"></path>
                </svg>
                <span class="absolute -bottom-1 w-1 h-1 rounded-full bg-emerald-500"></span>
            @else
                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 12V7H5a2 2 0 0 1 0-4h14v4"></path>
                    <path d="M3 5v14a2 2 0 0 0 2 2h16v-5"></path>
                    <path d="M18 12a2 2 0 0 0 0 4h4v-4z"></path>
                </svg>
            @endif
        </div>
        <span class="text-[10px] tracking-tight mt-0.5">Budgets</span>
    </a>

    <!-- 5. Reports Tab -->
    <a
        href="{{ Route::has('reports.index') ? route('reports.index') : (Route::has('reports') ? route('reports') : route('dashboard') . '#analytics') }}"
        class="flex flex-col items-center justify-center flex-1 py-1 ios-press group {{ $active === 'reports' ? 'text-emerald-600 dark:text-emerald-400 font-bold' : 'text-slate-400 dark:text-slate-500 hover:text-slate-600 dark:hover:text-slate-300 font-medium' }}"
    >
        <div class="relative w-6 h-6 flex items-center justify-center">
            @if($active === 'reports')
                <svg class="w-5 h-5 stroke-current" viewBox="0 0 24 24" fill="none" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="20" x2="18" y2="10"></line>
                    <line x1="12" y1="20" x2="12" y2="4"></line>
                    <line x1="6" y1="20" x2="6" y2="14"></line>
                </svg>
                <span class="absolute -bottom-1 w-1 h-1 rounded-full bg-emerald-500"></span>
            @else
                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="20" x2="18" y2="10"></line>
                    <line x1="12" y1="20" x2="12" y2="4"></line>
                    <line x1="6" y1="20" x2="6" y2="14"></line>
                </svg>
            @endif
        </div>
        <span class="text-[10px] tracking-tight mt-0.5">Reports</span>
    </a>
</nav>

<!-- Smooth Mobile Bottom Navigation Transition Script (Zero-Dependency) -->
<script data-persistent="true">
(function() {
    if (window._pocketLedgerNavActive) return;
    window._pocketLedgerNavActive = true;

    var navCache = new Map();
    var currentAbort = null;

    // Prefetch URL on pointerdown (touch/hover)
    function prefetchUrl(url) {
        if (!url) return;
        var clean = url.split('#')[0];
        if (navCache.has(clean)) return;

        fetch(clean, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' },
            priority: 'low'
        })
        .then(function(res) { return res.ok ? res.text() : null; })
        .then(function(html) {
            if (html) {
                navCache.set(clean, { html: html, time: Date.now() });
            }
        })
        .catch(function() {});
    }

    // Prefetch on touchstart / pointerdown
    document.addEventListener('pointerdown', function(e) {
        var a = e.target.closest('nav.lg\\:hidden a[href]');
        if (a && a.href && a.origin === window.location.origin) {
            prefetchUrl(a.href);
        }
    }, { passive: true });

    // Smooth navigation handler
    async function switchMobileTab(url, pushState) {
        var cleanUrl = url.split('#')[0];
        var hash = url.includes('#') ? url.substring(url.indexOf('#')) : '';
        var currentClean = window.location.href.split('#')[0];

        // Same page: smooth scroll to top or hash
        if (cleanUrl === currentClean) {
            if (hash) {
                var el = document.querySelector(hash);
                if (el) el.scrollIntoView({ behavior: 'smooth' });
            } else {
                window.scrollTo({ top: 0, behavior: 'smooth' });
            }
            return;
        }

        if (currentAbort) {
            currentAbort.abort();
        }
        currentAbort = new AbortController();

        try {
            var html = null;
            var cached = navCache.get(cleanUrl);
            var now = Date.now();

            if (cached && (now - cached.time < 30000)) {
                html = cached.html;
            } else {
                var response = await fetch(cleanUrl, {
                    signal: currentAbort.signal,
                    headers: { 'X-Requested-With': 'XMLHttpRequest' }
                });

                if (!response.ok) {
                    window.location.href = url;
                    return;
                }

                html = await response.text();
                navCache.set(cleanUrl, { html: html, time: now });
            }

            var parser = new DOMParser();
            var doc = parser.parseFromString(html, 'text/html');

            function applyUpdate() {
                // 1. Update Title
                if (doc.title) {
                    document.title = doc.title;
                }

                // 2. Replace Main Layout Container
                var oldMain = document.querySelector('.min-h-screen.flex.flex-col.lg\\:flex-row');
                var newMain = doc.querySelector('.min-h-screen.flex.flex-col.lg\\:flex-row');
                if (oldMain && newMain) {
                    oldMain.replaceWith(newMain);
                }

                // 3. Replace Bottom Navigation Bar (Updates active tab styling)
                var oldNav = document.querySelector('nav.lg\\:hidden');
                var newNav = doc.querySelector('nav.lg\\:hidden');
                if (oldNav && newNav) {
                    oldNav.replaceWith(newNav);
                }

                // 4. Update History
                if (pushState) {
                    window.history.pushState({ url: url }, '', url);
                }

                // 5. Scroll to top
                window.scrollTo({ top: 0, left: 0, behavior: 'instant' });

                // 6. Execute scripts from the new page's body
                doc.querySelectorAll('body script').forEach(function(s) {
                    if (s.dataset.persistent || s.textContent.includes('_pocketLedgerNavActive')) {
                        return;
                    }
                    var freshScript = document.createElement('script');
                    Array.from(s.attributes).forEach(function(attr) {
                        freshScript.setAttribute(attr.name, attr.value);
                    });
                    freshScript.textContent = s.textContent;
                    document.body.appendChild(freshScript);
                });

                // Dispatch synthetic event for any listening components
                window.dispatchEvent(new CustomEvent('pocketledger:navigated', { detail: { url: url } }));
            }

            if (document.startViewTransition) {
                document.startViewTransition(function() {
                    applyUpdate();
                });
            } else {
                applyUpdate();
            }

        } catch (err) {
            if (err.name === 'AbortError') return;
            window.location.href = url;
        } finally {
            currentAbort = null;
        }
    }

    // Intercept clicks on bottom navigation
    document.addEventListener('click', function(e) {
        var a = e.target.closest('nav.lg\\:hidden a[href]');
        if (!a) return;

        // Ignore modified or non-left clicks
        if (e.defaultPrevented || e.button !== 0 || e.metaKey || e.ctrlKey || e.shiftKey || e.altKey) return;
        if (a.target === '_blank' || a.hasAttribute('download')) return;

        var href = a.href;
        if (!href || !href.startsWith('http')) return;

        var url = new URL(href, window.location.origin);
        if (url.origin !== window.location.origin) return;

        e.preventDefault();
        switchMobileTab(href, true);
    });

    // Browser Back / Forward handler
    window.addEventListener('popstate', function() {
        switchMobileTab(window.location.href, false);
    });

    // Invalidate cache on mutations (form submit)
    document.addEventListener('submit', function() {
        navCache.clear();
    });
})();
</script>

