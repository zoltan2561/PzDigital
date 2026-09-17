@props(['project'])

<article class="project-card accent-{{ $project['accent'] }}" data-project-card="{{ $project['slug'] }}">
    <a class="project-card-image" href="{{ route('projects.show', $project['slug']) }}" aria-label="{{ $project['name'] }} projekt megtekintése">
        <img src="{{ $project['media'][0]['src'] }}" alt="{{ $project['media'][0]['alt'] }}" width="1440" height="1000" loading="lazy">
        <span>Referenciamunka</span>
    </a>
    <div class="project-card-body">
        <div class="project-categories">{{ implode(' · ', $project['categories']) }}</div>
        <h3><a href="{{ route('projects.show', $project['slug']) }}">{{ $project['name'] }}</a></h3>
        <p>{{ $project['summary'] }}</p>
        <a class="text-link" href="{{ route('projects.show', $project['slug']) }}">Projekt megtekintése <span aria-hidden="true">→</span></a>
    </div>
</article>
