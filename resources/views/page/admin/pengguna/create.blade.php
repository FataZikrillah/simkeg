@extends('layouts.app')

@section('title', 'Tambah Pengguna')

@section('content')
    <div class="mb-8">
        <a href="{{ route('admin.pengguna.index') }}"
            class="inline-flex items-center text-sm font-medium text-slate-500 hover:text-[#7B3F61] transition-colors mb-4">
            <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar Pengguna
        </a>
        <h1 class="text-2xl font-bold text-slate-800">Tambah Pengguna Baru</h1>
        <p class="text-slate-500 text-sm mt-1">Buat akun baru untuk staff atau pimpinan.</p>
    </div>

    <div class="max-w-4xl">
        <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm overflow-hidden border-2 border-[#7B3F61]">
            <form action="{{ route('admin.pengguna.store') }}" method="POST" class="p-6 sm:p-8">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Name -->
                    <div class="md:col-span-2">
                        <label for="name" class="block text-sm font-bold text-slate-700 mb-2">Nama Lengkap</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}"
                            class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-maroon-soft/20 focus:border-[#7B3F61] transition-all outline-none"
                            placeholder="Contoh: Ahmad Sulaiman" required>
                        @error('name')
                            <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-bold text-slate-700 mb-2">Alamat Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}"
                            class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-maroon-soft/20 focus:border-[#7B3F61] transition-all outline-none"
                            placeholder="email@example.com" required>
                        @error('email')
                            <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Phone -->
                    <div>
                        <label for="phone" class="block text-sm font-bold text-slate-700 mb-2">Nomor Telepon</label>
                        <input type="text" name="phone" id="phone" value="{{ old('phone') }}"
                            class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-maroon-soft/20 focus:border-[#7B3F61] transition-all outline-none"
                            placeholder="08123456789">
                        @error('phone')
                            <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-bold text-slate-700 mb-2">Password</label>
                        <input type="password" name="password" id="password"
                            class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-maroon-soft/20 focus:border-[#7B3F61] transition-all outline-none"
                            required>
                        @error('password')
                            <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password Confirmation -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-bold text-slate-700 mb-2">Konfirmasi
                            Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                            class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-maroon-soft/20 focus:border-[#7B3F61] transition-all outline-none"
                            required>
                    </div>

                    <!-- Role -->
                    <div>
                        <label for="role" class="block text-sm font-bold text-slate-700 mb-2">Role / Peran</label>
                        <select name="role" id="role"
                            class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-maroon-soft/20 focus:border-[#7B3F61] transition-all outline-none appearance-none bg-no-repeat bg-[right_1rem_center] bg-[length:1em_1em]"
                            required>
                            <option value="staff" {{ old('role') == 'staff' ? 'selected' : '' }}>Staff</option>
                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Administrator</option>
                            <option value="pimpinan" {{ old('role') == 'pimpinan' ? 'selected' : '' }}>Pimpinan</option>
                        </select>
                        @error('role')
                            <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Active Status -->
                    <div class="flex items-center mt-8">
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="is_active" value="1" class="sr-only peer" checked>
                            <div
                                class="w-11 h-6 bg-slate-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-maroon-soft/20 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#7B3F61]">
                            </div>
                            <span class="ml-3 text-sm font-bold text-slate-700">Status Aktif</span>
                        </label>
                    </div>
                </div>

                <div class="mt-8 pt-6 border-t border-slate-100 flex justify-end gap-3">
                    <a href="{{ route('admin.pengguna.index') }}"
                        class="px-6 py-2.5 rounded-xl border border-slate-200 text-slate-600 font-semibold hover:bg-slate-50 transition-all">
                        Batal
                    </a>
                    <button type="submit"
                        class="px-6 py-2.5 rounded-xl bg-[#7B3F61] hover:bg-[#6A3653] text-white font-semibold transition-all shadow-sm shadow-maroon-soft/20">
                        Simpan Pengguna
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
