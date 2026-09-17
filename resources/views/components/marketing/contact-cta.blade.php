@props(['title' => 'Van egy folyamat, amin egyszerűsítenél?', 'interest' => null, 'project' => null])
@php($parameters = array_filter(['erdeklodes' => $interest, 'referencia' => $project]))
<section class="section cta-section">
    <div class="container cta-panel">
        <div>
            <span class="eyebrow eyebrow-light">Következő lépés</span>
            <h2>{{ $title }}</h2>
            <p>Írd meg röviden a célodat és azt, mi nem működik most jól. Nem szükséges kész műszaki specifikációval érkezned.</p>
        </div>
        <a class="button button-light" href="{{ route('contact', $parameters) }}">Beszéljünk róla <span aria-hidden="true">→</span></a>
    </div>
</section>
