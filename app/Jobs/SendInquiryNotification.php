<?php

namespace App\Jobs;

use App\Mail\InquiryReceived;
use App\Models\Inquiry;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;
use Throwable;

class SendInquiryNotification implements ShouldQueue
{
    use Queueable;

    public int $tries = 3;

    public function __construct(public Inquiry $inquiry) {}

    public function backoff(): array
    {
        return [60, 300, 900];
    }

    public function handle(): void
    {
        $this->inquiry->increment('notification_attempts');
        Mail::to(config('pzdigital.contact_email'))->send(new InquiryReceived($this->inquiry));

        $this->inquiry->update([
            'notification_status' => 'sent',
            'notification_sent_at' => now(),
            'notification_failed_at' => null,
        ]);
    }

    public function failed(Throwable $exception): void
    {
        $this->inquiry->update([
            'notification_status' => 'failed',
            'notification_failed_at' => now(),
        ]);
    }
}
