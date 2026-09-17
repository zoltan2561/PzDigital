@props(['steps', 'slug'])

<div class="workflow-demo" data-workflow-demo>
    <div class="workflow-demo-label"><span>Szemléltetett folyamat</span><small>Nem élő futtatás</small></div>
    <div class="workflow-demo-track" aria-hidden="true">
        @foreach($steps as $step)
            <span @class(['is-active' => $loop->first]) data-workflow-node>{{ $loop->iteration }}</span>
        @endforeach
    </div>
    <ol class="workflow-steps">
        @foreach($steps as $step)
            <li>
                <button type="button" data-workflow-step aria-pressed="{{ $loop->first ? 'true' : 'false' }}" aria-controls="workflow-panel-{{ $slug }}-{{ $loop->iteration }}">
                    <span>{{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                    <strong>{{ $step['title'] }}</strong>
                </button>
                <p id="workflow-panel-{{ $slug }}-{{ $loop->iteration }}">{{ $step['body'] }}</p>
            </li>
        @endforeach
    </ol>
    <div class="workflow-controls" aria-label="Folyamatszemléltető vezérlése">
        <button type="button" data-workflow-play>Lejátszás</button>
        <button type="button" data-workflow-pause disabled>Szünet</button>
        <button type="button" data-workflow-replay>Újra</button>
    </div>
</div>
