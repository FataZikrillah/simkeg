@extends('layouts.app')

@section('title', 'Edit Dokumentasi')

@section('content')
    <div class="max-w-3xl mx-auto">
        <div class="mb-4">
            <a href="{{ route('staff.dokumentasi.index') }}"
                class="inline-flex items-center text-sm font-bold text-slate-500 hover:text-maroon-soft transition-all">
                <i class="fas fa-arrow-left mr-2"></i> Kembali ke Galeri
            </a>
        </div>

        <div class="bg-white rounded-xl shadow-card overflow-hidden">
            <div class="p-6 border-b border-gray-100 bg-slate-50/50">
                <h2 class="text-xl font-bold text-gray-800">Edit Data Dokumentasi</h2>
                <p class="text-sm text-gray-500 mt-1">Lakukan perubahan pada foto atau keterangan di bawah ini.</p>
            </div>

            <form action="{{ route('staff.dokumentasi.update', $dokumentasi->id) }}" method="POST"
                enctype="multipart/form-data" class="p-8">
                @csrf
                @method('PUT')

                <div class="space-y-6">
                    <!-- Current Preview -->
                    <div>
                        <label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-2">Foto Saat
                            Ini</label>
                        <div class="relative w-full aspect-video rounded-xl overflow-hidden border border-slate-200">
                            <img src="{{ asset('storage/' . $dokumentasi->file) }}" class="w-full h-full object-cover">
                        </div>
                    </div>

                    <!-- Kegiatan -->
                    <div>
                        <label for="kegiatan_id"
                            class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-2">Kegiatan
                            Terkait</label>
                        <select name="kegiatan_id" id="kegiatan_id"
                            class="w-full rounded-lg border-slate-200 focus:ring-maroon-soft focus:border-maroon-soft transition-all text-sm font-medium">
                            @foreach ($kegiatans as $kegiatan)
                                <option value="{{ $kegiatan->id }}"
                                    {{ old('kegiatan_id', $dokumentasi->kegiatan_id) == $kegiatan->id ? 'selected' : '' }}>
                                    {{ $kegiatan->judul }}
                                </option>
                            @endforeach
                        </select>
                        @error('kegiatan_id')
                            <p class="text-rose-500 text-[10px] font-bold mt-1 uppercase tracking-wider">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Replacement File -->
                    <div>
                        <label for="file"
                            class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-2">Ganti Foto
                            (Opsional)</label>
                        <input type="file" name="file" id="file"
                            class="w-full rounded-lg border border-slate-200 p-2 text-sm focus:ring-maroon-soft focus:border-maroon-soft">
                        <p class="mt-1 text-[10px] font-bold text-slate-400 uppercase tracking-tighter italic">Kosongkan
                            jika tidak ingin mengganti foto</p>
                        @error('file')
                            <p class="text-rose-500 text-[10px] font-bold mt-1 uppercase tracking-wider">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Keterangan -->
                    <div>
                        <label for="keterangan"
                            class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-2">Pembaruan
                            Keterangan</label>
                        <textarea name="keterangan" id="keterangan" rows="4"
                            class="w-full rounded-lg border-slate-200 focus:ring-maroon-soft focus:border-maroon-soft transition-all text-sm font-medium">{{ old('keterangan', $dokumentasi->keterangan) }}</textarea>
                        @error('keterangan')
                            <p class="text-rose-500 text-[10px] font-bold mt-1 uppercase tracking-wider">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-8 pt-6 border-t border-slate-100">
                    <button type="submit"
                        class="w-full py-3 bg-maroon-soft text-white rounded-xl font-black text-xs uppercase tracking-widest hover:brightness-110 transition-all shadow-lg shadow-maroon-soft/20">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
