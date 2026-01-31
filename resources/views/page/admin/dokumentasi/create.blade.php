@extends('layouts.app')

@section('title', 'Upload Documentation')

@section('content')
    <div class="max-w-4xl mx-auto space-y-6">
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h2 class="text-xl sm:text-2xl font-bold tracking-tight text-maroon-soft">Upload Documentation</h2>
                <p class="text-slate-500 text-sm font-medium italic">
                    Add new files and documentation to existing activities.</p>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('admin.dokumentasi.index') }}"
                    class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-slate-200 rounded-lg text-sm font-semibold hover:bg-beige-bg transition-colors shadow-sm">
                    <i class="fas fa-arrow-left text-maroon-soft"></i>
                    <span>Back to Gallery</span>
                </a>
            </div>
        </div>

        <div class="bg-white rounded-xl border border-slate-200/60 shadow-sm overflow-hidden text-slate-700">
            <div class="p-6 sm:p-8">
                <!-- Form -->
                <form action="{{ route('admin.dokumentasi.store') }}" method="POST" enctype="multipart/form-data"
                    id="createForm">
                    @csrf

                    <div class="group space-y-8">
                        <!-- Primary Info Grid -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <!-- Left Column: Details -->
                            <div class="space-y-6">
                                <!-- Activity Selection -->
                                <div class="space-y-2">
                                    <label
                                        class="text-[10px] font-bold text-abu-muda uppercase tracking-wider flex items-center gap-2 border-b border-slate-50 pb-1">
                                        <i class="fas fa-calendar-alt text-maroon-soft"></i>
                                        Related Activity <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <select name="kegiatan_id"
                                            class="w-full pl-11 pr-10 py-3 bg-beige-bg/20 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-maroon-soft/20 focus:border-maroon-soft transition-all appearance-none @error('kegiatan_id') border-red-500 @enderror"
                                            required>
                                            <option value="">-- Select Activity --</option>
                                            @foreach($kegiatan as $k)
                                                <option value="{{ $k->id }}" {{ old('kegiatan_id') == $k->id ? 'selected' : '' }}>
                                                    {{ $k->judul }} ({{ \Carbon\Carbon::parse($k->tanggal)->format('d M') }})
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="absolute left-4 top-1/2 -translate-y-1/2 text-maroon-soft/50">
                                            <i class="fas fa-link text-xs"></i>
                                        </div>
                                        <div
                                            class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none">
                                            <i class="fas fa-chevron-down text-[10px]"></i>
                                        </div>
                                    </div>
                                    @error('kegiatan_id')
                                        <p class="mt-1 text-xs text-red-500 font-medium">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Description/Caption -->
                                <div class="space-y-2">
                                    <label
                                        class="text-[10px] font-bold text-abu-muda uppercase tracking-wider flex items-center gap-2 border-b border-slate-50 pb-1">
                                        <i class="fas fa-align-left text-maroon-soft"></i>
                                        File Caption / Description
                                    </label>
                                    <textarea name="keterangan" rows="4"
                                        class="w-full px-4 py-3 bg-beige-bg/20 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-maroon-soft/20 focus:border-maroon-soft transition-all @error('keterangan') border-red-500 @enderror"
                                        placeholder="Add a detailed caption for this documentation...">{{ old('keterangan') }}</textarea>
                                    @error('keterangan')
                                        <p class="mt-1 text-xs text-red-500 font-medium">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Pro Tip -->
                                <div class="p-4 bg-slate-50 rounded-xl flex items-start gap-3">
                                    <div
                                        class="w-8 h-8 rounded-lg bg-blue-100 flex items-center justify-center text-blue-600 shrink-0">
                                        <i class="fas fa-lightbulb text-sm"></i>
                                    </div>
                                    <div class="text-[11px] text-slate-500 leading-relaxed">
                                        <strong class="text-slate-700">Pro Tip:</strong> You can upload multiple files by
                                        repeating this process for each activity item.
                                    </div>
                                </div>
                            </div>

                            <!-- Right Column: File Upload -->
                            <div class="space-y-6">
                                <div class="space-y-2">
                                    <label
                                        class="text-[10px] font-bold text-abu-muda uppercase tracking-wider flex items-center gap-2 border-b border-slate-50 pb-1">
                                        <i class="fas fa-cloud-upload-alt text-maroon-soft"></i>
                                        Choose File <span class="text-red-500">*</span>
                                    </label>

                                    <!-- Dropzone -->
                                    <div id="drop-zone"
                                        class="group relative flex flex-col items-center justify-center p-10 border-2 border-dashed border-slate-200 rounded-2xl hover:border-maroon-soft/50 hover:bg-beige-bg/10 transition-all cursor-pointer min-h-[250px]">
                                        <input type="file" name="file" id="file-upload"
                                            class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
                                            accept="image/*,.pdf,.doc,.docx" required>
                                        <div class="text-center" id="upload-placeholder">
                                            <div
                                                class="w-16 h-16 rounded-full bg-maroon-soft/5 flex items-center justify-center text-maroon-soft mx-auto mb-4 group-hover:scale-110 transition-transform">
                                                <i class="fas fa-upload text-xl"></i>
                                            </div>
                                            <p class="text-sm font-bold text-slate-700">Click to upload or drag and drop</p>
                                            <p class="text-xs text-abu-muda mt-2">PNG, JPG, PDF or DOC (Max 2MB)</p>
                                        </div>

                                        <!-- Preview Container -->
                                        <div id="preview-container" class="hidden w-full space-y-4">
                                            <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-sm">
                                                <div class="flex items-center gap-4">
                                                    <div id="file-preview-icon"
                                                        class="w-14 h-14 rounded-xl bg-blue-50 flex items-center justify-center text-blue-600 text-xl">
                                                        <i class="fas fa-image"></i>
                                                    </div>
                                                    <div class="min-w-0 flex-1">
                                                        <p id="filename-display"
                                                            class="text-sm font-bold text-slate-700 truncate">preview.jpg
                                                        </p>
                                                        <p id="filesize-display"
                                                            class="text-[10px] font-bold text-abu-muda uppercase tracking-wider">
                                                            0 KB</p>
                                                    </div>
                                                    <button type="button" onclick="resetFile()"
                                                        class="p-2 text-slate-400 hover:text-red-500 transition-colors">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <p
                                                class="text-[10px] text-center font-bold text-maroon-soft/60 uppercase tracking-widest">
                                                Selected for upload</p>
                                        </div>
                                    </div>
                                    @error('file')
                                        <p class="mt-1 text-xs text-red-500 font-medium">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Security info -->
                                <div
                                    class="flex items-center gap-3 px-4 py-3 bg-maroon-soft/5 rounded-xl border border-maroon-soft/10">
                                    <i class="fas fa-shield-alt text-maroon-soft/50 text-xs"></i>
                                    <p class="text-[10px] font-bold text-maroon-soft/70 uppercase">Secure File Transmission
                                        Active</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="mt-10 pt-6 border-t border-slate-100 flex flex-col sm:flex-row justify-end gap-3">
                        <a href="{{ route('admin.dokumentasi.index') }}"
                            class="px-6 py-3 bg-white border border-slate-200 rounded-xl text-sm font-bold text-slate-600 hover:bg-slate-50 transition-all text-center">
                            Discard
                        </a>
                        <button type="submit"
                            class="px-10 py-3 bg-maroon-soft text-white rounded-xl text-sm font-bold hover:brightness-110 shadow-lg shadow-maroon-soft/20 transition-all">
                            <i class="fas fa-cloud-upload-alt mr-2"></i> Confirm Upload
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            const fileInput = document.getElementById('file-upload');
            const previewContainer = document.getElementById('preview-container');
            const placeholder = document.getElementById('upload-placeholder');
            const fileName = document.getElementById('filename-display');
            const fileSize = document.getElementById('filesize-display');
            const fileIcon = document.getElementById('file-preview-icon');
            const dropZone = document.getElementById('drop-zone');

            fileInput.addEventListener('change', function (e) {
                if (this.files && this.files[0]) {
                    const file = this.files[0];
                    fileName.textContent = file.name;
                    fileSize.textContent = (file.size / 1024).toFixed(1) + ' KB';

                    placeholder.classList.add('hidden');
                    previewContainer.classList.remove('hidden');

                    // Switch icon based on file type
                    const ext = file.name.split('.').pop().toLowerCase();
                    if (ext === 'pdf') {
                        fileIcon.innerHTML = '<i class="fas fa-file-pdf"></i>';
                        fileIcon.className = 'w-14 h-14 rounded-xl bg-red-50 flex items-center justify-center text-red-600 text-xl';
                    } else if (['doc', 'docx'].includes(ext)) {
                        fileIcon.innerHTML = '<i class="fas fa-file-word"></i>';
                        fileIcon.className = 'w-14 h-14 rounded-xl bg-blue-50 flex items-center justify-center text-blue-600 text-xl';
                    } else {
                        fileIcon.innerHTML = '<i class="fas fa-image"></i>';
                        fileIcon.className = 'w-14 h-14 rounded-xl bg-indigo-50 flex items-center justify-center text-indigo-600 text-xl';
                    }

                    dropZone.classList.add('border-maroon-soft/50', 'bg-beige-bg/10');
                }
            });

            function resetFile() {
                fileInput.value = '';
                previewContainer.classList.add('hidden');
                placeholder.classList.remove('hidden');
                dropZone.classList.remove('border-maroon-soft/50', 'bg-beige-bg/10');
            }

            // Drag & Drop Interactions
            ['dragenter', 'dragover'].forEach(eventName => {
                dropZone.addEventListener(eventName, (e) => {
                    e.preventDefault();
                    dropZone.classList.add('border-maroon-soft', 'bg-beige-bg/20');
                }, false);
            });

            ['dragleave', 'drop'].forEach(eventName => {
                dropZone.addEventListener(eventName, (e) => {
                    e.preventDefault();
                    dropZone.classList.remove('border-maroon-soft', 'bg-beige-bg/20');
                }, false);
            });
        </script>
    @endpush
@endsection