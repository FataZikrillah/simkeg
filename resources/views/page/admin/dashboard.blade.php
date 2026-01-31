@extends('layouts.app')

@section('title', 'Dashboard')
@section('subtitle', 'Overview')


@section('content')
    <!-- Header Section -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h2 class="text-xl sm:text-2xl font-bold tracking-tight text-maroon-soft">Dashboard Overview
            </h2>
            <p class="text-slate-500 dark:text-slate-400 text-sm font-medium">Monitoring aktivitas kegiatan</p>
        </div>

    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4">
        <div
            class="bg-white dark:bg-slate-900 p-4 sm:p-5 rounded-xl border border-slate-200/60 dark:border-slate-800 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between mb-4">
                <div class="p-2 bg-maroon-soft/10 rounded-lg">
                    <i class="fas fa-chart-bar text-maroon-soft"></i>
                </div>
            </div>
            <p class="text-abu-muda text-xs font-bold uppercase tracking-wider">Total Kegiatan</p>
            <h3 class="text-xl sm:text-2xl font-bold mt-1 text-slate-800 dark:text-white">{{ $totalKegiatan }}</h3>
        </div>

        <div
            class="bg-white dark:bg-slate-900 p-4 sm:p-5 rounded-xl border border-slate-200/60 dark:border-slate-800 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between mb-4">
                <div class="p-2 bg-beige-accent/50 rounded-lg">
                    <i class="fas fa-money-bill-wave text-maroon-soft"></i>
                </div>
            </div>
            <p class="text-abu-muda text-xs font-bold uppercase tracking-wider">Total Anggaran</p>
            <h3 class="text-xl sm:text-2xl font-bold mt-1 text-slate-800 dark:text-white">Rp
                {{ number_format($totalAnggaran, 0, ',', '.') }}
            </h3>
        </div>

        <div
            class="bg-white dark:bg-slate-900 p-4 sm:p-5 rounded-xl border border-slate-200/60 dark:border-slate-800 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between mb-4">
                <div class="p-2 bg-sage/10 rounded-lg">
                    <i class="fas fa-file-alt text-sage"></i>
                </div>
            </div>
            <p class="text-abu-muda text-xs font-bold uppercase tracking-wider">Laporan Masuk</p>
            <h3 class="text-xl sm:text-2xl font-bold mt-1 text-slate-800 dark:text-white">{{ $totalLaporan }}</h3>
        </div>
    </div>

    <!-- Main Content Area -->
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-4 sm:gap-6">
        <!-- Main Content (Full width) -->
        <div class="xl:col-span-3 space-y-4 sm:space-y-6">
            <!-- Recent Activities Table -->
            <div
                class="bg-white dark:bg-slate-900 rounded-xl border border-slate-200/60 dark:border-slate-800 shadow-sm overflow-hidden">
                <div class="p-4 sm:p-5 border-b border-slate-100 dark:border-slate-800 flex items-center justify-between">
                    <h3 class="font-bold text-maroon-soft">Recent Activities</h3>
                    <a href="{{ route('admin.kegiatan.index') }}"
                        class="text-maroon-soft text-xs font-bold hover:underline">View All</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr
                                class="bg-beige-bg/80 dark:bg-slate-800/50 text-[11px] font-bold text-abu-muda uppercase tracking-wider">
                                <th class="px-4 sm:px-6 py-3">Activity Name</th>
                                <th class="px-4 sm:px-6 py-3 hidden md:table-cell">Created By</th>
                                <th class="px-4 sm:px-6 py-3">Location</th>
                                <th class="px-4 sm:px-6 py-3">Status</th>
                                <th class="px-4 sm:px-6 py-3 hidden sm:table-cell">Date</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50 dark:divide-slate-800">
                            @forelse($recentActivities as $activity)
                                <tr class="hover:bg-beige-bg/30 dark:hover:bg-slate-800/50 transition-colors">
                                    <td class="px-4 sm:px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 rounded bg-maroon-soft/5 flex items-center justify-center">
                                                <i class="fas fa-clipboard-check text-sm text-maroon-soft"></i>
                                            </div>
                                            <div>
                                                <span
                                                    class="text-sm font-semibold text-slate-700 block">{{ $activity->judul }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 sm:px-6 py-4 hidden md:table-cell">
                                        <span
                                            class="text-xs text-slate-600 font-medium">{{ $activity->user->name ?? 'Unknown' }}</span>
                                    </td>
                                    <td class="px-4 sm:px-6 py-4">
                                        <span class="text-xs text-slate-600">{{ $activity->lokasi }}</span>
                                    </td>
                                    <td class="px-4 sm:px-6 py-4">
                                        <span
                                            class="flex items-center gap-1.5 text-xs font-medium {{ $activity->status == 'completed' ? 'text-green-600' : 'text-amber-600' }}">
                                            <i class="fas fa-circle text-[8px]"></i>
                                            {{ ucfirst($activity->status) }}
                                        </span>
                                    </td>
                                    <td class="px-4 sm:px-6 py-4 text-xs text-abu-muda font-medium hidden sm:table-cell">
                                        {{ $activity->created_at->format('M d, Y') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-4 sm:px-6 py-4 text-center text-sm text-slate-500">No recent
                                        activities found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>


        </div>

    </div>
    </div>

@endsection