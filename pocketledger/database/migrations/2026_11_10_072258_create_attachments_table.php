<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('attachments', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('transaction_id');

            $table->string('storage_disk', 30)->default('public');

            $table->string('file_path', 500);
            $table->string('original_name', 255);

            $table->string('mime_type', 127)->nullable();

            $table->unsignedBigInteger('size_bytes');

            $table->timestamps();

            // Enforce that attachment and transaction
            // belong to the same user.
            $table->foreign(
                ['user_id', 'transaction_id'],
                'fk_attachments_user_transaction'
            )
                ->references(['user_id', 'id'])
                ->on('transactions')
                ->restrictOnDelete();

            $table->index(
                ['user_id', 'transaction_id'],
                'idx_attachments_user_transaction'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attachments');
    }
};