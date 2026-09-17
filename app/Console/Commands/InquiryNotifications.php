<?php

namespace App\Console\Commands;

use App\Jobs\SendInquiryNotification;
use App\Models\Inquiry;
use Illuminate\Console\Command;

class InquiryNotifications extends Command
{
    protected $signature = 'inquiries:notifications
                            {--retry=* : Újraküldendő érdeklődés UUID azonosítója}
                            {--limit=50 : A listában megjelenő rekordok felső határa}';

    protected $description = 'Listázza a függő/sikertelen értesítéseket, vagy újra queue-ba teszi a kiválasztott rekordokat.';

    public function handle(): int
    {
        $retryIds = array_values(array_unique(array_filter($this->option('retry'))));

        if ($retryIds !== []) {
            $inquiries = Inquiry::query()->whereIn('id', $retryIds)->get();

            foreach ($inquiries as $inquiry) {
                $inquiry->update(['notification_status' => 'pending']);
                SendInquiryNotification::dispatch($inquiry);
                $this->line("Queue-ba helyezve: {$inquiry->id}");
            }

            foreach (array_diff($retryIds, $inquiries->pluck('id')->all()) as $id) {
                $this->warn("Nem található: {$id}");
            }

            return self::SUCCESS;
        }

        $limit = max(1, min((int) $this->option('limit'), 200));
        $rows = Inquiry::query()
            ->whereIn('notification_status', ['pending', 'failed'])
            ->latest()
            ->limit($limit)
            ->get(['id', 'created_at', 'notification_status', 'notification_attempts'])
            ->map(fn (Inquiry $inquiry): array => [
                $inquiry->id,
                $inquiry->created_at?->toDateTimeString(),
                $inquiry->notification_status,
                $inquiry->notification_attempts,
            ]);

        $this->table(['ID', 'Létrehozva', 'Értesítés', 'Próbálkozás'], $rows);
        $this->info("Találatok: {$rows->count()}");

        return self::SUCCESS;
    }
}
