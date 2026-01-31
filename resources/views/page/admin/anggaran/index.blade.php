@extends('layouts.app')

@section('title', 'Anggaran')

@section('content')
    <div class="space-y-6">
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h2 class="text-xl sm:text-2xl font-bold tracking-tight text-maroon-soft">Anggaran</h2>
                <p class="text-slate-500 dark:text-slate-400 text-sm font-medium">Monitoring Anggaran.</p>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('admin.anggaran.create') }}"
                    class="inline-flex items-center gap-2 px-3 sm:px-4 py-2 bg-maroon-soft text-white rounded-lg text-xs sm:text-sm font-bold hover:brightness-110 shadow-lg shadow-maroon-soft/20 transition-all">
                    <i class="fas fa-plus"></i>
                    <span class="hidden sm:inline">Tambah Anggaran</span>
                    <span class="sm:hidden">Tambah</span>
                </a>
            </div>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <!-- Total Budget -->
            <div class="bg-white dark:bg-slate-900 p-5 rounded-2xl border border-slate-200/60 shadow-sm hover:shadow-md transition-all group">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-2.5 bg-maroon-soft/10 rounded-xl group-hover:scale-110 transition-transform">
                        <i class="fas fa-wallet text-maroon-soft text-lg"></i>
                    </div>
                </div>
                <div>
                    <p class="text-[10px] font-bold text-abu-muda uppercase tracking-widest mb-1">Total Anggaran</p>
                    <h3 class="text-lg font-extrabold text-slate-800 dark:text-slate-100 uppercase tracking-tight">
                        Rp {{ number_format($totalBudget, 0, ',', '.') }}
                    </h3>
                </div>
            </div>

            <!-- Approved -->
            <div class="bg-white dark:bg-slate-900 p-5 rounded-2xl border border-slate-200/60 shadow-sm hover:shadow-md transition-all group">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-2.5 bg-green-500/10 rounded-xl group-hover:scale-110 transition-transform">
                        <i class="fas fa-check-circle text-green-600 text-lg"></i>
                    </div>
                    <span class="text-[10px] font-bold text-green-600 bg-green-50 px-2 py-0.5 rounded-full">{{ number_format($approvedPercentage, 1) }}%</span>
                </div>
                <div>
                    <p class="text-[10px] font-bold text-abu-muda uppercase tracking-widest mb-1 text-green-600/70">Disetujui</p>
                    <h3 class="text-lg font-extrabold text-slate-800 dark:text-slate-100 uppercase tracking-tight">
                        Rp {{ number_format($approvedBudget, 0, ',', '.') }}
                    </h3>
                </div>
            </div>

            <!-- Pending -->
            <div class="bg-white dark:bg-slate-900 p-5 rounded-2xl border border-slate-200/60 shadow-sm hover:shadow-md transition-all group">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-2.5 bg-amber-500/10 rounded-xl group-hover:scale-110 transition-transform">
                        <i class="fas fa-clock text-amber-600 text-lg"></i>
                    </div>
                    <span class="text-[10px] font-bold text-amber-600 bg-amber-50 px-2 py-0.5 rounded-full">{{ number_format($pendingPercentage, 1) }}%</span>
                </div>
                <div>
                    <p class="text-[10px] font-bold text-abu-muda uppercase tracking-widest mb-1 text-amber-600/70">Ditolak</p>
                    <h3 class="text-lg font-extrabold text-slate-800 dark:text-slate-100 uppercase tracking-tight">
                        Rp {{ number_format($pendingBudget, 0, ',', '.') }}
                    </h3>
                </div>
            </div>

            <!-- Rejected -->
            <div class="bg-white dark:bg-slate-900 p-5 rounded-2xl border border-slate-200/60 shadow-sm hover:shadow-md transition-all group">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-2.5 bg-red-500/10 rounded-xl group-hover:scale-110 transition-transform">
                        <i class="fas fa-times-circle text-red-600 text-lg"></i>
                    </div>
                    <span class="text-[10px] font-bold text-red-600 bg-red-50 px-2 py-0.5 rounded-full">{{ number_format($rejectedPercentage, 1) }}%</span>
                </div>
                <div>
                    <p class="text-[10px] font-bold text-abu-muda uppercase tracking-widest mb-1 text-red-600/70">Ditolak</p>
                    <h3 class="text-lg font-extrabold text-slate-800 dark:text-slate-100 uppercase tracking-tight">
                        Rp {{ number_format($rejectedBudget, 0, ',', '.') }}
                    </h3>
                </div>
            </div>
        </div>

        <!-- Main Content Area -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Left Side: Table -->
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200/60 shadow-sm overflow-hidden">
                    <div class="p-5 border-b border-slate-100 dark:border-slate-800 flex items-center justify-between bg-slate-50/50">
                        <h3 class="text-sm font-bold text-slate-700 dark:text-slate-200 flex items-center gap-2">
                            <i class="fas fa-list text-maroon-soft"></i>
                            Data Anggaran
                        </h3>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-slate-50/50 dark:bg-slate-800/50">
                                    <th class="px-5 py-4 text-[10px] font-bold text-abu-muda uppercase tracking-wider border-b border-slate-100 dark:border-slate-800">No</th>
                                    <th class="px-5 py-4 text-[10px] font-bold text-abu-muda uppercase tracking-wider border-b border-slate-100 dark:border-slate-800">Kegiatan</th>
                                    <th class="px-5 py-4 text-[10px] font-bold text-abu-muda uppercase tracking-wider border-b border-slate-100 dark:border-slate-800">Jumlah</th>
                                    <th class="px-5 py-4 text-[10px] font-bold text-abu-muda uppercase tracking-wider border-b border-slate-100 dark:border-slate-800">Sumber</th>
                                    <th class="px-5 py-4 text-[10px] font-bold text-abu-muda uppercase tracking-wider border-b border-slate-100 dark:border-slate-800 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-50 dark:divide-slate-800">
                                @forelse($anggarans as $item)
                                    <tr class="hover:bg-beige-bg/10 dark:hover:bg-slate-800/50 transition-colors group">
                                        <td class="px-5 py-4">
                                            <div class="flex items-center gap-3">
                                                <div class="w-10 h-10 rounded-xl bg-slate-100 dark:bg-slate-800 flex items-center justify-center text-maroon-soft group-hover:bg-maroon-soft group-hover:text-white transition-all shadow-sm">
                                                    <i class="fas fa-file-invoice-dollar"></i>
                                                </div>
                                                <div class="min-w-0">
                                                    <p class="text-sm font-bold text-slate-700 dark:text-slate-200 truncate group-hover:text-maroon-soft transition-colors">{{ $item->kegiatan->judul ?? 'No Activity' }}</p>
                                                    <div class="flex items-center gap-2 mt-1">
                                                        @if($item->status == 'disetujui')
                                                            <span class="text-[9px] font-bold bg-green-50 text-green-600 px-1.5 py-0.5 rounded uppercase tracking-tighter">Disetujui</span>
                                                        @elseif($item->status == 'pending')
                                                            <span class="text-[9px] font-bold bg-amber-50 text-amber-600 px-1.5 py-0.5 rounded uppercase tracking-tighter">Menunggu</span>
                                                        @else
                                                            <span class="text-[9px] font-bold bg-red-50 text-red-600 px-1.5 py-0.5 rounded uppercase tracking-tighter">Ditolak</span>
                                                        @endif
                                                        <span class="text-[9px] font-bold text-abu-muda uppercase">{{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-5 py-4">
                                            <span class="text-sm font-extrabold text-slate-700 dark:text-slate-200">Rp {{ number_format($item->jumlah, 0, ',', '.') }}</span>
                                        </td>
                                        <td class="px-5 py-4">
                                            <div class="flex items-center gap-2">
                                                <div class="w-2 h-2 rounded-full bg-maroon-soft/40"></div>
                                                <span class="text-xs font-bold text-slate-500 dark:text-slate-400 capitalize">{{ $item->sumber_dana }}</span>
                                            </div>
                                        </td>
                                        <td class="px-5 py-4">
                                            <div class="flex items-center justify-center gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                                <a href="{{ route('admin.anggaran.show', $item->id) }}" class="w-8 h-8 rounded-lg bg-slate-100 dark:bg-slate-800 flex items-center justify-center text-slate-400 hover:bg-maroon-soft hover:text-white transition-all shadow-sm" title="View Detail">
                                                    <i class="fas fa-eye text-xs"></i>
                                                </a>
                                                <a href="{{ route('admin.anggaran.edit', $item->id) }}" class="w-8 h-8 rounded-lg bg-slate-100 dark:bg-slate-800 flex items-center justify-center text-slate-400 hover:bg-amber-500 hover:text-white transition-all shadow-sm" title="Edit">
                                                    <i class="fas fa-edit text-xs"></i>
                                                </a>
                                                <form action="{{ route('admin.anggaran.destroy', $item->id) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="w-8 h-8 rounded-lg bg-slate-100 dark:bg-slate-800 flex items-center justify-center text-slate-400 hover:bg-red-500 hover:text-white transition-all shadow-sm" title="Delete" onclick="return confirm('Silahkan konfirmasi untuk menghapus data ini?')">
                                                        <i class="fas fa-trash text-xs"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-5 py-10 text-center">
                                            <div class="flex flex-col items-center gap-3">
                                                <div class="w-16 h-16 rounded-full bg-slate-50 flex items-center justify-center text-slate-300">
                                                    <i class="fas fa-money-bill-wave text-2xl"></i>
                                                </div>
                                                <p class="text-sm font-bold text-slate-400 italic">Tidak ada data anggaran.</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if($anggarans->hasPages())
                        <div class="p-5 border-t border-slate-50 dark:border-slate-800">
                            {{ $anggarans->links() }}
                        </div>
                    @endif
                </div>
            </div>

            <!-- Right Side: Analytics -->
            <div class="space-y-6">
                <!-- Budget by Source Card -->
                <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200/60 shadow-sm p-6">
                    <h3 class="text-sm font-bold text-slate-700 dark:text-slate-200 mb-6 flex items-center gap-2">
                        <i class="fas fa-chart-pie text-maroon-soft"></i>
                        Alokasi Anggaran Berdasarkan Sumber
                    </h3>
                    
                    <div class="space-y-5">
                        @foreach($budgetBySource as $source)
                            <div class="space-y-2 group">
                                <div class="flex justify-between items-end">
                                    <div class="min-w-0">
                                        <p class="text-[10px] font-bold text-abu-muda uppercase tracking-widest">{{ $source->sumber_dana }}</p>
                                        <p class="text-xs font-bold text-slate-700 dark:text-slate-200 truncate">{{ $source->count }} Data</p>
                                    </div>
                                    <div class="text-right shrink-0">
                                        <p class="text-sm font-extrabold text-maroon-soft">Rp {{ number_format($source->total, 0, ',', '.') }}</p>
                                        <p class="text-[10px] font-bold text-abu-muda">{{ number_format(($source->total / $totalBudget) * 100, 1) }}%</p>
                                    </div>
                                </div>
                                <div class="h-1.5 w-full bg-slate-50 dark:bg-slate-800 rounded-full overflow-hidden">
                                    <div class="h-full bg-maroon-soft group-hover:brightness-110 transition-all rounded-full" style="width: {{ ($source->total / $totalBudget) * 100 }}%"></div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-8 pt-6 border-t border-slate-50 dark:border-slate-800">
                        <div class="bg-beige-bg/20 rounded-xl p-4 flex items-center gap-4">
                            <div class="w-10 h-10 rounded-lg bg-white flex items-center justify-center text-maroon-soft shadow-sm border border-slate-100">
                                <i class="fas fa-info-circle text-xs"></i>
                            </div>
                            <p class="text-[10px] text-slate-500 font-medium leading-relaxed italic">
                                Data anggaran diupdate secara real-time berdasarkan anggaran yang disetujui dan anggaran yang menunggu.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Status Summary Mini Card -->
                <div class="bg-maroon-soft rounded-2xl p-6 text-white shadow-lg shadow-maroon-soft/20 relative overflow-hidden group">
                    <div class="absolute -right-4 -bottom-4 w-24 h-24 bg-white/10 rounded-full blur-2xl group-hover:scale-150 transition-transform duration-700"></div>
                    <h3 class="text-sm font-bold opacity-80 mb-4 uppercase tracking-widest">Status Anggaran</h3>
                    
                    <div class="space-y-4 relative z-10">
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-bold opacity-60">Status Anggaran</span>
                            <span class="text-xs font-bold px-2 py-0.5 bg-white/20 rounded-full">Normal</span>
                        </div>
                        <div class="grid grid-cols-3 gap-2">
                            <div class="bg-white/10 rounded-xl p-3 text-center">
                                <p class="text-[10px] font-bold opacity-60 uppercase mb-1">Disetujui</p>
                                <p class="text-sm font-extrabold">{{ number_format($approvedPercentage, 0) }}%</p>
                            </div>
                            <div class="bg-white/10 rounded-xl p-3 text-center">
                                <p class="text-[10px] font-bold opacity-60 uppercase mb-1">Menunggu</p>
                                <p class="text-sm font-extrabold">{{ number_format($pendingPercentage, 0) }}%</p>
                            </div>
                            <div class="bg-white/10 rounded-xl p-3 text-center">
                                <p class="text-[10px] font-bold opacity-60 uppercase mb-1">Ditolak</p>
                                <p class="text-sm font-extrabold">{{ number_format($rejectedPercentage, 0) }}%</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection