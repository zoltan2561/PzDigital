@extends('layouts.marketing')
@php($heroProducts = collect(['foodpro', 'szervizpro'])->map(fn ($slug) => $products->firstWhere('slug', $slug))->filter())
@php($title = $heroProducts->count() === 2 ? 'SzoftLab – FoodPro és SzervizPro üzleti rendszerek' : 'SzoftLab – Egyedi üzleti rendszerek')
@php($description = $heroProducts->count() === 2 ? 'FoodPro éttermeknek, SzervizPro autószervizeknek. Nézd meg saját rendszereinket és az egyedi fejlesztési lehetőségeket.' : 'Egyedi üzleti rendszerek a napi működéshez. Nézd meg az elérhető megoldásainkat, vagy beszéljük át a feladatodat.')

@section('content')
<section class="hero company-home-hero">
    <div class="hero-orbit" aria-hidden="true"></div>
    <div @class(['container', 'company-home-hero-grid', 'has-showcase' => $heroProducts->isNotEmpty()])>
        <div class="hero-copy">
            <span class="eyebrow eyebrow-light hero-eyebrow"><span class="brand-dot" aria-hidden="true"></span> {{ $heroProducts->isNotEmpty() ? 'SzoftLab saját termékek' : 'SzoftLab üzleti rendszerek' }}</span>
            @if($heroProducts->count() === 2)
                <h1>Két kész rendszer. <span>Valós napi feladatokra.</span></h1>
                <p>A FoodPro az éttermi rendeléseket, a SzervizPro a műhelymunkát rendezi egy felületre. Nézd meg a bemutatókat, vagy mondd el, milyen egyedi megoldásra van szükséged.</p>
            @else
                <h1>Szoftver, ami rendet tesz <span>a napi munkában.</span></h1>
                <p>Megértjük, hol akad el a munkád, majd megépítjük a hozzá illő rendszert. Nézd meg az elérhető megoldásainkat, vagy beszéljük át az egyedi feladatodat.</p>
            @endif
            <div class="button-row">
                @if($heroProducts->isNotEmpty())
                    <a class="button" href="#megoldasok">Megnézem a termékeket <span aria-hidden="true">↓</span></a>
                    <a class="button button-outline" href="{{ route('contact', ['erdeklodes' => 'other']) }}">Beszéljünk a feladatról <span aria-hidden="true">→</span></a>
                @else
                    <a class="button" href="{{ route('contact', ['erdeklodes' => 'other']) }}">Beszéljünk a feladatról <span aria-hidden="true">→</span></a>
                    <a class="button button-outline" href="#szolgaltatasok">Miben segítünk? <span aria-hidden="true">↓</span></a>
                @endif
            </div>
            @if($heroProducts->count() === 2)
                <p class="hero-support">FoodPro éttermeknek · SzervizPro autószervizeknek</p>
            @endif
        </div>
        @if($heroProducts->isNotEmpty())
            <div class="hero-showcase" data-hero-showcase>
                <div class="showcase-label"><span class="showcase-dot" aria-hidden="true"></span> Saját szoftvereink</div>
                <div class="hero-product-stack">
                    @foreach($heroProducts as $product)
                        <a class="hero-product-feature accent-{{ $product['accent'] }}" href="{{ route('products.show', $product['slug']) }}" data-hero-product="{{ $product['slug'] }}" aria-label="{{ $product['name'] }} termékbemutató">
                            <span class="hero-product-feature-copy"><small>{{ $product['audience'] }}</small><strong>{{ $product['name'] }}</strong><span>{{ $product['headline'] }}</span><b>Termékbemutató <span aria-hidden="true">↗</span></b></span>
                            <span class="hero-product-feature-image"><img src="{{ $product['screenshots'][0]['src'] }}" alt="{{ $product['screenshots'][0]['alt'] }}" width="{{ $product['screenshots'][0]['width'] ?? 1440 }}" height="{{ $product['screenshots'][0]['height'] ?? 1000 }}" @if($loop->first) fetchpriority="high" @else loading="lazy" @endif></span>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</section>

<section id="megoldasok" class="section section-products home-products-section" data-home-reveal>
    <div class="container">
        <div class="section-heading">
            <div><span class="eyebrow">{{ $heroProducts->count() === 2 ? 'FoodPro és SzervizPro' : 'Saját termékeink' }}</span><h2>{{ $heroProducts->count() === 2 ? 'Ismerd meg a két rendszert' : 'Ismerd meg a rendszereinket' }}</h2></div>
            <div class="section-heading-action"><p>Nézd meg a képernyőket és a funkciókat, majd kérj demóhozzáférést a számodra érdekes termékhez.</p><a class="text-link" href="{{ route('products.index') }}">Összes termék <span aria-hidden="true">→</span></a></div>
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

@if($showReferences && $projects->isNotEmpty())
<section class="compact-references" id="referenciak" data-home-reveal>
    <div class="container compact-references-inner">
        <div><span class="eyebrow eyebrow-light">Referenciák</span><h2>Nézd meg, min dolgoztunk.</h2><p>Weboldalak, üzleti felületek és automatizált megoldások a gyakorlatban.</p></div>
        <div class="compact-reference-links">
            @foreach($projects->take(3) as $project)
                <a class="reference-preview" href="{{ route('projects.show', $project['slug']) }}">
                    <div class="reference-preview-image"><img src="{{ $project['media'][0]['card_src'] ?? $project['media'][0]['src'] }}" alt="{{ $project['media'][0]['alt'] }}" width="1440" height="1000" loading="lazy"><span aria-hidden="true">↗</span></div>
                    <div class="reference-preview-copy"><span>{{ $project['name'] }}</span><strong>{{ $project['home_feature'] ?? $project['showcase_title'] }}</strong></div>
                </a>
            @endforeach
            <a class="compact-reference-all" href="{{ route('projects.index') }}">Munkáink megtekintése <span aria-hidden="true">→</span></a>
        </div>
    </div>
</section>
@endif

<section class="section section-services" id="szolgaltatasok" data-home-reveal>
    <div class="container">
        <div class="section-heading"><div><span class="eyebrow">Miben segítünk?</span><h2>Mire szeretnél megoldást?</h2></div></div>
        <div class="service-rows">
            <article><div class="service-card-top"><span class="service-icon"><x-marketing.icon name="code" /></span><span>01 / FEJLESZTÉS</span></div><h3>Egyedi szoftver</h3><p>Olyan rendszert készítünk, ami a saját munkafolyamataidhoz igazodik — például nyilvántartáshoz, feladatkövetéshez vagy belső ügyintézéshez.</p><a href="{{ route('services') }}#rendszerek" aria-label="Részletek: Egyedi szoftver">Részletek <span aria-hidden="true">→</span></a></article>
            <article><div class="service-card-top"><span class="service-icon"><x-marketing.icon name="flow" /></span><span>02 / AUTOMATIZÁLÁS</span></div><h3>Automatizálás</h3><p>Összekötjük, amit ma külön kezelsz, és ahol lehet, kiváltjuk az ismétlődő kézi adatmozgatást.</p><a href="{{ route('services') }}#integraciok" aria-label="Részletek: Automatizálás">Részletek <span aria-hidden="true">→</span></a></article>
            <article><div class="service-card-top"><span class="service-icon"><x-marketing.icon name="globe" /></span><span>03 / ONLINE RENDSZEREK</span></div><h3>Web és online rendszerek</h3><p>Bemutatkozó oldal, rendelés, foglalás vagy más online felület — azzal a kezeléssel együtt, amire tényleg szükséged van.</p><a href="{{ route('services') }}#weboldalak" aria-label="Részletek: Web és online rendszerek">Részletek <span aria-hidden="true">→</span></a></article>
        </div>
    </div>
</section>

<section class="section section-process home-process-section" data-home-reveal>
    <div class="container">
        <div class="section-heading"><div><span class="eyebrow">Hogyan dolgozunk?</span><h2>Innen indul a közös munka</h2></div><a class="text-link" href="{{ route('process') }}">A teljes folyamatról <span aria-hidden="true">→</span></a></div>
        <ol class="process-grid">
            <li><span>1</span><h3>Átbeszéljük a feladatot</h3><p>Megnézzük, mit szeretnél elérni, és mi nehezíti most a munkát.</p><small>Egyeztetett igények</small></li>
            <li><span>2</span><h3>Javaslatot és ajánlatot kapsz</h3><p>Tisztázzuk a megoldást, a feladatokat, a költséget és az ütemezést.</p><small>Feladatok és keretek</small></li>
            <li><span>3</span><h3>Megmutatjuk, hogyan készül</h3><p>Bemutatjuk a készülő megoldást, és átbeszéljük a visszajelzéseidet.</p><small>Kipróbálható változat</small></li>
            <li><span>4</span><h3>Kipróbáljuk és átadjuk</h3><p>Ellenőrizzük a megbeszélt funkciókat, és átbeszéljük a használatot.</p><small>Átadott megoldás</small></li>
        </ol>
        <p class="process-support-note">Az átadás utáni támogatásról és bővítésről a megállapodás szerint egyeztetünk.</p>
    </div>
</section>

<section class="section company-principles-section" data-home-reveal>
    <div class="container principles-layout">
        <div class="principles-intro">
            <span class="eyebrow">Miért SzoftLab?</span>
            <h2>Beszéljük át a feladatot. A technikai részét megoldjuk.</h2>
            <p>Nem kell tudnod, milyen technológia vagy rendszer kell hozzá. Először azt nézzük meg, mit szeretnél egyszerűbben csinálni.</p>
            <a class="text-link" href="{{ route('about') }}">A SzoftLabról <span aria-hidden="true">→</span></a>
        </div>
        <div class="principles-list">
            <article><span>01</span><div><h3>Érthető egyeztetés</h3><p>Nem technikai kifejezésekkel kezdünk, hanem azzal, mit szeretnél megoldani.</p></div></article>
            <article><span>02</span><div><h3>Tudd, mit kapsz</h3><p>Előre átbeszéljük a feladatokat és azt, mi tartozik az ajánlatba.</p></div></article>
            <article><span>03</span><div><h3>Később is bővíthető</h3><p>Ha később új igényed lesz, megnézzük, hogyan érdemes továbbépíteni.</p></div></article>
        </div>
    </div>
</section>

<section class="section section-faq faq-section" data-home-reveal>
    <div class="container narrow">
        <div class="section-heading"><div><h2>Gyakori kérdések</h2></div></div>
        <div class="faq-list">
            <details><summary>Mikorra készülhet el a fejlesztés?</summary><p>Egy kisebb automatizálás és egy összetettebb üzleti rendszer eltérő munkát igényel. A feladat és a szükséges tartalmak átbeszélése után adunk ütemezési javaslatot.</p></details>
            <details><summary>Mitől függ a fejlesztés ára?</summary><p>A funkcióktól, a tartalomtól és a meglévő rendszerekhez szükséges kapcsolatoktól. Az ajánlatban megmutatjuk, mi tartozik a feladathoz, és mi jelent külön költséget.</p></details>
            <details><summary>Meglévő rendszerrel is tudtok dolgozni?</summary><p>Először átnézzük a jelenlegi megoldást. Ezután javasoljuk, mit érdemes megtartani, javítani vagy továbbfejleszteni. Nem kell automatikusan mindent újrakezdeni.</p></details>
            <details><summary>Milyen feladatot érdemes automatizálni?</summary><p>Például foglalási adatok továbbítását, riportok előkészítését vagy ismétlődő adatfrissítést. A saját folyamatodból indulunk ki; a lehetőségekhez a használt rendszereket is meg kell nézni.</p></details>
            <details><summary>A domain, a tárhely és a céges e-mail ügyében is segítetek?</summary><p>A saját termékeinknél 3 hónap díjmentes tárhelyet és domaint adunk, a beüzemelésben segítünk. A 4. hónaptól fizetendő tárhelydíjat és a domain további feltételeit még a megrendelés előtt, az írásos ajánlatban rögzítjük. Igény esetén hosszú távú támogatásról külön egyeztetünk.</p></details>
            <details><summary>Számlaképesek vagytok?</summary><p>Igen. A SzoftLab szolgáltatásairól alanyi adómentes számlát állítunk ki. A számlázás részleteit az írásos ajánlatban rögzítjük.</p></details>
            <details><summary>Kész műszaki tervvel kell érkeznem?</summary><p>Nem. Elég, ha elmondod, mivel foglalkozol, és min szeretnél változtatni. Ha van jelenlegi weboldalad vagy egy jó példád, azt is megnézzük.</p></details>
        </div>
    </div>
</section>

<x-marketing.contact-cta />
@endsection
