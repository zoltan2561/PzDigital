# QA riport

## Automatizált ellenőrzések — 2026-09-17

- `php artisan test --testsuite=Feature`: PASS — 13 teszt, 52 assertion.
- `npm run build`: PASS — Vite production build elkészült.
- `vendor\bin\pint --test`: PASS.
- `composer validate --no-check-publish`: PASS.

## Manuális böngészős ellenőrzés

- [ ] 360 px: nincs vízszintes túlcsordulás; mobilmenü és CTA elérhető.
- [x] 390 px: a főoldali hero, CTA-k, mobilmenü és termék-látványterv nem okoz vízszintes túlcsordulást.
- [ ] 768 px: termékkártyák és folyamatlépések megfelelően törnek.
- [x] 1440 px: hero és termék-látványterv aránya megfelelő.
- [ ] Billentyűzet: skip link, menü, GYIK és űrlap használható.
- [x] A SzervizPRO-paraméteres kapcsolatoldal a „SzervizPRO bemutató” érdeklődést választja ki; a mentési út automatizált teszttel igazolt.
- [ ] Kampányparaméteres közvetlen termékoldali belépés és normalizált UTM mentés.

## Launch előtti mérések

- [ ] Három mobil Lighthouse futás mediánja dokumentálva.
- [ ] Valós SMTP sandbox kézbesítés ellenőrizve.
- [ ] Queue worker és sikertelen job helyreállítás ellenőrizve.
- [ ] DEV hozzáférés-védelem és `noindex` ellenőrizve.

A lokális QA-képek a figyelmen kívül hagyott `storage/app/qa` könyvtárban készültek; nem publikus médiaelemek.
