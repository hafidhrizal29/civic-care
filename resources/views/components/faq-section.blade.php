<section id="faq" class="py-20 lg:py-28 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-2xl mb-12">
            <h2 class="text-3xl lg:text-4xl font-semibold text-navy tracking-tight mb-4">
                Pertanyaan Umum
            </h2>
            <p class="text-ink-muted leading-relaxed">
                Jawaban atas pertanyaan yang sering ditanyakan tentang layanan kami.
            </p>
        </div>

        <div class="max-w-3xl space-y-3" x-data="{ openFaq: null }">
            <div class="border border-border-subtle rounded-xl overflow-hidden"
                 :class="openFaq === 0 ? 'shadow-card' : ''">
                <button @click="openFaq = openFaq === 0 ? null : 0"
                        class="w-full flex items-center justify-between p-5 text-left hover:bg-surface-1 transition-colors">
                    <span class="font-medium text-ink pr-4">Bagaimana cara membuat pengaduan?</span>
                    <svg class="w-5 h-5 text-ink-subdued shrink-0 transition-transform duration-200"
                         :class="openFaq === 0 ? 'rotate-180' : ''"
                         fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                    </svg>
                </button>
                <div x-show="openFaq === 0" x-collapse class="px-5 pb-5">
                    <p class="text-sm text-ink-muted leading-relaxed">Anda dapat membuat pengaduan dengan mengklik tombol "Buat Pengaduan" pada halaman utama. Isi formulir yang tersedia dengan data yang benar dan lengkap, lalu lampirkan foto bukti jika diperlukan. Setelah itu, Anda akan mendapatkan nomor tiket untuk melacak status pengaduan.</p>
                </div>
            </div>

            <div class="border border-border-subtle rounded-xl overflow-hidden"
                 :class="openFaq === 1 ? 'shadow-card' : ''">
                <button @click="openFaq = openFaq === 1 ? null : 1"
                        class="w-full flex items-center justify-between p-5 text-left hover:bg-surface-1 transition-colors">
                    <span class="font-medium text-ink pr-4">Berapa lama pengaduan akan diproses?</span>
                    <svg class="w-5 h-5 text-ink-subdued shrink-0 transition-transform duration-200"
                         :class="openFaq === 1 ? 'rotate-180' : ''"
                         fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                    </svg>
                </button>
                <div x-show="openFaq === 1" x-collapse class="px-5 pb-5">
                    <p class="text-sm text-ink-muted leading-relaxed">Waktu penanganan bervariasi tergantung jenis dan kompleksitas pengaduan. Umumnya, verifikasi dilakukan dalam 1-3 hari kerja. Untuk pengaduan mendesak, prioritas penanganan akan diberikan.</p>
                </div>
            </div>

            <div class="border border-border-subtle rounded-xl overflow-hidden"
                 :class="openFaq === 2 ? 'shadow-card' : ''">
                <button @click="openFaq = openFaq === 2 ? null : 2"
                        class="w-full flex items-center justify-between p-5 text-left hover:bg-surface-1 transition-colors">
                    <span class="font-medium text-ink pr-4">Bagaimana cara melacak status pengaduan?</span>
                    <svg class="w-5 h-5 text-ink-subdued shrink-0 transition-transform duration-200"
                         :class="openFaq === 2 ? 'rotate-180' : ''"
                         fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                    </svg>
                </button>
                <div x-show="openFaq === 2" x-collapse class="px-5 pb-5">
                    <p class="text-sm text-ink-muted leading-relaxed">Gunakan nomor tiket yang Anda terima saat membuat pengaduan. Masukkan nomor tiket pada halaman "Lacak Pengaduan" untuk melihat status terkini dan riwayat penanganan pengaduan Anda.</p>
                </div>
            </div>

            <div class="border border-border-subtle rounded-xl overflow-hidden"
                 :class="openFaq === 3 ? 'shadow-card' : ''">
                <button @click="openFaq = openFaq === 3 ? null : 3"
                        class="w-full flex items-center justify-between p-5 text-left hover:bg-surface-1 transition-colors">
                    <span class="font-medium text-ink pr-4">Apakah saya perlu membuat akun untuk mengadu?</span>
                    <svg class="w-5 h-5 text-ink-subdued shrink-0 transition-transform duration-200"
                         :class="openFaq === 3 ? 'rotate-180' : ''"
                         fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                    </svg>
                </button>
                <div x-show="openFaq === 3" x-collapse class="px-5 pb-5">
                    <p class="text-sm text-ink-muted leading-relaxed">Tidak, Anda dapat membuat pengaduan tanpa harus mendaftar akun. Cukup isi data diri Anda pada formulir pengaduan. Namun, dengan membuat akun, Anda dapat melacak semua pengaduan Anda dalam satu tempat.</p>
                </div>
            </div>

            <div class="border border-border-subtle rounded-xl overflow-hidden"
                 :class="openFaq === 4 ? 'shadow-card' : ''">
                <button @click="openFaq = openFaq === 4 ? null : 4"
                        class="w-full flex items-center justify-between p-5 text-left hover:bg-surface-1 transition-colors">
                    <span class="font-medium text-ink pr-4">Bagaimana jika pengaduan saya ditolak?</span>
                    <svg class="w-5 h-5 text-ink-subdued shrink-0 transition-transform duration-200"
                         :class="openFaq === 4 ? 'rotate-180' : ''"
                         fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                    </svg>
                </button>
                <div x-show="openFaq === 4" x-collapse class="px-5 pb-5">
                    <p class="text-sm text-ink-muted leading-relaxed">Jika pengaduan Anda ditolak, Anda akan menerima penjelasan mengenai alasan penolakan. Anda dapat membuat pengaduan baru dengan data yang lebih lengkap atau menghubungi tim kami untuk konsultasi lebih lanjut.</p>
                </div>
            </div>

            <div class="border border-border-subtle rounded-xl overflow-hidden"
                 :class="openFaq === 5 ? 'shadow-card' : ''">
                <button @click="openFaq = openFaq === 5 ? null : 5"
                        class="w-full flex items-center justify-between p-5 text-left hover:bg-surface-1 transition-colors">
                    <span class="font-medium text-ink pr-4">Apakah data saya aman di platform ini?</span>
                    <svg class="w-5 h-5 text-ink-subdued shrink-0 transition-transform duration-200"
                         :class="openFaq === 5 ? 'rotate-180' : ''"
                         fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                    </svg>
                </button>
                <div x-show="openFaq === 5" x-collapse class="px-5 pb-5">
                    <p class="text-sm text-ink-muted leading-relaxed">Ya, kami menjamin kerahasiaan data Anda. Seluruh data pribadi dilindungi sesuai dengan peraturan perundang-undangan yang berlaku di Indonesia.</p>
                </div>
            </div>
        </div>
    </div>
</section>
