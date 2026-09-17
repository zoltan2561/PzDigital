# Megvalósítási jegyzetek

## Technikai alap

- Laravel 13.32, PHP 8.3+.
- Szerveroldali Blade oldalak, Tailwind CSS 4/Vite build és scope-olt marketing JavaScript.
- GSAP core + ScrollTrigger a főoldali hero és az egyes kártyák lépcsőzetes belépéséhez; nincs smooth-scroll vagy második animációs keretrendszer.
- SQLite a lokális alap; támogatott céladatbázis MySQL/MariaDB vagy PostgreSQL.
- Database queue az értesítésekhez; külső SMTP nincs bekapcsolva.

## Tartalom és média

A termék- és referenciaadatok külön gyűjteményként a `config/pzdigital.php` fájlban szerkeszthetők. A nyilvános megjelenéshez mindkét típusnál a `publication_status=published` és `content_approved=true` együttesen szükséges. A képernyőképek helyi, verziókezelt médiafájlok; az eredetüket a `REFERENCE_MIGRATION.md` rögzíti.

### Vizuális megújulás a V1.8 visszajelzése után

- A hero kék fényátmenetes, finom rácsos háttéren a legelső publikálható, főoldalra kiemelt termék valódi képernyőképét mutatja. Az egyenes böngészőkeret a termékoldalra vezet; a státusz és a háromlépéses termékfolyamat szintén a katalógusból származik. Üres főoldali terméklistán a vizuál kimarad, a szöveg és a CTA megmarad.
- Világos fejléc, három ikonos szolgáltatáskártya, közvetlenül alattuk a négy lépés; nagy, fekvő termékpanelek és képes referenciák. A kék/zöld termékfelületek valódi képeket használnak, új marketingállítás vagy fiktív képernyő nélkül.
- A főoldali sorrend: hero → szolgáltatások → négylépéses közös munka → termékek → működési elvek → opcionális referenciák → technológiák → GYIK → kapcsolatfelvétel.
- A technológiai lista és a GYIK forrásleltárát a `CONTENT_GUIDE.md` tartalmazza. A tartalom Blade-ben, szerveroldali HTML-ként jelenik meg; az FAQ natív `details`/`summary` elemeket használ.
- A változtatás nem vezetett be új JavaScript-, CSS- vagy PHP-függőséget.

### A harmadik főoldali termékhely előnézete

A nyilvános főoldal alapállapotban kizárólag a két jóváhagyott terméket mutatja. A „Következő saját termék” elem csak vizuális tervezési előnézet, nem katalógustermék. Lokális, DEV vagy tesztkörnyezetben a `PZDIGITAL_HOME_ENABLE_PRODUCT_DESIGN_PREVIEW=true` kapcsolja be; alapértéke `false`, production környezetben pedig a kód akkor sem jeleníti meg, ha a környezeti változó tévesen `true`. Nem készül hozzá hivatkozás, route, sitemap-bejegyzés vagy űrlapopció.

Ha megérkezik a valós harmadik termék, a `config/pzdigital.php` `products` gyűjteményébe kell új, publikálási állapottal, jóváhagyással és médiával rendelkező elemet felvenni. Az adatvezérelt főoldali lista ezt külön Blade-nézet másolása nélkül kezeli.

### Főoldali referenciák kapcsolása

A kompakt referencia-blokkot a `PZDIGITAL_HOME_SHOW_REFERENCES` környezeti változó kapcsolja. Kikapcsolva a külön `/referenciak` lista és a projektoldalak továbbra is elérhetők, a főmenü pedig közvetlenül erre a listára mutat.

## Mozgás és progresszív működés

- A `resources/js/marketing/motion` moduljai külön kezelik a főoldali szekcióbelépéseket és a projektoldalakon felhasználó által indított folyamatszemléltetőt. A `pagehide` eseménykor az eseménykezelők, időzítők és ScrollTrigger-példányok takarítása megtörténik.
- Animációs állapot csak sikeres inicializálás után kerül a DOM-ra. JavaScript-hibánál a címsor, minden főoldali tartalom, helyi kép és normál hivatkozás látható marad.
- V1.9: a főcím és a CTA azonnal látható. A hero képe és címkéje legfeljebb 8–10 px függőleges mozgással, kb. 0,6 másodperc alatt jelenik meg; nincs forgatás, perspektíva vagy vízszintes belépés. A szekciócímek és kártyák egyszeri, 10 px-es görgetéses belépést, a folyamatvonal egyszeri kirajzolást kap. Nincs végtelen lebegés, scroll hijack vagy automatikus carousel.
- `prefers-reduced-motion: reduce` esetén a belépések és a hover-elmozdulások kimaradnak. A GSAP matchMedia az élő beállításváltásnál is visszaállítja az inline animációs stílusokat. A projektoldali folyamatlépések közvetlenül választhatók, az időzített lejátszás rejtett.
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

A publikus kapcsolatfelvételi e-mail-cím a `PZDIGITAL_CONTACT_EMAIL` értékéből jelenik meg a kapcsolatoldalon és a láblécben is. Publikálható kapcsolattartói név és szerepkör jelenleg nincs megadva; ezt jóváhagyott adat érkezéséig nem helyettesíti kitalált személy.

```powershell
php artisan inquiries:notifications
php artisan inquiries:notifications --retry=AZ_INQUIRY_UUID
```

Az éles SMTP, queue worker és scheduler konfiguráció külön launch gate.

## Élesítés

Ebben a munkacsomagban nincs PROD-deploy, DNS-, HTTPS- vagy SMTP-módosítás. Éles indulás előtt végleges jogi tartalom, szolgáltatói adatok, jóváhagyott termékígéretek, valódi média és tesztelt levélkézbesítés szükséges.

## V1.8 vizuális és termékbemutató-frissítés (történeti előzmény)

- A közös marketingtokenek grafit, törtfehér és visszafogott márkakék palettát használnak; a nagy felületek és a CTA-k kék fényudvara megszűnt. A meglévő betűcsalád maradt, a címek 600–650-es hangsúlyt kaptak.
- A Főoldal link valódi route-ra vezet, és csak azon kap `aria-current="page"` jelölést. 1320 px alatt a teljes menü a meglévő mobilnavigációba kerül.
- A főoldali termékkártyák igazolt funkciókat, részletoldali és kontextusos bemutatókérő hivatkozást tartalmaznak.
- A termékoldali `demo_highlights` blokkok későbbi képsorok helyét készítik elő. V1.9-től a hiányzó képek helykitöltői nem jelennek meg; a funkcióleírások megmaradnak. Nem jött létre új termék, demókörnyezet vagy külső kapcsolat.
