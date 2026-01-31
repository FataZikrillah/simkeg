@extends('layouts.app')

@section('title', 'Detail Kegiatan - ' . $kegiatan->judul)

@section('content')
    <div class="max-w-6xl mx-auto space-y-6">
        <!-- Header & Quick Actions -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div>
                <div class="flex items-center gap-2 mb-2">
                    <span
                        class="px-2 py-0.5 bg-maroon-soft/10 text-maroon-soft text-[10px] font-bold uppercase tracking-widest rounded">
                        #{{ str_pad($kegiatan->id, 6, '0', STR_PAD_LEFT) }}
                    </span>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold uppercase tracking-wider
                            @if($kegiatan->status == 'disetujui') bg-sage/10 text-sage
                            @elseif($kegiatan->status == 'pending') bg-amber-500/10 text-amber-500
                            @elseif($kegiatan->status == 'ditolak') bg-red-500/10 text-red-500
                            @else bg-blue-500/10 text-blue-500 @endif">
                        {{ $kegiatan->status }}
                    </span>
                </div>
                <h1 class="text-2xl sm:text-3xl font-bold tracking-tight text-slate-800 dark:text-white">
                    {{ $kegiatan->judul }}
                </h1>
                <div class="mt-3 flex flex-wrap items-center gap-4 text-sm font-medium text-slate-500">
                    <div class="flex items-center gap-1.5">
                        <i class="fas fa-calendar text-maroon-soft"></i>
                        {{ \Carbon\Carbon::parse($kegiatan->tanggal)->format('d M Y') }}
                    </div>
                    <div class="flex items-center gap-1.5">
                        <i class="fas fa-clock text-maroon-soft"></i>
                        {{ \Carbon\Carbon::parse($kegiatan->waktu_mulai)->format('H:i') }}
                    </div>
                    <div class="flex items-center gap-1.5">
                        <i class="fas fa-map-marker-alt text-maroon-soft"></i>
                        {{ $kegiatan->lokasi }}
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-2">
                <a href="{{ route('admin.kegiatan.edit', $kegiatan->id) }}"
                    class="inline-flex items-center gap-2 px-4 py-2 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg text-sm font-semibold text-slate-700 dark:text-slate-300 hover:bg-beige-bg dark:hover:bg-slate-700 transition-colors shadow-sm">
                    <i class="fas fa-edit text-amber-500"></i>
                    <span>Edit</span>
                </a>
                <a href="{{ route('admin.kegiatan.export', $kegiatan->id) }}"
                    class="inline-flex items-center gap-2 px-4 py-2 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg text-sm font-semibold text-slate-700 dark:text-slate-300 hover:bg-sage/10 transition-colors shadow-sm">
                    <i class="fas fa-file-pdf text-red-500"></i>
                    <span>Export</span>
                </a>
                <a href="{{ route('admin.kegiatan.index') }}"
                    class="inline-flex items-center gap-2 px-4 py-2 bg-maroon-soft text-white rounded-lg text-sm font-semibold hover:brightness-110 transition-all shadow-lg shadow-maroon-soft/20">
                    <i class="fas fa-arrow-left"></i>
                    <span>Kembali</span>
                </a>
            </div>
        </div>

        @if($kegiatan->image)
            <div
                class="relative h-64 sm:h-80 w-full overflow-hidden rounded-2xl border border-slate-200/60 dark:border-slate-800 shadow-sm transition-all hover:shadow-md">
                <img src="{{ asset('storage/' . $kegiatan->image) }}" alt="{{ $kegiatan->judul }}"
                    class="h-full w-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                <div class="absolute bottom-6 left-6 right-6">
                    <div class="flex items-center gap-2">
                        <span
                            class="px-2 py-0.5 bg-maroon-soft text-white text-[10px] font-bold uppercase tracking-widest rounded shadow-sm">
                            Foto Utama
                        </span>
                    </div>
                </div>
            </div>
        @endif

        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Column: Details & Documentation -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Activity Description & Info -->
                <div
                    class="bg-white dark:bg-slate-900 rounded-xl border border-slate-200/60 dark:border-slate-800 shadow-sm overflow-hidden">
                    <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-800 flex items-center gap-3">
                        <div class="p-2 bg-maroon-soft/10 rounded-lg">
                            <i class="fas fa-align-left text-maroon-soft text-sm"></i>
                        </div>
                        <h2 class="text-sm font-bold text-slate-800 dark:text-white uppercase tracking-wider">Deskripsi
                            Kegiatan</h2>
                    </div>
                    <div class="p-6">
                        <div class="prose prose-sm dark:prose-invert max-w-none text-slate-600 dark:text-slate-400">
                            <p class="leading-relaxed whitespace-pre-line">{{ $kegiatan->deskripsi }}</p>
                        </div>

                        <div
                            class="mt-8 pt-6 border-t border-slate-100 dark:border-slate-800 grid grid-cols-2 sm:grid-cols-4 gap-6">
                            <div>
                                <p class="text-[10px] font-bold text-abu-muda uppercase tracking-widest mb-1">Prioritas</p>
                                <div class="flex items-center gap-1.5 font-bold text-slate-700 dark:text-slate-300">
                                    <i class="fas fa-flag text-xs 
                                            @if($kegiatan->prioritas == 'tinggi') text-red-500
                                            @elseif($kegiatan->prioritas == 'sedang') text-amber-500
                                            @else text-sage @endif"></i>
                                    <span class="text-sm truncate capitalize">{{ $kegiatan->prioritas }}</span>
                                </div>
                            </div>
                            <div>
                                <p class="text-[10px] font-bold text-abu-muda uppercase tracking-widest mb-1">Dibuat Pada
                                </p>
                                <p class="text-sm font-bold text-slate-700 dark:text-slate-300 truncate">
                                    {{ $kegiatan->created_at->format('d M Y') }}
                                </p>
                            </div>
                            <div>
                                <p class="text-[10px] font-bold text-abu-muda uppercase tracking-widest mb-1">Terakhir
                                    Update</p>
                                <p class="text-sm font-bold text-slate-700 dark:text-slate-300 truncate">
                                    {{ $kegiatan->updated_at->diffForHumans() }}
                                </p>
                            </div>
                            <div>
                                <p class="text-[10px] font-bold text-abu-muda uppercase tracking-widest mb-1">Kategori</p>
                                <p class="text-sm font-bold text-slate-700 dark:text-slate-300 truncate">
                                    Umum
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Documentation & Gallery -->
                <div
                    class="bg-white dark:bg-slate-900 rounded-xl border border-slate-200/60 dark:border-slate-800 shadow-sm overflow-hidden">
                    <div
                        class="px-6 py-4 border-b border-slate-100 dark:border-slate-800 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="p-2 bg-sage/10 rounded-lg">
                                <i class="fas fa-images text-sage text-sm"></i>
                            </div>
                            <h2 class="text-sm font-bold text-slate-800 dark:text-white uppercase tracking-wider">
                                Dokumentasi & Lampiran</h2>
                        </div>
                        <span class="text-[10px] font-bold px-2 py-1 bg-slate-100 dark:bg-slate-800 text-slate-500 rounded">
                            {{ $kegiatan->dokumentasi->count() }} Files
                        </span>
                    </div>
                    <div class="p-6">
                        @if($kegiatan->dokumentasi->count() > 0)
                            <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                                @foreach($kegiatan->dokumentasi as $dok)
                                    <div
                                        class="group relative rounded-xl overflow-hidden bg-slate-100 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 transition-all hover:shadow-md">
                                        <div class="aspect-video flex items-center justify-center overflow-hidden">
                                            @if(in_array(pathinfo($dok->file, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif', 'webp']))
                                                <img src="{{ asset('storage/' . $dok->file) }}" alt="{{ $dok->keterangan }}"
                                                    class="h-full w-full object-cover transition-transform group-hover:scale-110">
                                            @else
                                                <div class="flex flex-col items-center gap-2">
                                                    <i class="fas fa-file-pdf text-3xl text-red-400"></i>
                                                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">
                                                        {{ strtoupper(pathinfo($dok->file, PATHINFO_EXTENSION)) }}
                                                    </span>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="p-3 bg-white dark:bg-slate-900">
                                            <p class="text-[10px] font-bold text-slate-700 dark:text-slate-300 truncate mb-1">
                                                {{ $dok->keterangan }}
                                            </p>
                                            <div class="flex items-center justify-between">
                                                <span class="text-[9px] font-medium text-slate-400">
                                                    {{ $dok->created_at->format('d M') }}
                                                </span>
                                                <a href="{{ asset('storage/' . $dok->file) }}" download
                                                    class="p-1.5 text-sage hover:bg-sage/10 rounded transition-colors">
                                                    <i class="fas fa-download text-xs"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="flex flex-col items-center justify-center py-12 text-slate-400">
                                <i class="fas fa-folder-open text-4xl mb-4 opacity-20"></i>
                                <p class="text-sm font-medium">Belum ada dokumentasi yang diupload.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Right Column: Stats & Actions -->
            <div class="space-y-6">
                <!-- Person in Charge -->
                <div
                    class="bg-white dark:bg-slate-900 rounded-xl border border-slate-200/60 dark:border-slate-800 shadow-sm overflow-hidden">
                    <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-800 flex items-center gap-3">
                        <div class="p-2 bg-blue-500/10 rounded-lg">
                            <i class="fas fa-user-tie text-blue-500 text-sm"></i>
                        </div>
                        <h2 class="text-sm font-bold text-slate-800 dark:text-white uppercase tracking-wider">Penanggung
                            Jawab</h2>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center gap-4">
                            <div
                                class="h-14 w-14 rounded-full bg-gradient-to-br from-maroon-soft to-maroon-soft/60 flex items-center justify-center text-white text-xl font-bold border-4 border-white dark:border-slate-800 shadow-sm">
                                {{ strtoupper(substr($kegiatan->user->name, 0, 1)) }}
                            </div>
                            <div>
                                <h3 class="font-bold text-slate-800 dark:text-white">{{ $kegiatan->user->name }}</h3>
                                <div class="flex items-center gap-1.5">
                                    <span
                                        class="text-[10px] font-bold px-1.5 py-0.5 bg-beige-bg text-maroon-soft rounded uppercase tracking-wider">
                                        {{ $kegiatan->user->role }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="mt-6 space-y-3">
                            <div class="flex items-center gap-3 text-xs text-slate-500">
                                <div
                                    class="w-8 h-8 rounded bg-slate-50 dark:bg-slate-800 flex items-center justify-center shrink-0">
                                    <i class="fas fa-envelope text-slate-400"></i>
                                </div>
                                <span class="truncate">{{ $kegiatan->user->email }}</span>
                            </div>
                            <div class="flex items-center gap-3 text-xs text-slate-500">
                                <div
                                    class="w-8 h-8 rounded bg-slate-50 dark:bg-slate-800 flex items-center justify-center shrink-0">
                                    <i class="fas fa-phone text-slate-400"></i>
                                </div>
                                <span>{{ $kegiatan->user->phone ?? '-' }}</span>
                            </div>
                        </div>
                        <a href="mailto:{{ $kegiatan->user->email }}"
                            class="mt-6 w-full py-2.5 bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 text-xs font-bold rounded-lg hover:bg-beige-bg/40 transition-all flex items-center justify-center gap-2">
                            <i class="fas fa-paper-plane mr-2"></i> Kirim Pesan
                        </a>
                    </div>
                </div>

                <!-- Quick Actions / Navigation -->
                <div
                    class="bg-white dark:bg-slate-900 rounded-xl border border-slate-200/60 dark:border-slate-800 shadow-sm overflow-hidden">
                    <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-800 flex items-center gap-3">
                        <div class="p-2 bg-amber-500/10 rounded-lg">
                            <i class="fas fa-bolt text-amber-500 text-sm"></i>
                        </div>
                        <h2 class="text-sm font-bold text-slate-800 dark:text-white uppercase tracking-wider">Aksi Cepat
                        </h2>
                    </div>
                    <div class="p-4 space-y-2">
                        <a href="{{ route('admin.laporan.create', ['kegiatan_id' => $kegiatan->id]) }}"
                            class="group flex items-center gap-3 p-3 rounded-xl hover:bg-sage/5 border border-transparent hover:border-sage/20 transition-all">
                            <div
                                class="h-10 w-10 rounded-lg bg-sage/10 text-sage flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform">
                                <i class="fas fa-file-signature text-sm"></i>
                            </div>
                            <div>
                                <p class="text-xs font-bold text-slate-800 dark:text-white">Buat Laporan</p>
                                <p class="text-[10px] text-slate-500">Susun evaluasi kegiatan</p>
                            </div>
                        </a>
                        <a href="{{ route('admin.anggaran.create', ['kegiatan_id' => $kegiatan->id]) }}"
                            class="group flex items-center gap-3 p-3 rounded-xl hover:bg-blue-500/5 border border-transparent hover:border-blue-500/20 transition-all">
                            <div
                                class="h-10 w-10 rounded-lg bg-blue-500/10 text-blue-500 flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform">
                                <i class="fas fa-wallet text-sm"></i>
                            </div>
                            <div>
                                <p class="text-xs font-bold text-slate-800 dark:text-white">Tambah Anggaran</p>
                                <p class="text-[10px] text-slate-500">Alokasikan dana tambahan</p>
                            </div>
                        </a>

                        <div class="pt-4 mt-2 border-t border-slate-100 dark:border-slate-800">
                            <button onclick="confirmReset()"
                                class="w-full flex items-center gap-3 p-3 rounded-xl hover:bg-red-500/5 border border-transparent hover:border-red-500/20 transition-all text-left">
                                <div
                                    class="h-10 w-10 rounded-lg bg-red-500/10 text-red-500 flex items-center justify-center shrink-0">
                                    <i class="fas fa-trash-alt text-sm"></i>
                                </div>
                                <div>
                                    <p class="text-xs font-bold text-red-500">Hapus Kegiatan</p>
                                    <p class="text-[10px] text-slate-500 italic">*Tindakan tidak dapat dibatalkan</p>
                                </div>
                            </button>
                            <form id="delete-kegiatan-form" action="{{ route('admin.kegiatan.destroy', $kegiatan->id) }}"
                                method="POST" class="hidden">
                                @csrf
                                @method('DELETE')
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function confirmReset() {
            if (confirm('Apakah Anda yakin ingin menghapus kegiatan ini secara permanen?')) {
                document.getElementById('delete-kegiatan-form').submit();
            }
        }
    </script>
@endsection