<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin Login — myapp</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/css/admin.css', 'resources/js/app.js'])
</head>
<body class="h-full font-sans antialiased text-slate-900 overflow-x-hidden relative selection:bg-[#240A89] selection:text-white admin-login-canvas">

    <!-- Whole Screen Minimal White Doodle Background -->
    <div class="fixed inset-0 pointer-events-none z-0">
        <!-- Minimal White Doodle Image -->
        <div class="absolute inset-0 bg-cover bg-center bg-no-repeat opacity-95 transition-all duration-700"
             style="background-image: url('{{ asset('images/minimal-white-bg.jpg') }}');">
        </div>

        <!-- Subtle Ambient Lighting Gradients in Brand #240A89 -->
        <div class="absolute inset-0 bg-gradient-to-tr from-white/90 via-white/70 to-transparent"></div>
        <div class="absolute -top-32 -left-32 w-[420px] h-[420px] rounded-full bg-[#ECE8FE]/80 blur-3xl admin-halo-anim"></div>
        <div class="absolute -bottom-32 right-1/4 w-[520px] h-[520px] rounded-full bg-[#DCD4FD]/45 blur-3xl admin-halo-anim" style="animation-delay: -2.5s;"></div>
    </div>

    <!-- Main Viewport Container -->
    <main class="relative z-10 min-h-screen flex items-center justify-center p-4 sm:p-6 lg:p-12">
        <div class="w-full max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-16 items-center">

            <!-- LEFT COLUMN: Compact, Minimal White Admin Login Card -->
            <section class="lg:col-span-5 xl:col-span-4 flex justify-center lg:justify-start order-2 lg:order-1">
                <div class="w-full max-w-md admin-glass-card p-6 sm:p-8 relative overflow-hidden group">
                    
                    <!-- Decorative Top Accent Line in Brand Color #240A89 -->
                    <div class="absolute top-0 inset-x-0 h-[3px] bg-gradient-to-r from-[#240A89] via-[#5527DE] to-[#9C80F0]"></div>
                    
                    <!-- Card Header -->
                    <div class="mb-6">
                        <div class="flex items-center justify-between mb-4">
                            <span class="admin-brand-badge">
                                <span class="w-1.5 h-1.5 rounded-full bg-[#240A89] animate-pulse"></span>
                                ADMIN PORTAL
                            </span>
                            <span class="text-xs text-slate-500 font-mono tracking-wider">v2.4.0</span>
                        </div>
                        <h1 class="text-2xl sm:text-3xl font-bold tracking-tight text-slate-950 mb-2">
                            Welcome Back
                        </h1>
                        <p class="text-sm text-slate-600">
                            Sign in to manage your <strong class="text-[#240A89] font-semibold">myapp</strong> admin workspace.
                        </p>
                    </div>

                    <!-- Status Notification Alert -->
                    @if (session('status'))
                        <div class="mb-5 p-3.5 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs flex items-center gap-2.5">
                            <svg class="w-4 h-4 shrink-0 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span>{{ session('status') }}</span>
                        </div>
                    @endif

                    <!-- Error Alert -->
                    @if ($errors->any())
                        <div class="mb-5 p-3.5 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 text-xs flex items-start gap-2.5">
                            <svg class="w-4 h-4 shrink-0 text-rose-600 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                            <div>
                                @foreach ($errors->all() as $error)
                                    <p>{{ $error }}</p>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Login Form -->
                    <form action="{{ route('admin.login.submit') }}" method="POST" class="space-y-4" id="loginForm">
                        @csrf

                        <!-- Email Input -->
                        <div>
                            <label for="email" class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-1.5">
                                Administrator Email
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                                    </svg>
                                </div>
                                <input id="email" 
                                       type="email" 
                                       name="email" 
                                       value="{{ old('email', 'admin@myapp.com') }}" 
                                       required 
                                       autocomplete="email" 
                                       autofocus
                                       placeholder="admin@myapp.com"
                                       class="admin-input-field">
                            </div>
                        </div>

                        <!-- Password Input -->
                        <div>
                            <div class="flex items-center justify-between mb-1.5">
                                <label for="password" class="block text-xs font-semibold text-slate-700 uppercase tracking-wider">
                                    Password
                                </label>
                                <span class="text-xs text-[#240A89] hover:underline font-medium transition-colors cursor-pointer" onclick="toggleDemoFill()">
                                    Quick Fill
                                </span>
                            </div>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                    </svg>
                                </div>
                                <input id="password" 
                                       type="password" 
                                       name="password" 
                                       value="password"
                                       required 
                                       autocomplete="current-password"
                                       placeholder="••••••••"
                                       class="admin-input-field pr-11">
                                <button type="button" 
                                        id="togglePasswordBtn" 
                                        aria-label="Toggle password visibility"
                                        class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-slate-700 transition-colors">
                                    <svg id="eyeIcon" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <!-- Remember Me & Help -->
                        <div class="flex items-center justify-between text-xs pt-1">
                            <label class="flex items-center gap-2 cursor-pointer text-slate-700 hover:text-slate-900 select-none">
                                <input type="checkbox" 
                                       name="remember" 
                                       id="remember" 
                                       checked
                                       class="admin-checkbox">
                                <span>Remember session</span>
                            </label>
                            <span class="text-slate-500 hover:text-[#240A89] cursor-pointer transition-colors">
                                Reset Password?
                            </span>
                        </div>

                        <!-- Submit Button in Brand #240A89 -->
                        <div class="pt-2">
                            <button type="submit" 
                                    id="submitBtn"
                                    class="admin-btn-primary w-full">
                                <span>Sign In to Admin</span>
                                <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </button>
                        </div>
                    </form>

                    <!-- Quick Demo Credentials Box -->
                    <div class="mt-5 pt-4 border-t border-slate-100">
                        <button type="button" 
                                onclick="toggleDemoFill()"
                                class="w-full py-2 px-3 rounded-xl bg-slate-50 hover:bg-slate-100 border border-slate-200 text-slate-700 hover:text-black text-xs flex items-center justify-between transition-colors">
                            <span class="flex items-center gap-2">
                                <span class="text-[#240A89]">⚡</span>
                                <span>Default Admin: <strong class="text-slate-900 font-mono">admin@myapp.com</strong></span>
                            </span>
                            <span class="text-[11px] text-[#240A89] font-medium underline">Auto-fill</span>
                        </button>
                    </div>

                    <!-- Security Badge Footer -->
                    <div class="mt-4 flex items-center justify-center gap-2 text-[11px] text-slate-400">
                        <svg class="w-3.5 h-3.5 text-[#240A89]" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 1.944A11.954 11.954 0 012.166 5C2.056 5.649 2 6.319 2 7c0 5.225 3.34 9.67 8 11.317C14.66 16.67 18 12.225 18 7c0-.682-.057-1.35-.166-2.001A11.954 11.954 0 0110 1.944zM11 14a1 1 0 11-2 0 1 1 0 012 0zm0-7a1 1 0 10-2 0v3a1 1 0 102 0V7z" clip-rule="evenodd" />
                        </svg>
                        <span>256-Bit SSL Encrypted Admin Portal</span>
                    </div>

                </div>
            </section>

            <!-- RIGHT COLUMN: HUGE High-Impact myapp Logo on Minimal White Canvas -->
            <section class="lg:col-span-7 xl:col-span-8 flex flex-col items-center justify-center text-center order-1 lg:order-2 py-6">
                
                <!-- Logo Frame Container -->
                <div class="relative group">
                    
                    <!-- Ambient Glow in Brand Color #240A89 -->
                    <div class="absolute inset-0 -m-8 rounded-full bg-[#240A89]/15 blur-3xl opacity-75 group-hover:opacity-100 transition-opacity duration-700 pointer-events-none admin-halo-anim"></div>
                    
                    <!-- Huge Logo Presentation Card -->
                    <div class="relative admin-logo-frame p-4 sm:p-6 lg:p-8 admin-float-anim">
                        <img src="{{ asset('images/myapp-logo.jpg') }}" 
                             alt="myapp brand logo" 
                             id="hugeMyAppLogo"
                             class="w-64 h-64 sm:w-80 sm:h-80 md:w-96 md:h-96 lg:w-[420px] lg:h-[420px] xl:w-[480px] xl:h-[480px] object-contain rounded-2xl drop-shadow-[0_20px_40px_rgba(36,10,137,0.22)] transition-transform duration-500 group-hover:scale-[1.03]">
                    </div>

                    <!-- Floating Mini-Badge on Logo -->
                    <div class="absolute -bottom-4 right-4 sm:right-8 px-4 py-1.5 rounded-full bg-white/95 border border-[#240A89]/20 backdrop-blur-xl text-xs font-semibold text-[#240A89] shadow-lg flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-ping"></span>
                        <span>Enterprise Cloud v2.4</span>
                    </div>
                </div>

                <!-- Showcase Text & Badges -->
                <div class="mt-8 max-w-xl mx-auto px-4">
                    <h2 class="text-xl sm:text-2xl font-bold text-slate-950 tracking-tight">
                        Next-Generation Intelligent Admin Suite
                    </h2>
                    <p class="mt-2 text-sm sm:text-base text-slate-600 leading-relaxed">
                        Precision administration, real-time metrics, and hyper-scalable cloud controls crafted for <strong class="text-[#240A89] font-bold">myapp</strong>.
                    </p>

                    <!-- Real-time Status Indicators in Brand Shades -->
                    <div class="mt-5 flex flex-wrap items-center justify-center gap-2.5 sm:gap-3 text-xs text-slate-700">
                        <span class="px-3.5 py-1.5 rounded-full bg-white/90 border border-slate-200 shadow-xs flex items-center gap-1.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                            All Systems Operational
                        </span>
                        <span class="px-3.5 py-1.5 rounded-full bg-white/90 border border-slate-200 shadow-xs flex items-center gap-1.5">
                            <span class="text-[#240A89] font-bold">⚡</span>
                            Ultra-low Latency (14ms)
                        </span>
                        <span class="px-3.5 py-1.5 rounded-full bg-white/90 border border-slate-200 shadow-xs flex items-center gap-1.5">
                            <span class="text-[#240A89]">🛡️</span>
                            Zero-Trust RBAC
                        </span>
                    </div>
                </div>

            </section>

        </div>
    </main>

    <!-- Client-side Interactive Logic -->
    <script>
        // Password toggle visibility
        const toggleBtn = document.getElementById('togglePasswordBtn');
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');

        if (toggleBtn && passwordInput) {
            toggleBtn.addEventListener('click', () => {
                const isPassword = passwordInput.getAttribute('type') === 'password';
                passwordInput.setAttribute('type', isPassword ? 'text' : 'password');
                
                if (isPassword) {
                    eyeIcon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18" />`;
                } else {
                    eyeIcon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />`;
                }
            });
        }

        // Quick demo credential autofill
        function toggleDemoFill() {
            const email = document.getElementById('email');
            const pass = document.getElementById('password');
            if (email && pass) {
                email.value = 'admin@myapp.com';
                pass.value = 'password';
                
                // Visual feedback highlight
                [email, pass].forEach(input => {
                    input.classList.add('ring-2', 'ring-[#240A89]', 'border-[#240A89]');
                    setTimeout(() => {
                        input.classList.remove('ring-2', 'ring-[#240A89]');
                    }, 800);
                });
            }
        }
    </script>
</body>
</html>
