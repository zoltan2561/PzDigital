<?php

namespace Tests\Feature\Marketing;

use App\Models\Inquiry;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;
use Tests\TestCase;

class InquiryRetentionTest extends TestCase
{
    use RefreshDatabase;

    public function test_prune_deletes_expired_inquiries_and_keeps_recent_ones(): void
    {
        $old = $this->createInquiry('old@example.com');
        $recent = $this->createInquiry('recent@example.com');

        $old->timestamps = false;
        $old->created_at = now()->subMonthsNoOverflow(12)->subDay();
        $old->save();

        Artisan::call('inquiries:prune');

        $this->assertModelMissing($old);
        $this->assertModelExists($recent);
    }

    private function createInquiry(string $email): Inquiry
    {
        return Inquiry::create([
            'submission_token' => (string) Str::uuid(),
            'name' => 'Teszt Elek',
            'email' => $email,
            'interest_type' => 'other',
            'privacy_version' => 'test-v1',
        ]);
    }
}
