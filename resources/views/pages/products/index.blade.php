@extends('layouts.marketing')
@php($title = 'Termékek — PZ Digital')
@php($description = 'Ismerd meg a PZ Digital SzervizPRO és FoodShop üzleti megoldásait, valós állapotjelzéssel és egyeztethető bemutatóval.')

@section('content')
<section class="page-hero"><div class="container narrow"><span class="eyebrow eyebrow-light">Saját megoldásaink</span><h1>Üzleti folyamatokra tervezett termékek</h1><p>Nem általános funkciólistát mutatunk: minden termékoldal a célcsoport problémájából, a bemutatható folyamatból és a tiszta szolgáltatási keretekből indul ki.</p></div></section>
<section class="section"><div class="container"><div class="products-grid products-grid-stack">@foreach($products as $product)<x-marketing.product-card :product="$product" :featured="$loop->first" />@endforeach</div></div></section>
<x-marketing.contact-cta title="Melyik megoldás illik a működésedhez?" />
@endsection
