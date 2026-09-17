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
            <div><h3>{{ $placeholder['name'] }}</h3><p>{{ $placeholder['audience'] }}</p></div>
        </div>
        <span class="status-badge status-badge-muted">{{ $placeholder['status_label'] }}</span>
        <p>{{ $placeholder['summary'] }}</p>
        <span class="placeholder-status" aria-label="Nem kattintható állapot">Részletek később</span>
    </div>
</article>
