@extends('layouts.marketing')
@php($title = 'Demóigénylés — SzoftLab')
@php($description = 'Kérj hozzáférést a SzervizPro vagy a FoodPro kipróbálásához, és járd végig a rendszer működését.')
@php($selectedDemoProduct = $products->get($selectedProduct))

@section('content')
<section class="contact-hero">
    <div class="container contact-grid">
        <div class="contact-copy">
            <span class="eyebrow eyebrow-light">Demóhozzáférés</span>
            <h1>Próbáld ki a kezelőfelületet is.</h1>
            <p>A nyilvános oldalt azonnal megnyithatod. Ha a belső folyamatokat is végigkattintanád, kérj tesztadatokkal előkészített demóhozzáférést.</p>
            <div class="contact-note"><strong>Mi történik beküldés után?</strong><p>1–2 munkanapon belül értesítünk e-mailben, és egyeztetjük a kipróbáláshoz szükséges hozzáférést. A demó tesztadatokat használ; nem kell éles ügyféladatot megadnod.</p></div>
            @if(! empty($selectedDemoProduct['demo_url']))<p class="contact-direct">Előbb körülnéznél? <a href="{{ $selectedDemoProduct['demo_url'] }}" target="_blank" rel="noopener noreferrer">{{ $selectedDemoProduct['public_demo_cta'] ?? 'Nyilvános oldal megnyitása' }} ↗</a></p>@endif
            <p class="contact-direct">Inkább ajánlatot kérnél? <a href="{{ route('contact', $selectedDemoProduct ? ['erdeklodes' => $selectedProduct, 'ajanlat' => 1] : []) }}">Árajánlatot kérek</a>.</p>
        </div>
        <div class="form-card">
            <div class="form-heading"><span>Demóhozzáférést kérek</span><p>A *-gal jelölt mezők kötelezők.</p></div>
            @if($errors->any())<div class="form-alert" role="alert"><strong>{{ $errors->has('form') ? 'A beküldést nem tudtuk feldolgozni.' : 'Nézd át a megjelölt mezőket.' }}</strong><p>{{ $errors->has('form') ? $errors->first('form') : 'Javítsd az adatokat, majd küldd el újra.' }}</p></div>@endif
            <form method="post" action="{{ route('demo.store') }}" data-inquiry-form>
                @csrf
                <input type="hidden" name="submission_token" value="{{ old('submission_token', $submissionToken) }}">
                <input type="hidden" name="source_path" value="{{ old('source_path', '/demo-igenyles') }}">
                @foreach(['utm_source', 'utm_medium', 'utm_campaign'] as $utm)<input type="hidden" name="{{ $utm }}" value="{{ old($utm, request()->query($utm)) }}">@endforeach
                <div class="honeypot" aria-hidden="true"><label for="demo-website">Weboldal</label><input id="demo-website" name="website" type="text" tabindex="-1" autocomplete="off"></div>
                <div class="field"><label for="demo-product">Melyik rendszert próbálnád ki? *</label><select id="demo-product" name="product_slug" required @error('product_slug') aria-invalid="true" aria-describedby="demo-product-error" @enderror><option value="">Válassz rendszert</option>@foreach($products as $product)<option value="{{ $product['slug'] }}" @selected(old('product_slug', $selectedProduct) === $product['slug'])>{{ $product['name'] }}</option>@endforeach</select>@error('product_slug')<span class="field-error" id="demo-product-error">{{ $message }}</span>@enderror</div>
                <div class="form-row">
                    <div class="field"><label for="demo-name">Név *</label><input id="demo-name" name="name" type="text" value="{{ old('name') }}" autocomplete="name" required maxlength="120" @error('name') aria-invalid="true" aria-describedby="demo-name-error" @enderror>@error('name')<span class="field-error" id="demo-name-error">{{ $message }}</span>@enderror</div>
                    <div class="field"><label for="demo-email">E-mail *</label><input id="demo-email" name="email" type="email" value="{{ old('email') }}" autocomplete="email" required maxlength="254" @error('email') aria-invalid="true" aria-describedby="demo-email-error" @enderror>@error('email')<span class="field-error" id="demo-email-error">{{ $message }}</span>@enderror</div>
                </div>
                <div class="form-row">
                    <div class="field"><label for="demo-company">Cég <span>(opcionális)</span></label><input id="demo-company" name="company" type="text" value="{{ old('company') }}" autocomplete="organization" maxlength="160"></div>
                    <div class="field"><label for="demo-phone">Telefon <span>(opcionális)</span></label><input id="demo-phone" name="phone" type="tel" value="{{ old('phone') }}" autocomplete="tel" maxlength="40"></div>
                </div>
                <div class="field"><label for="demo-message">Mit szeretnél kipróbálni? <span>(opcionális)</span></label><textarea id="demo-message" name="message" rows="4" maxlength="3000" placeholder="Például a munkalapokat vagy a rendeléskezelést néznéd meg közelebbről.">{{ old('message') }}</textarea>@error('message')<span class="field-error">{{ $message }}</span>@enderror</div>
                <p class="privacy-note">A megadott adatokat a demóigénylés kezelésére használjuk. Részletek az <a href="{{ route('privacy') }}">adatkezelési tájékoztatóban</a>.</p>
                <button class="button button-full" type="submit" data-submit>Demóhozzáférést kérek <span aria-hidden="true">→</span></button>
            </form>
        </div>
    </div>
</section>
@endsection
