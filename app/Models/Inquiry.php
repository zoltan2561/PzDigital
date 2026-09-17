<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'submission_token',
        'name',
        'email',
        'company',
        'phone',
        'interest_type',
        'product_slug',
        'message',
        'source_path',
        'utm_source',
        'utm_medium',
        'utm_campaign',
        'status',
        'notification_status',
        'notification_attempts',
        'notification_sent_at',
        'notification_failed_at',
        'privacy_version',
        'process_version',
    ];

    protected function casts(): array
    {
        return [
            'notification_sent_at' => 'datetime',
            'notification_failed_at' => 'datetime',
        ];
    }
}
