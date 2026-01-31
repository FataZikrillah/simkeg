<div class="overflow-x-auto rounded-lg border border-gray-200">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    <div class="flex items-center">
                        <input type="checkbox" id="select-all"
                            class="h-4 w-4 rounded border-gray-300 text-primary focus:ring-primary">
                        <span class="ml-3">Judul Kegiatan</span>
                    </div>
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lokasi</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Penanggung
                    Jawab</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Prioritas
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse($kegiatans as $item)
                <tr class="hover:bg-gray-50 transition-colors duration-150">
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            <input type="checkbox"
                                class="h-4 w-4 rounded border-gray-300 text-primary focus:ring-primary select-item">
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">{{ $item->judul }}</div>
                                <div class="text-sm text-gray-500">{{ Str::limit($item->deskripsi, 50) }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        <div class="flex items-center">
                            <i class="fas fa-map-marker-alt text-gray-400 mr-2"></i>
                            {{ $item->lokasi }}
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div
                                class="h-8 w-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-semibold mr-3">
                                {{ strtoupper(substr($item->user->name ?? 'U', 0, 1)) }}
                            </div>
                            <div>
                                <div class="text-sm font-medium text-gray-900">{{ $item->user->name ?? 'Unknown' }}
                                </div>
                                <div class="text-xs text-gray-500 capitalize">{{ $item->user->role ?? 'Staf' }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @php
                            $statusClasses = [
                                'disetujui' => 'bg-green-100 text-green-800',
                                'pending' => 'bg-yellow-100 text-yellow-800',
                                'ditolak' => 'bg-red-100 text-red-800',
                                'selesai' => 'bg-blue-100 text-blue-800',
                            ];
                            $statusClass = $statusClasses[$item->status] ?? 'bg-gray-100 text-gray-800';
                        @endphp
                        <span
                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ $statusClass }}">
                            {{ ucfirst($item->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @php
                            $priorityClasses = [
                                'high' => 'bg-red-100 text-red-800',
                                'medium' => 'bg-yellow-100 text-yellow-800',
                                'low' => 'bg-green-100 text-green-800',
                            ];
                            $priorityClass = $priorityClasses[$item->prioritas] ?? 'bg-gray-100 text-gray-800';
                        @endphp
                        <span
                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ $priorityClass }}">
                            {{ ucfirst($item->prioritas ?? 'Normal') }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <a href="{{ route('pimpinan.kegiatan.show', $item->id) }}"
                            class="text-blue-600 hover:text-blue-900">
                            <i class="fas fa-eye"></i>
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="px-6 py-10 text-center text-gray-500 italic">
                        Tidak ada kegiatan yang ditemukan.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@if ($kegiatans->hasPages())
    <div class="mt-6 flex items-center justify-between" id="pagination-links">
        <div class="text-sm text-gray-700">
            Menampilkan {{ $kegiatans->firstItem() }} sampai {{ $kegiatans->lastItem() }} dari
            {{ $kegiatans->total() }} entri
        </div>
        <div class="flex items-center space-x-2">
            {{ $kegiatans->links() }}
        </div>
    </div>
@endif
