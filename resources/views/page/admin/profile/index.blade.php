@extends('layouts.app')

@section('title', 'My Profile')

@section('content')
    <div class="max-w-6xl mx-auto space-y-6">
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h2 class="text-xl sm:text-2xl font-bold tracking-tight text-maroon-soft">Profile Settings</h2>
                <p class="text-slate-500 text-sm font-medium">Manage your personal information and account security</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
            <!-- Left Column: Sidebar Info -->
            <div class="lg:col-span-4 space-y-6">
                <!-- Profile Summary Card -->
                <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm p-6 text-center">
                    <div class="relative inline-block mb-4">
                        @if (auth()->user()->photo)
                            <img src="{{ asset('storage/' . auth()->user()->photo) }}" alt="{{ auth()->user()->name }}"
                                class="h-32 w-32 rounded-full object-cover mx-auto border-4 border-maroon-soft/10 shadow-lg"
                                id="profile-preview">
                        @else
                            <div class="h-32 w-32 rounded-full flex items-center justify-center text-maroon-soft border-4 border-maroon-soft/20 text-6xl font-bold mx-auto shadow-lg bg-beige-bg/10"
                                id="profile-initials">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                        @endif

                        <!-- Mini upload trigger on photo -->
                        <label for="photo-upload"
                            class="absolute bottom-0 right-0 w-10 h-10 bg-maroon-soft text-white rounded-full border-4 border-white flex items-center justify-center cursor-pointer hover:scale-110 transition-transform shadow-md">
                            <i class="fas fa-camera text-xs"></i>
                        </label>
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

                        @if (auth()->user()->phone)
                            <div class="flex items-center gap-3 p-3 bg-slate-50 rounded-xl">
                                <div
                                    class="w-8 h-8 rounded-lg bg-white flex items-center justify-center text-maroon-soft shadow-sm">
                                    <i class="fas fa-phone text-xs"></i>
                                </div>
                                <div class="min-w-0 flex-1">
                                    <p class="text-[9px] font-bold text-abu-muda uppercase tracking-wider">Phone</p>
                                    <p class="text-xs font-bold text-slate-700 font-mono">{{ auth()->user()->phone }}</p>
                                </div>
                            </div>
                        @endif

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
                    </div>
                </div>

                <!-- Account Status Card -->
                <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm p-6">
                    <h4 class="text-xs font-bold text-abu-muda uppercase tracking-wider mb-4 flex items-center gap-2">
                        <i class="fas fa-info-circle text-maroon-soft"></i> Account Info
                    </h4>
                    <div class="space-y-4">
                        <div class="flex justify-between items-center text-xs">
                            <span class="text-slate-500 font-medium">Status</span>
                            <span class="px-2 py-1 bg-green-100 text-green-700 rounded-lg font-bold">Active</span>
                        </div>
                        <div class="flex justify-between items-center text-xs">
                            <span class="text-slate-500 font-medium">Last Updated</span>
                            <span class="text-slate-700 font-bold">{{ auth()->user()->updated_at->diffForHumans() }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Forms -->
            <div class="lg:col-span-8 space-y-6">
                <!-- Profile Information Form -->
                <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm overflow-hidden text-slate-700">
                    <div class="p-6 border-b border-slate-100 bg-slate-50/50">
                        <h3 class="text-sm font-bold text-slate-800 flex items-center gap-2">
                            <i class="fas fa-user-edit text-maroon-soft"></i> Personal Information
                        </h3>
                    </div>

                    <div class="p-6">
                        <form method="POST" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data"
                            id="profile-form">
                            @csrf
                            @method('PUT')

                            <!-- Hidden File Input Moved Here -->
                            <input type="file" name="photo" id="photo-upload" class="hidden" accept="image/*">

                            <div class="space-y-6">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <!-- Full Name -->
                                    <div class="space-y-2">
                                        <label
                                            class="text-[10px] font-bold text-abu-muda uppercase tracking-wider flex items-center gap-2">
                                            Full Name
                                        </label>
                                        <input type="text" name="name"
                                            value="{{ old('name', auth()->user()->name) }}"
                                            class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl text-sm font-bold text-slate-700 focus:outline-none focus:ring-2 focus:ring-maroon-soft/20 focus:border-maroon-soft transition-all @error('name') border-red-500 @enderror">
                                        @error('name')
                                            <p class="mt-1 text-xs text-red-500 font-medium">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Email Address -->
                                    <div class="space-y-2">
                                        <label
                                            class="text-[10px] font-bold text-abu-muda uppercase tracking-wider flex items-center gap-2">
                                            Email Address
                                        </label>
                                        <input type="email" name="email"
                                            value="{{ old('email', auth()->user()->email) }}"
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
                                            Phone Number
                                        </label>
                                        <input type="tel" name="phone"
                                            value="{{ old('phone', auth()->user()->phone) }}"
                                            class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl text-sm font-bold text-slate-700 focus:outline-none focus:ring-2 focus:ring-maroon-soft/20 focus:border-maroon-soft transition-all @error('phone') border-red-500 @enderror"
                                            placeholder="Enter phone number">
                                        @error('phone')
                                            <p class="mt-1 text-xs text-red-500 font-medium">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Role (Disabled) -->
                                    <div class="space-y-2">
                                        <label
                                            class="text-[10px] font-bold text-abu-muda uppercase tracking-wider flex items-center gap-2">
                                            Account Role
                                        </label>
                                        <div class="relative">
                                            <input type="text" value="{{ ucfirst(auth()->user()->role) }}" disabled
                                                class="w-full pl-4 pr-10 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-bold text-slate-500 cursor-not-allowed">
                                            <div class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400">
                                                <i class="fas fa-lock text-[10px]"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Bio -->
                                <div class="space-y-2">
                                    <label
                                        class="text-[10px] font-bold text-abu-muda uppercase tracking-wider flex items-center gap-2">
                                        Bio / About
                                    </label>
                                    <textarea name="bio" rows="4"
                                        class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl text-sm font-medium text-slate-700 focus:outline-none focus:ring-2 focus:ring-maroon-soft/20 focus:border-maroon-soft transition-all @error('bio') border-red-500 @enderror"
                                        placeholder="Tell us about yourself...">{{ old('bio', auth()->user()->bio) }}</textarea>
                                    @error('bio')
                                        <p class="mt-1 text-xs text-red-500 font-medium">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="mt-8 flex justify-end">
                                <button type="submit"
                                    class="px-10 py-3 bg-maroon-soft text-white rounded-xl text-sm font-bold hover:brightness-110 shadow-lg shadow-maroon-soft/20 transition-all flex items-center gap-2">
                                    <i class="fas fa-save text-xs"></i> Save Profile Details
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Security & Password Card -->
                <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm overflow-hidden text-slate-700">
                    <div class="p-6 border-b border-slate-100 bg-slate-50/50">
                        <h3 class="text-sm font-bold text-slate-800 flex items-center gap-2">
                            <i class="fas fa-shield-alt text-maroon-soft"></i> Security Settings
                        </h3>
                    </div>

                    <div class="p-6">
                        <form method="POST" action="{{ route('admin.profile.update.password') }}" id="password-form">
                            @csrf
                            @method('PUT')

                            <div class="space-y-6">
                                <div class="space-y-2">
                                    <label
                                        class="text-[10px] font-bold text-abu-muda uppercase tracking-wider flex items-center gap-2">
                                        Current Password
                                    </label>
                                    <input type="password" name="current_password"
                                        class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-maroon-soft/20 focus:border-maroon-soft transition-all @error('current_password') border-red-500 @enderror"
                                        placeholder="••••••••">
                                    @error('current_password')
                                        <p class="mt-1 text-xs text-red-500 font-medium">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="space-y-2">
                                        <label
                                            class="text-[10px] font-bold text-abu-muda uppercase tracking-wider flex items-center gap-2">
                                            New Password
                                        </label>
                                        <input type="password" name="password"
                                            class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-maroon-soft/20 focus:border-maroon-soft transition-all @error('password') border-red-500 @enderror"
                                            placeholder="••••••••">
                                        @error('password')
                                            <p class="mt-1 text-xs text-red-500 font-medium">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="space-y-2">
                                        <label
                                            class="text-[10px] font-bold text-abu-muda uppercase tracking-wider flex items-center gap-2">
                                            Confirm New Password
                                        </label>
                                        <input type="password" name="password_confirmation"
                                            class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-maroon-soft/20 focus:border-maroon-soft transition-all"
                                            placeholder="••••••••">
                                    </div>
                                </div>
                            </div>

                            <div class="mt-8 flex justify-end">
                                <button type="submit"
                                    class="px-10 py-3 bg-maroon-soft/10 text-maroon-soft border border-maroon-soft/20 rounded-xl text-sm font-bold hover:bg-maroon-soft hover:text-white transition-all flex items-center gap-2">
                                    <i class="fas fa-key text-xs"></i> Change Password
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
            const profilePreview = document.getElementById('profile-preview');
            const profileInitials = document.getElementById('profile-initials');

            photoInput.addEventListener('change', function(e) {
                if (this.files && this.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        if (profilePreview) {
                            profilePreview.src = e.target.result;
                        } else if (profileInitials) {
                            // Replace initials with image if first upload
                            const img = document.createElement('img');
                            img.src = e.target.result;
                            img.id = 'profile-preview';
                            img.className =
                                'h-32 w-32 rounded-full object-cover mx-auto border-4 border-maroon-soft/10 shadow-lg';
                            profileInitials.parentNode.replaceChild(img, profileInitials);
                        }
                    }
                    reader.readAsDataURL(this.files[0]);

                    // Show a small notification that file is selected using SweetAlert2
                    Swal.fire({
                        icon: 'info',
                        title: 'Photo Selected',
                        text: "Click 'Save Profile Details' to apply your new photo.",
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                    });
                }
            });
        </script>
    @endpush
@endsection
