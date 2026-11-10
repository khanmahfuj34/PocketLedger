<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained('users')
                ->restrictOnDelete();

            $table->unsignedBigInteger('category_id');

            $table->string('title', 150);

            $table->decimal('amount', 15, 2);

            $table->date('transaction_date');

            // Cash, bKash, Nagad, Bank, Card etc.
            $table->string('payment_method', 30)
                ->default('cash');

            $table->text('note')->nullable();

            $table->timestamps();

            $table->softDeletes();

            // Composite unique key for attachment ownership.
            $table->unique(
                ['user_id', 'id'],
                'uq_transactions_user_id_id'
            );

            // Prevent cross-user category assignment.
            $table->foreign(
                ['user_id', 'category_id'],
                'fk_transactions_user_category'
            )
                ->references(['user_id', 'id'])
                ->on('categories')
                ->restrictOnDelete();

            // Default transaction history.
            $table->index(
                ['user_id', 'deleted_at', 'transaction_date', 'id'],
                'idx_tx_user_deleted_date'
            );

            // Category-wise transaction filtering.
            $table->index(
                ['user_id', 'category_id', 'deleted_at', 'transaction_date', 'id'],
                'idx_tx_user_category_date'
            );

            // Prefix search by transaction title.
            $table->index(
                ['user_id', 'deleted_at', 'title'],
                'idx_tx_user_title'
            );

            // Word-based search.
            if (DB::getDriverName() !== 'sqlite') {
                $table->fullText(
                    ['title', 'note'],
                    'ft_tx_title_note'
                );
            }
        });

        if (DB::getDriverName() !== 'sqlite') {
            DB::statement("
                ALTER TABLE transactions
                ADD CONSTRAINT chk_transactions_amount
                CHECK (amount > 0)
            ");
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};