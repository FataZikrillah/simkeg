@extends('layouts.app')

@section('title', 'Galeri Dokumentasi')
@section('subtitle', 'Kumpulan bukti visual kegiatan Anda')

@section('content')
    <div class="bg-white rounded-xl shadow-card overflow-hidden">
        <div
            class="p-6 border-b border-gray-100 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h2 class="text-xl font-bold text-gray-800">Galeri Foto Kegiatan</h2>
                <p class="text-sm text-gray-500 mt-1">Total {{ $dokumentasis->total() }} dokumentasi ditemukan</p>
            </div>
            <a href="{{ route('staff.dokumentasi.create') }}"
                class="btn px-4 py-2 rounded-lg border-2 border-maroon-soft text-maroon-soft hover:bg-maroon-soft hover:text-white flex items-center gap-2 transition-all font-bold text-sm">
                <i class="fas fa-upload"></i>
                Unggah Foto Baru
            </a>
        </div>

        <div class="p-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @forelse($dokumentasis as $item)
                    <div
                        class="group relative bg-slate-50 rounded-2xl overflow-hidden border border-slate-100 shadow-sm transition-all hover:shadow-md">
                        <!-- Image Container -->
                        <div class="aspect-video relative overflow-hidden bg-slate-200">
                            <img src="{{ asset('storage/' . $item->file) }}" alt="{{ $item->keterangan }}"
                                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">

                            <!-- Overlay Actions -->
                            <div
                                class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center gap-2">
                                <button type="button"
                                    onclick="openModal('{{ asset('storage/' . $item->file) }}', '{{ $item->kegiatan->judul ?? 'N/A' }}', '{{ $item->keterangan ?? 'Tidak ada keterangan.' }}', '{{ $item->created_at->format('d M Y') }}')"
                                    class="w-8 h-8 bg-white/20 backdrop-blur-md rounded-lg flex items-center justify-center text-white hover:bg-white/40 transition-all">
                                    <i class="fas fa-expand-alt text-xs"></i>
                                </button>
                                <a href="{{ route('staff.dokumentasi.edit', $item->id) }}"
                                    class="w-8 h-8 bg-white/20 backdrop-blur-md rounded-lg flex items-center justify-center text-white hover:bg-white/40 transition-all">
                                    <i class="fas fa-edit text-xs"></i>
                                </a>
                                <form action="{{ route('staff.dokumentasi.destroy', $item->id) }}" method="POST"
                                    class="inline" onsubmit="return confirm('Hapus dokumentasi ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="w-8 h-8 bg-rose-500/80 backdrop-blur-md rounded-lg flex items-center justify-center text-white hover:bg-rose-600 transition-all">
                                        <i class="fas fa-trash-alt text-xs"></i>
                                    </button>
                                </form>
                            </div>
                        </div>

                        <!-- Card Content -->
                        <div class="p-4">
                            <div class="mb-2">
                                <span
                                    class="px-2 py-0.5 bg-maroon-soft/5 text-maroon-soft text-[9px] font-black uppercase tracking-widest rounded">
                                    {{ $item->kegiatan->judul ?? 'N/A' }}
                                </span>
                            </div>
                            <p class="text-xs text-slate-600 font-medium line-clamp-2 min-h-[2rem]">
                                {{ $item->keterangan ?? 'Tidak ada keterangan.' }}
                            </p>
                            <div class="mt-3 pt-3 border-t border-slate-100 flex justify-between items-center">
                                <span class="text-[9px] font-bold text-slate-400">
                                    <i class="fas fa-calendar-alt mr-1"></i> {{ $item->created_at->format('d M Y') }}
                                </span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-12 text-center text-slate-500">
                        <div class="flex flex-col items-center">
                            <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mb-4">
                                <i class="fas fa-images text-3xl text-slate-200"></i>
                            </div>
                            <p class="font-bold">Belum ada dokumentasi terunggah</p>
                            <p class="text-sm mt-1">Unggah dokumentasi sebagai bukti pelaksanaan kegiatan Anda.</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>

        @if ($dokumentasis->hasPages())
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-100">
                {{ $dokumentasis->links() }}
            </div>
        @endif
    </div>

    @include('page.staff.dokumentasi.show')

    @push('scripts')
        <script>
            function openModal(image, kegiatan, keterangan, tanggal) {
                document.getElementById('modalImage').src = image;
                document.getElementById('modalKegiatan').innerText = kegiatan;
                document.getElementById('modalDesc').innerText = keterangan;
                document.getElementById('modalDate').innerText = tanggal;
                document.getElementById('modalDownload').href = image;

                const modal = document.getElementById('detailModal');
                modal.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            }

            function closeModal() {
                const modal = document.getElementById('detailModal');
                modal.classList.add('hidden');
                document.body.style.overflow = '';
            }

            // Close on overlay click
            document.getElementById('modalOverlay').addEventListener('click', closeModal);

            // Close on ESC key
            document.addEventListener('keydown', function(event) {
                if (event.key === "Escape") {
                    closeModal();
                }
            });
        </script>
    @endpush
@endsection
