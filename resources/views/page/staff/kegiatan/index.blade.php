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
                <a href="{{ route('staff.kegiatan.create') }}"
                    class="btn p-2 px-4 border border-[#7B3F61] text-[#7B3F61] hover:bg-[#7B3F61] hover:text-white flex items-center transition-all">
                    <i class="fas fa-plus mr-2"></i> Tambah Kegiatan
                </a>
                <a href="{{ route('staff.kegiatan.export-pdf') }}" id="btn-export-pdf"
                    class="btn p-2 px-4 border border-[#7B3F61] text-[#7B3F61] hover:bg-[#7B3F61] hover:text-white flex items-center transition-all">
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
                        class="w-full rounded-lg border-gray-300 focus:border-[#7B3F61] focus:ring focus:ring-[#7B3F61] focus:ring-opacity-50 filter-input">
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
                        class="w-full rounded-lg border-gray-300 focus:border-[#7B3F61] focus:ring focus:ring-[#7B3F61] focus:ring-opacity-50 filter-input">
                        <option value="">Semua Prioritas</option>
                        <option value="tinggi">Tinggi</option>
                        <option value="sedang">Sedang</option>
                        <option value="rendah">Rendah</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Mulai</label>
                    <input type="date" id="filter-start-date"
                        class="w-full rounded-lg border-gray-300 focus:border-[#7B3F61] focus:ring focus:ring-[#7B3F61] focus:ring-opacity-50 filter-input">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Selesai</label>
                    <input type="date" id="filter-end-date"
                        class="w-full rounded-lg border-gray-300 focus:border-[#7B3F61] focus:ring focus:ring-[#7B3F61] focus:ring-opacity-50 filter-input">
                </div>
            </div>
        </div>

        <!-- Activities Table -->
        <div class="overflow-x-auto rounded-lg border border-gray-200 bg-white relative">
            <!-- Loading Overlay -->
            <div id="loading-overlay" class="absolute inset-0 bg-white/50 z-10 flex items-center justify-center hidden">
                <div class="flex items-center gap-2 text-[#7B3F61]">
                    <i class="fas fa-spinner fa-spin"></i>
                    <span class="text-xs font-bold uppercase tracking-widest">Memuat...</span>
                </div>
            </div>
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <div class="flex items-center">
                                <input type="checkbox"
                                    class="h-4 w-4 rounded border-gray-300 text-[#7B3F61] focus:ring-[#7B3F61]">
                                <span class="ml-3">Judul Kegiatan</span>
                            </div>
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lokasi
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Penanggung Jawab</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Prioritas
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody id="kegiatan-table-body" class="bg-white divide-y divide-gray-200">
                    @include('page.staff.kegiatan._table')
                </tbody>
            </table>
        </div>

    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tableBody = document.getElementById('kegiatan-table-body');
            const loadingOverlay = document.getElementById('loading-overlay');
            const filters = document.querySelectorAll('.filter-input');
            const exportBtn = document.getElementById('btn-export-pdf');

            const fetchFilteredData = () => {
                const status = document.getElementById('filter-status').value;
                const prioritas = document.getElementById('filter-prioritas').value;
                const startDate = document.getElementById('filter-start-date').value;
                const endDate = document.getElementById('filter-end-date').value;

                const params = new URLSearchParams();
                params.append('status', status);
                params.append('prioritas', prioritas);
                params.append('start_date', startDate);
                params.append('end_date', endDate);

                // Update Export PDF link to match current filters
                if (exportBtn) {
                    const exportUrl = new URL("{{ route('staff.kegiatan.export-pdf') }}");
                    exportUrl.searchParams.set('status', status);
                    exportUrl.searchParams.set('prioritas', prioritas);
                    exportUrl.searchParams.set('start_date', startDate);
                    exportUrl.searchParams.set('end_date', endDate);
                    exportBtn.href = exportUrl.toString();
                }

                loadingOverlay.classList.remove('hidden');

                fetch(`{{ route('staff.kegiatan.index') }}?${params.toString()}`, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => response.text())
                    .then(data => {
                        tableBody.innerHTML = data;
                        loadingOverlay.classList.add('hidden');
                    })
                    .catch(error => {
                        console.error('Error fetching data:', error);
                        loadingOverlay.classList.add('hidden');
                    });
            };

            filters.forEach(filter => {
                filter.addEventListener('change', fetchFilteredData);
            });

            // Handle pagination clicks via AJAX
            document.addEventListener('click', function(e) {
                if (e.target.closest('.pagination a')) {
                    e.preventDefault();
                    const url = e.target.closest('a').href;
                    const params = new URLSearchParams(new URL(url).search);

                    // Keep internal filters when paginating
                    params.set('status', document.getElementById('filter-status').value);
                    params.set('prioritas', document.getElementById('filter-prioritas').value);
                    params.set('start_date', document.getElementById('filter-start-date').value);
                    params.set('end_date', document.getElementById('filter-end-date').value);

                    loadingOverlay.classList.remove('hidden');

                    fetch(`{{ route('staff.kegiatan.index') }}?${params.toString()}`, {
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        })
                        .then(response => response.text())
                        .then(data => {
                            tableBody.innerHTML = data;
                            loadingOverlay.classList.add('hidden');
                            document.querySelector('.overflow-x-auto').scrollIntoView({
                                behavior: 'smooth'
                            });
                        });
                }
            });
        });
    </script>
@endpush
