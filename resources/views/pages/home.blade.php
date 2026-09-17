@extends('layouts.marketing')

@section('content')
<section class="hero company-home-hero motion-hero" data-motion-hero>
    <div class="hero-glow"></div>
    <div class="container company-home-hero-grid">
        <div class="hero-copy" data-hero-copy>
            <span class="eyebrow eyebrow-light">PZ Digital · Weboldalak és szoftverek</span>
            <h1>Weboldal az ügyfeleidnek. Rendszer a napi munkádhoz.</h1>
            <p>Bemutatkozó oldalt, online rendelést, időpontfoglalást vagy belső kezelőfelületet készítünk. Elmondod, mire van szükséged, mi segítünk összeállítani a megoldást.</p>
            <div class="button-row">
                <a class="button" href="{{ route('contact', ['erdeklodes' => 'other']) }}">Beszéljünk a projektedről <span aria-hidden="true">→</span></a>
                <a class="button button-outline" href="#megoldasok">Megnézem a termékeket</a>
            </div>
        </div>
        <x-marketing.company-system-visual />
    </div>
</section>

<section class="section section-services" id="szolgaltatasok" data-home-reveal>
    <div class="container">
        <div class="section-heading"><div><span class="eyebrow">Miben segítünk?</span><h2>Mire van szüksége a vállalkozásodnak?</h2></div></div>
        <div class="service-rows">
            <article><span>01</span><h3>Céges weboldal</h3><p>Mutasd meg, mivel foglalkozol, mit kínálsz, és hogyan lehet elérni. Olyan oldalt készítünk, amelyet telefonon is könnyű használni.</p><a href="{{ route('services') }}#weboldalak" aria-label="Részletek: Céges weboldal">Részletek <span aria-hidden="true">→</span></a></article>
            <article><span>02</span><h3>Rendelési, foglalási és ügyviteli rendszer</h3><p>Fogadd a rendeléseket, kezeld az időpontokat vagy kövesd a munkákat egy hozzád illő felületen. A szükséges funkciókat együtt pontosítjuk.</p><a href="{{ route('services') }}#rendszerek" aria-label="Részletek: Rendelési, foglalási és ügyviteli rendszer">Részletek <span aria-hidden="true">→</span></a></article>
            <article><span>03</span><h3>Kevesebb kézi adatbevitel</h3><p>Összekapcsoljuk a használt rendszereket, ahol erre van lehetőség. Például a foglalási felületet a naptárral, vagy az adatforrást a weboldallal.</p><a href="{{ route('services') }}#integraciok" aria-label="Részletek: Kevesebb kézi adatbevitel">Részletek <span aria-hidden="true">→</span></a></article>
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
            <div class="section-heading-action"><p>Ismerd meg termékeinket, és nézd meg, melyik illeszkedhet a vállalkozásod működéséhez.</p><a class="text-link" href="{{ route('products.index') }}">Összes termék <span aria-hidden="true">→</span></a></div>
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
            <p>A weboldalt, a kezelőfelületet és a szükséges kapcsolatokat együtt nézzük. Így már a tervezésnél kiderül, minek kell együtt működnie.</p>
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
                <a href="{{ route('projects.show', $project['slug']) }}"><span>{{ $project['name'] }}</span><strong>{{ $project['home_feature'] ?? $project['showcase_title'] }}</strong><b aria-hidden="true">→</b></a>
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
            <details><summary>Mikorra készülhet el a fejlesztés?</summary><p>Egy bemutatkozó oldal és egy rendelési rendszer eltérő munkát igényel. A feladat és a szükséges tartalmak átbeszélése után adunk ütemezési javaslatot.</p></details>
            <details><summary>Mitől függ a fejlesztés ára?</summary><p>A funkcióktól, a tartalomtól és a meglévő rendszerekhez szükséges kapcsolatoktól. Az ajánlatban megmutatjuk, mi tartozik a feladathoz, és mi jelent külön költséget.</p></details>
            <details><summary>A meglévő weboldalunkon is tudtok dolgozni?</summary><p>Először átnézzük a jelenlegi megoldást. Ezután javasoljuk, mit érdemes megtartani, javítani vagy továbbfejleszteni. Nem kell automatikusan mindent újrakezdeni.</p></details>
            <details><summary>Milyen feladatot érdemes automatizálni?</summary><p>Például foglalási adatok továbbítását, riportok előkészítését vagy ismétlődő adatfrissítést. A saját folyamatodból indulunk ki; a lehetőségekhez a használt rendszereket is meg kell nézni.</p></details>
            <details><summary>A domain, a tárhely és a céges e-mail ügyében is segítetek?</summary><p>Ezek beállítása is része lehet a közös munkának. Az ajánlatban külön jelezzük a beállítás feladatait és a szükséges szolgáltatások díjait.</p></details>
            <details><summary>Kész műszaki tervvel kell érkeznem?</summary><p>Nem. Elég, ha elmondod, mivel foglalkozol, és min szeretnél változtatni. Ha van jelenlegi weboldalad vagy egy jó példád, azt is megnézzük.</p></details>
        </div>
    </div>
</section>

<x-marketing.contact-cta />
@endsection
