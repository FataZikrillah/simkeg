@extends('layouts.app')

@section('title', 'Tambah Kegiatan Baru')

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-xl shadow-card p-6">
            <!-- Form Header -->
            <div class="mb-8">
                <h2 class="text-2xl font-bold text-gray-800">Tambah Kegiatan Baru</h2>
                <p class="text-gray-600 mt-2">Isi form berikut untuk menambahkan kegiatan baru</p>
            </div>

            <!-- Progress Steps -->
            <div class="mb-8">
                <div class="flex items-center">
                    <div class="flex items-center relative">
                        <div
                            class="h-10 w-10 rounded-full bg-primary text-white flex items-center justify-center font-semibold">
                            1
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-gray-900">Informasi Dasar</p>
                        </div>
                    </div>
                    <div class="flex-1 h-1 bg-gray-200 mx-4"></div>
                    <div class="flex items-center relative">
                        <div
                            class="h-10 w-10 rounded-full bg-gray-200 text-gray-500 flex items-center justify-center font-semibold">
                            2
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-gray-500">Detail Kegiatan</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form -->
            <form action="{{ route('staff.kegiatan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Left Column -->
                    <div class="space-y-6">
                        <!-- Judul Kegiatan -->
                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-heading text-primary mr-2"></i>
                                Judul Kegiatan *
                            </label>
                            <input type="text" name="judul" class="form-input @error('judul') border-red-500 @enderror"
                                placeholder="Masukkan judul kegiatan" value="{{ old('judul') }}" required>
                            @error('judul')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tanggal & Waktu -->
                        <div class="grid grid-cols-2 gap-4">
                            <div class="form-group">
                                <label class="form-label">
                                    <i class="fas fa-calendar text-primary mr-2"></i>
                                    Tanggal *
                                </label>
                                <input type="date" name="tanggal"
                                    class="form-input @error('tanggal') border-red-500 @enderror"
                                    value="{{ old('tanggal') }}" required>
                                @error('tanggal')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-label">
                                    <i class="fas fa-clock text-primary mr-2"></i>
                                    Waktu Mulai
                                </label>
                                <input type="time" name="waktu_mulai"
                                    class="form-input @error('waktu_mulai') border-red-500 @enderror"
                                    value="{{ old('waktu_mulai') }}">
                                @error('waktu_mulai')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Lokasi -->
                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-map-marker-alt text-primary mr-2"></i>
                                Lokasi *
                            </label>
                            <input type="text" name="lokasi" class="form-input @error('lokasi') border-red-500 @enderror"
                                placeholder="Tempat kegiatan dilaksanakan" value="{{ old('lokasi') }}" required>
                            @error('lokasi')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Penanggung Jawab -->
                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-user-tie text-primary mr-2"></i>
                                Penanggung Jawab
                            </label>
                            <select name="user_id" class="form-input @error('user_id') border-red-500 @enderror">
                                <option value="">Pilih Penanggung Jawab</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }} ({{ ucfirst($user->role) }})
                                    </option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="space-y-6">
                        <!-- Prioritas -->
                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-flag text-primary mr-2"></i>
                                Prioritas
                            </label>
                            <div class="grid grid-cols-3 gap-3 mt-2">
                                <label class="relative">
                                    <input type="radio" name="prioritas" value="rendah" class="sr-only peer" {{ old('prioritas') == 'rendah' ? 'checked' : '' }}>
                                    <div
                                        class="p-4 border-2 border-gray-200 rounded-lg text-center cursor-pointer peer-checked:border-green-500 peer-checked:bg-green-50">
                                        <i class="fas fa-flag text-green-500 text-lg mb-2"></i>
                                        <p class="text-sm font-medium">Rendah</p>
                                    </div>
                                </label>
                                <label class="relative">
                                    <input type="radio" name="prioritas" value="sedang" class="sr-only peer" {{ old('prioritas') == 'sedang' ? 'checked' : '' }}>
                                    <div
                                        class="p-4 border-2 border-gray-200 rounded-lg text-center cursor-pointer peer-checked:border-yellow-500 peer-checked:bg-yellow-50">
                                        <i class="fas fa-flag text-yellow-500 text-lg mb-2"></i>
                                        <p class="text-sm font-medium">Sedang</p>
                                    </div>
                                </label>
                                <label class="relative">
                                    <input type="radio" name="prioritas" value="tinggi" class="sr-only peer" {{ old('prioritas') == 'tinggi' ? 'checked' : '' }}>
                                    <div
                                        class="p-4 border-2 border-gray-200 rounded-lg text-center cursor-pointer peer-checked:border-red-500 peer-checked:bg-red-50">
                                        <i class="fas fa-flag text-red-500 text-lg mb-2"></i>
                                        <p class="text-sm font-medium">Tinggi</p>
                                    </div>
                                </label>
                            </div>
                            @error('prioritas')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-tasks text-primary mr-2"></i>
                                Status
                            </label>
                            <select name="status" class="form-input @error('status') border-red-500 @enderror">
                                <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="disetujui" {{ old('status') == 'disetujui' ? 'selected' : '' }}>Disetujui
                                </option>
                                <option value="ditolak" {{ old('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                <option value="selesai" {{ old('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                            </select>
                            @error('status')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Deskripsi -->
                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-align-left text-primary mr-2"></i>
                                Deskripsi *
                            </label>
                            <textarea name="deskripsi" rows="4"
                                class="form-input @error('deskripsi') border-red-500 @enderror"
                                placeholder="Deskripsi lengkap kegiatan..." required>{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- File Upload -->
                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-paperclip text-primary mr-2"></i>
                                Lampiran
                            </label>
                            <div
                                class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-primary transition-colors">
                                <div class="space-y-1 text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none"
                                        viewBox="0 0 48 48">
                                        <path
                                            d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <div class="flex text-sm text-gray-600">
                                        <label for="file-upload"
                                            class="relative cursor-pointer bg-white rounded-md font-medium text-primary hover:text-primary-dark focus-within:outline-none">
                                            <span>Upload file</span>
                                            <input id="file-upload" name="file" type="file" class="sr-only">
                                        </label>
                                        <p class="pl-1">or drag and drop</p>
                                    </div>
                                    <p class="text-xs text-gray-500">PDF, DOC, JPG up to 10MB</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="mt-8 pt-6 border-t border-gray-200 flex justify-end space-x-3">
                    <a href="{{ route('staff.kegiatan.index') }}" class="btn bg-gray-100 text-gray-700 hover:bg-gray-200">
                        <i class="fas fa-times mr-2"></i> Batal
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save mr-2"></i> Simpan Kegiatan
                    </button>
                </div>
            </form>
        </div>

        <!-- Help Text -->
        <div class="mt-6 bg-blue-50 border border-blue-200 rounded-lg p-4">
            <div class="flex">
                <i class="fas fa-info-circle text-blue-500 mt-1 mr-3"></i>
                <div>
                    <h3 class="text-sm font-medium text-blue-800">Tips</h3>
                    <ul class="mt-2 text-sm text-blue-700 list-disc list-inside space-y-1">
                        <li>Pastikan semua informasi yang diperlukan telah diisi dengan benar</li>
                        <li>Gunakan deskripsi yang jelas dan detail</li>
                        <li>Upload file pendukung jika diperlukan</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection