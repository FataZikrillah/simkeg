@extends('layouts.app')

@section('title', 'Edit Laporan')

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="mb-4 text-left">
            <a href="{{ route('staff.laporan.index') }}"
                class="inline-flex items-center text-sm font-bold text-slate-500 hover:text-maroon-soft transition-all">
                <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar Laporan
            </a>
        </div>

        <div class="bg-white rounded-xl shadow-card overflow-hidden">
            <!-- Header with Status Warning -->
            <div class="p-6 border-b border-gray-100 bg-slate-50/50 flex justify-between items-center">
                <div>
                    <h2 class="text-xl font-bold text-gray-800">Edit Laporan Kegiatan</h2>
                    <p class="text-sm text-gray-500 mt-1">Perbarui informasi laporan yang telah Anda kirim sebelumnya.</p>
                </div>
                @if ($laporan->status == 'ditolak')
                    <div class="px-4 py-2 bg-rose-50 border border-rose-100 rounded-lg">
                        <span class="text-[10px] font-black text-rose-600 uppercase tracking-widest block">Status
                            Terkini</span>
                        <span class="text-xs font-bold text-rose-700">Ditolak - Perlu Revisi</span>
                    </div>
                @endif
            </div>

            <form action="{{ route('staff.laporan.update', $laporan->id) }}" method="POST" enctype="multipart/form-data"
                class="p-8">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <!-- Kegiatan -->
                    <div class="md:col-span-1">
                        <label for="kegiatan_id"
                            class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-2">Kegiatan
                            Terkait</label>
                        <select name="kegiatan_id" id="kegiatan_id"
                            class="w-full rounded-lg border-slate-200 focus:ring-maroon-soft focus:border-maroon-soft transition-all text-sm font-medium">
                            @foreach ($kegiatans as $kegiatan)
                                <option value="{{ $kegiatan->id }}"
                                    {{ old('kegiatan_id', $laporan->kegiatan_id) == $kegiatan->id ? 'selected' : '' }}>
                                    {{ $kegiatan->judul }}
                                </option>
                            @endforeach
                        </select>
                        @error('kegiatan_id')
                            <p class="text-rose-500 text-[10px] font-bold mt-1 uppercase tracking-wider">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Judul Laporan -->
                    <div class="md:col-span-1">
                        <label for="judul"
                            class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-2">Judul
                            Laporan</label>
                        <input type="text" name="judul" id="judul" value="{{ old('judul', $laporan->judul) }}"
                            class="w-full rounded-lg border-slate-200 focus:ring-maroon-soft focus:border-maroon-soft transition-all text-sm font-medium">
                        @error('judul')
                            <p class="text-rose-500 text-[10px] font-bold mt-1 uppercase tracking-wider">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mb-6">
                    <!-- Narasi Laporan -->
                    <label for="isi"
                        class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-2">Narasi Laporan
                        (Isi)</label>
                    <textarea name="isi" id="isi" rows="10"
                        class="w-full rounded-lg border-slate-200 focus:ring-maroon-soft focus:border-maroon-soft transition-all text-sm font-medium">{{ old('isi', $laporan->isi) }}</textarea>
                    @error('isi')
                        <p class="text-rose-500 text-[10px] font-bold mt-1 uppercase tracking-wider">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-8">
                    <!-- File PDF -->
                    <label for="file_pdf"
                        class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-2">Lampiran Laporan
                        (Ganti PDF)</label>
                    <div class="mb-3">
                        <a href="{{ asset('storage/' . $laporan->file_pdf) }}" target="_blank"
                            class="inline-flex items-center text-xs font-bold text-maroon-soft hover:underline">
                            <i class="fas fa-file-pdf mr-2"></i> Lihat Lampiran Saat Ini
                        </a>
                    </div>
                    <div class="relative">
                        <input type="file" name="file_pdf" id="file_pdf" accept=".pdf"
                            class="w-full rounded-lg border border-slate-200 p-2.5 text-sm focus:ring-maroon-soft focus:border-maroon-soft bg-slate-50">
                        <p class="mt-2 text-[10px] font-bold text-slate-400 uppercase tracking-tighter">
                            <i class="fas fa-info-circle mr-1"></i> Biarkan kosong jika tidak ingin mengganti lampiran PDF.
                        </p>
                    </div>
                    @error('file_pdf')
                        <p class="text-rose-500 text-[10px] font-bold mt-1 uppercase tracking-wider">{{ $message }}</p>
                    @enderror
                </div>

                <div class="pt-6 border-t border-slate-100">
                    <button type="submit"
                        class="w-full py-3 bg-maroon-soft text-white rounded-xl font-black text-xs uppercase tracking-widest hover:brightness-110 transition-all shadow-lg shadow-maroon-soft/20">
                        <i class="fas fa-save mr-2"></i> Simpan & Kirim Ulang Laporan
                    </button>
                    <p class="text-center mt-4 text-[9px] font-bold text-slate-400 uppercase tracking-tighter italic">
                        Catatan: Status akan dikembalikan ke "Pending" untuk direview kembali oleh Pimpinan.
                    </p>
                </div>
            </form>
        </div>
    </div>
@endsection
