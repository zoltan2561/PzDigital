@extends('layouts.marketing')

@section('content')
<section class="hero">
    <div class="hero-glow"></div>
    <div class="container hero-grid">
        <div class="hero-copy">
            <span class="eyebrow eyebrow-light">Saját termékek. Egyedi fejlesztés. Átlátható együttműködés.</span>
            <h1>Üzleti szoftverek, amelyek egyszerűbbé teszik a <span>működésed.</span></h1>
            <p>Céges weboldalakat, egyedi webes rendszereket és saját üzleti megoldásokat készítünk. Az igényfelméréstől a bevezetésig átlátható folyamatban dolgozunk.</p>
            <div class="button-row">
                <a class="button" href="#megoldasok">Megnézem a megoldásokat <span aria-hidden="true">→</span></a>
                <a class="button button-outline" href="{{ route('contact', ['erdeklodes' => 'custom_development']) }}">Egyedi fejlesztésről egyeztetnék</a>
            </div>
            <div class="hero-points">
                <span><x-marketing.icon name="code" /> Laravel alapú fejlesztés</span>
                <span><x-marketing.icon name="flow" /> Átlátható folyamat</span>
                <span><x-marketing.icon name="shield" /> Dokumentált átadás</span>
            </div>
        </div>
        <div class="hero-visual-wrap">
            <x-marketing.product-visual :product="$products['szervizpro']" />
            <p class="visual-note">A végleges képernyőképet jóváhagyott termékfotó váltja.</p>
        </div>
    </div>
</section>

<section id="megoldasok" class="section">
    <div class="container">
        <div class="section-heading">
            <div><span class="eyebrow">Saját termékeink</span><h2>Megoldások valós üzleti folyamatokra</h2></div>
            <p>A termékek részletes oldala világosan jelzi a jelenlegi állapotot, és nem ígér nem ellenőrzött funkciókat.</p>
        </div>
        <div class="products-grid">
            @foreach($products as $product)
                <x-marketing.product-card :product="$product" :featured="$loop->first" />
            @endforeach
        </div>
    </div>
</section>

<section class="section section-soft">
    <div class="container">
        <div class="section-heading"><div><span class="eyebrow">Szolgáltatásaink</span><h2>Fejlesztés a céltól az átadásig</h2></div><p>A megfelelő eszközt a működési problémához választjuk, nem fordítva.</p></div>
        <div class="service-grid">
            <article class="service-card"><span class="icon-box"><x-marketing.icon name="globe" /></span><h3>Céges weboldalak</h3><p>Gyors, könnyen használható és keresőbarát weboldal, amely érthetően mutatja be a vállalkozást.</p><a href="{{ route('services') }}#weboldalak" aria-label="Céges weboldalak részletei">→</a></article>
            <article class="service-card"><span class="icon-box"><x-marketing.icon name="code" /></span><h3>Egyedi üzleti rendszerek</h3><p>A napi munkához illesztett webes eszköz, tiszta felelősségi és átadási keretekkel.</p><a href="{{ route('services') }}#rendszerek" aria-label="Egyedi üzleti rendszerek részletei">→</a></article>
            <article class="service-card"><span class="icon-box"><x-marketing.icon name="flow" /></span><h3>Integrációk és automatizálás</h3><p>A kézi adatmozgatás és ismétlődő lépések csökkentése ellenőrizhető folyamatokkal.</p><a href="{{ route('services') }}#integraciok" aria-label="Integrációk részletei">→</a></article>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="section-heading"><div><span class="eyebrow">Hogyan dolgozunk?</span><h2>Négy érthető lépés</h2></div><a class="text-link" href="{{ route('process') }}">A teljes folyamatról <span>→</span></a></div>
        <ol class="process-grid">
            <li><span>1</span><h3>Megértjük a feladatot</h3><p>Átbeszéljük a célokat, a jelenlegi működést és a valódi korlátokat.</p></li>
            <li><span>2</span><h3>Rögzítjük a kereteket</h3><p>Leírjuk, mi készül el, hogyan ellenőrizzük és mi nem része a feladatnak.</p></li>
            <li><span>3</span><h3>Bemutatjuk és teszteljük</h3><p>Követhető részekben haladunk, rendszeres visszajelzési pontokkal.</p></li>
            <li><span>4</span><h3>Bevezetjük és átadjuk</h3><p>A működő megoldás mellé dokumentáció és egyeztetett támogatás kerül.</p></li>
        </ol>
    </div>
</section>

<section class="section section-soft">
    <div class="container proof-grid">
        <div>
            <span class="eyebrow">Miért PZ Digital?</span>
            <h2>Átlátható fejlesztés, tiszta következő lépések</h2>
            <p>Nem kész funkciólistával kezdünk, hanem azzal a folyamattal, amin javítani szeretnél. A döntéseket, a határokat és az átadást is dokumentáljuk.</p>
            <a class="text-link" href="{{ route('about') }}">Ismerd meg a szemléletünket <span>→</span></a>
        </div>
        <div class="values-grid">
            <article><x-marketing.icon name="chart" /><h3>Üzleti szemlélet</h3><p>A fejlesztési döntéseket a használati cél vezeti.</p></article>
            <article><x-marketing.icon name="flow" /><h3>Testreszabott keretek</h3><p>A vállalt tartalom előre látható és ellenőrizhető.</p></article>
            <article><x-marketing.icon name="shield" /><h3>Stabil alapok</h3><p>Karbantartható technológia és dokumentált működés.</p></article>
            <article><x-marketing.icon name="people" /><h3>Közvetlen egyeztetés</h3><p>A kérdésekhez konkrét felelős és válasz tartozik.</p></article>
        </div>
    </div>
</section>

<section class="section faq-section">
    <div class="container narrow">
        <div class="section-heading"><div><span class="eyebrow">Gyakori kérdések</span><h2>Amire az első egyeztetés előtt érdemes válaszolni</h2></div></div>
        <div class="faq-list">
            <details><summary>Kész terméket vagy egyedi fejlesztést érdemes választanom?</summary><p>Ha a SzervizPRO vagy FoodShop tervezett folyamata közel áll a működésedhez, érdemes azzal kezdeni. Eltérő igénynél az első egyeztetés tisztázza, hogy konfiguráció vagy önálló fejlesztés szükséges.</p></details>
            <details><summary>Hogyan zajlik egy bemutató?</summary><p>Röviden megismerjük a jelenlegi folyamatodat, majd az ahhoz kapcsolódó, ellenőrzött felületeket mutatjuk meg. A bemutató nem jelent automatikus megrendelést.</p></details>
            <details><summary>Hogyan alakul ki a költség?</summary><p>A feladat, az átadandó eredmény, a szükséges integrációk és a támogatási keret felmérése után készülhet felelős ajánlat.</p></details>
        </div>
    </div>
</section>

<x-marketing.contact-cta />
@endsection
