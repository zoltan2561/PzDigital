@extends('layouts.marketing')
@php($title = 'Kapcsolat — PZ Digital')
@php($description = 'Kérj termékbemutatót vagy írj a PZ Digitalnak egyedi webes fejlesztési elképzelésedről.')

@section('content')
<section class="contact-hero">
    <div class="container contact-grid">
        <div class="contact-copy"><span class="eyebrow eyebrow-light">Kapcsolat</span><h1>Beszéljünk a folyamatról, amin egyszerűsítenél.</h1><p>Írd meg röviden, mivel foglalkozol és hol keletkezik a legtöbb pluszmunka. Az első válaszban a következő tisztázandó lépéseket foglaljuk össze.</p><div class="contact-note"><strong>Mi történik beküldés után?</strong><ol><li>Rögzítjük és átnézzük a megkeresést.</li><li>E-mailben pontosító kérdéseket küldünk.</li><li>Indokolt esetben bemutatót vagy egyeztetést szervezünk.</li></ol></div></div>
        <div class="form-card">
            <div class="form-heading"><span>Projekt- és bemutatókérés</span><p>A *-gal jelölt mezők kötelezők.</p></div>
            @if($errors->any())<div class="form-alert" role="alert"><strong>A beküldést nem tudtuk feldolgozni.</strong><p>Kérjük, ellenőrizd a megjelölt mezőket.</p>@error('form')<p>{{ $message }}</p>@enderror</div>@endif
            <form method="post" action="{{ route('contact.store') }}" data-inquiry-form>
                @csrf
                <input type="hidden" name="submission_token" value="{{ old('submission_token', $submissionToken) }}">
                <input type="hidden" name="source_path" value="{{ old('source_path', request()->path() === '/' ? '/' : '/'.request()->path()) }}">
                <input type="hidden" name="product_slug" value="{{ old('product_slug', in_array($selectedInterest, ['szervizpro', 'foodshop'], true) ? $selectedInterest : '') }}" data-product-slug>
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
                <div class="field"><label for="interest_type">Miben segíthetünk? *</label><select id="interest_type" name="interest_type" required data-interest><option value="">Válassz egy lehetőséget</option><option value="szervizpro" @selected(old('interest_type', $selectedInterest) === 'szervizpro')>SzervizPRO bemutató</option><option value="foodshop" @selected(old('interest_type', $selectedInterest) === 'foodshop')>FoodShop bemutató</option><option value="custom_development" @selected(old('interest_type', $selectedInterest) === 'custom_development')>Egyedi fejlesztés</option><option value="other" @selected(old('interest_type', $selectedInterest) === 'other')>Más kérdés</option></select>@error('interest_type')<span class="field-error">{{ $message }}</span>@enderror</div>
                <div class="field"><label for="message">Rövid leírás <span>(egyedi fejlesztésnél kötelező)</span></label><textarea id="message" name="message" rows="5" maxlength="3000" placeholder="Mivel foglalkozol, és melyik folyamat okozza a legtöbb pluszmunkát?">{{ old('message') }}</textarea>@error('message')<span class="field-error">{{ $message }}</span>@enderror</div>
                <p class="privacy-note">A megadott adatokat a kapcsolatfelvétel kezelésére használjuk. Az éles indulás előtt a végleges <a href="{{ route('privacy') }}">adatkezelési tájékoztató</a> jóváhagyása szükséges.</p>
                <button class="button button-full" type="submit" data-submit>Megkeresés elküldése <span aria-hidden="true">→</span></button>
            </form>
        </div>
    </div>
</section>
@endsection
