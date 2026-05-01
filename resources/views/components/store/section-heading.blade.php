@props([
    'eyebrow' => null,
    'title',
    'text' => null,
])

<div {{ $attributes->class(['section-head']) }}>
    <div class="section-head-main">
        @if($eyebrow)
            <span class="eyebrow">{{ $eyebrow }}</span>
        @endif

        <h2>{{ $title }}</h2>

        @if($text)
            <p class="section-head-copy">{{ $text }}</p>
        @endif
    </div>

    @isset($actions)
        <div>
            {{ $actions }}
        </div>
    @endisset
</div>
