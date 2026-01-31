@extends('layouts.app')

@section('title', 'Detail Pengguna')

@section('content')
    <div class="mb-8">
        <a href="{{ route('admin.pengguna.index') }}"
            class="inline-flex items-center text-sm font-medium text-slate-500 hover:text-[#7B3F61] transition-colors mb-4">
            <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar Pengguna
        </a>
        <h1 class="text-2xl font-bold text-slate-800">Detail Pengguna</h1>
        <p class="text-slate-500 text-sm mt-1">Informasi lengkap akun user.</p>
    </div>

    <div class="max-w-4xl">
        <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm overflow-hidden border-2 border-[#7B3F61]">
            <div class="p-6 sm:p-8">
                <div class="flex flex-col md:flex-row gap-8 items-start">
                    <div class="w-full md:w-1/3 text-center">
                        @if ($user->photo)
                            <img src="{{ asset('storage/' . $user->photo) }}"
                                class="h-48 w-48 rounded-2xl object-cover mx-auto border-4 border-maroon-soft/10 shadow-lg mb-4">
                        @else
                            <div
                                class="h-48 w-48 rounded-2xl flex items-center justify-center text-[#7B3F61] border-4 border-[#7B3F61] text-8xl font-bold mx-auto shadow-lg mb-4">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                        @endif
                        <div
                            class="inline-flex items-center px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider
                            @if ($user->role == 'admin') bg-purple-100 text-purple-700
                            @elseif($user->role == 'staff') bg-blue-100 text-blue-700
                            @else bg-amber-100 text-amber-700 @endif mb-2">
                            {{ $user->role }}
                        </div>
                        <div>
                            @if ($user->is_active)
                                <span class="inline-flex items-center gap-1.5 text-sm font-medium text-emerald-600">
                                    <span class="h-2 w-2 rounded-full bg-emerald-600"></span>
                                    Status: Aktif
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 text-sm font-medium text-slate-400">
                                    <span class="h-2 w-2 rounded-full bg-slate-300"></span>
                                    Status: Nonaktif
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="w-full md:w-2/3">
                        <div class="space-y-6">
                            <div>
                                <label class="text-xs font-bold text-slate-400 uppercase tracking-widest block mb-1">Nama
                                    Lengkap</label>
                                <p class="text-lg font-bold text-slate-800">{{ $user->name }}</p>
                            </div>
                            <div class="grid grid-cols-2 gap-6">
                                <div>
                                    <label
                                        class="text-xs font-bold text-slate-400 uppercase tracking-widest block mb-1">Email</label>
                                    <p class="text-slate-700">{{ $user->email }}</p>
                                </div>
                                <div>
                                    <label
                                        class="text-xs font-bold text-slate-400 uppercase tracking-widest block mb-1">Nomor
                                        Telepon</label>
                                    <p class="text-slate-700">{{ $user->phone ?? '-' }}</p>
                                </div>
                            </div>
                            <div>
                                <label class="text-xs font-bold text-slate-400 uppercase tracking-widest block mb-1">Bio /
                                    Keterangan</label>
                                <p class="text-slate-600 italic">{{ $user->bio ?? 'Tidak ada bio.' }}</p>
                            </div>
                            <div class="pt-6 border-t border-slate-100">
                                <label
                                    class="text-xs font-bold text-slate-400 uppercase tracking-widest block mb-1">Terdaftar
                                    Sejak</label>
                                <p class="text-slate-500">{{ $user->created_at->format('d F Y H:i') }}</p>
                            </div>
                        </div>

                        <div class="mt-8 flex gap-3">
                            <a href="{{ route('admin.pengguna.edit', $user->id) }}"
                                class="flex-1 inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-[#7B3F61] hover:bg-[#6A3653] text-white rounded-xl font-semibold transition-all shadow-sm shadow-maroon-soft/20">
                                <i class="fas fa-edit"></i>
                                Edit Pengguna
                            </a>
                            @if ($user->id !== auth()->id())
                                <form action="{{ route('admin.pengguna.destroy', $user->id) }}" method="POST"
                                    class="inline-block" onsubmit="return confirm('Yakin ingin menghapus pengguna ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="px-5 py-2.5 border border-rose-200 text-rose-600 hover:bg-rose-50 rounded-xl font-semibold transition-all">
                                        <i class="fas fa-trash-alt mr-2"></i>
                                        Hapus
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
