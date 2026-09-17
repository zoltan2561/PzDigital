# PZ Digital weboldal

Laravel 13 + Blade + Tailwind/Vite alapú céges weboldal. A projekt saját termékoldalakat, szolgáltatási és folyamatoldalakat, valamint tartósan mentett, queue-alapú kapcsolatfelvételt tartalmaz.

## Helyi indítás

```powershell
composer install
Copy-Item .env.example .env
php artisan key:generate
php artisan migrate
npm install
npm run build
php artisan serve
```

A helyi alapkonfiguráció SQLite-ot, `database` queue-t és `log` mailert használ. Fejlesztés közben a queue feldolgozásához külön terminálban futtasd:

```powershell
php artisan queue:work --tries=3
```

## Ellenőrzés

```powershell
php artisan test --testsuite=Feature
npm run build
vendor\bin\pint --test
```

Részletes konfiguráció és nyitott jóváhagyások: [docs/pzdigital/IMPLEMENTATION_NOTES.md](docs/pzdigital/IMPLEMENTATION_NOTES.md).
