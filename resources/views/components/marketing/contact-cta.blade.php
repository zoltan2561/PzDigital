@props(['title' => 'Beszéljük át a következő fejlesztésedet.', 'interest' => 'other', 'project' => null])
@php($parameters = array_filter(['erdeklodes' => $interest, 'referencia' => $project]))
<section class="section cta-section">
    <div class="container cta-panel">
        <div>
            <span class="eyebrow eyebrow-light">Következő lépés</span>
            <h2>{{ $title }}</h2>
            <p>Írd meg, mit szeretnél elérni. Nem szükséges kész műszaki tervvel érkezned.</p>
        </div>
        <a class="button button-light" href="{{ route('contact', $parameters) }}">Beszéljünk a projektedről <span aria-hidden="true">→</span></a>
    </div>
</section>
