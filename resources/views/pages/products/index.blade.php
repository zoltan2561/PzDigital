@extends('layouts.marketing')
@php($title = 'Termékek — SzoftLab')
@php($description = 'Ismerd meg a SzoftLab saját szoftvermegoldásait, minden terméknél valós készültségi állapottal.')

@section('content')
<section class="page-hero"><div class="container narrow"><span class="eyebrow eyebrow-light">Saját szoftvermegoldásaink</span><h1>Kész rendszer a napi munkádhoz</h1><p>Ismerd meg a működő SzervizPro műhelyrendszert és a FoodPro éttermi rendelési rendszert. Mindkettőnél megmutatjuk a valódi felületeket, az előnyöket és a bevezetés feltételeit.</p></div></section>
<section class="section" data-home-reveal><div class="container"><div class="section-heading"><div><span class="eyebrow">Válassz területet</span><h2>Melyik rendszert keresed?</h2></div><p>Nézd meg a két működő bemutatót, vagy olvasd el, hogyan segítik a napi munkát.</p></div><div class="products-grid">@foreach($products as $product)<x-marketing.product-card :product="$product" />@endforeach</div></div></section>
<section class="section product-index-offer" data-home-reveal><div class="container"><span class="eyebrow">Egyszerű indulás</span><h2>Egyszeri vételár, segítség a beüzemelésben.</h2><p>Mindkét termék ajánlatához 3 hónap díjmentes tárhely és domain tartozik. A 4. hónaptól fizetendő tárhelydíjat és a domain további feltételeit még a megrendelés előtt írásban rögzítjük. Igény esetén hosszú távú támogatásról is egyeztetünk.</p><a class="text-link" href="{{ route('contact') }}">Segítséget kérek a választáshoz <span aria-hidden="true">→</span></a></div></section>
<x-marketing.contact-cta title="Melyik megoldás illik a működésedhez?" />
@endsection
