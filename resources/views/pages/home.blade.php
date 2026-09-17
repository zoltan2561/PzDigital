@extends('layouts.marketing')

@section('content')
<section class="hero company-hero">
    <div class="hero-glow"></div>
    <div class="container hero-grid company-hero-grid">
        <div class="hero-copy">
            <span class="eyebrow eyebrow-light">PZ Digital · Szoftverfejlesztés</span>
            <h1>Weboldalak és rendszerek, a <span>vállalkozásodra szabva.</span></h1>
            <p>Egyedi weboldalakat, üzleti alkalmazásokat és saját szoftvermegoldásokat fejlesztünk. A céges bemutatkozástól a rendelési és ügyviteli folyamatokig.</p>
            <div class="button-row">
                <a class="button" href="{{ route('contact', ['erdeklodes' => 'custom_development']) }}">Beszéljünk a projektedről <span aria-hidden="true">→</span></a>
                <a class="button button-outline" href="#munkaink">Megnézem a munkákat</a>
            </div>
            <div class="hero-points">
                <span><x-marketing.icon name="globe" /> Céges weboldalak</span>
                <span><x-marketing.icon name="code" /> Üzleti rendszerek</span>
                <span><x-marketing.icon name="flow" /> Integrációk</span>
            </div>
        </div>

        <div class="hero-projects" aria-label="Válogatás a PZ Digital munkáiból és termékeiből">
            @foreach($projects->take(2) as $project)
                <a @class(['hero-project-card', 'hero-project-card-main' => $loop->first, 'hero-project-card-secondary' => ! $loop->first]) href="{{ route('projects.show', $project['slug']) }}">
                    <img src="{{ $project['media'][0]['src'] }}" alt="{{ $project['media'][0]['alt'] }}" width="1440" height="1000" @if($loop->first) fetchpriority="high" @endif>
                    <span><small>Referenciamunka</small><strong>{{ $project['name'] }}</strong></span>
                </a>
            @endforeach
            @if($products->isNotEmpty())
                @php($heroProduct = $products->first())
                <a class="hero-project-card hero-project-card-product" href="{{ route('products.show', $heroProduct['slug']) }}">
                    <img src="{{ $heroProduct['screenshots'][0]['src'] }}" alt="{{ $heroProduct['screenshots'][0]['alt'] }}" width="1440" height="1000">
                    <span><small>Saját termék</small><strong>{{ $heroProduct['name'] }}</strong></span>
                </a>
            @endif
        </div>
    </div>
</section>

<section class="section section-services" id="szolgaltatasok">
    <div class="container">
        <div class="section-heading"><div><span class="eyebrow">Miben segítünk?</span><h2>Digitális megoldások, érthető üzleti céllal</h2></div><p>A megfelelő eszközt a működési problémához választjuk, majd követhetően végigvisszük a megvalósítást.</p></div>
        <div class="service-grid">
            <article class="service-card"><span class="icon-box"><x-marketing.icon name="globe" /></span><h3>Céges weboldalak</h3><p>Gyors és könnyen használható weboldal, amely hitelesen mutatja be a vállalkozást és egyértelmű következő lépést ad.</p><a href="{{ route('services') }}#weboldalak" aria-label="Céges weboldalak részletei">→</a></article>
            <article class="service-card"><span class="icon-box"><x-marketing.icon name="code" /></span><h3>Egyedi üzleti rendszerek</h3><p>A napi munkához illesztett alkalmazás, amely egy helyre rendezi az adatokat, feladatokat és ügyfélfolyamatokat.</p><a href="{{ route('services') }}#rendszerek" aria-label="Egyedi üzleti rendszerek részletei">→</a></article>
            <article class="service-card"><span class="icon-box"><x-marketing.icon name="flow" /></span><h3>Integrációk és automatizálás</h3><p>Kevesebb ismétlődő kézi lépés és megbízhatóbb adatáramlás a már használt rendszerek között.</p><a href="{{ route('services') }}#integraciok" aria-label="Integrációk részletei">→</a></article>
        </div>
    </div>
</section>

<section id="munkaink" class="section section-projects-dark">
    <div class="container">
        <div class="section-heading">
            <div><span class="eyebrow">Munkáink</span><h2>Válogatott munkáink</h2></div>
            <div class="section-heading-action"><p>Korábbi és jelenlegi munkák a PZ Digital mögötti fejlesztői tapasztalatból.</p><a class="text-link" href="{{ route('projects.index') }}">Összes referencia <span>→</span></a></div>
        </div>
        <div class="project-grid">
            @foreach($projects as $project)
                <x-marketing.project-card :project="$project" />
            @endforeach
        </div>
    </div>
</section>

<section id="megoldasok" class="section section-products">
    <div class="container">
        <div class="section-heading">
            <div><span class="eyebrow">Saját termékeink</span><h2>Saját szoftvermegoldásaink</h2></div>
            <div class="section-heading-action"><p>Minden terméknél külön jelezzük, mi működő demó és mi áll még előkészítés alatt.</p><a class="text-link" href="{{ route('products.index') }}">Összes termék <span>→</span></a></div>
        </div>
        <div class="products-grid">
            @foreach($products as $product)
                <x-marketing.product-card :product="$product" />
            @endforeach
        </div>
    </div>
</section>

<section class="section section-process">
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

<section class="section company-benefits-section">
    <div class="container proof-grid">
        <div>
            <span class="eyebrow">Miért PZ Digital?</span>
            <h2>Érthető üzleti célok, professzionális megvalósítás</h2>
            <p>Nem technológiai listával kezdünk, hanem azzal, min szeretnél javítani. A döntéseket, a vállalt kereteket és a következő lépést végig tisztán tartjuk.</p>
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

<section class="section section-faq faq-section">
    <div class="container narrow">
        <div class="section-heading"><div><span class="eyebrow">Gyakori kérdések</span><h2>Az első egyeztetés előtt</h2></div></div>
        <div class="faq-list">
            <details><summary>Kész terméket vagy egyedi fejlesztést érdemes választanom?</summary><p>Ha egy saját termékünk folyamata közel áll a működésedhez, érdemes azzal kezdeni. Eltérő igénynél az első egyeztetés tisztázza, hogy konfiguráció vagy önálló fejlesztés szükséges.</p></details>
            <details><summary>Hogyan indul egy új projekt?</summary><p>Röviden megismerjük a célt és a jelenlegi működést, majd kijelöljük az első ellenőrizhető eredményt és a szükséges döntéseket.</p></details>
            <details><summary>Hogyan alakul ki a költség?</summary><p>A feladat, az átadandó eredmény, a szükséges integrációk és a támogatási keret felmérése után készülhet felelős ajánlat.</p></details>
        </div>
    </div>
</section>

<x-marketing.contact-cta title="Van egy projekt, amit érdemes lenne egyszerűbben megoldani?" />
@endsection
