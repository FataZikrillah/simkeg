<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SIMKEG</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'maroon-soft': '#7B3F61',
                        'beige-bg': '#F5E6D3',
                        'abu-muda': '#8E8E93',
                    }
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');

        body {
            font-family: 'Inter', sans-serif;
        }

        .gradient-bg {
            background: linear-gradient(135deg, #7B3F61 0%, #5B2F49 100%);
        }

        .floating-animation {
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        .slide-in {
            animation: slideIn 0.6s ease-out;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(-30px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
    </style>
</head>

<body class="bg-slate-50 min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-6xl bg-white rounded-3xl shadow-2xl overflow-hidden">
        <div class="grid grid-cols-1 lg:grid-cols-2 min-h-[600px]">
            <!-- Left Side - Branding -->
            <div
                class="gradient-bg p-12 flex flex-col justify-center items-center text-white relative overflow-hidden hidden lg:flex">
                <div class="absolute top-0 left-0 w-full h-full opacity-10">
                    <div class="absolute top-10 left-10 w-32 h-32 bg-white rounded-full blur-3xl"></div>
                    <div class="absolute bottom-20 right-10 w-48 h-48 bg-white rounded-full blur-3xl"></div>
                </div>

                <div class="relative z-10 text-center space-y-6 floating-animation">
                    <div
                        class="w-24 h-24 bg-white/10 rounded-2xl flex items-center justify-center mx-auto backdrop-blur-sm border border-white/20">
                        <img src="{{ asset('images/logo.png') }}" alt="" class="h-20 w-20 object-cover">
                    </div>
                    <h1 class="text-4xl font-extrabold tracking-tight">SIMKEG</h1>
                    <p class="text-lg font-medium text-white/90 max-w-md">Sistem Informasi Manajemen Kegiatan</p>
                    <div class="pt-8 space-y-4">
                        <div class="flex items-center gap-3 text-white/80">
                            <div class="w-10 h-10 bg-white/10 rounded-lg flex items-center justify-center">
                                <i class="fas fa-tasks"></i>
                            </div>
                            <p class="text-sm font-medium">Kelola kegiatan dengan mudah</p>
                        </div>
                        <div class="flex items-center gap-3 text-white/80">
                            <div class="w-10 h-10 bg-white/10 rounded-lg flex items-center justify-center">
                                <i class="fas fa-chart-line"></i>
                            </div>
                            <p class="text-sm font-medium">Pantau progress secara real-time</p>
                        </div>
                        <div class="flex items-center gap-3 text-white/80">
                            <div class="w-10 h-10 bg-white/10 rounded-lg flex items-center justify-center">
                                <i class="fas fa-users"></i>
                            </div>
                            <p class="text-sm font-medium">Kolaborasi tim yang efektif</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side - Login Form -->
            <div class="p-8 sm:p-12 flex flex-col justify-center">
                <div class="max-w-md mx-auto w-full slide-in">
                    <!-- Mobile Logo -->
                    <div class="lg:hidden text-center mb-8">
                        <div
                            class="w-16 h-16 bg-maroon-soft/10 rounded-xl flex items-center justify-center mx-auto mb-3">
                            <i class="fas fa-calendar-check text-2xl text-maroon-soft"></i>
                        </div>
                        <h2 class="text-2xl font-bold text-maroon-soft">SIMKEG</h2>
                    </div>

                    <div class="mb-8">
                        <h2 class="text-3xl font-extrabold text-slate-800 mb-2">Welcome Back</h2>
                        <p class="text-slate-500 font-medium">Sign in to access your dashboard</p>
                    </div>

                    <!-- Alerts -->
                    @if ($errors->any())
                        <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl flex items-start gap-3">
                            <i class="fas fa-exclamation-circle text-red-500 mt-0.5"></i>
                            <div class="flex-1">
                                <p class="text-sm font-semibold text-red-800">{{ $errors->first() }}</p>
                            </div>
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl flex items-start gap-3">
                            <i class="fas fa-check-circle text-green-500 mt-0.5"></i>
                            <div class="flex-1">
                                <p class="text-sm font-semibold text-green-800">{{ session('success') }}</p>
                            </div>
                        </div>
                    @endif

                    <form method="POST" action="/login" class="space-y-6">
                        @csrf

                        <!-- Email -->
                        <div class="space-y-2">
                            <label for="email"
                                class="text-xs font-bold text-abu-muda uppercase tracking-wider flex items-center gap-2">
                                <i class="fas fa-envelope text-maroon-soft"></i>
                                Email Address
                            </label>
                            <input type="email" name="email" id="email"
                                class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl text-sm font-medium text-slate-700 focus:outline-none focus:ring-2 focus:ring-maroon-soft/20 focus:border-maroon-soft transition-all"
                                placeholder="your.email@example.com" value="{{ old('email') }}" required autofocus>
                        </div>

                        <!-- Password -->
                        <div class="space-y-2">
                            <label for="password"
                                class="text-xs font-bold text-abu-muda uppercase tracking-wider flex items-center gap-2">
                                <i class="fas fa-lock text-maroon-soft"></i>
                                Password
                            </label>
                            <div class="relative">
                                <input type="password" name="password" id="password"
                                    class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl text-sm font-medium text-slate-700 focus:outline-none focus:ring-2 focus:ring-maroon-soft/20 focus:border-maroon-soft transition-all pr-12"
                                    placeholder="Enter your password" required>
                                <button type="button" id="togglePassword"
                                    class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 hover:text-maroon-soft transition-colors">
                                    <i class="fas fa-eye" id="toggleIcon"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Remember & Forgot -->
                        <div class="flex items-center justify-between">
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="checkbox" name="remember" id="remember"
                                    class="w-4 h-4 rounded border-slate-300 text-maroon-soft focus:ring-maroon-soft/20">
                                <span class="text-sm font-medium text-slate-600">Remember me</span>
                            </label>
                            <a href="#" class="text-sm font-semibold text-maroon-soft hover:underline">Forgot
                                password?</a>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit"
                            class="w-full py-3.5 bg-maroon-soft text-white rounded-xl text-sm font-bold hover:brightness-110 shadow-lg shadow-maroon-soft/20 transition-all flex items-center justify-center gap-2">
                            <i class="fas fa-sign-in-alt"></i>
                            <span>Sign In</span>
                        </button>
                    </form>

                    <!-- Footer -->
                    <div class="mt-8 text-center">
                        <p class="text-xs text-slate-400">© 2026 SIMKEG. All rights reserved.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Toggle password visibility
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        const toggleIcon = document.getElementById('toggleIcon');

        togglePassword.addEventListener('click', function () {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            toggleIcon.classList.toggle('fa-eye');
            toggleIcon.classList.toggle('fa-eye-slash');
        });

        // Auto-dismiss alerts after 5 seconds
        setTimeout(() => {
            const alerts = document.querySelectorAll('[class*="bg-red-50"], [class*="bg-green-50"]');
            alerts.forEach(alert => {
                alert.style.transition = 'opacity 0.5s';
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 500);
            });
        }, 5000);
    </script>
</body>

</html>