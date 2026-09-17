@extends('layouts.marketing')
@php($title = 'Hogyan dolgozunk? — PZ Digital')
@section('content')
<section class="page-hero"><div class="container narrow"><span class="eyebrow eyebrow-light">Együttműködés</span><h1>Átlátható folyamat az első kérdéstől az átadásig</h1><p>Minden szakasznak érthető célja, kézzelfogható eredménye és visszajelzési pontja van.</p></div></section>
<section class="section"><div class="container timeline">
    <article><span>01</span><div><h2>Megértjük a feladatot</h2><p>Átbeszéljük a célt, a jelenlegi működést és a legfontosabb igényt.</p><strong>Kimenet: igények és prioritások.</strong></div></article>
    <article><span>02</span><div><h2>Rögzítjük a megoldást és a kereteket</h2><p>Tisztázzuk, mi készül el, mi tartozik az adott szakaszba, és hogyan ellenőrizzük az eredményt.</p><strong>Kimenet: egyeztetett feladat és ajánlat.</strong></div></article>
    <article><span>03</span><div><h2>Bemutatjuk és teszteljük</h2><p>Nem csak a végén látod az eredményt: a megbeszélt pontokon működő változatot mutatunk, amelyre visszajelezhetsz.</p><strong>Kimenet: bemutatható változat és visszajelzés.</strong></div></article>
    <article><span>04</span><div><h2>Átadjuk a megoldást</h2><p>A használatba vétel és az átadás feltételeit, valamint az egyeztetett támogatási keretet is rögzítjük.</p><strong>Kimenet: átadás és következő lépések.</strong></div></article>
</div></section>
<x-marketing.contact-cta />
@endsection
