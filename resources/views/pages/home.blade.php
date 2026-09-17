@extends('layouts.marketing')

@section('content')
<section class="hero company-home-hero motion-hero" data-motion-hero>
    <div class="hero-glow"></div>
    <div class="container company-home-hero-grid">
        <div class="hero-copy" data-hero-copy>
            <span class="eyebrow eyebrow-light">PZ Digital · Szoftverfejlesztés</span>
            <h1>Fejlesztési partner a vállalkozásod mellé.</h1>
            <p>Céges weboldalakat, egyedi üzleti rendszereket és saját szoftvermegoldásokat készítünk. A feladat megértésétől a működő megoldásig.</p>
            <div class="button-row">
                <a class="button" href="{{ route('contact', ['erdeklodes' => 'other']) }}">Beszéljünk a projektedről <span aria-hidden="true">→</span></a>
                <a class="button button-outline" href="#megoldasok">Saját megoldásaink</a>
            </div>
        </div>
        <x-marketing.company-system-visual />
    </div>
</section>

<div class="capability-strip" aria-label="Kiemelt képességek">
    <div class="container">
        <span>Egyedi fejlesztés</span><i aria-hidden="true"></i>
        <span>Saját szoftverek</span><i aria-hidden="true"></i>
        <span>Rendszerintegráció</span>
    </div>
</div>

<section class="section section-services" id="szolgaltatasok" data-home-reveal>
    <div class="container">
        <div class="section-heading"><div><span class="eyebrow">Miben segítünk?</span><h2>Három terület, egy átgondolt megoldás</h2></div><p>Az üzleti céltól indulunk, és ahhoz választjuk meg a megfelelő webes eszközöket.</p></div>
        <div class="service-rows">
            <article><span>01</span><h3>Céges weboldalak</h3><p>A vállalkozásodhoz illő bemutatkozás, áttekinthető szolgáltatások és egyszerű kapcsolatfelvétel.</p><a href="{{ route('services') }}#weboldalak">Részletek <span aria-hidden="true">→</span></a></article>
            <article><span>02</span><h3>Egyedi üzleti rendszerek</h3><p>A napi működéshez igazított webes alkalmazások, kezelőfelületek és jogosultságok.</p><a href="{{ route('services') }}#rendszerek">Részletek <span aria-hidden="true">→</span></a></article>
            <article><span>03</span><h3>Integrációk és automatizálás</h3><p>Meglévő rendszerek összekapcsolása és az ismétlődő feladatok egyszerűsítése.</p><a href="{{ route('services') }}#integraciok">Részletek <span aria-hidden="true">→</span></a></article>
        </div>
    </div>
</section>

<section id="megoldasok" class="section section-products home-products-section" data-home-reveal>
    <div class="container">
        <div class="section-heading">
            <div><span class="eyebrow">Saját termékeink</span><h2>Megoldások valós működési helyzetekre</h2></div>
            <div class="section-heading-action"><p>Két bemutatható irány és egy tudatosan jelölt következő termékhely — mindig a tényleges készültségi állapottal.</p><a class="text-link" href="{{ route('products.index') }}">Összes termék <span aria-hidden="true">→</span></a></div>
        </div>
        <div @class(['home-products-grid', 'is-two-up' => ! $productPlaceholder])>
            @foreach($products as $product)
                <x-marketing.home-product-card :product="$product" />
            @endforeach
            @if($productPlaceholder)
                <x-marketing.product-placeholder :placeholder="$productPlaceholder" />
            @endif
        </div>
    </div>
</section>

<section class="section section-process home-process-section" data-home-reveal>
    <div class="container">
        <div class="section-heading"><div><span class="eyebrow">Hogyan dolgozunk?</span><h2>Négy követhető lépés</h2></div><a class="text-link" href="{{ route('process') }}">A teljes folyamatról <span aria-hidden="true">→</span></a></div>
        <ol class="process-grid">
            <li><span>1</span><h3>Igényfelmérés</h3><p>A cél, a jelenlegi működés és a prioritások tisztázása.</p><small>Egyeztetett igények</small></li>
            <li><span>2</span><h3>Tervezés és specifikáció</h3><p>A megoldás és a feladat kereteinek rögzítése.</p><small>Megoldási terv és feladatkör</small></li>
            <li><span>3</span><h3>Fejlesztés és bemutatás</h3><p>Bemutatható változatok, visszajelzés és ellenőrzés.</p><small>Követhető fejlesztési állapot</small></li>
            <li><span>4</span><h3>Átadás és továbbfejlesztés</h3><p>A használatba vétel és a következő lépések egyeztetése.</p><small>Átadás és további lehetőségek</small></li>
        </ol>
    </div>
</section>

<section class="section company-principles-section" data-home-reveal>
    <div class="container principles-layout">
        <div class="principles-intro">
            <span class="eyebrow">Miért PZ Digital?</span>
            <h2>Átlátható együttműködés. Átgondolt megvalósítás.</h2>
            <p>A feladatot a működési célból indítjuk, a döntési pontokat pedig végig érthetően tartjuk.</p>
            <a class="text-link" href="{{ route('about') }}">A PZ Digitalról <span aria-hidden="true">→</span></a>
        </div>
        <div class="principles-list">
            <article><span>01</span><div><h3>Üzleti szemlélet</h3><p>A feladatot a működési célból indítjuk, nem egy előre kiválasztott eszközből.</p></div></article>
            <article><span>02</span><div><h3>Egyeztetett keretek</h3><p>Világos marad, mi készül el, mi a következő lépés és miről kell dönteni.</p></div></article>
            <article><span>03</span><div><h3>Rendszerszintű gondolkodás</h3><p>A felületet, a mögöttes logikát és a kapcsolódásokat együtt tervezzük.</p></div></article>
            <article><span>04</span><div><h3>Továbbfejleszthető megoldások</h3><p>Az átadás utáni bővítés és együttműködés lehetőségeit is figyelembe vesszük.</p></div></article>
        </div>
    </div>
</section>

@if($showReferences && $projects->isNotEmpty())
<section class="compact-references" id="referenciak" data-home-reveal>
    <div class="container compact-references-inner">
        <div><span class="eyebrow eyebrow-light">Referenciák</span><h2>Nézd meg, min dolgoztunk.</h2><p>Weboldalak, üzleti felületek és automatizált megoldások a gyakorlatban.</p></div>
        <div class="compact-reference-links">
            @foreach($projects->take(3) as $project)
                <a href="{{ route('projects.show', $project['slug']) }}"><span>{{ $project['showcase_label'] }}</span><strong>{{ $project['name'] }}</strong><b aria-hidden="true">→</b></a>
            @endforeach
            <a class="compact-reference-all" href="{{ route('projects.index') }}">Munkáink megtekintése <span aria-hidden="true">→</span></a>
        </div>
    </div>
</section>
@endif

<section class="section section-faq faq-section" data-home-reveal>
    <div class="container narrow">
        <div class="section-heading"><div><span class="eyebrow">Gyakori kérdések</span><h2>Az első egyeztetés előtt</h2></div></div>
        <div class="faq-list">
            <details><summary>Kész műszaki specifikációval kell érkeznem?</summary><p>Nem. Elég leírnod a célt és azt, mi nem működik most jól; a szükséges kereteket az egyeztetés során pontosítjuk.</p></details>
            <details><summary>Meglévő rendszer továbbfejlesztéséről is egyeztethetünk?</summary><p>Erről is egyeztethetünk. A jelenlegi rendszer és a kívánt változás rövid áttekintése után meg tudjuk mondani, vállalható-e a feladat és mi legyen a következő lépés.</p></details>
            <details><summary>Hogyan indul egy új projekt?</summary><p>Röviden megismerjük a célt és a jelenlegi működést, majd kijelöljük az első ellenőrizhető eredményt és a szükséges döntéseket.</p></details>
            <details><summary>Hogyan alakul ki a költség?</summary><p>A feladat, az átadandó eredmény, a szükséges integrációk és a támogatási keret felmérése után készülhet felelős ajánlat.</p></details>
        </div>
    </div>
</section>

<x-marketing.contact-cta title="Van egy projekt, amit érdemes lenne egyszerűbben megoldani?" />
@endsection
