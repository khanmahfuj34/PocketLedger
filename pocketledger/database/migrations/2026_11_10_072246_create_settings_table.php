<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->unique('uq_settings_user')
                ->constrained('users')
                ->restrictOnDelete();

            $table->char('currency', 3)->default('BDT');

            $table->string('timezone', 64)
                ->default('Asia/Dhaka');

            $table->string('theme', 20)
                ->default('system');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};