# Megvalósítási jegyzetek

## Technikai alap

- Laravel 13.32, PHP 8.3+.
- Szerveroldali Blade oldalak, Tailwind CSS 4/Vite build és scope-olt marketing JavaScript.
- GSAP core + ScrollTrigger kizárólag a hero egyszeri összeállásához és a főoldali szekciók visszafogott belépéséhez; nincs smooth-scroll vagy második animációs keretrendszer.
- SQLite a lokális alap; támogatott céladatbázis MySQL/MariaDB vagy PostgreSQL.
- Database queue az értesítésekhez; külső SMTP nincs bekapcsolva.

## Tartalom és média

A termék- és referenciaadatok külön gyűjteményként a `config/pzdigital.php` fájlban szerkeszthetők. A nyilvános megjelenéshez mindkét típusnál a `publication_status=published` és `content_approved=true` együttesen szükséges. A képernyőképek helyi, verziókezelt médiafájlok; az eredetüket a `REFERENCE_MIGRATION.md` rögzíti.

### A harmadik főoldali termékhely cseréje

A „Új saját megoldás” elem kizárólag főoldali megjelenítési helykitöltő, nem katalógustermék. Lokális/DEV környezetben a `PZDIGITAL_HOME_SHOW_PRODUCT_PLACEHOLDER=true` kapcsolja be; production környezetben az alapérték kikapcsolt. Nem készül hozzá route, sitemap-bejegyzés vagy űrlapopció.

Ha megérkezik a valós harmadik termék, a `config/pzdigital.php` `products` gyűjteményébe kell új, publikálási állapottal, jóváhagyással és médiával rendelkező elemet felvenni. Ezután a helykitöltő kapcsoló kikapcsolható; új Blade-nézet másolása nem szükséges. Éles környezetben a helykitöltő csak külön tartalmi jóváhagyással maradhat látható.

### Főoldali referenciák kapcsolása

A kompakt referencia-blokkot a `PZDIGITAL_HOME_SHOW_REFERENCES` környezeti változó kapcsolja. Kikapcsolva a külön `/referenciak` lista és a projektoldalak továbbra is elérhetők, a főmenü pedig közvetlenül erre a listára mutat.

## Mozgás és progresszív működés

- A `resources/js/marketing/motion` moduljai külön kezelik a céges herót, a főoldali szekcióbelépéseket és a projektoldalakon felhasználó által indított folyamatszemléltetőt. A `pagehide` eseménykor az eseménykezelők, időzítők és ScrollTrigger-példányok takarítása megtörténik.
- Animációs állapot csak sikeres inicializálás után kerül a DOM-ra. JavaScript-hibánál a címsor, minden főoldali tartalom, helyi kép és normál hivatkozás látható marad.
- `prefers-reduced-motion: reduce` esetén a hero és a főoldali szekciók időzített belépése kimarad. A projektoldali folyamatlépések közvetlenül választhatók, az időzített lejátszás rejtett.
- A szemléltetők rögzített helyi szöveggel működnek; nincs AI-, Google Naptár-, MLSZ- vagy rendelési végpont a marketinginterakció mögött.

## Hiányzó, nem publikált média

- NapiInfo: jóváhagyott, anonimizált szerkesztői képernyő és a jelenlegi publikálási sorrend friss auditja.
- GyrosCity: jóváhagyott, szintetikus adatú rendelésadmin-képernyő.
- Tiszaszalka SE: publikálható importnapló vagy admin-képernyő.
- ZCutzBarber: jóváhagyott, tesztadatú Google Naptár-képernyő és a szinkron irányának dokumentálása.
- Ezek hiányában kizárólag valódi publikus screenshot és egyértelműen „Szemléltetett folyamat – nem élő futtatás” címkéjű HTML-ábra jelenik meg.

## Megkeresések és értesítés

Az űrlap CSRF-védett, rate limitált és honeypot mezőt használ. A rekord mentése után, commitot követően kerül queue-ba az értesítés. A címzettet kizárólag a `PZDIGITAL_CONTACT_EMAIL` környezeti változó adja. Sikertelen vagy függő értesítések PII nélküli listája:

A szolgáltatási érdeklődési kategóriák a `pzdigital.inquiry_interests` konfigurációból, a termék- és referenciaválasztás pedig a publikálható katalógusból épül. Az ismeretlen kategória vagy slug nem kerülhet a mentett rekordba.

```powershell
php artisan inquiries:notifications
php artisan inquiries:notifications --retry=AZ_INQUIRY_UUID
```

Az éles SMTP, queue worker és scheduler konfiguráció külön launch gate.

## Élesítés

Ebben a munkacsomagban nincs PROD-deploy, DNS-, HTTPS- vagy SMTP-módosítás. Éles indulás előtt végleges jogi tartalom, szolgáltatói adatok, jóváhagyott termékígéretek, valódi média és tesztelt levélkézbesítés szükséges.
