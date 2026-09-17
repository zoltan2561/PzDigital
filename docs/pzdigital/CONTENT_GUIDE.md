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

- A hero alapállapota GyrosCity; a `showcase_label`, `showcase_flow` és első média adja a kézi választó tartalmát. A váltás nem automatikus carousel.
- A sticky történet a `homepage_story_project_slugs` szerinti NapiInfo–GyrosCity–ZCutzBarber sorrendet használja. Üres publikálható listán a teljes szekció rejtve marad.
- A projekt neve, leírása és részletoldali linkje mindig szerveroldali HTML-ben marad; a JavaScript kizárólag a képi aktív állapotot kezeli.

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
