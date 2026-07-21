<x-layouts.app>
    <x-slot name="header">
        <h1 class="text-xl font-semibold text-ink">Dashboard</h1>
    </x-slot>

    <x-breadcrumb :items="[['label' => 'Dashboard']]" />

    {{-- Stats Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-4 mb-8">
        <div class="bg-white rounded-xl p-5 shadow-card border border-border-subtle">
            <div class="flex items-center justify-between mb-3">
                <span class="text-sm text-ink-muted">Total</span>
                <div class="w-9 h-9 rounded-lg bg-navy/10 flex items-center justify-center">
                    <svg class="w-5 h-5 text-navy" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                    </svg>
                </div>
            </div>
            <div class="text-2xl font-bold text-ink">{{ number_format($stats['total']) }}</div>
        </div>

        <div class="bg-white rounded-xl p-5 shadow-card border border-border-subtle">
            <div class="flex items-center justify-between mb-3">
                <span class="text-sm text-ink-muted">Baru</span>
                <div class="w-9 h-9 rounded-lg bg-primary/10 flex items-center justify-center">
                    <svg class="w-5 h-5 text-primary" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
            <div class="text-2xl font-bold text-ink">{{ number_format($stats['baru']) }}</div>
        </div>

        <div class="bg-white rounded-xl p-5 shadow-card border border-border-subtle">
            <div class="flex items-center justify-between mb-3">
                <span class="text-sm text-ink-muted">Diproses</span>
                <div class="w-9 h-9 rounded-lg bg-warning/10 flex items-center justify-center">
                    <svg class="w-5 h-5 text-warning" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
            <div class="text-2xl font-bold text-ink">{{ number_format($stats['diproses']) }}</div>
        </div>

        <div class="bg-white rounded-xl p-5 shadow-card border border-border-subtle">
            <div class="flex items-center justify-between mb-3">
                <span class="text-sm text-ink-muted">Selesai</span>
                <div class="w-9 h-9 rounded-lg bg-success/10 flex items-center justify-center">
                    <svg class="w-5 h-5 text-success" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
            <div class="text-2xl font-bold text-ink">{{ number_format($stats['selesai']) }}</div>
        </div>

        <div class="bg-white rounded-xl p-5 shadow-card border border-border-subtle">
            <div class="flex items-center justify-between mb-3">
                <span class="text-sm text-ink-muted">Ditolak</span>
                <div class="w-9 h-9 rounded-lg bg-error/10 flex items-center justify-center">
                    <svg class="w-5 h-5 text-error" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
            <div class="text-2xl font-bold text-ink">{{ number_format($stats['ditolak']) }}</div>
        </div>

        <div class="bg-white rounded-xl p-5 shadow-card border border-border-subtle">
            <div class="flex items-center justify-between mb-3">
                <span class="text-sm text-ink-muted">Hari Ini</span>
                <div class="w-9 h-9 rounded-lg bg-gold/10 flex items-center justify-center">
                    <svg class="w-5 h-5 text-gold" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                    </svg>
                </div>
            </div>
            <div class="text-2xl font-bold text-ink">{{ number_format($stats['today']) }}</div>
        </div>
    </div>

    {{-- Charts Row --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        {{-- Monthly Chart --}}
        <div class="bg-white rounded-xl p-6 shadow-card border border-border-subtle">
            <h3 class="text-base font-semibold text-ink mb-4">Pengaduan per Bulan</h3>
            <div class="space-y-3" x-data="monthlyChart({{ json_encode($monthlyData) }})">
                @foreach ($monthlyData as $data)
                    @php
                        $max = max(array_column($monthlyData, 'count'));
                        $width = $max > 0 ? ($data['count'] / $max) * 100 : 0;
                    @endphp
                    <div class="flex items-center gap-3">
                        <span class="text-xs text-ink-subdued w-20 shrink-0">{{ $data['month'] }}</span>
                        <div class="flex-1 h-6 bg-surface-1 rounded-md overflow-hidden">
                            <div class="h-full bg-primary rounded-md transition-all duration-500"
                                 style="width: {{ $width }}%"></div>
                        </div>
                        <span class="text-sm font-medium text-ink w-8 text-right">{{ $data['count'] }}</span>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Status Distribution --}}
        <div class="bg-white rounded-xl p-6 shadow-card border border-border-subtle">
            <h3 class="text-base font-semibold text-ink mb-4">Status Pengaduan</h3>
            <div class="space-y-4">
                @php
                    $statusLabels = [
                        'baru' => ['label' => 'Baru', 'color' => 'bg-primary'],
                        'diproses' => ['label' => 'Diproses', 'color' => 'bg-warning'],
                        'selesai' => ['label' => 'Selesai', 'color' => 'bg-success'],
                        'ditolak' => ['label' => 'Ditolak', 'color' => 'bg-error'],
                    ];
                    $totalForPercent = array_sum($statusData);
                @endphp

                @foreach ($statusLabels as $key => $info)
                    @php
                        $count = $statusData[$key] ?? 0;
                        $percent = $totalForPercent > 0 ? round(($count / $totalForPercent) * 100) : 0;
                    @endphp
                    <div>
                        <div class="flex items-center justify-between mb-1.5">
                            <span class="text-sm text-ink-muted">{{ $info['label'] }}</span>
                            <span class="text-sm font-medium text-ink">{{ $count }} ({{ $percent }}%)</span>
                        </div>
                        <div class="h-2 bg-surface-1 rounded-full overflow-hidden">
                            <div class="h-full {{ $info['color'] }} rounded-full transition-all duration-500"
                                 style="width: {{ $percent }}%"></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Bottom Row --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Recent Complaints --}}
        <div class="lg:col-span-2 bg-white rounded-xl shadow-card border border-border-subtle">
            <div class="flex items-center justify-between px-6 py-4 border-b border-border-subtle">
                <h3 class="text-base font-semibold text-ink">Pengaduan Terbaru</h3>
                <a href="{{ route('complaints.index') }}" class="text-sm text-primary hover:text-primary-hover transition-colors">Lihat Semua</a>
            </div>

            @if ($recentComplaints->isEmpty())
                <div class="p-12 text-center">
                    <svg class="w-12 h-12 text-ink-subdued mx-auto mb-3" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                    </svg>
                    <p class="text-sm text-ink-subdued">Belum ada pengaduan</p>
                </div>
            @else
                <div class="divide-y divide-border-subtle">
                    @foreach ($recentComplaints as $complaint)
                        <a href="{{ route('complaints.show', $complaint) }}"
                           class="flex items-center gap-4 px-6 py-3 hover:bg-surface-1 transition-colors">
                            <div class="w-10 h-10 rounded-lg bg-surface-1 flex items-center justify-center shrink-0">
                                <span class="text-xs font-mono font-medium text-ink-muted">{{ substr($complaint->nomor_tiket, -4) }}</span>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="text-sm font-medium text-ink truncate">{{ $complaint->judul }}</div>
                                <div class="text-xs text-ink-subdued">{{ $complaint->nama_pelapor }} &middot; {{ $complaint->created_at->diffForHumans() }}</div>
                            </div>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                {{ match($complaint->status) {
                                    'baru' => 'bg-primary/10 text-primary',
                                    'diproses' => 'bg-warning/10 text-warning',
                                    'selesai' => 'bg-success/10 text-success',
                                    'ditolak' => 'bg-error/10 text-error',
                                    default => 'bg-surface-2 text-ink-muted',
                                } }}">
                                {{ $complaint->status_label }}
                            </span>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>

        {{-- Top Categories --}}
        <div class="bg-white rounded-xl shadow-card border border-border-subtle">
            <div class="px-6 py-4 border-b border-border-subtle">
                <h3 class="text-base font-semibold text-ink">Kategori Terbanyak</h3>
            </div>

            @if (empty($topCategories))
                <div class="p-12 text-center">
                    <p class="text-sm text-ink-subdued">Belum ada data</p>
                </div>
            @else
                <div class="divide-y divide-border-subtle">
                    @foreach ($topCategories as $index => $category)
                        <div class="flex items-center gap-4 px-6 py-3">
                            <span class="text-sm font-bold text-ink-subdued w-5">{{ $index + 1 }}</span>
                            <div class="flex-1 min-w-0">
                                <div class="text-sm font-medium text-ink truncate">{{ $category['nama'] }}</div>
                            </div>
                            <span class="text-sm font-semibold text-ink">{{ $category['complaints_count'] }}</span>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-layouts.app>
