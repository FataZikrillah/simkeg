@extends('layouts.app')

@section('title', 'Manajemen Laporan')
@section('subtitle', 'Daftar semua laporan kegiatan organisasi')

@section('content')
    <div class="bg-white rounded-xl shadow-card overflow-hidden">
        <div
            class="p-6 border-b border-gray-100 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h2 class="text-xl font-bold text-gray-800">Daftar Laporan</h2>
                <p class="text-sm text-gray-500 mt-1">Total <span id="total-count">{{ $laporans->total() }}</span> laporan
                    tersedia</p>
            </div>
            <a href="{{ route('pimpinan.laporan.create') }}"
                class="btn px-4 py-2 rounded-lg border-2 border-maroon-soft text-maroon-soft hover:bg-maroon-soft hover:text-white flex items-center gap-2">
                <i class="fas fa-plus-circle"></i>
                Buat Laporan Baru
            </a>
        </div>

        <!-- Filter Section -->
        <div class="p-6 bg-slate-50/50 border-b border-gray-100">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-400">
                        <i class="fas fa-search text-xs"></i>
                    </span>
                    <input type="text" id="search-input" placeholder="Cari judul laporan..."
                        class="w-full pl-9 pr-4 py-2 bg-white border border-slate-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-maroon-soft/20 focus:border-maroon-soft transition-all">
                </div>
                <div>
                    <select id="status-filter"
                        class="w-full px-4 py-2 bg-white border border-slate-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-maroon-soft/20 focus:border-maroon-soft transition-all">
                        <option value="">Semua Status</option>
                        <option value="pending">Pending</option>
                        <option value="disetujui">Disetujui</option>
                        <option value="ditolak">Ditolak</option>
                    </select>
                </div>
                <div>
                    <input type="date" id="date-filter"
                        class="w-full px-4 py-2 bg-white border border-slate-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-maroon-soft/20 focus:border-maroon-soft transition-all">
                </div>
            </div>
        </div>

        <div class="overflow-x-auto relative">
            <!-- Loading Overlay -->
            <div id="loading-overlay"
                class="absolute inset-0 bg-white/60 backdrop-blur-[1px] z-10 flex items-center justify-center hidden transition-all">
                <div class="flex flex-col items-center gap-2">
                    <i class="fas fa-circle-notch fa-spin text-2xl text-maroon-soft"></i>
                    <span class="text-[10px] font-bold text-maroon-soft uppercase tracking-widest">Memuat Data...</span>
                </div>
            </div>

            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-black text-slate-500 uppercase tracking-widest">Judul &
                            Kegiatan</th>
                        <th class="px-6 py-4 text-left text-xs font-black text-slate-500 uppercase tracking-widest">Pengirim
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-black text-slate-500 uppercase tracking-widest">Tanggal
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-black text-slate-500 uppercase tracking-widest">Status
                        </th>
                        <th class="px-6 py-4 text-right text-xs font-black text-slate-500 uppercase tracking-widest">Aksi
                        </th>
                    </tr>
                </thead>
                <tbody id="laporan-table-body" class="divide-y divide-gray-200">
                    @include('page.pimpinan.laporan._table')
                </tbody>
            </table>
        </div>

        <div id="pagination-container" class="px-6 py-4 bg-gray-50 border-t border-gray-100">
            {{ $laporans->links() }}
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tableBody = document.getElementById('laporan-table-body');
            const paginationContainer = document.getElementById('pagination-container');
            const loadingOverlay = document.getElementById('loading-overlay');
            const totalCount = document.getElementById('total-count');

            const searchInput = document.getElementById('search-input');
            const statusFilter = document.getElementById('status-filter');
            const dateFilter = document.getElementById('date-filter');

            let searchTimeout;

            const fetchLaporan = (url = "{{ route('pimpinan.laporan.index') }}") => {
                const urlObj = new URL(url, window.location.origin);

                // Set or update parameters
                if (searchInput.value) urlObj.searchParams.set('search', searchInput.value);
                else urlObj.searchParams.delete('search');

                if (statusFilter.value) urlObj.searchParams.set('status', statusFilter.value);
                else urlObj.searchParams.delete('status');

                if (dateFilter.value) urlObj.searchParams.set('tanggal', dateFilter.value);
                else urlObj.searchParams.delete('tanggal');

                loadingOverlay.classList.remove('hidden');

                fetch(urlObj.toString(), {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => response.text())
                    .then(html => {
                        const tempDiv = document.createElement('div');
                        tempDiv.innerHTML = html;

                        // Replace table body
                        tableBody.innerHTML = html;

                        // Sync Total Count
                        const newMeta = tempDiv.querySelector('#ajax-meta');
                        if (newMeta) {
                            totalCount.innerText = newMeta.getAttribute('data-total');
                        }

                        // Sync Pagination
                        const newPagination = tempDiv.querySelector('#ajax-pagination-links');
                        if (newPagination) {
                            paginationContainer.innerHTML = newPagination.innerHTML;
                            paginationContainer.classList.remove('hidden');
                        } else {
                            paginationContainer.innerHTML = '';
                            paginationContainer.classList.add('hidden');
                        }

                        loadingOverlay.classList.add('hidden');
                    })
                    .catch(error => {
                        console.error('Error fetching reports:', error);
                        loadingOverlay.classList.add('hidden');
                    });
            };

            // Handle Input Changes
            searchInput.addEventListener('input', () => {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(() => fetchLaporan(), 500);
            });

            statusFilter.addEventListener('change', () => fetchLaporan());
            dateFilter.addEventListener('change', () => fetchLaporan());

            // AJAX Pagination
            paginationContainer.addEventListener('click', function(e) {
                const link = e.target.closest('a');
                if (link) {
                    e.preventDefault();
                    const url = link.getAttribute('href');
                    if (url) {
                        fetchLaporan(url);
                        window.scrollTo({
                            top: 0,
                            behavior: 'smooth'
                        });
                    }
                }
            });
        });
    </script>
@endpush
