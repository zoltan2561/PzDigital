@extends('layouts.marketing')
@php($title = 'Kapcsolat — SzoftPont')
@php($description = 'Kérj termékbemutatót vagy írj a SzoftPontnak egyedi webes fejlesztési elképzelésedről.')
@php($activeProject = old('project_slug', $selectedProject))

@section('content')
<section class="contact-hero">
    <div class="container contact-grid">
        <div class="contact-copy"><span class="eyebrow eyebrow-light">Kapcsolat</span><h1>Mit szeretnél megoldani?</h1><p>Írd meg, mire van szükséged. Nem kell kész tervet vagy műszaki leírást küldened. Új fejlesztésről és meglévő rendszer továbbfejlesztéséről is egyeztethetünk.</p><div class="contact-note"><strong>Mi történik beküldés után?</strong><p>Átnézzük, amit írtál, és jelentkezünk, hogy átbeszéljük a részleteket.</p></div><p class="contact-direct">Közvetlen e-mail: <a href="mailto:{{ config('pzdigital.contact_email') }}">{{ config('pzdigital.contact_email') }}</a></p></div>
        <div class="form-card">
            <div class="form-heading"><span>Írj nekünk</span><p>A *-gal jelölt mezők kötelezők.</p></div>
            @if($errors->any())<div class="form-alert" role="alert"><strong>{{ $errors->has('form') ? 'A beküldést nem tudtuk feldolgozni.' : 'Nézd át a megjelölt mezőket.' }}</strong>@if($errors->has('form'))<p>{{ $errors->first('form') }}</p>@else<p>Javítsd az adatokat, majd küldd el újra.</p>@endif</div>@endif
            <form method="post" action="{{ route('contact.store') }}" data-inquiry-form>
                @csrf
                <input type="hidden" name="submission_token" value="{{ old('submission_token', $submissionToken) }}">
                <input type="hidden" name="source_path" value="{{ old('source_path', request()->path() === '/' ? '/' : '/'.request()->path()) }}">
                <input type="hidden" name="product_slug" value="{{ old('product_slug', $selectedProduct) }}" data-product-slug>
                <input type="hidden" name="project_slug" value="{{ old('project_slug', $selectedProject) }}" data-project-slug>
                @foreach(['utm_source', 'utm_medium', 'utm_campaign'] as $utm)<input type="hidden" name="{{ $utm }}" value="{{ old($utm, request()->query($utm)) }}">@endforeach
                <div class="honeypot" aria-hidden="true"><label for="website">Weboldal</label><input id="website" name="website" type="text" tabindex="-1" autocomplete="off"></div>
                <div class="form-row">
                    <div class="field"><label for="name">Név *</label><input id="name" name="name" type="text" value="{{ old('name') }}" autocomplete="name" required maxlength="120" @error('name') aria-invalid="true" aria-describedby="name-error" @enderror>@error('name')<span class="field-error" id="name-error">{{ $message }}</span>@enderror</div>
                    <div class="field"><label for="email">E-mail *</label><input id="email" name="email" type="email" value="{{ old('email') }}" autocomplete="email" required maxlength="254" @error('email') aria-invalid="true" aria-describedby="email-error" @enderror>@error('email')<span class="field-error" id="email-error">{{ $message }}</span>@enderror</div>
                </div>
                <div class="form-row">
                    <div class="field"><label for="company">Cég <span>(opcionális)</span></label><input id="company" name="company" type="text" value="{{ old('company') }}" autocomplete="organization" maxlength="160"></div>
                    <div class="field"><label for="phone">Telefon <span>(opcionális)</span></label><input id="phone" name="phone" type="tel" value="{{ old('phone') }}" autocomplete="tel" maxlength="40"></div>
                </div>
                <div class="field">
                    <label for="interest_type">Miben segíthetünk? *</label>
                    <select id="interest_type" name="interest_type" required data-interest>
                        <option value="">Válassz egy lehetőséget</option>
                        <optgroup label="Projekt típusa">
                            @foreach($inquiryInterests as $value => $label)
                                <option value="{{ $value }}" @selected(old('interest_type', $selectedInterest) === $value)>{{ $label }}</option>
                            @endforeach
                        </optgroup>
                        <optgroup label="Saját termék">
                            @foreach($products as $product)
                                <option value="{{ $product['slug'] }}" data-product-option="{{ $product['slug'] }}" @selected(old('interest_type', $selectedInterest) === $product['slug'])>{{ $product['name'] }} — {{ $product['lifecycle_status'] === 'preview' ? 'egyeztetés' : 'bemutató' }}</option>
                            @endforeach
                        </optgroup>
                        @if($activeProject && $projects->has($activeProject))
                            <option value="project_reference" data-project-option="{{ $activeProject }}" @selected(old('interest_type', $selectedInterest) === 'project_reference')>{{ $projects[$activeProject]['name'] }} projekthez hasonló fejlesztés</option>
                        @endif
                        <option value="custom_development" @selected(old('interest_type', $selectedInterest) === 'custom_development')>Egyedi fejlesztés</option>
                        <option value="other" @selected(old('interest_type', $selectedInterest) === 'other')>Más kérdés</option>
                    </select>
                    @error('interest_type')<span class="field-error">{{ $message }}</span>@enderror
                    @error('product_slug')<span class="field-error">{{ $message }}</span>@enderror
                    @error('project_slug')<span class="field-error">{{ $message }}</span>@enderror
                </div>
                <div class="field"><label for="message">Rövid leírás <span>(projektmegkeresésnél kötelező)</span></label><textarea id="message" name="message" rows="5" maxlength="3000" placeholder="Mi a célod, és mi nem működik most jól?">{{ old('message') }}</textarea>@error('message')<span class="field-error">{{ $message }}</span>@enderror</div>
                <p class="privacy-note">A megadott adatokat a kapcsolatfelvétel kezelésére használjuk. Az éles indulás előtt a végleges <a href="{{ route('privacy') }}">adatkezelési tájékoztató</a> jóváhagyása szükséges.</p>
                <button class="button button-full" type="submit" data-submit>Megkeresés elküldése <span aria-hidden="true">→</span></button>
            </form>
        </div>
    </div>
</section>
@endsection
