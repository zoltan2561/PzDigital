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

## V1.2 vizuális finomítás — 2026-09-17

- [x] A fejléc és hero közös sötétkék nyitózónát, a fő tartalmi felületek kékesszürke hátteret, a CTA és lábléc összefüggő sötét lezárást kapott.
- [x] A referenciablokk teljes szélességű sötét felület; a kártyák 16:10-es, semleges keretet és kizárólag az előnézeti képen alkalmazott enyhe `saturate(.72) brightness(.96)` szűrést használnak. A részletgaléria szűretlen.
- [x] A GyrosCity publikus „Top Trendek” felülete 1440 × 1000 és 390 × 844 viewporton rögzítve; a hero, referencia-, FoodShop- és részletoldali kiemelt képek terméklistát mutatnak.
- [x] Böngészős audit: 360, 390, 768, 1024, 1440 és 1920 px; 0 vízszintes túlcsordulás, 0 törött kép és 0 konzolhiba. Mobilmenü, GYIK és kapcsolatűrlap fókuszsorrend ellenőrizve.
- [x] Kontrasztmérés: világos főszöveg 13,78:1, világos másodlagos szöveg 5,16:1, sötét főszöveg 17,18:1, sötét másodlagos szöveg 8,10:1, sötét felületi link 8,53:1.
- [x] Célzott tesztek: 19 PASS, 114 assertion; Vite build PASS; Pint PASS; Composer validáció PASS.
- [x] Előtte/utána és részletképek: `storage/app/qa/v1-2` (figyelmen kívül hagyott lokális mappa).

## V1.3 bizalom és projektbemutatás — 2026-09-17

- [x] A főoldali referenciaválogatás egy adatból kiválasztott nagy projektet és két külön másodlagos referenciát mutat. A GyrosCity-kiemelés feladatot, megoldást és valós termékrácsot tartalmaz.
- [x] Hibás vagy visszavont kiemelt slug esetén az első publikálható kiemelt projekt jelenik meg; publikálható elem nélkül a szekció rejtett. Célzott regressziós teszttel ellenőrizve.
- [x] A szolgáltatások konkrét kimenetet, a négy folyamatlépés külön kimenetcímkét, a bizalompanel pedig PZ-monogramot és igazolható Laravel/PHP/webes fókuszt kapott. Fiktív név, fotó vagy ügyfélvélemény nem került ki.
- [x] A kapcsolatoldal új weboldal, üzleti rendszer, meglévő rendszer továbbfejlesztése, saját termék és általános egyeztetés szerint választható; a termék- és referenciakontextus, mentés és értesítési folyamat változatlan.
- [x] Böngészős audit: 360, 390, 768, 1024, 1440 és 1920 px; 0 vízszintes túlcsordulás, 0 törött kép, 0 konzolhiba. Mobilmenü, GYIK, űrlapfókusz és az általános/SzervizPRO/GyrosCity/meglévő rendszer/érvénytelen kategóriaútvonal ellenőrizve.
- [x] Célzott tesztek: 21 PASS, 132 assertion; Vite build PASS; Pint PASS; Composer validáció PASS.
- [x] Előtte/utána desktop és mobil, valamint referencia- és bizalomrészlet: `storage/app/qa/v1-3` (figyelmen kívül hagyott lokális mappa).

## V1.4 motion és projektoldalak — 2026-09-17

- [x] Új aszimmetrikus hero, kézzel és nyílbillentyűvel váltható GyrosCity/ZCutzBarber/NapiInfo példa; nincs automatikus carousel vagy blokkoló intro.
- [x] A szolgáltatások három számozott sorra, a főoldali referenciák natív sticky képtérre és három szerveroldali történetre váltottak. ScrollTrigger nem fogja el a természetes görgetést és nem használ snapet.
- [x] NapiInfo, GyrosCity, Tiszaszalka SE és ZCutzBarber közös, allowlistes esettanulmányblokkokkal, projektspecifikus folyamattal, igazolt eredményekkel és kontextusos kapcsolatúttal működik.
- [x] A szemléltetők helyi, rögzített adatokkal futnak; mindegyik „nem élő futtatás” jelölést, közvetlen lépésválasztást és véges Lejátszás/Szünet/Újra vezérlést kapott.
- [x] Böngészős audit: 360/390/768/1024/1440/1920 px, valamint 1024 × 650 alacsony viewport; 0 vízszintes túlcsordulás, 0 törött kép, 0 konzolhiba.
- [x] Reduced-motion állapotban nincs sticky projektváltás vagy időzített workflow; JavaScript nélkül mindhárom főoldali projektkép, szöveg és link látható.
- [x] Hash-alapú projektaktiválás, hero egér/billentyűzet, workflow közvetlen és véges lejátszás, továbbá SzervizPRO/FoodShop útvonal regresszió ellenőrizve.
- [x] Célzott marketingtesztek: 23 PASS, 186 assertion; Vite production build, Pint és Composer-validáció PASS; `npm audit` 0 sérülékenységet jelzett a GSAP telepítésekor.
- [x] Bizonyítékok: `storage/app/qa/v1-4`; a `motion-proof-28s.mp4` tényleges, 28 másodperces 1440 × 900 képernyőfelvétel.

## V1.6 UX, tartalom és konverzió — 2026-09-17

- [x] A publikus főoldal kizárólag a két jóváhagyott terméket mutatja. A háromhelyes vizuális előnézet külön, alapból kikapcsolt local/DEV/test kapcsoló mögött van; production környezetben a kapcsoló értékétől függetlenül tiltott.
- [x] Az előnézeti harmadik elem nem tartalmaz hivatkozást, szerepkört vagy fókuszpontot, és nincs hovermozgása. A valós harmadik termék továbbra is az adatvezérelt katalógusba vehető fel.
- [x] A hero, termék-, bizalom-, referencia-, kapcsolat- és záró CTA-szövegek ügyfélközpontú változatra frissültek. A fejléc, hero és záró CTA ugyanarra az általános kapcsolatfelvételi útvonalra vezet.
- [x] A referencialista rövidebb hero után 2 × 2-es desktop és egyoszlopos mobilrácsot használ; mind a négy publikált projekt az adatvezérelt katalógusból jelenik meg.
- [x] Böngészős audit: 320/360/390/768/1024/1440/1920 px, továbbá 200%-os szövegméret és 320 px-es effektív nézet; 0 vízszintes túlcsordulás, 0 konzolhiba. A mért szövegkontrasztok 5,16:1 és 9,77:1 közöttiek.
- [x] Billentyűzetes fókuszjelzés, globális Escape-es mobilmenü-zárás és fókuszvisszaadás, GYIK, JavaScript nélküli mobilnavigáció és reduced-motion állapot ellenőrizve.
- [x] Célzott marketing- és megkereséstesztek: 26 PASS, 237 assertion; teljes tesztcsomag: 28 PASS, 239 assertion. Vite production build, Pint és Composer-validáció PASS.
- [x] Előtte/utána desktop és mobil, hero-, termék-, referencia- és háromhelyes előnézeti képek, JSON audit és 2 másodperces 1440 × 900 motion videó: `storage/app/qa/v1-6`.

## V1.7 ügyfélbarát tartalom, GYIK és technológia — 2026-09-17

- [x] A főoldal sorrendje: szolgáltatások → négylépéses közös munka → termékek → működési elvek → opcionális referenciák → technológiák → hat kérdéses GYIK → záró CTA.
- [x] A hero és a szolgáltatások közérthető szöveget, az időpontfoglalási szemléltető pedig három egyértelmű, fiktív adat nélküli lépést kapott. A régi rendszerarchitektúra és az ingyenességi ígéretek nem jelennek meg.
- [x] Böngészős audit: 320/390/768/1024/1440/1920 px, 200%-os szövegméret és 320 px-es effektív nézet; 0 vízszintes túlcsordulás, 0 törött kép, 0 konzolhiba. Minden vizsgált publikus útvonal HTTP 200.
- [x] Mobilmenü nyitás/Escape/fókuszvisszaadás, JavaScript nélküli navigáció, billentyűzetes GYIK, látható fókusz és reduced-motion állapot ellenőrizve.
- [x] Kontrasztmérés: világos másodlagos szöveg 5,16:1, hero másodlagos szöveg 9,44:1, sötét másodlagos szöveg 9,29:1, technológiaszöveg 6,12:1.
- [x] Teljes tesztcsomag: 29 PASS, 270 assertion. Vite production build, Pint és Composer-validáció PASS.
- [x] V1.7 képek, JSON audit és motion videó: `storage/app/qa/v1-7` (figyelmen kívül hagyott helyi mappa).

## V1.8 pozicionálás, arculat és termékbemutatók — 2026-09-17

- [x] Új, problémamegoldásra épülő hero; egyetlen H1, általános kapcsolati CTA, termékhorgony. A foglalási panel és a hozzá tartozó kizárólagos CSS/JS kikerült.
- [x] Grafit/törtfehér közös színek, visszafogott cím- és gombsúlyok. A szolgáltatások és a közvetlenül utánuk álló négy lépés közös világos felületet használ.
- [x] Főoldal menüpont desktopon és mobilon, kizárólag a kezdőoldalon aktuális jelöléssel; aloldalról visszalépés, Escape, fókuszvisszaadás, rejtett mobilmenü és JavaScript nélküli menü ellenőrizve.
- [x] 320/390/768/1024/1280/1440/1920 px: nincs vízszintes túlcsordulás, törött kép vagy konzolhiba. 200%-os szövegméret és 320 px-es effektív reflow vizsgálva. Ez nem teljes akadálymentességi tanúsítás.
- [x] Tényleges számított színeken mért kontraszt: hero cím 16,31:1; hero leírás 9,51:1; elsődleges gomb 5,70:1; világos leírás 5,56:1; technológiai lista 5,19:1; GYIK kérdés 15,26:1. Az elsődleges, körvonalas és világos gomb hoverállapota is ellenőrizve, elugrás nélkül.
- [x] SzervizPRO, FoodShop és GyrosCity közös stílusa desktopon és 390 px-en ellenőrizve. Kapcsolati oldalon natív és szerveroldali hiányzó név/e-mail hibák megjelennek; a böngészős teszt nem küldött érvényes megkeresést.
- [x] A termékkártyák konkrét funkciókat és kontextusos bemutatókérést kaptak. A részletoldalak két-két jelölt képsorhelye konfigurációból tölthető. A FoodShop státusza, a GyrosCity-kapcsolat és a harmadik termékhely védelme változatlan.
- [x] Célzott marketing- és kapcsolatút-tesztek: 28 PASS, 278 assertion; Vite build és Pint PASS. Értesítés a regressziós tesztekben fake, nincs külső üzenet.
- [x] Előtte/utána 1440 és 390 px főoldalkép, olvasható hero-, szolgáltatás/folyamat-, termék- és mobilmenü-részlet; termék-, referencia- és űrlaphibaképek; JSON audit és 3 másodperces, 1440 × 900-as gyorsított mozgáselőnézet: `storage/app/qa/v1-8`.
- [x] A screenshotok és a nyers képkockák helyi, figyelmen kívül hagyott QA-artifactok. PROD- vagy DEV-deploy nem része ennek a változtatásnak.

## Vizuális megújulás a V1.8 visszajelzése után — 2026-09-17

- [x] Kék–fehér közös arculat, rétegzett hero valódi termékképpel; ikonos szolgáltatáskártyák, nagy termékpanelek és képes referenciák. A szolgáltatások és a négy lépés közvetlenül egymás alatt maradtak.
- [x] A hero a publikálható főoldali terméklistából épül. Új regressziós teszt ellenőrzi a nem jóváhagyott termék kizárását és az üres lista biztonságos megjelenítését. Termékstátuszok és demó-korlátozások változatlanok.
- [x] Véges hero-timeline, lépcsőzetes scroll-reveal, folyamatvonal és hoverállapotok. A ténylegesen mért hero-opacity 0,25-ről 1-re változik; a folyamatvonal végállapota 1. Élő reduced-motion váltás után 0 inline animációs stílus, minden vizsgált elem teljesen látható.
- [x] 320/390/768/1024/1280/1440/1920 px: nincs dokumentumszintű vízszintes túlcsordulás vagy törött kép. Mobilmenü/Escape/fókusz, billentyűzetes GYIK, JS nélküli navigáció, 200%-os szöveg és reduced-motion ellenőrizve; 0 konzolhiba.
- [x] A két termékoldal, GyrosCity és a kapcsolatoldal közös stílusa desktopon és mobilon ellenőrizve. A hiányos űrlap natív és szerveroldali validációja működik; érvényes megkeresés nem került beküldésre.
- [x] Teljes tesztcsomag: 31 PASS, 290 assertion. Vite production build, Pint és git diff whitespace-ellenőrzés PASS.
- [x] Helyi képek és audit: `storage/app/qa/visual-experience`. A `motion-preview.mp4` időbélyeges böngészős képkockákból összeállított, kb. 8 másodperces mozgásbemutató. A régi egyszínű kontrasztmérő a hero gradientjét nem értelmezi; arra a külön `final-check.json` a legvilágosabb háttérszínből számított konzervatív értéket rögzíti. Ez nem teljes akadálymentességi tanúsítás.
- [x] Nem került be új függőség. Nincs PROD-deploy, külső adatírás vagy éles demómegnyitás.
