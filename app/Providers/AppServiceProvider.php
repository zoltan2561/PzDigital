<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        RateLimiter::for('inquiries', function (Request $request): Limit {
            return Limit::perMinute(config('pzdigital.inquiry_rate_limit'))
                ->by($request->ip())
                ->response(fn () => back()->withInput()->withErrors([
                    'form' => 'Túl sok beküldési kísérlet érkezett. Kérjük, várj egy percet, majd próbáld újra.',
                ]));
        });
    }
}
