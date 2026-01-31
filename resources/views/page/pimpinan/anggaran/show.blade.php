@extends('layouts.app')

@section('title', 'Detail Anggaran')
@section('subtitle', 'Informasi lengkap alokasi anggaran')

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200/60 shadow-sm overflow-hidden">
            <div
                class="p-6 border-b border-slate-100 dark:border-slate-800 bg-gradient-to-r from-white to-slate-50/50 flex justify-between items-center">
                <div class="flex items-center gap-3">
                    <div class="p-2 bg-maroon-soft/10 rounded-lg">
                        <i class="fas fa-file-invoice-dollar text-maroon-soft"></i>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-slate-800 dark:text-white">Detail Anggaran</h2>
                        <p class="text-slate-500 text-xs mt-1 font-medium">Ref: #ANG-{{ $anggaran->id }}</p>
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <a href="{{ route('pimpinan.anggaran.edit', $anggaran->id) }}"
                        class="px-4 py-2 bg-maroon-soft/10 text-maroon-soft rounded-xl text-xs font-bold hover:bg-maroon-soft hover:text-white transition-all">
                        <i class="fas fa-edit mr-1"></i> Edit
                    </a>
                </div>
            </div>

            <div class="p-6 space-y-8">
                <!-- Info Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-6">
                        <div>
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-1">Nama
                                Kegiatan</label>
                            <p class="text-sm font-bold text-slate-700 dark:text-slate-200">
                                {{ $anggaran->kegiatan->judul ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-1">Jumlah
                                Anggaran</label>
                            <p class="text-2xl font-black text-maroon-soft">Rp
                                {{ number_format($anggaran->jumlah, 0, ',', '.') }}</p>
                        </div>
                    </div>
                    <div class="space-y-6">
                        <div>
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-1">Sumber
                                Dana</label>
                            <span
                                class="px-3 py-1 bg-blue-50 text-blue-600 text-[10px] font-black rounded-lg uppercase tracking-widest">{{ $anggaran->sumber_dana }}</span>
                        </div>
                        <div>
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-1">Status
                                Transfer</label>
                            <span
                                class="px-3 py-1 @if ($anggaran->status == 'disetujui') bg-emerald-50 text-emerald-600 @else bg-amber-50 text-amber-600 @endif text-[10px] font-black rounded-lg uppercase tracking-widest inline-flex items-center gap-2">
                                <i class="fas {{ $anggaran->status == 'disetujui' ? 'fa-check-circle' : 'fa-clock' }}"></i>
                                {{ ucfirst($anggaran->status) }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Keterangan -->
                <div class="p-6 bg-slate-50 dark:bg-slate-800 rounded-2xl border border-slate-100 dark:border-slate-700">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-2">Catatan
                        Pimpinan</label>
                    <p class="text-sm text-slate-600 dark:text-slate-400 leading-relaxed italic">
                        {{ $anggaran->keterangan ?? '"Tidak ada keterangan tambahan."' }}
                    </p>
                </div>

                <!-- Footer Activity Link -->
                @if ($anggaran->kegiatan)
                    <div
                        class="flex items-center justify-between p-4 bg-maroon-soft/5 rounded-xl border border-maroon-soft/10">
                        <div class="flex items-center gap-3">
                            <div
                                class="w-10 h-10 bg-white rounded-lg flex items-center justify-center text-maroon-soft shadow-sm">
                                <i class="fas fa-clipboard-list"></i>
                            </div>
                            <div>
                                <p class="text-[10px] font-black text-maroon-soft uppercase tracking-widest">Detail Kegiatan
                                    Terkait</p>
                                <p class="text-xs font-bold text-slate-700">{{ $anggaran->kegiatan->judul }}</p>
                            </div>
                        </div>
                        <a href="{{ route('pimpinan.kegiatan.show', $anggaran->kegiatan_id) }}"
                            class="text-xs font-bold text-maroon-soft hover:underline flex items-center gap-1">
                            Lihat Kegiatan <i class="fas fa-arrow-right text-[10px]"></i>
                        </a>
                    </div>
                @endif
            </div>

            <div class="p-6 border-t border-slate-100 dark:border-slate-800 bg-slate-50/50 flex justify-start">
                <a href="{{ route('pimpinan.anggaran.index') }}"
                    class="px-6 py-3 bg-white border border-slate-200 text-slate-600 text-xs font-black uppercase tracking-widest rounded-xl hover:bg-slate-50 transition-all">
                    Kembali Ke Daftar
                </a>
            </div>
        </div>
    </div>
@endsection
