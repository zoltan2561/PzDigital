# QA riport

## Automatizált ellenőrzések — 2026-09-17

- `php artisan test --testsuite=Feature --compact`: PASS — 20 teszt, 110 assertion.
- `npm run build`: PASS — Vite production build elkészült.
- `vendor\bin\pint --test`: PASS.
- `composer validate --no-check-publish`: PASS.

## Manuális böngészős ellenőrzés

- [x] 360 px: nincs vízszintes túlcsordulás; a mobilmenü egérrel és Space billentyűvel nyitható/zárható.
- [x] 390 px: a modernizált hero, CTA-k, mobilmenü és valós termékkép nem okoz vízszintes túlcsordulást.
- [x] 768 px: a hero és a termékképernyő megfelelően egy oszlopra törik.
- [x] 1024 px: nincs oldalirányú túllógás; a céges projektkompozíció és navigáció elkülönül.
- [x] 1440 px: a főoldali hero, bizalmi sáv és a SzervizPRO termékoldal képgalériája vizuálisan ellenőrizve.
- [ ] Billentyűzet: skip link, menü, GYIK és űrlap használható.
- [x] Billentyűzetes célzott ellenőrzés: mobilmenü nyitás/zárás és `aria-expanded`, GYIK `details` nyitás, valamint kapcsolatűrlap név → e-mail fókuszsorrend.
- [x] A SzervizPRO-paraméteres kapcsolatoldal a „SzervizPRO bemutató” érdeklődést választja ki; a mentési út automatizált teszttel igazolt.
- [ ] Kampányparaméteres közvetlen termékoldali belépés és normalizált UTM mentés.

## Launch előtti mérések

- [ ] Három mobil Lighthouse futás mediánja dokumentálva.
- [ ] Valós SMTP sandbox kézbesítés ellenőrizve.
- [ ] Queue worker és sikertelen job helyreállítás ellenőrizve.
- [ ] DEV hozzáférés-védelem és `noindex` ellenőrizve.

A lokális QA-képek a figyelmen kívül hagyott `storage/app/qa` könyvtárban készültek; nem publikus médiaelemek.

## Terméktartalom ellenőrzése — 2026-09-17

- A SzervizPRO-funkciók a `D:\Car_sas` forráskódja, README-je, a privát GitHub-repó és a működő demo alapján kerültek pontosításra.
- A publikus médiaelemek demo-adatokat tartalmazó képernyőképek; nem állítanak nem igazolt eredményszázalékot vagy külső integrációt.
- A FoodShop továbbra is egyértelműen előzetes bemutatóként szerepel.

## V1.1 céges fókusz és referenciák — 2026-09-17

- [x] A főoldali sorrend: céges hero → szolgáltatások → három referencia → saját termékek → folyamat → céges háttér → GYIK → kapcsolat.
- [x] A hero három külön projektet jelöl; mobilon két referenciára egyszerűsödik.
- [x] A teljes referencialista négy publikált projektet tartalmaz, közös részletoldali sablonnal.
- [x] A GyrosCity, ZCutzBarber, Tiszaszalka SE és NapiInfo desktop- és mobilképei helyi fájlból töltődnek.
- [x] A FoodShop `preview` állapotú, `demo_url=null`, a GyrosCity-kapcsolat `origin`; az élő oldal kizárólag referenciahivatkozás.
- [x] Izolált tesztadatokkal 2, 3 és 5 termék megjelenése, valamint a háromelemes főoldali limit ellenőrzött.
- [x] Draft/nem jóváhagyott termék és referencia nem jelenik meg listán, részletoldalon, kapcsolatűrlapon vagy sitemapben.
- [x] Böngészős audit: 360, 390, 768, 1024 és 1440 px; vizsgált főoldal, GyrosCity-részlet és FoodShop-oldal; 0 konzolhiba.
- [x] V1.1 QA-képek: `storage/app/qa/v1-1` (figyelmen kívül hagyott lokális mappa).
