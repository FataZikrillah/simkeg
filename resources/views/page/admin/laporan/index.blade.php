@extends('layouts.app')

@section('title', 'Reports Management')

@section('content')
    <div class="space-y-6">
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h2 class="text-xl sm:text-2xl font-bold tracking-tight text-maroon-soft">Reports Management</h2>
                <p class="text-slate-500 text-sm font-medium">Monitoring activity documentation with a refined, professional touch.</p>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('admin.laporan.create') }}"
                    class="inline-flex items-center gap-2 px-3 sm:px-4 py-2 bg-maroon-soft text-white rounded-lg text-xs sm:text-sm font-bold hover:brightness-110 shadow-lg shadow-maroon-soft/20 transition-all">
                    <i class="fas fa-plus"></i>
                    <span class="hidden sm:inline">Create Report</span>
                    <span class="sm:hidden">New</span>
                </a>

            </div>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <!-- Total Reports -->
            <div class="bg-white dark:bg-slate-900 p-5 rounded-2xl border border-slate-200/60 shadow-sm hover:shadow-md transition-all group">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-2.5 bg-maroon-soft/10 rounded-xl group-hover:scale-110 transition-transform">
                        <i class="fas fa-file-alt text-maroon-soft text-lg"></i>
                    </div>
                </div>
                <div>
                    <p class="text-[10px] font-bold text-abu-muda uppercase tracking-widest mb-1">Total Reports</p>
                    <h3 class="text-xl font-extrabold text-slate-800 dark:text-slate-100">{{ $totalReports }} <span class="text-xs font-bold text-slate-400 ml-1">Entries</span></h3>
                </div>
            </div>

            <!-- Approved -->
            <div class="bg-white dark:bg-slate-900 p-5 rounded-2xl border border-slate-200/60 shadow-sm hover:shadow-md transition-all group">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-2.5 bg-green-500/10 rounded-xl group-hover:scale-110 transition-transform">
                        <i class="fas fa-check-circle text-green-600 text-lg"></i>
                    </div>
                    <span class="text-[10px] font-bold text-green-600 bg-green-50 px-2 py-0.5 rounded-full">{{ number_format($approvedPercentage, 0) }}%</span>
                </div>
                <div>
                    <p class="text-[10px] font-bold text-abu-muda uppercase tracking-widest mb-1 text-green-600/70">Approved</p>
                    <h3 class="text-xl font-extrabold text-slate-800 dark:text-slate-100">{{ $approvedReports }}</h3>
                </div>
            </div>

            <!-- Pending -->
            <div class="bg-white dark:bg-slate-900 p-5 rounded-2xl border border-slate-200/60 shadow-sm hover:shadow-md transition-all group">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-2.5 bg-amber-500/10 rounded-xl group-hover:scale-110 transition-transform">
                        <i class="fas fa-clock text-amber-600 text-lg"></i>
                    </div>
                    <span class="text-[10px] font-bold text-amber-600 bg-amber-50 px-2 py-0.5 rounded-full">{{ number_format($pendingPercentage, 0) }}%</span>
                </div>
                <div>
                    <p class="text-[10px] font-bold text-abu-muda uppercase tracking-widest mb-1 text-amber-600/70">Pending</p>
                    <h3 class="text-xl font-extrabold text-slate-800 dark:text-slate-100">{{ $pendingReports }}</h3>
                </div>
            </div>

            <!-- Rejected -->
            <div class="bg-white dark:bg-slate-900 p-5 rounded-2xl border border-slate-200/60 shadow-sm hover:shadow-md transition-all group">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-2.5 bg-red-500/10 rounded-xl group-hover:scale-110 transition-transform">
                        <i class="fas fa-times-circle text-red-600 text-lg"></i>
                    </div>
                    <span class="text-[10px] font-bold text-red-600 bg-red-50 px-2 py-0.5 rounded-full">{{ number_format($rejectedPercentage, 0) }}%</span>
                </div>
                <div>
                    <p class="text-[10px] font-bold text-abu-muda uppercase tracking-widest mb-1 text-red-600/70">Rejected</p>
                    <h3 class="text-xl font-extrabold text-slate-800 dark:text-slate-100">{{ $rejectedReports }}</h3>
                </div>
            </div>
        </div>

        <!-- Reports Table Area -->
        <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200/60 shadow-sm overflow-hidden">
            <div class="p-5 border-b border-slate-100 dark:border-slate-800 flex items-center justify-between bg-slate-50/50">
                <h3 class="text-sm font-bold text-slate-700 dark:text-slate-200 flex items-center gap-2">
                    <i class="fas fa-clipboard-list text-maroon-soft"></i>
                    All Generated Reports
                </h3>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/50 dark:bg-slate-800/50">
                            <th class="px-5 py-4 text-[10px] font-bold text-abu-muda uppercase tracking-wider border-b border-slate-100">Report Title & Preview</th>
                            <th class="px-5 py-4 text-[10px] font-bold text-abu-muda uppercase tracking-wider border-b border-slate-100">Related Activity</th>
                            <th class="px-5 py-4 text-[10px] font-bold text-abu-muda uppercase tracking-wider border-b border-slate-100">Author</th>
                            <th class="px-5 py-4 text-[10px] font-bold text-abu-muda uppercase tracking-wider border-b border-slate-100 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse($laporan as $item)
                            <tr class="hover:bg-beige-bg/10 transition-colors group">
                                <td class="px-5 py-4 min-w-[300px]">
                                    <div class="flex items-center gap-4">
                                        <div class="w-10 h-10 rounded-xl bg-slate-100 flex items-center justify-center text-maroon-soft group-hover:bg-maroon-soft group-hover:text-white transition-all shadow-sm">
                                            <i class="fas fa-file-contract"></i>
                                        </div>
                                        <div class="min-w-0">
                                            <p class="text-sm font-bold text-slate-700 group-hover:text-maroon-soft transition-colors truncate">{{ $item->judul }}</p>
                                            <div class="flex items-center gap-2 mt-1">
                                                @if($item->status == 'approved')
                                                    <span class="text-[9px] font-bold bg-green-50 text-green-600 px-1.5 py-0.5 rounded uppercase tracking-tighter">Approved</span>
                                                @elseif($item->status == 'pending')
                                                    <span class="text-[9px] font-bold bg-amber-50 text-amber-600 px-1.5 py-0.5 rounded uppercase tracking-tighter">Pending</span>
                                                @elseif($item->status == 'rejected')
                                                    <span class="text-[9px] font-bold bg-red-50 text-red-600 px-1.5 py-0.5 rounded uppercase tracking-tighter">Rejected</span>
                                                @else
                                                    <span class="text-[9px] font-bold bg-slate-100 text-slate-500 px-1.5 py-0.5 rounded uppercase tracking-tighter">Draft</span>
                                                @endif
                                                <span class="text-[9px] font-bold text-abu-muda uppercase">Created {{ $item->created_at->format('d M Y') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-5 py-4">
                                    <div class="flex items-center gap-2">
                                        <div class="w-2 h-2 rounded-full bg-maroon-soft/20"></div>
                                        <span class="text-xs font-bold text-slate-600 truncate max-w-[150px]">{{ $item->kegiatan->judul ?? 'No Activity' }}</span>
                                    </div>
                                </td>
                                <td class="px-5 py-4">
                                    <div class="flex items-center gap-2">
                                        <div class="w-7 h-7 rounded-full bg-slate-50 border border-slate-100 flex items-center justify-center text-[10px] font-bold text-maroon-soft shrink-0">
                                            {{ strtoupper(substr($item->user->name ?? 'U', 0, 1)) }}
                                        </div>
                                        <span class="text-xs font-bold text-slate-500 whitespace-nowrap">{{ $item->user->name ?? 'Unknown' }}</span>
                                    </div>
                                </td>
                                <td class="px-5 py-4">
                                    <div class="flex items-center justify-center gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                        <a href="{{ route('admin.laporan.show', $item->id) }}" class="w-8 h-8 rounded-lg bg-slate-100 flex items-center justify-center text-slate-400 hover:bg-maroon-soft hover:text-white transition-all shadow-sm" title="View Detail">
                                            <i class="fas fa-eye text-xs"></i>
                                        </a>
                                        <a href="{{ route('admin.laporan.edit', $item->id) }}" class="w-8 h-8 rounded-lg bg-slate-100 flex items-center justify-center text-slate-400 hover:bg-amber-500 hover:text-white transition-all shadow-sm" title="Edit">
                                            <i class="fas fa-edit text-xs"></i>
                                        </a>
                                        <form action="{{ route('admin.laporan.destroy', $item->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="w-8 h-8 rounded-lg bg-slate-100 flex items-center justify-center text-slate-400 hover:bg-red-500 hover:text-white transition-all shadow-sm" title="Delete" onclick="return confirm('Apakah Anda yakin ingin menghapus laporan ini?')">
                                                <i class="fas fa-trash text-xs"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-5 py-12 text-center">
                                    <div class="flex flex-col items-center gap-3">
                                        <div class="w-16 h-16 rounded-full bg-slate-50 flex items-center justify-center text-slate-300">
                                            <i class="fas fa-file-invoice text-2xl"></i>
                                        </div>
                                        <p class="text-sm font-bold text-slate-400 italic">No reports found in the archive.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            @if(method_exists($laporan, 'hasPages') && $laporan->hasPages())
                <div class="p-5 border-t border-slate-50 bg-slate-50/30">
                    {{ $laporan->links() }}
                </div>
            @endif
        </div>


    </div>
@endsection