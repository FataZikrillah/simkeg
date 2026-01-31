@extends('layouts.app')

@section('title', 'Laporan Kegiatan')
@section('subtitle', 'Kelola laporan pelaksanaan kegiatan Anda')

@section('content')
    <div class="bg-white rounded-xl shadow-card overflow-hidden">
        <div
            class="p-6 border-b border-gray-100 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h2 class="text-xl font-bold text-gray-800">Daftar Laporan Saya</h2>
                <p class="text-sm text-gray-500 mt-1">Total {{ $laporans->total() }} laporan terkirim</p>
            </div>
            <a href="{{ route('staff.laporan.create') }}"
                class="btn px-4 py-2 rounded-lg border-2 border-maroon-soft text-maroon-soft hover:bg-maroon-soft hover:text-white flex items-center gap-2 transition-all font-bold text-sm">
                <i class="fas fa-file-signature"></i>
                Buat Laporan Baru
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-black text-slate-500 uppercase tracking-widest">Judul
                            Laporan</th>
                        <th class="px-6 py-4 text-left text-xs font-black text-slate-500 uppercase tracking-widest">Kegiatan
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-black text-slate-500 uppercase tracking-widest">Tanggal
                            Kirim</th>
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
                                <span
                                    class="text-sm font-bold text-slate-700 block truncate max-w-xs">{{ $item->judul }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-[11px] font-bold text-maroon-soft bg-maroon-soft/5 px-2 py-0.5 rounded">
                                    {{ $item->kegiatan->judul ?? 'N/A' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-xs text-slate-600 font-medium">
                                {{ $item->created_at->format('d M Y') }}
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
                                    <a href="{{ route('staff.laporan.show', $item->id) }}"
                                        class="p-2 text-slate-400 hover:text-maroon-soft hover:bg-maroon-soft/5 rounded-lg transition-all"
                                        title="Detail">
                                        <i class="fas fa-eye text-xs"></i>
                                    </a>

                                    @if ($item->status != 'disetujui')
                                        <a href="{{ route('staff.laporan.edit', $item->id) }}"
                                            class="p-2 text-slate-400 hover:text-amber-500 hover:bg-amber-50 rounded-lg transition-all"
                                            title="Edit">
                                            <i class="fas fa-edit text-xs"></i>
                                        </a>
                                        <form action="{{ route('staff.laporan.destroy', $item->id) }}" method="POST"
                                            class="inline" onsubmit="return confirm('Hapus laporan ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="p-2 text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition-all"
                                                title="Hapus">
                                                <i class="fas fa-trash-alt text-xs"></i>
                                            </button>
                                        </form>
                                    @else
                                        <span class="p-2 text-slate-300 cursor-not-allowed" title="Sudah Disetujui">
                                            <i class="fas fa-lock text-xs"></i>
                                        </span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-8 py-12 text-center text-slate-500">
                                <div class="flex flex-col items-center">
                                    <i class="fas fa-file-alt text-4xl text-slate-200 mb-3"></i>
                                    <p class="font-bold">Belum ada laporan yang dibuat.</p>
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
