@props(['projects'])

@php($heroOrder = ['gyroscity', 'zcutzbarber', 'napiinfo'])
@php($heroProjects = $projects->sortBy(fn (array $project) => array_search($project['slug'], $heroOrder, true))->values())
@php($activeProject = $heroProjects->first())

@if($activeProject)
<div class="hero-stage" data-hero-stage>
    <div class="hero-stage-frame" data-hero-stage-frame>
        <span class="hero-stage-kicker" data-hero-stage-label>{{ $activeProject['showcase_label'] }}</span>
        <a href="{{ route('projects.show', $activeProject['slug']) }}" data-hero-stage-link>
            <img src="{{ $activeProject['media'][0]['card_src'] ?? $activeProject['media'][0]['src'] }}" alt="{{ $activeProject['media'][0]['alt'] }}" width="1440" height="1000" fetchpriority="high" data-hero-stage-image>
        </a>
        <div class="hero-stage-caption">
            <strong data-hero-stage-title>{{ $activeProject['name'] }}</strong>
            <span data-hero-stage-flow>{{ $activeProject['showcase_flow'] }}</span>
        </div>
        <svg class="pz-ribbon" viewBox="0 0 340 72" aria-hidden="true">
            <path d="M2 44H76L102 18H188L214 44H338" />
            <path d="M76 44L102 70H188L214 44" />
        </svg>
    </div>

    <div class="hero-stage-options" aria-label="Működési példa kiválasztása">
        @foreach($heroProjects as $project)
            <div class="hero-stage-option">
                <button type="button"
                    data-hero-option
                    data-image="{{ $project['media'][0]['card_src'] ?? $project['media'][0]['src'] }}"
                    data-alt="{{ $project['media'][0]['alt'] }}"
                    data-label="{{ $project['showcase_label'] }}"
                    data-title="{{ $project['name'] }}"
                    data-flow="{{ $project['showcase_flow'] }}"
                    data-url="{{ route('projects.show', $project['slug']) }}"
                    aria-pressed="{{ $loop->first ? 'true' : 'false' }}">
                    <span>{{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                    <strong>{{ $project['showcase_label'] }}</strong>
                    <small>{{ $project['name'] }}</small>
                </button>
                <a href="{{ route('projects.show', $project['slug']) }}" aria-label="{{ $project['name'] }} projektoldala">↗</a>
            </div>
        @endforeach
    </div>
</div>
@endif
