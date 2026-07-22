<x-layouts.app>
    <x-slot name="header">
        <h1 class="text-xl font-semibold text-ink">Edit Pengaduan</h1>
    </x-slot>

    <x-breadcrumb :items="[['label' => 'Pengaduan', 'url' => route('complaints.index')], ['label' => $complaint->nomor_tiket, 'url' => route('complaints.show', $complaint)], ['label' => 'Edit']]" />

    <div class="max-w-3xl">
        <form method="POST" action="{{ route('complaints.update', $complaint) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="bg-white rounded-xl shadow-card border border-border-subtle">
                <div class="px-6 py-4 border-b border-border-subtle flex items-center justify-between">
                    <h3 class="text-base font-semibold text-ink">Informasi Pengaduan</h3>
                    <span class="font-mono text-xs font-medium text-primary">{{ $complaint->nomor_tiket }}</span>
                </div>

                <div class="p-6 space-y-5">
                    <div>
                        <label for="judul" class="block text-sm font-medium text-ink mb-1.5">
                            Judul <span class="text-error">*</span>
                        </label>
                        <input type="text" name="judul" id="judul" value="{{ old('judul', $complaint->judul) }}" required
                               class="w-full px-4 py-2.5 text-sm border border-border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary @error('judul') border-error @enderror"
                               placeholder="Ringkasan singkat pengaduan">
                        @error('judul')
                            <p class="mt-1.5 text-sm text-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="complaint_category_id" class="block text-sm font-medium text-ink mb-1.5">
                            Kategori <span class="text-error">*</span>
                        </label>
                        <select name="complaint_category_id" id="complaint_category_id" required
                                class="w-full px-4 py-2.5 text-sm border border-border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary bg-white @error('complaint_category_id') border-error @enderror">
                            <option value="">Pilih kategori</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ old('complaint_category_id', $complaint->complaint_category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('complaint_category_id')
                            <p class="mt-1.5 text-sm text-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="deskripsi" class="block text-sm font-medium text-ink mb-1.5">
                            Deskripsi <span class="text-error">*</span>
                        </label>
                        <textarea name="deskripsi" id="deskripsi" rows="5" required
                                  class="w-full px-4 py-2.5 text-sm border border-border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary @error('deskripsi') border-error @enderror"
                                  placeholder="Jelaskan pengaduan Anda secara detail">{{ old('deskripsi', $complaint->deskripsi) }}</textarea>
                        @error('deskripsi')
                            <p class="mt-1.5 text-sm text-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="foto" class="block text-sm font-medium text-ink mb-1.5">
                            Foto Bukti <span class="text-ink-subdued font-normal">(opsional, max 2MB)</span>
                        </label>
                        @if ($complaint->foto)
                            <div class="mb-3">
                                <img src="{{ Storage::url($complaint->foto) }}" alt="Foto bukti saat ini" class="rounded-lg max-w-xs border border-border-subtle">
                                <p class="text-xs text-ink-subdued mt-1">Foto saat ini. Unggah foto baru untuk menggantikan.</p>
                            </div>
                        @endif
                        <input type="file" name="foto" id="foto" accept="image/*"
                               class="w-full px-4 py-2.5 text-sm border border-border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary file:mr-3 file:py-1 file:px-3 file:text-sm file:font-medium file:bg-surface-1 file:text-ink-muted file:border-0 file:rounded-md hover:file:bg-surface-2 file:cursor-pointer @error('foto') border-error @enderror">
                        @error('foto')
                            <p class="mt-1.5 text-sm text-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="status" class="block text-sm font-medium text-ink mb-1.5">
                            Status <span class="text-error">*</span>
                        </label>
                        <select name="status" id="status" required
                                class="w-full px-4 py-2.5 text-sm border border-border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary bg-white @error('status') border-error @enderror">
                            @foreach (['baru' => 'Baru', 'diproses' => 'Diproses', 'selesai' => 'Selesai', 'ditolak' => 'Ditolak'] as $value => $label)
                                <option value="{{ $value }}" {{ old('status', $complaint->status) === $value ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                        @error('status')
                            <p class="mt-1.5 text-sm text-error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-card border border-border-subtle mt-6">
                <div class="px-6 py-4 border-b border-border-subtle">
                    <h3 class="text-base font-semibold text-ink">Data Pelapor</h3>
                </div>

                <div class="p-6 space-y-5">
                    <div>
                        <label for="nama_pelapor" class="block text-sm font-medium text-ink mb-1.5">
                            Nama Lengkap <span class="text-error">*</span>
                        </label>
                        <input type="text" name="nama_pelapor" id="nama_pelapor" value="{{ old('nama_pelapor', $complaint->nama_pelapor) }}" required
                               class="w-full px-4 py-2.5 text-sm border border-border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary @error('nama_pelapor') border-error @enderror"
                               placeholder="Nama lengkap pelapor">
                        @error('nama_pelapor')
                            <p class="mt-1.5 text-sm text-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div>
                            <label for="email" class="block text-sm font-medium text-ink mb-1.5">
                                Email
                            </label>
                            <input type="email" name="email" id="email" value="{{ old('email', $complaint->email) }}"
                                   class="w-full px-4 py-2.5 text-sm border border-border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary @error('email') border-error @enderror"
                                   placeholder="email@contoh.com">
                            @error('email')
                                <p class="mt-1.5 text-sm text-error">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="telepon" class="block text-sm font-medium text-ink mb-1.5">
                                Nomor Telepon
                            </label>
                            <input type="text" name="telepon" id="telepon" value="{{ old('telepon', $complaint->telepon) }}"
                                   class="w-full px-4 py-2.5 text-sm border border-border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary @error('telepon') border-error @enderror"
                                   placeholder="08xxxxxxxxxx">
                            @error('telepon')
                                <p class="mt-1.5 text-sm text-error">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="lokasi" class="block text-sm font-medium text-ink mb-1.5">
                            Lokasi Kejadian <span class="text-error">*</span>
                        </label>
                        <input type="text" name="lokasi" id="lokasi" value="{{ old('lokasi', $complaint->lokasi) }}" required
                               class="w-full px-4 py-2.5 text-sm border border-border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary @error('lokasi') border-error @enderror"
                               placeholder="Alamat atau lokasi kejadian">
                        @error('lokasi')
                            <p class="mt-1.5 text-sm text-error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-end gap-3 mt-6">
                <a href="{{ route('complaints.index') }}" class="px-4 py-2 text-sm font-medium text-ink-muted hover:text-ink bg-surface-1 hover:bg-surface-2 rounded-lg transition-colors">
                    Batal
                </a>
                <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-primary hover:bg-primary-hover rounded-lg transition-colors">
                    Perbarui Pengaduan
                </button>
            </div>
        </form>
    </div>
</x-layouts.app>
