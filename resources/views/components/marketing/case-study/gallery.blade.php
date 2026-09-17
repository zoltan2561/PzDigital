@props(['block', 'project'])
<section id="kepernyok" class="case-section case-gallery">
    <div class="container">
        <div class="section-heading"><div><span class="eyebrow">Képernyők</span><h2>{{ $block['heading'] }}</h2></div><p>{{ $block['body'] }}</p></div>
        <div class="reference-gallery">
            @foreach($project['media'] as $medium)
                <figure @class(['reference-shot', 'reference-shot-mobile' => $loop->iteration === 2])>
                    <div><img src="{{ $medium['src'] }}" alt="{{ $medium['alt'] }}" width="{{ $loop->first ? '1440' : '390' }}" height="{{ $loop->first ? '1000' : '844' }}" loading="lazy"></div>
                    <figcaption>{{ $medium['viewport'] }} · valódi, nyilvános felület</figcaption>
                </figure>
            @endforeach
        </div>
    </div>
</section>
