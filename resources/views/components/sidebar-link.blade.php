@props(['href' => '#', 'active' => false])

<a href="{{ $href }}"
   {{ $attributes->merge([
       'class' => 'flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium transition-colors ' .
           ($active
               ? 'bg-white/15 text-white'
               : 'text-white/70 hover:bg-white/10 hover:text-white')
   ]) }}>
    {{ $slot }}
</a>
