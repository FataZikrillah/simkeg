@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto space-y-6">
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h2 class="text-xl sm:text-2xl font-bold tracking-tight text-maroon-soft">Edit Kegiatan</h2>
                <p class="text-slate-500 dark:text-slate-400 text-sm font-medium italic">
                    #{{ str_pad($kegiatan->id, 6, '0', STR_PAD_LEFT) }} - Perbarui informasi kegiatan ini.</p>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('admin.kegiatan.show', $kegiatan->id) }}"
                    class="inline-flex items-center gap-2 px-3 sm:px-4 py-2 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg text-xs sm:text-sm font-semibold hover:bg-beige-bg dark:hover:bg-slate-700 transition-colors shadow-sm">
                    <i class="fas fa-eye"></i>
                    <span>Lihat Detail</span>
                </a>
            </div>
        </div>

        <div
            class="bg-white dark:bg-slate-900 rounded-xl border border-slate-200/60 dark:border-slate-800 shadow-sm p-6 sm:p-8">
            <!-- Form -->
            <form action="{{ route('admin.kegiatan.update', $kegiatan->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="space-y-6">
                    <!-- Judul Kegiatan -->
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-abu-muda uppercase tracking-wider flex items-center gap-2">
                            <i class="fas fa-heading text-maroon-soft"></i>
                            Judul Kegiatan <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="judul"
                            class="w-full px-4 py-3 bg-beige-bg/20 border border-slate-200 dark:border-slate-700 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-maroon-soft/20 focus:border-maroon-soft transition-all @error('judul') border-red-500 @enderror"
                            placeholder="Nama Kegiatan" value="{{ old('judul', $kegiatan->judul) }}" required>
                        @error('judul')
                            <p class="mt-1 text-xs text-red-500 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-xs font-bold text-abu-muda uppercase tracking-wider flex items-center gap-2">
                                <i class="fas fa-calendar-alt text-maroon-soft"></i>
                                Tanggal Pelaksanaan <span class="text-red-500">*</span>
                            </label>
                            <input type="date" name="tanggal"
                                class="w-full px-4 py-3 bg-beige-bg/20 border border-slate-200 dark:border-slate-700 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-maroon-soft/20 focus:border-maroon-soft transition-all @error('tanggal') border-red-500 @enderror"
                                value="{{ old('tanggal', $kegiatan->tanggal) }}" required>
                            @error('tanggal')
                                <p class="mt-1 text-xs text-red-500 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <label class="text-xs font-bold text-abu-muda uppercase tracking-wider flex items-center gap-2">
                                <i class="fas fa-clock text-maroon-soft"></i>
                                Waktu Mulai
                            </label>
                            <input type="time" name="waktu_mulai"
                                class="w-full px-4 py-3 bg-beige-bg/20 border border-slate-200 dark:border-slate-700 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-maroon-soft/20 focus:border-maroon-soft transition-all @error('waktu_mulai') border-red-500 @enderror"
                                value="{{ old('waktu_mulai', $kegiatan->waktu_mulai) }}">
                            @error('waktu_mulai')
                                <p class="mt-1 text-xs text-red-500 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <label class="text-xs font-bold text-abu-muda uppercase tracking-wider flex items-center gap-2">
                                <i class="fas fa-map-marker-alt text-maroon-soft"></i>
                                Lokasi
                            </label>
                            <input type="text" name="lokasi"
                                class="w-full px-4 py-3 bg-beige-bg/20 border border-slate-200 dark:border-slate-700 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-maroon-soft/20 focus:border-maroon-soft transition-all @error('lokasi') border-red-500 @enderror"
                                placeholder="Tempat Pelaksanaan" value="{{ old('lokasi', $kegiatan->lokasi) }}">
                            @error('lokasi')
                                <p class="mt-1 text-xs text-red-500 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <label class="text-xs font-bold text-abu-muda uppercase tracking-wider flex items-center gap-2">
                                <i class="fas fa-flag text-maroon-soft"></i>
                                Prioritas
                            </label>
                            <div class="relative">
                                <select name="prioritas"
                                    class="w-full px-4 py-3 bg-beige-bg/20 border border-slate-200 dark:border-slate-700 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-maroon-soft/20 focus:border-maroon-soft transition-all appearance-none @error('prioritas') border-red-500 @enderror"
                                    required>
                                    <option value="rendah" {{ old('prioritas', $kegiatan->prioritas) == 'rendah' ? 'selected' : '' }}>Rendah</option>
                                    <option value="sedang" {{ old('prioritas', $kegiatan->prioritas) == 'sedang' ? 'selected' : '' }}>Sedang</option>
                                    <option value="tinggi" {{ old('prioritas', $kegiatan->prioritas) == 'tinggi' ? 'selected' : '' }}>Tinggi</option>
                                </select>
                                <div
                                    class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-slate-400">
                                    <i class="fas fa-chevron-down text-xs"></i>
                                </div>
                            </div>
                            @error('prioritas')
                                <p class="mt-1 text-xs text-red-500 font-medium">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Penanggung Jawab -->
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-abu-muda uppercase tracking-wider flex items-center gap-2">
                            <i class="fas fa-user-tie text-maroon-soft"></i>
                            Penanggung Jawab <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <select name="user_id"
                                class="w-full px-4 py-3 bg-beige-bg/20 border border-slate-200 dark:border-slate-700 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-maroon-soft/20 focus:border-maroon-soft transition-all appearance-none @error('user_id') border-red-500 @enderror"
                                required>
                                <option value="">Pilih Penanggung Jawab</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ old('user_id', $kegiatan->user_id) == $user->id ? 'selected' : '' }}>
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

                    <div class="space-y-2">
                        <label class="text-xs font-bold text-abu-muda uppercase tracking-wider flex items-center gap-2">
                            <i class="fas fa-align-left text-maroon-soft"></i>
                            Deskripsi Kegiatan <span class="text-red-500">*</span>
                        </label>
                        <textarea name="deskripsi" rows="4"
                            class="w-full px-4 py-3 bg-beige-bg/20 border border-slate-200 dark:border-slate-700 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-maroon-soft/20 focus:border-maroon-soft transition-all @error('deskripsi') border-red-500 @enderror"
                            placeholder="Jelaskan detail kegiatan..."
                            required>{{ old('deskripsi', $kegiatan->deskripsi) }}</textarea>
                        @error('deskripsi')
                            <p class="mt-1 text-xs text-red-500 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-xs font-bold text-abu-muda uppercase tracking-wider flex items-center gap-2">
                                <i class="fas fa-tasks text-maroon-soft"></i>
                                Status
                            </label>
                            <div class="relative">
                                <select name="status"
                                    class="w-full px-4 py-3 bg-beige-bg/20 border border-slate-200 dark:border-slate-700 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-maroon-soft/20 focus:border-maroon-soft transition-all appearance-none @error('status') border-red-500 @enderror">
                                    <option value="pending" {{ old('status', $kegiatan->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="disetujui" {{ old('status', $kegiatan->status) == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                                    <option value="ditolak" {{ old('status', $kegiatan->status) == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                    <option value="selesai" {{ old('status', $kegiatan->status) == 'selesai' ? 'selected' : '' }}>Selesai</option>
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

                        <div class="space-y-2">
                            <label class="text-xs font-bold text-abu-muda uppercase tracking-wider flex items-center gap-2">
                                <i class="fas fa-image text-maroon-soft"></i>
                                Foto Utama (Cover)
                            </label>

                            <div class="relative group">
                                <div id="image-preview-wrapper"
                                    class="flex flex-col items-center justify-center w-full h-48 transition bg-white dark:bg-slate-900 border-2 border-slate-200 dark:border-slate-800 border-dashed rounded-xl overflow-hidden cursor-pointer group-hover:border-maroon-soft/50 focus:outline-none">

                                    <!-- Current/Preview Image -->
                                    <img id="image-preview"
                                        src="{{ $kegiatan->image ? asset('storage/' . $kegiatan->image) : '#' }}"
                                        alt="Preview"
                                        class="{{ $kegiatan->image ? '' : 'hidden' }} w-full h-full object-cover">

                                    <!-- Placeholder (only if no image) -->
                                    <div id="placeholder-content"
                                        class="{{ $kegiatan->image ? 'hidden' : 'flex' }} flex flex-col items-center justify-center space-y-2">
                                        <i class="fas fa-camera text-maroon-soft text-2xl"></i>
                                        <span class="text-xs font-bold text-slate-500">
                                            Upload <span class="text-maroon-soft">foto utama</span>
                                        </span>
                                    </div>

                                    <input type="file" name="image" id="image-input" accept="image/*"
                                        class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">

                                    <!-- Change Overlay -->
                                    <div id="change-overlay"
                                        class="{{ $kegiatan->image ? 'flex' : 'hidden' }} absolute inset-0 bg-black/40 items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                        <span
                                            class="px-3 py-1 bg-white/20 backdrop-blur-md border border-white/30 rounded-full text-[10px] text-white font-bold uppercase tracking-wider">
                                            Ganti Foto
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <p class="text-[10px] text-slate-400 italic font-medium">Biarkan kosong jika tidak ingin
                                mengubah foto utama.</p>
                        </div>

                        <div class="space-y-2">
                            <label class="text-xs font-bold text-abu-muda uppercase tracking-wider flex items-center gap-2">
                                <i class="fas fa-paperclip text-maroon-soft"></i>
                                Update Lampiran Tambahan
                            </label>
                            <div class="relative group">
                                <div id="file-preview-wrapper"
                                    class="flex flex-col items-center justify-center w-full min-h-[96px] px-4 transition bg-white dark:bg-slate-900 border-2 border-slate-200 dark:border-slate-800 border-dashed rounded-xl appearance-none cursor-pointer group-hover:border-maroon-soft/50 focus:outline-none py-4">

                                    <!-- Placeholder Content -->
                                    <div id="file-placeholder" class="flex flex-col items-center justify-center space-y-2">
                                        <i class="fas fa-cloud-upload-alt text-slate-400 text-lg"></i>
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
                            <p class="text-[10px] text-slate-400 italic font-medium">Biarkan kosong jika tidak ingin
                                menambah lampiran.</p>
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
                        <i class="fas fa-save mr-2"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
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
                        if (placeholder) placeholder.classList.add('hidden');
                        if (overlay) {
                            overlay.classList.remove('hidden');
                            overlay.classList.add('flex');
                        }
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