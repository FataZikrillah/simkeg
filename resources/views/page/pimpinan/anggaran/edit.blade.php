@extends('layouts.app')

@section('title', 'Edit Anggaran')
@section('subtitle', 'Perbarui alokasi anggarankegiatan')

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200/60 shadow-sm overflow-hidden">
            <div class="p-6 border-b border-slate-100 dark:border-slate-800 bg-gradient-to-r from-white to-slate-50/50">
                <div class="flex items-center gap-3">
                    <div class="p-2 bg-maroon-soft/10 rounded-lg">
                        <i class="fas fa-edit text-maroon-soft"></i>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-slate-800 dark:text-white">Edit Alokasi Anggaran</h2>
                        <p class="text-slate-500 text-xs mt-1 font-medium">Perbarui detail anggaran #ANG-{{ $anggaran->id }}
                        </p>
                    </div>
                </div>
            </div>

            <form action="{{ route('pimpinan.anggaran.update', $anggaran->id) }}" method="POST" class="p-6 space-y-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Kegiatan -->
                    <div class="space-y-2">
                        <label for="kegiatan_id"
                            class="text-xs font-black text-slate-700 dark:text-slate-300 uppercase tracking-widest">Kegiatan</label>
                        <select name="kegiatan_id" id="kegiatan_id"
                            class="w-full bg-slate-50 dark:bg-slate-800 border-2 border-slate-100 dark:border-slate-700 rounded-xl px-4 py-3 text-sm font-semibold focus:border-maroon-soft focus:ring-0 transition-all @error('kegiatan_id') border-rose-500 @enderror">
                            <option value="">Pilih Kegiatan</option>
                            @foreach ($kegiatans as $kegiatan)
                                <option value="{{ $kegiatan->id }}"
                                    {{ (old('kegiatan_id') ?? $anggaran->kegiatan_id) == $kegiatan->id ? 'selected' : '' }}>
                                    {{ $kegiatan->judul }}
                                </option>
                            @endforeach
                        </select>
                        @error('kegiatan_id')
                            <p class="text-[10px] text-rose-500 font-bold uppercase">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Jumlah -->
                    <div class="space-y-2">
                        <label for="jumlah"
                            class="text-xs font-black text-slate-700 dark:text-slate-300 uppercase tracking-widest">Jumlah
                            Anggaran (Rp)</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 font-bold">Rp</span>
                            <input type="number" name="jumlah" id="jumlah"
                                value="{{ old('jumlah') ?? $anggaran->jumlah }}" placeholder="0"
                                class="w-full bg-slate-50 dark:bg-slate-800 border-2 border-slate-100 dark:border-slate-700 rounded-xl pl-12 pr-4 py-3 text-sm font-semibold focus:border-maroon-soft focus:ring-0 transition-all @error('jumlah') border-rose-500 @enderror">
                        </div>
                        @error('jumlah')
                            <p class="text-[10px] text-rose-500 font-bold uppercase">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Sumber Dana -->
                    <div class="space-y-2">
                        <label for="sumber_dana"
                            class="text-xs font-black text-slate-700 dark:text-slate-300 uppercase tracking-widest">Sumber
                            Dana</label>
                        <input type="text" name="sumber_dana" id="sumber_dana"
                            value="{{ old('sumber_dana') ?? $anggaran->sumber_dana }}"
                            placeholder="Contoh: APBD, Sponsor, Hibah"
                            class="w-full bg-slate-50 dark:bg-slate-800 border-2 border-slate-100 dark:border-slate-700 rounded-xl px-4 py-3 text-sm font-semibold focus:border-maroon-soft focus:ring-0 transition-all @error('sumber_dana') border-rose-500 @enderror">
                        @error('sumber_dana')
                            <p class="text-[10px] text-rose-500 font-bold uppercase">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div class="space-y-2">
                        <label for="status"
                            class="text-xs font-black text-slate-700 dark:text-slate-300 uppercase tracking-widest">Status</label>
                        <select name="status" id="status"
                            class="w-full bg-slate-50 dark:bg-slate-800 border-2 border-slate-100 dark:border-slate-700 rounded-xl px-4 py-3 text-sm font-semibold focus:border-maroon-soft focus:ring-0 transition-all @error('status') border-rose-500 @enderror">
                            <option value="pending"
                                {{ (old('status') ?? $anggaran->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="disetujui"
                                {{ (old('status') ?? $anggaran->status) == 'disetujui' ? 'selected' : '' }}>Disetujui
                            </option>
                        </select>
                        @error('status')
                            <p class="text-[10px] text-rose-500 font-bold uppercase">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Keterangan -->
                <div class="space-y-2">
                    <label for="keterangan"
                        class="text-xs font-black text-slate-700 dark:text-slate-300 uppercase tracking-widest">Keterangan
                        (Opsional)</label>
                    <textarea name="keterangan" id="keterangan" rows="3" placeholder="Tambahkan catatan jika perlu..."
                        class="w-full bg-slate-50 dark:bg-slate-800 border-2 border-slate-100 dark:border-slate-700 rounded-xl px-4 py-3 text-sm font-semibold focus:border-maroon-soft focus:ring-0 transition-all @error('keterangan') border-rose-500 @enderror">{{ old('keterangan') ?? $anggaran->keterangan }}</textarea>
                    @error('keterangan')
                        <p class="text-[10px] text-rose-500 font-bold uppercase">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-end gap-3 pt-4">
                    <a href="{{ route('pimpinan.anggaran.index') }}"
                        class="px-6 py-3 bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-400 text-xs font-black uppercase tracking-widest rounded-xl hover:bg-slate-200 transition-all">
                        Batal
                    </a>
                    <button type="submit"
                        class="px-8 py-3 bg-maroon-soft text-white text-xs font-black uppercase tracking-widest rounded-xl hover:brightness-110 shadow-lg shadow-maroon-soft/20 transition-all">
                        Update Anggaran
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
