@extends('layouts.app')

@section('title', 'Data Pengguna')

@section('content')
    <div class="mb-8 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Manajemen Pengguna</h1>
            <p class="text-slate-500 text-sm mt-1">Kelola data user dan akses sistem SIMKEG.</p>
        </div>
        <div>
            <a href="{{ route('admin.pengguna.create') }}"
                class="inline-flex items-center gap-2 px-5 py-2.5 bg-[#7B3F61] hover:bg-[#6A3653] text-white rounded-xl font-semibold transition-all shadow-sm shadow-maroon-soft/20">
                <i class="fas fa-plus"></i>
                Tambah Pengguna
            </a>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white p-6 rounded-2xl border border-slate-200/60 shadow-sm">
            <div class="flex items-center gap-4">
                <div class="p-3 bg-blue-50 text-blue-600 rounded-xl">
                    <i class="fas fa-users text-xl"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-slate-500">Total Pengguna</p>
                    <p class="text-2xl font-bold text-slate-800">{{ $totalUsers }}</p>
                </div>
            </div>
        </div>
        <div class="bg-white p-6 rounded-2xl border border-slate-200/60 shadow-sm">
            <div class="flex items-center gap-4">
                <div class="p-3 bg-purple-50 text-purple-600 rounded-xl">
                    <i class="fas fa-user-shield text-xl"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-slate-500">Admin</p>
                    <p class="text-2xl font-bold text-slate-800">{{ $adminCount }}</p>
                </div>
            </div>
        </div>
        <div class="bg-white p-6 rounded-2xl border border-slate-200/60 shadow-sm">
            <div class="flex items-center gap-4">
                <div class="p-3 bg-amber-50 text-amber-600 rounded-xl">
                    <i class="fas fa-user-tie text-xl"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-slate-500">Staff</p>
                    <p class="text-2xl font-bold text-slate-800">{{ $staffCount }}</p>
                </div>
            </div>
        </div>
        <div class="bg-white p-6 rounded-2xl border border-slate-200/60 shadow-sm">
            <div class="flex items-center gap-4">
                <div class="p-3 bg-rose-50 text-rose-600 rounded-xl">
                    <i class="fas fa-user-friends text-xl"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-slate-500">Pimpinan</p>
                    <p class="text-2xl font-bold text-slate-800">{{ $pimpinanCount }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Table Section -->
    <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/50 border-b border-slate-200/60">
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Pengguna</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Role</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Kontak</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($users as $user)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    @if ($user->photo)
                                        <img src="{{ asset('storage/' . $user->photo) }}"
                                            class="h-10 w-10 rounded-full object-cover">
                                    @else
                                        <div
                                            class="h-10 w-10 rounded-xl border border-[#7B3F61] flex items-center justify-center text-[#7B3F61] font-bold text-sm">
                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                        </div>
                                    @endif
                                    <div>
                                        <div class="font-semibold text-slate-800">{{ $user->name }}</div>
                                        <div class="text-xs text-slate-400">{{ $user->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span
                                    class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider
                                    @if ($user->role == 'admin') bg-purple-100 text-purple-700
                                    @elseif($user->role == 'staff') bg-blue-100 text-blue-700
                                    @else bg-amber-100 text-amber-700 @endif">
                                    {{ $user->role }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                @if ($user->is_active)
                                    <span class="flex items-center gap-1.5 text-xs font-medium text-emerald-600">
                                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-600"></span>
                                        Aktif
                                    </span>
                                @else
                                    <span class="flex items-center gap-1.5 text-xs font-medium text-slate-400">
                                        <span class="h-1.5 w-1.5 rounded-full bg-slate-300"></span>
                                        Nonaktif
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-sm text-slate-600">{{ $user->phone ?? '-' }}</span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.pengguna.edit', $user->id) }}"
                                        class="p-2 text-slate-400 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-all"
                                        title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    @if ($user->id !== auth()->id())
                                        <form action="{{ route('admin.pengguna.destroy', $user->id) }}" method="POST"
                                            class="inline-block"
                                            onsubmit="return confirm('Yakin ingin menghapus pengguna ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="p-2 text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition-all"
                                                title="Hapus">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-slate-400">
                                <i class="fas fa-users text-4xl mb-3 block opacity-20"></i>
                                Belum ada data pengguna.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($users->hasPages())
            <div class="px-6 py-4 border-t border-slate-100 bg-slate-50/30">
                {{ $users->links() }}
            </div>
        @endif
    </div>
@endsection
