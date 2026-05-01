@props([
    'eyebrow' => null,
    'title',
    'subtitle' => null,
    'compact' => false,
])

<div {{ $attributes->class(['page-hero', 'page-hero-compact' => $compact]) }}>
    <div class="page-hero-copy">
        @if($eyebrow)
            <span class="eyebrow">{{ $eyebrow }}</span>
        @endif

        <h1>{{ $title }}</h1>

        @if($subtitle)
            <p>{{ $subtitle }}</p>
        @endif
    </div>

    @isset($actions)
        <div class="page-hero-actions">
            {{ $actions }}
        </div>
    @endisset
</div>
