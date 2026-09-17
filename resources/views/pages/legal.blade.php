@extends('layouts.marketing')
@php($title = 'Impresszum — PZ Digital')
@php($noindex = true)
@section('content')
<section class="page-hero compact"><div class="container narrow"><span class="eyebrow eyebrow-light">Jogi tartalom</span><h1>Impresszum</h1></div></section>
<section class="section"><article class="container prose"><div class="draft-notice"><strong>Jóváhagyásra váró szolgáltatói adatok</strong><p>Az éles indulás előtt itt kell feltüntetni a tényleges szolgáltató hivatalos nevét, székhelyét, nyilvántartási és adóadatait, valamint elérhetőségét. A fejlesztés nem talál ki jogi formát vagy cégadatot.</p></div><h2>Kapcsolat</h2><p>E-mail: <a href="mailto:{{ config('pzdigital.contact_email') }}">{{ config('pzdigital.contact_email') }}</a></p></article></section>
@endsection
