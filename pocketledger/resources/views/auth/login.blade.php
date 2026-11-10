<!DOCTYPE html>
<html lang="en">
<head>
    <title>PocketLedger - Login</title>
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
            
            <!-- Background Ambient Glow Orbs -->
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

            <!-- Animated Illustration Centerpiece -->
            <div class="relative z-10 my-auto py-12 flex flex-col items-center justify-center">
                
                <div class="relative w-80 h-72 flex items-center justify-center">
                    
                    <!-- Glow Behind Glass Card -->
                    <div class="absolute inset-0 rounded-full bg-emerald-400/20 blur-2xl animate-pulse-glow"></div>

                    <!-- Floating Back Card -->
                    <div class="absolute w-64 h-40 rounded-3xl bg-gradient-to-tr from-emerald-600/60 to-teal-500/40 border border-white/20 backdrop-blur-lg shadow-2xl transform -rotate-6 translate-y-3"></div>

                    <!-- Main Floating Credit / Debit Card -->
                    <div class="relative w-68 h-42 rounded-3xl bg-gradient-to-br from-white/20 via-white/10 to-transparent border border-white/30 backdrop-blur-xl shadow-2xl p-6 flex flex-col justify-between transform rotate-3 animate-float-slow">
                        
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <div class="w-7 h-7 rounded-lg bg-emerald-400/30 flex items-center justify-center">
                                    <svg class="w-4 h-4 text-emerald-200" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <rect x="2" y="5" width="20" height="15" rx="3"/>
                                        <path d="M2 9h20"/>
                                    </svg>
                                </div>
                                <span class="text-xs font-bold tracking-wider uppercase text-emerald-100">Pocket Pass</span>
                            </div>
                            <span class="text-xs font-black tracking-widest text-white/80">VISA</span>
                        </div>

                        <div>
                            <div class="text-[10px] text-emerald-100/70 uppercase tracking-widest font-semibold">Available Balance</div>
                            <div class="text-2xl font-black text-white tracking-tight mt-0.5">৳ 128,450.00</div>
                        </div>

                        <div class="flex items-center justify-between text-[11px] text-emerald-100/80 font-mono">
                            <span>•••• 4829</span>
                            <span>12/28</span>
                        </div>
                    </div>

                    <!-- Floating Mini Widget: Budget On Track -->
                    <div class="absolute -bottom-4 -left-4 bg-white/95 text-slate-800 rounded-2xl p-3 shadow-xl border border-white/50 flex items-center gap-3 animate-float-slow" style="animation-delay: -2s;">
                        <div class="w-8 h-8 rounded-xl bg-emerald-500 text-white flex items-center justify-center font-bold text-xs shadow-sm">
                            ✓
                        </div>
                        <div>
                            <div class="text-xs font-bold text-slate-900">Budget on Track</div>
                            <div class="text-[10px] text-emerald-600 font-semibold">+18.4% saved this month</div>
                        </div>
                    </div>

                </div>

                <div class="text-center max-w-sm mt-6">
                    <h2 class="text-xl font-black text-white">Smart Financial Tracking</h2>
                    <p class="text-xs text-emerald-100/80 mt-1.5 leading-relaxed">
                        Effortlessly log expenses, analyze trends, and stay in complete control of your financial freedom.
                    </p>
                </div>
            </div>

            <!-- Bottom Badges / Trust Info -->
            <div class="relative z-10 flex items-center justify-between text-xs text-emerald-200/70 border-t border-white/10 pt-4">
                <span>© 2026 PocketLedger</span>
                <div class="flex items-center gap-4">
                    <span>🔒 256-bit Encryption</span>
                    <span>⚡ Real-Time Sync</span>
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

            <!-- Mobile Animated Finance Illustration (Compact, iPhone-optimized) -->
            <div class="lg:hidden relative flex items-center justify-center py-2 mb-6 overflow-visible">
                <div class="absolute w-48 h-24 rounded-full bg-emerald-200/50 dark:bg-emerald-900/30 blur-2xl pointer-events-none animate-pulse-glow"></div>

                <div class="relative w-64 h-28 flex items-center justify-center">
                    <div class="absolute w-52 h-20 rounded-2xl bg-emerald-100/70 dark:bg-emerald-950/40 border border-emerald-200/80 dark:border-emerald-800/80 shadow-xs transform -rotate-6"></div>

                    <div class="relative w-52 h-20 rounded-2xl bg-gradient-to-br from-emerald-500 to-emerald-700 text-white shadow-lg shadow-emerald-500/25 p-3 flex flex-col justify-between transform rotate-2 animate-float-slow">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-1.5">
                                <div class="w-5 h-5 rounded-md bg-white/20 flex items-center justify-center">
                                    <svg class="w-3 h-3 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3">
                                        <rect x="2" y="5" width="20" height="15" rx="3"/>
                                        <path d="M2 9h20"/>
                                    </svg>
                                </div>
                                <span class="text-[10px] font-bold tracking-wider uppercase text-emerald-100">Pocket Card</span>
                            </div>
                            <span class="relative flex h-2 w-2">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-200 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2 w-2 bg-white"></span>
                            </span>
                        </div>
                        <div>
                            <span class="text-[9px] uppercase tracking-wider text-emerald-200 font-semibold">Total Savings</span>
                            <div class="text-base font-black text-white tracking-tight">৳ 38,500.00</div>
                        </div>
                    </div>

                    <div class="absolute -top-1.5 right-1 w-8 h-8 rounded-full bg-gradient-to-tr from-amber-400 to-yellow-200 border-2 border-white shadow-md flex items-center justify-center text-amber-900 font-black text-xs animate-float-reverse">
                        ৳
                    </div>

                    <div class="absolute -bottom-2 left-1 bg-white/95 dark:bg-slate-800 text-slate-800 dark:text-slate-100 rounded-xl py-1 px-2.5 shadow-md border border-slate-100 dark:border-slate-700 flex items-center gap-1.5 animate-float-slow" style="animation-delay: -1.5s;">
                        <span class="text-xs">📈</span>
                        <span class="text-[10px] font-bold text-emerald-600 dark:text-emerald-400">+18.4%</span>
                    </div>
                </div>
            </div>

            <!-- Form Container -->
            <div class="max-w-md w-full mx-auto animate-fade-in-up">

                <!-- Header Title -->
                <div class="mb-6 sm:mb-8">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-emerald-50 dark:bg-emerald-950/60 text-emerald-700 dark:text-emerald-300 mb-3 border border-emerald-100 dark:border-emerald-800">
                        👋 Welcome Back
                    </span>
                    <h1 class="text-2xl sm:text-3xl font-black text-slate-900 dark:text-white tracking-tight">Login to PocketLedger</h1>
                    <p class="text-xs sm:text-sm text-slate-500 dark:text-slate-400 mt-1 font-medium">Access your personal finance dashboard</p>
                </div>

                <!-- Validation Errors Alert -->
                @if ($errors->any())
                    <div class="mb-6 p-4 rounded-3xl bg-rose-50 dark:bg-rose-950/40 border border-rose-200 dark:border-rose-800 text-rose-800 dark:text-rose-300 shadow-xs space-y-1">
                        <div class="flex items-center gap-2 font-bold text-sm">
                            <svg class="w-4 h-4 text-rose-600 dark:text-rose-400 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                <circle cx="12" cy="12" r="10"></circle>
                                <line x1="12" y1="8" x2="12" y2="12"></line>
                                <line x1="12" y1="16" x2="12.01" y2="16"></line>
                            </svg>
                            <span>Unable to sign in</span>
                        </div>
                        <ul class="list-disc list-inside text-xs space-y-0.5 pl-6 text-rose-700 dark:text-rose-400">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Login Form -->
                <form action="{{ route('login.submit') }}" method="POST" class="space-y-4 sm:space-y-5" id="loginForm">
                    @csrf

                    <!-- Email Field -->
                    <div>
                        <label for="email" class="block text-xs font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider mb-2">
                            Email Address
                        </label>
                        <div class="relative rounded-2xl border @error('email') border-rose-400 ring-2 ring-rose-100 @else border-slate-200 dark:border-slate-700 @enderror input-glow bg-slate-50/50 dark:bg-slate-800/80 hover:bg-white dark:hover:bg-slate-800 transition-all">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
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
                                autofocus
                                class="w-full pl-11 pr-4 py-3.5 rounded-2xl text-sm font-semibold text-slate-800 dark:text-white bg-transparent focus:outline-none placeholder:text-slate-400 dark:placeholder:text-slate-500"
                            >
                        </div>
                    </div>

                    <!-- Password Field -->
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <label for="password" class="block text-xs font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider">
                                Password
                            </label>
                            <a href="#forgot" class="text-xs font-semibold text-emerald-600 dark:text-emerald-400 hover:text-emerald-700 transition-colors">
                                Forgot password?
                            </a>
                        </div>
                        <div class="relative rounded-2xl border @error('password') border-rose-400 ring-2 ring-rose-100 @else border-slate-200 dark:border-slate-700 @enderror input-glow bg-slate-50/50 dark:bg-slate-800/80 hover:bg-white dark:hover:bg-slate-800 transition-all">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                    <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                </svg>
                            </div>
                            <input
                                type="password"
                                id="password"
                                name="password"
                                placeholder="••••••••"
                                required
                                class="w-full pl-11 pr-11 py-3.5 rounded-2xl text-sm font-semibold text-slate-800 dark:text-white bg-transparent focus:outline-none placeholder:text-slate-400 dark:placeholder:text-slate-500"
                            >
                            <button
                                type="button"
                                onclick="togglePasswordVisibility('password', this)"
                                class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-slate-600 dark:hover:text-slate-300 transition-colors"
                            >
                                <svg class="w-5 h-5 icon-eye" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                                <svg class="w-5 h-5 icon-eye-off hidden" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path>
                                    <line x1="1" y1="1" x2="23" y2="23"></line>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center justify-between pt-1">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input
                                type="checkbox"
                                name="remember"
                                class="w-4 h-4 rounded-md border-slate-300 text-emerald-600 focus:ring-emerald-500/20 cursor-pointer"
                            >
                            <span class="text-xs font-medium text-slate-600 dark:text-slate-400">Remember for 30 days</span>
                        </label>
                    </div>

                    <!-- Animated Sign In Button -->
                    <button
                        type="submit"
                        id="submitBtn"
                        onclick="if (typeof triggerHaptic === 'function') triggerHaptic(15);"
                        class="w-full py-4 px-6 rounded-2xl bg-emerald-500 hover:bg-emerald-600 text-white font-black text-sm shadow-lg shadow-emerald-500/30 hover:shadow-xl hover:shadow-emerald-500/35 transition-all flex items-center justify-center gap-2 group cursor-pointer ios-press"
                    >
                        <span>Sign In to Account</span>
                        <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12 5 19 12 12 19"></polyline>
                        </svg>
                    </button>

                </form>

                <!-- Link to Register -->
                <div class="text-center mt-6 sm:mt-8 pt-6 border-t border-slate-100 dark:border-slate-800">
                    <p class="text-xs sm:text-sm text-slate-500 dark:text-slate-400 font-medium">
                        Don't have a PocketLedger account?
                        <a href="{{ route('register') }}" class="font-bold text-emerald-600 dark:text-emerald-400 hover:text-emerald-700 ml-1 transition-colors">
                            Create Account
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
    </script>

</body>
</html>
