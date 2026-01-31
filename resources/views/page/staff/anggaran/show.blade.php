@extends('layouts.app')

@section('title', 'Detail Pengajuan Anggaran')

@section('content')
    <div class="max-w-3xl mx-auto">
        <div class="mb-4">
            <a href="{{ route('staff.anggaran.index') }}" class="inline-flex items-center text-sm font-bold text-slate-500 hover:text-maroon-soft transition-all">
                <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar
            </a>
        </div>

        <div class="bg-white rounded-xl shadow-card overflow-hidden">
            <div class="p-6 border-b border-gray-100 flex justify-between items-center bg-slate-50/50">
                <div>
                    <span class="px-3 py-1 bg-white border border-slate-200 rounded-lg text-[10px] font-black text-slate-400 uppercase tracking-widest">Detail Anggaran</span>
                    <h2 class="text-xl font-bold text-gray-800 mt-2">{{ $anggaran->kegiatan->judul ?? 'N/A' }}</h2>
                </div>
                <div class="text-right">
                    <span class="px-3 py-1 rounded-lg text-[10px] font-bold uppercase tracking-wider
                        @if($anggaran->status == 'disetujui') bg-emerald-100 text-emerald-700
                        @else bg-amber-100 text-amber-700 @endif inline-flex items-center gap-1.5">
                        <i class="fas {{ $anggaran->status == 'disetujui' ? 'fa-check-circle' : 'fa-clock' }}"></i>
                        {{ ucfirst($anggaran->status) }}
                    </span>
                </div>
            </div>

            <div class="p-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                    <div>
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Jumlah Anggaran</p>
                        <p class="text-2xl font-black text-slate-800">Rp {{ number_format($anggaran->jumlah, 0, ',', '.') }}</p>
                    </div>
                    <div>
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Sumber Dana</p>
                        <p class="text-sm font-bold text-slate-700">{{ $anggaran->sumber_dana }}</p>
                    </div>
                </div>

                <div class="mb-8">
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Keterangan Penggunaan</p>
                    <div class="bg-slate-50 rounded-xl p-5 border border-slate-100">
                        <p class="text-sm text-slate-600 leading-relaxed italic">
                            {{ $anggaran->keterangan ?? 'Tidak ada keterangan tambahan.' }}
                        </p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pt-6 border-t border-slate-100">
                    <div>
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Diajukan Pada</p>
                        <p class="text-xs font-bold text-slate-700">{{ $anggaran->created_at->format('d F Y, H:i') }}</p>
                    </div>
                    <div>
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Terakhir Diperbarui</p>
                        <p class="text-xs font-bold text-slate-700">{{ $anggaran->updated_at->format('d F Y, H:i') }}</p>
                    </div>
                </div>
            </div>

            @if($anggaran->status == 'pending')
                <div class="p-6 bg-slate-50 border-t border-gray-100 flex gap-3">
                    <a href="{{ route('staff.anggaran.edit', $anggaran->id) }}" class="flex-1 py-3 bg-white border border-slate-200 text-slate-600 rounded-xl font-bold text-xs uppercase tracking-widest text-center hover:bg-slate-50 transition-all">
                        <i class="fas fa-edit mr-2"></i> Edit Data
                    </a>
                    <form action="{{ route('staff.anggaran.destroy', $anggaran->id) }}" method="POST" class="flex-1" onsubmit="return confirm('Hapus/Batalkan pengajuan ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full py-3 bg-rose-50 text-rose-600 border border-rose-100 rounded-xl font-bold text-xs uppercase tracking-widest hover:bg-rose-100 transition-all">
                            <i class="fas fa-trash-alt mr-2"></i> Batalkan Pengajuan
                        </button>
                    </form>
                </div>
            @endif
        </div>
    </div>
@endsection
