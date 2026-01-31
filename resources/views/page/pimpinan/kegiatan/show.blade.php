@extends('layouts.app')

@section('title', 'Detail Kegiatan: ' . $kegiatan->judul)

@section('content')
    <div class="max-w-6xl mx-auto">
        <!-- Header -->
        <div class="mb-6 flex justify-between items-start">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">{{ $kegiatan->judul }}</h1>
                <div class="mt-2 flex items-center space-x-4">
                    <span
                        class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium 
                        @if ($kegiatan->status == 'disetujui') bg-green-100 text-green-800
                        @elseif($kegiatan->status == 'pending') bg-yellow-100 text-yellow-800
                        @elseif($kegiatan->status == 'ditolak') bg-red-100 text-red-800
                        @else bg-blue-100 text-blue-800 @endif">
                        @if ($kegiatan->status == 'disetujui')
                            <i class="fas fa-check-circle mr-1"></i>
                        @elseif($kegiatan->status == 'pending')
                            <i class="fas fa-clock mr-1"></i>
                        @elseif($kegiatan->status == 'ditolak')
                            <i class="fas fa-times-circle mr-1"></i>
                        @else
                            <i class="fas fa-spinner mr-1"></i>
                        @endif
                        {{ ucfirst($kegiatan->status) }}
                    </span>

                    <span
                        class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium 
                        @if ($kegiatan->prioritas == 'tinggi') bg-red-100 text-red-800
                        @elseif($kegiatan->prioritas == 'sedang') bg-yellow-100 text-yellow-800
                        @else bg-green-100 text-green-800 @endif">
                        @if ($kegiatan->prioritas == 'tinggi')
                            <i class="fas fa-exclamation-triangle mr-1"></i>
                        @endif
                        {{ ucfirst($kegiatan->prioritas) }}
                    </span>

                    <span class="text-gray-500 text-sm">
                        <i class="fas fa-calendar mr-1"></i>
                        {{ \Carbon\Carbon::parse($kegiatan->tanggal)->format('d M Y') }}
                    </span>

                    <span class="text-gray-500 text-sm">
                        <i class="fas fa-clock mr-1"></i>
                        {{ \Carbon\Carbon::parse($kegiatan->waktu_mulai)->format('H:i') }}
                    </span>
                </div>
            </div>

            <div class="flex space-x-3">
                <a href="{{ route('pimpinan.kegiatan.index') }}" class="btn bg-gray-100 text-gray-700 hover:bg-gray-200">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                </a>
            </div>
        </div>

        <!-- Main Content -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Left Column - Details -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Basic Information Card -->
                <div class="bg-white rounded-xl shadow-card p-6">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-info-circle text-primary mr-2"></i>
                        Informasi Dasar
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 mb-2">Deskripsi</h3>
                            <p class="text-gray-800">{{ $kegiatan->deskripsi }}</p>
                        </div>

                        <div>
                            <h3 class="text-sm font-medium text-gray-500 mb-2">Lokasi</h3>
                            <div class="flex items-center text-gray-800">
                                <i class="fas fa-map-marker-alt text-gray-400 mr-2"></i>
                                {{ $kegiatan->lokasi }}
                            </div>
                        </div>
                    </div>

                    <!-- Additional Info -->
                    <div class="mt-6 pt-6 border-t border-gray-200 grid grid-cols-2 md:grid-cols-4 gap-4">
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 mb-1">Dibuat</h3>
                            <p class="text-sm text-gray-800">{{ $kegiatan->created_at->format('d M Y') }}</p>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 mb-1">Diupdate</h3>
                            <p class="text-sm text-gray-800">{{ $kegiatan->updated_at->format('d M Y') }}</p>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 mb-1">ID Kegiatan</h3>
                            <p class="text-sm text-gray-800 font-mono">#{{ str_pad($kegiatan->id, 6, '0', STR_PAD_LEFT) }}
                            </p>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 mb-1">Kategori</h3>
                            <p class="text-sm text-gray-800">Regular</p>
                        </div>
                    </div>
                </div>

                <!-- Attachments Card -->
                @if ($kegiatan->dokumentasi->count() > 0)
                    <div class="bg-white rounded-xl shadow-card p-6">
                        <h2 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                            <i class="fas fa-paperclip text-primary mr-2"></i>
                            Lampiran & Dokumentasi
                        </h2>

                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            @foreach ($kegiatan->dokumentasi as $dok)
                                <div
                                    class="border border-gray-200 rounded-lg overflow-hidden hover:shadow-md transition-shadow">
                                    <div class="h-32 bg-gray-100 flex items-center justify-center">
                                        @if (in_array(pathinfo($dok->file, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif']))
                                            <img src="{{ asset('storage/' . $dok->file) }}" alt="{{ $dok->keterangan }}"
                                                class="h-full w-full object-cover">
                                        @else
                                            <i class="fas fa-file text-4xl text-gray-400"></i>
                                        @endif
                                    </div>
                                    <div class="p-3">
                                        <p class="text-sm font-medium text-gray-800 truncate">{{ $dok->keterangan }}</p>
                                        <div class="mt-2 flex justify-between items-center">
                                            <span class="text-xs text-gray-500">
                                                {{ \Carbon\Carbon::parse($dok->created_at)->format('d M') }}
                                            </span>
                                            <a href="{{ asset('storage/' . $dok->file) }}" download
                                                class="text-primary hover:text-primary-dark">
                                                <i class="fas fa-download"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <!-- Right Column - Sidebar -->
            <div class="space-y-6">
                <!-- Responsible Person -->
                <div class="bg-white rounded-xl shadow-card p-6">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-user-tie text-primary mr-2"></i>
                        Penanggung Jawab
                    </h2>

                    <div class="flex items-center">
                        <div
                            class="h-16 w-16 rounded-full bg-gradient-to-r from-primary to-blue-400 flex items-center justify-center text-white text-xl font-semibold">
                            {{ strtoupper(substr($kegiatan->user->name, 0, 1)) }}
                        </div>
                        <div class="ml-4">
                            <h3 class="font-medium text-gray-900">{{ $kegiatan->user->name }}</h3>
                            <p class="text-sm text-gray-500 capitalize">{{ $kegiatan->user->role }}</p>
                            <div class="mt-2 flex items-center text-sm text-gray-600">
                                <i class="fas fa-envelope mr-2"></i>
                                {{ $kegiatan->user->email }}
                            </div>
                            <div class="flex items-center text-sm text-gray-600 mt-1">
                                <i class="fas fa-phone mr-2"></i>
                                {{ $kegiatan->user->phone ?? '-' }}
                            </div>
                        </div>
                    </div>

                    <div class="mt-6">
                        <a href="mailto:{{ $kegiatan->user->email }}"
                            class="w-full btn bg-blue-50 text-primary hover:bg-blue-100">
                            <i class="fas fa-envelope mr-2"></i> Kirim Email
                        </a>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="bg-white rounded-xl shadow-card p-6">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4">Aksi Cepat</h2>

                    <div class="space-y-3">
                        <a href="{{ route('pimpinan.anggaran.create', ['kegiatan_id' => $kegiatan->id]) }}"
                            class="flex items-center p-3 bg-purple-50 hover:bg-purple-100 rounded-lg text-purple-700">
                            <i class="fas fa-money-bill-wave text-lg mr-3"></i>
                            <div>
                                <p class="font-medium">Tambah Anggaran</p>
                                <p class="text-sm">Alokasi dana</p>
                            </div>
                        </a>
                    </div>
                </div>

                <!-- Activity Timeline -->
                {{-- Timeline removed or static --}}
            </div>
        </div>
    </div>
@endsection
