@extends('layouts.marketing')
@php($title = 'SzoftPont – Szoftverfejlesztés és automatizálás')
@php($description = 'Egyedi szoftverek, automatizálás és rendszerkapcsolatok a vállalkozásod működéséhez. Saját termékek, bemutatók és átlátható megvalósítás.')

@section('content')
@php($heroProduct = $products->first())
<section class="hero company-home-hero">
    <div class="hero-orbit" aria-hidden="true"></div>
    <div @class(['container', 'company-home-hero-grid', 'has-showcase' => $heroProduct])>
        <div class="hero-copy">
            <span class="eyebrow eyebrow-light hero-eyebrow"><span class="brand-dot" aria-hidden="true"></span> Szoftver · Automatizálás · Integráció</span>
            <h1>Ami ma pluszmunka,<br> <span>arra fejlesztünk megoldást.</span></h1>
            <p>Mondd el, mi lassítja a munkát. Készítünk rá szoftvert, összekötjük a meglévő rendszereidet, vagy automatizáljuk, amit ma még kézzel csinálsz.</p>
            <div class="button-row">
                <a class="button" href="{{ route('contact', ['erdeklodes' => 'other']) }}">Beszéljünk a feladatról <span aria-hidden="true">→</span></a>
                <a class="button button-outline" href="#megoldasok">Megnézem a termékeket</a>
            </div>
            <div class="hero-assurances" aria-label="Amiben számíthatsz ránk">
                <span><x-marketing.icon name="code" /> Egyedi fejlesztés</span>
                <span><x-marketing.icon name="flow" /> Saját termékek</span>
                <span><x-marketing.icon name="shield" /> Bevezetés</span>
            </div>
        </div>
        @if($heroProduct)
            <div class="hero-showcase" data-hero-showcase>
                <div class="showcase-label"><span class="showcase-dot" aria-hidden="true"></span> Egy saját fejlesztésünk: {{ $heroProduct['name'] }}</div>
                <a class="showcase-window" href="{{ route('products.show', $heroProduct['slug']) }}" aria-label="{{ $heroProduct['name'] }}: a termék bemutatása">
                    <div class="showcase-toolbar" aria-hidden="true"><span class="window-dots"><i></i><i></i><i></i></span><span>{{ $heroProduct['name'] }}</span><x-marketing.icon name="shield" /></div>
                    <img src="{{ $heroProduct['screenshots'][0]['src'] }}" alt="{{ $heroProduct['screenshots'][0]['alt'] }}" width="1440" height="1050" fetchpriority="high">
                    <div class="showcase-caption"><div><small>{{ $heroProduct['status_label'] }}</small><strong>{{ $heroProduct['name'] }}</strong></div><span class="showcase-open" aria-hidden="true">↗</span></div>
                </a>
                <div class="showcase-flow">
                    <span class="showcase-flow-icon" aria-hidden="true"><x-marketing.icon name="flow" /></span>
                    <div><small>Egy átgondolt folyamat</small><div>@foreach($heroProduct['flow'] as $step)<span>{{ $step['title'] }}</span>@unless($loop->last)<b aria-hidden="true">→</b>@endunless @endforeach</div></div>
                </div>
            </div>
        @endif
    </div>
    <div class="container hero-footnote"><span>Az üzleti feladattól a működő megoldásig.</span><a href="#szolgaltatasok">Nézd meg, miben segítünk <span aria-hidden="true">↓</span></a></div>
</section>

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

<section id="megoldasok" class="section section-products home-products-section" data-home-reveal>
    <div class="container">
        <div class="section-heading">
            <div><span class="eyebrow">Saját termékeink</span><h2>Saját szoftverek a napi működéshez</h2></div>
            <div class="section-heading-action"><p>Nem kell mindig nulláról indulni. Nézd meg saját termékeinket, és beszéljük át, melyik passzolhat a munkádhoz.</p><a class="text-link" href="{{ route('products.index') }}">Összes termék <span aria-hidden="true">→</span></a></div>
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

<section class="section company-principles-section" data-home-reveal>
    <div class="container principles-layout">
        <div class="principles-intro">
            <span class="eyebrow">Miért SzoftPont?</span>
            <h2>Beszéljük át a feladatot. A technikai részét megoldjuk.</h2>
            <p>Nem kell tudnod, milyen technológia vagy rendszer kell hozzá. Először azt nézzük meg, mit szeretnél egyszerűbben csinálni.</p>
            <a class="text-link" href="{{ route('about') }}">A SzoftPontról <span aria-hidden="true">→</span></a>
        </div>
        <div class="principles-list">
            <article><span>01</span><div><h3>Érthető egyeztetés</h3><p>Nem technikai kifejezésekkel kezdünk, hanem azzal, mit szeretnél megoldani.</p></div></article>
            <article><span>02</span><div><h3>Tudd, mit kapsz</h3><p>Előre átbeszéljük a feladatokat és azt, mi tartozik az ajánlatba.</p></div></article>
            <article><span>03</span><div><h3>Később is bővíthető</h3><p>Ha később új igényed lesz, megnézzük, hogyan érdemes továbbépíteni.</p></div></article>
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

<section class="section technology-section" id="technologiak" data-home-reveal>
    <div class="container technology-inner">
        <div class="technology-heading">
            <span class="eyebrow">Szakmai háttér</span>
            <h2>A háttérben ezekkel dolgozunk.</h2>
            <p>Neked nem kell technológiát választanod. A feladathoz illő megoldást mi rakjuk össze.</p>
        </div>
        @php($technologies = [
            ['name' => 'Laravel', 'logo' => 'laravel/FF2D20'],
            ['name' => 'PHP', 'logo' => 'php/777BB4'],
            ['name' => 'JavaScript', 'logo' => 'javascript/F7DF1E'],
            ['name' => 'MySQL', 'logo' => 'mysql/4479A1'],
            ['name' => 'Docker', 'logo' => 'docker/2496ED'],
            ['name' => 'Python', 'logo' => 'python/3776AB'],
            ['name' => 'OpenAI API', 'logo' => 'https://upload.wikimedia.org/wikipedia/commons/0/04/ChatGPT_logo.svg'],
            ['name' => 'Git', 'logo' => 'git/F05032'],
            ['name' => 'Linux', 'logo' => 'linux/FCC624'],
        ])
        <ul class="technology-list" aria-label="Használt technológiák">
            @foreach($technologies as $technology)
                <li><img class="technology-logo" src="{{ str_starts_with($technology['logo'], 'http') ? $technology['logo'] : 'https://cdn.simpleicons.org/'.$technology['logo'] }}" alt="" width="22" height="22" loading="lazy"><span>{{ $technology['name'] }}</span></li>
            @endforeach
        </ul>
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
            <details><summary>A domain, a tárhely és a céges e-mail ügyében is segítetek?</summary><p>Ezek beállítása is része lehet a közös munkának. Az ajánlatban külön jelezzük a beállítás feladatait és a szükséges szolgáltatások díjait.</p></details>
            <details><summary>Kész műszaki tervvel kell érkeznem?</summary><p>Nem. Elég, ha elmondod, mivel foglalkozol, és min szeretnél változtatni. Ha van jelenlegi weboldalad vagy egy jó példád, azt is megnézzük.</p></details>
        </div>
    </div>
</section>

<x-marketing.contact-cta />
@endsection
