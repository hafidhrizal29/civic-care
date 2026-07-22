<x-layouts.app>
    <x-slot name="header">
        <h1 class="text-xl font-semibold text-ink">Pengaduan</h1>
    </x-slot>

    <x-breadcrumb :items="[['label' => 'Pengaduan']]" />

    <div class="bg-white rounded-xl shadow-card border border-border-subtle">
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 px-6 py-4 border-b border-border-subtle">
            <form method="GET" class="flex flex-wrap items-center gap-2 w-full sm:w-auto">
                <div class="relative flex-1 sm:flex-initial">
                    <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-ink-subdued" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                    </svg>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nomor tiket, judul, pelapor..."
                           class="w-full sm:w-56 pl-9 pr-4 py-2 text-sm border border-border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary">
                </div>
                <select name="status" class="px-3 py-2 text-sm border border-border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary bg-white">
                    <option value="">Semua Status</option>
                    <option value="baru" {{ request('status') === 'baru' ? 'selected' : '' }}>Baru</option>
                    <option value="diproses" {{ request('status') === 'diproses' ? 'selected' : '' }}>Diproses</option>
                    <option value="selesai" {{ request('status') === 'selesai' ? 'selected' : '' }}>Selesai</option>
                    <option value="ditolak" {{ request('status') === 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                </select>
                <select name="category" class="px-3 py-2 text-sm border border-border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary bg-white">
                    <option value="">Semua Kategori</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>{{ $category->nama }}</option>
                    @endforeach
                </select>
                <button type="submit" class="px-4 py-2 text-sm font-medium text-ink bg-surface-1 hover:bg-surface-2 rounded-lg transition-colors">
                    Cari
                </button>
                @if (request()->hasAny(['search', 'status', 'category']))
                    <a href="{{ route('complaints.index') }}" class="px-3 py-2 text-sm font-medium text-ink-muted hover:text-ink rounded-lg transition-colors">
                        Reset
                    </a>
                @endif
            </form>

            <a href="{{ route('complaints.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-primary hover:bg-primary-hover text-white text-sm font-medium rounded-lg transition-colors shrink-0">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                Buat Pengaduan
            </a>
        </div>

        @if ($complaints->isEmpty())
            <div class="p-12 text-center">
                <svg class="w-12 h-12 text-ink-subdued mx-auto mb-3" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                </svg>
                <p class="text-sm text-ink-subdued mb-4">Belum ada pengaduan</p>
                <a href="{{ route('complaints.create') }}" class="inline-flex items-center gap-1.5 text-sm font-medium text-primary hover:text-primary-hover transition-colors">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    Buat Pengaduan Pertama
                </a>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-border-subtle">
                            <th class="text-left px-6 py-3 font-medium text-ink-muted">No</th>
                            <th class="text-left px-6 py-3 font-medium text-ink-muted">Nomor Tiket</th>
                            <th class="text-left px-6 py-3 font-medium text-ink-muted">Judul</th>
                            <th class="text-left px-6 py-3 font-medium text-ink-muted">Pelapor</th>
                            <th class="text-left px-6 py-3 font-medium text-ink-muted">Kategori</th>
                            <th class="text-center px-6 py-3 font-medium text-ink-muted">Status</th>
                            <th class="text-left px-6 py-3 font-medium text-ink-muted">Tanggal</th>
                            <th class="text-right px-6 py-3 font-medium text-ink-muted">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-border-subtle">
                        @foreach ($complaints as $complaint)
                            <tr class="hover:bg-surface-1 transition-colors">
                                <td class="px-6 py-3 text-ink-subdued">{{ ($complaints->currentPage() - 1) * $complaints->perPage() + $loop->iteration }}</td>
                                <td class="px-6 py-3">
                                    <a href="{{ route('complaints.show', $complaint) }}" class="font-mono text-xs font-medium text-primary hover:text-primary-hover">
                                        {{ $complaint->nomor_tiket }}
                                    </a>
                                </td>
                                <td class="px-6 py-3 font-medium text-ink max-w-xs truncate">{{ $complaint->judul }}</td>
                                <td class="px-6 py-3 text-ink-muted">{{ $complaint->nama_pelapor }}</td>
                                <td class="px-6 py-3">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-surface-2 text-ink-muted">
                                        {{ $complaint->category->nama }}
                                    </span>
                                </td>
                                <td class="px-6 py-3 text-center">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $complaint->status_badge_class }}">
                                        {{ $complaint->status_label }}
                                    </span>
                                </td>
                                <td class="px-6 py-3 text-ink-muted text-xs">
                                    {{ $complaint->created_at->format('d M Y') }}
                                </td>
                                <td class="px-6 py-3">
                                    <div class="flex items-center justify-end gap-1">
                                        <a href="{{ route('complaints.show', $complaint) }}" class="p-1.5 text-ink-subdued hover:text-primary hover:bg-primary/10 rounded-lg transition-colors" title="Detail">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                        </a>
                                        <a href="{{ route('complaints.edit', $complaint) }}" class="p-1.5 text-ink-subdued hover:text-primary hover:bg-primary/10 rounded-lg transition-colors" title="Edit">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                            </svg>
                                        </a>
                                        <button type="button"
                                                @click="$dispatch('confirm-modal', { title: 'Hapus Pengaduan', message: 'Apakah Anda yakin ingin menghapus pengaduan {{ $complaint->nomor_tiket }}? Data yang sudah dihapus tidak dapat dikembalikan.', formId: 'delete-complaint-{{ $complaint->id }}' })"
                                                class="p-1.5 text-ink-subdued hover:text-error hover:bg-error/10 rounded-lg transition-colors" title="Hapus">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                            </svg>
                                        </button>
                                        <form id="delete-complaint-{{ $complaint->id }}" method="POST" action="{{ route('complaints.destroy', $complaint) }}" class="hidden">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="px-6 py-4 border-t border-border-subtle">
                {{ $complaints->withQueryString()->links() }}
            </div>
        @endif
    </div>

    <x-confirm-modal />
</x-layouts.app>
