@props(['project'])

<article class="project-featured" data-project-featured="{{ $project['slug'] }}">
    <a class="project-featured-image" href="{{ route('projects.show', $project['slug']) }}" aria-label="{{ $project['name'] }} projekt részletei">
        <img src="{{ $project['media'][0]['card_src'] ?? $project['media'][0]['src'] }}" alt="{{ $project['media'][0]['alt'] }}" width="1440" height="{{ isset($project['media'][0]['card_src']) ? 900 : 1000 }}" loading="lazy">
        <span>Kiemelt referenciamunka</span>
    </a>
    <div class="project-featured-body">
        <div class="project-categories">{{ implode(' · ', $project['categories']) }}</div>
        <h3>{{ $project['showcase_headline'] ?? $project['name'] }}</h3>
        <p>{{ $project['summary'] }}</p>
        <dl class="project-brief">
            <div><dt>Feladat</dt><dd>{{ $project['case_study_sections']['task'] }}</dd></div>
            <div><dt>Megoldás</dt><dd>{{ implode(' · ', array_slice($project['case_study_sections']['solutions'], 0, 2)) }}</dd></div>
        </dl>
        <a class="text-link" href="{{ route('projects.show', $project['slug']) }}">Projekt részletei <span aria-hidden="true">→</span></a>
    </div>
</article>
