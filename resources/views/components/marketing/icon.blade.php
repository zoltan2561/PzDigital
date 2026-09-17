@props(['name'])
<svg {{ $attributes->merge(['class' => 'icon', 'viewBox' => '0 0 24 24', 'fill' => 'none', 'stroke' => 'currentColor', 'stroke-width' => '1.8', 'stroke-linecap' => 'round', 'stroke-linejoin' => 'round', 'aria-hidden' => 'true']) }}>
    @switch($name)
        @case('code') <path d="m8 9-4 3 4 3M16 9l4 3-4 3M14 5l-4 14"/> @break
        @case('globe') <circle cx="12" cy="12" r="9"/><path d="M3 12h18M12 3a15 15 0 0 1 0 18M12 3a15 15 0 0 0 0 18"/> @break
        @case('flow') <rect x="3" y="3" width="7" height="7" rx="2"/><rect x="14" y="14" width="7" height="7" rx="2"/><path d="M7 14v2a2 2 0 0 0 2 2h1M14 7h2a2 2 0 0 1 2 2v1"/> @break
        @case('shield') <path d="M12 3 5 6v5c0 4.7 2.9 8.2 7 10 4.1-1.8 7-5.3 7-10V6l-7-3Z"/><path d="m9 12 2 2 4-4"/> @break
        @case('chart') <path d="M4 20V10M10 20V4M16 20v-7M22 20H2"/> @break
        @case('people') <path d="M16 20v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2M9 10a4 4 0 1 0 0-8 4 4 0 0 0 0 8ZM22 20v-2a4 4 0 0 0-3-3.9M16 2.1a4 4 0 0 1 0 7.8"/> @break
        @default <circle cx="12" cy="12" r="9"/><path d="m9 12 2 2 4-4"/>
    @endswitch
</svg>
