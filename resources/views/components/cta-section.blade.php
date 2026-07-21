<section id="kontak" class="py-20 lg:py-28 bg-navy">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl lg:text-4xl font-semibold text-white tracking-tight mb-4">
            Wujudkan Lingkungan yang Lebih Baik
        </h2>
        <p class="text-white/60 max-w-lg mx-auto mb-8 leading-relaxed">
            Setiap pengaduan Anda adalah langkah nyata menuju perubahan. Sampaikan keluhan Anda sekarang.
        </p>
        <div class="flex flex-col sm:flex-row items-center justify-center gap-3">
            <a href="{{ route('complaint.create') }}"
               class="inline-flex items-center gap-2 px-6 py-3 bg-primary hover:bg-primary-hover active:bg-primary-pressed text-white font-medium rounded-lg transition-all duration-120 shadow-sm">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                Laporkan Sekarang
            </a>
            <a href="{{ route('tracking') }}"
               class="inline-flex items-center gap-2 px-6 py-3 bg-white/10 hover:bg-white/15 text-white font-medium rounded-lg transition-all duration-120 border border-white/20">
                Lacak Pengaduan
            </a>
        </div>
    </div>
</section>
