<!doctype html>
<html lang="hu" class="no-js">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? config('pzdigital.brand.name').' — üzleti szoftverek és egyedi fejlesztés' }}</title>
    <meta name="description" content="{{ $description ?? 'Egyedi szoftverek, automatizálás és rendszerkapcsolatok a vállalkozásod működéséhez.' }}">
    <link rel="canonical" href="{{ url()->current() }}">
    @if(($noindex ?? false) || app()->environment() !== 'production')
        <meta name="robots" content="noindex, nofollow">
    @endif
    <meta name="theme-color" content="#13151A">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="{{ config('pzdigital.brand.name') }}">
    <meta property="og:title" content="{{ $title ?? config('pzdigital.brand.name').' — üzleti szoftverek és egyedi fejlesztés' }}">
    <meta property="og:description" content="{{ $description ?? 'Egyedi szoftverek, automatizálás és rendszerkapcsolatok a vállalkozásod működéséhez.' }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta name="twitter:card" content="summary_large_image">
    <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">
    <script type="application/ld+json"><?php echo json_encode(['@context' => 'https://schema.org', '@type' => 'Organization', 'name' => config('pzdigital.brand.name'), 'url' => url('/')], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE); ?></script>
    <script>document.documentElement.classList.replace('no-js', 'js');</script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <a class="skip-link" href="#tartalom">Ugrás a tartalomra</a>

    <header class="site-header" data-header>
        <div class="container nav-shell">
            <a class="brand" href="{{ route('home') }}" aria-label="{{ config('pzdigital.brand.name') }} főoldal">
                <img class="brand-logo brand-logo-light" src="{{ asset('media/pzdigital/brand/szoftpont-logo-light.png') }}" alt="" width="2172" height="724">
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
                <a class="brand brand-inverse" href="{{ route('home') }}" aria-label="{{ config('pzdigital.brand.name') }} főoldal"><img class="brand-logo brand-logo-light" src="{{ asset('media/pzdigital/brand/szoftpont-logo-light.png') }}" alt="" width="2172" height="724"></a>
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
