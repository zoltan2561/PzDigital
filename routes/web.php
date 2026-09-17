<?php

use App\Http\Controllers\Marketing\InquiryController;
use App\Http\Controllers\Marketing\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/termekek', [PageController::class, 'products'])->name('products.index');
Route::get('/termekek/{slug}', [PageController::class, 'product'])->name('products.show');

Route::get('/szolgaltatasok', fn () => app(PageController::class)->page('services'))->name('services');
Route::get('/hogyan-dolgozunk', fn () => app(PageController::class)->page('process'))->name('process');
Route::get('/rolunk', fn () => app(PageController::class)->page('about'))->name('about');
Route::get('/kapcsolat', [InquiryController::class, 'create'])->name('contact');
Route::post('/kapcsolat', [InquiryController::class, 'store'])->middleware('throttle:inquiries')->name('contact.store');
Route::get('/koszonjuk', fn () => view('pages.thank-you'))->name('thank-you');
Route::get('/adatkezeles', fn () => app(PageController::class)->page('privacy'))->name('privacy');
Route::get('/impresszum', fn () => app(PageController::class)->page('legal'))->name('legal');

Route::get('/sitemap.xml', function () {
    $urls = [
        route('home'), route('products.index'), route('services'), route('process'), route('about'), route('contact'),
        ...collect(config('pzdigital.products'))
            ->filter(fn (array $product): bool => $product['publication_status'] === 'published' && $product['content_approved'])
            ->map(fn (array $product): string => route('products.show', $product['slug']))
            ->values()
            ->all(),
    ];

    return response()->view('sitemap', compact('urls'))->header('Content-Type', 'application/xml');
})->name('sitemap');
