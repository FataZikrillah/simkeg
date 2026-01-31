@extends('layouts.app')

@section('title', 'Budget Details')

@section('content')
    <div class="max-w-6xl mx-auto">
        <!-- Header -->
        <div class="mb-6 flex justify-between items-start">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Budget Details</h1>
                <div class="mt-2 flex items-center space-x-4">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium 
                        @if($anggaran->status == 'disetujui') bg-green-100 text-green-800
                        @elseif($anggaran->status == 'pending') bg-yellow-100 text-yellow-800
                        @else bg-red-100 text-red-800 @endif">
                        @if($anggaran->status == 'disetujui')
                            <i class="fas fa-check-circle mr-1"></i>
                        @elseif($anggaran->status == 'pending')
                            <i class="fas fa-clock mr-1"></i>
                        @else
                            <i class="fas fa-times-circle mr-1"></i>
                        @endif
                        {{ ucfirst($anggaran->status) }}
                    </span>

                    <span class="text-gray-500 text-sm">
                        <i class="fas fa-money-bill-wave mr-1"></i>
                        Rp {{ number_format($anggaran->jumlah, 0, ',', '.') }}
                    </span>

                    <span class="text-gray-500 text-sm">
                        <i class="fas fa-piggy-bank mr-1"></i>
                        {{ $anggaran->sumber_dana }}
                    </span>
                </div>
            </div>

            <div class="flex space-x-3">
                <a href="{{ route('admin.anggaran.edit', $anggaran->id) }}"
                    class="btn bg-yellow-100 text-yellow-700 hover:bg-yellow-200">
                    <i class="fas fa-edit mr-2"></i> Edit
                </a>
                <a href="{{ route('admin.anggaran.index') }}" class="btn bg-gray-100 text-gray-700 hover:bg-gray-200">
                    <i class="fas fa-arrow-left mr-2"></i> Back
                </a>
                {{-- <button class="btn bg-blue-100 text-blue-700 hover:bg-blue-200" onclick="printBudget()">
                    <i class="fas fa-print mr-2"></i> Print
                </button> --}}
            </div>
        </div>

        <!-- Main Content -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Left Column -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Budget Information -->
                <div class="bg-white rounded-xl shadow-card p-6">
                    <h2 class="text-lg font-semibold text-gray-800 mb-6 flex items-center">
                        <i class="fas fa-info-circle text-primary mr-2"></i>
                        Budget Information
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 mb-2">Activity</h3>
                            <div class="flex items-center">
                                <div class="h-10 w-10 rounded-lg bg-blue-100 flex items-center justify-center mr-3">
                                    <i class="fas fa-calendar-check text-blue-600"></i>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-900">{{ $anggaran->kegiatan->judul }}</p>
                                    <p class="text-sm text-gray-500">
                                        {{ \Carbon\Carbon::parse($anggaran->kegiatan->tanggal)->format('d M Y') }}</p>
                                </div>
                            </div>
                        </div>

                        <div>
                            <h3 class="text-sm font-medium text-gray-500 mb-2">Amount</h3>
                            <p class="text-2xl font-bold text-gray-800">Rp
                                {{ number_format($anggaran->jumlah, 0, ',', '.') }}</p>
                            <p class="text-sm text-gray-500 mt-1">In IDR</p>
                        </div>

                        <div>
                            <h3 class="text-sm font-medium text-gray-500 mb-2">Source of Funds</h3>
                            <span
                                class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-purple-100 text-purple-800">
                                <i class="fas fa-piggy-bank mr-1"></i>
                                {{ $anggaran->sumber_dana }}
                            </span>
                        </div>

                        <div>
                            <h3 class="text-sm font-medium text-gray-500 mb-2">Status</h3>
                            @if($anggaran->status == 'disetujui')
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                    <i class="fas fa-check-circle mr-1"></i> Approved
                                </span>
                            @elseif($anggaran->status == 'pending')
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                                    <i class="fas fa-clock mr-1"></i> Pending Approval
                                </span>
                            @else
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                    <i class="fas fa-times-circle mr-1"></i> Rejected
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="mt-6 pt-6 border-t border-gray-200">
                        <h3 class="text-sm font-medium text-gray-500 mb-2">Description</h3>
                        <p class="text-gray-800">{{ $anggaran->keterangan }}</p>
                    </div>

                    <!-- Timeline -->
                    <div class="mt-6 pt-6 border-t border-gray-200">
                        <h3 class="text-sm font-medium text-gray-500 mb-4">Timeline</h3>
                        <div class="space-y-4">
                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    <div class="h-8 w-8 rounded-full bg-green-100 flex items-center justify-center">
                                        <i class="fas fa-plus text-green-600 text-sm"></i>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-900">Budget created</p>
                                    <p class="text-xs text-gray-500">{{ $anggaran->created_at->format('d M Y H:i') }}</p>
                                </div>
                            </div>

                            @if($anggaran->status == 'disetujui')
                                <div class="flex items-start">
                                    <div class="flex-shrink-0">
                                        <div class="h-8 w-8 rounded-full bg-blue-100 flex items-center justify-center">
                                            <i class="fas fa-check text-blue-600 text-sm"></i>
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        <p class="text-sm font-medium text-gray-900">Approved by management</p>
                                        <p class="text-xs text-gray-500">{{ $anggaran->updated_at->format('d M Y H:i') }}</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Activity Details -->
                <div class="bg-white rounded-xl shadow-card p-6">
                    <h2 class="text-lg font-semibold text-gray-800 mb-6 flex items-center">
                        <i class="fas fa-calendar-check text-primary mr-2"></i>
                        Activity Details
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 mb-2">Activity Title</h3>
                            <p class="font-medium text-gray-900">{{ $anggaran->kegiatan->judul }}</p>
                        </div>

                        <div>
                            <h3 class="text-sm font-medium text-gray-500 mb-2">Date & Time</h3>
                            <p class="text-gray-800">
                                {{ \Carbon\Carbon::parse($anggaran->kegiatan->tanggal)->format('d F Y') }}
                                @if($anggaran->kegiatan->waktu_mulai)
                                    at {{ \Carbon\Carbon::parse($anggaran->kegiatan->waktu_mulai)->format('H:i') }}
                                @endif
                            </p>
                        </div>

                        <div>
                            <h3 class="text-sm font-medium text-gray-500 mb-2">Location</h3>
                            <p class="text-gray-800 flex items-center">
                                <i class="fas fa-map-marker-alt text-gray-400 mr-2"></i>
                                {{ $anggaran->kegiatan->lokasi }}
                            </p>
                        </div>

                        <div>
                            <h3 class="text-sm font-medium text-gray-500 mb-2">Responsible Person</h3>
                            <div class="flex items-center">
                                <div
                                    class="h-8 w-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-semibold mr-2">
                                    {{ strtoupper(substr($anggaran->kegiatan->user->name ?? 'U', 0, 1)) }}
                                </div>
                                <span class="text-gray-800">{{ $anggaran->kegiatan->user->name ?? 'Unknown' }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6">
                        <h3 class="text-sm font-medium text-gray-500 mb-2">Activity Description</h3>
                        <p class="text-gray-800">{{ $anggaran->kegiatan->deskripsi }}</p>
                    </div>
                </div>
            </div>

            <!-- Right Column -->
            <div class="space-y-6">
                <!-- Actions Card -->
                <div class="bg-white rounded-xl shadow-card p-6">
                    <h2 class="text-lg font-semibold text-gray-800 mb-6">Actions</h2>

                    <div class="space-y-3">
                        @if($anggaran->status == 'pending' && auth()->user()->role == 'pimpinan')
                            <button onclick="approveBudget({{ $anggaran->id }})"
                                class="w-full flex items-center justify-center p-3 bg-green-50 hover:bg-green-100 rounded-lg text-green-700">
                                <i class="fas fa-check-circle text-lg mr-3"></i>
                                <div class="text-left">
                                    <p class="font-medium">Approve Budget</p>
                                    <p class="text-sm">Approve this allocation</p>
                                </div>
                            </button>

                            <button onclick="rejectBudget({{ $anggaran->id }})"
                                class="w-full flex items-center justify-center p-3 bg-red-50 hover:bg-red-100 rounded-lg text-red-700">
                                <i class="fas fa-times-circle text-lg mr-3"></i>
                                <div class="text-left">
                                    <p class="font-medium">Reject Budget</p>
                                    <p class="text-sm">Reject this allocation</p>
                                </div>
                            </button>
                        @endif

                        <a href="{{ route('admin.kegiatan.show', $anggaran->kegiatan->id) }}"
                            class="w-full flex items-center justify-center p-3 bg-blue-50 hover:bg-blue-100 rounded-lg text-blue-700">
                            <i class="fas fa-external-link-alt text-lg mr-3"></i>
                            <div class="text-left">
                                <p class="font-medium">View Activity</p>
                                <p class="text-sm">Go to activity details</p>
                            </div>
                        </a>

                        <form action="{{ route('admin.anggaran.destroy', $anggaran->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure you want to delete this budget?')"
                                class="w-full flex items-center justify-center p-3 bg-red-50 hover:bg-red-100 rounded-lg text-red-700">
                                <i class="fas fa-trash-alt text-lg mr-3"></i>
                                <div class="text-left">
                                    <p class="font-medium">Delete Budget</p>
                                    <p class="text-sm">Permanently delete</p>
                                </div>
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Budget Summary -->
                <div class="bg-white rounded-xl shadow-card p-6">
                    <h2 class="text-lg font-semibold text-gray-800 mb-6">Budget Summary</h2>

                    <div class="space-y-4">
                        <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                            <span class="text-gray-700">Allocated Amount</span>
                            <span class="font-bold text-gray-900">Rp
                                {{ number_format($anggaran->jumlah, 0, ',', '.') }}</span>
                        </div>

                        <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                            <span class="text-gray-700">Source</span>
                            <span class="font-medium text-gray-900">{{ $anggaran->sumber_dana }}</span>
                        </div>

                        <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                            <span class="text-gray-700">Created</span>
                            <span class="text-sm text-gray-500">{{ $anggaran->created_at->format('d M Y') }}</span>
                        </div>

                        <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                            <span class="text-gray-700">Last Updated</span>
                            <span class="text-sm text-gray-500">{{ $anggaran->updated_at->format('d M Y') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Related Documents (Hidden for now as relation handling needs confirmation) -->
                {{--
                @if($anggaran->dokumentasis->count() > 0)
                <div class="bg-white rounded-xl shadow-card p-6">
                    ...
                </div>
                @endif
                --}}
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            function printBudget() {
                // window.open('{{ route("anggaran.print", $anggaran->id) }}', '_blank');
            }
            //... API calls commented out for now or need update
        </script>
    @endpush
@endsection