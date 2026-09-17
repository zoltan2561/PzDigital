# Tartalomszerkesztési útmutató

## Új termék felvétele

1. Adj új rekordot a `config/pzdigital.php` `products` gyűjteményéhez egyedi `slug`, `sort_order`, készültségi állapot, jóváhagyott szöveg és helyi média megadásával.
2. `featured_on_home=true` esetén bekerülhet a főoldali válogatásba; ott legfeljebb az első három publikálható termék jelenik meg.
3. A `publication_status=published` és `content_approved=true` együtt szükséges a lista-, részlet-, kapcsolat- és sitemap-megjelenéshez.
4. A `demo_url` csak elkülönített, biztonságos sandbox lehet. Éles referencia URL-jét ne add meg demóként.

## Új referencia felvétele

1. Adj új rekordot a `projects` gyűjteményhez: valós név, tömör összefoglaló, kategóriák, eredet, saját szerep, helyi média és forrásnyilvántartás szükséges.
2. A részletoldal és route közös sablonból készül; új Blade-nézet vagy route nem szükséges.
3. A főoldali működési történetek sorrendjét a `homepage_story_project_slugs` lista adja. Csak publikált és jóváhagyott projekt jelenik meg; hiányzó elem automatikusan kiesik.
4. Ne adj meg feltételezett technológiát, évszámot, eredményszázalékot vagy ügyfélidézetet.

### Főoldali projektpéldák

- A hero az első publikált, jóváhagyott és főoldalra kiemelt terméket mutatja: `screenshots[0]`, `name`, `status_label` és `flow` mezőkkel. Nincs független, szűrést megkerülő termékadat. Üres listán a képes rész kimarad.
- A képes főoldali referencialista a `homepage_story_project_slugs` szerinti NapiInfo–GyrosCity–ZCutzBarber sorrendet használja. A kép a `media[0].card_src`, ennek hiányában `media[0].src`. Üres publikálható listán a teljes szekció rejtve marad.
- A projekt neve, leírása és részletoldali linkje szerveroldali HTML-ben szerepel. A külön projektoldalakon a meglévő részletes esettanulmány és folyamatbemutató marad.

### Esettanulmányblokkok

- A projekt `case_study` része közös `headline`, `lead`, `audience` mezőből és `blocks` listából áll.
- Engedélyezett publikus blokktípusok: `overview`, `workflow`, `integration`, `gallery`, `outcome`. Más típushoz a sablon nem választ dinamikus view-t és nem renderel tartalmat.
- Egy blokk csak `publication_status=published` állapotban jelenik meg. Az `evidence_status` és `missing_assets` belső szerkesztési adat; ezeket a Blade nem írja HTML-be vagy kliensoldali JSON-ba.
- A `workflow.steps` elemeihez csak rövid cím és magyarázat kell. A szemléltető nem hív külső API-t és nem módosít éles adatot.
- A `gallery` a projekt jóváhagyott `media` listáját használja. Videó csak tényleges fájl és jóváhagyás után adható hozzá; üres lejátszó nem jelenhet meg.

## Státuszok és kapcsolatok

- `publication_status`: `draft` vagy `published`; a draft szerveroldalon kiszűrésre kerül.
- `content_approved`: csak jóváhagyott tartalomnál legyen `true`.
- `lifecycle_status`: `preview`, `pilot` vagy `available`; ez nem azonos a publikálhatósággal.
- FoodShop–GyrosCity: a FoodShop `related_projects` eleme `project_slug=gyroscity`, `relationship=origin`. A GyrosCity URL-je kizárólag a referencia `public_url` mezője.
- Minden képet a projekt `public/media/pzdigital` könyvtárából szolgáljunk ki, és egészítsük ki konkrét alt szöveggel, forrás- és viewport-adattal a médiamanifesztben.

## Kapcsolatfelvételi kategóriák

- Az általános projektkategóriák a `inquiry_interests` konfigurációból, a termékopciók kizárólag a publikálható termékkatalógusból származnak.
- A termék- és referenciakontextust továbbra is külön, szerveroldalon ellenőrzött slug őrzi. Ismeretlen query-paraméter nem választ ki kategóriát.
- Új weboldal, üzleti rendszer, meglévő rendszer továbbfejlesztése és más egyedi fejlesztés esetén rövid projektleírás kötelező; a meglévő CSRF-, honeypot-, rate-limit- és deduplikációs folyamat változatlan.

## V1.7 forrásleltár

A `pzoli.com` nyilvános főoldalát és készségoldalát 2026. szeptember 17-én kézzel ellenőriztük. A PZ Digital főoldalára kizárólag az ügyfelek döntését segítő, általánosan igazolható témák kerültek át:

- GYIK: várható elkészülés, árképzési tényezők, meglévő weboldal továbbfejlesztése, automatizálható feladatok, valamint domain-, tárhely- és céges e-mail-kérdések.
- Technológiai háttér: PHP, Laravel, HTML, CSS, JavaScript, MySQL, MariaDB, Linux, Docker, Git, OpenAI API és Python.
- Saját kiegészítésként szerepel a műszaki terv nélküli indulás lehetősége; ez folyamatmagyarázat, nem külső forrásból átvett ígéret.

Nem került át konkrét napokban vagy hetekben megadott vállalási idő, ingyenességi ígéret, személyes kapcsolat- vagy önéletrajzi adat, közösségimédia-hivatkozás, hardveres/általános IT-szolgáltatás, illetve a kiválasztott listán kívüli modell, eszköz vagy képzési irány. A későbbi frissítéseknél ezt a szűrést meg kell tartani.

## Termékbemutatók képeinek bővítése (V1.9)

A termék `demo_highlights` listája a bemutató témáit tartalmazza, `title`, `text` és `image` mezőkkel. Az `image=null` esetén a médiaelem nem jelenik meg a nyilvános nézetben; a cím, leírás és bemutatókérés megmarad. Jóváhagyott, anonimizált helyi kép érkezésekor az érték például `['src' => '/media/pzdigital/szervizpro/munkalap.png', 'alt' => 'A munkalap részletes nézete tesztadatokkal']` lehet; ez kizárólag formátumpélda, a fájl jelenleg nem létezik. A forrást a meglévő médiamanifesztben is rögzíteni kell.

A SzervizPRO bemutatókérése a termékkontextusos kapcsolatoldalra vezet. A FoodShop előkészítés alatt áll; a GyrosCity éles előzmény, nem írható tesztkörnyezet. A nyilvános galéria és a később feltöltendő képsorok nem jelentenek automatikusan megnyitott élő demót.

A FoodShop `menu-mobile.jpg` képe meglévő, valódi GyrosCity-forrás. Az `orientation=portrait`, `width=390`, `height=844` mezők alapján álló, teljes képet mutat a galéria, külön teljesméretű hivatkozással. Nem készült új admin- vagy termékkép.

V1.9: a GyrosCity publikus leírása rövidült, de továbbra sincs igazolt konkrét rendelési státuszlista, fizetési vagy futárintegráció. Ezek nem kerülhetnek funkcióígéretként a felületre új bizonyíték nélkül. A kapcsolatoldal jogi jóváhagyási megjegyzése és az éles indulás adatkezelési/SMTP-korlátja változatlanul nyitott.
