@php
    $navLinks = [
        ['label' => 'Beranda', 'href' => '#beranda'],
        ['label' => 'Layanan', 'href' => '#layanan'],
        ['label' => 'Kategori', 'href' => '#kategori'],
        ['label' => 'Cara Kerja', 'href' => '#cara-kerja'],
        ['label' => 'FAQ', 'href' => '#faq'],
        ['label' => 'Kontak', 'href' => '#kontak'],
    ];
@endphp

<nav x-data="{ open: false, scrolled: false }"
     x-init="window.addEventListener('scroll', () => { scrolled = window.scrollY > 20 })"
     :class="scrolled ? 'bg-white/95 backdrop-blur-sm shadow-card' : 'bg-transparent'"
     class="fixed top-0 left-0 right-0 z-50 transition-all duration-240">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16 lg:h-[72px]">
            <a href="{{ route('home') }}" class="flex items-center gap-2.5">
                <div class="w-8 h-8 bg-primary rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0zm-9 3.75h.008v.008H12v-.008z" />
                    </svg>
                </div>
                <span class="text-lg font-semibold text-navy tracking-tight">CivicCare</span>
            </a>

            <div class="hidden lg:flex items-center gap-1">
                @foreach ($navLinks as $link)
                    <a href="{{ $link['href'] }}"
                       class="px-3 py-2 text-sm font-medium text-ink-muted hover:text-primary transition-colors duration-120 rounded-lg hover:bg-surface-1">
                        {{ $link['label'] }}
                    </a>
                @endforeach
            </div>

            <div class="hidden lg:flex items-center gap-3">
                @auth
                    <a href="{{ url('/dashboard') }}"
                       class="px-4 py-2 text-sm font-medium text-primary hover:text-primary-hover transition-colors duration-120">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}"
                       class="px-4 py-2 text-sm font-medium text-ink-muted hover:text-primary transition-colors duration-120">
                        Masuk
                    </a>
                    <a href="{{ route('register') }}"
                       class="px-4 py-2 text-sm font-medium text-white bg-primary hover:bg-primary-hover active:bg-primary-pressed rounded-lg transition-all duration-120 shadow-sm">
                        Daftar
                    </a>
                @endauth
            </div>

            <button @click="open = !open" class="lg:hidden p-2 rounded-lg text-ink-muted hover:bg-surface-1 transition-colors">
                <svg x-show="!open" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
                <svg x-show="open" x-cloak class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>

    <div x-show="open" x-cloak x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-1"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-1"
         class="lg:hidden bg-white border-t border-border-subtle shadow-elevated">
        <div class="px-4 py-3 space-y-1">
            @foreach ($navLinks as $link)
                <a href="{{ $link['href'] }}" @click="open = false"
                   class="block px-3 py-2.5 text-sm font-medium text-ink-muted hover:text-primary hover:bg-surface-1 rounded-lg transition-colors">
                    {{ $link['label'] }}
                </a>
            @endforeach
            <div class="border-t border-border-subtle mt-2 pt-2 space-y-1">
                @auth
                    <a href="{{ url('/dashboard') }}"
                       class="block px-3 py-2.5 text-sm font-medium text-primary hover:bg-surface-1 rounded-lg transition-colors">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}"
                       class="block px-3 py-2.5 text-sm font-medium text-ink-muted hover:text-primary hover:bg-surface-1 rounded-lg transition-colors">
                        Masuk
                    </a>
                    <a href="{{ route('register') }}"
                       class="block px-3 py-2.5 text-sm font-medium text-white bg-primary hover:bg-primary-hover rounded-lg transition-colors text-center">
                        Daftar
                    </a>
                @endauth
            </div>
        </div>
    </div>
</nav>
