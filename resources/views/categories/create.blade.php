<x-layouts.app>
    <x-slot name="header">
        <h1 class="text-xl font-semibold text-ink">Tambah Kategori</h1>
    </x-slot>

    <x-breadcrumb :items="[['label' => 'Master Data', 'url' => route('categories.index')], ['label' => 'Kategori', 'url' => route('categories.index')], ['label' => 'Tambah Baru']]" />

    <div class="max-w-2xl">
        <div class="bg-white rounded-xl shadow-card border border-border-subtle">
            <form method="POST" action="{{ route('categories.store') }}">
                @csrf

                <div class="p-6 space-y-5">
                    <div>
                        <label for="nama" class="block text-sm font-medium text-ink mb-1.5">
                            Nama Kategori <span class="text-error">*</span>
                        </label>
                        <input type="text" name="nama" id="nama" value="{{ old('nama') }}" required
                               class="w-full px-4 py-2.5 text-sm border border-border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary @error('nama') border-error @enderror"
                               placeholder="Masukkan nama kategori">
                        @error('nama')
                            <p class="mt-1.5 text-sm text-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="deskripsi" class="block text-sm font-medium text-ink mb-1.5">
                            Deskripsi
                        </label>
                        <textarea name="deskripsi" id="deskripsi" rows="3"
                                  class="w-full px-4 py-2.5 text-sm border border-border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary @error('deskripsi') border-error @enderror"
                                  placeholder="Deskripsi singkat tentang kategori ini">{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                            <p class="mt-1.5 text-sm text-error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3 px-6 py-4 border-t border-border-subtle">
                    <a href="{{ route('categories.index') }}" class="px-4 py-2 text-sm font-medium text-ink-muted hover:text-ink bg-surface-1 hover:bg-surface-2 rounded-lg transition-colors">
                        Batal
                    </a>
                    <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-primary hover:bg-primary-hover rounded-lg transition-colors">
                        Simpan Kategori
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>
