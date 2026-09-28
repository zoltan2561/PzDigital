<?php

namespace Tests\Feature\Marketing;

use Tests\TestCase;

class PublicPagesTest extends TestCase
{
    public function test_marketing_pages_render(): void
    {
        $routes = [
            '/', '/termekek', '/termekek/szervizpro', '/termekek/foodpro',
            '/referenciak', '/referenciak/gyroscity', '/referenciak/zcutzbarber',
            '/referenciak/tiszaszalka-se', '/referenciak/napiinfo',
            '/szolgaltatasok', '/hogyan-dolgozunk', '/rolunk', '/kapcsolat',
            '/adatkezeles', '/impresszum',
        ];

        foreach ($routes as $route) {
            $this->get($route)->assertOk();
        }
    }

    public function test_public_brand_and_metadata_use_szoftlab(): void
    {
        $this->get('/')
            ->assertOk()
            ->assertSee('SzoftLab')
            ->assertSee('/media/pzdigital/brand/szoftlab-logo-primary.png', false)
            ->assertSee('/media/pzdigital/brand/szoftlab-social.png', false)
            ->assertDontSee('PZ Digital')
            ->assertDontSee('SzoftPont')
            ->assertSee('property="og:site_name" content="SzoftLab"', false)
            ->assertSee('application/ld+json', false)
            ->assertSee('favicon.svg', false);
    }

    public function test_homepage_has_company_focus_and_expected_section_order(): void
    {
        $response = $this->get('/')
            ->assertOk()
            ->assertSee('Valós problémákra')
            ->assertSee('kulcsrakész rendszerek.')
            ->assertSee('data-hero-showcase', false)
            ->assertSee('Így áll össze a megoldás')
            ->assertSee('/media/pzdigital/hero/szoftlab-connected-systems.png', false)
            ->assertSee('A fejlesztés lépései')
            ->assertSee('Munkafelvétel')
            ->assertSee('Programozás')
            ->assertSee('Egyeztetés')
            ->assertSee('Átadás')
            ->assertSee('Elkészítjük és bevezetjük a munkádhoz illő megoldást: összekötjük a meglévő rendszereidet, automatizáljuk az ismétlődő feladatokat, hogy időt és munkát spórolj.')
            ->assertSee('Megnézem a termékeket')
            ->assertSee('Miben segítünk?')
            ->assertSee('Mire szeretnél megoldást?')
            ->assertSee('Egyedi szoftver')
            ->assertSee('Automatizálás')
            ->assertSee('Saját szoftverek a napi működéshez')
            ->assertSee('SzervizPRO')
            ->assertSee('FoodPro')
            ->assertSee('Bemutató elérhető')
            ->assertSee('Élő bemutató')
            ->assertSee('Gyors rendelési út mobilon és asztali gépen.')
            ->assertSee('Innen indul a közös munka')
            ->assertSee('Javaslatot és ajánlatot kapsz')
            ->assertSee('Az átadás utáni támogatásról és bővítésről a megállapodás szerint egyeztetünk.')
            ->assertSee('Beszéljük át a feladatot. A technikai részét megoldjuk.')
            ->assertSee('Nézd meg, min dolgoztunk.')
            ->assertDontSee('Egy időpontfoglalás a gyakorlatban')
            ->assertDontSee('A vendég kiválasztja az időpontot.')
            ->assertDontSee('A foglalás bekerül a naptárba.')
            ->assertDontSee('Te látod, ki mikor érkezik.')
            ->assertDontSee('Szemléltető példa.')
            ->assertSee('A háttérben ezekkel dolgozunk.')
            ->assertSee('Neked nem kell technológiát választanod. A feladathoz illő megoldást mi rakjuk össze.')
            ->assertSee('cdn.simpleicons.org/laravel/FF2D20', false)
            ->assertSee('ChatGPT_logo.svg', false)
            ->assertSee('OpenAI API')
            ->assertSee('Gyakori kérdések')
            ->assertSee('Mikorra készülhet el a fejlesztés?')
            ->assertSee('A domain, a tárhely és a céges e-mail ügyében is segítetek?')
            ->assertSee('Mondd el, mire van szükséged.')
            ->assertSee('AI-val támogatott cikkgyártás')
            ->assertSee('Online rendelés és rendeléskezelő admin')
            ->assertSee('Időpontfoglalás Google Naptár-kapcsolattal')
            ->assertDontSee('data-product-placeholder', false)
            ->assertDontSee('capability-strip', false)
            ->assertDontSee('system-visual-base', false)
            ->assertDontSee('Működési modell · szemléltetés')
            ->assertDontSee('Felület</strong>', false)
            ->assertDontSee('2–3 nap')
            ->assertDontSee('ingyenes felmérés')
            ->assertDontSee('A műhely átlátja a napot.')
            ->assertDontSee('Ügyfeleink mondták')
            ->assertDontSee('data-hero-option', false)
            ->assertDontSee('data-project-story=', false);

        $html = $response->getContent();
        $this->assertLessThan(strpos($html, 'Innen indul a közös munka'), strpos($html, 'id="szolgaltatasok"'));
        $this->assertLessThan(strpos($html, 'id="megoldasok"'), strpos($html, 'Innen indul a közös munka'));
        $this->assertLessThan(strpos($html, 'Beszéljük át a feladatot.'), strpos($html, 'id="megoldasok"'));
        $this->assertLessThan(strpos($html, 'A háttérben ezekkel dolgozunk.'), strpos($html, 'id="referenciak"'));
        $this->assertLessThan(strpos($html, 'Gyakori kérdések'), strpos($html, 'A háttérben ezekkel dolgozunk.'));
        $this->assertSame(6, substr_count($html, '<details>'));
        $this->assertSame(2, substr_count($html, 'data-home-product-slot'));
        $this->assertSame(1, substr_count($html, '<h1>'));

        $this->assertLessThan(strpos($html, 'Termékek</a>'), strpos($html, 'Szolgáltatások</a>'));
        $this->assertLessThan(strpos($html, 'Hogyan dolgozunk</a>'), strpos($html, 'Termékek</a>'));
        $this->assertLessThan(strpos($html, 'Rólunk</a>'), strpos($html, 'Hogyan dolgozunk</a>'));
        $this->assertLessThan(strpos($html, 'Munkáink</a>'), strpos($html, 'Rólunk</a>'));
    }

    public function test_homepage_references_are_compact_configurable_and_publication_safe(): void
    {
        config(['pzdigital.homepage_story_project_slugs' => ['napiinfo', 'gyroscity']]);

        $this->get('/')
            ->assertOk()
            ->assertSee(route('projects.show', 'napiinfo'), false)
            ->assertSee(route('projects.show', 'gyroscity'), false)
            ->assertDontSee('data-project-story=', false);

        $projects = config('pzdigital.projects');
        $projects['napiinfo']['content_approved'] = false;
        config(['pzdigital.projects' => $projects]);

        $this->get('/')
            ->assertOk()
            ->assertSee(route('projects.show', 'gyroscity'), false)
            ->assertDontSee(route('projects.show', 'napiinfo'), false);

        config(['pzdigital.projects' => collect($projects)->map(fn (array $project): array => [
            ...$project,
            'content_approved' => false,
        ])->all()]);

        $this->get('/')
            ->assertOk()
            ->assertDontSee('id="referenciak"', false)
            ->assertSee('A háttérben ezekkel dolgozunk.');

        config(['pzdigital.home.show_references' => false]);
        $this->get('/')
            ->assertOk()
            ->assertDontSee('id="referenciak"', false)
            ->assertSee('A háttérben ezekkel dolgozunk.');
        $this->get('/referenciak')->assertOk();
    }

    public function test_hero_uses_only_published_featured_products_and_handles_an_empty_catalog(): void
    {
        $products = config('pzdigital.products');
        $products['szervizpro']['content_approved'] = false;
        config(['pzdigital.products' => $products]);

        $this->get('/')->assertOk()
            ->assertSee('data-hero-showcase', false)
            ->assertSee('data-hero-product="foodpro"', false)
            ->assertDontSee('/media/pzdigital/szervizpro/dashboard.png', false);

        $products['foodpro']['featured_on_home'] = false;
        config(['pzdigital.products' => $products]);

        $this->get('/')->assertOk()
            ->assertDontSee('data-hero-showcase', false)
            ->assertDontSee('has-showcase', false)
            ->assertSee('Valós problémákra');
    }

    public function test_homepage_preview_placeholder_is_explicit_non_interactive_and_environment_safe(): void
    {
        $this->get('/')
            ->assertOk()
            ->assertDontSee('data-product-placeholder', false)
            ->assertSee('home-products-grid is-two-up', false);

        config(['pzdigital.home.enable_product_design_preview' => true]);
        $response = $this->get('/')
            ->assertOk()
            ->assertSee('data-product-placeholder', false)
            ->assertSee('Következő saját termék')
            ->assertSee('A részletes bemutató előkészítés alatt.')
            ->assertDontSee('/termekek/uj-sajat-megoldas', false)
            ->assertDontSee('A célcsoport a végleges terméktartalommal érkezik.');

        $this->assertSame(3, substr_count($response->getContent(), 'data-home-product-slot'));
        $placeholder = substr($response->getContent(), strpos($response->getContent(), '<article class="home-product-card home-product-placeholder"'));
        $placeholder = substr($placeholder, 0, strpos($placeholder, '</article>') + 10);
        $this->assertStringNotContainsString('href=', $placeholder);
        $this->assertStringNotContainsString('role=', $placeholder);
        $this->assertStringNotContainsString('tabindex=', $placeholder);

        $this->get('/termekek')->assertDontSee('Következő saját termék');
        $this->get('/kapcsolat')->assertDontSee('Következő saját termék');
        $this->get('/sitemap.xml')->assertDontSee('uj-sajat-megoldas');
        $this->get('/termekek/uj-sajat-megoldas')->assertNotFound();

        $this->app->detectEnvironment(fn (): string => 'production');
        $production = $this->get('/')
            ->assertOk()
            ->assertDontSee('data-product-placeholder', false)
            ->assertSee('home-products-grid is-two-up', false);

        $this->assertSame(2, substr_count($production->getContent(), 'data-home-product-slot'));
    }

    public function test_projects_index_uses_customer_facing_copy_and_data_driven_two_column_grid(): void
    {
        $response = $this->get('/referenciak')
            ->assertOk()
            ->assertSee('Weboldalak és rendszerek a gyakorlatban')
            ->assertSee('Korábbi és jelenlegi munkák a SzoftLab mögötti fejlesztői tapasztalatból. Ismerd meg az egyes projektek feladatát és megvalósítását.')
            ->assertSee('project-grid project-grid-index', false)
            ->assertSee('Mondd el, mire van szükséged.')
            ->assertDontSee('belső ellenőrzés');

        $this->assertSame(5, substr_count($response->getContent(), 'data-project-card='));
        $response->assertSee('FotoKlikk')->assertSee('Mire szolgál?')->assertDontSee('pzoli.com');
    }

    public function test_both_products_offer_a_demo_request_and_the_new_reference_explains_its_purpose(): void
    {
        foreach (['szervizpro', 'foodpro'] as $slug) {
            $this->get('/termekek/'.$slug)->assertOk()
                ->assertSee(route('demo.request', ['termek' => $slug]), false)
                ->assertSee('Kipróbálom')
                ->assertSee('kedvezményes tárhely- és domainfenntartást');
        }

        $this->get('/referenciak/fotoklikk')->assertOk()
            ->assertSee('Fejlesztői közreműködés')
            ->assertSee('Mire szolgál?')
            ->assertSee('/media/pzdigital/references/fotoklikk/desktop.png', false)
            ->assertDontSee('pzoli.com');

        $this->get('/sitemap.xml')->assertOk()->assertSee('/demo-igenyles')->assertSee('/referenciak/fotoklikk');
    }

    public function test_primary_calls_to_action_share_the_general_contact_route(): void
    {
        $contactUrl = route('contact', ['erdeklodes' => 'other']);
        $html = $this->get('/')->assertOk()->getContent();

        $this->assertGreaterThanOrEqual(3, substr_count($html, $contactUrl));
        $this->assertSame(3, substr_count($html, 'Beszéljünk a feladatról'));
    }

    public function test_home_navigation_and_product_demo_context_are_preserved(): void
    {
        $home = $this->get('/')->assertOk()->getContent();
        $product = $this->get('/termekek/szervizpro')->assertOk();
        $this->assertMatchesRegularExpression('/href="[^"]*"\\s+aria-current="page"[^>]*>Főoldal<\\/a>/', $home);
        $this->assertDoesNotMatchRegularExpression('/aria-current="page"[^>]*>Főoldal<\\/a>/', $product->getContent());
        $product->assertDontSee('Képes bemutató hamarosan')
            ->assertSee('Ezt mutatjuk meg a bemutatón')
            ->assertSee('Egy munkalap, a felvételtől az átadásig')
            ->assertSee(route('contact', ['erdeklodes' => 'szervizpro']), false);
        $this->get('/termekek/foodpro')->assertOk()
            ->assertSee('Élő bemutató')
            ->assertSee('A csapat azonnal látja a rendelést')
            ->assertSee(route('contact', ['erdeklodes' => 'foodpro']), false);
    }

    public function test_process_page_uses_the_same_customer_facing_four_steps(): void
    {
        $this->get('/hogyan-dolgozunk')
            ->assertOk()
            ->assertSee('Innen indul a közös munka')
            ->assertSee('Átbeszéljük a feladatot')
            ->assertSee('Javaslatot és ajánlatot kapsz')
            ->assertSee('Megmutatjuk, hogyan készül')
            ->assertSee('Kipróbáljuk és átadjuk')
            ->assertSee('Az átadás utáni támogatásról és bővítésről a megállapodás szerint egyeztetünk.');
    }

    public function test_product_media_and_customer_copy_preserve_context_without_empty_boxes(): void
    {
        $this->get('/termekek/foodpro')->assertOk()
            ->assertDontSee('Képes bemutató hamarosan')
            ->assertSee('Gyors rendelés')
            ->assertSee('Beérkezett rendelések egy helyen')
            ->assertSee('gallery-card-portrait', false)
            ->assertSee('<dialog class="product-lightbox"', false)
            ->assertSee('data-product-lightbox-open', false)
            ->assertSee('href="/media/pzdigital/foodpro/home-desktop.png"', false)
            ->assertSee('href="/media/pzdigital/foodpro/mobile-menu.png"', false);

        $this->get('/referenciak/gyroscity')->assertOk()
            ->assertSee('Amit megvalósítottunk')
            ->assertSee('A rendelés útja — szemléltető bemutató.')
            ->assertSee('Hasonló rendelési rendszert szeretnél?')
            ->assertSee('A beérkező rendelések az adminfelületen kezelhetők.')
            ->assertSee(route('contact', ['referencia' => 'gyroscity']), false)
            ->assertDontSee('Konkrét státuszokat, fizetési vagy futárintegrációt');

        $this->get('/kapcsolat?referencia=gyroscity')->assertOk()
            ->assertSee('Írj nekünk')
            ->assertSee('value="project_reference" data-project-option="gyroscity" selected', false);

        config(['pzdigital.products.szervizpro.demo_highlights.0.image' => [
            'src' => '/media/approved-detail.png', 'alt' => 'Jóváhagyott részlet',
        ]]);
        $this->get('/termekek/szervizpro')->assertOk()
            ->assertSee('src="/media/approved-detail.png"', false)
            ->assertDontSee('Képes bemutató hamarosan');
    }

    public function test_project_case_studies_explain_confirmed_workflows_without_internal_notes(): void
    {
        $expectations = [
            '/referenciak/napiinfo' => ['NapiInfo — az utasítástól a cikkig.', 'Utasítás', 'AI-cikktervezet', 'felügyelet nélküli automatikus publikálást'],
            '/referenciak/gyroscity' => ['GyrosCity — étlap és rendeléskezelés egy rendszerben.', 'Étlap', 'Rendelés', 'Rendeléskezelő adminisztráció'],
            '/referenciak/tiszaszalka-se' => ['Tiszaszalka SE — eredmények, kézi másolgatás nélkül.', 'MLSZ Adatbank', 'Automatikus átvétel', 'valós idejű'],
            '/referenciak/zcutzbarber' => ['ZCutzBarber — online foglalás, naptárkapcsolattal.', 'Időpontválasztás', 'Google Naptár', 'Kétirányú szinkront'],
        ];

        foreach ($expectations as $route => $texts) {
            $response = $this->get($route)->assertOk();

            foreach ($texts as $text) {
                $response->assertSee($text);
            }

            $response
                ->assertSee('Szemléltetett folyamat')
                ->assertSee('Nem élő futtatás')
                ->assertSee('Lejátszás')
                ->assertSee('Szünet')
                ->assertSee('Újra')
                ->assertDontSee('evidence_status')
                ->assertDontSee('missing_assets');
        }
    }

    public function test_unknown_or_unpublished_case_study_blocks_are_not_rendered(): void
    {
        $projects = config('pzdigital.projects');
        $projects['napiinfo']['case_study']['blocks'][] = [
            'type' => 'arbitrary_view',
            'body' => 'INTERNAL-DO-NOT-PUBLISH',
            'publication_status' => 'published',
        ];
        $projects['napiinfo']['case_study']['blocks'][] = [
            'type' => 'integration',
            'heading' => 'Draft heading',
            'body' => 'DRAFT-DO-NOT-PUBLISH',
            'publication_status' => 'draft',
        ];
        config(['pzdigital.projects' => $projects]);

        $this->get('/referenciak/napiinfo')
            ->assertOk()
            ->assertDontSee('INTERNAL-DO-NOT-PUBLISH')
            ->assertDontSee('DRAFT-DO-NOT-PUBLISH');
    }

    public function test_szervizpro_page_displays_verified_product_screens(): void
    {
        $this->get('/termekek/szervizpro')
            ->assertOk()
            ->assertSee('Valódi képernyők')
            ->assertSee('<dialog class="product-lightbox"', false)
            ->assertSee('data-product-lightbox-open', false)
            ->assertSee('Alkatrész-adatbázis és bizonylatimport')
            ->assertSee('Számlázz.hu XML-előnézet már készül.')
            ->assertSee('Éles számlakibocsátás és Billingo kapcsolat')
            ->assertSee('Működő funkció')
            ->assertSee('Külön egyeztetendő')
            ->assertSee('3 hónap díjmentes tárhely és domain')
            ->assertSee('Árajánlatot kérek')
            ->assertSee('/media/pzdigital/szervizpro/customer-home.jpg', false)
            ->assertSee('/media/pzdigital/szervizpro/status-lookup.jpg', false)
            ->assertSee('/media/pzdigital/szervizpro/customer-status.jpg', false)
            ->assertSee('/media/pzdigital/szervizpro/work-order.jpg', false)
            ->assertSee('/media/pzdigital/szervizpro/work-order-parts.jpg', false)
            ->assertSee('/media/pzdigital/szervizpro/print-work-order.jpg', false)
            ->assertSee('/media/pzdigital/szervizpro/print-work-order-items.jpg', false)
            ->assertSee('A műhelyben')
            ->assertSee('Az ügyfélnek')
            ->assertSee('Nyomtatáshoz');

        foreach (config('pzdigital.products.szervizpro.screenshots') as $screenshot) {
            $this->assertFileExists(public_path(ltrim($screenshot['src'], '/')));
        }
    }

    public function test_foodpro_has_its_own_live_demo_and_verified_product_gallery(): void
    {
        $this->assertSame('https://foodpro.shop/', config('pzdigital.products.foodpro.demo_url'));
        $this->assertSame([], config('pzdigital.products.foodpro.related_projects'));

        $this->get('/termekek/foodpro')
            ->assertOk()
            ->assertSee('Élő bemutató')
            ->assertSee('https://foodpro.shop/', false)
            ->assertSee('Árajánlatot kérek')
            ->assertSee('Gyors rendelés')
            ->assertSee('Rendeléskezelés és nyomtatás')
            ->assertSee('E-mail értesítési sablonok')
            ->assertSee('saját Barion-szerződése')
            ->assertSee('3 hónap díjmentes tárhely és domain')
            ->assertSee('/media/pzdigital/foodpro/home-desktop.png', false)
            ->assertSee('/media/pzdigital/foodpro/menu.png', false)
            ->assertSee('/media/pzdigital/foodpro/orders-admin.png', false)
            ->assertSee('/media/pzdigital/foodpro/print-receipt.png', false)
            ->assertSee('/media/pzdigital/foodpro/users-admin.png', false)
            ->assertSee('/media/pzdigital/foodpro/barion-admin.png', false)
            ->assertDontSee('GyrosCity');

        foreach (config('pzdigital.products.foodpro.screenshots') as $screenshot) {
            $this->assertFileExists(public_path(ltrim($screenshot['src'], '/')));
        }

        $this->get('/kapcsolat?erdeklodes=foodpro')
            ->assertOk()
            ->assertSee('value="foodpro" data-product-option="foodpro" selected', false);

        $this->get('/kapcsolat?erdeklodes=foodpro&ajanlat=1')
            ->assertOk()
            ->assertSee('Kérj árajánlatot')
            ->assertSee('value="foodpro" data-product-option="foodpro" selected', false);

        $this->get('/termekek/foodshop')->assertRedirect('/termekek/foodpro');
        $this->get('/kapcsolat?erdeklodes=foodshop&ajanlat=1')
            ->assertOk()
            ->assertSee('value="foodpro" data-product-option="foodpro" selected', false);
    }

    public function test_unknown_product_returns_a_real_404(): void
    {
        $this->get('/termekek/nem-letezik')->assertNotFound();
    }

    public function test_reference_catalog_and_unknown_reference_behave_correctly(): void
    {
        $this->get('/referenciak')
            ->assertOk()
            ->assertSee('GyrosCity')
            ->assertSee('ZCutzBarber')
            ->assertSee('Tiszaszalka SE')
            ->assertSee('NapiInfo');

        $this->get('/referenciak/gyroscity')
            ->assertOk()
            ->assertSee(route('contact', ['referencia' => 'gyroscity']), false)
            ->assertSee('/media/pzdigital/references/gyroscity/menu-desktop.jpg', false)
            ->assertSee('/media/pzdigital/references/gyroscity/menu-mobile.jpg', false)
            ->assertSee('Éles referenciaoldal');

        $this->get('/kapcsolat?referencia=gyroscity')
            ->assertOk()
            ->assertSee('GyrosCity projekthez hasonló fejlesztés');

        $this->get('/referenciak/nem-letezik')->assertNotFound();
    }

    public function test_unapproved_product_is_not_public(): void
    {
        $products = config('pzdigital.products');
        $products['foodpro']['content_approved'] = false;
        config(['pzdigital.products' => $products]);

        $this->get('/termekek/foodpro')->assertNotFound();
        $this->get('/termekek')->assertDontSee(route('products.show', 'foodpro'), false);
        $this->get('/kapcsolat')->assertDontSee('FoodPro — egyeztetés');
        $this->get('/sitemap.xml')->assertDontSee('/termekek/foodpro');
    }

    public function test_unapproved_project_is_absent_from_every_public_surface(): void
    {
        $projects = config('pzdigital.projects');
        $projects['napiinfo']['content_approved'] = false;
        config(['pzdigital.projects' => $projects]);

        $this->get('/')->assertDontSee('data-project-story="napiinfo"', false);
        $this->get('/referenciak')->assertDontSee(route('projects.show', 'napiinfo'), false);
        $this->get('/referenciak/napiinfo')->assertNotFound();
        $this->get('/kapcsolat?referencia=napiinfo')->assertDontSee('NapiInfo projekthez hasonló fejlesztés');
        $this->get('/sitemap.xml')->assertDontSee('/referenciak/napiinfo');
    }

    public function test_product_layout_supports_two_three_and_five_items_with_home_limit(): void
    {
        $base = config('pzdigital.products.szervizpro');
        config(['pzdigital.home.enable_product_design_preview' => false]);

        foreach ([2, 3, 5] as $count) {
            $products = [];

            for ($index = 1; $index <= $count; $index++) {
                $slug = "teszt-$index";
                $products[$slug] = [
                    ...$base,
                    'slug' => $slug,
                    'name' => "Teszt termék $index",
                    'sort_order' => $index,
                    'featured_on_home' => true,
                ];
            }

            config(['pzdigital.products' => $products]);

            $this->assertSame($count, substr_count($this->get('/termekek')->getContent(), 'data-product-card='));
            $this->assertSame(min(3, $count), substr_count($this->get('/')->getContent(), 'data-product-card='));
        }
    }

    public function test_thank_you_page_is_noindex(): void
    {
        $this->get('/koszonjuk')->assertOk()->assertSee('noindex, nofollow', false);
    }

    public function test_sitemap_lists_only_canonical_public_pages(): void
    {
        $this->get('/sitemap.xml')
            ->assertOk()
            ->assertHeader('Content-Type', 'application/xml')
            ->assertSee('/termekek/szervizpro')
            ->assertSee('/referenciak/gyroscity')
            ->assertDontSee('/koszonjuk');
    }
}
