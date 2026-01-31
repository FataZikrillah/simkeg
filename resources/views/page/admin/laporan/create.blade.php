@extends('layouts.app')

@section('title', 'Create New Report')

@section('content')
    <div class="max-w-4xl mx-auto space-y-6">
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h2 class="text-xl sm:text-2xl font-bold tracking-tight text-maroon-soft">Create New Report</h2>
                <p class="text-slate-500 text-sm font-medium italic">Documenting activity progress with precision and
                    professional standards.</p>
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
                <form action="{{ route('admin.laporan.store') }}" method="POST" id="createForm"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="space-y-8">
                        <!-- Context Section -->
                        <div class="space-y-6">
                            <h3
                                class="text-xs font-bold text-abu-muda uppercase tracking-[0.2em] border-b border-slate-50 pb-2">
                                Activity Context</h3>

                            <!-- Kegiatan Selection -->
                            <div class="space-y-2">
                                <label
                                    class="text-[10px] font-bold text-abu-muda uppercase tracking-wider flex items-center gap-2">
                                    <i class="fas fa-calendar-alt text-maroon-soft"></i>
                                    Select Related Activity <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <select name="kegiatan_id"
                                        class="w-full pl-11 pr-10 py-3 bg-beige-bg/20 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-maroon-soft/20 focus:border-maroon-soft transition-all appearance-none @error('kegiatan_id') border-red-500 @enderror"
                                        required>
                                        <option value="">-- Choose an activity to report --</option>
                                        @foreach($kegiatan as $k)
                                            <option value="{{ $k->id }}" {{ old('kegiatan_id') == $k->id ? 'selected' : '' }}>
                                                {{ $k->judul }} ({{ \Carbon\Carbon::parse($k->tanggal)->format('d M Y') }})
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
                        </div>

                        <!-- Content Section -->
                        <div class="space-y-6">
                            <h3
                                class="text-xs font-bold text-abu-muda uppercase tracking-[0.2em] border-b border-slate-50 pb-2">
                                Narrative Details</h3>

                            <!-- Judul Laporan -->
                            <div class="space-y-2">
                                <label
                                    class="text-[10px] font-bold text-abu-muda uppercase tracking-wider flex items-center gap-2">
                                    <i class="fas fa-heading text-maroon-soft"></i>
                                    Report Title <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="judul"
                                    class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl text-sm font-bold text-slate-700 focus:outline-none focus:ring-2 focus:ring-maroon-soft/20 focus:border-maroon-soft transition-all @error('judul') border-red-500 @enderror"
                                    placeholder="Enter descriptive report title (e.g., Monthly Progress Report Jan 2026)"
                                    value="{{ old('judul') }}" required>
                                @error('judul')
                                    <p class="mt-1 text-xs text-red-500 font-medium">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Isi Laporan -->
                            <div class="space-y-2">
                                <label
                                    class="text-[10px] font-bold text-abu-muda uppercase tracking-wider flex items-center gap-2">
                                    <i class="fas fa-align-left text-maroon-soft"></i>
                                    Executive Summary / Detailed Results <span class="text-red-500">*</span>
                                </label>
                                <textarea name="isi" rows="8"
                                    class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-maroon-soft/20 focus:border-maroon-soft transition-all @error('isi') border-red-500 @enderror"
                                    placeholder="Summarize the core findings, achievements, or outcomes of the activity..."
                                    required>{{ old('isi') }}</textarea>
                                @error('isi')
                                    <p class="mt-1 text-xs text-red-500 font-medium">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Official Documentation -->
                        <div class="space-y-6">
                            <h3
                                class="text-xs font-bold text-abu-muda uppercase tracking-[0.2em] border-b border-slate-50 pb-2">
                                Formal Documentation</h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-start">
                                <!-- Guidance -->
                                <div class="bg-maroon-soft/5 border border-maroon-soft/10 rounded-2xl p-5 space-y-4">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-8 h-8 rounded-lg bg-white flex items-center justify-center text-maroon-soft shadow-sm border border-slate-100">
                                            <i class="fas fa-info-circle text-xs"></i>
                                        </div>
                                        <h4 class="text-xs font-bold text-maroon-soft uppercase tracking-wider">Attachment
                                            Rules</h4>
                                    </div>
                                    <ul class="space-y-3">
                                        <li
                                            class="flex items-start gap-2 text-[10px] font-medium text-slate-600 leading-relaxed">
                                            <i class="fas fa-check text-green-500 mt-0.5 shrink-0"></i>
                                            Document must be in <strong>PDF format</strong> only.
                                        </li>
                                        <li
                                            class="flex items-start gap-2 text-[10px] font-medium text-slate-600 leading-relaxed">
                                            <i class="fas fa-check text-green-500 mt-0.5 shrink-0"></i>
                                            Maximum file size: <strong>2MB</strong>.
                                        </li>
                                        <li
                                            class="flex items-start gap-2 text-[10px] font-medium text-slate-600 leading-relaxed">
                                            <i class="fas fa-check text-green-500 mt-0.5 shrink-0"></i>
                                            The report will be sent to <strong>Pending</strong> status for review.
                                        </li>
                                    </ul>
                                </div>

                                <!-- File Upload -->
                                <div class="space-y-4">
                                    <label
                                        class="text-[10px] font-bold text-abu-muda uppercase tracking-wider flex items-center gap-2">
                                        <i class="fas fa-file-pdf text-maroon-soft"></i>
                                        Upload Final Report <span class="text-red-500">*</span>
                                    </label>
                                    <div id="drop-zone"
                                        class="group relative flex flex-col items-center justify-center p-6 border-2 border-dashed border-slate-200 rounded-2xl hover:border-maroon-soft/50 hover:bg-beige-bg/10 transition-all cursor-pointer min-h-[160px]">
                                        <input type="file" name="file" id="file-upload"
                                            class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
                                            accept="application/pdf" required>
                                        <div class="text-center" id="upload-placeholder">
                                            <div
                                                class="w-12 h-12 rounded-full bg-slate-50 flex items-center justify-center text-slate-400 mx-auto mb-3 group-hover:scale-110 transition-transform">
                                                <i class="fas fa-cloud-upload-alt text-lg"></i>
                                            </div>
                                            <p class="text-[11px] font-bold text-slate-600 uppercase tracking-widest">Select
                                                PDF Document</p>
                                            <p class="text-[9px] text-abu-muda mt-1">or drag and drop it here</p>
                                        </div>
                                        <!-- File Selected Indicator -->
                                        <div id="file-selected-info" class="hidden text-center">
                                            <div
                                                class="w-14 h-14 rounded-xl bg-green-50 flex items-center justify-center text-green-600 mx-auto mb-2 border border-green-100">
                                                <i class="fas fa-check-circle text-xl"></i>
                                            </div>
                                            <p id="file-name-preview"
                                                class="text-xs font-extrabold text-slate-700 truncate max-w-[150px]">
                                                Document.pdf</p>
                                            <button type="button" onclick="resetFile()"
                                                class="text-[10px] text-red-500 font-bold hover:underline mt-2 flex items-center gap-1 mx-auto">
                                                <i class="fas fa-times-circle"></i> Remove
                                            </button>
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
                            Discard
                        </a>
                        <button type="submit"
                            class="px-12 py-3 bg-maroon-soft text-white rounded-xl text-sm font-bold hover:brightness-110 shadow-lg shadow-maroon-soft/20 transition-all">
                            <i class="fas fa-paper-plane mr-2"></i> Submit Final Report
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Footer Meta -->
        <div class="flex items-center justify-center gap-6 p-4 bg-slate-50/50 border border-slate-200/40 rounded-2xl">
            <div class="flex items-center gap-2">
                <i class="fas fa-user-circle text-maroon-soft/40 text-sm"></i>
                <p class="text-[10px] font-bold text-abu-muda uppercase tracking-widest">Creator Identity:
                    {{ auth()->user()->name }}</p>
            </div>
            <div class="w-px h-3 bg-slate-200"></div>
            <div class="flex items-center gap-2">
                <i class="fas fa-calendar-day text-maroon-soft/40 text-sm"></i>
                <p class="text-[10px] font-bold text-abu-muda uppercase tracking-widest">Submission Date:
                    {{ now()->format('d M Y') }}</p>
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