@props(['block', 'slug'])
<section id="mukodes" class="case-section case-workflow">
    <div class="container case-split">
        <div><span class="eyebrow">Működés</span><h2>{{ $block['heading'] }}</h2><p>A lépések előre rögzített magyarázatok. A bemutató nem indít külső szolgáltatást és nem módosít valódi adatot.</p></div>
        <x-marketing.workflow-demo :steps="$block['steps']" :slug="$slug" />
    </div>
</section>
