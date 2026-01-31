@extends('layouts.app')

@section('title', 'Laporan: ' . $laporan->judul)

@section('content')
    <div class="max-w-6xl mx-auto">
        <!-- Header -->
        <div class="mb-6 flex justify-between items-start">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">{{ $laporan->judul }}</h1>
                <div class="mt-2 flex items-center space-x-4">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium 
                        @if($laporan->status == 'approved') bg-green-100 text-green-800
                        @elseif($laporan->status == 'pending') bg-yellow-100 text-yellow-800
                        @elseif($laporan->status == 'rejected') bg-red-100 text-red-800
                        @else bg-gray-100 text-gray-800 @endif">
                        @if($laporan->status == 'approved')
                            <i class="fas fa-check-circle mr-1"></i>
                        @elseif($laporan->status == 'pending')
                            <i class="fas fa-clock mr-1"></i>
                        @elseif($laporan->status == 'rejected')
                            <i class="fas fa-times-circle mr-1"></i>
                        @else
                            <i class="fas fa-file-alt mr-1"></i>
                        @endif
                        {{ ucfirst($laporan->status) }}
                    </span>

                    <span class="text-gray-500 text-sm">
                        <i class="fas fa-user mr-1"></i>
                        {{ $laporan->user->name ?? 'Unknown' }}
                    </span>

                    <span class="text-gray-500 text-sm">
                        <i class="fas fa-calendar mr-1"></i>
                        {{ $laporan->created_at->format('d M Y') }}
                    </span>
                </div>
            </div>

            <div class="flex space-x-3">
                @if($laporan->file_pdf)
                    <a href="{{ asset('storage/' . $laporan->file_pdf) }}" target="_blank"
                        class="btn bg-green-100 text-green-700 hover:bg-green-200">
                        <i class="fas fa-file-pdf mr-2"></i> Lihat PDF
                    </a>
                @endif
                <a href="{{ route('admin.laporan.edit', $laporan->id) }}"
                    class="btn bg-yellow-100 text-yellow-700 hover:bg-yellow-200">
                    <i class="fas fa-edit mr-2"></i> Edit
                </a>
                <a href="{{ route('admin.laporan.index') }}" class="btn bg-gray-100 text-gray-700 hover:bg-gray-200">
                    <i class="fas fa-arrow-left mr-2"></i> Back
                </a>
            </div>
        </div>

        <!-- Main Content -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Left Column - Report Content -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Report Content -->
                <div class="bg-white rounded-xl shadow-card p-6">
                    <div class="prose max-w-none">
                        {!! nl2br(e($laporan->isi)) !!}
                    </div>
                </div>

                <!-- Activity Details -->
                <div class="bg-white rounded-xl shadow-card p-6">
                    <h2 class="text-lg font-semibold text-gray-800 mb-6 flex items-center">
                        <i class="fas fa-calendar-check text-primary mr-2"></i>
                        Related Activity
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 mb-2">Activity Title</h3>
                            <p class="font-medium text-gray-900">{{ $laporan->kegiatan->judul }}</p>
                        </div>

                        <div>
                            <h3 class="text-sm font-medium text-gray-500 mb-2">Date & Time</h3>
                            <p class="text-gray-800">
                                {{ \Carbon\Carbon::parse($laporan->kegiatan->tanggal)->format('d F Y') }}
                            </p>
                        </div>

                        <div>
                            <h3 class="text-sm font-medium text-gray-500 mb-2">Location</h3>
                            <p class="text-gray-800 flex items-center">
                                <i class="fas fa-map-marker-alt text-gray-400 mr-2"></i>
                                {{ $laporan->kegiatan->lokasi }}
                            </p>
                        </div>
                    </div>

                    <div class="mt-6">
                        <a href="{{ route('admin.kegiatan.show', $laporan->kegiatan->id) }}" class="btn btn-primary">
                            <i class="fas fa-external-link-alt mr-2"></i> View Activity Details
                        </a>
                    </div>
                </div>
            </div>

            <!-- Right Column -->
            <div class="space-y-6">
                <!-- Report Metadata -->
                <div class="bg-white rounded-xl shadow-card p-6">
                    <h2 class="text-lg font-semibold text-gray-800 mb-6">Report Details</h2>

                    <div class="space-y-4">
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 mb-1">Report ID</h3>
                            <p class="text-gray-800 font-mono">#{{ str_pad($laporan->id, 6, '0', STR_PAD_LEFT) }}</p>
                        </div>

                        <div>
                            <h3 class="text-sm font-medium text-gray-500 mb-1">Created By</h3>
                            <div class="flex items-center">
                                <div
                                    class="h-8 w-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-semibold mr-2">
                                    {{ strtoupper(substr($laporan->user->name ?? 'U', 0, 1)) }}
                                </div>
                                <div>
                                    <p class="font-medium text-gray-900">{{ $laporan->user->name ?? 'Unknown' }}</p>
                                    <p class="text-xs text-gray-500 capitalize">{{ $laporan->user->role ?? '' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Actions Card -->
                <div class="bg-white rounded-xl shadow-card p-6">
                    <h2 class="text-lg font-semibold text-gray-800 mb-6">Actions</h2>

                    <div class="space-y-3">
                        @if(auth()->user()->id == $laporan->user_id || auth()->user()->role == 'admin')
                            <form action="{{ route('admin.laporan.destroy', $laporan->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Are you sure you want to delete this report?')"
                                    class="w-full flex items-center justify-center p-3 bg-red-50 hover:bg-red-100 rounded-lg text-red-700">
                                    <i class="fas fa-trash-alt text-lg mr-3"></i>
                                    <div class="text-left">
                                        <p class="font-medium">Delete Report</p>
                                        <p class="text-sm">Permanently delete</p>
                                    </div>
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection