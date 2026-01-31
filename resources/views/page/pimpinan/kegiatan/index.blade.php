@extends('layouts.app')

@section('title', 'Kegiatan Management')
@section('subtitle', 'Daftar semua kegiatan yang terdaftar dalam sistem')

@section('content')
    <div class="bg-white rounded-xl shadow-card p-6">
        <!-- Header with Actions -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Daftar Kegiatan</h2>
                <p class="text-gray-600 mt-1">Total {{ $kegiatans->total() }} kegiatan ditemukan</p>
            </div>
            <div class="mt-4 md:mt-0 flex space-x-3">
                <a href="{{ route('pimpinan.kegiatan.export-pdf') }}" id="btn-export-pdf"
                    class="btn px-4 py-2 cursor-pointer bg-gray-100 text-gray-700 rounded-lg hover:bg-white hover:border hover:border-[#7B3F61] hover:text-[#7B3F61] transition-all flex items-center">
                    <i class="fas fa-file-pdf mr-2 text-red-600"></i> Export PDF
                </a>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="mb-6 p-4 bg-gray-50 rounded-lg">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                    <select id="filter-status"
                        class="w-full rounded-lg border-gray-300 focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                        <option value="">Semua Status</option>
                        <option value="pending">Pending</option>
                        <option value="disetujui">Disetujui</option>
                        <option value="ditolak">Ditolak</option>
                        <option value="selesai">Selesai</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Prioritas</label>
                    <select id="filter-prioritas"
                        class="w-full rounded-lg border-gray-300 focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                        <option value="">Semua Prioritas</option>
                        <option value="high">Tinggi</option>
                        <option value="medium">Sedang</option>
                        <option value="low">Rendah</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Mulai</label>
                    <input type="date" id="filter-start-date"
                        class="w-full rounded-lg border-gray-300 focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Selesai</label>
                    <input type="date" id="filter-end-date"
                        class="w-full rounded-lg border-gray-300 focus:border-primary focus:ring focus:ring-primary focus:ring-primary focus:ring-opacity-50">
                </div>
            </div>
        </div>

        <div id="table-container">
            @include('page.pimpinan.kegiatan.partials.table_body')
        </div>

    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tableContainer = document.getElementById('table-container');
            const filters = [
                'filter-status',
                'filter-prioritas',
                'filter-start-date',
                'filter-end-date'
            ];

            function fetchKegiatan(url = null) {
                const status = document.getElementById('filter-status').value;
                const prioritas = document.getElementById('filter-prioritas').value;
                const startDate = document.getElementById('filter-start-date').value;
                const endDate = document.getElementById('filter-end-date').value;

                if (!url) {
                    url = new URL("{{ route('pimpinan.kegiatan.index') }}");
                } else {
                    url = new URL(url);
                }

                url.searchParams.set('status', status);
                url.searchParams.set('prioritas', prioritas);
                url.searchParams.set('start_date', startDate);
                url.searchParams.set('end_date', endDate);

                // Update Export PDF link to match current filters
                const exportBtn = document.getElementById('btn-export-pdf');
                if (exportBtn) {
                    const exportUrl = new URL("{{ route('pimpinan.kegiatan.export-pdf') }}");
                    exportUrl.searchParams.set('status', status);
                    exportUrl.searchParams.set('prioritas', prioritas);
                    exportUrl.searchParams.set('start_date', startDate);
                    exportUrl.searchParams.set('end_date', endDate);
                    exportBtn.href = exportUrl.toString();
                }

                // Show loading state
                tableContainer.style.opacity = '0.5';

                fetch(url, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => response.text())
                    .then(html => {
                        tableContainer.innerHTML = html;
                        tableContainer.style.opacity = '1';

                        // Re-bind pagination clicks
                        bindPagination();
                    })
                    .catch(error => {
                        console.error('Error fetching data:', error);
                        tableContainer.style.opacity = '1';
                    });
            }

            function bindPagination() {
                const paginationLinks = document.querySelectorAll(
                    '#table-container .pagination a, #table-container nav a');
                paginationLinks.forEach(link => {
                    link.addEventListener('click', function(e) {
                        e.preventDefault();
                        fetchKegiatan(this.href);
                    });
                });
            }

            // Auto filter on any input change
            filters.forEach(id => {
                const element = document.getElementById(id);
                if (element) {
                    element.addEventListener('change', () => fetchKegiatan());
                    // For date inputs, also listen for input event for better responsiveness
                    if (element.type === 'date') {
                        element.addEventListener('input', () => {
                            if (element.value) fetchKegiatan();
                        });
                    }
                }
            });

            // Initial bind
            bindPagination();

            // Select all functionality
            document.addEventListener('change', function(e) {
                if (e.target.id === 'select-all') {
                    document.querySelectorAll('.select-item').forEach(checkbox => {
                        checkbox.checked = e.target.checked;
                    });
                }
            });
        });
    </script>
@endpush
