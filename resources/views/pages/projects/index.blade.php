@extends('layouts.marketing')
@php($title = 'Munkáink — PZ Digital')
@php($description = 'Korábbi és jelenlegi webes munkák a PZ Digital mögötti fejlesztői tapasztalatból.')

@section('content')
<section class="page-hero projects-index-hero">
    <div class="container narrow">
        <span class="eyebrow eyebrow-light">Munkáink</span>
        <h1>Weboldalak és rendszerek a gyakorlatban</h1>
        <p>Korábbi és jelenlegi munkák a PZ Digital mögötti fejlesztői tapasztalatból. Ismerd meg az egyes projektek feladatát és megvalósítását.</p>
    </div>
</section>

<section class="section section-projects-dark">
    <div class="container">
        <div class="project-grid project-grid-index">
            @foreach($projects as $project)
                <x-marketing.project-card :project="$project" />
            @endforeach
        </div>
    </div>
</section>

<x-marketing.contact-cta />
@endsection
