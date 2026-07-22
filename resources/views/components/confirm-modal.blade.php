@props(['id' => 'confirm-modal'])

<div x-data="{ open: false, title: '', message: '', formId: '' }"
     @confirm-modal.window="open = true; title = $event.detail.title; message = $event.detail.message; formId = $event.detail.formId || '';"
     x-show="open"
     x-transition:enter="transition ease-out duration-200"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-150"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     class="fixed inset-0 z-50 flex items-center justify-center p-4"
     style="display: none;">

    <div class="fixed inset-0 bg-ink/50" @click="open = false"></div>

    <div x-show="open"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95"
         class="relative bg-white rounded-xl shadow-elevated p-6 max-w-sm w-full">

        <div class="flex items-center gap-4 mb-4">
            <div class="w-10 h-10 rounded-full bg-error/10 flex items-center justify-center shrink-0">
                <svg class="w-5 h-5 text-error" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                </svg>
            </div>
            <div>
                <h3 class="text-base font-semibold text-ink" x-text="title"></h3>
                <p class="text-sm text-ink-muted mt-0.5" x-text="message"></p>
            </div>
        </div>

        <div class="flex items-center justify-end gap-3 mt-6">
            <button @click="open = false" class="px-4 py-2 text-sm font-medium text-ink-muted hover:text-ink bg-surface-1 hover:bg-surface-2 rounded-lg transition-colors">
                Batal
            </button>
            <button @click="if (formId) document.getElementById(formId)?.submit(); open = false;" class="px-4 py-2 text-sm font-medium text-white bg-error hover:bg-error/90 rounded-lg transition-colors">
                Hapus
            </button>
        </div>
    </div>
</div>
