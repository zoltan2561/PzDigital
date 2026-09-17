@props(['block'])
<section class="case-section case-outcome">
    <div class="container case-outcome-inner">
        <div><span class="eyebrow">Projektlezárás</span><h2>{{ $block['heading'] }}</h2></div>
        <ul>@foreach($block['items'] as $item)<li>{{ $item }}</li>@endforeach</ul>
    </div>
</section>
