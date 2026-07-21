@props(['categories' => []])

<section id="kategori" class="py-20 lg:py-28 bg-surface-1">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-2xl mb-12">
            <h2 class="text-3xl lg:text-4xl font-semibold text-navy tracking-tight mb-4">
                Kategori Pengaduan
            </h2>
            <p class="text-ink-muted leading-relaxed">
                Pilih kategori yang sesuai dengan keluhan Anda agar dapat ditangani oleh pihak yang tepat.
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            @foreach ($categories as $category)
                <div class="group p-5 bg-white rounded-xl border border-border-subtle hover:border-primary/30 hover:shadow-card transition-all duration-240">
                    <div class="w-10 h-10 bg-primary/10 rounded-lg flex items-center justify-center mb-4 group-hover:bg-primary/15 transition-colors">
                        <svg class="w-5 h-5 text-primary" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
                        </svg>
                    </div>
                    <h3 class="font-semibold text-ink mb-1.5">{{ $category->nama }}</h3>
                    <p class="text-sm text-ink-muted leading-relaxed">{{ Str::limit($category->deskripsi, 80) }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>
