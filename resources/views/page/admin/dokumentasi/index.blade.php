@extends('layouts.app')

@section('title', 'Documentation Management')
@section('subtitle', 'Manage all activity documentation and files')

@section('content')
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h2 class="text-xl sm:text-2xl font-bold tracking-tight text-maroon-soft">Documentation Management</h2>
                <p class="text-slate-500 text-sm font-medium">{{ $totalFiles }} files across {{ $totalActivities }}
                    activities</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.dokumentasi.create') }}"
                    class="inline-flex items-center gap-2 px-4 py-2 bg-maroon-soft text-white rounded-lg text-sm font-bold hover:brightness-110 shadow-lg shadow-maroon-soft/20 transition-all">
                    <i class="fas fa-plus"></i>
                    <span>Upload Files</span>
                </a>

            </div>
        </div>

        <!-- File Type Summary -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="bg-white p-5 rounded-xl border border-slate-200/60 shadow-sm hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-2 bg-blue-50 rounded-lg">
                        <i class="fas fa-image text-blue-600"></i>
                    </div>
                </div>
                <p class="text-abu-muda text-[10px] font-bold uppercase tracking-wider">Images</p>
                <h3 class="text-2xl font-bold mt-1 text-slate-800">{{ $imageCount }}</h3>
            </div>

            <div class="bg-white p-5 rounded-xl border border-slate-200/60 shadow-sm hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-2 bg-red-50 rounded-lg">
                        <i class="fas fa-file-pdf text-red-600"></i>
                    </div>
                </div>
                <p class="text-abu-muda text-[10px] font-bold uppercase tracking-wider">PDF Files</p>
                <h3 class="text-2xl font-bold mt-1 text-slate-800">{{ $pdfCount }}</h3>
            </div>

            <div class="bg-white p-5 rounded-xl border border-slate-200/60 shadow-sm hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-2 bg-green-50 rounded-lg">
                        <i class="fas fa-file-word text-green-600"></i>
                    </div>
                </div>
                <p class="text-abu-muda text-[10px] font-bold uppercase tracking-wider">Documents</p>
                <h3 class="text-2xl font-bold mt-1 text-slate-800">{{ $docCount }}</h3>
            </div>

            <div class="bg-white p-5 rounded-xl border border-slate-200/60 shadow-sm hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-2 bg-purple-50 rounded-lg">
                        <i class="fas fa-folder text-purple-600"></i>
                    </div>
                </div>
                <p class="text-abu-muda text-[10px] font-bold uppercase tracking-wider">Other Files</p>
                <h3 class="text-2xl font-bold mt-1 text-slate-800">{{ $otherCount }}</h3>
            </div>
        </div>

        <!-- Documentation Content -->
        <div class="bg-white rounded-xl border border-slate-200/60 shadow-sm overflow-hidden">
            <div
                class="p-5 border-b border-slate-50 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                <h3 class="font-bold text-maroon-soft">All Documentation</h3>
                <div class="flex items-center gap-3 w-full sm:w-auto">
                    <div class="relative flex-1 sm:flex-initial">
                        <select id="viewMode"
                            class="w-full pl-3 pr-10 py-2 text-xs font-bold text-slate-600 bg-beige-bg/50 border-none rounded-lg focus:ring-2 focus:ring-maroon-soft/20 appearance-none cursor-pointer">
                            <option value="grid">Grid View</option>
                            <option value="list">List View</option>
                        </select>
                        <i
                            class="fas fa-chevron-down absolute right-3 top-1/2 -translate-y-1/2 text-[10px] text-abu-muda pointer-events-none"></i>
                    </div>
                    <div class="relative flex-1 sm:flex-initial">
                        <select id="sortBy"
                            class="w-full pl-3 pr-10 py-2 text-xs font-bold text-slate-600 bg-beige-bg/50 border-none rounded-lg focus:ring-2 focus:ring-maroon-soft/20 appearance-none cursor-pointer">
                            <option value="newest">Newest First</option>
                            <option value="oldest">Oldest First</option>
                            <option value="activity">By Activity</option>
                        </select>
                        <i
                            class="fas fa-chevron-down absolute right-3 top-1/2 -translate-y-1/2 text-[10px] text-abu-muda pointer-events-none"></i>
                    </div>
                </div>
            </div>

            <!-- Grid View -->
            <div id="gridView" class="p-5 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($dokumentasi as $dok)
                    <div
                        class="group bg-white rounded-xl border border-slate-100 overflow-hidden hover:shadow-xl hover:shadow-maroon-soft/5 transition-all duration-300">
                        <!-- File Preview -->
                        <div class="h-48 bg-slate-50 flex items-center justify-center relative overflow-hidden">
                            @if(in_array(pathinfo($dok->file, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif', 'webp']))
                                <img src="{{ asset('storage/' . $dok->file) }}" alt="{{ $dok->keterangan }}"
                                    class="h-full w-full object-cover group-hover:scale-110 transition-transform duration-500">
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity">
                                </div>
                                <div class="absolute top-3 right-3">
                                    <span
                                        class="inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-bold bg-white/90 text-blue-600 shadow-sm backdrop-blur-sm">
                                        <i class="fas fa-image mr-1"></i> IMAGE
                                    </span>
                                </div>
                            @elseif(pathinfo($dok->file, PATHINFO_EXTENSION) == 'pdf')
                                <div class="text-center group-hover:scale-110 transition-transform duration-300">
                                    <i class="fas fa-file-pdf text-5xl text-red-400"></i>
                                    <div class="mt-3">
                                        <span
                                            class="inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-bold bg-white/90 text-red-600 shadow-sm">
                                            <i class="fas fa-file-pdf mr-1"></i> PDF
                                        </span>
                                    </div>
                                </div>
                            @elseif(in_array(pathinfo($dok->file, PATHINFO_EXTENSION), ['doc', 'docx', 'xls', 'xlsx']))
                                <div class="text-center group-hover:scale-110 transition-transform duration-300">
                                    <i class="fas fa-file-word text-5xl text-blue-400"></i>
                                    <div class="mt-3">
                                        <span
                                            class="inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-bold bg-white/90 text-blue-600 shadow-sm">
                                            <i class="fas fa-file-alt mr-1"></i> DOC
                                        </span>
                                    </div>
                                </div>
                            @else
                                <div class="text-center group-hover:scale-110 transition-transform duration-300">
                                    <i class="fas fa-file text-5xl text-slate-300"></i>
                                    <div class="mt-3">
                                        <span
                                            class="inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-bold bg-white/90 text-slate-600 shadow-sm">
                                            <i class="fas fa-file mr-1"></i> FILE
                                        </span>
                                    </div>
                                </div>
                            @endif

                            <!-- Quick Actions Overlay -->
                            <div
                                class="absolute inset-0 flex items-center justify-center gap-2 opacity-0 group-hover:opacity-100 transition-opacity translate-y-4 group-hover:translate-y-0 duration-300">
                                <a href="{{ route('admin.dokumentasi.show', $dok->id) }}"
                                    class="w-10 h-10 rounded-full bg-white flex items-center justify-center text-maroon-soft hover:bg-maroon-soft hover:text-white transition-colors shadow-lg">
                                    <i class="fas fa-eye text-sm"></i>
                                </a>
                                <a href="{{ asset('storage/' . $dok->file) }}" download
                                    class="w-10 h-10 rounded-full bg-white flex items-center justify-center text-blue-600 hover:bg-blue-600 hover:text-white transition-colors shadow-lg">
                                    <i class="fas fa-download text-sm"></i>
                                </a>
                            </div>
                        </div>

                        <!-- File Info -->
                        <div class="p-4">
                            <div class="flex items-start justify-between mb-3">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-9 h-9 rounded-lg bg-maroon-soft/5 flex items-center justify-center text-maroon-soft text-sm font-bold">
                                        {{ strtoupper(substr($dok->kegiatan->judul, 0, 1)) }}
                                    </div>
                                    <div class="min-w-0">
                                        <p class="text-sm font-bold text-slate-700 truncate capitalize">
                                            {{ $dok->kegiatan->judul }}</p>
                                        <p class="text-[10px] font-bold text-abu-muda uppercase tracking-tight">
                                            {{ \Carbon\Carbon::parse($dok->kegiatan->tanggal)->format('d M Y') }}
                                        </p>
                                    </div>
                                </div>
                                <div class="relative dropdown">
                                    <button
                                        class="w-8 h-8 rounded-lg flex items-center justify-center text-slate-400 hover:bg-beige-bg transition-colors dropdown-toggle">
                                        <i class="fas fa-ellipsis-v text-xs"></i>
                                    </button>
                                    <div
                                        class="dropdown-menu hidden absolute right-0 mt-2 w-40 bg-white rounded-xl shadow-xl border border-slate-50 z-50 overflow-hidden">
                                        <a href="{{ route('admin.dokumentasi.edit', $dok->id) }}"
                                            class="flex items-center gap-3 px-4 py-3 text-sm text-slate-600 hover:bg-beige-bg transition-colors font-medium">
                                            <i class="fas fa-edit text-amber-500"></i> Edit File
                                        </a>
                                        <form action="{{ route('admin.dokumentasi.destroy', $dok->id) }}" method="POST"
                                            class="w-full">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="w-full flex items-center gap-3 px-4 py-3 text-sm text-red-600 hover:bg-red-50 transition-colors font-medium"
                                                onclick="return confirm('Are you sure?')">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <p class="text-xs text-slate-600 font-medium mb-4 line-clamp-2 min-h-[2rem]">{{ $dok->keterangan }}
                            </p>

                            <div class="pt-4 border-t border-slate-50 flex items-center justify-between">
                                <span
                                    class="flex items-center gap-1.5 text-[10px] font-bold text-abu-muda uppercase tracking-wider">
                                    <i class="fas fa-calendar-alt text-maroon-soft/40"></i>
                                    {{ $dok->created_at->format('M d') }}
                                </span>
                                <span
                                    class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded bg-beige-bg/80 text-[10px] font-bold text-maroon-soft/70 uppercase">
                                    <i class="fas fa-user-circle"></i>
                                    {{-- $dok->user->name --}} Staff
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- List View (Hidden by default) -->
            <div id="listView" class="hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-beige-bg/50 text-[11px] font-bold text-abu-muda uppercase tracking-wider">
                                <th class="px-6 py-4">File Item</th>
                                <th class="px-6 py-4">Related Activity</th>
                                <th class="px-6 py-4">Uploaded</th>
                                <th class="px-6 py-4 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            @foreach($dokumentasi as $dok)
                                <tr class="hover:bg-beige-bg/20 transition-colors">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            @php $ext = pathinfo($dok->file, PATHINFO_EXTENSION); @endphp
                                            <div class="w-10 h-10 rounded-lg flex items-center justify-center
                                                        @if(in_array($ext, ['jpg', 'jpeg', 'png', 'gif'])) bg-blue-50 text-blue-600
                                                        @elseif($ext == 'pdf') bg-red-50 text-red-600
                                                        @else bg-slate-50 text-slate-600 @endif">
                                                <i
                                                    class="fas @if(in_array($ext, ['jpg', 'jpeg', 'png', 'gif'])) fa-image @elseif($ext == 'pdf') fa-file-pdf @else fa-file @endif"></i>
                                            </div>
                                            <div>
                                                <p class="text-sm font-bold text-slate-700">{{ $dok->keterangan }}</p>
                                                <p class="text-[10px] font-bold text-abu-muda uppercase">{{ strtoupper($ext) }}
                                                    File</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <p class="text-sm font-semibold text-slate-600">{{ $dok->kegiatan->judul }}</p>
                                        <p class="text-xs text-slate-400 capitalize">{{ $dok->kegiatan->lokasi }}</p>
                                    </td>
                                    <td class="px-6 py-4 text-xs font-bold text-abu-muda uppercase">
                                        {{ $dok->created_at->format('M d, Y') }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center justify-end gap-2">
                                            <a href="{{ route('admin.dokumentasi.show', $dok->id) }}"
                                                class="w-8 h-8 rounded-lg bg-slate-50 flex items-center justify-center text-slate-400 hover:bg-maroon-soft hover:text-white transition-all shadow-sm">
                                                <i class="fas fa-eye text-xs"></i>
                                            </a>
                                            <a href="{{ asset('storage/' . $dok->file) }}" download
                                                class="w-8 h-8 rounded-lg bg-slate-50 flex items-center justify-center text-slate-400 hover:bg-blue-600 hover:text-white transition-all shadow-sm">
                                                <i class="fas fa-download text-xs"></i>
                                            </a>
                                            <a href="{{ route('admin.dokumentasi.edit', $dok->id) }}"
                                                class="w-8 h-8 rounded-lg bg-slate-50 flex items-center justify-center text-slate-400 hover:bg-amber-500 hover:text-white transition-all shadow-sm">
                                                <i class="fas fa-edit text-xs"></i>
                                            </a>
                                            <form action="{{ route('admin.dokumentasi.destroy', $dok->id) }}" method="POST"
                                                class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="w-8 h-8 rounded-lg bg-slate-50 flex items-center justify-center text-slate-400 hover:bg-red-600 hover:text-white transition-all shadow-sm"
                                                    onclick="return confirm('Are you sure?')">
                                                    <i class="fas fa-trash text-xs"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Pagination -->
            {{-- <div class="mt-6">
                {{ $dokumentasi->links() }}
            </div> --}}
        </div>

        {{-- Stats usage --}}
        {{-- Removed to avoid errors for now --}}
    </div>

    @push('scripts')
        <script>
            document.getElementById('viewMode').addEventListener('change', function (e) {
                if (e.target.value === 'list') {
                    document.getElementById('gridView').classList.add('hidden');
                    document.getElementById('listView').classList.remove('hidden');
                } else {
                    document.getElementById('gridView').classList.remove('hidden');
                    document.getElementById('listView').classList.add('hidden');
                }
            });

            document.getElementById('sortBy').addEventListener('change', function (e) {
                // You would typically make an AJAX request here
                // For now, we'll just reload with query parameters
                window.location.href = '{{ route("admin.dokumentasi.index") }}?sort=' + e.target.value;
            });

            // Initialize dropdown toggles
            document.querySelectorAll('.dropdown-toggle').forEach(function (toggle) {
                toggle.addEventListener('click', function (e) {
                    e.stopPropagation();
                    const dropdown = this.nextElementSibling;
                    dropdown.classList.toggle('hidden');
                });
            });

            // Close dropdowns when clicking outside
            document.addEventListener('click', function () {
                document.querySelectorAll('.dropdown-menu').forEach(function (menu) {
                    menu.classList.add('hidden');
                });
            });
        </script>
    @endpush
@endsection