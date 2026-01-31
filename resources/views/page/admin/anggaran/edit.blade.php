@extends('layouts.app')

@section('title', 'Edit Budget')

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-xl shadow-card p-6">
            <!-- Form Header -->
            <div class="mb-8">
                <div class="flex items-center">
                    <div class="h-12 w-12 rounded-lg bg-yellow-100 flex items-center justify-center mr-4">
                        <i class="fas fa-edit text-yellow-600 text-xl"></i>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">Edit Budget</h2>
                        <p class="text-gray-600 mt-2">Modify budget details for {{ $anggaran->kegiatan->judul }}</p>
                    </div>
                </div>
            </div>

            <!-- Form -->
            <form action="{{ route('admin.anggaran.update', $anggaran->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Activity Selection (Disabled as it shouldn't change easily usually, but allows if needed or just display) -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-calendar-check text-primary mr-2"></i>
                            Activity
                        </label>
                        <select name="kegiatan_id" class="form-input bg-gray-50" disabled>
                            <option value="{{ $anggaran->kegiatan_id }}" selected>
                                {{ $anggaran->kegiatan->judul }}
                            </option>
                        </select>
                        <input type="hidden" name="kegiatan_id" value="{{ $anggaran->kegiatan_id }}">
                    </div>

                    <!-- Budget Amount -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-coins text-primary mr-2"></i>
                            Budget Amount *
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500">Rp</span>
                            </div>
                            <input type="number" name="jumlah"
                                class="form-input pl-12 @error('jumlah') border-red-500 @enderror" placeholder="0"
                                value="{{ old('jumlah', $anggaran->jumlah) }}" required>
                        </div>
                        @error('jumlah')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Source of Funds -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-piggy-bank text-primary mr-2"></i>
                            Source of Funds *
                        </label>
                        <select name="sumber_dana" class="form-input @error('sumber_dana') border-red-500 @enderror"
                            required>
                            <option value="">-- Select Source --</option>
                            <option value="Kas Kantor" {{ old('sumber_dana', $anggaran->sumber_dana) == 'Kas Kantor' ? 'selected' : '' }}>Kas Kantor
                            </option>
                            <option value="Anggaran Tahunan" {{ old('sumber_dana', $anggaran->sumber_dana) == 'Anggaran Tahunan' ? 'selected' : '' }}>
                                Anggaran Tahunan</option>
                            <option value="Dana Darurat" {{ old('sumber_dana', $anggaran->sumber_dana) == 'Dana Darurat' ? 'selected' : '' }}>Dana
                                Darurat</option>
                            <option value="Sponsor" {{ old('sumber_dana', $anggaran->sumber_dana) == 'Sponsor' ? 'selected' : '' }}>Sponsor</option>
                            <option value="Lainnya" {{ old('sumber_dana', $anggaran->sumber_dana) == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                        @error('sumber_dana')
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
                            <option value="pending" {{ old('status', $anggaran->status) == 'pending' ? 'selected' : '' }}>
                                Pending</option>
                            <option value="disetujui" {{ old('status', $anggaran->status) == 'disetujui' ? 'selected' : '' }}>
                                Disetujui</option>
                            <option value="ditolak" {{ old('status', $anggaran->status) == 'ditolak' ? 'selected' : '' }}>
                                Ditolak</option>
                        </select>
                        @error('status')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="md:col-span-2 form-group">
                        <label class="form-label">
                            <i class="fas fa-align-left text-primary mr-2"></i>
                            Description *
                        </label>
                        <textarea name="keterangan" rows="4"
                            class="form-input @error('keterangan') border-red-500 @enderror"
                            placeholder="Describe the purpose of this budget allocation..."
                            required>{{ old('keterangan', $anggaran->keterangan) }}</textarea>
                        @error('keterangan')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="mt-8 pt-6 border-t border-gray-200 flex justify-end space-x-3">
                    <a href="{{ route('admin.anggaran.index') }}" class="btn bg-gray-100 text-gray-700 hover:bg-gray-200">
                        <i class="fas fa-times mr-2"></i> Cancel
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save mr-2"></i> Update Budget
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection