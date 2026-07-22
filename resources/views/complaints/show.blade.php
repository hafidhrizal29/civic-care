<x-layouts.app>
    <x-slot name="header">
        <h1 class="text-xl font-semibold text-ink">Detail Pengaduan</h1>
    </x-slot>

    <x-breadcrumb :items="[['label' => 'Pengaduan', 'url' => route('complaints.index')], ['label' => $complaint->nomor_tiket]]" />

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 space-y-6">
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

                <div class="p-6 space-y-5">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <dt class="text-xs font-medium text-ink-subdued uppercase tracking-wide">Kategori</dt>
                            <dd class="mt-1 text-sm text-ink">{{ $complaint->category->nama }}</dd>
                        </div>
                        <div>
                            <dt class="text-xs font-medium text-ink-subdued uppercase tracking-wide">Tanggal</dt>
                            <dd class="mt-1 text-sm text-ink">{{ $complaint->created_at->format('d M Y H:i') }}</dd>
                        </div>
                        <div>
                            <dt class="text-xs font-medium text-ink-subdued uppercase tracking-wide">Pelapor</dt>
                            <dd class="mt-1 text-sm text-ink">{{ $complaint->nama_pelapor }}</dd>
                        </div>
                        <div>
                            <dt class="text-xs font-medium text-ink-subdued uppercase tracking-wide">Email</dt>
                            <dd class="mt-1 text-sm text-ink">{{ $complaint->email ?: '-' }}</dd>
                        </div>
                        <div>
                            <dt class="text-xs font-medium text-ink-subdued uppercase tracking-wide">Telepon</dt>
                            <dd class="mt-1 text-sm text-ink">{{ $complaint->telepon ?: '-' }}</dd>
                        </div>
                        <div>
                            <dt class="text-xs font-medium text-ink-subdued uppercase tracking-wide">Lokasi</dt>
                            <dd class="mt-1 text-sm text-ink">{{ $complaint->lokasi }}</dd>
                        </div>
                    </div>

                    <div>
                        <dt class="text-xs font-medium text-ink-subdued uppercase tracking-wide">Deskripsi</dt>
                        <dd class="mt-1 text-sm text-ink whitespace-pre-wrap">{{ $complaint->deskripsi }}</dd>
                    </div>

                    @if ($complaint->foto)
                        <div>
                            <dt class="text-xs font-medium text-ink-subdued uppercase tracking-wide mb-2">Foto Bukti</dt>
                            <img src="{{ Storage::url($complaint->foto) }}" alt="Foto bukti pengaduan" class="rounded-lg max-w-md border border-border-subtle">
                        </div>
                    @endif
                </div>

                <div class="px-6 py-4 border-t border-border-subtle flex items-center justify-between">
                    <a href="{{ route('complaints.index') }}" class="px-4 py-2 text-sm font-medium text-ink-muted hover:text-ink bg-surface-1 hover:bg-surface-2 rounded-lg transition-colors">
                        Kembali
                    </a>
                    <div class="flex items-center gap-2">
                        <a href="{{ route('complaints.edit', $complaint) }}" class="px-4 py-2 text-sm font-medium text-primary hover:bg-primary/10 rounded-lg transition-colors">
                            Edit
                        </a>
                        <button type="button"
                                @click="$dispatch('confirm-modal', { title: 'Hapus Pengaduan', message: 'Apakah Anda yakin ingin menghapus pengaduan {{ $complaint->nomor_tiket }}?', formId: 'delete-complaint-detail' })"
                                class="px-4 py-2 text-sm font-medium text-error hover:bg-error/10 rounded-lg transition-colors">
                            Hapus
                        </button>
                        <form id="delete-complaint-detail" method="POST" action="{{ route('complaints.destroy', $complaint) }}" class="hidden">
                            @csrf
                            @method('DELETE')
                        </form>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-card border border-border-subtle">
                <div class="px-6 py-4 border-b border-border-subtle">
                    <h3 class="text-base font-semibold text-ink">Riwayat Tanggapan</h3>
                </div>

                @if ($complaint->responses->isEmpty())
                    <div class="p-8 text-center">
                        <svg class="w-10 h-10 text-ink-subdued mx-auto mb-2" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 01-.825-.242m9.345-8.334a2.126 2.126 0 00-.476-.095 48.64 48.64 0 00-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0011.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155" />
                        </svg>
                        <p class="text-sm text-ink-subdued">Belum ada tanggapan</p>
                    </div>
                @else
                    <div class="divide-y divide-border-subtle">
                        @foreach ($complaint->responses->sortByDesc('created_at') as $response)
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
                @endif
            </div>
        </div>

        <div class="space-y-6">
            <div class="bg-white rounded-xl shadow-card border border-border-subtle" x-data="{ open: false }">
                <div class="px-6 py-4 border-b border-border-subtle">
                    <h3 class="text-base font-semibold text-ink">Ubah Status</h3>
                </div>
                <div class="p-6">
                    <form method="POST" action="{{ route('complaints.status', $complaint) }}">
                        @csrf
                        @method('PATCH')
                        <div class="space-y-3">
                            @foreach (['baru' => 'Baru', 'diproses' => 'Diproses', 'selesai' => 'Selesai', 'ditolak' => 'Ditolak'] as $value => $label)
                                <label class="flex items-center gap-3 p-3 rounded-lg border transition-colors cursor-pointer
                                    {{ $complaint->status === $value ? 'border-primary bg-primary/5' : 'border-border hover:border-border-hover' }}">
                                    <input type="radio" name="status" value="{{ $value }}" {{ $complaint->status === $value ? 'checked' : '' }}
                                           class="text-primary focus:ring-primary/20">
                                    <span class="text-sm font-medium text-ink">{{ $label }}</span>
                                </label>
                            @endforeach
                        </div>
                        <button type="submit" class="w-full mt-4 px-4 py-2.5 text-sm font-medium text-white bg-primary hover:bg-primary-hover rounded-lg transition-colors">
                            Perbarui Status
                        </button>
                    </form>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-card border border-border-subtle">
                <div class="px-6 py-4 border-b border-border-subtle">
                    <h3 class="text-base font-semibold text-ink">Informasi</h3>
                </div>
                <div class="p-6 space-y-3 text-sm">
                    <div class="flex justify-between">
                        <span class="text-ink-subdued">Dibuat</span>
                        <span class="text-ink font-medium">{{ $complaint->created_at->format('d M Y H:i') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-ink-subdued">Diperbarui</span>
                        <span class="text-ink font-medium">{{ $complaint->updated_at->format('d M Y H:i') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-ink-subdued">Total Tanggapan</span>
                        <span class="text-ink font-medium">{{ $complaint->responses_count ?? $complaint->responses->count() }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-confirm-modal />
</x-layouts.app>
