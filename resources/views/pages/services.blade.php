@extends('layouts.marketing')
@php($title = 'Szolgáltatások — PZ Digital')
@section('content')
<section class="page-hero"><div class="container narrow"><span class="eyebrow eyebrow-light">Szolgáltatások</span><h1>Digitális megoldás, érthető üzleti keretekkel</h1><p>A tervezéstől az átadásig követhető folyamatban dolgozunk. A pontos tartalmat és támogatást minden projektnél külön rögzítjük.</p></div></section>
<section class="section"><div class="container detail-list">
    <article id="weboldalak"><span class="icon-box"><x-marketing.icon name="globe" /></span><div><span class="eyebrow">01</span><h2>Céges weboldalak</h2><p>Olyan reszponzív weboldal készül, amely világosan bemutatja az ajánlatot, gyorsan betöltődik, és egyszerű kapcsolatfelvételi utat ad.</p><ul class="check-list"><li>Tartalmi és oldaltérkép-tervezés</li><li>Reszponzív, hozzáférhető felület</li><li>Technikai SEO és mérhető konverziós pontok</li></ul></div></article>
    <article id="rendszerek"><span class="icon-box"><x-marketing.icon name="code" /></span><div><span class="eyebrow">02</span><h2>Egyedi üzleti rendszerek</h2><p>A manuális vagy szétszórt folyamatból karbantartható webes rendszer készül, meghatározott szerepkörökkel és adatkezeléssel.</p><ul class="check-list"><li>Igény- és folyamatfelmérés</li><li>Iteratív fejlesztés és bemutatók</li><li>Tesztelt, dokumentált átadás</li></ul></div></article>
    <article id="integraciok"><span class="icon-box"><x-marketing.icon name="flow" /></span><div><span class="eyebrow">03</span><h2>Integrációk és automatizálás</h2><p>A meglévő rendszerek közötti kézi lépések csökkenthetők szabályozott adatkapcsolatokkal és ellenőrizhető automatizmusokkal.</p><ul class="check-list"><li>Adatáramlás és hibapontok feltérképezése</li><li>Biztonságos integrációs keretek</li><li>Naplózás és helyreállítási folyamat</li></ul></div></article>
</div></section>
<x-marketing.contact-cta title="Milyen eredményt szeretnél elérni?" interest="custom_development" />
@endsection
