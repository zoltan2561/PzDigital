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
            ->assertSee('Ami ma pluszmunka, arra fejlesztünk megoldást.')
            ->assertSee('Egyedi szoftvereket készítünk, összekötjük a rendszereidet, és automatizáljuk az ismétlődő feladatokat. Abból indulunk ki, hol veszítesz időt, és hogyan lehetne egyszerűbb a munkád.')
            ->assertSee('Megnézem a termékeket')
            ->assertSee('Miben segítünk?')
            ->assertSee('Mire szeretnél megoldást?')
            ->assertSee('Egyedi szoftverek')
            ->assertSee('Automatizálás és összekapcsolás')
            ->assertSee('Saját szoftverek a napi működéshez')
            ->assertSee('SzervizPRO')
            ->assertSee('FoodShop')
            ->assertSee('Bemutató elérhető')
            ->assertSee('Előkészítés alatt')
            ->assertSee('GyrosCity — a FoodShop éles előzménye.')
            ->assertSee('Innen indul a közös munka')
            ->assertSee('Javaslatot és ajánlatot kapsz')
            ->assertSee('Az átadás utáni támogatásról és bővítésről a megállapodás szerint egyeztetünk.')
            ->assertSee('Ne neked kelljen összerakni a technikai részleteket.')
            ->assertSee('Nézd meg, min dolgoztunk.')
            ->assertDontSee('Egy időpontfoglalás a gyakorlatban')
            ->assertDontSee('A vendég kiválasztja az időpontot.')
            ->assertDontSee('A foglalás bekerül a naptárba.')
            ->assertDontSee('Te látod, ki mikor érkezik.')
            ->assertDontSee('Szemléltető példa.')
            ->assertSee('Technológiák, amelyekkel dolgozunk')
            ->assertSee('Nem kell ezek közül választanod. A feladathoz megfelelő eszközöket javasoljuk.')
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
        $this->assertLessThan(strpos($html, 'Ne neked kelljen összerakni'), strpos($html, 'id="megoldasok"'));
        $this->assertLessThan(strpos($html, 'Technológiák, amelyekkel dolgozunk'), strpos($html, 'id="referenciak"'));
        $this->assertLessThan(strpos($html, 'Gyakori kérdések'), strpos($html, 'Technológiák, amelyekkel dolgozunk'));
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
            ->assertSee('Technológiák, amelyekkel dolgozunk');

        config(['pzdigital.home.show_references' => false]);
        $this->get('/')
            ->assertOk()
            ->assertDontSee('id="referenciak"', false)
            ->assertSee('Technológiák, amelyekkel dolgozunk');
        $this->get('/referenciak')->assertOk();
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
            ->assertSee('Korábbi és jelenlegi munkák a PZ Digital mögötti fejlesztői tapasztalatból. Ismerd meg az egyes projektek feladatát és megvalósítását.')
            ->assertSee('project-grid project-grid-index', false)
            ->assertSee('Mondd el, mire van szükséged.')
            ->assertDontSee('belső ellenőrzés');

        $this->assertSame(4, substr_count($response->getContent(), 'data-project-card='));
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
        $product->assertSee('Képes bemutató hamarosan')
            ->assertSee(route('contact', ['erdeklodes' => 'szervizpro']), false);
        $this->get('/termekek/foodshop')->assertOk()
            ->assertSee('Előkészítés alatt')
            ->assertSee('nyilvános tesztrendelés jelenleg nem érhető el.')
            ->assertSee(route('contact', ['erdeklodes' => 'foodshop']), false);
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
            ->assertSee('Előkészítés alatt')
            ->assertSee('A GyrosCity rendelési rendszerére épülő megoldás. A több vállalkozásnál bevezethető változat előkészítés alatt áll.')
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
