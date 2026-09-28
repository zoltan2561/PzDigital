@props(['screenshot', 'wide' => false])

<figure @class(['gallery-card', 'gallery-card-wide' => $wide, 'gallery-card-portrait' => ($screenshot['orientation'] ?? null) === 'portrait'])>
    <a class="gallery-image" href="{{ $screenshot['src'] }}" data-product-lightbox-open aria-label="{{ $screenshot['title'] }} — kép nagyítása"><img src="{{ $screenshot['src'] }}" alt="{{ $screenshot['alt'] }}" width="{{ $screenshot['width'] ?? 1440 }}" height="{{ $screenshot['height'] ?? 1000 }}" loading="lazy"></a>
    <figcaption><span>{{ $screenshot['label'] }}</span><strong>{{ $screenshot['title'] }}</strong></figcaption>
</figure>
