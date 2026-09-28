@props(['title' => 'Mondd el, mire van szükséged.', 'interest' => 'other', 'project' => null, 'buttonText' => 'Beszéljünk a feladatról', 'description' => 'Van egy folyamat, ami túl sok időt visz el? Vagy új rendszert, weboldalt tervezel? Írd meg röviden, és megnézzük, merre érdemes indulni.'])
@php($parameters = array_filter(['erdeklodes' => $interest, 'referencia' => $project, 'ajanlat' => $buttonText === 'Árajánlatot kérek' ? 1 : null]))
<section class="section cta-section">
    <div class="container cta-panel">
        <div>
            <span class="eyebrow eyebrow-light">Következő lépés</span>
            <h2>{{ $title }}</h2>
            <p>{{ $description }}</p>
        </div>
        <a class="button button-light" href="{{ route('contact', $parameters) }}">{{ $buttonText }} <span aria-hidden="true">→</span></a>
    </div>
</section>
