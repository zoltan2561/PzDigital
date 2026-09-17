@props(['product'])
<article class="home-product-card accent-{{ $product['accent'] }}" data-home-product-slot data-product-card="{{ $product['slug'] }}">
    <figure class="home-product-media">
        <div class="home-product-image-frame"><img src="{{ $product['screenshots'][0]['src'] }}" alt="{{ $product['screenshots'][0]['alt'] }}" width="1440" height="1000" loading="lazy"></div>
        @if($product['slug'] === 'foodshop')
            <figcaption>GyrosCity — a FoodShop éles előzménye.</figcaption>
        @else
            <figcaption>{{ $product['visual_title'] }}</figcaption>
        @endif
    </figure>
    <div class="home-product-copy">
        <div class="home-product-heading">
            <span class="product-symbol" aria-hidden="true">{{ $product['symbol'] }}</span>
            <div><h3>{{ $product['name'] }}</h3><p>{{ $product['audience'] }}</p></div>
        </div>
        <span class="status-badge">{{ $product['status_label'] }}</span>
        <p>{{ $product['summary'] }}</p>
        <a class="text-link" href="{{ route('products.show', $product['slug']) }}">Megismerem <span aria-hidden="true">→</span></a>
    </div>
</article>
