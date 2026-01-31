@extends('layouts.app')

@section('title', 'Buat Laporan Baru')

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="mb-4 text-left">
            <a href="{{ route('staff.laporan.index') }}"
                class="inline-flex items-center text-sm font-bold text-slate-500 hover:text-maroon-soft transition-all">
                <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar Laporan
            </a>
        </div>

        <div class="bg-white rounded-xl shadow-card overflow-hidden">
            <div class="p-6 border-b border-gray-100 bg-slate-50/50">
                <h2 class="text-xl font-bold text-gray-800">Laporan Kegiatan</h2>
                <p class="text-sm text-gray-500 mt-1">Gunakan formulir ini untuk melaporkan hasil pelaksanaan kegiatan.</p>
            </div>

            <form action="{{ route('staff.laporan.store') }}" method="POST" enctype="multipart/form-data" class="p-8">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <!-- Kegiatan -->
                    <div class="md:col-span-1">
                        <label for="kegiatan_id"
                            class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-2">Pilih
                            Kegiatan</label>
                        <select name="kegiatan_id" id="kegiatan_id"
                            class="w-full rounded-lg border-slate-200 focus:ring-maroon-soft focus:border-maroon-soft transition-all text-sm font-medium">
                            <option value="">-- Pilih Kegiatan --</option>
                            @foreach ($kegiatans as $kegiatan)
                                <option value="{{ $kegiatan->id }}"
                                    {{ old('kegiatan_id') == $kegiatan->id ? 'selected' : '' }}>
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
                        <input type="text" name="judul" id="judul" value="{{ old('judul') }}"
                            class="w-full rounded-lg border-slate-200 focus:ring-maroon-soft focus:border-maroon-soft transition-all text-sm font-medium"
                            placeholder="Contoh: Laporan Akhir Pelaksanaan Seminar">
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
                        class="w-full rounded-lg border-slate-200 focus:ring-maroon-soft focus:border-maroon-soft transition-all text-sm font-medium"
                        placeholder="Tuliskan detail pelaksanaan kegiatan, kendala, dan hasil yang dicapai...">{{ old('isi') }}</textarea>
                    @error('isi')
                        <p class="text-rose-500 text-[10px] font-bold mt-1 uppercase tracking-wider">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-8">
                    <!-- File PDF -->
                    <label for="file_pdf"
                        class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-2">Lampiran Laporan
                        (PDF)</label>
                    <div class="relative">
                        <input type="file" name="file_pdf" id="file_pdf" accept=".pdf"
                            class="w-full rounded-lg border border-slate-200 p-2.5 text-sm focus:ring-maroon-soft focus:border-maroon-soft bg-slate-50">
                        <p class="mt-2 text-[10px] font-bold text-slate-400 uppercase tracking-tighter">
                            <i class="fas fa-info-circle mr-1"></i> Format berkas harus PDF, maksimal ukuran 2MB.
                        </p>
                    </div>
                    @error('file_pdf')
                        <p class="text-rose-500 text-[10px] font-bold mt-1 uppercase tracking-wider">{{ $message }}</p>
                    @enderror
                </div>

                <div class="pt-6 border-t border-slate-100 flex flex-col md:flex-row gap-4">
                    <button type="submit"
                        class="flex-1 py-3 bg-maroon-soft text-white rounded-xl font-black text-xs uppercase tracking-widest hover:brightness-110 transition-all shadow-lg shadow-maroon-soft/20">
                        <i class="fas fa-paper-plane mr-2"></i> Kirim Laporan
                    </button>
                    <a href="{{ route('staff.laporan.index') }}"
                        class="flex-1 py-3 bg-slate-100 text-slate-600 rounded-xl font-black text-xs uppercase tracking-widest text-center hover:bg-slate-200 transition-all">
                        Batalkan
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
