<aside class="w-64 flex-shrink-0 bg-maroon-soft dark:bg-slate-950 hidden lg:flex flex-col text-white">
    <div class="p-6">
        <div class="flex items-center gap-3">
            <div class="bg-white/20 rounded-lg text-white backdrop-blur-sm">
                <img src="{{ asset('images/logo.png') }}" alt="" class="h-16 w-16 object-cover">
            </div>
            <div>
                <h1 class="text-sm font-bold leading-none">SIMKEG</h1>
                <p class="text-[10px] text-white/60 mt-1 uppercase tracking-widest font-medium">Sistem Informasi Manajemen Kegiatan</p>
            </div>
        </div>
    </div>
    <nav class="flex-1 px-4 space-y-1 overflow-y-auto">
        @include('partials.nav-links')
    </nav>
</aside>