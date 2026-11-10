<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('budgets', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained('users')
                ->restrictOnDelete();

            $table->unsignedBigInteger('category_id');

            $table->decimal('amount', 15, 2);

            // Always store the first day of the month.
            // Example: 2026-11-01
            $table->date('budget_month');

            $table->timestamps();

            $table->foreign(
                ['user_id', 'category_id'],
                'fk_budgets_user_category'
            )
                ->references(['user_id', 'id'])
                ->on('categories')
                ->restrictOnDelete();

            // One budget per user, category and month.
            $table->unique(
                ['user_id', 'category_id', 'budget_month'],
                'uq_budgets_user_category_month'
            );

            // Monthly dashboard budget listing.
            $table->index(
                ['user_id', 'budget_month'],
                'idx_budgets_user_month'
            );
        });

        if (DB::getDriverName() !== 'sqlite') {
            DB::statement("
                ALTER TABLE budgets
                ADD CONSTRAINT chk_budgets_amount
                CHECK (amount > 0)
            ");
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('budgets');
    }
};