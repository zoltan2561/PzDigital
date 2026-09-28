@extends('layouts.marketing')
@php($title = $product['name'].' — SzoftLab')
@php($description = $product['summary'])

@section('content')
<section class="product-hero">
    <div class="container hero-grid">
        <div class="hero-copy">
            <span class="status-badge status-on-dark">{{ $product['status_label'] }}</span>
            <span class="eyebrow eyebrow-light">{{ $product['eyebrow'] }}</span>
            <h1>{{ $product['headline'] }}</h1>
            <p>{{ $product['summary'] }}</p>
            <div class="button-row"><a class="button" href="{{ route('contact', ['erdeklodes' => $product['slug'], 'ajanlat' => 1]) }}">{{ $product['primary_cta'] }} <span aria-hidden="true">→</span></a><a class="button button-outline" href="#funkciok">Megnézem a részleteket</a>@if(! empty($product['demo_url']))<a class="button button-outline" href="{{ $product['demo_url'] }}" target="_blank" rel="noopener noreferrer">Élő bemutató <span aria-hidden="true">↗</span></a>@endif</div>
        </div>
        <div>
            <x-marketing.product-visual :product="$product" />
            <p class="visual-note"><span></span> {{ $product['visual_label'] }} · {{ $product['visual_title'] }}</p>
        </div>
    </div>
</section>

<nav class="product-jump-nav" aria-label="Termékoldal szakaszai"><div class="container"><a href="#elonyok">Mit nyersz vele?</a><a href="#folyamat">Hogyan működik?</a><a href="#funkciok">Funkciók</a>@if(! empty($product['screenshots']))<a href="#kepernyok">Képernyők</a>@endif<a href="#bevezetes">Bevezetés és ár</a></div></nav>

<section id="elonyok" class="section product-value-section" data-home-reveal><div class="container"><div class="section-heading"><div><span class="eyebrow">A mindennapokban</span><h2>{{ $product['value_heading'] ?? 'Ezt teszi egyszerűbbé a műhelyben' }}</h2></div><p>{{ $product['value_intro'] ?? 'A rendszer a műhely napi feladatait és az ügyfél tájékoztatását egy folyamatba rendezi.' }}</p></div><div class="product-value-grid">@foreach($product['value_points'] as $point)<article class="product-value-card"><span>0{{ $loop->iteration }}</span><h3>{{ $point['title'] }}</h3><p>{{ $point['text'] }}</p></article>@endforeach</div></div></section>

<section id="folyamat" class="section" data-home-reveal><div class="container"><div class="section-heading"><div><span class="eyebrow">Bemutatott folyamat</span><h2>Így épül fel a megoldás</h2></div><p>{{ $product['flow_intro'] ?? 'A két oldal ugyanannak a folyamatnak a számukra fontos részét látja.' }}</p></div><ol class="process-grid process-grid-three">@foreach($product['flow'] as $step)<li><span>{{ $loop->iteration }}</span><h3>{{ $step['title'] }}</h3><p>{{ $step['text'] }}</p></li>@endforeach</ol></div></section>

<section id="funkciok" class="section product-features-section" data-home-reveal><div class="container"><div class="section-heading"><div><span class="eyebrow">Konkrét lehetőségek</span><h2>Mit tud ma a {{ $product['name'] }}?</h2></div><p>{{ $product['capabilities_intro'] ?? 'A kész működést és a külön bevezetést igénylő kapcsolatokat külön jelöljük.' }}</p></div><div class="product-feature-grid">@foreach($product['capabilities'] as $capability)<article class="product-feature-card"><span @class(['feature-state', 'feature-state-planned' => $capability['state'] === 'planned'])>{{ ['available' => 'Működő funkció', 'planned' => 'Külön egyeztetendő'][$capability['state']] }}</span><h3>{{ $capability['title'] }}</h3><p>{{ $capability['text'] }}</p></article>@endforeach</div><a class="text-link product-feature-cta" href="{{ route('contact', ['erdeklodes' => $product['slug'], 'ajanlat' => 1]) }}">Saját működésedre kérsz ajánlatot? <span aria-hidden="true">→</span></a></div></section>

@if(! empty($product['demo_highlights']))
<section class="section section-soft" id="bemutato" data-home-reveal>
    <div class="container">
        <div class="section-heading">
            <div><span class="eyebrow">A te munkamenetedből kiindulva</span><h2>Ezt mutatjuk meg a bemutatón</h2></div>
            <p>{{ $product['demo_intro'] ?? 'Mondj egy tipikus műhelyfeladatot. Megmutatjuk, hogyan követheted végig a rendszerben.' }}</p>
        </div>
        <div class="product-tour">
            @foreach($product['demo_highlights'] as $highlight)
                <article>
                    <div><h3>{{ $highlight['title'] }}</h3><p>{{ $highlight['text'] }}</p></div>
                    @if(! empty($highlight['image']))
                        <figure class="product-tour-image"><img src="{{ $highlight['image']['src'] }}" alt="{{ $highlight['image']['alt'] }}" width="1440" height="1000" loading="lazy"></figure>
                    @endif
                </article>
            @endforeach
        </div>
        <div class="button-row"><a class="button" href="{{ route('contact', ['erdeklodes' => $product['slug'], 'ajanlat' => 1]) }}">{{ $product['primary_cta'] }} <span aria-hidden="true">→</span></a></div>
    </div>
</section>
@endif

@if(! empty($product['screenshots']))
<section id="kepernyok" class="section section-soft product-gallery-section" data-home-reveal>
    <div class="container">
        <div class="section-heading"><div><span class="eyebrow">Valódi képernyők</span><h2>Nézd meg működés közben</h2></div><p>{{ $product['gallery_intro'] ?? 'A képek a működő rendszer helyi demójából, tesztadatokkal készültek. A bevezetett rendszer arculata és beállításai a műhelyhez igazíthatók.' }}</p></div>
        <div class="product-gallery-groups">
            @foreach(collect($product['screenshots'])->groupBy(fn ($screenshot) => $screenshot['group'] ?? '') as $group => $screenshots)
                <div class="product-gallery-group">
                    @if($group !== '')<h3>{{ $group }}</h3>@endif
                    <div class="product-gallery">
                        @foreach($screenshots as $screenshot)
                            <figure @class(['gallery-card', 'gallery-card-wide' => $loop->first && $group !== 'Nyomtatáshoz', 'gallery-card-portrait' => ($screenshot['orientation'] ?? null) === 'portrait', 'gallery-card-contained' => ($screenshot['fit'] ?? null) === 'contain'])>
                                <a class="gallery-image" href="{{ $screenshot['src'] }}" target="_blank" rel="noopener noreferrer" aria-label="{{ $screenshot['title'] }} — teljes kép megnyitása"><img src="{{ $screenshot['src'] }}" alt="{{ $screenshot['alt'] }}" width="{{ $screenshot['width'] ?? 1440 }}" height="{{ $screenshot['height'] ?? 1000 }}" loading="lazy"></a>
                                <figcaption><span>{{ $screenshot['label'] }}</span><strong>{{ $screenshot['title'] }}</strong></figcaption>
                            </figure>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

@if($relatedProjects->isNotEmpty())
<section class="section related-project-section" data-home-reveal>
    <div class="container">
        <div class="section-heading"><div><span class="eyebrow">Kapcsolódó munkánk</span><h2>További példa a gyakorlatból</h2></div></div>
        <div class="project-grid project-grid-related">
            @foreach($relatedProjects as $project)
                <x-marketing.project-card :project="$project" />
            @endforeach
        </div>
    </div>
</section>
@endif

<section id="bevezetes" class="section product-offer-section" data-home-reveal><div class="container product-offer-layout"><div class="product-offer-intro"><span class="eyebrow">Bevezetés és ajánlat</span><h2>Használható rendszert kapsz, nem csak hozzáférést.</h2><p>Átbeszéljük a jelenlegi munkamenetet, beállítjuk a szükséges alapokat, és segítünk az indulásban. A {{ $product['name'] }} pontos tartalma az ajánlatban lesz rögzítve.</p>@if($product['lifecycle_status'] === 'preview')<p class="product-offer-note">A FoodPro több étteremhez igazítható változata még készül. Az ajánlat a megvalósítás és a bevezetés egyeztetett körét tartalmazza.</p>@endif</div><aside class="product-offer-card"><span class="scope-kicker">Mit tartalmaz az indulás?</span><ul><li><strong>{{ config('pzdigital.product_offer.price_model') }}</strong><span>Nem havidíjas belépőár. A konkrét vételárat egyedi ajánlatban adjuk meg.</span></li><li><strong>{{ config('pzdigital.product_offer.included_start') }}</strong><span>Az induló időszakra a rendszerhez.</span></li><li><strong>{{ config('pzdigital.product_offer.setup') }}</strong><span>Beállítás, átadás és a használat közös áttekintése.</span></li></ul><p>{{ config('pzdigital.product_offer.note') }}</p><a class="button" href="{{ route('contact', ['erdeklodes' => $product['slug'], 'ajanlat' => 1]) }}">Árajánlatot kérek <span aria-hidden="true">→</span></a></aside></div></section>

<section class="section faq-section" data-home-reveal><div class="container narrow"><span class="eyebrow">{{ $product['name'] }} GYIK</span><h2>Fontos kérdések az ajánlat előtt</h2><div class="faq-list">@foreach($product['questions'] as $item)<details><summary>{{ $item['question'] }}</summary><p>{{ $item['answer'] }}</p></details>@endforeach</div></div></section>
<x-marketing.contact-cta :title="'Kérj ajánlatot a '.$product['name'].' bevezetésére'" :interest="$product['slug']" button-text="Árajánlatot kérek" description="Írd meg, hogyan dolgoztok most, és milyen feladatokra keresel megoldást. Ezek alapján a pontos funkciókra és indulási költségekre adunk ajánlatot." />
@endsection
