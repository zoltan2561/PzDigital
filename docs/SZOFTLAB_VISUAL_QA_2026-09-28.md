# SzoftLab vizuális és tartalmi ellenőrzés — 2026-09-28

## Hatókör

A helyi Laravel oldalt Chrome böngészőben ellenőriztem a főoldalon, a terméklistán, a SzervizPRO és FoodPro részletoldalán, a referencialistán és négy referenciarészleten, valamint a szolgáltatások, folyamat, rólunk, kapcsolat, adatkezelés és impresszum oldalon (összesen 15 nyilvános útvonal).

Négy böngészőméretet használtam: 320, 390, 768 és 1440 képpontos viewportbeállítás. A böngésző tényleges `innerWidth` értékei a felület miatt ettől kisebbek voltak (291, 355, 698 és 1309 px). Minden kombinációban ellenőriztem az egyetlen főcímet, a vízszintes kilógást és a látható képek betöltését. A konzolban nem volt hiba.

## Eredmény és javítások

- A ZCutzBarber referencia keskeny kijelzőn kilógott. A hero rácsát, címtörését és a horgonynavigációt javítottam; az ismételt ellenőrzésen nem volt vízszintes görgetés.
- A mobilmenü gombja sötét fejlécen jobban látható. A megnyitás után a menüpontok megjelentek, az `aria-expanded` állapot helyesen változott.
- Asztali szélességen a teljes navigáció elfér és látható. A termékoldali szakaszhivatkozások a megfelelő részekhez visznek.
- A FoodPro és SzervizPRO ajánlatkérő gombja a kapcsolatoldalra visz előre kiválasztott termékkel és „Kérj árajánlatot” címmel.
- A termékoldalakon az előnyök, a folyamat, a funkciók és a bevezetés külön szakaszban olvashatók. A meglévő görgetéses megjelenés az új szakaszokra is kiterjed; a csökkentett mozgás beállítását a kód megtartja.

## Termékállítások határa

A SzervizPRO funkcióleírását a [CAR_S README](https://github.com/zoltan2561/Car_sas/blob/main/README.md), a [műhelybővítések dokumentációja](https://github.com/zoltan2561/Car_sas/blob/main/docs/operations/workshop_extensions.md) és a [javítási audit](https://github.com/zoltan2561/Car_sas/blob/main/docs/audits/audit_first_remediation_report.md) alapján írtam. A munkalap, az ügyféloldali állapotkövetés és kommunikáció, a szöveges beszállítói PDF ellenőrizhető importja és a helyi számlatervezet jelenlegi funkcióként szerepel. Az éles Számlázz.hu számlakibocsátás és a Billingo kapcsolat külön bevezetendő elemként látszik; a szkennelt PDF OCR feldolgozását nem ígérjük.

A FoodPro előkészítés alatt áll. A GyrosCity képei és rendelési folyamata éles előzményként szerepelnek; a FoodPro saját készültségét és a további integrációkat külön jelöljük. Mindkét terméknél egyszeri vételár, három hónap díjmentes tárhely és domain, valamint beüzemelési segítség szerepel. A pontos vételárat és a negyedik hónaptól várható fenntartási költséget az írásos ajánlat határozza meg.

## SzervizPRO képes bemutató

A galéria a műhely, az ügyféloldal és a nyomtatás képeit külön csoportban mutatja. A javított ügyféloldali demóképen „Teszt Szerviz Kft.” szerepel. A digitális munkalap, a tételes alkatrészlista, a tényleges ügyféloldali állapot és a nyomtatható munkalap képei a helyi CAR_S demóból készültek. A képek forrását és méretét a [médiadokumentáció](SZOFTLAB_SZERVIZPRO_MEDIA.md) rögzíti. A frissített termékoldal galériáját asztali és 390 px mobilnézetben ellenőriztem; vízszintes kilógást nem találtam.

## Automatizált ellenőrzések

- `php artisan test --compact`: 34 sikeres teszt, 370 ellenőrzés.
- `vendor\bin\pint --test`: sikeres.
- `npm run build`: sikeres.
- `git diff --check`: sikeres.

Az ellenőrzés helyi környezetben történt. Éles telepítés nem része ennek a munkának.
