<!doctype html>
<html lang="hu" class="no-js">
<head>
    @php
        $seoTitle = $title ?? config('pzdigital.brand.name').' — kulcsrakész üzleti rendszerek';
        $seoDescription = $description ?? 'Kulcsrakész rendszerek valós üzleti problémákra. Kevesebb kézi munka, több idő a fontos feladatokra.';
        $seoUrl = url()->current();
        $socialImage = $socialImage ?? [
            'src' => '/media/pzdigital/brand/szoftlab-social.png',
            'alt' => 'SzoftLab arculati kép összekapcsolt üzleti rendszerekkel',
            'width' => 1731,
            'height' => 909,
        ];
        $socialImageUrl = asset(ltrim($socialImage['src'], '/'));
        $socialImageType = str_ends_with(strtolower($socialImage['src']), '.png') ? 'image/png' : 'image/jpeg';
    @endphp
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $seoTitle }}</title>
    <meta name="description" content="{{ $seoDescription }}">
    <link rel="canonical" href="{{ $seoUrl }}">
    @if(($noindex ?? false) || app()->environment() !== 'production')
        <meta name="robots" content="noindex, nofollow">
    @else
        <meta name="robots" content="max-image-preview:large">
    @endif
    <meta name="theme-color" content="#13151A">
    <meta property="og:locale" content="hu_HU">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="{{ config('pzdigital.brand.name') }}">
    <meta property="og:title" content="{{ $seoTitle }}">
    <meta property="og:description" content="{{ $seoDescription }}">
    <meta property="og:url" content="{{ $seoUrl }}">
    <meta property="og:image" content="{{ $socialImageUrl }}">
    <meta property="og:image:type" content="{{ $socialImageType }}">
    @if(isset($socialImage['width'], $socialImage['height']))
        <meta property="og:image:width" content="{{ $socialImage['width'] }}">
        <meta property="og:image:height" content="{{ $socialImage['height'] }}">
    @endif
    <meta property="og:image:alt" content="{{ $socialImage['alt'] }}">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $seoTitle }}">
    <meta name="twitter:description" content="{{ $seoDescription }}">
    <meta name="twitter:image" content="{{ $socialImageUrl }}">
    <meta name="twitter:image:alt" content="{{ $socialImage['alt'] }}">
    <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">
    @if(request()->routeIs('home'))
        @php
            $seoOrganizationId = route('home').'#organization';
            $structuredData = [
                '@context' => 'https://schema.org',
                '@graph' => [
                    [
                        '@type' => 'Organization',
                        '@id' => $seoOrganizationId,
                        'name' => config('pzdigital.brand.name'),
                        'legalName' => config('pzdigital.legal.provider_name'),
                        'url' => route('home'),
                        'logo' => asset('media/pzdigital/brand/szoftlab-logo-primary.png'),
                    ],
                    [
                        '@type' => 'WebSite',
                        '@id' => route('home').'#website',
                        'name' => config('pzdigital.brand.name'),
                        'url' => route('home'),
                        'inLanguage' => 'hu-HU',
                        'publisher' => ['@id' => $seoOrganizationId],
                    ],
                ],
            ];
        @endphp
        <script type="application/ld+json">{!! json_encode($structuredData, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>
    @endif
    <script>document.documentElement.classList.replace('no-js', 'js');</script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <a class="skip-link" href="#tartalom">Ugrás a tartalomra</a>

    <header class="site-header" data-header>
        <div class="container nav-shell">
            <a class="brand brand-surface" href="{{ route('home') }}" aria-label="{{ config('pzdigital.brand.name') }} főoldal">
                <img class="brand-logo brand-logo-primary" src="{{ asset('media/pzdigital/brand/szoftlab-logo-primary.png') }}" alt="" width="2172" height="724">
            </a>

            <button class="nav-toggle" type="button" aria-expanded="false" aria-controls="main-navigation" data-nav-toggle>
                <span class="sr-only">Menü megnyitása</span>
                <span></span><span></span><span></span>
            </button>

            <nav id="main-navigation" class="main-nav" aria-label="Fő navigáció" data-nav>
                <a @class(['active' => request()->routeIs('home')]) href="{{ route('home') }}" @if(request()->routeIs('home')) aria-current="page" @endif>Főoldal</a>
                <a @class(['active' => request()->routeIs('services')]) href="{{ route('services') }}">Szolgáltatások</a>
                <a @class(['active' => request()->routeIs('products.*')]) href="{{ route('products.index') }}">Termékek</a>
                <a @class(['active' => request()->routeIs('process')]) href="{{ route('process') }}">Hogyan dolgozunk</a>
                <a @class(['active' => request()->routeIs('about')]) href="{{ route('about') }}">Rólunk</a>
                <a @class(['active' => request()->routeIs('projects.*')]) href="{{ route('projects.index') }}">Munkáink</a>
                <a class="button button-small" href="{{ route('contact', ['erdeklodes' => 'other']) }}">Beszéljünk a feladatról <span aria-hidden="true">→</span></a>
            </nav>
        </div>
    </header>

    <main id="tartalom">
        @yield('content')
    </main>

    <footer class="site-footer">
        <div class="container footer-grid">
            <div>
                <a class="brand brand-inverse brand-surface" href="{{ route('home') }}" aria-label="{{ config('pzdigital.brand.name') }} főoldal"><img class="brand-logo brand-logo-primary" src="{{ asset('media/pzdigital/brand/szoftlab-logo-primary.png') }}" alt="" width="2172" height="724"></a>
                <p>{{ config('pzdigital.brand.tagline') }}</p>
                <a class="footer-email" href="mailto:{{ config('pzdigital.contact_email') }}">{{ config('pzdigital.contact_email') }}</a>
            </div>
            <nav aria-label="Lábléc navigáció">
                <a href="{{ route('projects.index') }}">Munkáink</a>
                <a href="{{ route('products.index') }}">Termékek</a>
                <a href="{{ route('services') }}">Szolgáltatások</a>
                <a href="{{ route('contact') }}">Kapcsolat</a>
            </nav>
            <nav aria-label="Jogi navigáció">
                <a href="{{ route('privacy') }}">Adatkezelés</a>
                <a href="{{ route('legal') }}">Impresszum</a>
            </nav>
            <p class="copyright">© {{ date('Y') }} {{ config('pzdigital.brand.name') }}</p>
        </div>
    </footer>
</body>
</html>
