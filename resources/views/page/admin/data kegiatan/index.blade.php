@extends('layouts.app')

@section('title', 'Kegiatan Management')
@section('subtitle', 'Daftar semua kegiatan yang terdaftar dalam sistem')

@section('content')
    <div class="space-y-6">
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h2 class="text-xl sm:text-2xl font-bold tracking-tight text-maroon-soft">Kegiatan Management
                </h2>
                <p class="text-slate-500 dark:text-slate-400 text-sm font-medium">Manage and monitor all activities in the
                    system.</p>
            </div>
            <div class="flex items-center gap-2">

                <a href="{{ route('admin.kegiatan.create') }}"
                    class="inline-flex items-center gap-2 px-3 sm:px-4 py-2 bg-maroon-soft text-white rounded-lg text-xs sm:text-sm font-bold hover:brightness-110 shadow-lg shadow-maroon-soft/20 transition-all">
                    <i class="fas fa-plus"></i>
                    <span>Tambah Kegiatan</span>
                </a>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4">
            <div
                class="bg-white dark:bg-slate-900 p-4 sm:p-5 rounded-xl border border-slate-200/60 dark:border-slate-800 shadow-sm hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-2 bg-maroon-soft/10 rounded-lg">
                        <i class="fas fa-tasks text-maroon-soft"></i>
                    </div>
                </div>
                <p class="text-abu-muda text-xs font-bold uppercase tracking-wider">Total Kegiatan</p>
                <h3 class="text-xl sm:text-2xl font-bold mt-1 text-slate-800 dark:text-white">{{ $totalKegiatan }}</h3>
            </div>

            <div
                class="bg-white dark:bg-slate-900 p-4 sm:p-5 rounded-xl border border-slate-200/60 dark:border-slate-800 shadow-sm hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-2 bg-yellow-100 rounded-lg">
                        <i class="fas fa-clock text-yellow-600"></i>
                    </div>
                </div>
                <p class="text-abu-muda text-xs font-bold uppercase tracking-wider">Pending</p>
                <h3 class="text-xl sm:text-2xl font-bold mt-1 text-slate-800 dark:text-white">{{ $pendingKegiatan }}</h3>
            </div>

            <div
                class="bg-white dark:bg-slate-900 p-4 sm:p-5 rounded-xl border border-slate-200/60 dark:border-slate-800 shadow-sm hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-2 bg-green-100 rounded-lg">
                        <i class="fas fa-check-circle text-green-600"></i>
                    </div>
                </div>
                <p class="text-abu-muda text-xs font-bold uppercase tracking-wider">Disetujui</p>
                <h3 class="text-xl sm:text-2xl font-bold mt-1 text-slate-800 dark:text-white">{{ $disetujuiKegiatan }}</h3>
            </div>

            <div
                class="bg-white dark:bg-slate-900 p-4 sm:p-5 rounded-xl border border-slate-200/60 dark:border-slate-800 shadow-sm hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-2 bg-red-100 rounded-lg">
                        <i class="fas fa-times-circle text-red-600"></i>
                    </div>
                </div>
                <p class="text-abu-muda text-xs font-bold uppercase tracking-wider">Ditolak</p>
                <h3 class="text-xl sm:text-2xl font-bold mt-1 text-slate-800 dark:text-white">{{ $ditolakKegiatan }}</h3>
            </div>
        </div>

        <!-- Activities Table -->
        <div
            class="bg-white dark:bg-slate-900 rounded-xl border border-slate-200/60 dark:border-slate-800 shadow-sm overflow-hidden">
            <div class="p-4 sm:p-5 border-b border-slate-100 dark:border-slate-800 flex items-center justify-between">
                <h3 class="font-bold text-maroon-soft">Activity List</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr
                            class="bg-beige-bg/80 dark:bg-slate-800/50 text-[11px] font-bold text-abu-muda uppercase tracking-wider">
                            <th class="px-6 py-3">Activity Name</th>
                            <th class="px-6 py-3 hidden md:table-cell">PIC</th>
                            <th class="px-6 py-3">Location</th>
                            <th class="px-6 py-3">Status</th>
                            <th class="px-6 py-3 hidden sm:table-cell">Date</th>
                            <th class="px-6 py-3 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50 dark:divide-slate-800">
                        @forelse($kegiatans as $item)
                            <tr class="hover:bg-beige-bg/30 dark:hover:bg-slate-800/50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-10 h-10 rounded-lg overflow-hidden shrink-0 border border-slate-200 dark:border-slate-800 shadow-sm bg-slate-50 dark:bg-slate-800 flex items-center justify-center">
                                            @if($item->image)
                                                <img src="{{ asset('storage/' . $item->image) }}"
                                                    class="w-full h-full object-cover">
                                            @else
                                                <i class="fas fa-image text-slate-300 dark:text-slate-600"></i>
                                            @endif
                                        </div>
                                        <div>
                                            <span class="text-sm font-semibold text-slate-700 block">{{ $item->judul }}</span>
                                            <span class="text-[10px] text-slate-500 line-clamp-1">{{ $item->deskripsi }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 hidden md:table-cell">
                                    <div class="flex items-center gap-2">
                                        <div
                                            class="w-6 h-6 rounded-full bg-blue-100 flex items-center justify-center text-[10px] text-blue-600 font-bold">
                                            {{ strtoupper(substr($item->user->name ?? 'U', 0, 1)) }}
                                        </div>
                                        <span
                                            class="text-xs text-slate-600 font-medium">{{ $item->user->name ?? 'Unknown' }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-xs text-slate-600 flex items-center gap-1">
                                        <i class="fas fa-map-marker-alt text-[10px]"></i>
                                        {{ $item->lokasi }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="flex items-center gap-1.5 text-xs font-medium 
                                                @if($item->status == 'disetujui') text-green-600 
                                                @elseif($item->status == 'pending') text-amber-600 
                                                @elseif($item->status == 'ditolak') text-red-600
                                                @else text-blue-600 @endif">
                                        <i class="fas fa-circle text-[8px]"></i>
                                        {{ ucfirst($item->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-xs text-abu-muda font-medium hidden sm:table-cell">
                                    {{ \Carbon\Carbon::parse($item->tanggal)->format('M d, Y') }}
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('admin.kegiatan.show', $item->id) }}"
                                            class="p-1.5 text-slate-400 hover:text-maroon-soft transition-colors" title="View">
                                            <i class="fas fa-eye text-sm"></i>
                                        </a>
                                        <a href="{{ route('admin.kegiatan.edit', $item->id) }}"
                                            class="p-1.5 text-slate-400 hover:text-amber-500 transition-colors" title="Edit">
                                            <i class="fas fa-edit text-sm"></i>
                                        </a>
                                        <form action="{{ route('admin.kegiatan.destroy', $item->id) }}" method="POST"
                                            class="inline deletable">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="p-1.5 text-slate-400 hover:text-red-500 transition-colors" title="Delete"
                                                onclick="return confirm('Are you sure?')">
                                                <i class="fas fa-trash text-sm"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-10 text-center">
                                    <div class="flex flex-col items-center justify-center text-slate-400">
                                        <i class="fas fa-clipboard-list text-4xl mb-3"></i>
                                        <p class="text-sm font-medium">No activities found.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination Section -->
            @if($kegiatans->hasPages())
                <div
                    class="px-6 py-4 bg-beige-bg/20 border-t border-slate-100 dark:border-slate-800 flex items-center justify-between">
                    <p class="text-[11px] font-bold text-abu-muda uppercase tracking-wider">
                        Showing {{ $kegiatans->firstItem() }} to {{ $kegiatans->lastItem() }} of {{ $kegiatans->total() }}
                        results
                    </p>
                    <div class="flex items-center gap-1">
                        <a href="{{ $kegiatans->previousPageUrl() }}"
                            class="p-2 rounded-lg bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-maroon-soft hover:bg-beige-bg transition-all shadow-sm {{ $kegiatans->onFirstPage() ? 'opacity-50 pointer-events-none' : '' }}">
                            <i class="fas fa-chevron-left text-xs"></i>
                        </a>

                        <div
                            class="flex items-center gap-1 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg p-1 shadow-sm">
                            @foreach($kegiatans->getUrlRange(max(1, $kegiatans->currentPage() - 1), min($kegiatans->lastPage(), $kegiatans->currentPage() + 1)) as $page => $url)
                                <a href="{{ $url }}"
                                    class="px-3 py-1 text-xs font-bold rounded-md transition-all {{ $page == $kegiatans->currentPage() ? 'bg-maroon-soft text-white' : 'text-slate-500 hover:text-maroon-soft' }}">
                                    {{ $page }}
                                </a>
                            @endforeach
                        </div>

                        <a href="{{ $kegiatans->nextPageUrl() }}"
                            class="p-2 rounded-lg bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-maroon-soft hover:bg-beige-bg transition-all shadow-sm {{ $kegiatans->hasMorePages() ? '' : 'opacity-50 pointer-events-none' }}">
                            <i class="fas fa-chevron-right text-xs"></i>
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Bulk selection
        document.getElementById('select-all').addEventListener('change', function (e) {
            document.querySelectorAll('.select-item').forEach(function (checkbox) {
                checkbox.checked = e.target.checked;
            });
        });
    </script>
@endpush