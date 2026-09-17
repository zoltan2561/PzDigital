@extends('layouts.marketing')
@php($title = $project['name'].' referencia — PZ Digital')
@php($description = $project['case_study']['lead'] ?? $project['summary'])
@php($publishedBlocks = collect($project['case_study']['blocks'] ?? [])->where('publication_status', 'published'))

@section('content')
<article class="case-study case-accent-{{ $project['accent'] }}">
    <header class="case-hero">
        <div class="container case-hero-grid">
            <div class="case-hero-copy">
                <span class="eyebrow eyebrow-light">Referenciamunka · {{ $project['showcase_label'] ?? $project['categories'][0] }}</span>
                <h1>{{ $project['case_study']['headline'] ?? $project['name'] }}</h1>
                <p>{{ $project['case_study']['lead'] ?? $project['summary'] }}</p>
                <div class="button-row">
                    <a class="button" href="{{ route('contact', ['referencia' => $project['slug']]) }}">Hasonló projektet tervezek <span aria-hidden="true">→</span></a>
                    @if($project['public_url'])
                        <a class="button button-outline" href="{{ $project['public_url'] }}" target="_blank" rel="noopener noreferrer">Éles referenciaoldal <span aria-hidden="true">↗</span></a>
                    @endif
                </div>
                <p class="history-note">{{ $project['role_description'] }}</p>
            </div>
            <figure class="case-hero-screen">
                <img src="{{ $project['media'][0]['src'] }}" alt="{{ $project['media'][0]['alt'] }}" width="1440" height="1000" fetchpriority="high">
                <figcaption><span>{{ $project['name'] }}</span><small>{{ $project['showcase_flow'] ?? implode(' · ', $project['categories']) }}</small></figcaption>
            </figure>
        </div>
        <nav class="case-anchor-nav" aria-label="Projektoldal szakaszai">
            <div class="container"><a href="#attekintes">Áttekintés</a><a href="#mukodes">Működés</a><a href="#kepernyok">Képernyők</a></div>
        </nav>
    </header>

    <section class="case-facts">
        <div class="container">
            <dl>
                <div><dt>Feladat</dt><dd>{{ $project['case_study_sections']['task'] }}</dd></div>
                <div><dt>Saját szerep</dt><dd>{{ $project['case_study_sections']['role'] }}</dd></div>
                <div><dt>Célcsoport</dt><dd>{{ $project['case_study']['audience'] ?? 'A projekt nyilvános felületének használói' }}</dd></div>
                @if($project['year'])<div><dt>Év</dt><dd>{{ $project['year'] }}</dd></div>@endif
            </dl>
        </div>
    </section>

    @foreach($publishedBlocks as $block)
        @switch($block['type'])
            @case('overview')
                <x-marketing.case-study.overview :block="$block" />
                @break
            @case('workflow')
                <x-marketing.case-study.workflow :block="$block" :slug="$project['slug']" />
                @break
            @case('integration')
                <x-marketing.case-study.integration :block="$block" />
                @break
            @case('gallery')
                <x-marketing.case-study.gallery :block="$block" :project="$project" />
                @break
            @case('outcome')
                <x-marketing.case-study.outcome :block="$block" />
                @break
        @endswitch
    @endforeach

    <section class="case-closing">
        <div class="container case-closing-grid">
            <div><span class="eyebrow eyebrow-light">Hasonló feladatod van?</span><h2>{{ $project['slug'] === 'gyroscity' ? 'Hasonló rendelési rendszert szeretnél?' : 'A megkeresésben a '.$project['name'].' referencia már ki lesz választva.' }}</h2><a class="button" href="{{ route('contact', ['referencia' => $project['slug']]) }}">Beszéljünk róla <span aria-hidden="true">→</span></a></div>
            @if($nextProject)
                <a class="next-project" href="{{ route('projects.show', $nextProject['slug']) }}"><span>Következő projekt</span><strong>{{ $nextProject['name'] }}</strong><small>{{ $nextProject['showcase_title'] ?? $nextProject['summary'] }}</small><b aria-hidden="true">↗</b></a>
            @endif
        </div>
    </section>
</article>
@endsection
