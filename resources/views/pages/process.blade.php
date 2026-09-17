@extends('layouts.marketing')
@php($title = 'Hogyan dolgozunk? — PZ Digital')
@section('content')
<section class="page-hero"><div class="container narrow"><span class="eyebrow eyebrow-light">Együttműködés</span><h1>Átlátható folyamat az első kérdéstől az átadásig</h1><p>Minden szakasznak érthető célja, kézzelfogható eredménye és visszajelzési pontja van.</p></div></section>
<section class="section"><div class="container timeline">
    <article><span>01</span><div><h2>Megértjük a feladatot</h2><p>Feltérképezzük a jelenlegi működést, az érintetteket, a szükséges adatokat és azt, mitől lenne valóban jobb a folyamat.</p><strong>Eredmény: közös probléma- és céldefiníció.</strong></div></article>
    <article><span>02</span><div><h2>Rögzítjük a megoldást és a kereteket</h2><p>Meghatározzuk az átadandó funkciókat, a kizárásokat, az ellenőrzés módját és a következő döntési pontokat.</p><strong>Eredmény: követhető megvalósítási terv.</strong></div></article>
    <article><span>03</span><div><h2>Bemutatjuk és teszteljük</h2><p>Működő részeket mutatunk be, a visszajelzéseket rögzítjük, és a kritikus folyamatokat célzott tesztekkel ellenőrizzük.</p><strong>Eredmény: ellenőrzött, elfogadható megoldás.</strong></div></article>
    <article><span>04</span><div><h2>Bevezetjük és átadjuk</h2><p>Az élesítés külön jóváhagyott lépés. Az átadáshoz dokumentáció, konfigurációs leírás és egyeztetett támogatási keret tartozik.</p><strong>Eredmény: használható rendszer és tiszta felelősségek.</strong></div></article>
</div></section>
<x-marketing.contact-cta />
@endsection
