<!-- Documentation Detail Modal -->
<div id="detailModal" class="fixed inset-0 z-[60] hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog"
    aria-modal="true">
    <!-- Overlay -->
    <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity" id="modalOverlay"></div>

    <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
        <div
            class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-4xl animate-in fade-in zoom-in duration-300">
            <!-- Close Button -->
            <button onclick="closeModal()"
                class="absolute top-4 right-4 z-10 w-8 h-8 flex items-center justify-center bg-white/20 backdrop-blur-md rounded-lg text-white hover:bg-white/40 transition-all border border-white/30">
                <i class="fas fa-times"></i>
            </button>

            <div class="flex flex-col lg:flex-row h-full lg:max-h-[80vh]">
                <!-- Image Section -->
                <div class="lg:w-2/3 bg-slate-100 flex items-center justify-center overflow-hidden">
                    <img id="modalImage" src="" alt="Preview" class="w-full h-full object-contain">
                </div>

                <!-- Info Section -->
                <div class="lg:w-1/3 p-8 flex flex-col">
                    <div class="mb-6">
                        <span id="modalKegiatan"
                            class="px-2 py-0.5 bg-maroon-soft/5 text-maroon-soft text-[10px] font-black uppercase tracking-widest rounded mb-2 inline-block">
                            Nama Kegiatan
                        </span>
                        <h3 class="text-xl font-bold text-gray-800" id="modalTitle">Detail Dokumentasi</h3>
                    </div>

                    <div class="space-y-4 mb-8 flex-1 overflow-y-auto">
                        <div>
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Keterangan
                            </p>
                            <p class="text-sm text-slate-600 leading-relaxed italic" id="modalDesc">
                                Tidak ada keterangan.
                            </p>
                        </div>

                        <div class="grid grid-cols-1 gap-4 pt-4 border-t border-slate-100">
                            <div>
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Diunggah
                                    Pada</p>
                                <p class="text-xs font-bold text-slate-700" id="modalDate">31 Januari 2026</p>
                            </div>
                        </div>
                    </div>

                    <div class="pt-6 border-t border-slate-100 flex gap-2">
                        <a id="modalDownload" href="" download
                            class="flex-1 py-3 bg-slate-50 border border-slate-200 text-slate-600 rounded-xl font-bold text-[10px] uppercase tracking-widest text-center hover:bg-slate-100 transition-all">
                            <i class="fas fa-download mr-1"></i> Unduh File
                        </a>
                        <button onclick="closeModal()"
                            class="flex-1 py-3 bg-maroon-soft text-white rounded-xl font-bold text-[10px] uppercase tracking-widest text-center hover:brightness-110 transition-all shadow-lg shadow-maroon-soft/20 text-white">
                            Tutup
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
