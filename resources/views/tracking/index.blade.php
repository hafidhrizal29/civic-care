<x-layouts.landing>
    <x-navbar />

    <main class="min-h-screen bg-surface-1 py-16">
        <div class="max-w-3xl mx-auto px-4 sm:px-6">
            <div class="text-center mb-10">
                <h1 class="text-2xl sm:text-3xl font-bold text-ink">Lacak Pengaduan</h1>
                <p class="mt-2 text-ink-muted">Masukkan nomor tiket untuk melacak status pengaduan Anda</p>
            </div>

            <div class="bg-white rounded-xl shadow-card border border-border-subtle p-6 sm:p-8">
                <form method="GET" action="{{ route('tracking') }}">
                    <div class="flex flex-col sm:flex-row gap-3">
                        <div class="relative flex-1">
                            <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-ink-subdued" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                            </svg>
                            <input type="text" name="nomor_tiket" value="{{ request('nomor_tiket') }}" required
                                   placeholder="CC-20260722-0001"
                                   class="w-full pl-10 pr-4 py-3 text-sm border border-border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary font-mono">
                        </div>
                        <button type="submit" class="px-6 py-3 text-sm font-medium text-white bg-primary hover:bg-primary-hover rounded-lg transition-colors shrink-0">
                            Lacak
                        </button>
                    </div>
                </form>
            </div>

            @if (request('nomor_tiket') && !$complaint)
                <div class="mt-8 bg-white rounded-xl shadow-card border border-border-subtle p-8 text-center">
                    <svg class="w-12 h-12 text-ink-subdued mx-auto mb-3" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                    </svg>
                    <p class="text-ink font-medium">Pengaduan tidak ditemukan</p>
                    <p class="text-sm text-ink-muted mt-1">Nomor tiket <span class="font-mono">{{ request('nomor_tiket') }}</span> tidak terdaftar dalam sistem.</p>
                </div>
            @endif

            @if ($complaint)
                <div class="mt-8 space-y-6">
                    <div class="bg-white rounded-xl shadow-card border border-border-subtle">
                        <div class="px-6 py-4 border-b border-border-subtle flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                            <div>
                                <div class="font-mono text-sm font-semibold text-primary">{{ $complaint->nomor_tiket }}</div>
                                <h2 class="text-lg font-semibold text-ink mt-0.5">{{ $complaint->judul }}</h2>
                            </div>
                            <span class="inline-flex items-center self-start px-3 py-1 rounded-full text-sm font-medium {{ $complaint->status_badge_class }}">
                                {{ $complaint->status_label }}
                            </span>
                        </div>

                        <div class="p-6 space-y-4">
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                                <div>
                                    <dt class="text-xs font-medium text-ink-subdued uppercase tracking-wide">Kategori</dt>
                                    <dd class="mt-1 text-ink">{{ $complaint->category->nama }}</dd>
                                </div>
                                <div>
                                    <dt class="text-xs font-medium text-ink-subdued uppercase tracking-wide">Lokasi</dt>
                                    <dd class="mt-1 text-ink">{{ $complaint->lokasi }}</dd>
                                </div>
                                <div>
                                    <dt class="text-xs font-medium text-ink-subdued uppercase tracking-wide">Pelapor</dt>
                                    <dd class="mt-1 text-ink">{{ $complaint->nama_pelapor }}</dd>
                                </div>
                                <div>
                                    <dt class="text-xs font-medium text-ink-subdued uppercase tracking-wide">Tanggal</dt>
                                    <dd class="mt-1 text-ink">{{ $complaint->created_at->format('d M Y H:i') }}</dd>
                                </div>
                            </div>

                            <div>
                                <dt class="text-xs font-medium text-ink-subdued uppercase tracking-wide">Deskripsi</dt>
                                <dd class="mt-1 text-sm text-ink-muted whitespace-pre-wrap">{{ $complaint->deskripsi }}</dd>
                            </div>

                            @if ($complaint->foto)
                                <div>
                                    <dt class="text-xs font-medium text-ink-subdued uppercase tracking-wide mb-2">Foto Bukti</dt>
                                    <img src="{{ Storage::url($complaint->foto) }}" alt="Foto bukti" class="rounded-lg max-w-sm border border-border-subtle">
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow-card border border-border-subtle">
                        <div class="px-6 py-4 border-b border-border-subtle">
                            <h3 class="text-base font-semibold text-ink">Status Pengaduan</h3>
                        </div>
                        <div class="p-6">
                            <div class="relative">
                                @php
                                    $statuses = [
                                        'baru' => ['label' => 'Baru', 'desc' => 'Pengaduan telah diterima'],
                                        'diproses' => ['label' => 'Diproses', 'desc' => 'Pengaduan sedang ditindaklanjuti'],
                                        'selesai' => ['label' => 'Selesai', 'desc' => 'Pengaduan telah diselesaikan'],
                                        'ditolak' => ['label' => 'Ditolak', 'desc' => 'Pengaduan tidak dapat diproses'],
                                    ];
                                    $statusOrder = ['baru', 'diproses', 'selesai'];
                                    $currentIndex = array_search($complaint->status, $statusOrder);
                                    $isRejected = $complaint->status === 'ditolak';
                                @endphp

                                <div class="space-y-0">
                                    @foreach ($statusOrder as $index => $status)
                                        @php
                                            $isActive = !$isRejected && $index <= $currentIndex;
                                            $isCurrent = $complaint->status === $status;
                                        @endphp
                                        <div class="flex gap-4">
                                            <div class="flex flex-col items-center">
                                                <div class="w-8 h-8 rounded-full flex items-center justify-center shrink-0 {{ $isActive ? 'bg-primary text-white' : 'bg-surface-2 text-ink-subdued' }}">
                                                    @if ($isActive && !$isCurrent)
                                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                                        </svg>
                                                    @else
                                                        <span class="text-xs font-semibold">{{ $index + 1 }}</span>
                                                    @endif
                                                </div>
                                                @if (!$loop->last)
                                                    <div class="w-0.5 h-8 {{ $isActive && $index < $currentIndex ? 'bg-primary' : 'bg-surface-2' }}"></div>
                                                @endif
                                            </div>
                                            <div class="pb-6 {{ $loop->last ? 'pb-0' : '' }}">
                                                <div class="text-sm font-medium {{ $isActive ? 'text-ink' : 'text-ink-subdued' }}">{{ $statuses[$status]['label'] }}</div>
                                                <div class="text-xs {{ $isActive ? 'text-ink-muted' : 'text-ink-subdued' }}">{{ $statuses[$status]['desc'] }}</div>
                                            </div>
                                        </div>
                                    @endforeach

                                    @if ($isRejected)
                                        <div class="flex gap-4">
                                            <div class="flex flex-col items-center">
                                                <div class="w-8 h-8 rounded-full flex items-center justify-center shrink-0 bg-red-500 text-white">
                                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="text-sm font-medium text-ink">Ditolak</div>
                                                <div class="text-xs text-ink-muted">{{ $statuses['ditolak']['desc'] }}</div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    @if ($complaint->responses->isNotEmpty())
                        <div class="bg-white rounded-xl shadow-card border border-border-subtle">
                            <div class="px-6 py-4 border-b border-border-subtle">
                                <h3 class="text-base font-semibold text-ink">Riwayat Tanggapan</h3>
                            </div>
                            <div class="divide-y divide-border-subtle">
                                @foreach ($complaint->responses->sortBy('created_at') as $response)
                                    <div class="px-6 py-4">
                                        <div class="flex items-center gap-3 mb-2">
                                            <div class="w-8 h-8 rounded-full bg-primary/10 flex items-center justify-center text-xs font-semibold text-primary">
                                                {{ substr($response->user->name, 0, 1) }}
                                            </div>
                                            <div>
                                                <div class="text-sm font-medium text-ink">{{ $response->user->name }}</div>
                                                <div class="text-xs text-ink-subdued">{{ $response->created_at->format('d M Y H:i') }}</div>
                                            </div>
                                        </div>
                                        <p class="text-sm text-ink-muted whitespace-pre-wrap ml-11">{{ $response->isi }}</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            @endif
        </div>
    </main>

    <x-footer />
</x-layouts.landing>
