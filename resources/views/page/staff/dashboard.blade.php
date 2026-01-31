@extends('layouts.app')

@section('title', 'Staff Dashboard')

@section('content')
    <!-- Hero / Welcome Section -->
    <div
        class="relative overflow-hidden bg-gradient-to-br from-maroon-soft to-[#9D567D] rounded-3xl p-8 mb-8 text-white shadow-xl shadow-maroon-soft/20">
        <div class="relative z-10">
            <h2 class="text-3xl font-black mb-2 tracking-tight">Selamat Datang, {{ Auth::user()->name }}! 👋</h2>
            <p class="text-white/80 font-medium max-w-lg mb-6 leading-relaxed">Kelola kegiatan dan anggaran organisasi Anda
                dengan lebih terstruktur dan efisien. Pantau status pengajuan Anda hari ini.</p>
            <div class="flex flex-wrap gap-4">
                <a href="{{ route('staff.kegiatan.create') }}"
                    class="px-6 py-2.5 bg-white text-maroon-soft rounded-xl font-bold text-sm hover:bg-slate-50 transition-all flex items-center gap-2 shadow-lg shadow-black/5">
                    <i class="fas fa-plus-circle"></i> Ajukan Kegiatan
                </a>
                <div
                    class="px-6 py-2.5 bg-white/10 backdrop-blur-md border border-white/20 rounded-xl font-bold text-sm flex items-center gap-2">
                    <i class="fas fa-calendar-alt"></i> {{ date('l, d F Y') }}
                </div>
            </div>
        </div>
        <!-- Abstract Decoration -->
        <div class="absolute -right-20 -top-20 w-80 h-80 bg-white/10 rounded-full blur-3xl"></div>
        <div class="absolute right-20 -bottom-20 w-60 h-60 bg-black/10 rounded-full blur-2xl"></div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <!-- Total Kegiatan -->
        <div
            class="bg-white rounded-2xl p-5 border border-slate-100 shadow-sm hover:border-maroon-soft/20 transition-all group">
            <div class="flex items-center gap-4">
                <div
                    class="w-12 h-12 bg-maroon-soft/10 rounded-xl flex items-center justify-center text-maroon-soft group-hover:scale-110 transition-transform">
                    <i class="fas fa-layer-group text-lg"></i>
                </div>
                <div>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest leading-none mb-1">Total
                        Kegiatan</p>
                    <h3 class="text-2xl font-black text-slate-800">{{ $totalKegiatan }}</h3>
                </div>
            </div>
        </div>

        <!-- Disetujui -->
        <div
            class="bg-white rounded-2xl p-5 border border-slate-100 shadow-sm hover:border-emerald-500/20 transition-all group">
            <div class="flex items-center gap-4">
                <div
                    class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center text-emerald-600 group-hover:scale-110 transition-transform">
                    <i class="fas fa-check-double text-lg"></i>
                </div>
                <div>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest leading-none mb-1">Disetujui
                    </p>
                    <h3 class="text-2xl font-black text-slate-800">{{ $kegiatanDisetujui }}</h3>
                </div>
            </div>
        </div>

        <!-- Draft -->
        <div
            class="bg-white rounded-2xl p-5 border border-slate-100 shadow-sm hover:border-amber-500/20 transition-all group">
            <div class="flex items-center gap-4">
                <div
                    class="w-12 h-12 bg-amber-100 rounded-xl flex items-center justify-center text-amber-600 group-hover:scale-110 transition-transform">
                    <i class="fas fa-pen-nib text-lg"></i>
                </div>
                <div>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest leading-none mb-1">Masih Draft
                    </p>
                    <h3 class="text-2xl font-black text-slate-800">{{ $kegiatanDraft }}</h3>
                </div>
            </div>
        </div>

        <!-- Anggaran -->
        <div
            class="bg-white rounded-2xl p-5 border border-slate-100 shadow-sm hover:border-blue-500/20 transition-all group">
            <div class="flex items-center gap-4">
                <div
                    class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center text-blue-600 group-hover:scale-110 transition-transform">
                    <i class="fas fa-wallet text-lg"></i>
                </div>
                <div class="min-w-0">
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest leading-none mb-1">Total
                        Anggaran</p>
                    <h3 class="text-lg font-black text-slate-800 truncate">Rp
                        {{ number_format($totalAnggaran, 0, ',', '.') }}</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Left Section: Recent Tracking -->
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white rounded-2xl shadow-card overflow-hidden border border-slate-100">
                <div class="p-6 border-b border-slate-50 flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-black text-slate-800">Kegiatan Terbaru</h3>
                        <p class="text-xs text-slate-400 font-medium">5 pengajuan terakhir Anda</p>
                    </div>
                    <a href="{{ route('staff.kegiatan.index') }}"
                        class="px-4 py-2 bg-slate-50 hover:bg-slate-100 text-slate-600 rounded-lg text-xs font-bold transition-all flex items-center gap-2">
                        Lihat Semua <i class="fas fa-external-link-alt text-[10px]"></i>
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr
                                class="bg-slate-50/50 text-[10px] font-black text-slate-400 uppercase tracking-widest border-b border-slate-50">
                                <th class="px-6 py-4">Judul Kegiatan</th>
                                <th class="px-6 py-4">Status</th>
                                <th class="px-6 py-4">Tanggal</th>
                                <th class="px-6 py-4 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            @forelse($recentActivities as $activity)
                                <tr class="hover:bg-slate-50/50 transition-colors group">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div
                                                class="w-8 h-8 rounded-lg bg-maroon-soft/5 flex items-center justify-center text-maroon-soft text-xs font-black">
                                                {{ strtoupper(substr($activity->judul, 0, 1)) }}
                                            </div>
                                            <div class="min-w-0">
                                                <span
                                                    class="text-sm font-bold text-slate-700 block truncate max-w-[200px]">{{ $activity->judul }}</span>
                                                <span
                                                    class="text-[10px] text-slate-400 font-medium">{{ $activity->lokasi }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span
                                            class="px-2.5 py-1 rounded-lg text-[9px] font-black uppercase tracking-widest
                                            @if ($activity->status == 'disetujui') bg-emerald-100 text-emerald-700
                                            @elseif($activity->status == 'draft') bg-amber-100 text-amber-700
                                            @else bg-slate-100 text-slate-600 @endif inline-flex items-center gap-1.5">
                                            <div
                                                class="w-1.5 h-1.5 rounded-full {{ $activity->status == 'disetujui' ? 'bg-emerald-500' : ($activity->status == 'draft' ? 'bg-amber-500' : 'bg-slate-400') }}">
                                            </div>
                                            {{ $activity->status }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="text-xs text-slate-500 font-semibold">{{ \Carbon\Carbon::parse($activity->tanggal)->format('d M Y') }}</span>
                                    </td>
                                    <td class="px-6 py-4 text-center text-xs">
                                        <a href="{{ route('staff.kegiatan.show', $activity->id) }}"
                                            class="p-2 text-slate-400 hover:text-maroon-soft hover:bg-maroon-soft/5 rounded-lg transition-all">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-12 text-center">
                                        <div class="flex flex-col items-center">
                                            <div
                                                class="w-12 h-12 bg-slate-50 rounded-full flex items-center justify-center mb-3">
                                                <i class="fas fa-folder-open text-slate-300"></i>
                                            </div>
                                            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Belum ada
                                                kegiatan</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Right Section: Profile & Info -->
        <div class="space-y-6">
            <!-- User Card -->
            <div
                class="bg-white rounded-2xl shadow-card p-6 border border-slate-100 text-center relative overflow-hidden group">
                <div class="relative z-10">
                    <div
                        class="w-20 h-20 bg-maroon-soft/5 rounded-full mx-auto mb-4 flex items-center justify-center p-1 border-2 border-maroon-soft border-dashed">
                        @if (Auth::user()->photo)
                            <img src="{{ asset('storage/' . Auth::user()->photo) }}"
                                class="w-full h-full rounded-full object-cover">
                        @else
                            <div
                                class="w-full h-full rounded-full bg-maroon-soft flex items-center justify-center text-white font-black text-2xl">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                        @endif
                    </div>
                    <h4 class="text-lg font-black text-slate-800 mb-1">{{ Auth::user()->name }}</h4>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-6">
                        {{ Auth::user()->role ?? 'Staff Member' }}</p>

                    <div class="grid grid-cols-2 gap-3 border-t border-slate-50 pt-6">
                        <div class="text-left">
                            <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest leading-none mb-1">
                                Laporan</p>
                            <p class="text-sm font-bold text-slate-700">{{ $totalLaporan }} Berkas</p>
                        </div>
                        <div class="text-right">
                            <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest leading-none mb-1">
                                Bergabung</p>
                            <p class="text-sm font-bold text-slate-700">{{ Auth::user()->created_at->format('M Y') }}</p>
                        </div>
                    </div>
                </div>
                <!-- Abstract Deco -->
                <div
                    class="absolute -right-10 -bottom-10 w-32 h-32 bg-maroon-soft/5 rounded-full group-hover:scale-110 transition-transform">
                </div>
            </div>

            <!-- Promotion / Tip Card -->
            <div class="bg-slate-800 rounded-2xl p-6 text-white shadow-lg relative overflow-hidden group">
                <h4 class="text-xs font-black text-white/40 uppercase tracking-widest mb-3 flex items-center gap-2">
                    <i class="fas fa-lightbulb text-amber-400"></i> Tip Hari Ini
                </h4>
                <p class="text-sm font-medium leading-relaxed italic pr-8">"Lengkapi dokumentasi foto setiap selesai
                    berkegiatan untuk mempermudah verifikasi laporan oleh pimpinan."</p>
                <div class="absolute -right-4 -top-4 text-white/5 text-6xl group-hover:rotate-12 transition-transform">
                    <i class="fas fa-quote-right"></i>
                </div>
            </div>
        </div>
    </div>
@endsection
