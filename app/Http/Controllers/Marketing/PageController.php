<?php

namespace App\Http\Controllers\Marketing;

use App\Http\Controllers\Controller;
use App\Support\MarketingCatalog;
use Illuminate\Contracts\View\View;

class PageController extends Controller
{
    public function __construct(private readonly MarketingCatalog $catalog) {}

    public function home(): View
    {
        return view('pages.home', [
            'products' => $this->catalog->featuredProducts(),
            'projects' => $this->catalog->homepageStoryProjects(),
            'showReferences' => (bool) config('pzdigital.home.show_references', true),
            'productPlaceholder' => config('pzdigital.home.show_product_placeholder', false)
                ? config('pzdigital.home.product_placeholder')
                : null,
        ]);
    }

    public function products(): View
    {
        return view('pages.products.index', ['products' => $this->catalog->products()]);
    }

    public function product(string $slug): View
    {
        $product = $this->catalog->products()->get($slug);

        abort_unless($product, 404);

        return view('pages.products.show', [
            'product' => $product,
            'relatedProjects' => $this->catalog->relatedProjects($product),
        ]);
    }

    public function projects(): View
    {
        return view('pages.projects.index', ['projects' => $this->catalog->projects()]);
    }

    public function project(string $slug): View
    {
        $project = $this->catalog->projects()->get($slug);

        abort_unless($project, 404);

        return view('pages.projects.show', [
            'project' => $project,
            'nextProject' => $this->catalog->nextProject($slug),
        ]);
    }

    public function page(string $view): View
    {
        abort_unless(view()->exists("pages.$view"), 404);

        return view("pages.$view");
    }
}
