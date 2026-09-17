@extends('layouts.marketing')
@php($title = 'Termékek — PZ Digital')
@php($description = 'Ismerd meg a PZ Digital saját szoftvermegoldásait, minden terméknél valós készültségi állapottal.')

@section('content')
<section class="page-hero"><div class="container narrow"><span class="eyebrow eyebrow-light">Saját szoftvermegoldásaink</span><h1>Üzleti folyamatokra tervezett termékek</h1><p>A működő demót és az előkészítés alatt álló termékváltozatot külön jelöljük. A bemutató mindig a valós készültségből indul ki.</p></div></section>
<section class="section"><div class="container"><div class="products-grid">@foreach($products as $product)<x-marketing.product-card :product="$product" />@endforeach</div></div></section>
<x-marketing.contact-cta title="Melyik megoldás illik a működésedhez?" />
@endsection
