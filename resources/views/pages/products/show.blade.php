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
            <div class="button-row"><a class="button" href="{{ route('contact', ['erdeklodes' => $product['slug']]) }}">Bemutatót kérek <span>→</span></a><a class="button button-outline" href="#folyamat">Megnézem a folyamatot</a></div>
        </div>
        <div><x-marketing.product-visual :product="$product" /><p class="visual-note">Illusztratív látványterv, nem ellenőrzött termékképernyő.</p></div>
    </div>
</section>

<section id="folyamat" class="section"><div class="container"><div class="section-heading"><div><span class="eyebrow">Példafolyamat</span><h2>Így épül fel a bemutatott működés</h2></div><p>A lépések koncepciót jelölnek; a bemutatón csak ténylegesen elérhető funkciót mutatunk kész megoldásként.</p></div><ol class="process-grid process-grid-three">@foreach($product['flow'] as $step)<li><span>{{ $loop->iteration }}</span><h3>{{ $step['title'] }}</h3><p>{{ $step['text'] }}</p></li>@endforeach</ol></div></section>

<section class="section section-soft"><div class="container split-content"><div><span class="eyebrow">A megoldás fókusza</span><h2>A működésedhez igazított bevezetés</h2><p>A bemutató célja, hogy a jelenlegi folyamathoz mérten látható legyen, hol segíthet a {{ $product['name'] }} és hol van szükség más megoldásra.</p><ul class="check-list large">@foreach($product['benefits'] as $benefit)<li>{{ $benefit }}</li>@endforeach</ul></div><aside class="scope-card"><h3>A szolgáltatási keret egyeztetendő részei</h3><ul><li>beállítás és arculati illesztés</li><li>kezdeti adat-előkészítés</li><li>bevezetés és betanítás</li><li>hosztolás, mentés és frissítés</li><li>támogatási és továbbfejlesztési keret</li></ul><p>A korlátlan fejlesztés, harmadik fél díja és 24/7 ügyfélszolgálat nem automatikus része a csomagnak.</p></aside></div></section>

<section class="section faq-section"><div class="container narrow"><span class="eyebrow">{{ $product['name'] }} GYIK</span><h2>Fontos kérdések a bemutató előtt</h2><div class="faq-list">@foreach($product['questions'] as $item)<details><summary>{{ $item['question'] }}</summary><p>{{ $item['answer'] }}</p></details>@endforeach</div></div></section>
<x-marketing.contact-cta :title="'Nézd meg, hogyan illeszkedhet hozzád a '.$product['name']" :interest="$product['slug']" />
@endsection
