<?php

namespace Tests\Feature\Marketing;

use Tests\TestCase;

class PublicPagesTest extends TestCase
{
    public function test_marketing_pages_render(): void
    {
        $routes = [
            '/', '/termekek', '/termekek/szervizpro', '/termekek/foodshop',
            '/szolgaltatasok', '/hogyan-dolgozunk', '/rolunk', '/kapcsolat',
            '/adatkezeles', '/impresszum',
        ];

        foreach ($routes as $route) {
            $this->get($route)->assertOk();
        }
    }

    public function test_homepage_contains_primary_message_and_no_unapproved_reference_section(): void
    {
        $this->get('/')
            ->assertOk()
            ->assertSee('Üzleti szoftverek, amelyek egyszerűbbé teszik')
            ->assertSee('SzervizPRO')
            ->assertSee('FoodShop')
            ->assertDontSee('Ügyfeleink mondták');
    }

    public function test_unknown_product_returns_a_real_404(): void
    {
        $this->get('/termekek/nem-letezik')->assertNotFound();
    }

    public function test_unapproved_product_is_not_public(): void
    {
        $products = config('pzdigital.products');
        $products['foodshop']['content_approved'] = false;
        config(['pzdigital.products' => $products]);

        $this->get('/termekek/foodshop')->assertNotFound();
        $this->get('/termekek')->assertDontSee(route('products.show', 'foodshop'), false);
        $this->get('/sitemap.xml')->assertDontSee('/termekek/foodshop');
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
            ->assertDontSee('/koszonjuk');
    }
}
