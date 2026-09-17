@props(['product', 'featured' => false])
<article @class(['product-card', 'product-card-featured' => $featured, 'accent-green' => $product['accent'] === 'green'])>
    <div class="product-card-copy">
        <div class="product-heading">
            <span class="product-symbol">{{ $product['slug'] === 'szervizpro' ? '⌁' : '✦' }}</span>
            <div><h3>{{ $product['name'] }}</h3><p>{{ $product['audience'] }}</p></div>
        </div>
        <span class="status-badge">{{ $product['status_label'] }}</span>
        <p>{{ $product['summary'] }}</p>
        <ul class="check-list">
            @foreach($product['benefits'] as $benefit)<li>{{ $benefit }}</li>@endforeach
        </ul>
        <a class="text-link" href="{{ route('products.show', $product['slug']) }}">Megismerem <span aria-hidden="true">→</span></a>
    </div>
    <x-marketing.product-visual :product="$product" compact />
</article>
