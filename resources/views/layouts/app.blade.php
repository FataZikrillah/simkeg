<!DOCTYPE html>
<html class="light" lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png">
    <title>SIMKEG - Sistem Informasi Manajemen Kegiatan</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;display=swap"
        rel="stylesheet" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "maroon-soft": "#7B3F61",
                        "beige-bg": "#F9F7F2",
                        "beige-accent": "#F5F0E1",
                        "abu-muda": "#C2C2C2",
                        "primary": "#7B3F61",
                        "background-light": "#F9F7F2",
                        "background-dark": "#1a1617",
                        "sage": "#789473",
                    },
                    fontFamily: {
                        "display": ["Inter", "sans-serif"]
                    },
                    borderRadius: { "DEFAULT": "0.25rem", "lg": "0.5rem", "xl": "0.75rem", "full": "9999px" },
                },
            },
        }
    </script>
    <style type="text/tailwindcss">
        @layer base {
            body {
                font-family: 'Inter', sans-serif;
            }
        }
        
        ::-webkit-scrollbar {
            width: 6px;
        }
        
        ::-webkit-scrollbar-track {
            background: transparent;
        }
        
        ::-webkit-scrollbar-thumb {
            background: #C2C2C2;
            border-radius: 10px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: #7B3F61;
        }
        
        /* Mobile menu animation */
        .mobile-menu-enter {
            transform: translateX(-100%);
        }
        
        .mobile-menu-enter-active {
            transform: translateX(0);
            transition: transform 300ms ease-out;
        }
        
        .mobile-menu-exit {
            transform: translateX(0);
        }
        
        .mobile-menu-exit-active {
            transform: translateX(-100%);
            transition: transform 300ms ease-out;
        }
    </style>
</head>

<body
    class="bg-background-light dark:bg-background-dark font-display text-slate-800 dark:text-slate-100 transition-colors duration-200">
    <!-- Mobile Menu Button -->
    <div class="lg:hidden fixed top-4 left-4 z-50">
        <button id="mobileMenuToggle" class="p-2.5 bg-maroon-soft text-white rounded-lg shadow-lg">
            <i class="fas fa-bars text-lg"></i>
        </button>
    </div>

    <!-- Mobile Menu Overlay -->
    <div id="mobileMenuOverlay" class="lg:hidden fixed inset-0 bg-black/50 z-40 hidden"></div>

    <!-- Mobile Sidebar -->
    <aside id="mobileSidebar"
        class="lg:hidden fixed inset-y-0 left-0 w-64 bg-maroon-soft dark:bg-slate-950 flex flex-col text-white z-50 transform -translate-x-full transition-transform duration-300">
        <div class="p-6">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="bg-white/20 p-2 rounded-lg text-white backdrop-blur-sm">
                        <img src="{{ asset('images/logo.png') }}" alt="" class="w-10 h-10">
                    </div>
                    <div>
                        <h1 class="text-sm font-bold leading-none">Office Admin</h1>
                        <p class="text-[10px] text-white/60 mt-1 uppercase tracking-widest font-medium">Management
                            System</p>
                    </div>
                </div>
                <button id="closeMobileMenu" class="p-2 text-white/70 hover:text-white">
                    <i class="fas fa-times text-lg"></i>
                </button>
            </div>
        </div>
        <nav class="flex-1 px-4 space-y-1 overflow-y-auto">
            @include('partials.nav-links')
        </nav>
    </aside>

    <div class="flex h-screen overflow-hidden">
        <!-- Desktop Sidebar -->
        @include('partials.sidebar')

        <main class="flex-1 flex flex-col min-w-0 overflow-hidden">
            @include('partials.header')

            <div class="flex-1 overflow-y-auto p-4 sm:p-6 space-y-6">
                @yield('content')
            </div>
        </main>
    </div>

    <script>
        // Mobile menu functionality
        const mobileMenuToggle = document.getElementById('mobileMenuToggle');
        const closeMobileMenu = document.getElementById('closeMobileMenu');
        const mobileMenuOverlay = document.getElementById('mobileMenuOverlay');
        const mobileSidebar = document.getElementById('mobileSidebar');

        function openMobileMenu() {
            mobileSidebar.classList.remove('-translate-x-full');
            mobileMenuOverlay.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeMobileMenuHandler() {
            mobileSidebar.classList.add('-translate-x-full');
            mobileMenuOverlay.classList.add('hidden');
            document.body.style.overflow = '';
        }

        mobileMenuToggle.addEventListener('click', openMobileMenu);
        closeMobileMenu.addEventListener('click', closeMobileMenuHandler);
        mobileMenuOverlay.addEventListener('click', closeMobileMenuHandler);

        // Close mobile menu when clicking on a link
        document.querySelectorAll('#mobileSidebar a').forEach(link => {
            link.addEventListener('click', closeMobileMenuHandler);
        });

        // Handle window resize
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 1024) {
                closeMobileMenuHandler();
            }
        });

        // Global SweetAlert Handler
        const toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });

        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: "{{ session('success') }}",
                confirmButtonColor: '#7B3F61',
            });
        @endif

        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "{{ session('error') }}",
                confirmButtonColor: '#7B3F61',
            });
        @endif
    </script>
    @stack('scripts')
</body>

</html>