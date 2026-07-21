@props(['items' => []])

@if (count($items) > 0)
    <nav class="flex items-center gap-1.5 text-sm text-ink-subdued mb-6">
        <a href="{{ route('dashboard') }}" class="hover:text-ink transition-colors">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
            </svg>
        </a>

        @foreach ($items as $item)
            <svg class="w-4 h-4 text-ink-subdued/50" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
            </svg>

            @if ($item['url'] ?? false)
                <a href="{{ $item['url'] }}" class="hover:text-ink transition-colors">
                    {{ $item['label'] }}
                </a>
            @else
                <span class="text-ink font-medium">{{ $item['label'] }}</span>
            @endif
        @endforeach
    </nav>
@endif
