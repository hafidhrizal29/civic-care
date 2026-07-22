<x-layouts.app>
    <x-slot name="header">
        <h1 class="text-xl font-semibold text-ink">Laporan</h1>
    </x-slot>

    <x-breadcrumb :items="[['label' => 'Laporan']]" />

    {{-- Filter Section --}}
    <div class="bg-white rounded-xl shadow-card border border-border-subtle p-6 mb-6 report-filters">
        <form method="GET" action="{{ route('reports.index') }}">
            <div class="flex flex-wrap items-end gap-3">
                <div class="flex flex-col gap-1">
                    <label for="date_from" class="text-xs font-medium text-ink-muted">Dari Tanggal</label>
                    <input type="date" id="date_from" name="date_from" value="{{ request('date_from') }}"
                           class="px-3 py-2 text-sm border border-border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary bg-white">
                </div>

                <div class="flex flex-col gap-1">
                    <label for="date_to" class="text-xs font-medium text-ink-muted">Sampai Tanggal</label>
                    <input type="date" id="date_to" name="date_to" value="{{ request('date_to') }}"
                           class="px-3 py-2 text-sm border border-border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary bg-white">
                </div>

                <div class="flex flex-col gap-1">
                    <label for="category" class="text-xs font-medium text-ink-muted">Kategori</label>
                    <select id="category" name="category"
                            class="px-3 py-2 text-sm border border-border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary bg-white">
                        <option value="">Semua Kategori</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>{{ $category->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="flex flex-col gap-1">
                    <label for="status" class="text-xs font-medium text-ink-muted">Status</label>
                    <select id="status" name="status"
                            class="px-3 py-2 text-sm border border-border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary bg-white">
                        <option value="">Semua Status</option>
                        <option value="baru" {{ request('status') === 'baru' ? 'selected' : '' }}>Baru</option>
                        <option value="diproses" {{ request('status') === 'diproses' ? 'selected' : '' }}>Diproses</option>
                        <option value="selesai" {{ request('status') === 'selesai' ? 'selected' : '' }}>Selesai</option>
                        <option value="ditolak" {{ request('status') === 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                    </select>
                </div>

                <button type="submit" class="px-4 py-2 text-sm font-medium text-ink bg-surface-1 hover:bg-surface-2 rounded-lg transition-colors">
                    Cari
                </button>

                @if (request()->hasAny(['date_from', 'date_to', 'category', 'status']))
                    <a href="{{ route('reports.index') }}" class="px-3 py-2 text-sm font-medium text-ink-muted hover:text-ink rounded-lg transition-colors">
                        Reset
                    </a>
                @endif
            </div>

            <div class="flex items-center gap-3 mt-4 pt-4 border-t border-border-subtle">
                <a href="{{ route('reports.export', request()->query()) }}"
                   class="px-4 py-2 text-sm font-medium text-white bg-green-600 hover:bg-green-700 rounded-lg transition-colors">
                    Export CSV
                </a>
                <button type="button" onclick="window.print()"
                        class="px-4 py-2 text-sm font-medium text-ink bg-surface-1 hover:bg-surface-2 rounded-lg transition-colors">
                    Cetak
                </button>
            </div>
        </form>
    </div>

    {{-- Stats Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <div class="bg-white rounded-xl shadow-card border border-border-subtle p-6">
            <span class="text-xs font-medium text-ink-subdued uppercase tracking-wide">Total Pengaduan</span>
            <div class="text-2xl font-bold text-ink mt-1">{{ $total }}</div>
        </div>

        <div class="bg-white rounded-xl shadow-card border border-border-subtle p-6">
            <span class="text-xs font-medium text-ink-subdued uppercase tracking-wide">Selesai</span>
            <div class="text-2xl font-bold text-ink mt-1">{{ $selesai }}</div>
        </div>

        <div class="bg-white rounded-xl shadow-card border border-border-subtle p-6">
            <span class="text-xs font-medium text-ink-subdued uppercase tracking-wide">Tingkat Penyelesaian</span>
            <div class="text-2xl font-bold text-ink mt-1">{{ $completionRate }}%</div>
        </div>

        <div class="bg-white rounded-xl shadow-card border border-border-subtle p-6">
            <span class="text-xs font-medium text-ink-subdued uppercase tracking-wide">Rata-rata Penyelesaian</span>
            <div class="text-2xl font-bold text-ink mt-1">{{ $avgResolutionDays ? $avgResolutionDays . ' hari' : '-' }}</div>
        </div>
    </div>

    {{-- Print Header --}}
    <div class="print-header" style="display: none;">
        <h2 class="text-lg font-bold">Laporan Pengaduan - CivicCare</h2>
    </div>

    {{-- Results Table --}}
    <div class="bg-white rounded-xl shadow-card border border-border-subtle">
        @if ($complaints->isEmpty())
            <div class="p-12 text-center">
                <svg class="w-12 h-12 text-ink-subdued mx-auto mb-3" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                </svg>
                <p class="text-sm text-ink-subdued">Tidak ada data laporan yang cocok dengan filter yang dipilih.</p>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-border-subtle">
                            <th class="text-left px-6 py-3 font-medium text-ink-muted">No</th>
                            <th class="text-left px-6 py-3 font-medium text-ink-muted">Nomor Tiket</th>
                            <th class="text-left px-6 py-3 font-medium text-ink-muted">Judul</th>
                            <th class="text-left px-6 py-3 font-medium text-ink-muted">Kategori</th>
                            <th class="text-left px-6 py-3 font-medium text-ink-muted">Pelapor</th>
                            <th class="text-center px-6 py-3 font-medium text-ink-muted">Status</th>
                            <th class="text-left px-6 py-3 font-medium text-ink-muted">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-border-subtle">
                        @foreach ($complaints as $complaint)
                            <tr class="hover:bg-surface-1 transition-colors">
                                <td class="px-6 py-3 text-ink-subdued">{{ ($complaints->currentPage() - 1) * $complaints->perPage() + $loop->iteration }}</td>
                                <td class="px-6 py-3">
                                    <span class="font-mono text-xs text-primary">{{ $complaint->nomor_tiket }}</span>
                                </td>
                                <td class="px-6 py-3 font-medium text-ink max-w-xs truncate">{{ $complaint->judul }}</td>
                                <td class="px-6 py-3">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-surface-2 text-ink-muted">
                                        {{ $complaint->category->nama }}
                                    </span>
                                </td>
                                <td class="px-6 py-3 text-ink-muted">{{ $complaint->nama_pelapor }}</td>
                                <td class="px-6 py-3 text-center">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $complaint->status_badge_class }}">
                                        {{ $complaint->status_label }}
                                    </span>
                                </td>
                                <td class="px-6 py-3 text-ink-muted text-xs">
                                    {{ $complaint->created_at->format('d M Y') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="px-6 py-4 border-t border-border-subtle report-pagination">
                {{ $complaints->withQueryString()->links() }}
            </div>
        @endif
    </div>

    <style>
        @media print {
            .app-sidebar,
            .app-topbar,
            .report-filters,
            .report-pagination,
            nav[aria-label='breadcrumb'] {
                display: none !important;
            }

            .print-header {
                display: block !important;
                margin-bottom: 1rem !important;
            }

            table {
                page-break-inside: auto;
            }

            tr {
                page-break-inside: avoid;
            }
        }
    </style>
</x-layouts.app>
