@extends('layouts.marketing')
@php($title = 'Munkáink — PZ Digital')
@php($description = 'Korábbi és jelenlegi webes munkák a PZ Digital mögötti fejlesztői tapasztalatból.')

@section('content')
<section class="page-hero">
    <div class="container narrow">
        <span class="eyebrow eyebrow-light">Munkáink</span>
        <h1>Valódi projektek, különböző üzleti helyzetekre</h1>
        <p>Korábbi és jelenlegi munkák a PZ Digital mögötti fejlesztői tapasztalatból. Minden bemutató csak ellenőrzött, nyilvánosan látható részletekre épül.</p>
    </div>
</section>

<section class="section section-projects-dark">
    <div class="container">
        <div class="project-grid">
            @foreach($projects as $project)
                <x-marketing.project-card :project="$project" />
            @endforeach
        </div>
    </div>
</section>

<x-marketing.contact-cta title="Hasonló projekten gondolkodsz?" />
@endsection
