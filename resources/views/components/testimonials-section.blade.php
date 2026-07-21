<section class="py-20 lg:py-28 bg-surface-1">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-2xl mb-12">
            <h2 class="text-3xl lg:text-4xl font-semibold text-navy tracking-tight mb-4">
                Kata Mereka
            </h2>
            <p class="text-ink-muted leading-relaxed">
                Pengalaman warga yang telah menggunakan layanan pengaduan kami.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="p-6 bg-white rounded-xl border border-border-subtle">
                <div class="flex items-center gap-1 mb-4">
                    @for ($i = 0; $i < 5; $i++)
                        <svg class="w-4 h-4 text-gold" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                    @endfor
                </div>
                <p class="text-sm text-ink leading-relaxed mb-4">
                    "Pengaduan saya tentang jalan rusak ditanggapi dalam 3 hari. Sangat terkejut dengan respons yang cepat dan profesional."
                </p>
                <div>
                    <p class="font-medium text-ink text-sm">Rina Widyastuti</p>
                    <p class="text-xs text-ink-subdued">Warga Surabaya</p>
                </div>
            </div>

            <div class="p-6 bg-white rounded-xl border border-border-subtle">
                <div class="flex items-center gap-1 mb-4">
                    @for ($i = 0; $i < 5; $i++)
                        <svg class="w-4 h-4 text-gold" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                    @endfor
                </div>
                <p class="text-sm text-ink leading-relaxed mb-4">
                    "Sangat membantu. Laporkan sampah menumpuk di RT saya, dan dalam seminggu sudah ditindaklanjuti oleh dinas terkait."
                </p>
                <div>
                    <p class="font-medium text-ink text-sm">Budi Santoso</p>
                    <p class="text-xs text-ink-subdued">Warga Semarang</p>
                </div>
            </div>

            <div class="p-6 bg-white rounded-xl border border-border-subtle">
                <div class="flex items-center gap-1 mb-4">
                    @for ($i = 0; $i < 5; $i++)
                        <svg class="w-4 h-4 text-gold" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                    @endfor
                </div>
                <p class="text-sm text-ink leading-relaxed mb-4">
                    "Platform yang sangat mudah digunakan. Tidak perlu datang ke kantor, cukup dari HP saja. Terima kasih CivicCare."
                </p>
                <div>
                    <p class="font-medium text-ink text-sm">Siti Nurhaliza</p>
                    <p class="text-xs text-ink-subdued">Warga Bandung</p>
                </div>
            </div>
        </div>
    </div>
</section>
