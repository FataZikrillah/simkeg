@extends('layouts.app')

@section('title', 'Manajemen Laporan')
@section('subtitle', 'Daftar semua laporan kegiatan organisasi')

@section('content')
    <div class="bg-white rounded-xl shadow-card overflow-hidden">
        <div
            class="p-6 border-b border-gray-100 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h2 class="text-xl font-bold text-gray-800">Daftar Laporan</h2>
                <p class="text-sm text-gray-500 mt-1">Total {{ $laporans->total() }} laporan tersedia</p>
            </div>
            <a href="{{ route('pimpinan.laporan.create') }}"
                class="btn px-4 py-2 rounded-lg border-2 border-maroon-soft text-maroon-soft hover:bg-maroon-soft hover:text-white flex items-center gap-2">
                <i class="fas fa-plus-circle"></i>
                Buat Laporan Baru
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-black text-slate-500 uppercase tracking-widest">Judul &
                            Kegiatan</th>
                        <th class="px-6 py-4 text-left text-xs font-black text-slate-500 uppercase tracking-widest">Pengirim
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-black text-slate-500 uppercase tracking-widest">Tanggal
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-black text-slate-500 uppercase tracking-widest">Status
                        </th>
                        <th class="px-6 py-4 text-right text-xs font-black text-slate-500 uppercase tracking-widest">Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($laporans as $item)
                        <tr class="hover:bg-slate-50/50 transition-colors group">
                            <td class="px-6 py-4">
                                <div class="flex flex-col">
                                    <span
                                        class="text-sm font-bold text-slate-700 block truncate max-w-xs">{{ $item->judul }}</span>
                                    <span class="text-[10px] text-slate-400 font-medium">Kegiatan:
                                        {{ $item->kegiatan->judul }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <div
                                        class="w-7 h-7 rounded-full border-2 border-maroon-soft flex items-center justify-center text-maroon-soft text-[10px] font-bold">
                                        {{ strtoupper(substr($item->user->name ?? 'U', 0, 1)) }}
                                    </div>
                                    <span
                                        class="text-xs text-slate-600 font-semibold">{{ $item->user->name ?? 'Unknown' }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span
                                    class="text-xs text-slate-600 font-medium">{{ \Carbon\Carbon::parse($item->tanggal_laporan)->format('d M Y') }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <span
                                    class="px-2.5 py-1 rounded-lg text-[10px] font-bold uppercase tracking-wider
                                    @if ($item->status == 'disetujui') bg-emerald-100 text-emerald-700
                                    @elseif($item->status == 'ditolak') bg-rose-100 text-rose-700
                                    @else bg-amber-100 text-amber-700 @endif inline-flex items-center gap-1.5">
                                    <i
                                        class="fas {{ $item->status == 'disetujui' ? 'fa-check-circle' : ($item->status == 'ditolak' ? 'fa-times-circle' : 'fa-clock') }}"></i>
                                    {{ ucfirst($item->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-end gap-2">
                                    @if ($item->status == 'pending')
                                        <form action="{{ route('pimpinan.laporan.approve', $item->id) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="disetujui">
                                            <button type="submit"
                                                class="px-2 py-1 border-2 border-emerald-500 text-emerald-500 hover:bg-emerald-50 rounded-lg transition-all"
                                                title="Setujui">
                                                <i class="fas fa-check text-xs"></i>
                                            </button>
                                        </form>
                                        <form action="{{ route('pimpinan.laporan.approve', $item->id) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="ditolak">
                                            <button type="submit"
                                                class="px-2 py-1 border-2 border-rose-500 text-rose-500 hover:bg-rose-50 rounded-lg transition-all"
                                                title="Tolak">
                                                <i class="fas fa-times text-xs"></i>
                                            </button>
                                        </form>
                                    @endif
                                    <a href="{{ route('pimpinan.laporan.show', $item->id) }}"
                                        class="p-2 text-slate-400 hover:text-maroon-soft hover:bg-maroon-soft/5 rounded-lg transition-all"
                                        title="Detail">
                                        <i class="fas fa-eye text-xs"></i>
                                    </a>
                                    <a href="{{ route('pimpinan.laporan.edit', $item->id) }}"
                                        class="p-2 text-slate-400 hover:text-amber-500 hover:bg-amber-50 rounded-lg transition-all"
                                        title="Edit">
                                        <i class="fas fa-edit text-xs"></i>
                                    </a>
                                    <form action="{{ route('pimpinan.laporan.destroy', $item->id) }}" method="POST"
                                        class="inline" onsubmit="return confirm('Hapus laporan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="p-2 text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition-all"
                                            title="Hapus">
                                            <i class="fas fa-trash-alt text-xs"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-8 py-12 text-center text-slate-500">
                                <div class="flex flex-col items-center">
                                    <i class="fas fa-file-invoice text-4xl text-slate-200 mb-3"></i>
                                    <p class="font-bold">Belum ada laporan.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($laporans->hasPages())
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-100">
                {{ $laporans->links() }}
            </div>
        @endif
    </div>
@endsection
