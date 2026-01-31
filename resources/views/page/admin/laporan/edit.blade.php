@extends('layouts.app')

@section('title', 'Edit Report')

@section('content')
    <div class="max-w-4xl mx-auto space-y-6">
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h2 class="text-xl sm:text-2xl font-bold tracking-tight text-maroon-soft">Edit Report</h2>
                <p class="text-slate-500 text-sm font-medium italic">
                    Updating documentation for: <span class="text-slate-700 font-bold">"{{ $laporan->judul }}"</span>
                </p>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('admin.laporan.index') }}"
                    class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-slate-200 rounded-lg text-sm font-semibold hover:bg-beige-bg transition-colors shadow-sm">
                    <i class="fas fa-arrow-left text-maroon-soft"></i>
                    <span>Back to List</span>
                </a>
            </div>
        </div>

        <div class="bg-white rounded-xl border border-slate-200/60 shadow-sm overflow-hidden text-slate-700">
            <div class="p-6 sm:p-8">
                <!-- Form -->
                <form action="{{ route('admin.laporan.update', $laporan->id) }}" method="POST" id="editForm"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="space-y-8">
                        <!-- Activity & Meta Section -->
                        <div class="space-y-6">
                            <h3
                                class="text-xs font-bold text-abu-muda uppercase tracking-[0.2em] border-b border-slate-50 pb-2">
                                Context & Status</h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Activity Selection -->
                                <div class="space-y-2">
                                    <label
                                        class="text-[10px] font-bold text-abu-muda uppercase tracking-wider flex items-center gap-2">
                                        <i class="fas fa-calendar-alt text-maroon-soft"></i>
                                        Related Activity <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <select name="kegiatan_id"
                                            class="w-full pl-11 pr-10 py-3 bg-beige-bg/20 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-maroon-soft/20 focus:border-maroon-soft transition-all appearance-none @error('kegiatan_id') border-red-500 @enderror"
                                            required>
                                            @foreach($kegiatan as $k)
                                                <option value="{{ $k->id }}" {{ old('kegiatan_id', $laporan->kegiatan_id) == $k->id ? 'selected' : '' }}>
                                                    {{ $k->judul }}
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

                                <!-- Status -->
                                <div class="space-y-2">
                                    <label
                                        class="text-[10px] font-bold text-abu-muda uppercase tracking-wider flex items-center gap-2">
                                        <i class="fas fa-shield-alt text-maroon-soft"></i>
                                        Report Review Status
                                    </label>
                                    <div class="relative">
                                        <select name="status"
                                            class="w-full pl-11 pr-10 py-3 bg-white border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-maroon-soft/20 focus:border-maroon-soft transition-all appearance-none @error('status') border-red-500 @enderror">
                                            <option value="pending" {{ old('status', $laporan->status) == 'pending' ? 'selected' : '' }}>Pending Review</option>
                                            <option value="approved" {{ old('status', $laporan->status) == 'approved' ? 'selected' : '' }}>Disetujui (Approved)</option>
                                            <option value="rejected" {{ old('status', $laporan->status) == 'rejected' ? 'selected' : '' }}>Ditolak (Rejected)</option>
                                        </select>
                                        <div class="absolute left-4 top-1/2 -translate-y-1/2 text-maroon-soft/50">
                                            <i class="fas fa-check-double text-xs"></i>
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

                        <!-- Content Section -->
                        <div class="space-y-6">
                            <h3
                                class="text-xs font-bold text-abu-muda uppercase tracking-[0.2em] border-b border-slate-50 pb-2">
                                Narrative & Documentation</h3>

                            <!-- Judul Laporan -->
                            <div class="space-y-2">
                                <label
                                    class="text-[10px] font-bold text-abu-muda uppercase tracking-wider flex items-center gap-2">
                                    <i class="fas fa-heading text-maroon-soft"></i>
                                    Report Title <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="judul"
                                    class="w-full px-4 py-3 bg-beige-bg/20 border border-slate-200 rounded-xl text-sm font-bold text-slate-700 focus:outline-none focus:ring-2 focus:ring-maroon-soft/20 focus:border-maroon-soft transition-all @error('judul') border-red-500 @enderror"
                                    placeholder="Enter descriptive report title" value="{{ old('judul', $laporan->judul) }}"
                                    required>
                                @error('judul')
                                    <p class="mt-1 text-xs text-red-500 font-medium">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Isi Laporan -->
                            <div class="space-y-2">
                                <label
                                    class="text-[10px] font-bold text-abu-muda uppercase tracking-wider flex items-center gap-2">
                                    <i class="fas fa-align-left text-maroon-soft"></i>
                                    Report Content / Executive Summary <span class="text-red-500">*</span>
                                </label>
                                <textarea name="isi" rows="8"
                                    class="w-full px-4 py-3 bg-beige-bg/20 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-maroon-soft/20 focus:border-maroon-soft transition-all @error('isi') border-red-500 @enderror"
                                    placeholder="Detail report findings, achievements, and statistics..."
                                    required>{{ old('isi', $laporan->isi) }}</textarea>
                                @error('isi')
                                    <p class="mt-1 text-xs text-red-500 font-medium">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Attachments Section -->
                        <div class="space-y-6">
                            <h3
                                class="text-xs font-bold text-abu-muda uppercase tracking-[0.2em] border-b border-slate-50 pb-2">
                                Official Attachment</h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-start">
                                <!-- Current File Preview -->
                                <div class="space-y-4">
                                    <label class="text-[10px] font-bold text-abu-muda uppercase tracking-wider">
                                        Current Document
                                    </label>
                                    @if($laporan->file_pdf)
                                        <div
                                            class="group relative p-4 bg-slate-50 border border-slate-200 rounded-2xl flex items-center gap-4 hover:bg-white hover:shadow-md transition-all">
                                            <div
                                                class="w-12 h-12 rounded-xl bg-red-100 flex items-center justify-center text-red-600 shadow-sm">
                                                <i class="fas fa-file-pdf text-xl"></i>
                                            </div>
                                            <div class="min-w-0 flex-1">
                                                <p class="text-[11px] font-bold text-slate-700 truncate capitalize">
                                                    {{ basename($laporan->file_pdf) }}</p>
                                                <a href="{{ asset('storage/' . $laporan->file_pdf) }}" target="_blank"
                                                    class="text-[9px] font-bold text-blue-600 hover:underline flex items-center gap-1 mt-1">
                                                    <i class="fas fa-external-link-alt"></i>
                                                    View Document
                                                </a>
                                            </div>
                                        </div>
                                    @else
                                        <div
                                            class="p-4 bg-slate-50/50 border border-dashed border-slate-200 rounded-2xl flex flex-col items-center justify-center text-slate-400 gap-2 min-h-[80px]">
                                            <i class="fas fa-ghost text-xl opacity-30"></i>
                                            <p class="text-[10px] font-bold uppercase tracking-widest opacity-60">No File
                                                Attached</p>
                                        </div>
                                    @endif

                                    <div
                                        class="flex items-center gap-3 p-4 bg-maroon-soft/5 rounded-2xl border border-maroon-soft/10">
                                        <div
                                            class="w-8 h-8 rounded-lg bg-white flex items-center justify-center text-maroon-soft shadow-sm border border-slate-100 shrink-0">
                                            <i class="fas fa-info-circle text-xs"></i>
                                        </div>
                                        <p class="text-[10px] text-maroon-soft/80 font-medium italic leading-relaxed">
                                            Keep the file input empty to retain the current report document.
                                        </p>
                                    </div>
                                </div>

                                <!-- New File Upload -->
                                <div class="space-y-4">
                                    <label
                                        class="text-[10px] font-bold text-abu-muda uppercase tracking-wider flex items-center gap-2">
                                        <i class="fas fa-cloud-upload-alt text-maroon-soft"></i>
                                        Replace Document (PDF)
                                    </label>
                                    <div id="drop-zone"
                                        class="group relative flex flex-col items-center justify-center p-6 border-2 border-dashed border-slate-200 rounded-2xl hover:border-maroon-soft/50 hover:bg-beige-bg/10 transition-all cursor-pointer min-h-[140px]">
                                        <input type="file" name="file" id="file-upload"
                                            class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
                                            accept="application/pdf">
                                        <div class="text-center" id="upload-placeholder">
                                            <div
                                                class="w-10 h-10 rounded-full bg-slate-50 flex items-center justify-center text-slate-400 mx-auto mb-2 group-hover:scale-110 transition-transform">
                                                <i class="fas fa-upload text-sm"></i>
                                            </div>
                                            <p class="text-[11px] font-bold text-slate-600">Select new PDF</p>
                                            <p class="text-[9px] text-abu-muda mt-1 uppercase tracking-tighter">MAX 2MB •
                                                PDF ONLY</p>
                                        </div>
                                        <!-- File Selected Indicator -->
                                        <div id="file-selected-info" class="hidden text-center">
                                            <div
                                                class="w-12 h-12 rounded-xl bg-green-50 flex items-center justify-center text-green-600 mx-auto mb-2">
                                                <i class="fas fa-check-circle"></i>
                                            </div>
                                            <p id="file-name-preview"
                                                class="text-xs font-extrabold text-slate-700 truncate max-w-[150px]">
                                                Document.pdf</p>
                                            <button type="button" onclick="resetFile()"
                                                class="text-[10px] text-red-500 font-bold hover:underline mt-1">Change
                                                File</button>
                                        </div>
                                    </div>
                                    @error('file')
                                        <p class="mt-1 text-xs text-red-500 font-medium">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="mt-12 pt-8 border-t border-slate-100 flex flex-col sm:flex-row justify-end gap-3">
                        <a href="{{ route('admin.laporan.index') }}"
                            class="px-6 py-3 bg-white border border-slate-200 rounded-xl text-sm font-bold text-slate-600 hover:bg-slate-50 transition-all text-center">
                            Discard Edits
                        </a>
                        <button type="submit"
                            class="px-10 py-3 bg-maroon-soft text-white rounded-xl text-sm font-bold hover:brightness-110 shadow-lg shadow-maroon-soft/20 transition-all">
                            <i class="fas fa-save mr-2"></i> Update Report Information
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Meta Summary Information -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="bg-slate-50 border border-slate-200/60 rounded-2xl p-4 flex items-center gap-4">
                <div
                    class="w-10 h-10 rounded-xl bg-white flex items-center justify-center text-slate-400 shadow-sm border border-slate-100 shrink-0">
                    <i class="fas fa-user-edit text-xs"></i>
                </div>
                <div>
                    <p class="text-[9px] font-bold text-abu-muda uppercase tracking-[0.1em]">Author Responsibility</p>
                    <p class="text-xs font-bold text-slate-700 capitalize">Reporting by:
                        {{ $laporan->user->name ?? 'System' }}</p>
                </div>
            </div>
            <div class="bg-indigo-50/30 border border-indigo-100 rounded-2xl p-4 flex items-center gap-4">
                <div
                    class="w-10 h-10 rounded-xl bg-white flex items-center justify-center text-indigo-500 shadow-sm border border-indigo-50 shrink-0">
                    <i class="fas fa-clock text-xs"></i>
                </div>
                <div>
                    <p class="text-[9px] font-bold text-indigo-400 uppercase tracking-[0.1em]">Last Document Update</p>
                    <p class="text-xs font-bold text-indigo-700">{{ $laporan->updated_at->format('d M Y, H:i') }}</p>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            const fileInput = document.getElementById('file-upload');
            const placeholder = document.getElementById('upload-placeholder');
            const infoPreview = document.getElementById('file-selected-info');
            const namePreview = document.getElementById('file-name-preview');
            const dropZone = document.getElementById('drop-zone');

            fileInput.addEventListener('change', function (e) {
                if (this.files && this.files.length > 0) {
                    placeholder.classList.add('hidden');
                    infoPreview.classList.remove('hidden');
                    namePreview.textContent = this.files[0].name;
                    dropZone.classList.add('border-maroon-soft/50', 'bg-beige-bg/5');
                }
            });

            function resetFile() {
                fileInput.value = '';
                placeholder.classList.remove('hidden');
                infoPreview.classList.add('hidden');
                dropZone.classList.remove('border-maroon-soft/50', 'bg-beige-bg/5');
            }

            // Drag & Drop visual highlights
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