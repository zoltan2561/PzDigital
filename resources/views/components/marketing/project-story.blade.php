@props(['projects'])

@if($projects->isNotEmpty())
<section id="munkaink" class="section project-story-section" data-project-showcase>
    <div class="container">
        <div class="section-heading project-story-heading">
            <div><span class="eyebrow">Munkáink</span><h2>A felülettől a működő háttérfolyamatig.</h2></div>
            <div class="section-heading-action"><p>Három külön rendszer, három külön üzleti feladat. Görgess végig a történeteken, vagy nyisd meg a részletes esettanulmányt.</p><a class="text-link" href="{{ route('projects.index') }}">Összes referencia <span>→</span></a></div>
        </div>
        <div class="project-story-layout">
            <div class="project-story-stage" aria-hidden="true" data-project-stage>
                @foreach($projects as $project)
                    <figure data-project-media="{{ $project['slug'] }}" @class(['is-active' => $loop->first])>
                        <img src="{{ $project['media'][0]['card_src'] ?? $project['media'][0]['src'] }}" alt="" width="1440" height="1000" loading="{{ $loop->first ? 'eager' : 'lazy' }}">
                        <figcaption><span>{{ $project['showcase_label'] }}</span><strong>{{ $project['name'] }}</strong><small>{{ $project['showcase_flow'] }}</small></figcaption>
                    </figure>
                @endforeach
                <svg class="pz-ribbon project-story-ribbon" viewBox="0 0 340 72" aria-hidden="true"><path d="M2 44H76L102 18H188L214 44H338"/><path d="M76 44L102 70H188L214 44"/></svg>
            </div>
            <div class="project-story-list">
                @foreach($projects as $project)
                    <article id="projekt-{{ $project['slug'] }}" data-project-story="{{ $project['slug'] }}" @class(['is-active' => $loop->first]) tabindex="-1">
                        <figure class="project-story-inline-media"><img src="{{ $project['media'][0]['card_src'] ?? $project['media'][0]['src'] }}" alt="{{ $project['media'][0]['alt'] }}" width="1440" height="1000" loading="lazy"></figure>
                        <span class="project-story-index">{{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }} / {{ str_pad((string) $projects->count(), 2, '0', STR_PAD_LEFT) }}</span>
                        <p class="project-story-label">{{ $project['showcase_label'] }} · {{ $project['name'] }}</p>
                        <h3>{{ $project['showcase_title'] }}</h3>
                        <p>{{ $project['summary'] }}</p>
                        <div class="project-story-tags">@foreach(array_slice($project['categories'], 0, 3) as $category)<span>{{ $category }}</span>@endforeach</div>
                        <a class="text-link" href="{{ route('projects.show', $project['slug']) }}">A rendszer bemutatása <span>→</span></a>
                    </article>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endif
