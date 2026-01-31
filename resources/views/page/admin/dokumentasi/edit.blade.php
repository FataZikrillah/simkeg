@extends('layouts.app')

@section('title', 'Edit Documentation')

@section('content')
    <div class="max-w-4xl mx-auto space-y-6">
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h2 class="text-xl sm:text-2xl font-bold tracking-tight text-maroon-soft">Edit Documentation</h2>
                <p class="text-slate-500 text-sm font-medium italic">
                    #DOK-{{ str_pad($dokumentasi->id, 4, '0', STR_PAD_LEFT) }} - Update file documentation details.</p>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('admin.dokumentasi.index') }}"
                    class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-slate-200 rounded-lg text-sm font-semibold hover:bg-beige-bg transition-colors shadow-sm">
                    <i class="fas fa-arrow-left text-maroon-soft"></i>
                    <span>Back to Gallery</span>
                </a>
            </div>
        </div>

        <div class="bg-white rounded-xl border border-slate-200/60 shadow-sm overflow-hidden">
            <div class="p-6 sm:p-8">
                <!-- Form -->
                <form action="{{ route('admin.dokumentasi.update', $dokumentasi->id) }}" method="POST"
                    enctype="multipart/form-data" id="editForm">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="kegiatan_id" value="{{ $dokumentasi->kegiatan_id }}">

                    <div class="space-y-8">
                        <!-- Primary Info Grid -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <!-- Left Column: Details -->
                            <div class="space-y-6">
                                <!-- Activity (Read Only) -->
                                <div class="space-y-2">
                                    <label
                                        class="text-[10px] font-bold text-abu-muda uppercase tracking-wider flex items-center gap-2 border-b border-slate-50 pb-1">
                                        <i class="fas fa-calendar-check text-maroon-soft"></i>
                                        Related Activity
                                    </label>
                                    <div
                                        class="flex items-center gap-3 p-3 bg-beige-bg/20 rounded-xl border border-slate-100">
                                        <div
                                            class="w-10 h-10 rounded-lg bg-white flex items-center justify-center text-maroon-soft shadow-sm border border-slate-50">
                                            <i class="fas fa-link text-sm"></i>
                                        </div>
                                        <div class="min-w-0">
                                            <p class="text-sm font-bold text-slate-700 truncate">
                                                {{ $dokumentasi->kegiatan->judul }}</p>
                                            <p class="text-[10px] font-bold text-abu-muda uppercase">
                                                {{ \Carbon\Carbon::parse($dokumentasi->kegiatan->tanggal)->format('d M Y') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Description/Caption -->
                                <div class="space-y-2">
                                    <label
                                        class="text-[10px] font-bold text-abu-muda uppercase tracking-wider flex items-center gap-2 border-b border-slate-50 pb-1">
                                        <i class="fas fa-align-left text-maroon-soft"></i>
                                        File Caption / Description <span class="text-red-500">*</span>
                                    </label>
                                    <textarea name="keterangan" rows="4"
                                        class="w-full px-4 py-3 bg-beige-bg/20 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-maroon-soft/20 focus:border-maroon-soft transition-all @error('keterangan') border-red-500 @enderror"
                                        placeholder="Add a detailed caption for this documentation..."
                                        required>{{ old('keterangan', $dokumentasi->keterangan) }}</textarea>
                                    @error('keterangan')
                                        <p class="mt-1 text-xs text-red-500 font-medium">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Metadata info -->
                                <div class="p-4 bg-slate-50 rounded-xl flex items-start gap-3">
                                    <i class="fas fa-info-circle text-blue-500 mt-0.5"></i>
                                    <div class="text-xs text-slate-500 leading-relaxed">
                                        <strong>Pro Tip:</strong> Ensure your captions are descriptive to help with
                                        reporting and historical tracking.
                                    </div>
                                </div>
                            </div>

                            <!-- Right Column: File Management -->
                            <div class="space-y-6">
                                <!-- Current File Preview -->
                                <div class="space-y-2">
                                    <label
                                        class="text-[10px] font-bold text-abu-muda uppercase tracking-wider flex items-center gap-2 border-b border-slate-50 pb-1">
                                        <i class="fas fa-file-alt text-maroon-soft"></i>
                                        Current Attachment
                                    </label>
                                    <div
                                        class="relative group aspect-video bg-slate-100 rounded-2xl overflow-hidden border border-slate-200">
                                        @if(in_array(pathinfo($dokumentasi->file, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif', 'webp']))
                                            <img src="{{ asset('storage/' . $dokumentasi->file) }}"
                                                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                                        @else
                                            <div class="w-full h-full flex flex-col items-center justify-center gap-3">
                                                <i class="fas fa-file-pdf text-5xl text-red-400"></i>
                                                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">PDF
                                                    DOCUMENT</span>
                                            </div>
                                        @endif
                                        <div
                                            class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center gap-2">
                                            <a href="{{ asset('storage/' . $dokumentasi->file) }}" target="_blank"
                                                class="w-10 h-10 rounded-full bg-white flex items-center justify-center text-maroon-soft hover:bg-maroon-soft hover:text-white transition-all shadow-lg">
                                                <i class="fas fa-expand-alt"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Upload New File -->
                                <div class="space-y-2">
                                    <label
                                        class="text-[10px] font-bold text-abu-muda uppercase tracking-wider flex items-center gap-2 border-b border-slate-50 pb-1">
                                        <i class="fas fa-cloud-upload-alt text-maroon-soft"></i>
                                        Replace File (Optional)
                                    </label>
                                    <div class="relative">
                                        <div id="drop-zone"
                                            class="group relative flex flex-col items-center justify-center p-6 border-2 border-dashed border-slate-200 rounded-2xl hover:border-maroon-soft/50 hover:bg-beige-bg/10 transition-all cursor-pointer">
                                            <input type="file" name="file" id="file-upload"
                                                class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
                                                accept="image/*,.pdf">
                                            <div class="text-center">
                                                <div
                                                    class="w-12 h-12 rounded-full bg-maroon-soft/5 flex items-center justify-center text-maroon-soft mx-auto mb-3 group-hover:scale-110 transition-transform">
                                                    <i class="fas fa-upload"></i>
                                                </div>
                                                <p class="text-xs font-bold text-slate-700">Select a new file</p>
                                                <p class="text-[10px] text-abu-muda mt-1">PNG, JPG or PDF (Max 2MB)</p>
                                            </div>
                                        </div>

                                        <!-- New File Preview Container -->
                                        <div id="new-preview-container"
                                            class="hidden mt-4 p-4 bg-white border border-slate-200 rounded-xl shadow-sm animate-fade-in">
                                            <div class="flex items-center gap-4">
                                                <div id="new-file-icon"
                                                    class="w-12 h-12 rounded-lg bg-blue-50 flex items-center justify-center text-blue-600">
                                                    <i class="fas fa-image"></i>
                                                </div>
                                                <div class="min-w-0 flex-1">
                                                    <p id="new-filename" class="text-sm font-bold text-slate-700 truncate">
                                                        preview.jpg</p>
                                                    <p
                                                        class="text-[10px] font-bold text-green-500 uppercase tracking-wider flex items-center gap-1">
                                                        <i class="fas fa-check-circle"></i> NEW FILE SELECTED
                                                    </p>
                                                </div>
                                                <button type="button" onclick="resetFile()"
                                                    class="p-2 text-slate-400 hover:text-red-500 transition-colors">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    @error('file')
                                        <p class="mt-1 text-xs text-red-500 font-medium">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Technical Info Alert -->
                        <div class="flex items-center gap-4 p-4 bg-amber-50 rounded-2xl border border-amber-100/50">
                            <div
                                class="w-10 h-10 rounded-xl bg-amber-100 flex items-center justify-center text-amber-600 shadow-sm border border-amber-200/50">
                                <i class="fas fa-exclamation-triangle"></i>
                            </div>
                            <div>
                                <h4 class="text-sm font-bold text-amber-900">Important Note</h4>
                                <p class="text-[11px] text-amber-700/80 leading-relaxed">
                                    Replacing the file will permanently delete the previous one. If you only want to update
                                    the caption, leave the file selector empty.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="mt-10 pt-6 border-t border-slate-100 flex flex-col sm:flex-row justify-end gap-3">
                        <a href="{{ route('admin.dokumentasi.index') }}"
                            class="px-6 py-3 bg-white border border-slate-200 rounded-xl text-sm font-bold text-slate-600 hover:bg-slate-50 transition-all text-center">
                            Cancel Changes
                        </a>
                        <button type="submit"
                            class="px-8 py-3 bg-maroon-soft text-white rounded-xl text-sm font-bold hover:brightness-110 shadow-lg shadow-maroon-soft/20 transition-all">
                            <i class="fas fa-save mr-2"></i> Update Documentation
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            const fileInput = document.getElementById('file-upload');
            const previewContainer = document.getElementById('new-preview-container');
            const fileName = document.getElementById('new-filename');
            const fileIcon = document.getElementById('new-file-icon');
            const dropZone = document.getElementById('drop-zone');

            fileInput.addEventListener('change', function (e) {
                if (this.files && this.files[0]) {
                    const file = this.files[0];
                    fileName.textContent = file.name;
                    previewContainer.classList.remove('hidden');

                    // Switch icon based on file type
                    if (file.type === 'application/pdf') {
                        fileIcon.innerHTML = '<i class="fas fa-file-pdf"></i>';
                        fileIcon.className = 'w-12 h-12 rounded-lg bg-red-50 flex items-center justify-center text-red-600';
                    } else {
                        fileIcon.innerHTML = '<i class="fas fa-image"></i>';
                        fileIcon.className = 'w-12 h-12 rounded-lg bg-blue-50 flex items-center justify-center text-blue-600';
                    }

                    // Impact dropzone
                    dropZone.classList.add('border-maroon-soft/50', 'bg-beige-bg/5');
                }
            });

            function resetFile() {
                fileInput.value = '';
                previewContainer.classList.add('hidden');
                dropZone.classList.remove('border-maroon-soft/50', 'bg-beige-bg/5');
            }

            // Simple Drag & Drop highlight
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

        <style>
            .animate-fade-in {
                animation: fadeIn 0.3s ease-out;
            }

            @keyframes fadeIn {
                from {
                    opacity: 0;
                    transform: translateY(10px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
        </style>
    @endpush
@endsection