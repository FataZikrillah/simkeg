@extends('layouts.app')

@section('title', 'Profil Saya')

@section('content')
    <div class="max-w-4xl mx-auto space-y-6">
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h2 class="text-xl sm:text-2xl font-bold tracking-tight text-maroon-soft">Pengaturan Profil</h2>
                <p class="text-slate-500 text-sm font-medium">Kelola informasi pribadi dan detail akun Anda</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Profile Photo Card -->
            <div class="lg:col-span-1 border-2 border-[#7B3F61] rounded-2xl">
                <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm p-6 text-center sticky top-6">
                    <div class="relative inline-block mb-4">
                        @if (auth()->user()->photo)
                            <img src="{{ asset('storage/' . auth()->user()->photo) }}" alt="{{ auth()->user()->name }}"
                                class="h-32 w-32 rounded-full object-cover mx-auto border-4 border-maroon-soft/10 shadow-lg">
                        @else
                            <div
                                class="h-32 w-32 rounded-full  flex items-center justify-center text-[#7B3F61] border-4 border-[#7B3F61] text-6xl font-bold mx-auto shadow-lg">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                        @endif
                    </div>

                    <h3 class="text-lg font-bold text-slate-800">{{ auth()->user()->name }}</h3>
                    <p class="text-xs font-bold text-maroon-soft uppercase tracking-widest mt-1">{{ auth()->user()->role }}
                    </p>

                    <div class="mt-6 space-y-3 text-left">
                        <div class="flex items-center gap-3 p-3 bg-slate-50 rounded-xl">
                            <div
                                class="w-8 h-8 rounded-lg bg-white flex items-center justify-center text-maroon-soft shadow-sm">
                                <i class="fas fa-envelope text-xs"></i>
                            </div>
                            <div class="min-w-0 flex-1">
                                <p class="text-[9px] font-bold text-abu-muda uppercase tracking-wider">Email</p>
                                <p class="text-xs font-bold text-slate-700 truncate">{{ auth()->user()->email }}</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-3 p-3 bg-maroon-soft/5 rounded-xl border border-maroon-soft/10">
                            <div
                                class="w-8 h-8 rounded-lg bg-white flex items-center justify-center text-maroon-soft shadow-sm">
                                <i class="fas fa-calendar-alt text-xs"></i>
                            </div>
                            <div class="min-w-0 flex-1">
                                <p class="text-[9px] font-bold text-maroon-soft/60 uppercase tracking-wider">Member Since
                                </p>
                                <p class="text-xs font-bold text-maroon-soft">
                                    {{ auth()->user()->created_at->format('M Y') }}</p>
                            </div>
                        </div>

                        <div class="pt-4 border-t border-slate-100 mt-4 space-y-3">
                            <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest px-1">Statistik Saya
                            </p>
                            <div class="grid grid-cols-2 gap-2">
                                <div class="p-3 bg-slate-50 rounded-xl border border-slate-100 text-center">
                                    <p class="text-[8px] font-bold text-slate-400 uppercase">Kegiatan</p>
                                    <p class="text-sm font-black text-slate-700">
                                        {{ \App\Models\Kegiatan::where('user_id', auth()->id())->count() }}</p>
                                </div>
                                <div class="p-3 bg-slate-50 rounded-xl border border-slate-100 text-center">
                                    <p class="text-[8px] font-bold text-slate-400 uppercase">Laporan</p>
                                    <p class="text-sm font-black text-slate-700">
                                        {{ \App\Models\Laporan::whereHas('kegiatan', function ($q) {$q->where('user_id', auth()->id());})->count() }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Personal Information Form -->
            <div class="lg:col-span-2 border-2 border-[#7B3F61] rounded-2xl">
                <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm overflow-hidden">
                    <div class="p-6 sm:p-8">
                        <h3
                            class="text-xs font-bold text-abu-muda uppercase tracking-[0.2em] border-b border-slate-50 pb-3 mb-6">
                            Informasi Pribadi</h3>

                        <form method="POST" action="{{ route('staff.profile.update') }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="space-y-6">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <!-- Full Name -->
                                    <div class="space-y-2">
                                        <label
                                            class="text-[10px] font-bold text-abu-muda uppercase tracking-wider flex items-center gap-2">
                                            <i class="fas fa-user text-maroon-soft"></i>
                                            Nama Lengkap
                                        </label>
                                        <input type="text" name="name" value="{{ auth()->user()->name }}"
                                            class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl text-sm font-bold text-slate-700 focus:outline-none focus:ring-2 focus:ring-maroon-soft/20 focus:border-maroon-soft transition-all @error('name') border-red-500 @enderror">
                                        @error('name')
                                            <p class="mt-1 text-xs text-red-500 font-medium">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Email Address -->
                                    <div class="space-y-2">
                                        <label
                                            class="text-[10px] font-bold text-abu-muda uppercase tracking-wider flex items-center gap-2">
                                            <i class="fas fa-envelope text-maroon-soft"></i>
                                            Alamat Email
                                        </label>
                                        <input type="email" name="email" value="{{ auth()->user()->email }}"
                                            class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl text-sm font-bold text-slate-700 focus:outline-none focus:ring-2 focus:ring-maroon-soft/20 focus:border-maroon-soft transition-all @error('email') border-red-500 @enderror">
                                        @error('email')
                                            <p class="mt-1 text-xs text-red-500 font-medium">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <!-- Phone Number -->
                                    <div class="space-y-2">
                                        <label
                                            class="text-[10px] font-bold text-abu-muda uppercase tracking-wider flex items-center gap-2">
                                            <i class="fas fa-phone text-maroon-soft"></i>
                                            Nomor Telepon
                                        </label>
                                        <input type="tel" name="phone" value="{{ auth()->user()->phone ?? '' }}"
                                            class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-maroon-soft/20 focus:border-maroon-soft transition-all @error('phone') border-red-500 @enderror"
                                            placeholder="Masukkan nomor telepon">
                                        @error('phone')
                                            <p class="mt-1 text-xs text-red-500 font-medium">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Role (Disabled) -->
                                    <div class="space-y-2">
                                        <label
                                            class="text-[10px] font-bold text-abu-muda uppercase tracking-wider flex items-center gap-2">
                                            <i class="fas fa-shield-alt text-maroon-soft"></i>
                                            Peran Akun
                                        </label>
                                        <input type="text" value="{{ ucfirst(auth()->user()->role) }}" disabled
                                            class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-bold text-slate-500 cursor-not-allowed">
                                    </div>
                                </div>

                                <!-- Bio -->
                                <div class="space-y-2">
                                    <label
                                        class="text-[10px] font-bold text-abu-muda uppercase tracking-wider flex items-center gap-2">
                                        <i class="fas fa-align-left text-maroon-soft"></i>
                                        Bio / Tentang Saya
                                    </label>
                                    <textarea name="bio" rows="4"
                                        class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-maroon-soft/20 focus:border-maroon-soft transition-all @error('bio') border-red-500 @enderror"
                                        placeholder="Ceritakan tentang diri Anda...">{{ auth()->user()->bio ?? '' }}</textarea>
                                    @error('bio')
                                        <p class="mt-1 text-xs text-red-500 font-medium">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Profile Photo Upload -->
                                <div class="space-y-2">
                                    <label
                                        class="text-[10px] font-bold text-abu-muda uppercase tracking-wider flex items-center gap-2">
                                        <i class="fas fa-camera text-maroon-soft"></i>
                                        Perbarui Foto Profil
                                    </label>
                                    <div class="flex items-center gap-4">
                                        <input type="file" name="photo" id="photo-upload" class="hidden"
                                            accept="image/*">
                                        <label for="photo-upload"
                                            class="flex-1 px-4 py-3 bg-beige-bg/30 border border-slate-200 rounded-xl text-sm text-slate-500 hover:bg-beige-bg/50 transition-all cursor-pointer flex items-center justify-center gap-2">
                                            <i class="fas fa-upload text-maroon-soft"></i>
                                            <span class="font-semibold">Pilih foto baru</span>
                                        </label>
                                    </div>
                                    <p class="text-[10px] text-slate-400 italic">Disarankan: Gambar persegi, maks 2MB</p>
                                    @error('photo')
                                        <p class="mt-1 text-xs text-red-500 font-medium">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Actions -->
                            <div class="mt-8 pt-6 border-t border-slate-100 flex flex-col sm:flex-row justify-end gap-3">
                                <a href="{{ route('staff.dashboard') }}"
                                    class="px-6 py-3 bg-white border border-slate-200 rounded-xl text-sm font-bold text-slate-600 hover:bg-slate-50 transition-all text-center">
                                    Batal
                                </a>
                                <button type="submit"
                                    class="px-10 py-3 bg-maroon-soft text-white rounded-xl text-sm font-bold hover:brightness-110 shadow-lg shadow-maroon-soft/20 transition-all">
                                    <i class="fas fa-save mr-2"></i> Simpan Perubahan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            const photoInput = document.getElementById('photo-upload');
            const photoLabel = document.querySelector('label[for="photo-upload"]');

            photoInput.addEventListener('change', function(e) {
                if (this.files && this.files.length > 0) {
                    const fileName = this.files[0].name;
                    photoLabel.innerHTML = `
                                <i class="fas fa-check-circle text-green-600"></i>
                                <span class="font-semibold">${fileName}</span>
                            `;
                    photoLabel.classList.add('bg-green-50', 'border-green-200');
                    photoLabel.classList.remove('bg-beige-bg/30', 'border-slate-200');
                } else {
                    photoLabel.innerHTML = `
                                <i class="fas fa-upload text-maroon-soft"></i>
                                <span class="font-semibold">Pilih foto baru</span>
                            `;
                    photoLabel.classList.remove('bg-green-50', 'border-green-200');
                    photoLabel.classList.add('bg-beige-bg/30', 'border-slate-200');
                }
            });
        </script>
    @endpush
@endsection
