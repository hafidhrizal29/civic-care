<x-layouts.app>
    <x-slot name="header">
        <h1 class="text-xl font-semibold text-ink">Kirim Tanggapan</h1>
    </x-slot>

    <x-breadcrumb :items="[['label' => 'Tanggapan', 'url' => route('responses.index')], ['label' => 'Kirim Baru']]" />

    <div class="max-w-3xl">
        <form method="POST" action="{{ route('responses.store') }}">
            @csrf

            <div class="bg-white rounded-xl shadow-card border border-border-subtle">
                <div class="px-6 py-4 border-b border-border-subtle">
                    <h3 class="text-base font-semibold text-ink">Informasi Tanggapan</h3>
                </div>

                <div class="p-6 space-y-5">
                    <div>
                        <label for="complaint_id" class="block text-sm font-medium text-ink mb-1.5">
                            Pengaduan <span class="text-error">*</span>
                        </label>
                        <select name="complaint_id" id="complaint_id" required
                                class="w-full px-4 py-2.5 text-sm border border-border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary bg-white @error('complaint_id') border-error @enderror">
                            <option value="">Pilih Pengaduan</option>
                            @foreach ($complaints as $complaint)
                                <option value="{{ $complaint->id }}" {{ old('complaint_id') == $complaint->id ? 'selected' : '' }}>
                                    {{ $complaint->nomor_tiket }} - {{ $complaint->judul }}
                                </option>
                            @endforeach
                        </select>
                        @error('complaint_id')
                            <p class="mt-1.5 text-sm text-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="isi" class="block text-sm font-medium text-ink mb-1.5">
                            Isi Tanggapan <span class="text-error">*</span>
                        </label>
                        <textarea name="isi" id="isi" rows="6" required
                                  class="w-full px-4 py-2.5 text-sm border border-border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary @error('isi') border-error @enderror"
                                  placeholder="Tuliskan tanggapan Anda...">{{ old('isi') }}</textarea>
                        @error('isi')
                            <p class="mt-1.5 text-sm text-error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-end gap-3 mt-6">
                <a href="{{ route('responses.index') }}" class="px-4 py-2 text-sm font-medium text-ink-muted hover:text-ink bg-surface-1 hover:bg-surface-2 rounded-lg transition-colors">
                    Batal
                </a>
                <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-primary hover:bg-primary-hover rounded-lg transition-colors">
                    Kirim Tanggapan
                </button>
            </div>
        </form>
    </div>
</x-layouts.app>
