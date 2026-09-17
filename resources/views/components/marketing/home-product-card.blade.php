@props(['product'])
<article class="home-product-card accent-{{ $product['accent'] }}" data-home-product-slot data-product-card="{{ $product['slug'] }}">
    <figure class="home-product-media">
        <div class="product-media-heading"><span>{{ $product['screenshots'][0]['label'] }}</span><x-marketing.icon name="globe" /></div>
        <a class="home-product-image-frame" href="{{ route('products.show', $product['slug']) }}" aria-label="{{ $product['name'] }} képes bemutatója"><img src="{{ $product['screenshots'][0]['src'] }}" alt="{{ $product['screenshots'][0]['alt'] }}" width="1440" height="1000" loading="lazy"></a>
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
        <ul class="home-product-benefits">
            @foreach(array_slice($product['benefits'], 0, 3) as $benefit)
                <li>{{ $benefit }}</li>
            @endforeach
        </ul>
        <div class="home-product-actions">
            <a class="text-link" href="{{ route('products.show', $product['slug']) }}" aria-label="{{ $product['name'] }} termékbemutató">Termékbemutató <span aria-hidden="true">→</span></a>
            <a class="button button-dark-outline" href="{{ route('contact', ['erdeklodes' => $product['slug']]) }}">{{ $product['primary_cta'] }}</a>
        </div>
    </div>
</article>
