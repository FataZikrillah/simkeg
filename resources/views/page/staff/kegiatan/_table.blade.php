@forelse($kegiatans as $item)
    <tr class="hover:bg-gray-50 transition-colors duration-150">
        <td class="px-6 py-4">
            <div class="flex items-center">
                <input type="checkbox" class="h-4 w-4 rounded border-gray-300 text-[#7B3F61] focus:ring-[#7B3F61]">
                <div class="ml-4">
                    <div class="text-sm font-medium text-gray-900">{{ $item->judul }}</div>
                    <div class="text-sm text-gray-500">{{ Str::limit($item->deskripsi, 50) }}</div>
                </div>
            </div>
        </td>
        <td class="px-6 py-4 whitespace-nowrap">
            <div class="text-sm text-gray-900">{{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}
            </div>
            <div class="text-sm text-gray-500"></div>
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
            @if ($item->status == 'disetujui')
                <span
                    class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                    <i class="fas fa-check-circle mr-1"></i> Disetujui
                </span>
            @elseif($item->status == 'pending')
                <span
                    class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                    <i class="fas fa-clock mr-1"></i> Pending
                </span>
            @elseif($item->status == 'ditolak')
                <span
                    class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                    <i class="fas fa-times-circle mr-1"></i> Ditolak
                </span>
            @else
                <span
                    class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                    <i class="fas fa-spinner mr-1"></i> {{ ucfirst($item->status) }}
                </span>
            @endif
        </td>
        <td class="px-6 py-4 whitespace-nowrap">
            <span
                class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium 
                @if ($item->prioritas == 'tinggi') bg-red-100 text-red-800 
                @elseif($item->prioritas == 'sedang') bg-yellow-100 text-yellow-800
                @else bg-green-100 text-green-800 @endif">
                {{ ucfirst($item->prioritas ?? 'Normal') }}
            </span>
        </td>
        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
            <div class="flex items-center space-x-3">
                <a href="{{ route('staff.kegiatan.show', $item->id) }}" class="text-blue-600 hover:text-blue-900"
                    title="View">
                    <i class="fas fa-eye"></i>
                </a>
                <a href="{{ route('staff.kegiatan.edit', $item->id) }}" class="text-yellow-600 hover:text-yellow-900"
                    title="Edit">
                    <i class="fas fa-edit"></i>
                </a>
                <form action="{{ route('staff.kegiatan.destroy', $item->id) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-600 hover:text-red-900 confirm-delete" title="Delete"
                        onclick="return confirm('Are you sure?')">
                        <i class="fas fa-trash"></i>
                    </button>
                </form>
            </div>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="7" class="px-6 py-10 text-center text-gray-500">
            <div class="flex flex-col items-center">
                <i class="fas fa-folder-open text-4xl mb-3 text-gray-300"></i>
                <p>Tidak ada kegiatan ditemukan</p>
            </div>
        </td>
    </tr>
@endforelse

@if ($kegiatans->hasPages())
    <tr>
        <td colspan="7" class="px-6 py-4 bg-gray-50">
            {{ $kegiatans->links() }}
        </td>
    </tr>
@endif
