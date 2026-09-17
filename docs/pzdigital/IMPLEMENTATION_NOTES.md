# Megvalósítási jegyzetek

## Technikai alap

- Laravel 13.32, PHP 8.3+.
- Szerveroldali Blade oldalak, Tailwind CSS 4/Vite build és minimális saját JavaScript.
- SQLite a lokális alap; támogatott céladatbázis MySQL/MariaDB vagy PostgreSQL.
- Database queue az értesítésekhez; külső SMTP nincs bekapcsolva.

## Tartalom és termékképek

A termékadatok a `config/pzdigital.php` fájlban szerkeszthetők. A nyilvános megjelenéshez a `publication_status=published` és `content_approved=true` együttesen szükséges. A jelenlegi dashboardok kódból rajzolt, egyértelműen „Látványterv” jelölésű illusztrációk. Ezeket jóváhagyott, szintetikus adatokat mutató valódi képernyőképekre kell cserélni.

## Megkeresések és értesítés

Az űrlap CSRF-védett, rate limitált és honeypot mezőt használ. A rekord mentése után, commitot követően kerül queue-ba az értesítés. A címzettet kizárólag a `PZDIGITAL_CONTACT_EMAIL` környezeti változó adja. Sikertelen vagy függő értesítések PII nélküli listája:

```powershell
php artisan inquiries:notifications
php artisan inquiries:notifications --retry=AZ_INQUIRY_UUID
```

Az éles SMTP, queue worker és scheduler konfiguráció külön launch gate.

## Élesítés

Ebben a munkacsomagban nincs PROD-deploy, DNS-, HTTPS- vagy SMTP-módosítás. Éles indulás előtt végleges jogi tartalom, szolgáltatói adatok, jóváhagyott termékígéretek, valódi média és tesztelt levélkézbesítés szükséges.
