<?php

namespace App\Http\Controllers\Marketing;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;

class PageController extends Controller
{
    public function home(): View
    {
        return view('pages.home', ['products' => $this->publishedProducts()]);
    }

    public function products(): View
    {
        return view('pages.products.index', ['products' => $this->publishedProducts()]);
    }

    public function product(string $slug): View
    {
        $product = $this->publishedProducts()->get($slug);

        abort_unless($product, 404);

        return view('pages.products.show', compact('product'));
    }

    public function page(string $view): View
    {
        abort_unless(view()->exists("pages.$view"), 404);

        return view("pages.$view");
    }

    private function publishedProducts()
    {
        return collect(config('pzdigital.products'))
            ->filter(fn (array $product): bool => $product['publication_status'] === 'published' && $product['content_approved']);
    }
}
