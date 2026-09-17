@extends('layouts.marketing')

@section('content')
<section class="hero company-hero motion-hero" data-motion-hero>
    <div class="hero-glow"></div>
    <div class="container hero-grid motion-hero-grid">
        <div class="hero-copy" data-hero-copy>
            <span class="eyebrow eyebrow-light">PZ Digital · Szoftverfejlesztés</span>
            <h1>Weboldalak.<br><span>Rendszerek.</span><br>Automatizációk.</h1>
            <p>Nem csak a felületet készítjük el. A mögötte működő folyamatokat is megtervezzük és összekapcsoljuk.</p>
            <div class="button-row">
                <a class="button" href="{{ route('contact', ['erdeklodes' => 'custom_development']) }}">Beszéljünk a projektedről <span aria-hidden="true">→</span></a>
                <a class="button button-outline" href="#munkaink">Megnézem a munkákat</a>
            </div>
            <p class="hero-proof">Felület <span aria-hidden="true">→</span> üzleti logika <span aria-hidden="true">→</span> követhető működés</p>
        </div>
        <x-marketing.hero-stage :projects="$projects" />
    </div>
</section>

<section class="section section-services" id="szolgaltatasok">
    <div class="container">
        <div class="section-heading"><div><span class="eyebrow">Miben segítünk?</span><h2>Digitális megoldások, érthető üzleti céllal</h2></div><p>A megfelelő eszközt a működési problémához választjuk, majd követhetően végigvisszük a megvalósítást.</p></div>
        <div class="service-rows">
            <article><span>01</span><h3>Céges weboldalak</h3><p>A vállalkozásodhoz illő bemutatkozás, áttekinthető szolgáltatások és egyszerű kapcsolatfelvétel.</p><a href="{{ route('services') }}#weboldalak">Részletek <span aria-hidden="true">→</span></a></article>
            <article><span>02</span><h3>Egyedi üzleti rendszerek</h3><p>A működésedhez illeszkedő webes alkalmazás, a szükséges kezelőfelületekkel és jogosultságokkal.</p><a href="{{ route('services') }}#rendszerek">Részletek <span aria-hidden="true">→</span></a></article>
            <article><span>03</span><h3>Integrációk és automatizálás</h3><p>Rendszereid összekapcsolása, hogy kevesebb adatot kelljen kézzel mozgatni.</p><a href="{{ route('services') }}#integraciok">Részletek <span aria-hidden="true">→</span></a></article>
        </div>
    </div>
</section>

<x-marketing.project-story :projects="$projects" />

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
            <li><span>1</span><h3>Megértjük a feladatot</h3><p>Átbeszéljük a célt, a jelenlegi működést és a legfontosabb igényt.</p><small>Igények és prioritások</small></li>
            <li><span>2</span><h3>Rögzítjük a kereteket</h3><p>Tisztázzuk, mi készül el és mi tartozik az adott szakaszba.</p><small>Egyeztetett feladat és ajánlat</small></li>
            <li><span>3</span><h3>Bemutatjuk és teszteljük</h3><p>A megbeszélt pontokon működő változatot mutatunk, amelyre visszajelezhetsz.</p><small>Bemutatható változat és visszajelzés</small></li>
            <li><span>4</span><h3>Átadjuk a megoldást</h3><p>A használatba vétel és az átadás feltételeit is egyértelműen rögzítjük.</p><small>Átadás és következő lépések</small></li>
        </ol>
    </div>
</section>

<section class="section company-benefits-section">
    <div class="container proof-grid">
        <div>
            <span class="eyebrow">Miért PZ Digital?</span>
            <h2>Közvetlen egyeztetés. Átlátható fejlesztés.</h2>
            <p>A feladatot azzal beszéled át, aki a megoldáson dolgozik. A cél, a vállalt keretek és a következő döntési pont végig követhető marad.</p>
            <a class="text-link" href="{{ route('about') }}">A PZ Digitalról <span>→</span></a>
        </div>
        <div class="trust-profile">
            <span class="brand-mark trust-monogram" aria-hidden="true">PZ</span>
            <div><span class="eyebrow">Szakmai háttér</span><h3>Laravel, PHP és webes rendszerek</h3><p>Saját üzleti termékeken és körülhatárolt egyedi fejlesztéseken szerzett tapasztalat, a felméréstől a tesztelt átadásig.</p></div>
        </div>
    </div>
</section>

<section class="section section-faq faq-section">
    <div class="container narrow">
        <div class="section-heading"><div><span class="eyebrow">Gyakori kérdések</span><h2>Az első egyeztetés előtt</h2></div></div>
        <div class="faq-list">
            <details><summary>Kész műszaki specifikációval kell érkeznem?</summary><p>Nem. Elég leírnod a célt és azt, mi nem működik most jól; a szükséges kereteket az egyeztetés során pontosítjuk.</p></details>
            <details><summary>Meglévő rendszer továbbfejlesztéséről is egyeztethetünk?</summary><p>Erről is egyeztethetünk. A jelenlegi rendszer és a kívánt változás rövid áttekintése után meg tudjuk mondani, vállalható-e a feladat és mi legyen a következő lépés.</p></details>
            <details><summary>Hogyan indul egy új projekt?</summary><p>Röviden megismerjük a célt és a jelenlegi működést, majd kijelöljük az első ellenőrizhető eredményt és a szükséges döntéseket.</p></details>
            <details><summary>Hogyan alakul ki a költség?</summary><p>A feladat, az átadandó eredmény, a szükséges integrációk és a támogatási keret felmérése után készülhet felelős ajánlat.</p></details>
            <details><summary>Mi történik az átadás után?</summary><p>A támogatás és a további fejlesztés konkrét keretét az ajánlatban és az átadáskor rögzítjük.</p></details>
        </div>
    </div>
</section>

<x-marketing.contact-cta title="Van egy projekt, amit érdemes lenne egyszerűbben megoldani?" />
@endsection
