<header
    class="h-16 flex-shrink-0 flex items-center justify-end px-4 sm:px-6 bg-white dark:bg-slate-900 border-b border-slate-200 dark:border-slate-800 z-10">
    <div class="flex items-center gap-2 sm:gap-3">
        <a href="{{ route(auth()->user()->role . '.profile.index') }}"
            class="flex items-center gap-2 sm:gap-3 cursor-pointer group">
            <div class="text-right hidden sm:block">
                <p class="text-sm font-bold text-slate-800 leading-none">{{ auth()->user()->name }}</p>
                <p class="text-[11px] text-abu-muda mt-1 uppercase font-bold">{{ auth()->user()->role }}</p>
            </div>
            <div
                class="h-10 w-10 rounded-full border-2 border-white shadow-sm overflow-hidden ring-1 ring-maroon-soft/10 bg-maroon-soft flex items-center justify-center text-white text-xs font-bold">
                @if (auth()->user()->photo)
                    <img alt="Profile" class="h-full w-full object-cover"
                        src="{{ asset('storage/' . auth()->user()->photo) }}" />
                @else
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                @endif
            </div>
        </a>
    </div>
</header>
