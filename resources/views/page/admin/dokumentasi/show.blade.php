@extends('layouts.app')

@section('title', 'Detail Dokumentasi')

@section('content')
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="mb-6 flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Detail Dokumentasi</h1>
                <p class="text-gray-600 mt-2">Diupload pada {{ $dokumentasi->created_at->format('d M Y H:i') }}</p>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('admin.dokumentasi.edit', $dokumentasi->id) }}"
                    class="btn bg-yellow-100 text-yellow-700 hover:bg-yellow-200">
                    <i class="fas fa-edit mr-2"></i> Edit
                </a>
                <a href="{{ route('admin.dokumentasi.index') }}" class="btn bg-gray-100 text-gray-700 hover:bg-gray-200">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                </a>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-card overflow-hidden">
            <!-- Image/File Preview -->
            <div class="bg-gray-100 p-6 flex items-center justify-center min-h-[300px]">
                @if(in_array(pathinfo($dokumentasi->file, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif']))
                    <img src="{{ asset('storage/' . $dokumentasi->file) }}" alt="{{ $dokumentasi->keterangan }}"
                        class="max-h-[600px] max-w-full rounded-lg shadow-sm">
                @elseif(pathinfo($dokumentasi->file, PATHINFO_EXTENSION) == 'pdf')
                    <div class="text-center">
                        <i class="fas fa-file-pdf text-6xl text-red-500 mb-4"></i>
                        <p class="text-gray-600 mb-4">File PDF</p>
                        <a href="{{ asset('storage/' . $dokumentasi->file) }}" target="_blank" class="btn btn-primary">
                            <i class="fas fa-eye mr-2"></i> Lihat PDF
                        </a>
                    </div>
                @else
                    <div class="text-center">
                        <i class="fas fa-file text-6xl text-gray-400 mb-4"></i>
                        <a href="{{ asset('storage/' . $dokumentasi->file) }}" download class="btn btn-primary">
                            <i class="fas fa-download mr-2"></i> Download File
                        </a>
                    </div>
                @endif
            </div>

            <!-- Details -->
            <div class="p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Informasi File</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h3 class="text-sm font-medium text-gray-500 mb-1">Keterangan</h3>
                        <p class="text-gray-800">{{ $dokumentasi->keterangan }}</p>
                    </div>

                    <div>
                        <h3 class="text-sm font-medium text-gray-500 mb-1">Kegiatan Terkait</h3>
                        <div class="flex items-center">
                            <div class="h-8 w-8 rounded-lg bg-blue-100 flex items-center justify-center mr-3">
                                <i class="fas fa-calendar-check text-blue-600"></i>
                            </div>
                            <div>
                                <a href="{{ route('admin.kegiatan.show', $dokumentasi->kegiatan->id) }}"
                                    class="font-medium text-blue-600 hover:text-blue-800 hover:underline">
                                    {{ $dokumentasi->kegiatan->judul }}
                                </a>
                                <p class="text-xs text-gray-500">
                                    {{ \Carbon\Carbon::parse($dokumentasi->kegiatan->tanggal)->format('d M Y') }}</p>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-sm font-medium text-gray-500 mb-1">Tipe File</h3>
                        <span
                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 uppercase">
                            {{ pathinfo($dokumentasi->file, PATHINFO_EXTENSION) }}
                        </span>
                    </div>

                    <div>
                        <h3 class="text-sm font-medium text-gray-500 mb-1">Aksi</h3>
                        <form action="{{ route('admin.dokumentasi.destroy', $dokumentasi->id) }}" method="POST"
                            class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="text-red-600 hover:text-red-900 font-medium text-sm flex items-center"
                                onclick="return confirm('Are you sure?')">
                                <i class="fas fa-trash mr-2"></i> Hapus Dokumentasi
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection