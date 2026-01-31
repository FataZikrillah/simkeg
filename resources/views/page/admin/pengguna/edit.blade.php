@extends('layouts.app')

@section('title', 'Edit Pengguna')

@section('content')
    <div class="mb-8">
        <a href="{{ route('admin.pengguna.index') }}"
            class="inline-flex items-center text-sm font-medium text-slate-500 hover:text-[#7B3F61] transition-colors mb-4">
            <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar Pengguna
        </a>
        <h1 class="text-2xl font-bold text-slate-800">Edit Pengguna</h1>
        <p class="text-slate-500 text-sm mt-1">Perbarui informasi akun <b>{{ $user->name }}</b>.</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Profile Overview -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm p-6 text-center border-2 border-[#7B3F61]">
                <div class="relative inline-block mb-4">
                    @if ($user->photo)
                        <img src="{{ asset('storage/' . $user->photo) }}"
                            class="h-32 w-32 rounded-full object-cover mx-auto border-4 border-maroon-soft/10 shadow-lg">
                    @else
                        <div
                            class="h-32 w-32 rounded-full flex items-center justify-center text-[#7B3F61] border-4 border-[#7B3F61] text-6xl font-bold mx-auto shadow-lg">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                    @endif
                </div>
                <h3 class="text-xl font-bold text-slate-800">{{ $user->name }}</h3>
                <p class="text-sm text-slate-500 mb-4">{{ $user->email }}</p>
                <div
                    class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider
                    @if ($user->role == 'admin') bg-purple-100 text-purple-700
                    @elseif($user->role == 'staff') bg-blue-100 text-blue-700
                    @else bg-amber-100 text-amber-700 @endif">
                    {{ $user->role }}
                </div>
            </div>
        </div>

        <!-- Edit Form -->
        <div class="lg:col-span-2">
            <div
                class="bg-white rounded-2xl border border-slate-200/60 shadow-sm overflow-hidden border-2 border-[#7B3F61]">
                <form action="{{ route('admin.pengguna.update', $user->id) }}" method="POST" class="p-6 sm:p-8">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Name -->
                        <div class="md:col-span-2">
                            <label for="name" class="block text-sm font-bold text-slate-700 mb-2">Nama Lengkap</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"
                                class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-maroon-soft/20 focus:border-[#7B3F61] transition-all outline-none"
                                required>
                            @error('name')
                                <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-bold text-slate-700 mb-2">Alamat Email</label>
                            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                                class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-maroon-soft/20 focus:border-[#7B3F61] transition-all outline-none"
                                required>
                            @error('email')
                                <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Phone -->
                        <div>
                            <label for="phone" class="block text-sm font-bold text-slate-700 mb-2">Nomor Telepon</label>
                            <input type="text" name="phone" id="phone" value="{{ old('phone', $user->phone) }}"
                                class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-maroon-soft/20 focus:border-[#7B3F61] transition-all outline-none">
                            @error('phone')
                                <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Role -->
                        <div>
                            <label for="role" class="block text-sm font-bold text-slate-700 mb-2">Role / Peran</label>
                            <select name="role" id="role"
                                class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-maroon-soft/20 focus:border-[#7B3F61] transition-all outline-none appearance-none"
                                required>
                                <option value="staff" {{ old('role', $user->role) == 'staff' ? 'selected' : '' }}>Staff
                                </option>
                                <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>
                                    Administrator</option>
                                <option value="pimpinan" {{ old('role', $user->role) == 'pimpinan' ? 'selected' : '' }}>
                                    Pimpinan</option>
                            </select>
                            @error('role')
                                <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Active Status -->
                        <div class="flex items-center">
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="is_active" value="1" class="sr-only peer"
                                    {{ old('is_active', $user->is_active) ? 'checked' : '' }}>
                                <div
                                    class="w-11 h-6 bg-slate-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-maroon-soft/20 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#7B3F61]">
                                </div>
                                <span class="ml-3 text-sm font-bold text-slate-700">Status Aktif</span>
                            </label>
                        </div>

                        <div class="md:col-span-2 pt-4">
                            <div class="p-4 bg-amber-50 rounded-xl border border-amber-100 mb-4">
                                <div class="flex gap-3">
                                    <i class="fas fa-info-circle text-amber-500 mt-1"></i>
                                    <div>
                                        <p class="text-sm font-bold text-amber-800">Ubah Password</p>
                                        <p class="text-xs text-amber-700 mt-0.5">Biarkan kosong jika tidak ingin mengubah
                                            password.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-sm font-bold text-slate-700 mb-2">Password Baru</label>
                            <input type="password" name="password" id="password"
                                class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-maroon-soft/20 focus:border-[#7B3F61] transition-all outline-none">
                            @error('password')
                                <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password Confirmation -->
                        <div>
                            <label for="password_confirmation"
                                class="block text-sm font-bold text-slate-700 mb-2">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-maroon-soft/20 focus:border-[#7B3F61] transition-all outline-none">
                        </div>
                    </div>

                    <div class="mt-8 pt-6 border-t border-slate-100 flex justify-end gap-3">
                        <a href="{{ route('admin.pengguna.index') }}"
                            class="px-6 py-2.5 rounded-xl border border-slate-200 text-slate-600 font-semibold hover:bg-slate-50 transition-all">
                            Batal
                        </a>
                        <button type="submit"
                            class="px-6 py-2.5 rounded-xl bg-[#7B3F61] hover:bg-[#6A3653] text-white font-semibold transition-all shadow-sm shadow-maroon-soft/20">
                            Perbarui Pengguna
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
