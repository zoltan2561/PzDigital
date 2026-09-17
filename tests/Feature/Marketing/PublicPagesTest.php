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
            ->assertSee('Weboldalak és rendszerek, a')
            ->assertSee('vállalkozásodra szabva.')
            ->assertSee('Miben segítünk?')
            ->assertSee('Válogatott munkáink')
            ->assertSee('Saját szoftvermegoldásaink')
            ->assertSee('SzervizPRO')
            ->assertSee('FoodShop')
            ->assertSee('GyrosCity — saját étlap és rendelési felület')
            ->assertSee('Kiemelt referenciamunka')
            ->assertSee('/media/pzdigital/references/gyroscity/menu-desktop.jpg', false)
            ->assertSee('/media/pzdigital/references/gyroscity/menu-card.jpg', false)
            ->assertDontSee('A műhely átlátja a napot.')
            ->assertDontSee('Ügyfeleink mondták');

        $html = $response->getContent();
        $this->assertLessThan(strpos($html, 'id="munkaink"'), strpos($html, 'id="szolgaltatasok"'));
        $this->assertLessThan(strpos($html, 'id="megoldasok"'), strpos($html, 'id="munkaink"'));
        $this->assertSame(1, substr_count($html, 'data-project-featured='));
        $this->assertSame(2, substr_count($html, 'data-project-card='));
    }

    public function test_homepage_project_showcase_uses_configured_project_and_safe_fallbacks(): void
    {
        config(['pzdigital.featured_project_slug' => 'napiinfo']);

        $this->get('/')
            ->assertOk()
            ->assertSee('data-project-featured="napiinfo"', false)
            ->assertSee('data-project-card="gyroscity"', false);

        $projects = config('pzdigital.projects');
        $projects['napiinfo']['content_approved'] = false;
        config(['pzdigital.projects' => $projects]);

        $this->get('/')
            ->assertOk()
            ->assertSee('data-project-featured="gyroscity"', false)
            ->assertDontSee('data-project-card="napiinfo"', false);

        config(['pzdigital.projects' => collect($projects)->map(fn (array $project): array => [
            ...$project,
            'content_approved' => false,
        ])->all()]);

        $this->get('/')->assertOk()->assertDontSee('id="munkaink"', false);
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

        $this->get('/')->assertDontSee('data-project-card="napiinfo"', false);
        $this->get('/referenciak')->assertDontSee(route('projects.show', 'napiinfo'), false);
        $this->get('/referenciak/napiinfo')->assertNotFound();
        $this->get('/kapcsolat?referencia=napiinfo')->assertDontSee('NapiInfo projekthez hasonló fejlesztés');
        $this->get('/sitemap.xml')->assertDontSee('/referenciak/napiinfo');
    }

    public function test_product_layout_supports_two_three_and_five_items_with_home_limit(): void
    {
        $base = config('pzdigital.products.szervizpro');

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
