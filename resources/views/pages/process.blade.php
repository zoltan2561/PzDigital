@extends('layouts.marketing')
@php($title = 'Hogyan dolgozunk? — PZ Digital')
@section('content')
<section class="page-hero"><div class="container narrow"><span class="eyebrow eyebrow-light">Együttműködés</span><h1>Innen indul a közös munka</h1><p>Négy érthető lépésben jutunk el a feladattól az átadásig.</p></div></section>
<section class="section"><div class="container timeline">
    <article><span>01</span><div><h2>Átbeszéljük a feladatot</h2><p>Megnézzük, mit szeretnél elérni, és mi nehezíti most a munkát.</p><strong>Kimenet: egyeztetett igények.</strong></div></article>
    <article><span>02</span><div><h2>Javaslatot és ajánlatot kapsz</h2><p>Tisztázzuk a megoldást, a feladatokat, a költséget és az ütemezést.</p><strong>Kimenet: feladatok és keretek.</strong></div></article>
    <article><span>03</span><div><h2>Megmutatjuk, hogyan készül</h2><p>Bemutatjuk a készülő megoldást, és átbeszéljük a visszajelzéseidet.</p><strong>Kimenet: kipróbálható változat.</strong></div></article>
    <article><span>04</span><div><h2>Kipróbáljuk és átadjuk</h2><p>Ellenőrizzük a megbeszélt funkciókat, és átbeszéljük a használatot.</p><strong>Kimenet: átadott megoldás.</strong></div></article>
    <p class="timeline-note">Az átadás utáni támogatásról és bővítésről a megállapodás szerint egyeztetünk.</p>
</div></section>
<x-marketing.contact-cta />
@endsection
