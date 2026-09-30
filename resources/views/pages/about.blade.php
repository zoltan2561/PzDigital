@extends('layouts.marketing')
@php($title = 'Rólunk — SzoftLab')
@php($description = 'Ismerd meg a SzoftLab csapatát: 10 év IT-tapasztalattal, valós projekteken szerzett tudással és érthető kommunikációval készítünk webes rendszereket.')
@section('content')
<section class="page-hero"><div class="container narrow"><span class="eyebrow eyebrow-light">SzoftLab</span><h1>Értjük a problémát. Megépítjük a megoldást.</h1><p>Jól összeszokott csapatként, 10 év IT-tapasztalattal és valós projektekkel a hátunk mögött készítünk webes rendszereket. Olyan megoldásokon dolgozunk, amelyek időt és munkát spórolnak a használóiknak.</p></div></section>
<section class="section"><div class="container split-content"><div><span class="eyebrow">Ahogy együtt dolgozunk</span><h2>Először a működésedet értjük meg.</h2><p>Számunkra az ügyfél az első. Meghallgatjuk, hogyan dolgoztok ma, felmérjük a helyzetet, és együtt pontosítjuk, hol akad el a folyamat. Ezután a problémát programmal megoldható feladatokra fordítjuk le.</p><p>Gyorsan válaszolunk, és közérthetően beszélünk a lehetőségekről, a költségekről és a következő lépésről. A cél egy használható rendszer, amely a napi munkához illeszkedik.</p><a class="text-link" href="{{ route('projects.index') }}">Nézd meg a munkáinkat <span aria-hidden="true">→</span></a></div><div class="values-grid"><article><x-marketing.icon name="people" /><h3>Az ügyfél az első</h3><p>A döntéseket a valós munkamenethez és az érintettek igényeihez igazítjuk.</p></article><article><x-marketing.icon name="shield" /><h3>Érthető kommunikáció</h3><p>Világosan elmondjuk, mit javaslunk, miért és mi lesz a következő lépés.</p></article><article><x-marketing.icon name="chart" /><h3>Valós tapasztalat</h3><p>Tíz év IT-tapasztalat és megvalósult projektek tudása áll a munkánk mögött.</p></article><article><x-marketing.icon name="code" /><h3>Gyakorlati megoldások</h3><p>A feltárt problémából működő, a mindennapokban használható szoftvert készítünk.</p></article></div></div></section>
<section class="section technology-section" id="technologiak">
    <div class="container technology-inner">
        <div class="technology-heading">
            <span class="eyebrow">Szakmai háttér</span>
            <h2>A háttérben ezekkel dolgozunk.</h2>
            <p>Neked nem kell technológiát választanod. A feladathoz illő megoldást mi rakjuk össze.</p>
        </div>
        @php($technologies = [
            ['name' => 'Laravel', 'logo' => 'laravel/FF2D20'],
            ['name' => 'PHP', 'logo' => 'php/777BB4'],
            ['name' => 'JavaScript', 'logo' => 'javascript/F7DF1E'],
            ['name' => 'MySQL', 'logo' => 'mysql/4479A1'],
            ['name' => 'Docker', 'logo' => 'docker/2496ED'],
            ['name' => 'Python', 'logo' => 'python/3776AB'],
            ['name' => 'OpenAI API', 'logo' => 'https://upload.wikimedia.org/wikipedia/commons/0/04/ChatGPT_logo.svg'],
            ['name' => 'Git', 'logo' => 'git/F05032'],
            ['name' => 'Linux', 'logo' => 'linux/FCC624'],
        ])
        <ul class="technology-list" aria-label="Használt technológiák">
            @foreach($technologies as $technology)
                <li><img class="technology-logo" src="{{ str_starts_with($technology['logo'], 'http') ? $technology['logo'] : 'https://cdn.simpleicons.org/'.$technology['logo'] }}" alt="" width="22" height="22" loading="lazy"><span>{{ $technology['name'] }}</span></li>
            @endforeach
        </ul>
    </div>
</section>
<x-marketing.contact-cta />
@endsection
