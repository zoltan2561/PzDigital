<?php

use App\Http\Controllers\Marketing\InquiryController;
use App\Http\Controllers\Marketing\PageController;
use App\Support\MarketingCatalog;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/termekek', [PageController::class, 'products'])->name('products.index');
Route::get('/termekek/{slug}', [PageController::class, 'product'])->name('products.show');
Route::get('/referenciak', [PageController::class, 'projects'])->name('projects.index');
Route::get('/referenciak/{slug}', [PageController::class, 'project'])->name('projects.show');

Route::get('/szolgaltatasok', fn () => app(PageController::class)->page('services'))->name('services');
Route::get('/hogyan-dolgozunk', fn () => app(PageController::class)->page('process'))->name('process');
Route::get('/rolunk', fn () => app(PageController::class)->page('about'))->name('about');
Route::get('/kapcsolat', [InquiryController::class, 'create'])->name('contact');
Route::post('/kapcsolat', [InquiryController::class, 'store'])->middleware('throttle:inquiries')->name('contact.store');
Route::get('/koszonjuk', fn () => view('pages.thank-you'))->name('thank-you');
Route::get('/adatkezeles', fn () => app(PageController::class)->page('privacy'))->name('privacy');
Route::get('/impresszum', fn () => app(PageController::class)->page('legal'))->name('legal');

Route::get('/sitemap.xml', function () {
    $catalog = app(MarketingCatalog::class);
    $urls = [
        route('home'), route('products.index'), route('services'), route('process'), route('about'), route('contact'),
        route('projects.index'),
        ...$catalog->products()
            ->map(fn (array $product): string => route('products.show', $product['slug']))
            ->values()
            ->all(),
        ...$catalog->projects()
            ->map(fn (array $project): string => route('projects.show', $project['slug']))
            ->values()
            ->all(),
    ];

    return response()->view('sitemap', compact('urls'))->header('Content-Type', 'application/xml');
})->name('sitemap');
