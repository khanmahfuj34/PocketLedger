<!-- Theme Toggle Button (Supports custom classes for desktop sidebar & mobile navbar) -->
<button
    type="button"
    onclick="toggleAppTheme()"
    title="Toggle Light / Dark Mode"
    class="{{ $class ?? 'p-2 rounded-xl text-slate-500 hover:text-slate-800 dark:text-slate-400 dark:hover:text-slate-100 hover:bg-slate-100 dark:hover:bg-slate-800 transition-all active:scale-95' }}"
    aria-label="Toggle Color Theme"
>
    <!-- Sun Icon (Shown in Dark Mode) -->
    <svg id="themeIconSun" class="hidden dark:block w-4 h-4 text-amber-400 transition-transform" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
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

    <!-- Moon Icon (Shown in Light Mode) -->
    <svg id="themeIconMoon" class="block dark:hidden w-4 h-4 text-slate-600 transition-transform" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
    </svg>
</button>

<script>
    function toggleAppTheme() {
        if (typeof triggerHaptic === 'function') triggerHaptic(15);
        const html = document.documentElement;
        const isDark = html.classList.toggle('dark');
        localStorage.theme = isDark ? 'dark' : 'light';
        html.style.backgroundColor = isDark ? '#020617' : '#f8fafc';
        html.style.colorScheme = isDark ? 'dark' : 'light';

        // Notify charts if any
        window.dispatchEvent(new CustomEvent('themeChanged', { detail: { isDark } }));
    }
</script>

