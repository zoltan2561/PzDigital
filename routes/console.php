<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('inquiries:prune', function () {
    $cutoff = now()->subMonthsNoOverflow((int) config('pzdigital.inquiry_retention_months'));
    $deleted = DB::table('inquiries')->where('created_at', '<', $cutoff)->delete();

    $this->info("{$deleted} lejárt megkeresés törölve.");
})->purpose('Delete inquiry records older than the configured retention period');

Schedule::command('inquiries:prune')->dailyAt('03:00');
