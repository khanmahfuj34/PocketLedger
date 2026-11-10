<!DOCTYPE html>
<html lang="en">
<head>
    <title>PocketLedger - Create Account</title>
    <x-head-meta />
    <style>
        @keyframes floatSlow {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-12px) rotate(2deg); }
        }
        @keyframes floatReverse {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(10px) rotate(-3deg); }
        }
        @keyframes pulseGlow {
            0%, 100% { opacity: 0.35; transform: scale(1); }
            50% { opacity: 0.65; transform: scale(1.08); }
        }
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(16px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-float-slow {
            animation: floatSlow 5s ease-in-out infinite;
        }
        .animate-float-reverse {
            animation: floatReverse 4.2s ease-in-out infinite;
        }
        .animate-pulse-glow {
            animation: pulseGlow 7s ease-in-out infinite;
        }
        .animate-fade-in-up {
            animation: fadeInUp 0.5s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        .input-glow:focus-within {
            box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.15);
        }
    </style>
</head>
<body class="bg-slate-50 dark:bg-slate-950 text-slate-800 dark:text-slate-100 antialiased min-h-screen">

    <div class="min-h-screen flex flex-col lg:grid lg:grid-cols-12 bg-white dark:bg-slate-950 transition-colors">

        <!-- ======================================================== -->
        <!-- LEFT HERO / ILLUSTRATION PANEL (Visible on lg: screens)  -->
        <!-- ======================================================== -->
        <div class="hidden lg:flex lg:col-span-5 xl:col-span-6 bg-gradient-to-br from-emerald-700 via-emerald-800 to-teal-950 text-white relative overflow-hidden flex-col justify-between p-10 xl:p-14">
            
            <!-- Ambient Glow Orbs -->
            <div class="absolute -top-24 -left-24 w-96 h-96 rounded-full bg-emerald-400/20 blur-3xl pointer-events-none animate-pulse-glow"></div>
            <div class="absolute -bottom-24 -right-24 w-96 h-96 rounded-full bg-teal-400/20 blur-3xl pointer-events-none animate-pulse-glow" style="animation-delay: -3.5s;"></div>

            <!-- Brand Header -->
            <div class="relative z-10 flex items-center gap-3">
                <div class="w-11 h-11 rounded-2xl bg-white/10 backdrop-blur-md border border-white/20 flex items-center justify-center text-white shadow-lg">
                    <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="2" y="5" width="20" height="15" rx="3"/>
                        <path d="M2 9h20"/>
                        <circle cx="16" cy="14" r="1.5" fill="currentColor"/>
                    </svg>
                </div>
                <span class="text-2xl font-black tracking-tight text-white">
                    Pocket<span class="text-emerald-300">Ledger</span>
                </span>
            </div>

            <!-- Animated Illustration -->
            <div class="relative z-10 my-auto py-12 flex flex-col items-center justify-center">
                
                <div class="relative w-80 h-72 flex items-center justify-center">
                    
                    <div class="absolute inset-0 rounded-full bg-emerald-400/20 blur-2xl animate-pulse-glow"></div>

                    <!-- Floating Coins -->
                    <div class="absolute -top-4 left-6 w-12 h-12 rounded-full bg-gradient-to-tr from-amber-400 to-yellow-200 border-2 border-white shadow-lg flex items-center justify-center text-amber-900 font-black text-lg animate-float-slow">
                        ৳
                    </div>
                    <div class="absolute bottom-6 right-6 w-10 h-10 rounded-full bg-gradient-to-tr from-amber-400 to-yellow-100 border-2 border-white shadow-md flex items-center justify-center text-amber-900 font-black text-sm animate-float-reverse" style="animation-delay: -1.5s;">
                        ৳
                    </div>

                    <!-- Main Floating Growth Card -->
                    <div class="relative w-68 h-44 rounded-3xl bg-gradient-to-br from-white/20 via-white/10 to-transparent border border-white/30 backdrop-blur-xl shadow-2xl p-6 flex flex-col justify-between transform rotate-2 animate-float-slow">
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-bold tracking-wider uppercase text-emerald-100">Savings Goal</span>
                            <span class="text-xs font-bold text-emerald-300 bg-white/10 px-2 py-0.5 rounded-full">Active</span>
                        </div>

                        <div>
                            <div class="text-[10px] text-emerald-100/70 uppercase tracking-widest font-semibold">Target Saved</div>
                            <div class="text-2xl font-black text-white tracking-tight mt-0.5">৳ 85,000 / ৳ 100k</div>
                            <!-- Mini Progress Bar -->
                            <div class="w-full bg-white/20 h-2 rounded-full mt-2 overflow-hidden">
                                <div class="bg-gradient-to-r from-emerald-300 to-teal-200 h-full rounded-full" style="width: 85%;"></div>
                            </div>
                        </div>

                        <div class="flex items-center justify-between text-[11px] text-emerald-100/80">
                            <span>85% Completed</span>
                            <span>🎉 Almost there</span>
                        </div>
                    </div>

                    <!-- Mini Floating Shield Badge -->
                    <div class="absolute -bottom-4 -left-2 bg-white/95 text-slate-800 rounded-2xl p-3 shadow-xl border border-white/50 flex items-center gap-3 animate-float-slow" style="animation-delay: -2.5s;">
                        <div class="w-8 h-8 rounded-xl bg-emerald-500 text-white flex items-center justify-center font-bold text-xs shadow-sm">
                            🔒
                        </div>
                        <div>
                            <div class="text-xs font-bold text-slate-900">Zero Leakage</div>
                            <div class="text-[10px] text-emerald-600 font-semibold">Private & Safe</div>
                        </div>
                    </div>

                </div>

                <div class="text-center max-w-sm mt-6">
                    <h2 class="text-xl font-black text-white">Your Path to Financial Clarity</h2>
                    <p class="text-xs text-emerald-100/80 mt-1.5 leading-relaxed">
                        Join smart trackers who effortlessly monitor expenses, reach targets, and build wealth every single day.
                    </p>
                </div>
            </div>

            <!-- Bottom Badges -->
            <div class="relative z-10 flex items-center justify-between text-xs text-emerald-200/70 border-t border-white/10 pt-4">
                <span>© 2026 PocketLedger</span>
                <div class="flex items-center gap-4">
                    <span>🆓 100% Free Account</span>
                    <span>📱 iPhone Optimized</span>
                </div>
            </div>

        </div>

        <!-- ======================================================== -->
        <!-- RIGHT AUTH FORM PANEL                                    -->
        <!-- ======================================================== -->
        <div class="flex-1 lg:col-span-7 xl:col-span-6 flex flex-col justify-between p-4 sm:p-10 lg:p-14 xl:p-16 pt-[max(1rem,env(safe-area-inset-top,1rem))] pb-[max(1rem,env(safe-area-inset-bottom,1rem))]">
            
            <!-- Mobile Brand Bar & Theme Toggle -->
            <div class="flex items-center justify-between mb-4">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-2.5 lg:hidden ios-press">
                    <div class="w-9 h-9 rounded-2xl bg-gradient-to-tr from-emerald-600 to-teal-500 flex items-center justify-center text-white shadow-sm shadow-emerald-500/25">
                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3">
                            <rect x="2" y="5" width="20" height="15" rx="3"/>
                            <path d="M2 9h20"/>
                            <circle cx="16" cy="14" r="1.5" fill="currentColor"/>
                        </svg>
                    </div>
                    <span class="text-xl font-black tracking-tight text-slate-900 dark:text-white">
                        Pocket<span class="text-emerald-500">Ledger</span>
                    </span>
                </a>

                <div class="ml-auto flex items-center gap-2">
                    <x-theme-toggle />
                </div>
            </div>

            <!-- Mobile Animated Growth Element -->
            <div class="lg:hidden relative flex items-center justify-center py-2 mb-4 overflow-visible">
                <div class="absolute w-44 h-20 rounded-full bg-emerald-200/50 dark:bg-emerald-900/30 blur-2xl pointer-events-none animate-pulse-glow"></div>

                <div class="relative w-64 h-24 flex items-center justify-center">
                    <div class="absolute w-52 h-18 rounded-2xl bg-emerald-100/70 dark:bg-emerald-950/40 border border-emerald-200/80 dark:border-emerald-800/80 shadow-xs transform -rotate-4"></div>

                    <div class="relative w-52 h-18 rounded-2xl bg-gradient-to-br from-emerald-500 to-emerald-700 text-white shadow-lg shadow-emerald-500/25 p-2.5 flex flex-col justify-between transform rotate-2 animate-float-slow">
                        <div class="flex items-center justify-between text-[10px] font-bold">
                            <span>New Ledger</span>
                            <span class="text-emerald-200">🚀 Ready</span>
                        </div>
                        <div class="text-sm font-black tracking-tight">Setup in 30 Seconds</div>
                        <div class="w-full bg-white/20 h-1 rounded-full overflow-hidden">
                            <div class="bg-white h-full rounded-full" style="width: 100%;"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Container -->
            <div class="max-w-md w-full mx-auto animate-fade-in-up">

                <!-- Header Title -->
                <div class="mb-5 sm:mb-6">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-emerald-50 dark:bg-emerald-950/60 text-emerald-700 dark:text-emerald-300 mb-2.5 border border-emerald-100 dark:border-emerald-800">
                        ✨ Start for Free
                    </span>
                    <h1 class="text-2xl sm:text-3xl font-black text-slate-900 dark:text-white tracking-tight">Create Account</h1>
                    <p class="text-xs sm:text-sm text-slate-500 dark:text-slate-400 mt-0.5 font-medium">Set up your personal PocketLedger tracker</p>
                </div>

                <!-- Validation Errors Alert -->
                @if ($errors->any())
                    <div class="mb-5 p-4 rounded-3xl bg-rose-50 dark:bg-rose-950/40 border border-rose-200 dark:border-rose-800 text-rose-800 dark:text-rose-300 shadow-xs space-y-1">
                        <div class="flex items-center gap-2 font-bold text-sm">
                            <svg class="w-4 h-4 text-rose-600 dark:text-rose-400 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                <circle cx="12" cy="12" r="10"></circle>
                                <line x1="12" y1="8" x2="12" y2="12"></line>
                                <line x1="12" y1="16" x2="12.01" y2="16"></line>
                            </svg>
                            <span>Please fix the following issues:</span>
                        </div>
                        <ul class="list-disc list-inside text-xs space-y-0.5 pl-6 text-rose-700 dark:text-rose-400">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Register Form -->
                <form action="{{ route('register.submit') }}" method="POST" class="space-y-3.5 sm:space-y-4" id="registerForm">
                    @csrf

                    <!-- Name Field -->
                    <div>
                        <label for="name" class="block text-xs font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider mb-1.5">
                            Full Name
                        </label>
                        <div class="relative rounded-2xl border @error('name') border-rose-400 ring-2 ring-rose-100 @else border-slate-200 dark:border-slate-700 @enderror input-glow bg-slate-50/50 dark:bg-slate-800/80 hover:bg-white dark:hover:bg-slate-800 transition-all">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>
                            </div>
                            <input
                                type="text"
                                id="name"
                                name="name"
                                value="{{ old('name') }}"
                                placeholder="e.g. John Doe"
                                required
                                autofocus
                                class="w-full pl-11 pr-4 py-3 rounded-2xl text-sm font-semibold text-slate-800 dark:text-white bg-transparent focus:outline-none placeholder:text-slate-400 dark:placeholder:text-slate-500"
                            >
                        </div>
                    </div>

                    <!-- Email Field -->
                    <div>
                        <label for="email" class="block text-xs font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider mb-1.5">
                            Email Address
                        </label>
                        <div class="relative rounded-2xl border @error('email') border-rose-400 ring-2 ring-rose-100 @else border-slate-200 dark:border-slate-700 @enderror input-glow bg-slate-50/50 dark:bg-slate-800/80 hover:bg-white dark:hover:bg-slate-800 transition-all">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                    <polyline points="22,6 12,13 2,6"></polyline>
                                </svg>
                            </div>
                            <input
                                type="email"
                                id="email"
                                name="email"
                                value="{{ old('email') }}"
                                placeholder="name@example.com"
                                required
                                class="w-full pl-11 pr-4 py-3 rounded-2xl text-sm font-semibold text-slate-800 dark:text-white bg-transparent focus:outline-none placeholder:text-slate-400 dark:placeholder:text-slate-500"
                            >
                        </div>
                    </div>

                    <!-- Password Field -->
                    <div>
                        <label for="password" class="block text-xs font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider mb-1.5">
                            Password
                        </label>
                        <div class="relative rounded-2xl border @error('password') border-rose-400 ring-2 ring-rose-100 @else border-slate-200 dark:border-slate-700 @enderror input-glow bg-slate-50/50 dark:bg-slate-800/80 hover:bg-white dark:hover:bg-slate-800 transition-all">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                    <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                </svg>
                            </div>
                            <input
                                type="password"
                                id="password"
                                name="password"
                                placeholder="At least 8 characters"
                                required
                                oninput="checkPasswordStrength(this.value)"
                                class="w-full pl-11 pr-11 py-3 rounded-2xl text-sm font-semibold text-slate-800 dark:text-white bg-transparent focus:outline-none placeholder:text-slate-400 dark:placeholder:text-slate-500"
                            >
                            <button
                                type="button"
                                onclick="togglePasswordVisibility('password', this)"
                                class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-slate-600 dark:hover:text-slate-300 transition-colors"
                                aria-label="Toggle password visibility"
                            >
                                <svg class="w-5 h-5 icon-eye" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                                <svg class="w-5 h-5 icon-eye-off hidden" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path>
                                    <line x1="1" y1="1" x2="23" y2="23"></line>
                                </svg>
                            </button>
                        </div>

                        <!-- Live Password Strength Indicator -->
                        <div class="mt-2 space-y-1">
                            <div class="grid grid-cols-4 gap-1.5 h-1.5">
                                <div id="bar1" class="rounded-full bg-slate-200 dark:bg-slate-700 transition-colors"></div>
                                <div id="bar2" class="rounded-full bg-slate-200 dark:bg-slate-700 transition-colors"></div>
                                <div id="bar3" class="rounded-full bg-slate-200 dark:bg-slate-700 transition-colors"></div>
                                <div id="bar4" class="rounded-full bg-slate-200 dark:bg-slate-700 transition-colors"></div>
                            </div>
                            <div class="flex justify-between text-[11px] font-medium text-slate-400">
                                <span>Strength: <strong id="strengthLabel" class="text-slate-600 dark:text-slate-300 font-semibold">None</strong></span>
                                <span>Min 8 characters</span>
                            </div>
                        </div>
                    </div>

                    <!-- Confirm Password Field -->
                    <div>
                        <label for="password_confirmation" class="block text-xs font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider mb-1.5">
                            Confirm Password
                        </label>
                        <div class="relative rounded-2xl border border-slate-200 dark:border-slate-700 input-glow bg-slate-50/50 dark:bg-slate-800/80 hover:bg-white dark:hover:bg-slate-800 transition-all">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                                </svg>
                            </div>
                            <input
                                type="password"
                                id="password_confirmation"
                                name="password_confirmation"
                                placeholder="Re-enter password"
                                required
                                class="w-full pl-11 pr-11 py-3 rounded-2xl text-sm font-semibold text-slate-800 dark:text-white bg-transparent focus:outline-none placeholder:text-slate-400 dark:placeholder:text-slate-500"
                            >
                            <button
                                type="button"
                                onclick="togglePasswordVisibility('password_confirmation', this)"
                                class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-slate-600 dark:hover:text-slate-300 transition-colors"
                                aria-label="Toggle password visibility"
                            >
                                <svg class="w-5 h-5 icon-eye" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                                <svg class="w-5 h-5 icon-eye-off hidden" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path>
                                    <line x1="1" y1="1" x2="23" y2="23"></line>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Submit Register Button -->
                    <button
                        type="submit"
                        onclick="if (typeof triggerHaptic === 'function') triggerHaptic(15);"
                        class="w-full py-4 px-6 rounded-2xl bg-emerald-500 hover:bg-emerald-600 active:scale-[0.99] text-white font-black text-sm shadow-lg shadow-emerald-500/30 hover:shadow-xl hover:shadow-emerald-500/35 transition-all flex items-center justify-center gap-2 group cursor-pointer ios-press"
                    >
                        <span>Create Free Account</span>
                        <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12 5 19 12 12 19"></polyline>
                        </svg>
                    </button>

                </form>

                <!-- Link to Login -->
                <div class="text-center mt-6 pt-5 border-t border-slate-100 dark:border-slate-800">
                    <p class="text-xs sm:text-sm text-slate-500 dark:text-slate-400 font-medium">
                        Already have an account?
                        <a href="{{ route('login') }}" class="font-bold text-emerald-600 dark:text-emerald-400 hover:text-emerald-700 ml-1 transition-colors">
                            Sign In
                        </a>
                    </p>
                </div>

            </div>

            <!-- Mobile Footer -->
            <div class="text-center text-xs text-slate-400 dark:text-slate-500 mt-6 lg:hidden">
                © 2026 PocketLedger • Secure Financial Management
            </div>
            <div class="hidden lg:block"></div>

        </div>

    </div>

    <!-- Interactive JavaScript -->
    <script>
        function togglePasswordVisibility(fieldId, button) {
            if (typeof triggerHaptic === 'function') triggerHaptic(8);
            const field = document.getElementById(fieldId);
            const eyeOpen = button.querySelector('.icon-eye');
            const eyeOff = button.querySelector('.icon-eye-off');

            if (field.type === 'password') {
                field.type = 'text';
                eyeOpen.classList.add('hidden');
                eyeOff.classList.remove('hidden');
            } else {
                field.type = 'password';
                eyeOpen.classList.remove('hidden');
                eyeOff.classList.add('hidden');
            }
        }

        function checkPasswordStrength(password) {
            const bar1 = document.getElementById('bar1');
            const bar2 = document.getElementById('bar2');
            const bar3 = document.getElementById('bar3');
            const bar4 = document.getElementById('bar4');
            const label = document.getElementById('strengthLabel');

            let score = 0;
            if (password.length >= 8) score++;
            if (password.match(/[a-z]/) && password.match(/[A-Z]/)) score++;
            if (password.match(/\d/)) score++;
            if (password.match(/[^a-zA-Z\d]/)) score++;

            // Reset bars
            [bar1, bar2, bar3, bar4].forEach(bar => {
                bar.className = 'rounded-full bg-slate-200 dark:bg-slate-700 transition-colors';
            });

            if (password.length === 0) {
                label.textContent = 'None';
                label.className = 'text-slate-600 dark:text-slate-400 font-semibold';
                return;
            }

            if (score <= 1) {
                bar1.className = 'rounded-full bg-rose-500 transition-colors';
                label.textContent = 'Weak';
                label.className = 'text-rose-500 font-semibold';
            } else if (score === 2) {
                bar1.className = 'rounded-full bg-amber-400 transition-colors';
                bar2.className = 'rounded-full bg-amber-400 transition-colors';
                label.textContent = 'Fair';
                label.className = 'text-amber-500 font-semibold';
            } else if (score === 3) {
                bar1.className = 'rounded-full bg-blue-500 transition-colors';
                bar2.className = 'rounded-full bg-blue-500 transition-colors';
                bar3.className = 'rounded-full bg-blue-500 transition-colors';
                label.textContent = 'Good';
                label.className = 'text-blue-500 font-semibold';
            } else {
                [bar1, bar2, bar3, bar4].forEach(bar => {
                    bar.className = 'rounded-full bg-emerald-500 transition-colors';
                });
                label.textContent = 'Strong';
                label.className = 'text-emerald-600 dark:text-emerald-400 font-semibold';
            }
        }
    </script>

</body>
</html>
