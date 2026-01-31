@extends('layouts.app')

@section('title', 'Detail Laporan: ' . $laporan->judul)

@section('content')
    <div class="max-w-5xl mx-auto">
        <div class="mb-4">
            <a href="{{ route('pimpinan.laporan.index') }}"
                class="inline-flex items-center text-sm font-bold text-slate-500 hover:text-maroon-soft transition-all">
                <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white rounded-xl shadow-card overflow-hidden">
                    <div class="p-6 border-b border-gray-100 flex justify-between items-center bg-slate-50/50">
                        <span
                            class="px-3 py-1 bg-white border border-slate-200 rounded-lg text-[10px] font-black text-slate-400 uppercase tracking-widest">Konten
                            Laporan</span>
                        <span class="text-xs text-slate-400 font-medium">Dibuat pada:
                            {{ $laporan->created_at->format('d M Y, H:i') }}</span>
                    </div>
                    <div class="p-8">
                        <h1 class="text-2xl font-black text-slate-800 mb-6 leading-tight">{{ $laporan->judul }}</h1>

                        <div class="prose max-w-none text-slate-600 leading-relaxed whitespace-pre-line">
                            {{ $laporan->isi }}
                        </div>
                    </div>
                </div>

                @if ($laporan->file_pdf)
                    <div
                        class="bg-white rounded-xl shadow-card p-6 flex items-center justify-between border-l-4 border-maroon-soft">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-rose-50 rounded-xl flex items-center justify-center text-rose-500">
                                <i class="fas fa-file-pdf text-xl"></i>
                            </div>
                            <div>
                                <p class="text-sm font-bold text-slate-700">Lampiran Resmi (PDF)</p>
                                <p class="text-[10px] text-slate-400 font-medium">Klik tombol di samping untuk mengunduh
                                    dokumen.</p>
                            </div>
                        </div>
                        <a href="{{ asset('storage/' . $laporan->file_pdf) }}" target="_blank"
                            class="px-5 py-2.5 bg-slate-100 hover:bg-slate-200 rounded-lg text-xs font-bold text-slate-700 transition-all flex items-center gap-2">
                            <i class="fas fa-download"></i> Unduh PDF
                        </a>
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Info Section -->
                <div class="bg-white rounded-xl shadow-card p-6">
                    <h3 class="text-xs font-black text-slate-400 uppercase tracking-widest mb-4">Informasi Laporan</h3>

                    <div class="space-y-4">
                        <div class="flex flex-col">
                            <span class="text-[10px] font-bold text-slate-400 uppercase">Status</span>
                            <div class="mt-1">
                                <span
                                    class="px-3 py-1 rounded-lg text-[10px] font-bold uppercase tracking-wider
                                    @if ($laporan->status == 'disetujui') bg-emerald-100 text-emerald-700
                                    @elseif($laporan->status == 'ditolak') bg-rose-100 text-rose-700
                                    @else bg-amber-100 text-amber-700 @endif inline-flex items-center gap-1.5">
                                    <i
                                        class="fas {{ $laporan->status == 'disetujui' ? 'fa-check-circle' : ($laporan->status == 'ditolak' ? 'fa-times-circle' : 'fa-clock') }}"></i>
                                    {{ ucfirst($laporan->status) }}
                                </span>
                            </div>
                        </div>

                        <div class="flex flex-col">
                            <span class="text-[10px] font-bold text-slate-400 uppercase">Kegiatan</span>
                            <a href="{{ route('pimpinan.kegiatan.show', $laporan->kegiatan_id) }}"
                                class="mt-1 text-sm font-bold text-maroon-soft hover:underline">
                                {{ $laporan->kegiatan->judul ?? 'N/A' }}
                            </a>
                        </div>

                        <div class="flex flex-col">
                            <span class="text-[10px] font-bold text-slate-400 uppercase">Tanggal Laporan</span>
                            <span
                                class="mt-1 text-sm font-bold text-slate-700">{{ \Carbon\Carbon::parse($laporan->tanggal_laporan)->format('d F Y') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Sender Section -->
                <div class="bg-white rounded-xl shadow-card p-6">
                    <h3 class="text-xs font-black text-slate-400 uppercase tracking-widest mb-4">Disusun Oleh</h3>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center text-slate-400">
                            <i class="fas fa-user"></i>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-slate-700">{{ $laporan->user->name ?? 'System' }}</p>
                            <p class="text-[10px] font-medium text-slate-400 uppercase">
                                {{ $laporan->user->role ?? 'User' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="border-2 border-[#7B3F61] rounded-xl shadow-lg p-6 text-white">
                    <h3 class="text-xs font-black text-[#7B3F61] uppercase tracking-widest mb-4">Tindakan Cepat</h3>
                    <div class="grid grid-cols-2 gap-2">
                        <a href="{{ route('pimpinan.laporan.edit', $laporan->id) }}"
                            class="p-3 border-2 border-[#7B3F61] rounded-lg text-[#7B3F61] hover:bg-[#7B3F61] hover:text-white text-center transition-all">
                            <i class="fas fa-edit block mb-1"></i>
                            <span class="text-[10px] font-bold uppercase">Edit</span>
                        </a>
                        <form action="{{ route('pimpinan.laporan.destroy', $laporan->id) }}" method="POST"
                            onsubmit="return confirm('Hapus laporan?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="w-full p-3 border-2 border-rose-500 hover:bg-rose-500 hover:text-white rounded-lg text-rose-400 transition-all">
                                <i class="fas fa-trash-alt block mb-1"></i>
                                <span class="text-[10px] font-bold uppercase">Hapus</span>
                            </button>
                        </form>
                    </div>
                    @if ($laporan->status == 'pending')
                        <div class="mt-4 flex flex-col gap-2">
                            <form action="{{ route('pimpinan.laporan.approve', $laporan->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="disetujui">
                                <button type="submit"
                                    class="w-full py-2.5 bg-emerald-500 hover:bg-emerald-600 rounded-lg text-[10px] font-black uppercase tracking-widest transition-all">Setujui
                                    Laporan</button>
                            </form>
                            <form action="{{ route('pimpinan.laporan.approve', $laporan->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="ditolak">
                                <button type="submit"
                                    class="w-full py-2.5 border border-white/20 hover:bg-white/10 rounded-lg text-[10px] font-black uppercase tracking-widest transition-all">Tolak
                                    Laporan</button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
