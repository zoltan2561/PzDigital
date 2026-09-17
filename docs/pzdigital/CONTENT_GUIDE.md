# Tartalomszerkesztési útmutató

## Új termék felvétele

1. Adj új rekordot a `config/pzdigital.php` `products` gyűjteményéhez egyedi `slug`, `sort_order`, készültségi állapot, jóváhagyott szöveg és helyi média megadásával.
2. `featured_on_home=true` esetén bekerülhet a főoldali válogatásba; ott legfeljebb az első három publikálható termék jelenik meg.
3. A `publication_status=published` és `content_approved=true` együtt szükséges a lista-, részlet-, kapcsolat- és sitemap-megjelenéshez.
4. A `demo_url` csak elkülönített, biztonságos sandbox lehet. Éles referencia URL-jét ne add meg demóként.

## Új referencia felvétele

1. Adj új rekordot a `projects` gyűjteményhez: valós név, tömör összefoglaló, kategóriák, eredet, saját szerep, helyi média és forrásnyilvántartás szükséges.
2. A részletoldal és route közös sablonból készül; új Blade-nézet vagy route nem szükséges.
3. `featured_on_home=true` esetén a `sort_order` szerinti első három projekt kerül a főoldalra. A teljes listán minden publikálható referencia megjelenik.
4. Ne adj meg feltételezett technológiát, évszámot, eredményszázalékot vagy ügyfélidézetet.

## Státuszok és kapcsolatok

- `publication_status`: `draft` vagy `published`; a draft szerveroldalon kiszűrésre kerül.
- `content_approved`: csak jóváhagyott tartalomnál legyen `true`.
- `lifecycle_status`: `preview`, `pilot` vagy `available`; ez nem azonos a publikálhatósággal.
- FoodShop–GyrosCity: a FoodShop `related_projects` eleme `project_slug=gyroscity`, `relationship=origin`. A GyrosCity URL-je kizárólag a referencia `public_url` mezője.
- Minden képet a projekt `public/media/pzdigital` könyvtárából szolgáljunk ki, és egészítsük ki konkrét alt szöveggel, forrás- és viewport-adattal a médiamanifesztben.
