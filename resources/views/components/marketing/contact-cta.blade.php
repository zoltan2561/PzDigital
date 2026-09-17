@props(['title' => 'Mondd el, mire van szükséged.', 'interest' => 'other', 'project' => null])
@php($parameters = array_filter(['erdeklodes' => $interest, 'referencia' => $project]))
<section class="section cta-section">
    <div class="container cta-panel">
        <div>
            <span class="eyebrow eyebrow-light">Következő lépés</span>
            <h2>{{ $title }}</h2>
            <p>Új szoftvert tervezel, vagy a meglévő munkameneten egyszerűsítenél? Beszéljük át, milyen megoldás illik hozzá.</p>
        </div>
        <a class="button button-light" href="{{ route('contact', $parameters) }}">Beszéljünk a feladatról <span aria-hidden="true">→</span></a>
    </div>
</section>
