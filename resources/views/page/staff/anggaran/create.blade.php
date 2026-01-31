@extends('layouts.app')

@section('title', 'Buat Pengajuan Anggaran')

@section('content')
    <div class="max-w-3xl mx-auto">
        <div class="mb-4">
            <a href="{{ route('staff.anggaran.index') }}"
                class="inline-flex items-center text-sm font-bold text-slate-500 hover:text-maroon-soft transition-all">
                <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar
            </a>
        </div>

        <div class="bg-white rounded-xl shadow-card overflow-hidden">
            <div class="p-6 border-b border-gray-100 bg-slate-50/50">
                <h2 class="text-xl font-bold text-gray-800">Form Pengajuan Anggaran</h2>
                <p class="text-sm text-gray-500 mt-1">Lengkapi data di bawah ini untuk mengajukan anggaran baru.</p>
            </div>

            <form action="{{ route('staff.anggaran.store') }}" method="POST" class="p-8">
                @csrf

                <div class="space-y-6">
                    <!-- Kegiatan -->
                    <div>
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

                    <!-- Jumlah -->
                    <div>
                        <label for="jumlah"
                            class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-2">Jumlah Anggaran
                            (Rp)</label>
                        <input type="number" name="jumlah" id="jumlah" value="{{ old('jumlah') }}"
                            class="w-full rounded-lg border-slate-200 focus:ring-maroon-soft focus:border-maroon-soft transition-all text-sm font-medium"
                            placeholder="Contoh: 5000000">
                        @error('jumlah')
                            <p class="text-rose-500 text-[10px] font-bold mt-1 uppercase tracking-wider">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Sumber Dana -->
                    <div>
                        <label for="sumber_dana"
                            class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-2">Sumber
                            Dana</label>
                        <input type="text" name="sumber_dana" id="sumber_dana" value="{{ old('sumber_dana') }}"
                            class="w-full rounded-lg border-slate-200 focus:ring-maroon-soft focus:border-maroon-soft transition-all text-sm font-medium"
                            placeholder="Contoh: Kas Organisasi / Sponsor">
                        @error('sumber_dana')
                            <p class="text-rose-500 text-[10px] font-bold mt-1 uppercase tracking-wider">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Keterangan -->
                    <div>
                        <label for="keterangan"
                            class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-2">Keterangan
                            Penggunaan</label>
                        <textarea name="keterangan" id="keterangan" rows="4"
                            class="w-full rounded-lg border-slate-200 focus:ring-maroon-soft focus:border-maroon-soft transition-all text-sm font-medium"
                            placeholder="Jelaskan secara singkat kegunaan anggaran ini...">{{ old('keterangan') }}</textarea>
                        @error('keterangan')
                            <p class="text-rose-500 text-[10px] font-bold mt-1 uppercase tracking-wider">{{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>

                <div class="mt-8 pt-6 border-t border-slate-100">
                    <button type="submit"
                        class="w-full py-3 bg-maroon-soft text-white rounded-xl font-black text-xs uppercase tracking-widest hover:brightness-110 transition-all shadow-lg shadow-maroon-soft/20">
                        Kirim Pengajuan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
