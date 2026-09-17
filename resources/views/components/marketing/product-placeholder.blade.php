@props(['placeholder'])
<article class="home-product-card home-product-placeholder" data-home-product-slot data-product-placeholder>
    <div class="placeholder-visual" aria-hidden="true">
        <span class="placeholder-monogram">PZ</span>
        <span class="placeholder-line"></span>
        <span class="placeholder-orbit"></span>
    </div>
    <div class="home-product-copy">
        <div class="home-product-heading">
            <span class="product-symbol" aria-hidden="true">＋</span>
            <div><h3>{{ $placeholder['name'] }}</h3></div>
        </div>
        <p>{{ $placeholder['summary'] }}</p>
    </div>
</article>
