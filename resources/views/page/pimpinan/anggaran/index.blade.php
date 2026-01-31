@extends('layouts.app')

@section('title', 'Manajemen Anggaran')
@section('subtitle', 'Daftar semua alokasi anggaran kegiatan')

@section('content')
    <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200/60 shadow-sm overflow-hidden">
        <!-- Header with Actions -->
        <div
            class="p-6 border-b border-slate-100 dark:border-slate-800 flex flex-col md:flex-row justify-between items-start md:items-center gap-4 bg-gradient-to-r from-white to-slate-50/50">
            <div>
                <h2 class="text-xl font-bold text-maroon-soft">Data Anggaran</h2>
                <p class="text-slate-500 text-xs mt-1 font-medium">Monitoring dana kegiatan secara real-time</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('pimpinan.anggaran.create') }}"
                    class="inline-flex items-center gap-2 px-4 py-2 bg-maroon-soft text-white rounded-xl text-xs font-bold hover:brightness-110 transition-all shadow-lg shadow-maroon-soft/20">
                    <i class="fas fa-plus"></i>
                    Tambah Anggaran
                </a>
            </div>
        </div>

        <!-- Activities Table -->
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr
                        class="bg-slate-50/80 dark:bg-slate-800/50 text-[11px] font-bold text-slate-500 uppercase tracking-widest border-b border-slate-100 dark:border-slate-800">
                        <th class="px-6 py-4">Kegiatan</th>
                        <th class="px-6 py-4">Jumlah</th>
                        <th class="px-6 py-4">Sumber Dana</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50 dark:divide-slate-800">
                    @forelse($anggarans as $item)
                        <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/50 transition-colors group">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-10 h-10 rounded-xl bg-maroon-soft/5 flex items-center justify-center text-maroon-soft group-hover:scale-110 transition-transform">
                                        <i class="fas fa-wallet text-sm"></i>
                                    </div>
                                    <div class="min-w-0">
                                        <span
                                            class="text-sm font-bold text-slate-700 dark:text-slate-200 block truncate">{{ $item->kegiatan->judul ?? 'N/A' }}</span>
                                        <span class="text-[10px] text-slate-400 font-medium">Ref:
                                            #ANG-{{ $item->id }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-sm font-black text-slate-800 dark:text-white">Rp
                                    {{ number_format($item->jumlah, 0, ',', '.') }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-1.5">
                                    <div class="w-2 h-2 rounded-full bg-blue-400"></div>
                                    <span
                                        class="text-xs text-slate-600 dark:text-slate-400 font-semibold">{{ $item->sumber_dana }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span
                                    class="px-2.5 py-1 rounded-lg text-[10px] font-bold uppercase tracking-wider
                                    @if ($item->status == 'disetujui' || $item->status == 'completed') bg-emerald-100 text-emerald-700
                                    @else bg-amber-100 text-amber-700 @endif inline-flex items-center gap-1.5">
                                    <i
                                        class="fas {{ $item->status == 'disetujui' || $item->status == 'completed' ? 'fa-check-circle' : 'fa-clock' }}"></i>
                                    {{ ucfirst($item->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('pimpinan.anggaran.edit', $item->id) }}"
                                        class="p-2 text-slate-400 hover:text-maroon-soft hover:bg-maroon-soft/5 rounded-lg transition-all"
                                        title="Edit">
                                        <i class="fas fa-edit text-xs"></i>
                                    </a>
                                    <form action="{{ route('pimpinan.anggaran.destroy', $item->id) }}" method="POST"
                                        class="inline-block"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus anggaran ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="p-2 text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition-all"
                                            title="Delete">
                                            <i class="fas fa-trash-alt text-xs"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-8 py-12 text-center">
                                <div class="flex flex-col items-center">
                                    <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mb-4">
                                        <i class="fas fa-box-open text-2xl text-slate-300"></i>
                                    </div>
                                    <p class="text-sm font-bold text-slate-400">Belum ada data anggaran yang tersedia.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if ($anggarans->hasPages())
            <div class="p-6 border-t border-slate-100 dark:border-slate-800 bg-slate-50/30">
                <div class="flex items-center justify-between">
                    <div class="text-xs font-bold text-slate-400 uppercase tracking-widest">
                        Showing {{ $anggarans->firstItem() }}-{{ $anggarans->lastItem() }} of {{ $anggarans->total() }}
                    </div>
                    <div class="flex items-center gap-2">
                        @if (!$anggarans->onFirstPage())
                            <a href="{{ $anggarans->previousPageUrl() }}"
                                class="w-8 h-8 flex items-center justify-center rounded-lg bg-white border border-slate-200 text-slate-400 hover:text-maroon-soft transition-all">
                                <i class="fas fa-chevron-left text-xs"></i>
                            </a>
                        @endif
                        @if ($anggarans->hasMorePages())
                            <a href="{{ $anggarans->nextPageUrl() }}"
                                class="w-8 h-8 flex items-center justify-center rounded-lg bg-white border border-slate-200 text-slate-400 hover:text-maroon-soft transition-all">
                                <i class="fas fa-chevron-right text-xs"></i>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
