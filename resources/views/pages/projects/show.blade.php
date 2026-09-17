@extends('layouts.marketing')
@php($title = $project['name'].' referencia — PZ Digital')
@php($description = $project['summary'])

@section('content')
<section class="project-detail-hero">
    <div class="container project-detail-grid">
        <div class="project-detail-copy">
            <span class="eyebrow">Referenciamunka</span>
            <div class="project-categories">{{ implode(' · ', $project['categories']) }}</div>
            <h1>{{ $project['name'] }}</h1>
            <p>{{ $project['summary'] }}</p>
            <div class="button-row">
                <a class="button" href="{{ route('contact', ['referencia' => $project['slug']]) }}">Hasonló projektet tervezek <span aria-hidden="true">→</span></a>
                @if($project['public_url'])
                    <a class="button button-dark-outline" href="{{ $project['public_url'] }}" target="_blank" rel="noopener noreferrer">Éles referenciaoldal <span aria-hidden="true">↗</span></a>
                @endif
            </div>
            <p class="history-note">{{ $project['role_description'] }}</p>
        </div>
        <figure class="project-detail-screen">
            <img src="{{ $project['media'][0]['src'] }}" alt="{{ $project['media'][0]['alt'] }}" width="1440" height="1000" fetchpriority="high">
        </figure>
    </div>
</section>

<section class="section">
    <div class="container project-case-grid">
        <article><span>01</span><h2>A feladat</h2><p>{{ $project['case_study_sections']['task'] }}</p></article>
        <article><span>02</span><h2>Saját szerep</h2><p>{{ $project['case_study_sections']['role'] }}</p></article>
        <article><span>03</span><h2>Igazolt megoldások</h2><ul class="check-list large">@foreach($project['case_study_sections']['solutions'] as $solution)<li>{{ $solution }}</li>@endforeach</ul></article>
    </div>
</section>

<section class="section section-soft">
    <div class="container">
        <div class="section-heading"><div><span class="eyebrow">Projektképek</span><h2>Asztali és mobil nézet</h2></div><p>A képernyőképek a nyilvános oldalról készültek, módosító művelet és bejelentkezés nélkül.</p></div>
        <div class="reference-gallery">
            @foreach($project['media'] as $medium)
                <figure @class(['reference-shot', 'reference-shot-mobile' => $loop->iteration === 2])>
                    <div><img src="{{ $medium['src'] }}" alt="{{ $medium['alt'] }}" width="{{ $loop->first ? '1440' : '390' }}" height="{{ $loop->first ? '1000' : '844' }}" loading="lazy"></div>
                    <figcaption>{{ $medium['viewport'] }} · nyilvános felület</figcaption>
                </figure>
            @endforeach
        </div>
    </div>
</section>

<x-marketing.contact-cta :title="'Hasonló projektet tervezel, mint a '.$project['name'].'?'" :project="$project['slug']" />
@endsection
