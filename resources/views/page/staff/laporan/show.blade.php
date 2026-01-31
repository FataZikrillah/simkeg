@extends('layouts.app')

@section('title', 'Detail Laporan')

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="mb-4 text-left">
            <a href="{{ route('staff.laporan.index') }}"
                class="inline-flex items-center text-sm font-bold text-slate-500 hover:text-maroon-soft transition-all">
                <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar Laporan
            </a>
        </div>

        <div class="bg-white rounded-xl shadow-card overflow-hidden">
            <!-- Modal Header Look -->
            <div
                class="p-8 border-b border-gray-100 flex flex-col md:flex-row justify-between items-start md:items-center gap-6 bg-slate-50/50">
                <div class="flex-1">
                    <div class="flex items-center gap-3 mb-3">
                        <span
                            class="px-2.5 py-1 bg-white border border-slate-200 rounded-lg text-[10px] font-black text-slate-400 uppercase tracking-widest">Detail
                            Laporan</span>
                        <span
                            class="px-2.5 py-1 rounded-lg text-[10px] font-bold uppercase tracking-wider
                            @if ($laporan->status == 'disetujui') bg-emerald-100 text-emerald-700
                            @elseif($laporan->status == 'ditolak') bg-rose-100 text-rose-700
                            @else bg-amber-100 text-amber-700 @endif inline-flex items-center gap-1.5">
                            <i
                                class="fas {{ $laporan->status == 'disetujui' ? 'fa-check-circle' : ($laporan->status == 'ditolak' ? 'fa-times-circle' : 'fa-clock') }}"></i>
                            {{ ucfirst($laporan->status) }}
                        </span>
                    </div>
                    <h2 class="text-2xl font-black text-gray-800 leading-tight">{{ $laporan->judul }}</h2>
                    <p class="text-xs font-bold text-maroon-soft mt-2 uppercase tracking-wide">
                        <i class="fas fa-calendar-check mr-1"></i> Kegiatan: {{ $laporan->kegiatan->judul ?? 'N/A' }}
                    </p>
                </div>

                <div class="flex flex-col gap-2 w-full md:w-auto">
                    @if ($laporan->status != 'disetujui')
                        <a href="{{ route('staff.laporan.edit', $laporan->id) }}"
                            class="px-6 py-2.5 bg-white border border-slate-200 text-slate-600 rounded-xl font-bold text-[10px] uppercase tracking-widest text-center hover:bg-slate-50 transition-all shadow-sm">
                            <i class="fas fa-edit mr-2"></i> Edit Laporan
                        </a>
                    @endif
                    <a href="{{ asset('storage/' . $laporan->file_pdf) }}" target="_blank"
                        class="px-6 py-2.5 bg-maroon-soft text-white rounded-xl font-bold text-[10px] uppercase tracking-widest text-center hover:brightness-110 transition-all shadow-md shadow-maroon-soft/20">
                        <i class="fas fa-file-pdf mr-2"></i> Buka Lampiran PDF
                    </a>
                </div>
            </div>

            <div class="p-8">
                <!-- Meta Data -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-10 pb-8 border-b border-slate-100">
                    <div>
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Tanggal Kirim</p>
                        <p class="text-sm font-bold text-slate-700">{{ $laporan->created_at->format('d F Y, H:i') }}</p>
                    </div>
                    <div>
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Terakhir Diperbarui
                        </p>
                        <p class="text-sm font-bold text-slate-700">{{ $laporan->updated_at->format('d F Y, H:i') }}</p>
                    </div>
                </div>

                <!-- Narasi Content -->
                <div class="prose prose-slate max-w-none">
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-4">Narasi / Isi Laporan</p>
                    <div class="bg-slate-50/50 rounded-2xl p-6 md:p-8 border border-slate-100 min-h-[300px]">
                        <p class="text-slate-600 text-sm leading-relaxed whitespace-pre-line">
                            {{ $laporan->isi }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Footer Action for Rejection -->
            @if ($laporan->status == 'ditolak')
                <div class="p-6 bg-rose-50 border-t border-rose-100">
                    <div class="flex items-start gap-4">
                        <div
                            class="w-10 h-10 bg-rose-100 rounded-xl flex items-center justify-center text-rose-600 flex-shrink-0">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-rose-800">Laporan perlu Anda revisi.</p>
                            <p class="text-xs text-rose-600/80 mt-1">Status laporan ini telah ditolak oleh Pimpinan. Harap
                                lakukan perbaikan pada isi atau lampiran sesuai dengan arahan pimpinan dan tekan tombol
                                simpan ulang di halaman edit.</p>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
