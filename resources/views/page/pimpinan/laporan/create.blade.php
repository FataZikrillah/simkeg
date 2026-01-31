@extends('layouts.app')

@section('title', 'Buat Laporan Baru')

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-xl shadow-card overflow-hidden">
            <div class="p-6 border-b border-gray-100">
                <h2 class="text-xl font-bold text-gray-800">Form Laporan Baru</h2>
            </div>

            <form action="{{ route('pimpinan.laporan.store') }}" method="POST" enctype="multipart/form-data"
                class="p-6 space-y-4">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-1">Pilih Kegiatan</label>
                        <select name="kegiatan_id"
                            class="w-full rounded-lg border-gray-300 focus:border-maroon-soft focus:ring-maroon-soft"
                            required>
                            <option value="">-- Pilih Kegiatan --</option>
                            @foreach ($kegiatans as $k)
                                <option value="{{ $k->id }}">{{ $k->judul }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-1">Tanggal Laporan</label>
                        <input type="date" name="tanggal_laporan" value="{{ date('Y-m-d') }}"
                            class="w-full rounded-lg border-gray-300 focus:border-maroon-soft focus:ring-maroon-soft"
                            required>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-1">Judul Laporan</label>
                    <input type="text" name="judul"
                        class="w-full rounded-lg border-gray-300 focus:border-maroon-soft focus:ring-maroon-soft"
                        placeholder="Contoh: Laporan Mingguan Pelaksanaan..." required>
                </div>

                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-1">Isi/Ringkasan Laporan</label>
                    <textarea name="isi" rows="6"
                        class="w-full rounded-lg border-gray-300 focus:border-maroon-soft focus:ring-maroon-soft"
                        placeholder="Tuliskan detail laporan di sini..." required></textarea>
                </div>

                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-1">Lampiran PDF (Opsional)</label>
                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg">
                        <div class="space-y-1 text-center">
                            <i class="fas fa-file-pdf text-4xl text-gray-300 mb-2"></i>
                            <div class="flex text-sm text-gray-600">
                                <label for="file_pdf"
                                    class="relative cursor-pointer bg-white rounded-md font-medium text-maroon-soft hover:text-maroon-soft/80 focus-within:outline-none">
                                    <span>Upload a file</span>
                                    <input id="file_pdf" name="file_pdf" type="file" class="sr-only"
                                        accept="application/pdf">
                                </label>
                                <p class="pl-1">or drag and drop</p>
                            </div>
                            <p class="text-xs text-gray-500">PDF up to 2MB</p>
                        </div>
                    </div>
                </div>

                <div class="pt-4 flex items-center justify-end gap-3">
                    <a href="{{ route('pimpinan.laporan.index') }}"
                        class="px-5 py-2.5 rounded-lg text-sm font-bold text-slate-500 hover:bg-slate-50 transition-all">Batal</a>
                    <button type="submit"
                        class="px-10 py-2.5 rounded-lg text-sm font-bold text-white bg-maroon-soft hover:brightness-110 shadow-lg shadow-maroon-soft/20 transition-all">Simpan
                        Laporan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
