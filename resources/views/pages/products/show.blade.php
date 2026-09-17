@extends('layouts.marketing')
@php($title = $product['name'].' — PZ Digital')
@php($description = $product['summary'])

@section('content')
<section class="product-hero">
    <div class="container hero-grid">
        <div class="hero-copy">
            <span class="status-badge status-on-dark">{{ $product['status_label'] }}</span>
            <span class="eyebrow eyebrow-light">{{ $product['eyebrow'] }}</span>
            <h1>{{ $product['headline'] }}</h1>
            <p>{{ $product['summary'] }}</p>
            <div class="button-row"><a class="button" href="{{ route('contact', ['erdeklodes' => $product['slug']]) }}">{{ $product['primary_cta'] }} <span>→</span></a><a class="button button-outline" href="#folyamat">Megnézem a folyamatot</a></div>
        </div>
        <div>
            <x-marketing.product-visual :product="$product" />
            <p class="visual-note"><span></span> {{ $product['visual_label'] }} · {{ $product['visual_title'] }}</p>
        </div>
    </div>
</section>

<section id="folyamat" class="section"><div class="container"><div class="section-heading"><div><span class="eyebrow">Bemutatott folyamat</span><h2>Így épül fel a megoldás</h2></div><p>{{ $product['lifecycle_status'] === 'preview' ? 'A termékváltozat végleges működését és kereteit az igényfelmérés pontosítja.' : 'A két oldal ugyanannak a folyamatnak a számukra fontos részét látja.' }}</p></div><ol class="process-grid process-grid-three">@foreach($product['flow'] as $step)<li><span>{{ $loop->iteration }}</span><h3>{{ $step['title'] }}</h3><p>{{ $step['text'] }}</p></li>@endforeach</ol></div></section>

@if(! empty($product['demo_highlights']))
<section class="section section-soft" id="bemutato">
    <div class="container">
        <div class="section-heading">
            <div><span class="eyebrow">A te munkamenetedből kiindulva</span><h2>{{ $product['lifecycle_status'] === 'preview' ? 'Miről egyeztetünk a bemutatón?' : 'Mit nézz meg a bemutatón?' }}</h2></div>
            <p>{{ $product['lifecycle_status'] === 'preview' ? 'Ismerd meg a megoldás irányát, és mondd el, hogyan működik a vállalkozásod.' : 'Hozz egy jellemző feladatot a műhelyedből. Ezen keresztül megmutatjuk a fontos lépéseket.' }}</p>
        </div>
        <div class="product-tour">
            @foreach($product['demo_highlights'] as $highlight)
                <article>
                    <div><h3>{{ $highlight['title'] }}</h3><p>{{ $highlight['text'] }}</p></div>
                    @if(! empty($highlight['image']))
                        <figure class="product-tour-image"><img src="{{ $highlight['image']['src'] }}" alt="{{ $highlight['image']['alt'] }}" width="1440" height="1000" loading="lazy"></figure>
                    @else
                        <div class="product-tour-media">
                            <span>Képes bemutató hamarosan</span>
                            <small>A részletes képsor előkészítés alatt.</small>
                        </div>
                    @endif
                </article>
            @endforeach
        </div>
        <div class="button-row"><a class="button" href="{{ route('contact', ['erdeklodes' => $product['slug']]) }}">{{ $product['primary_cta'] }} <span aria-hidden="true">→</span></a></div>
    </div>
</section>
@endif

@if(! empty($product['screenshots']))
<section class="section section-soft product-gallery-section">
    <div class="container">
        <div class="section-heading"><div><span class="eyebrow">{{ $product['lifecycle_status'] === 'preview' ? 'Referenciaképernyők' : 'Valódi képernyők' }}</span><h2>{{ $product['lifecycle_status'] === 'preview' ? 'Az éles előzmény felülete' : 'Nézd meg működés közben' }}</h2></div><p>{{ $product['lifecycle_status'] === 'preview' ? 'A képek a kapcsolódó éles projekt nyilvános felületéről készültek. A több vállalkozásnál bevezethető termékváltozat előkészítés alatt áll.' : 'A képek a jelenlegi demóverzióból készültek. A bevezetett rendszer arculata és beállításai a műhelyhez igazíthatók.' }}</p></div>
        <div class="product-gallery">
            @foreach($product['screenshots'] as $screenshot)
                <figure @class(['gallery-card', 'gallery-card-wide' => $loop->first])>
                    <div class="gallery-image"><img src="{{ $screenshot['src'] }}" alt="{{ $screenshot['alt'] }}" width="1440" height="1000" loading="lazy"></div>
                    <figcaption><span>{{ $screenshot['label'] }}</span><strong>{{ $screenshot['title'] }}</strong></figcaption>
                </figure>
            @endforeach
        </div>
    </div>
</section>
@endif

@if($relatedProjects->isNotEmpty())
<section class="section related-project-section">
    <div class="container">
        <div class="section-heading"><div><span class="eyebrow">Éles előzmény</span><h2>Valós projektből továbbépíthető termékirány</h2></div><p>GyrosCity — a FoodShop éles előzménye. Referenciaképernyő. Az élő oldal nem tesztkörnyezet.</p></div>
        <div class="project-grid project-grid-related">
            @foreach($relatedProjects as $project)
                <x-marketing.project-card :project="$project" />
            @endforeach
        </div>
    </div>
</section>
@endif

<section class="section"><div class="container split-content"><div><span class="eyebrow">A megoldás fókusza</span><h2>A működésedhez igazított bevezetés</h2><p>A bemutatón együtt végignézzük, hogyan illeszkedik a {{ $product['name'] }} a jelenlegi folyamatodhoz, és mely pontokat érdemes a vállalkozásodra szabni.</p><ul class="check-list large">@foreach($product['benefits'] as $benefit)<li>{{ $benefit }}</li>@endforeach</ul></div><aside class="scope-card"><span class="scope-kicker">A bevezetés részei</span><h3>Előre tisztázott, követhető keretek</h3><ul><li>beállítás és arculati illesztés</li><li>kezdeti adat-előkészítés</li><li>bevezetés és betanítás</li><li>hosztolás, mentés és frissítés</li><li>támogatási és továbbfejlesztési keret</li></ul><p>A pontos tartalom és költség a bemutató után, a valós igények ismeretében kerül az ajánlatba.</p></aside></div></section>

<section class="section faq-section"><div class="container narrow"><span class="eyebrow">{{ $product['name'] }} GYIK</span><h2>Fontos kérdések a bemutató előtt</h2><div class="faq-list">@foreach($product['questions'] as $item)<details><summary>{{ $item['question'] }}</summary><p>{{ $item['answer'] }}</p></details>@endforeach</div></div></section>
<x-marketing.contact-cta :title="'Nézd meg, hogyan illeszkedhet hozzád a '.$product['name']" :interest="$product['slug']" />
@endsection
