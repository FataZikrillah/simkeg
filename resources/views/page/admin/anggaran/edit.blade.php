@extends('layouts.app')

@section('title', 'Edit Data Anggaran')

@section('content')
    <div class="max-w-4xl mx-auto space-y-6">
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h2 class="text-xl sm:text-2xl font-bold tracking-tight text-maroon-soft">Edit Data Anggaran</h2>
                <p class="text-slate-500 text-sm font-medium italic">
                    Perbarui rincian anggaran untuk kegiatan: {{ $anggaran->kegiatan->judul }}</p>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('admin.anggaran.index') }}"
                    class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-slate-200 rounded-lg text-sm font-semibold hover:bg-beige-bg transition-colors shadow-sm">
                    <i class="fas fa-arrow-left text-maroon-soft"></i>
                    <span>Back to List</span>
                </a>
            </div>
        </div>

        <div class="bg-white rounded-xl border border-slate-200/60 shadow-sm overflow-hidden text-slate-700">
            <div class="p-6 sm:p-8">
                <!-- Form -->
                <form action="{{ route('admin.anggaran.update', $anggaran->id) }}" method="POST" id="editForm">
                    @csrf
                    @method('PUT')

                    <div class="space-y-8">
                        <!-- Primary Information Section -->
                        <div class="space-y-6">
                            <h3
                                class="text-xs font-bold text-abu-muda uppercase tracking-[0.2em] border-b border-slate-50 pb-2">
                                Data Anggaran</h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Activity Selection (Read-only) -->
                                <div class="space-y-2">
                                    <label
                                        class="text-[10px] font-bold text-abu-muda uppercase tracking-wider flex items-center gap-2">
                                        <i class="fas fa-link text-maroon-soft"></i>
                                        Kegiatan
                                    </label>
                                    <div class="relative">
                                        <select name="kegiatan_id_display"
                                            class="w-full pl-11 pr-10 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm appearance-none cursor-not-allowed"
                                            disabled>
                                            <option value="{{ $anggaran->kegiatan_id }}" selected>
                                                {{ $anggaran->kegiatan->judul }}
                                            </option>
                                        </select>
                                        <input type="hidden" name="kegiatan_id" value="{{ $anggaran->kegiatan_id }}">
                                        <div class="absolute left-4 top-1/2 -translate-y-1/2 text-maroon-soft/50">
                                            <i class="fas fa-calendar-alt text-xs"></i>
                                        </div>
                                    </div>
                                    <p class="text-[9px] text-slate-400 italic">Kegiatan tidak dapat diubah setelah anggaran
                                        dibuat.</p>
                                </div>

                                <!-- Budget Amount -->
                                <div class="space-y-2">
                                    <label
                                        class="text-[10px] font-bold text-abu-muda uppercase tracking-wider flex items-center gap-2">
                                        <i class="fas fa-coins text-maroon-soft"></i>
                                        Jumlah Anggaran <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <input type="number" name="jumlah"
                                            class="w-full pl-12 pr-4 py-3 bg-beige-bg/20 border border-slate-200 rounded-xl text-sm font-bold text-slate-700 focus:outline-none focus:ring-2 focus:ring-maroon-soft/20 focus:border-maroon-soft transition-all @error('jumlah') border-red-500 @enderror"
                                            placeholder="0" value="{{ old('jumlah', (int) $anggaran->jumlah) }}" required>
                                        <div
                                            class="absolute left-4 top-1/2 -translate-y-1/2 text-maroon-soft/50 font-bold text-xs uppercase tracking-tighter">
                                            Rp
                                        </div>
                                    </div>
                                    @error('jumlah')
                                        <p class="mt-1 text-xs text-red-500 font-medium">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Source of Funds -->
                                <div class="space-y-2">
                                    <label
                                        class="text-[10px] font-bold text-abu-muda uppercase tracking-wider flex items-center gap-2">
                                        <i class="fas fa-piggy-bank text-maroon-soft"></i>
                                        Sumber Dana <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <select name="sumber_dana"
                                            class="w-full pl-11 pr-10 py-3 bg-beige-bg/20 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-maroon-soft/20 focus:border-maroon-soft transition-all appearance-none @error('sumber_dana') border-red-500 @enderror"
                                            required>
                                            <option value="">-- Pilih Sumber Dana --</option>
                                            <option value="Kas Kantor"
                                                {{ old('sumber_dana', $anggaran->sumber_dana) == 'Kas Kantor' ? 'selected' : '' }}>
                                                Kas Kantor</option>
                                            <option value="Anggaran Tahunan"
                                                {{ old('sumber_dana', $anggaran->sumber_dana) == 'Anggaran Tahunan' ? 'selected' : '' }}>
                                                Anggaran Tahunan</option>
                                            <option value="Dana Darurat"
                                                {{ old('sumber_dana', $anggaran->sumber_dana) == 'Dana Darurat' ? 'selected' : '' }}>
                                                Dana Darurat</option>
                                            <option value="Sponsor"
                                                {{ old('sumber_dana', $anggaran->sumber_dana) == 'Sponsor' ? 'selected' : '' }}>
                                                Sponsor</option>
                                            <option value="Lainnya"
                                                {{ old('sumber_dana', $anggaran->sumber_dana) == 'Lainnya' ? 'selected' : '' }}>
                                                Lainnya</option>
                                        </select>
                                        <div class="absolute left-4 top-1/2 -translate-y-1/2 text-maroon-soft/50">
                                            <i class="fas fa-university text-xs"></i>
                                        </div>
                                        <div
                                            class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none">
                                            <i class="fas fa-chevron-down text-[10px]"></i>
                                        </div>
                                    </div>
                                    @error('sumber_dana')
                                        <p class="mt-1 text-xs text-red-500 font-medium">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Status -->
                                <div class="space-y-2">
                                    <label
                                        class="text-[10px] font-bold text-abu-muda uppercase tracking-wider flex items-center gap-2">
                                        <i class="fas fa-tasks text-maroon-soft"></i>
                                        Status Anggaran
                                    </label>
                                    <div class="relative">
                                        <select name="status"
                                            class="w-full pl-11 pr-10 py-3 bg-white border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-maroon-soft/20 focus:border-maroon-soft transition-all appearance-none @error('status') border-red-500 @enderror">
                                            <option value="pending"
                                                {{ old('status', $anggaran->status) == 'pending' ? 'selected' : '' }}>
                                                Pending (Menunggu Review)</option>
                                            <option value="disetujui"
                                                {{ old('status', $anggaran->status) == 'disetujui' ? 'selected' : '' }}>
                                                Disetujui (Disetujui)</option>
                                            <option value="ditolak"
                                                {{ old('status', $anggaran->status) == 'ditolak' ? 'selected' : '' }}>
                                                Ditolak (Ditolak)</option>
                                        </select>
                                        <div class="absolute left-4 top-1/2 -translate-y-1/2 text-maroon-soft/50">
                                            <i class="fas fa-shield-alt text-xs"></i>
                                        </div>
                                        <div
                                            class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none">
                                            <i class="fas fa-chevron-down text-[10px]"></i>
                                        </div>
                                    </div>
                                    @error('status')
                                        <p class="mt-1 text-xs text-red-500 font-medium">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Description Section -->
                        <div class="space-y-6">
                            <h3
                                class="text-xs font-bold text-abu-muda uppercase tracking-[0.2em] border-b border-slate-50 pb-2">
                                Tujuan dan Penjelasan</h3>
                            <div class="space-y-2">
                                <label
                                    class="text-[10px] font-bold text-abu-muda uppercase tracking-wider flex items-center gap-2">
                                    <i class="fas fa-align-left text-maroon-soft"></i>
                                    Deskripsi Anggaran <span class="text-red-500">*</span>
                                </label>
                                <textarea name="keterangan" rows="4"
                                    class="w-full px-4 py-3 bg-beige-bg/20 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-maroon-soft/20 focus:border-maroon-soft transition-all @error('keterangan') border-red-500 @enderror"
                                    placeholder="Jelaskan rincian penggunaan anggaran..." required>{{ old('keterangan', $anggaran->keterangan) }}</textarea>
                                @error('keterangan')
                                    <p class="mt-1 text-xs text-red-500 font-medium">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Security Notice -->
                        <div class="flex items-center gap-4 p-4 bg-maroon-soft/5 rounded-2xl border border-maroon-soft/10">
                            <div
                                class="w-10 h-10 rounded-xl bg-white flex items-center justify-center text-maroon-soft shadow-sm border border-slate-100 shrink-0">
                                <i class="fas fa-lock"></i>
                            </div>
                            <p class="text-[11px] text-maroon-soft/80 font-medium leading-relaxed italic">
                                Perubahan pada data anggaran akan tercatat dalam log audit sistem. Pastikan semua rincian
                                akurat dan transparan.
                            </p>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="mt-10 pt-6 border-t border-slate-100 flex flex-col sm:flex-row justify-end gap-3">
                        <a href="{{ route('admin.anggaran.index') }}"
                            class="px-6 py-3 bg-white border border-slate-200 rounded-xl text-sm font-bold text-slate-600 hover:bg-slate-50 transition-all text-center">
                            Batal
                        </a>
                        <button type="submit"
                            class="px-10 py-3 bg-maroon-soft text-white rounded-xl text-sm font-bold hover:brightness-110 shadow-lg shadow-maroon-soft/20 transition-all">
                            <i class="fas fa-save mr-2"></i> Perbarui Anggaran
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Professional Information Card -->
        <div class="bg-beige-bg/10 border border-slate-200/60 rounded-2xl p-6 relative overflow-hidden">
            <div class="absolute right-0 top-0 p-8 opacity-5">
                <i class="fas fa-shield-check text-8xl"></i>
            </div>
            <div class="flex gap-4 relative z-10">
                <div
                    class="w-12 h-12 rounded-xl bg-white flex items-center justify-center text-maroon-soft shadow-sm border border-slate-100 shrink-0">
                    <i class="fas fa-info-circle text-lg"></i>
                </div>
                <div>
                    <h4 class="text-sm font-bold text-slate-800 mb-2 uppercase tracking-tight">Petunjuk Pembaruan</h4>
                    <ul class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-2">
                        <li class="flex items-start gap-2 text-xs text-slate-500 leading-relaxed">
                            <span class="w-1 h-1 rounded-full bg-maroon-soft mt-1.5 shrink-0"></span>
                            Pastikan jumlah anggaran tidak melebihi alokasi maksimal kegiatan.
                        </li>
                        <li class="flex items-start gap-2 text-xs text-slate-500 leading-relaxed">
                            <span class="w-1 h-1 rounded-full bg-maroon-soft mt-1.5 shrink-0"></span>
                            Perubahan status menjadi 'Disetujui' akan mengunci beberapa field di masa mendatang.
                        </li>
                        <li class="flex items-start gap-2 text-xs text-slate-500 leading-relaxed">
                            <span class="w-1 h-1 rounded-full bg-maroon-soft mt-1.5 shrink-0"></span>
                            Sumber dana harus sesuai dengan kebijakan keuangan organisasi.
                        </li>
                        <li class="flex items-start gap-2 text-xs text-slate-500 leading-relaxed">
                            <span class="w-1 h-1 rounded-full bg-maroon-soft mt-1.5 shrink-0"></span>
                            Deskripsi yang jelas akan mempercepat proses audit internal.
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
