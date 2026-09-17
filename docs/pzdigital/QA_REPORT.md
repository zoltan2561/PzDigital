# QA riport

## Automatizált ellenőrzések — 2026-09-17

- `php artisan test --testsuite=Feature`: PASS — 14 teszt, 59 assertion.
- `npm run build`: PASS — Vite production build elkészült.
- `vendor\bin\pint --test`: PASS.
- `composer validate --no-check-publish`: PASS.

## Manuális böngészős ellenőrzés

- [ ] 360 px: nincs vízszintes túlcsordulás; mobilmenü és CTA elérhető.
- [x] 390 px: a modernizált hero, CTA-k, mobilmenü és valós termékkép nem okoz vízszintes túlcsordulást.
- [x] 768 px: a hero és a termékképernyő megfelelően egy oszlopra törik.
- [x] 1440 px: a főoldali hero, bizalmi sáv és a SzervizPRO termékoldal képgalériája vizuálisan ellenőrizve.
- [ ] Billentyűzet: skip link, menü, GYIK és űrlap használható.
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
