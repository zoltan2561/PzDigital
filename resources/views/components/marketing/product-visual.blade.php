@props(['product', 'compact' => false])
<div @class(['product-visual', 'product-visual-compact' => $compact, 'accent-green' => $product['accent'] === 'green']) aria-label="{{ $product['name'] }} felület látványterv">
    <div class="visual-label">Látványterv</div>
    <div class="browser-bar"><i></i><i></i><i></i><span>app.{{ $product['slug'] }}.hu</span></div>
    <div class="app-frame">
        <aside>
            <strong>{{ $product['name'] }}</strong>
            <span class="nav-pill active"></span>
            <span class="nav-pill"></span>
            <span class="nav-pill short"></span>
            <span class="nav-pill"></span>
        </aside>
        <div class="app-content">
            <div class="app-top"><b>{{ $product['slug'] === 'szervizpro' ? 'Munkalapok' : 'Rendelések' }}</b><span></span></div>
            <div class="stat-row"><i></i><i></i><i></i></div>
            <div class="data-card">
                @foreach(range(1, 4) as $row)
                    <div class="data-row"><span></span><span></span><em></em></div>
                @endforeach
            </div>
        </div>
    </div>
</div>
