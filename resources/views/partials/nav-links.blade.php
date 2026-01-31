<div class="text-[11px] font-bold text-white/40 px-3 py-2 uppercase tracking-widest">Main Menu</div>

@php
    $role = auth()->user()->role;
    $dashboardRoute = $role . '.dashboard';
    // Admin dashboard route is named 'admin.dashboard'
    // Staff dashboard route is named 'staff.dashboard'
    // Pimpinan dashboard route is named 'pimpinan.dashboard'
@endphp

<a class="flex items-center gap-3 px-3 py-2.5 rounded-lg {{ request()->routeIs($dashboardRoute) ? 'bg-white/10 text-white font-medium' : 'text-white/70 hover:bg-white/5 hover:text-white transition-all' }}"
    href="{{ route($dashboardRoute) }}">
    <i class="fas fa-chart-line w-5 text-center"></i>
    <span class="text-sm font-semibold">Dashboard</span>
</a>

@if ($role == 'admin')
    <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('admin.anggaran.*') ? 'bg-white/10 text-white font-medium' : 'text-white/70 hover:bg-white/5 hover:text-white transition-all' }}"
        href="{{ route('admin.anggaran.index') }}">
        <i class="fas fa-money-bill-wave w-5 text-center"></i>
        <span class="text-sm">Anggaran</span>
    </a>
    <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('admin.kegiatan.*') ? 'bg-white/10 text-white font-medium' : 'text-white/70 hover:bg-white/5 hover:text-white transition-all' }}"
        href="{{ route('admin.kegiatan.index') }}">
        <i class="fas fa-calendar-alt w-5 text-center"></i>
        <span class="text-sm">Data Kegiatan</span>
    </a>
    <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('admin.dokumentasi.*') ? 'bg-white/10 text-white font-medium' : 'text-white/70 hover:bg-white/5 hover:text-white transition-all' }}"
        href="{{ route('admin.dokumentasi.index') }}">
        <i class="fas fa-images w-5 text-center"></i>
        <span class="text-sm">Dokumentasi</span>
    </a>
    <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('admin.laporan.*') ? 'bg-white/10 text-white font-medium' : 'text-white/70 hover:bg-white/5 hover:text-white transition-all' }}"
        href="{{ route('admin.laporan.index') }}">
        <i class="fas fa-file-contract w-5 text-center"></i>
        <span class="text-sm">Laporan</span>
    </a>
    <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('admin.pengguna.*') ? 'bg-white/10 text-white font-medium' : 'text-white/70 hover:bg-white/5 hover:text-white transition-all' }}"
        href="{{ route('admin.pengguna.index') }}">
        <i class="fas fa-users w-5 text-center"></i>
        <span class="text-sm">Data Pengguna</span>
    </a>
@endif

@if ($role == 'staff')
    <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('staff.kegiatan.*') ? 'bg-white/10 text-white font-medium' : 'text-white/70 hover:bg-white/5 hover:text-white transition-all' }}"
        href="{{ route('staff.kegiatan.index') }}">
        <i class="fas fa-tasks w-5 text-center"></i>
        <span class="text-sm">Kegiatan Saya</span>
    </a>
    <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('staff.dokumentasi.*') ? 'bg-white/10 text-white font-medium' : 'text-white/70 hover:bg-white/5 hover:text-white transition-all' }}"
        href="{{ route('staff.dokumentasi.index') }}">
        <i class="fas fa-images w-5 text-center"></i>
        <span class="text-sm">Dokumentasi</span>
    </a>
    <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('staff.anggaran.*') ? 'bg-white/10 text-white font-medium' : 'text-white/70 hover:bg-white/5 hover:text-white transition-all' }}"
        href="{{ route('staff.anggaran.index') }}">
        <i class="fas fa-piggy-bank w-5 text-center"></i>
        <span class="text-sm">Pengajuan Anggaran</span>
    </a>
    <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('staff.laporan.*') ? 'bg-white/10 text-white font-medium' : 'text-white/70 hover:bg-white/5 hover:text-white transition-all' }}"
        href="{{ route('staff.laporan.index') }}">
        <i class="fas fa-file-contract w-5 text-center"></i>
        <span class="text-sm">Laporan Saya</span>
    </a>
@endif

@if ($role == 'pimpinan')
    <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('pimpinan.kegiatan.*') ? 'bg-white/10 text-white font-medium' : 'text-white/70 hover:bg-white/5 hover:text-white transition-all' }}"
        href="{{ route('pimpinan.kegiatan.index') }}">
        <i class="fas fa-calendar-check w-5 text-center"></i>
        <span class="text-sm">Semua Kegiatan</span>
    </a>
    <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('pimpinan.anggaran.*') ? 'bg-white/10 text-white font-medium' : 'text-white/70 hover:bg-white/5 hover:text-white transition-all' }}"
        href="{{ route('pimpinan.anggaran.index') }}">
        <i class="fas fa-file-invoice-dollar w-5 text-center"></i>
        <span class="text-sm">Manajemen Anggaran</span>
    </a>
    <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('pimpinan.laporan.*') ? 'bg-white/10 text-white font-medium' : 'text-white/70 hover:bg-white/5 hover:text-white transition-all' }}"
        href="{{ route('pimpinan.laporan.index') }}">
        <i class="fas fa-file-signature w-5 text-center"></i>
        <span class="text-sm">Laporan</span>
    </a>
@endif

<div class="pt-6 text-[11px] font-bold text-white/40 px-3 py-2 uppercase tracking-widest">Account</div>
<a class="flex items-center gap-3 px-3 py-2.5 rounded-lg {{ request()->routeIs(auth()->user()->role . '.profile.*') ? 'bg-white/10 text-white font-medium' : 'text-white/70 hover:bg-white/5 hover:text-white transition-all' }}"
    href="{{ route(auth()->user()->role . '.profile.index') }}">
    <i class="fas fa-user-cog w-5 text-center"></i>
    <span class="text-sm">My Profile</span>
</a>

<form method="POST" action="{{ route('logout') }}" class="mt-2">
    @csrf
    <button type="submit"
        class="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-white/70 hover:bg-red-500/10 hover:text-red-400 transition-all text-left">
        <i class="fas fa-sign-out-alt w-5 text-center"></i>
        <span class="text-sm">Logout</span>
    </button>
</form>
