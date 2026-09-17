@props(['block'])
<section id="attekintes" class="case-section case-overview">
    <div class="container case-split">
        <div><span class="eyebrow">Felület és háttér</span><h2>{{ $block['heading'] }}</h2></div>
        <div class="case-two-sides">
            <article><span>01</span><h3>Amit a látogató lát</h3><p>{{ $block['public_side'] }}</p></article>
            <article><span>02</span><h3>Ami mögötte történik</h3><p>{{ $block['admin_side'] }}</p></article>
        </div>
    </div>
</section>
