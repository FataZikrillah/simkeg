@extends('layouts.app')

@section('title', 'Tambah Kegiatan Baru')

@section('content')
    <div class="max-w-4xl mx-auto space-y-6">
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h2 class="text-xl sm:text-2xl font-bold tracking-tight text-maroon-soft">Tambah Kegiatan Baru
                </h2>
                <p class="text-slate-500 dark:text-slate-400 text-sm font-medium">Isi form berikut untuk menambahkan
                    kegiatan baru.</p>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('admin.kegiatan.index') }}"
                    class="inline-flex items-center gap-2 px-3 sm:px-4 py-2 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg text-xs sm:text-sm font-semibold hover:bg-beige-bg dark:hover:bg-slate-700 transition-colors shadow-sm">
                    <i class="fas fa-arrow-left"></i>
                    <span>Kembali</span>
                </a>
            </div>
        </div>

        <div
            class="bg-white dark:bg-slate-900 rounded-xl border border-slate-200/60 dark:border-slate-800 shadow-sm p-6 sm:p-8">
            <!-- Progress Steps -->
            <div class="mb-10">
                <div class="flex items-center">
                    <div class="flex items-center relative gap-3">
                        <div
                            class="h-10 w-10 rounded-full bg-maroon-soft text-white flex items-center justify-center font-bold shadow-lg shadow-maroon-soft/20">
                            1
                        </div>
                        <div>
                            <p class="text-xs font-bold text-maroon-soft uppercase tracking-widest">Step 01</p>
                            <p class="text-sm font-bold text-slate-800">Informasi Dasar</p>
                        </div>
                    </div>
                    <div class="flex-1 h-[2px] bg-beige-bg mx-6"></div>
                    <div class="flex items-center relative gap-3 opacity-50">
                        <div
                            class="h-10 w-10 rounded-full bg-slate-100 text-slate-400 flex items-center justify-center font-bold">
                            2
                        </div>
                        <div>
                            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Step 02</p>
                            <p class="text-sm font-bold text-slate-500">Detail Kegiatan</p>
                        </div>
                    </div>
                </div>
            </div>
            <form action="{{ route('admin.kegiatan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Left Column -->
                    <div class="space-y-6">
                        <!-- Judul Kegiatan -->
                        <div class="space-y-2">
                            <label class="text-xs font-bold text-abu-muda uppercase tracking-wider flex items-center gap-2">
                                <i class="fas fa-heading text-maroon-soft"></i>
                                Judul Kegiatan <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="judul"
                                class="w-full px-4 py-3 bg-beige-bg/20 border border-slate-200 dark:border-slate-700 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-maroon-soft/20 focus:border-maroon-soft transition-all @error('judul') border-red-500 @enderror"
                                placeholder="Masukkan judul kegiatan" value="{{ old('judul') }}" required>
                            @error('judul')
                                <p class="mt-1 text-xs text-red-500 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tanggal & Waktu -->
                        <div class="grid grid-cols-2 gap-4">
                            <div class="space-y-2">
                                <label
                                    class="text-xs font-bold text-abu-muda uppercase tracking-wider flex items-center gap-2">
                                    <i class="fas fa-calendar text-maroon-soft"></i>
                                    Tanggal <span class="text-red-500">*</span>
                                </label>
                                <input type="date" name="tanggal"
                                    class="w-full px-4 py-3 bg-beige-bg/20 border border-slate-200 dark:border-slate-700 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-maroon-soft/20 focus:border-maroon-soft transition-all @error('tanggal') border-red-500 @enderror"
                                    value="{{ old('tanggal') }}" required>
                                @error('tanggal')
                                    <p class="mt-1 text-xs text-red-500 font-medium">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="space-y-2">
                                <label
                                    class="text-xs font-bold text-abu-muda uppercase tracking-wider flex items-center gap-2">
                                    <i class="fas fa-clock text-maroon-soft"></i>
                                    Waktu Mulai
                                </label>
                                <input type="time" name="waktu_mulai"
                                    class="w-full px-4 py-3 bg-beige-bg/20 border border-slate-200 dark:border-slate-700 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-maroon-soft/20 focus:border-maroon-soft transition-all @error('waktu_mulai') border-red-500 @enderror"
                                    value="{{ old('waktu_mulai') }}">
                                @error('waktu_mulai')
                                    <p class="mt-1 text-xs text-red-500 font-medium">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Lokasi -->
                        <div class="space-y-2">
                            <label class="text-xs font-bold text-abu-muda uppercase tracking-wider flex items-center gap-2">
                                <i class="fas fa-map-marker-alt text-maroon-soft"></i>
                                Lokasi <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="lokasi"
                                class="w-full px-4 py-3 bg-beige-bg/20 border border-slate-200 dark:border-slate-700 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-maroon-soft/20 focus:border-maroon-soft transition-all @error('lokasi') border-red-500 @enderror"
                                placeholder="Tempat kegiatan dilaksanakan" value="{{ old('lokasi') }}" required>
                            @error('lokasi')
                                <p class="mt-1 text-xs text-red-500 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Penanggung Jawab -->
                        <div class="space-y-2">
                            <label class="text-xs font-bold text-abu-muda uppercase tracking-wider flex items-center gap-2">
                                <i class="fas fa-user-tie text-maroon-soft"></i>
                                Penanggung Jawab
                            </label>
                            <div class="relative">
                                <select name="user_id"
                                    class="w-full px-4 py-3 bg-beige-bg/20 border border-slate-200 dark:border-slate-700 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-maroon-soft/20 focus:border-maroon-soft transition-all appearance-none @error('user_id') border-red-500 @enderror">
                                    <option value="">Pilih Penanggung Jawab</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                            {{ $user->name }} ({{ ucfirst($user->role) }})
                                        </option>
                                    @endforeach
                                </select>
                                <div
                                    class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-slate-400">
                                    <i class="fas fa-chevron-down text-xs"></i>
                                </div>
                            </div>
                            @error('user_id')
                                <p class="mt-1 text-xs text-red-500 font-medium">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="space-y-6">
                        <!-- Prioritas -->
                        <div class="space-y-2">
                            <label class="text-xs font-bold text-abu-muda uppercase tracking-wider flex items-center gap-2">
                                <i class="fas fa-flag text-maroon-soft"></i>
                                Prioritas
                            </label>
                            <div class="grid grid-cols-3 gap-3">
                                <label class="relative group">
                                    <input type="radio" name="prioritas" value="rendah" class="sr-only peer" {{ old('prioritas') == 'rendah' ? 'checked' : '' }}>
                                    <div
                                        class="p-3 border border-slate-200 dark:border-slate-800 rounded-xl text-center cursor-pointer transition-all peer-checked:border-maroon-soft peer-checked:bg-maroon-soft/5 group-hover:border-maroon-soft/30">
                                        <i class="fas fa-flag text-sage text-sm mb-1"></i>
                                        <p class="text-[10px] font-bold text-slate-600 uppercase">Rendah</p>
                                    </div>
                                    <div class="absolute -top-1 -right-1 hidden peer-checked:block">
                                        <div class="bg-maroon-soft text-white text-[8px] rounded-full p-0.5 shadow-sm">
                                            <i class="fas fa-check"></i>
                                        </div>
                                    </div>
                                </label>
                                <label class="relative group">
                                    <input type="radio" name="prioritas" value="sedang" class="sr-only peer" {{ old('prioritas', 'sedang') == 'sedang' ? 'checked' : '' }}>
                                    <div
                                        class="p-3 border border-slate-200 dark:border-slate-800 rounded-xl text-center cursor-pointer transition-all peer-checked:border-maroon-soft peer-checked:bg-maroon-soft/5 group-hover:border-maroon-soft/30">
                                        <i class="fas fa-flag text-amber-500 text-sm mb-1"></i>
                                        <p class="text-[10px] font-bold text-slate-600 uppercase">Sedang</p>
                                    </div>
                                    <div class="absolute -top-1 -right-1 hidden peer-checked:block">
                                        <div class="bg-maroon-soft text-white text-[8px] rounded-full p-0.5 shadow-sm">
                                            <i class="fas fa-check"></i>
                                        </div>
                                    </div>
                                </label>
                                <label class="relative group">
                                    <input type="radio" name="prioritas" value="tinggi" class="sr-only peer" {{ old('prioritas') == 'tinggi' ? 'checked' : '' }}>
                                    <div
                                        class="p-3 border border-slate-200 dark:border-slate-800 rounded-xl text-center cursor-pointer transition-all peer-checked:border-maroon-soft peer-checked:bg-maroon-soft/5 group-hover:border-maroon-soft/30">
                                        <i class="fas fa-flag text-red-500 text-sm mb-1"></i>
                                        <p class="text-[10px] font-bold text-slate-600 uppercase">Tinggi</p>
                                    </div>
                                    <div class="absolute -top-1 -right-1 hidden peer-checked:block">
                                        <div class="bg-maroon-soft text-white text-[8px] rounded-full p-0.5 shadow-sm">
                                            <i class="fas fa-check"></i>
                                        </div>
                                    </div>
                                </label>
                            </div>
                            @error('prioritas')
                                <p class="mt-1 text-xs text-red-500 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div class="space-y-2">
                            <label class="text-xs font-bold text-abu-muda uppercase tracking-wider flex items-center gap-2">
                                <i class="fas fa-tasks text-maroon-soft"></i>
                                Status
                            </label>
                            <div class="relative">
                                <select name="status"
                                    class="w-full px-4 py-3 bg-beige-bg/20 border border-slate-200 dark:border-slate-700 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-maroon-soft/20 focus:border-maroon-soft transition-all appearance-none @error('status') border-red-500 @enderror">
                                    <option value="pending" {{ old('status', 'pending') == 'pending' ? 'selected' : '' }}>
                                        Pending
                                    </option>
                                    <option value="disetujui" {{ old('status') == 'disetujui' ? 'selected' : '' }}>Disetujui
                                    </option>
                                    <option value="ditolak" {{ old('status') == 'ditolak' ? 'selected' : '' }}>Ditolak
                                    </option>
                                    <option value="selesai" {{ old('status') == 'selesai' ? 'selected' : '' }}>Selesai
                                    </option>
                                </select>
                                <div
                                    class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-slate-400">
                                    <i class="fas fa-chevron-down text-xs"></i>
                                </div>
                            </div>
                            @error('status')
                                <p class="mt-1 text-xs text-red-500 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Deskripsi -->
                        <div class="space-y-2">
                            <label class="text-xs font-bold text-abu-muda uppercase tracking-wider flex items-center gap-2">
                                <i class="fas fa-align-left text-maroon-soft"></i>
                                Deskripsi <span class="text-red-500">*</span>
                            </label>
                            <textarea name="deskripsi" rows="3"
                                class="w-full px-4 py-3 bg-beige-bg/20 border border-slate-200 dark:border-slate-700 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-maroon-soft/20 focus:border-maroon-soft transition-all @error('deskripsi') border-red-500 @enderror"
                                placeholder="Deskripsi lengkap kegiatan..." required>{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
                                <p class="mt-1 text-xs text-red-500 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Primary Image Upload -->
                        <div class="space-y-2">
                            <label class="text-xs font-bold text-abu-muda uppercase tracking-wider flex items-center gap-2">
                                <i class="fas fa-image text-maroon-soft"></i>
                                Foto Utama (Cover)
                            </label>
                            <div class="relative group">
                                <div id="image-preview-wrapper"
                                    class="flex flex-col items-center justify-center w-full h-48 transition bg-white dark:bg-slate-900 border-2 border-slate-200 dark:border-slate-800 border-dashed rounded-xl overflow-hidden cursor-pointer group-hover:border-maroon-soft/50 focus:outline-none">

                                    <!-- Placeholder Content -->
                                    <div id="placeholder-content"
                                        class="flex flex-col items-center justify-center space-y-2">
                                        <i class="fas fa-camera text-maroon-soft text-2xl"></i>
                                        <span class="text-xs font-bold text-slate-500">
                                            Upload <span class="text-maroon-soft">foto utama</span>
                                        </span>
                                        <p class="text-[10px] text-slate-400">1200x600px recommended</p>
                                    </div>

                                    <!-- Image Preview -->
                                    <img id="image-preview" src="#" alt="Preview" class="hidden w-full h-full object-cover">

                                    <input type="file" name="image" id="image-input" accept="image/*"
                                        class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">

                                    <!-- Change Overlay (shown when image exists) -->
                                    <div id="change-overlay"
                                        class="hidden absolute inset-0 bg-black/40 items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                        <span
                                            class="px-3 py-1 bg-white/20 backdrop-blur-md border border-white/30 rounded-full text-[10px] text-white font-bold uppercase tracking-wider">
                                            Ganti Foto
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- File Upload -->
                        <div class="space-y-2">
                            <label class="text-xs font-bold text-abu-muda uppercase tracking-wider flex items-center gap-2">
                                <i class="fas fa-paperclip text-maroon-soft"></i>
                                Lampiran Tambahan
                            </label>
                            <div class="relative group">
                                <div id="file-preview-wrapper"
                                    class="flex flex-col items-center justify-center w-full min-h-[96px] px-4 transition bg-white dark:bg-slate-900 border-2 border-slate-200 dark:border-slate-800 border-dashed rounded-xl appearance-none cursor-pointer group-hover:border-maroon-soft/50 focus:outline-none py-4">

                                    <!-- Placeholder Content -->
                                    <div id="file-placeholder" class="flex flex-col items-center justify-center space-y-2">
                                        <i class="fas fa-cloud-upload-alt text-slate-400 text-2xl"></i>
                                        <span class="text-[10px] font-bold text-slate-500">
                                            Drop files or <span class="text-maroon-soft">browse</span>
                                        </span>
                                    </div>

                                    <!-- File Info Preview -->
                                    <div id="file-info"
                                        class="hidden flex items-center gap-3 w-full bg-slate-50 dark:bg-slate-800/50 p-3 rounded-lg border border-slate-100 dark:border-slate-800">
                                        <div
                                            class="w-10 h-10 rounded-lg bg-maroon-soft/10 flex items-center justify-center shrink-0">
                                            <i class="fas fa-file-alt text-maroon-soft text-lg"></i>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p id="file-name"
                                                class="text-xs font-bold text-slate-700 dark:text-slate-200 truncate">
                                                filename.pdf</p>
                                            <p id="file-size" class="text-[10px] text-slate-500 font-medium">1.2 MB</p>
                                        </div>
                                        <div class="text-maroon-soft">
                                            <i class="fas fa-check-circle"></i>
                                        </div>
                                    </div>

                                    <input type="file" name="file" id="additional-file"
                                        class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div
                    class="mt-10 pt-6 border-t border-slate-100 dark:border-slate-800 flex flex-col sm:flex-row justify-end gap-3">
                    <a href="{{ route('admin.kegiatan.index') }}"
                        class="px-6 py-3 bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-400 text-xs font-bold rounded-xl hover:bg-slate-200 transition-all text-center">
                        <i class="fas fa-times mr-2"></i> Batal
                    </a>
                    <button type="submit"
                        class="px-8 py-3 bg-maroon-soft text-white text-xs font-bold rounded-xl hover:brightness-110 shadow-lg shadow-maroon-soft/20 transition-all">
                        <i class="fas fa-save mr-2"></i> Simpan Kegiatan
                    </button>
                </div>
            </form>
        </div>

        <!-- Help/Tips Section -->
        <div class="bg-maroon-soft/5 border border-maroon-soft/10 p-5 rounded-xl">
            <h4 class="text-sm font-bold text-maroon-soft mb-3 flex items-center gap-2">
                <i class="fas fa-lightbulb"></i>
                Pro Tips for Better Documentation
            </h4>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="flex gap-3">
                    <div class="w-6 h-6 rounded-full bg-maroon-soft/10 flex items-center justify-center shrink-0">
                        <span class="text-[10px] font-bold text-maroon-soft">01</span>
                    </div>
                    <div>
                        <p class="text-[11px] font-bold text-slate-700 mb-1">Clear Titles</p>
                        <p class="text-[10px] text-slate-500 leading-relaxed font-medium">Use concise, descriptive titles
                            that are easy to find in search.</p>
                    </div>
                </div>
                <div class="flex gap-3">
                    <div class="w-6 h-6 rounded-full bg-maroon-soft/10 flex items-center justify-center shrink-0">
                        <span class="text-[10px] font-bold text-maroon-soft">02</span>
                    </div>
                    <div>
                        <p class="text-[11px] font-bold text-slate-700 mb-1">Detailed Info</p>
                        <p class="text-[10px] text-slate-500 leading-relaxed font-medium">Fill in all details to help the
                            pimpinan make quick decisions.</p>
                    </div>
                </div>
                <div class="flex gap-3">
                    <div class="w-6 h-6 rounded-full bg-maroon-soft/10 flex items-center justify-center shrink-0">
                        <span class="text-[10px] font-bold text-maroon-soft">03</span>
                    </div>
                    <div>
                        <p class="text-[11px] font-bold text-slate-700 mb-1">Attachments</p>
                        <p class="text-[10px] text-slate-500 leading-relaxed font-medium">Always include relevant documents
                            to support your activity.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            // Cover Image Preview
            document.getElementById('image-input').addEventListener('change', function (e) {
                const preview = document.getElementById('image-preview');
                const placeholder = document.getElementById('placeholder-content');
                const overlay = document.getElementById('change-overlay');
                const file = e.target.files[0];

                if (file) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        preview.src = e.target.result;
                        preview.classList.remove('hidden');
                        placeholder.classList.add('hidden');
                        overlay.classList.remove('hidden');
                        overlay.classList.add('flex');
                    }
                    reader.readAsDataURL(file);
                }
            });

            // Additional File Preview
            document.getElementById('additional-file').addEventListener('change', function (e) {
                const info = document.getElementById('file-info');
                const placeholder = document.getElementById('file-placeholder');
                const name = document.getElementById('file-name');
                const size = document.getElementById('file-size');
                const file = e.target.files[0];

                if (file) {
                    name.textContent = file.name;
                    size.textContent = (file.size / (1024 * 1024)).toFixed(2) + ' MB';
                    info.classList.remove('hidden');
                    placeholder.classList.add('hidden');
                }
            });
        </script>
    @endpush
@endsection