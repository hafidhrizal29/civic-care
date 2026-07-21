@props(['collapsed' => false])

<aside {{ $attributes->merge(['class' => 'flex flex-col bg-navy text-white transition-all duration-200']) }}>
    <div class="flex items-center gap-3 px-5 h-16 border-b border-white/10">
        <a href="{{ route('home') }}" class="shrink-0">
            <x-application-logo class="w-8 h-8" />
        </a>

        @if (! $collapsed)
            <div class="flex-1 min-w-0">
                <div class="text-sm font-semibold tracking-tight">CivicCare</div>
                <div class="text-[11px] text-white/50 truncate">Pengaduan Masyarakat</div>
            </div>
        @endif
    </div>

    <nav class="flex-1 overflow-y-auto py-4 px-3 space-y-1">
        <x-sidebar-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
            <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
            </svg>
            @if (! $collapsed)
                <span>Dashboard</span>
            @endif
        </x-sidebar-link>

        <div class="pt-4 pb-2 px-3">
            @if (! $collapsed)
                <span class="text-[11px] font-semibold uppercase tracking-wider text-white/40">Master Data</span>
            @endif
        </div>

        <x-sidebar-link :href="route('categories.index')" :active="request()->routeIs('categories.*')">
            <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6z" />
            </svg>
            @if (! $collapsed)
                <span>Kategori</span>
            @endif
        </x-sidebar-link>

        <div class="pt-4 pb-2 px-3">
            @if (! $collapsed)
                <span class="text-[11px] font-semibold uppercase tracking-wider text-white/40">Transaksi</span>
            @endif
        </div>

        <x-sidebar-link :href="route('complaints.index')" :active="request()->routeIs('complaints.*')">
            <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
            </svg>
            @if (! $collapsed)
                <span>Pengaduan</span>
            @endif
        </x-sidebar-link>

        <x-sidebar-link :href="route('responses.index')" :active="request()->routeIs('responses.*')">
            <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 01-.825-.242m9.345-8.334a2.126 2.126 0 00-.476-.095 48.64 48.64 0 00-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0011.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155" />
            </svg>
            @if (! $collapsed)
                <span>Tanggapan</span>
            @endif
        </x-sidebar-link>

        <x-sidebar-link :href="route('tracking')" :active="request()->routeIs('tracking')">
            <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
            </svg>
            @if (! $collapsed)
                <span>Tracking</span>
            @endif
        </x-sidebar-link>

        <div class="pt-4 pb-2 px-3">
            @if (! $collapsed)
                <span class="text-[11px] font-semibold uppercase tracking-wider text-white/40">Lainnya</span>
            @endif
        </div>

        <x-sidebar-link :href="route('reports.index')" :active="request()->routeIs('reports.*')">
            <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z" />
            </svg>
            @if (! $collapsed)
                <span>Laporan</span>
            @endif
        </x-sidebar-link>
    </nav>

    <div class="border-t border-white/10 p-3">
        <div class="flex items-center gap-3 px-2 py-2">
            <div class="w-8 h-8 rounded-full bg-primary/20 flex items-center justify-center text-sm font-semibold text-primary shrink-0">
                {{ substr(Auth::user()->name, 0, 1) }}
            </div>

            @if (! $collapsed)
                <div class="flex-1 min-w-0">
                    <div class="text-sm font-medium truncate">{{ Auth::user()->name }}</div>
                    <div class="text-[11px] text-white/50 truncate">{{ Auth::user()->email }}</div>
                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="p-1.5 text-white/50 hover:text-white hover:bg-white/10 rounded-lg transition-colors" title="Logout">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                        </svg>
                    </button>
                </form>
            @endif
        </div>
    </div>
</aside>
