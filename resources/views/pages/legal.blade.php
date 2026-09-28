@extends('layouts.marketing')
@php($title = 'Impresszum — SzoftLab')
@section('content')
<section class="page-hero compact"><div class="container narrow"><span class="eyebrow eyebrow-light">Szolgáltatói adatok</span><h1>Impresszum</h1></div></section>
<section class="section">
    <article class="container prose">
        <p>A SzoftLab weboldalának üzemeltetője és a szolgáltatások nyújtója:</p>
        <dl class="legal-facts">
            <div><dt>Vállalkozó</dt><dd>{{ config('pzdigital.legal.provider_name') }}</dd></div>
            <div><dt>Használt név</dt><dd>{{ config('pzdigital.legal.trading_name') }}</dd></div>
            <div><dt>Székhely</dt><dd>{{ config('pzdigital.legal.registered_address') }}</dd></div>
            <div><dt>Nyilvántartási szám</dt><dd>{{ config('pzdigital.legal.registration_number') }}</dd></div>
            <div><dt>Nyilvántartást vezető szerv</dt><dd>{{ config('pzdigital.legal.registering_authority') }}</dd></div>
            <div><dt>Adószám</dt><dd>{{ config('pzdigital.legal.tax_number') }}</dd></div>
            <div><dt>Kapcsolat</dt><dd><a href="mailto:{{ config('pzdigital.contact_email') }}">{{ config('pzdigital.contact_email') }}</a></dd></div>
        </dl>
        <h2>Számlázás</h2>
        <p>A szolgáltatásokról számlát állítunk ki. A vállalkozó jelenleg alanyi adómentes számlát ad; a konkrét ügylet és az ajánlat számlázási feltételeit külön egyeztetjük.</p>
        <h2>Adatkezelés</h2>
        <p>A kapcsolatfelvétel során megadott adatok kezeléséről az <a href="{{ route('privacy') }}">adatkezelési tájékoztatóban</a> olvashatsz.</p>
    </article>
</section>
@endsection
