@extends('layouts.app')

@section('title', 'Unggah Dokumentasi')

@section('content')
    <div class="max-w-3xl mx-auto">
        <div class="mb-4">
            <a href="{{ route('staff.dokumentasi.index') }}"
                class="inline-flex items-center text-sm font-bold text-slate-500 hover:text-maroon-soft transition-all">
                <i class="fas fa-arrow-left mr-2"></i> Kembali ke Galeri
            </a>
        </div>

        <div class="bg-white rounded-xl shadow-card overflow-hidden">
            <div class="p-6 border-b border-gray-100 bg-slate-50/50">
                <h2 class="text-xl font-bold text-gray-800">Unggah Bukti Kegiatan</h2>
                <p class="text-sm text-gray-500 mt-1">Anda dapat mengunggah satu atau beberapa foto sekaligus.</p>
            </div>

            <form action="{{ route('staff.dokumentasi.store') }}" method="POST" enctype="multipart/form-data"
                class="p-8">
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

                    <!-- File Upload -->
                    <div>
                        <label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-2">Pilih Foto
                            (Bisa banyak)</label>
                        <div
                            class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-slate-200 border-dashed rounded-xl hover:border-maroon-soft transition-all bg-slate-50/30 group">
                            <div class="space-y-1 text-center">
                                <i
                                    class="fas fa-images text-4xl text-slate-300 group-hover:text-maroon-soft transition-colors mb-2"></i>
                                <div class="flex text-sm text-slate-600">
                                    <label for="files"
                                        class="relative cursor-pointer bg-white rounded-md font-bold text-maroon-soft hover:text-maroon-soft/80 focus-within:outline-none px-1">
                                        <span>Klik untuk mengunggah</span>
                                        <input id="files" name="files[]" type="file" multiple class="sr-only"
                                            accept="image/*">
                                    </label>
                                    <p class="pl-1">atau drag and drop</p>
                                </div>
                                <p class="text-[10px] text-slate-400 font-bold uppercase tracking-tighter">PNG, JPG, GIF up
                                    to 5MB per file</p>
                            </div>
                        </div>

                        <!-- Preview Container -->
                        <div id="preview-container" class="grid grid-cols-3 sm:grid-cols-4 gap-4 mt-4 hidden">
                            <!-- Previews will be injected here -->
                        </div>

                        @error('files')
                            <p class="text-rose-500 text-[10px] font-bold mt-1 uppercase tracking-wider">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Keterangan -->
                    <div>
                        <label for="keterangan"
                            class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-2">Keterangan
                            Umum</label>
                        <textarea name="keterangan" id="keterangan" rows="3"
                            class="w-full rounded-lg border-slate-200 focus:ring-maroon-soft focus:border-maroon-soft transition-all text-sm font-medium"
                            placeholder="Berikan keterangan singkat untuk foto-foto yang diunggah...">{{ old('keterangan') }}</textarea>
                        @error('keterangan')
                            <p class="text-rose-500 text-[10px] font-bold mt-1 uppercase tracking-wider">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-8 pt-6 border-t border-slate-100">
                    <button type="submit"
                        class="w-full py-3 bg-maroon-soft text-white rounded-xl font-black text-xs uppercase tracking-widest hover:brightness-110 transition-all shadow-lg shadow-maroon-soft/20">
                        <i class="fas fa-cloud-upload-alt mr-2"></i> Mulai Unggah
                    </button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script>
            document.getElementById('files').addEventListener('change', function(e) {
                const container = document.getElementById('preview-container');
                container.innerHTML = '';

                if (this.files && this.files.length > 0) {
                    container.classList.remove('hidden');

                    [...this.files].forEach(file => {
                        const reader = new FileReader();
                        reader.onload = function(event) {
                            const div = document.createElement('div');
                            div.className =
                                'relative aspect-square rounded-lg overflow-hidden border border-slate-200 bg-slate-100 shadow-sm';
                            div.innerHTML = `
                            <img src="${event.target.result}" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-black/10"></div>
                        `;
                            container.appendChild(div);
                        }
                        reader.readAsDataURL(file);
                    });
                } else {
                    container.classList.add('hidden');
                }
            });
        </script>
    @endpush
@endsection
