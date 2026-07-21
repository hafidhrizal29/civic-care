<section id="beranda" class="relative min-h-[100dvh] flex items-center bg-navy overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-br from-navy via-navy to-navy-deep"></div>

    <div class="absolute top-0 right-0 w-1/2 h-full opacity-[0.03]">
        <svg class="w-full h-full" viewBox="0 0 800 600" fill="none">
            <circle cx="400" cy="300" r="250" stroke="white" stroke-width="0.5"/>
            <circle cx="400" cy="300" r="200" stroke="white" stroke-width="0.5"/>
            <circle cx="400" cy="300" r="150" stroke="white" stroke-width="0.5"/>
            <circle cx="400" cy="300" r="100" stroke="white" stroke-width="0.5"/>
        </svg>
    </div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 lg:py-0">
        <div class="max-w-2xl">
            <div class="inline-flex items-center gap-2 px-3 py-1.5 bg-white/10 rounded-full mb-6">
                <span class="w-1.5 h-1.5 bg-success rounded-full"></span>
                <span class="text-xs font-medium text-white/80 tracking-wide uppercase">Sistem Resmi Pengaduan Masyarakat</span>
            </div>

            <h1 class="text-4xl sm:text-5xl lg:text-[56px] font-semibold text-white leading-[1.1] tracking-tight mb-6">
                Sampaikan Keluhan,<br>
                <span class="text-primary">Wujudkan Perubahan</span>
            </h1>

            <p class="text-lg text-white/70 leading-relaxed max-w-lg mb-8">
                Platform digital terpercaya untuk menyampaikan pengaduan masyarakat secara transparan dan akuntabel. Setiap laporan Anda kami tindaklanjuti.
            </p>

            <div class="flex flex-col sm:flex-row gap-3">
                <a href="{{ route('complaint.create') }}"
                   class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-primary hover:bg-primary-hover active:bg-primary-pressed text-white font-medium rounded-lg transition-all duration-120 shadow-sm">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    Buat Pengaduan
                </a>
                <a href="{{ route('tracking') }}"
                   class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-white/10 hover:bg-white/15 text-white font-medium rounded-lg transition-all duration-120 border border-white/20">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                    </svg>
                    Lacak Pengaduan
                </a>
            </div>
        </div>
    </div>
</section>
