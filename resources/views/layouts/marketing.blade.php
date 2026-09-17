<!doctype html>
<html lang="hu">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'PZ Digital — üzleti szoftverek és egyedi fejlesztés' }}</title>
    <meta name="description" content="{{ $description ?? 'Saját üzleti megoldások, céges weboldalak és egyedi webes rendszerek átlátható megvalósítással.' }}">
    <link rel="canonical" href="{{ url()->current() }}">
    @if(($noindex ?? false) || app()->environment() !== 'production')
        <meta name="robots" content="noindex, nofollow">
    @endif
    <meta name="theme-color" content="#0B1421">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <a class="skip-link" href="#tartalom">Ugrás a tartalomra</a>

    <header class="site-header" data-header>
        <div class="container nav-shell">
            <a class="brand" href="{{ route('home') }}" aria-label="PZ Digital főoldal">
                <span class="brand-mark" aria-hidden="true">PZ</span>
                <span>Digital</span>
            </a>

            <button class="nav-toggle" type="button" aria-expanded="false" aria-controls="main-navigation" data-nav-toggle>
                <span class="sr-only">Menü megnyitása</span>
                <span></span><span></span><span></span>
            </button>

            <nav id="main-navigation" class="main-nav" aria-label="Fő navigáció" data-nav>
                <a @class(['active' => request()->routeIs('services')]) href="{{ route('services') }}">Szolgáltatások</a>
                <a @class(['active' => request()->routeIs('products.*')]) href="{{ route('products.index') }}">Termékek</a>
                <a @class(['active' => request()->routeIs('process')]) href="{{ route('process') }}">Hogyan dolgozunk</a>
                <a @class(['active' => request()->routeIs('about')]) href="{{ route('about') }}">Rólunk</a>
                <a @class(['active' => request()->routeIs('projects.*')]) href="{{ route('projects.index') }}">Munkáink</a>
                <a class="button button-small" href="{{ route('contact') }}">Beszéljünk a projektedről <span aria-hidden="true">→</span></a>
            </nav>
        </div>
    </header>

    <main id="tartalom">
        @yield('content')
    </main>

    <footer class="site-footer">
        <div class="container footer-grid">
            <div>
                <a class="brand brand-inverse" href="{{ route('home') }}"><span class="brand-mark">PZ</span><span>Digital</span></a>
                <p>Üzleti szoftverek. Valódi működésre tervezve.</p>
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
            <p class="copyright">© {{ date('Y') }} PZ Digital</p>
        </div>
    </footer>
</body>
</html>
