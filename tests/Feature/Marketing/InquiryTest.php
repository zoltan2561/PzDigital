<?php

namespace Tests\Feature\Marketing;

use App\Jobs\SendInquiryNotification;
use App\Mail\InquiryReceived;
use App\Models\Inquiry;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Tests\TestCase;

class InquiryTest extends TestCase
{
    use RefreshDatabase;

    public function test_valid_inquiry_is_persisted_and_notification_is_queued(): void
    {
        Bus::fake();
        $token = (string) Str::uuid();

        $response = $this->post('/kapcsolat', $this->validPayload($token));

        $response->assertRedirect('/koszonjuk');
        $this->assertDatabaseHas('inquiries', [
            'submission_token' => $token,
            'email' => 'teszt@example.com',
            'product_slug' => 'szervizpro',
            'notification_status' => 'pending',
        ]);
        Bus::assertDispatched(SendInquiryNotification::class, 1);
    }

    public function test_same_submission_token_is_idempotent(): void
    {
        Bus::fake();
        $token = (string) Str::uuid();
        $payload = $this->validPayload($token);

        $this->post('/kapcsolat', $payload)->assertRedirect('/koszonjuk');
        $this->post('/kapcsolat', $payload)->assertRedirect('/koszonjuk');

        $this->assertDatabaseCount('inquiries', 1);
        Bus::assertDispatched(SendInquiryNotification::class, 1);
    }

    public function test_validation_summary_distinguishes_field_errors_from_form_failures(): void
    {
        Bus::fake();
        config(['pzdigital.inquiry_rate_limit' => 1]);
        $payload = [...$this->validPayload((string) Str::uuid()), 'name' => ''];

        $this->followingRedirects()->from('/kapcsolat')->post('/kapcsolat', $payload)->assertOk()
            ->assertSee('Nézd át a megjelölt mezőket.')
            ->assertSee('Javítsd az adatokat, majd küldd el újra.')
            ->assertSee('aria-invalid="true" aria-describedby="name-error"', false);

        $this->followingRedirects()->from('/kapcsolat')->post('/kapcsolat', $payload)->assertOk()
            ->assertSee('A beküldést nem tudtuk feldolgozni.')
            ->assertSee('Túl sok beküldési kísérlet érkezett.')
            ->assertDontSee('Javítsd az adatokat, majd küldd el újra.');

        $this->assertDatabaseCount('inquiries', 0);
        Bus::assertNothingDispatched();
    }

    public function test_custom_development_requires_a_message(): void
    {
        Bus::fake();

        $this->from('/kapcsolat')->post('/kapcsolat', [
            ...$this->validPayload((string) Str::uuid()),
            'interest_type' => 'custom_development',
            'product_slug' => null,
            'message' => '',
        ])->assertRedirect('/kapcsolat')->assertSessionHasErrors('message');

        $this->assertDatabaseCount('inquiries', 0);
        Bus::assertNothingDispatched();
    }

    public function test_existing_system_interest_is_selectable_validated_and_persisted(): void
    {
        Bus::fake();
        $token = (string) Str::uuid();

        $this->get('/kapcsolat?erdeklodes=existing_system')
            ->assertOk()
            ->assertSee('Meglévő rendszer továbbfejlesztése')
            ->assertSee('value="existing_system" selected', false);

        $this->post('/kapcsolat', [
            ...$this->validPayload($token),
            'interest_type' => 'existing_system',
            'product_slug' => null,
            'message' => 'A meglévő belső rendszer egy folyamatát szeretnénk továbbfejleszteni.',
        ])->assertRedirect('/koszonjuk');

        $this->assertDatabaseHas('inquiries', [
            'submission_token' => $token,
            'interest_type' => 'existing_system',
            'product_slug' => null,
        ]);
        Bus::assertDispatched(SendInquiryNotification::class, 1);
    }

    public function test_reference_context_is_validated_and_persisted(): void
    {
        Bus::fake();
        $token = (string) Str::uuid();

        $this->post('/kapcsolat', [
            ...$this->validPayload($token),
            'interest_type' => 'project_reference',
            'product_slug' => null,
            'project_slug' => 'gyroscity',
        ])->assertRedirect('/koszonjuk');

        $this->assertDatabaseHas('inquiries', [
            'submission_token' => $token,
            'interest_type' => 'project_reference',
            'project_slug' => 'gyroscity',
        ]);
    }

    public function test_product_interest_options_follow_the_published_catalog(): void
    {
        $products = config('pzdigital.products');
        $products['uj-termek'] = [
            ...$products['szervizpro'],
            'slug' => 'uj-termek',
            'name' => 'Új termék',
            'sort_order' => 30,
        ];
        config(['pzdigital.products' => $products]);

        $this->get('/kapcsolat?erdeklodes=uj-termek')
            ->assertOk()
            ->assertSee('Új termék — bemutató')
            ->assertSee('value="uj-termek"', false);
    }

    public function test_honeypot_and_unknown_product_are_rejected(): void
    {
        $this->post('/kapcsolat', [
            ...$this->validPayload((string) Str::uuid()),
            'website' => 'spam.example',
            'product_slug' => 'ismeretlen',
        ])->assertSessionHasErrors(['website', 'product_slug']);

        $this->assertDatabaseCount('inquiries', 0);
    }

    public function test_notification_job_sends_to_configured_address_and_updates_state(): void
    {
        Mail::fake();
        config(['pzdigital.contact_email' => 'inbox@pzdigital.test']);

        $inquiry = Inquiry::create([
            'submission_token' => (string) Str::uuid(),
            'name' => 'Teszt Elek',
            'email' => 'teszt@example.com',
            'interest_type' => 'other',
            'message' => 'Teszt megkeresés',
            'privacy_version' => 'test-v1',
            'process_version' => 'v1',
            'notification_status' => 'pending',
        ]);

        (new SendInquiryNotification($inquiry))->handle();

        Mail::assertSent(InquiryReceived::class, fn (InquiryReceived $mail): bool => $mail->hasTo('inbox@pzdigital.test'));
        $this->assertSame('sent', $inquiry->fresh()->notification_status);
        $this->assertSame(1, $inquiry->fresh()->notification_attempts);
    }

    public function test_exhausted_notification_job_marks_the_inquiry_as_failed(): void
    {
        $inquiry = Inquiry::create([
            'submission_token' => (string) Str::uuid(),
            'name' => 'Teszt Elek',
            'email' => 'teszt@example.com',
            'interest_type' => 'other',
            'privacy_version' => 'test-v1',
            'process_version' => 'v1',
            'notification_status' => 'pending',
        ]);

        (new SendInquiryNotification($inquiry))->failed(new \RuntimeException('SMTP unavailable'));

        $this->assertSame('failed', $inquiry->fresh()->notification_status);
        $this->assertNotNull($inquiry->fresh()->notification_failed_at);
    }

    private function validPayload(string $token): array
    {
        return [
            'submission_token' => $token,
            'name' => 'Teszt Elek',
            'email' => 'teszt@example.com',
            'company' => 'Teszt Műhely',
            'phone' => '+36 30 123 4567',
            'interest_type' => 'szervizpro',
            'product_slug' => 'szervizpro',
            'project_slug' => null,
            'message' => 'Szeretnék bemutatót kérni.',
            'source_path' => '/termekek/szervizpro',
            'utm_source' => 'manual-test',
            'utm_medium' => 'web',
            'utm_campaign' => 'v1',
            'website' => null,
        ];
    }
}
