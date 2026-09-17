<?php

namespace Tests\Feature\Marketing;

use Tests\TestCase;

class PublicPagesTest extends TestCase
{
    public function test_marketing_pages_render(): void
    {
        $routes = [
            '/', '/termekek', '/termekek/szervizpro', '/termekek/foodshop',
            '/referenciak', '/referenciak/gyroscity', '/referenciak/zcutzbarber',
            '/referenciak/tiszaszalka-se', '/referenciak/napiinfo',
            '/szolgaltatasok', '/hogyan-dolgozunk', '/rolunk', '/kapcsolat',
            '/adatkezeles', '/impresszum',
        ];

        foreach ($routes as $route) {
            $this->get($route)->assertOk();
        }
    }

    public function test_homepage_has_company_focus_and_expected_section_order(): void
    {
        $response = $this->get('/')
            ->assertOk()
            ->assertSee('Fejlesztési partner a vállalkozásod mellé.')
            ->assertSee('Céges weboldalakat, egyedi üzleti rendszereket és saját szoftvermegoldásokat készítünk.')
            ->assertSee('Egyedi fejlesztés')
            ->assertSee('Miben segítünk?')
            ->assertSee('Megoldások valós működési helyzetekre')
            ->assertSee('SzervizPRO')
            ->assertSee('FoodShop')
            ->assertSee('Új saját megoldás')
            ->assertSee('GyrosCity — a FoodShop éles előzménye.')
            ->assertSee('Négy követhető lépés')
            ->assertSee('Átlátható együttműködés. Átgondolt megvalósítás.')
            ->assertSee('Nézd meg, min dolgoztunk.')
            ->assertSee('Szemléltető rendszerábra — nem egy működő termék kezelőfelülete.')
            ->assertDontSee('A műhely átlátja a napot.')
            ->assertDontSee('Ügyfeleink mondták')
            ->assertDontSee('data-hero-option', false)
            ->assertDontSee('data-project-story=', false);

        $html = $response->getContent();
        $this->assertLessThan(strpos($html, 'id="megoldasok"'), strpos($html, 'id="szolgaltatasok"'));
        $this->assertLessThan(strpos($html, 'Négy követhető lépés'), strpos($html, 'id="megoldasok"'));
        $this->assertLessThan(strpos($html, 'Átlátható együttműködés.'), strpos($html, 'Négy követhető lépés'));
        $this->assertSame(3, substr_count($html, 'data-home-product-slot'));
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

        $this->get('/')->assertOk()->assertDontSee('id="referenciak"', false);

        config(['pzdigital.home.show_references' => false]);
        $this->get('/')->assertOk()->assertDontSee('id="referenciak"', false);
        $this->get('/referenciak')->assertOk();
    }

    public function test_homepage_placeholder_is_display_only_and_two_product_variant_stays_balanced(): void
    {
        $response = $this->get('/')
            ->assertOk()
            ->assertSee('data-product-placeholder', false)
            ->assertSee('A harmadik termék részletes bemutatója előkészítés alatt.')
            ->assertDontSee('/termekek/uj-sajat-megoldas', false);

        $this->assertSame(3, substr_count($response->getContent(), 'data-home-product-slot'));
        $this->get('/termekek')->assertDontSee('Új saját megoldás');
        $this->get('/kapcsolat')->assertDontSee('Új saját megoldás');
        $this->get('/sitemap.xml')->assertDontSee('uj-sajat-megoldas');
        $this->get('/termekek/uj-sajat-megoldas')->assertNotFound();

        config(['pzdigital.home.show_product_placeholder' => false]);
        $withoutPlaceholder = $this->get('/')
            ->assertOk()
            ->assertDontSee('data-product-placeholder', false)
            ->assertSee('home-products-grid is-two-up', false);

        $this->assertSame(2, substr_count($withoutPlaceholder->getContent(), 'data-home-product-slot'));
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
            ->assertSee('Digitális munkalapok és gyors státuszváltás.')
            ->assertSee('/media/pzdigital/szervizpro/customer-home.png', false)
            ->assertSee('/media/pzdigital/szervizpro/status-lookup.png', false);
    }

    public function test_foodshop_is_presented_as_a_preparation_with_gyroscity_origin(): void
    {
        $this->assertNull(config('pzdigital.products.foodshop.demo_url'));
        $this->assertSame('origin', config('pzdigital.products.foodshop.related_projects.0.relationship'));

        $this->get('/termekek/foodshop')
            ->assertOk()
            ->assertSee('Termékváltozat előkészítés alatt')
            ->assertSee('Érdeklődöm a megoldásról')
            ->assertSee('GyrosCity — a FoodShop éles előzménye. Referenciaképernyő.')
            ->assertSee('/media/pzdigital/references/gyroscity/menu-desktop.jpg', false)
            ->assertSee(route('projects.show', 'gyroscity'), false)
            ->assertDontSee('Demó kipróbálása');

        $this->get('/kapcsolat?erdeklodes=foodshop')
            ->assertOk()
            ->assertSee('value="foodshop" data-product-option="foodshop" selected', false);
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
        $products['foodshop']['content_approved'] = false;
        config(['pzdigital.products' => $products]);

        $this->get('/termekek/foodshop')->assertNotFound();
        $this->get('/termekek')->assertDontSee(route('products.show', 'foodshop'), false);
        $this->get('/kapcsolat')->assertDontSee('FoodShop — egyeztetés');
        $this->get('/sitemap.xml')->assertDontSee('/termekek/foodshop');
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
        config(['pzdigital.home.show_product_placeholder' => false]);

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
