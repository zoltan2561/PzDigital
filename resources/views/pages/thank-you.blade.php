@extends('layouts.marketing')
@php($title = 'Köszönjük a megkeresést — SzoftPont')
@php($noindex = true)
@section('content')
<section class="success-page"><div class="container narrow"><span class="success-icon">✓</span><span class="eyebrow">Sikeres rögzítés</span><h1>Köszönjük, megkaptuk a megkeresésed.</h1><p>Az igényt biztonságosan rögzítettük. Az e-mail-értesítés kézbesítése külön háttérfolyamatban történik; hamarosan felvesszük veled a kapcsolatot.</p><div class="button-row centered"><a class="button" href="{{ route('home') }}">Vissza a főoldalra</a><a class="button button-dark-outline" href="{{ route('products.index') }}">Termékek megtekintése</a></div></div></section>
@endsection
