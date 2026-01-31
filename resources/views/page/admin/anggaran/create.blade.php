@extends('layouts.app')

@section('title', 'Add New Budget')

@section('content')
    <div class="max-w-4xl mx-auto space-y-6">
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h2 class="text-xl sm:text-2xl font-bold tracking-tight text-maroon-soft">Add New Budget</h2>
                <p class="text-slate-500 text-sm font-medium italic">
                    Create a new financial allocation for organization activities.</p>
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
                <form action="{{ route('admin.anggaran.store') }}" method="POST" id="createForm"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="space-y-8">
                        <!-- Primary Information Section -->
                        <div class="space-y-6">
                            <h3
                                class="text-xs font-bold text-abu-muda uppercase tracking-[0.2em] border-b border-slate-50 pb-2">
                                Primary Allocation Details</h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Activity Selection -->
                                <div class="space-y-2">
                                    <label
                                        class="text-[10px] font-bold text-abu-muda uppercase tracking-wider flex items-center gap-2">
                                        <i class="fas fa-link text-maroon-soft"></i>
                                        Related Activity <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <select name="kegiatan_id"
                                            class="w-full pl-11 pr-10 py-3 bg-beige-bg/20 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-maroon-soft/20 focus:border-maroon-soft transition-all appearance-none @error('kegiatan_id') border-red-500 @enderror"
                                            required>
                                            <option value="">-- Select Activity --</option>
                                            @foreach($kegiatan as $k)
                                                <option value="{{ $k->id }}" {{ old('kegiatan_id') == $k->id ? 'selected' : '' }}>
                                                    {{ $k->judul }} ({{ \Carbon\Carbon::parse($k->tanggal)->format('d M Y') }})
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="absolute left-4 top-1/2 -translate-y-1/2 text-maroon-soft/50">
                                            <i class="fas fa-calendar-alt text-xs"></i>
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

                                <!-- Budget Amount -->
                                <div class="space-y-2">
                                    <label
                                        class="text-[10px] font-bold text-abu-muda uppercase tracking-wider flex items-center gap-2">
                                        <i class="fas fa-coins text-maroon-soft"></i>
                                        Budget Amount <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <input type="number" name="jumlah"
                                            class="w-full pl-12 pr-4 py-3 bg-beige-bg/20 border border-slate-200 rounded-xl text-sm font-bold text-slate-700 focus:outline-none focus:ring-2 focus:ring-maroon-soft/20 focus:border-maroon-soft transition-all @error('jumlah') border-red-500 @enderror"
                                            placeholder="0" value="{{ old('jumlah') }}" required>
                                        <div
                                            class="absolute left-4 top-1/2 -translate-y-1/2 text-maroon-soft/50 font-bold text-xs uppercase tracking-tighter">
                                            Rp
                                        </div>
                                    </div>
                                    <p class="text-[9px] text-slate-400 italic">Enter the total numeric value without dots
                                        or commas.</p>
                                    @error('jumlah')
                                        <p class="mt-1 text-xs text-red-500 font-medium">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Source of Funds -->
                                <div class="space-y-2">
                                    <label
                                        class="text-[10px] font-bold text-abu-muda uppercase tracking-wider flex items-center gap-2">
                                        <i class="fas fa-piggy-bank text-maroon-soft"></i>
                                        Source of Funds <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <select name="sumber_dana"
                                            class="w-full pl-11 pr-10 py-3 bg-beige-bg/20 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-maroon-soft/20 focus:border-maroon-soft transition-all appearance-none @error('sumber_dana') border-red-500 @enderror"
                                            required>
                                            <option value="">-- Select Source --</option>
                                            <option value="Kas Kantor" {{ old('sumber_dana') == 'Kas Kantor' ? 'selected' : '' }}>Kas Kantor</option>
                                            <option value="Anggaran Tahunan" {{ old('sumber_dana') == 'Anggaran Tahunan' ? 'selected' : '' }}>Anggaran Tahunan</option>
                                            <option value="Dana Darurat" {{ old('sumber_dana') == 'Dana Darurat' ? 'selected' : '' }}>Dana Darurat</option>
                                            <option value="Sponsor" {{ old('sumber_dana') == 'Sponsor' ? 'selected' : '' }}>
                                                Sponsor</option>
                                            <option value="Lainnya" {{ old('sumber_dana') == 'Lainnya' ? 'selected' : '' }}>
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

                                <!-- Initial Status -->
                                <div class="space-y-2">
                                    <label
                                        class="text-[10px] font-bold text-abu-muda uppercase tracking-wider flex items-center gap-2">
                                        <i class="fas fa-tasks text-maroon-soft"></i>
                                        Allocation Status
                                    </label>
                                    <div class="relative">
                                        <select name="status"
                                            class="w-full pl-11 pr-10 py-3 bg-white border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-maroon-soft/20 focus:border-maroon-soft transition-all appearance-none @error('status') border-red-500 @enderror">
                                            <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending
                                                (Awaiting Review)</option>
                                            <option value="disetujui" {{ old('status') == 'disetujui' ? 'selected' : '' }}>
                                                Disetujui (Approved)</option>
                                            <option value="ditolak" {{ old('status') == 'ditolak' ? 'selected' : '' }}>Ditolak
                                                (Rejected)</option>
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
                                Purpose and Narrative</h3>
                            <div class="space-y-2">
                                <label
                                    class="text-[10px] font-bold text-abu-muda uppercase tracking-wider flex items-center gap-2">
                                    <i class="fas fa-align-left text-maroon-soft"></i>
                                    Allocation Description <span class="text-red-500">*</span>
                                </label>
                                <textarea name="keterangan" rows="4"
                                    class="w-full px-4 py-3 bg-beige-bg/20 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-maroon-soft/20 focus:border-maroon-soft transition-all @error('keterangan') border-red-500 @enderror"
                                    placeholder="Provide a clear justification or item breakdown for this budget allocation..."
                                    required>{{ old('keterangan') }}</textarea>
                                @error('keterangan')
                                    <p class="mt-1 text-xs text-red-500 font-medium">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Timeline & Attachments Section -->
                        <div class="space-y-6">
                            <h3
                                class="text-xs font-bold text-abu-muda uppercase tracking-[0.2em] border-b border-slate-50 pb-2">
                                Timeline and Documentation</h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <div class="space-y-6">
                                    <!-- Dates -->
                                    <div class="grid grid-cols-2 gap-4">
                                        <div class="space-y-2">
                                            <label class="text-[10px] font-bold text-abu-muda uppercase tracking-wider">
                                                Allocation Date
                                            </label>
                                            <input type="date" name="tanggal_alokasi"
                                                class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:ring-2 focus:ring-maroon-soft/20 focus:border-maroon-soft outline-none transition-all"
                                                value="{{ old('tanggal_alokasi', date('Y-m-d')) }}">
                                        </div>
                                        <div class="space-y-2">
                                            <label class="text-[10px] font-bold text-abu-muda uppercase tracking-wider">
                                                Est. Completion
                                            </label>
                                            <input type="date" name="tanggal_selesai"
                                                class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:ring-2 focus:ring-maroon-soft/20 focus:border-maroon-soft outline-none transition-all"
                                                value="{{ old('tanggal_selesai') }}">
                                        </div>
                                    </div>

                                    <!-- Security Patch info -->
                                    <div
                                        class="flex items-center gap-4 p-4 bg-maroon-soft/5 rounded-2xl border border-maroon-soft/10">
                                        <div
                                            class="w-10 h-10 rounded-xl bg-white flex items-center justify-center text-maroon-soft shadow-sm border border-slate-100 shrink-0">
                                            <i class="fas fa-lock"></i>
                                        </div>
                                        <p class="text-[11px] text-maroon-soft/80 font-medium leading-relaxed italic">
                                            Financial data is encrypted. Please ensure all allocations follow the
                                            organization's transparency protocols.
                                        </p>
                                    </div>
                                </div>

                                <!-- File Upload Area -->
                                <div class="space-y-2">
                                    <label
                                        class="text-[10px] font-bold text-abu-muda uppercase tracking-wider flex items-center gap-2">
                                        <i class="fas fa-paperclip text-maroon-soft"></i>
                                        Supporting Documents (Optional)
                                    </label>
                                    <div id="drop-zone"
                                        class="group relative flex flex-col items-center justify-center p-6 border-2 border-dashed border-slate-200 rounded-2xl hover:border-maroon-soft/50 hover:bg-beige-bg/10 transition-all cursor-pointer min-h-[140px]">
                                        <input type="file" name="files[]" id="file-upload"
                                            class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" multiple
                                            accept=".pdf,.doc,.docx,.xls,.xlsx">
                                        <div class="text-center" id="upload-placeholder">
                                            <div
                                                class="w-10 h-10 rounded-full bg-slate-50 flex items-center justify-center text-slate-400 mx-auto mb-2 group-hover:scale-110 transition-transform">
                                                <i class="fas fa-upload text-sm"></i>
                                            </div>
                                            <p class="text-[11px] font-bold text-slate-600">Select supporting files</p>
                                            <p class="text-[9px] text-abu-muda mt-1 uppercase tracking-tighter">PDF, DOC,
                                                XLS (MAX 10MB each)</p>
                                        </div>
                                        <!-- Multi-file preview will be handled via JS list if needed, but for simplicity showing count -->
                                        <div id="file-count-preview" class="hidden text-center">
                                            <div
                                                class="w-12 h-12 rounded-xl bg-blue-50 flex items-center justify-center text-blue-600 mx-auto mb-2">
                                                <i class="fas fa-copy"></i>
                                            </div>
                                            <p id="file-count-text" class="text-xs font-extrabold text-slate-700">0 Files
                                                Selected</p>
                                            <button type="button" onclick="resetFiles()"
                                                class="text-[10px] text-red-500 font-bold hover:underline mt-1">Clear
                                                All</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="mt-10 pt-6 border-t border-slate-100 flex flex-col sm:flex-row justify-end gap-3">
                        <a href="{{ route('admin.anggaran.index') }}"
                            class="px-6 py-3 bg-white border border-slate-200 rounded-xl text-sm font-bold text-slate-600 hover:bg-slate-50 transition-all text-center">
                            Discard Changes
                        </a>
                        <button type="submit"
                            class="px-10 py-3 bg-maroon-soft text-white rounded-xl text-sm font-bold hover:brightness-110 shadow-lg shadow-maroon-soft/20 transition-all">
                            <i class="fas fa-save mr-2"></i> Confirm and Save Budget
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
                    <h4 class="text-sm font-bold text-slate-800 mb-2 uppercase tracking-tight">Allocation Guidelines</h4>
                    <ul class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-2">
                        <li class="flex items-start gap-2 text-xs text-slate-500 leading-relaxed">
                            <span class="w-1 h-1 rounded-full bg-maroon-soft mt-1.5 shrink-0"></span>
                            Verify that the related activity has been strictly approved first.
                        </li>
                        <li class="flex items-start gap-2 text-xs text-slate-500 leading-relaxed">
                            <span class="w-1 h-1 rounded-full bg-maroon-soft mt-1.5 shrink-0"></span>
                            Clear purpose and itemized breakdown improves review speed.
                        </li>
                        <li class="flex items-start gap-2 text-xs text-slate-500 leading-relaxed">
                            <span class="w-1 h-1 rounded-full bg-maroon-soft mt-1.5 shrink-0"></span>
                            Support documentation is required for all allocations above Rp 1.000.000.
                        </li>
                        <li class="flex items-start gap-2 text-xs text-slate-500 leading-relaxed">
                            <span class="w-1 h-1 rounded-full bg-maroon-soft mt-1.5 shrink-0"></span>
                            Budget status can be toggled to Ditolak (Rejected) if review fails.
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            const fileInput = document.getElementById('file-upload');
            const placeholder = document.getElementById('upload-placeholder');
            const countPreview = document.getElementById('file-count-preview');
            const countText = document.getElementById('file-count-text');
            const dropZone = document.getElementById('drop-zone');

            fileInput.addEventListener('change', function (e) {
                if (this.files && this.files.length > 0) {
                    placeholder.classList.add('hidden');
                    countPreview.classList.remove('hidden');
                    countText.textContent = this.files.length + ' File(s) Selected';
                    dropZone.classList.add('border-maroon-soft/50', 'bg-beige-bg/5');
                }
            });

            function resetFiles() {
                fileInput.value = '';
                placeholder.classList.remove('hidden');
                countPreview.classList.add('hidden');
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