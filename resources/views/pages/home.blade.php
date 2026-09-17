@extends('layouts.marketing')
@php($title = 'PZ Digital – Szoftverfejlesztés és automatizálás')
@php($description = 'Egyedi szoftverek, automatizálás és rendszerkapcsolatok a vállalkozásod működéséhez. Saját termékek, bemutatók és átlátható megvalósítás.')

@section('content')
@php($heroProduct = $products->first())
<section class="hero company-home-hero">
    <div class="hero-orbit" aria-hidden="true"></div>
    <div @class(['container', 'company-home-hero-grid', 'has-showcase' => $heroProduct])>
        <div class="hero-copy">
            <span class="eyebrow eyebrow-light hero-eyebrow"><span aria-hidden="true"></span> Szoftverfejlesztés · Automatizálás</span>
            <h1>Ami ma pluszmunka,<br> <span>arra fejlesztünk megoldást.</span></h1>
            <p>Egyedi szoftvereket készítünk, összekötjük a rendszereidet, és automatizáljuk az ismétlődő feladatokat. Abból indulunk ki, hol veszítesz időt, és hogyan lehetne egyszerűbb a munkád.</p>
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
                <div class="showcase-label"><span class="showcase-dot" aria-hidden="true"></span> Saját fejlesztés. Valódi felület.</div>
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
            <article><div class="service-card-top"><span class="service-icon"><x-marketing.icon name="code" /></span><span>01 / FEJLESZTÉS</span></div><h3>Egyedi szoftverek</h3><p>A munkádhoz illeszkedő rendszert készítünk, például feladatok követésére, adatok kezelésére vagy belső folyamatok támogatására.</p><a href="{{ route('services') }}#rendszerek" aria-label="Részletek: Egyedi szoftverek">Részletek <span aria-hidden="true">↗</span></a></article>
            <article><div class="service-card-top"><span class="service-icon"><x-marketing.icon name="flow" /></span><span>02 / AUTOMATIZÁLÁS</span></div><h3>Automatizálás és összekapcsolás</h3><p>Összekötjük a használt programokat, és csökkentjük az ismétlődő kézi adatmozgatást, ahol ezt a rendszerek lehetővé teszik.</p><a href="{{ route('services') }}#integraciok" aria-label="Részletek: Automatizálás és összekapcsolás">Részletek <span aria-hidden="true">↗</span></a></article>
            <article><div class="service-card-top"><span class="service-icon"><x-marketing.icon name="globe" /></span><span>03 / WEBES JELENLÉT</span></div><h3>Weboldalak és online felületek</h3><p>Céges bemutatkozást, rendelési vagy foglalási felületet készítünk, a hozzá szükséges kezeléssel együtt.</p><a href="{{ route('services') }}#weboldalak" aria-label="Részletek: Weboldalak és online felületek">Részletek <span aria-hidden="true">↗</span></a></article>
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
            <div class="section-heading-action"><p>Nem minden feladatnál kell nulláról indulni. Nézd meg saját megoldásainkat, a bemutatón pedig átbeszéljük a bevezetéshez szükséges lépéseket.</p><a class="text-link" href="{{ route('products.index') }}">Összes termék <span aria-hidden="true">→</span></a></div>
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
            <span class="eyebrow">Miért PZ Digital?</span>
            <h2>Ne neked kelljen összerakni a technikai részleteket.</h2>
            <p>A szoftvert, a kezelőfelületet és a szükséges kapcsolatokat együtt nézzük. Így már a tervezésnél kiderül, minek kell együtt működnie.</p>
            <a class="text-link" href="{{ route('about') }}">A PZ Digitalról <span aria-hidden="true">→</span></a>
        </div>
        <div class="principles-list">
            <article><span>01</span><div><h3>Érthető egyeztetés</h3><p>A feladatot a vállalkozásod nyelvén beszéljük át.</p></div></article>
            <article><span>02</span><div><h3>Körülhatárolt munka</h3><p>Előre tisztázzuk, mit tartalmaz a megoldás.</p></div></article>
            <article><span>03</span><div><h3>További lehetőségek</h3><p>A későbbi bővítésről külön is egyeztethetünk.</p></div></article>
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

<section class="section technology-section" data-home-reveal>
    <div class="container technology-inner">
        <div class="technology-heading">
            <span class="eyebrow">Szakmai háttér</span>
            <h2>Technológiák, amelyekkel dolgozunk</h2>
            <p>Nem kell ezek közül választanod. A feladathoz megfelelő eszközöket javasoljuk.</p>
        </div>
        <div class="technology-groups">
            <article><h3>Weboldalak és alkalmazások</h3><ul><li>PHP</li><li>Laravel</li><li>HTML</li><li>CSS</li><li>JavaScript</li></ul></article>
            <article><h3>Adatkezelés</h3><ul><li>MySQL</li><li>MariaDB</li></ul></article>
            <article><h3>Üzemeltetési háttér</h3><ul><li>Linux</li><li>Docker</li><li>Git</li></ul></article>
            <article><h3>AI és automatizálás</h3><ul><li>OpenAI API</li><li>Python</li></ul></article>
        </div>
    </div>
</section>

<section class="section section-faq faq-section" data-home-reveal>
    <div class="container narrow">
        <div class="section-heading"><div><h2>Gyakori kérdések</h2></div></div>
        <div class="faq-list">
            <details><summary>Mikorra készülhet el a fejlesztés?</summary><p>Egy kisebb automatizálás és egy összetettebb üzleti rendszer eltérő munkát igényel. A feladat és a szükséges tartalmak átbeszélése után adunk ütemezési javaslatot.</p></details>
            <details><summary>Mitől függ a fejlesztés ára?</summary><p>A funkcióktól, a tartalomtól és a meglévő rendszerekhez szükséges kapcsolatoktól. Az ajánlatban megmutatjuk, mi tartozik a feladathoz, és mi jelent külön költséget.</p></details>
            <details><summary>A meglévő rendszerünket is tudjátok továbbfejleszteni?</summary><p>Először átnézzük a jelenlegi megoldást. Ezután javasoljuk, mit érdemes megtartani, javítani vagy továbbfejleszteni. Nem kell automatikusan mindent újrakezdeni.</p></details>
            <details><summary>Milyen feladatot érdemes automatizálni?</summary><p>Például foglalási adatok továbbítását, riportok előkészítését vagy ismétlődő adatfrissítést. A saját folyamatodból indulunk ki; a lehetőségekhez a használt rendszereket is meg kell nézni.</p></details>
            <details><summary>A domain, a tárhely és a céges e-mail ügyében is segítetek?</summary><p>Ezek beállítása is része lehet a közös munkának. Az ajánlatban külön jelezzük a beállítás feladatait és a szükséges szolgáltatások díjait.</p></details>
            <details><summary>Kész műszaki tervvel kell érkeznem?</summary><p>Nem. Elég, ha elmondod, mivel foglalkozol, és min szeretnél változtatni. Ha van jelenlegi weboldalad vagy egy jó példád, azt is megnézzük.</p></details>
        </div>
    </div>
</section>

<x-marketing.contact-cta />
@endsection
