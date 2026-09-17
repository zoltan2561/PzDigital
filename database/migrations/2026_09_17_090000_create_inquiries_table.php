<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('inquiries', function (Blueprint $table): void {
            $table->uuid('id')->primary();
            $table->uuid('submission_token')->unique();
            $table->string('name', 120);
            $table->string('email', 254);
            $table->string('company', 160)->nullable();
            $table->string('phone', 40)->nullable();
            $table->string('interest_type', 40);
            $table->string('product_slug', 60)->nullable();
            $table->text('message')->nullable();
            $table->string('source_path', 180)->nullable();
            $table->string('utm_source', 100)->nullable();
            $table->string('utm_medium', 100)->nullable();
            $table->string('utm_campaign', 100)->nullable();
            $table->string('status', 30)->default('new');
            $table->string('notification_status', 30)->default('pending');
            $table->unsignedSmallInteger('notification_attempts')->default(0);
            $table->timestamp('notification_sent_at')->nullable();
            $table->timestamp('notification_failed_at')->nullable();
            $table->string('privacy_version', 40);
            $table->string('process_version', 40)->default('v1');
            $table->timestamps();

            $table->index(['notification_status', 'created_at']);
            $table->index(['status', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inquiries');
    }
};
