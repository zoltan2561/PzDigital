@props(['product', 'featured' => false])
<article data-product-card="{{ $product['slug'] }}" @class(['product-card', 'product-card-featured' => $featured, 'accent-green' => $product['accent'] === 'green'])>
    <div class="product-card-copy">
        <div class="product-heading">
            <span class="product-symbol">{{ $product['symbol'] }}</span>
            <div><h3>{{ $product['name'] }}</h3><p>{{ $product['audience'] }}</p></div>
        </div>
        <span class="status-badge">{{ $product['status_label'] }}</span>
        <p>{{ $product['summary'] }}</p>
        <ul class="check-list">
            @foreach($product['benefits'] as $benefit)<li>{{ $benefit }}</li>@endforeach
        </ul>
        <div class="product-card-actions"><a class="text-link" href="{{ route('products.show', $product['slug']) }}">Részletes bemutató <span aria-hidden="true">→</span></a><a class="button button-small" href="{{ route('demo.request', ['termek' => $product['slug']]) }}">Demóhozzáférést kérek</a><a class="text-link" href="{{ route('contact', ['erdeklodes' => $product['slug'], 'ajanlat' => 1]) }}">Árajánlatot kérek</a></div>
        @if(! empty($product['demo_url']))<a class="product-demo-url" href="{{ $product['demo_url'] }}" target="_blank" rel="noopener noreferrer"><span>{{ $product['demo_label'] ?? 'Nyilvános bemutató' }} · azonnal megnyitható</span><strong>{{ $product['demo_url'] }}</strong><span aria-hidden="true">↗</span></a>@endif
    </div>
    <x-marketing.product-visual :product="$product" compact />
</article>
