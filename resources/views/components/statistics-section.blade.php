@props([
    'totalComplaints' => 0,
    'processedComplaints' => 0,
    'completedComplaints' => 0,
    'totalCategories' => 0,
])

<section class="py-20 lg:py-28 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-2xl mb-12">
            <h2 class="text-3xl lg:text-4xl font-semibold text-navy tracking-tight mb-4">
                Statistik Pengaduan
            </h2>
            <p class="text-ink-muted leading-relaxed">
                Data real-time pengaduan yang telah masuk dan ditangani oleh sistem kami.
            </p>
        </div>

        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="p-6 bg-navy rounded-xl">
                <p class="text-3xl lg:text-4xl font-semibold text-white tracking-tight">
                    {{ number_format($totalComplaints) }}
                </p>
                <p class="text-sm text-white/60 mt-1">Total Pengaduan</p>
            </div>

            <div class="p-6 bg-surface-1 rounded-xl border border-border-subtle">
                <p class="text-3xl lg:text-4xl font-semibold text-primary tracking-tight">
                    {{ number_format($processedComplaints) }}
                </p>
                <p class="text-sm text-ink-muted mt-1">Sedang Diproses</p>
            </div>

            <div class="p-6 bg-surface-1 rounded-xl border border-border-subtle">
                <p class="text-3xl lg:text-4xl font-semibold text-success tracking-tight">
                    {{ number_format($completedComplaints) }}
                </p>
                <p class="text-sm text-ink-muted mt-1">Selesai</p>
            </div>

            <div class="p-6 bg-surface-1 rounded-xl border border-border-subtle">
                <p class="text-3xl lg:text-4xl font-semibold text-ink tracking-tight">
                    {{ number_format($totalCategories) }}
                </p>
                <p class="text-sm text-ink-muted mt-1">Kategori</p>
            </div>
        </div>
    </div>
</section>
