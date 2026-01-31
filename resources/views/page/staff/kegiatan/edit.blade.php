@extends('layouts.app')

@section('title', 'Edit Kegiatan')

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-xl shadow-card p-6">
            <!-- Form Header -->
            <div class="mb-8">
                <h2 class="text-2xl font-bold text-gray-800">Edit Kegiatan</h2>
                <p class="text-gray-600 mt-2">Edit informasi kegiatan</p>
            </div>

            <!-- Form -->
            <form action="{{ route('staff.kegiatan.update', $kegiatan->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="space-y-6">
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-heading text-primary mr-2"></i>
                            Judul Kegiatan *
                        </label>
                        <input type="text" name="judul" class="form-input @error('judul') border-red-500 @enderror"
                            placeholder="Nama Kegiatan" value="{{ old('judul', $kegiatan->judul) }}" required>
                        @error('judul')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-calendar-alt text-primary mr-2"></i>
                                Tanggal Pelaksanaan *
                            </label>
                            <input type="date" name="tanggal" class="form-input @error('tanggal') border-red-500 @enderror"
                                value="{{ old('tanggal', $kegiatan->tanggal) }}" required>
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
                                value="{{ old('waktu_mulai', $kegiatan->waktu_mulai) }}">
                            @error('waktu_mulai')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-map-marker-alt text-primary mr-2"></i>
                                Lokasi
                            </label>
                            <input type="text" name="lokasi" class="form-input @error('lokasi') border-red-500 @enderror"
                                placeholder="Tempat Pelaksanaan" value="{{ old('lokasi', $kegiatan->lokasi) }}">
                            @error('lokasi')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-flag text-primary mr-2"></i>
                                Prioritas
                            </label>
                            <select name="prioritas" class="form-input @error('prioritas') border-red-500 @enderror"
                                required>
                                <option value="rendah" {{ old('prioritas', $kegiatan->prioritas) == 'rendah' ? 'selected' : '' }}>Rendah</option>
                                <option value="sedang" {{ old('prioritas', $kegiatan->prioritas) == 'sedang' ? 'selected' : '' }}>Sedang</option>
                                <option value="tinggi" {{ old('prioritas', $kegiatan->prioritas) == 'tinggi' ? 'selected' : '' }}>Tinggi</option>
                            </select>
                            @error('prioritas')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="md:col-span-2 form-group">
                        <label class="form-label">
                            <i class="fas fa-align-left text-primary mr-2"></i>
                            Deskripsi Kegiatan *
                        </label>
                        <textarea name="deskripsi" rows="4" class="form-input @error('deskripsi') border-red-500 @enderror"
                            placeholder="Jelaskan detail kegiatan..."
                            required>{{ old('deskripsi', $kegiatan->deskripsi) }}</textarea>
                        @error('deskripsi')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-tasks text-primary mr-2"></i>
                            Status
                        </label>
                        <select name="status" class="form-input @error('status') border-red-500 @enderror">
                            <option value="pending" {{ old('status', $kegiatan->status) == 'pending' ? 'selected' : '' }}>
                                Pending</option>
                            <option value="disetujui" {{ old('status', $kegiatan->status) == 'disetujui' ? 'selected' : '' }}>
                                Disetujui</option>
                            <option value="ditolak" {{ old('status', $kegiatan->status) == 'ditolak' ? 'selected' : '' }}>
                                Ditolak</option>
                            <option value="selesai" {{ old('status', $kegiatan->status) == 'selesai' ? 'selected' : '' }}>
                                Selesai</option>
                        </select>
                        @error('status')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="mt-8 pt-6 border-t border-gray-200 flex justify-end space-x-3">
                    <a href="{{ route('staff.kegiatan.index') }}" class="btn bg-gray-100 text-gray-700 hover:bg-gray-200">
                        <i class="fas fa-times mr-2"></i> Batal
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save mr-2"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection