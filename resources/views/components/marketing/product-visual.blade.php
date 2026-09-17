@props(['product', 'compact' => false])
@if(! empty($product['screenshots']))
    <figure @class(['product-visual', 'product-visual-real', 'product-visual-compact' => $compact, 'accent-green' => $product['accent'] === 'green'])>
        <div class="visual-label visual-label-verified"><span></span>{{ $product['visual_label'] }}</div>
        <div class="browser-bar"><i></i><i></i><i></i><span>{{ $product['visual_title'] }}</span></div>
        <div class="product-screen">
            <img src="{{ $product['screenshots'][0]['src'] }}" alt="{{ $product['screenshots'][0]['alt'] }}" width="1440" height="1000" @if($compact) loading="lazy" @else fetchpriority="high" @endif>
        </div>
    </figure>
@else
    <div @class(['product-visual', 'product-visual-compact' => $compact, 'accent-green' => $product['accent'] === 'green']) aria-label="{{ $product['name'] }} felület látványterv">
        <div class="visual-label">Koncepció</div>
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
                <div class="app-top"><b>Felület</b><span></span></div>
                <div class="stat-row"><i></i><i></i><i></i></div>
                <div class="data-card">
                    @foreach(range(1, 4) as $row)
                        <div class="data-row"><span></span><span></span><em></em></div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endif
