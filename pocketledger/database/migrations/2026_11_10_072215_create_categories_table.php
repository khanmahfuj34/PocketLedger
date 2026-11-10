<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained('users')
                ->restrictOnDelete();

            $table->string('name', 100);
            $table->string('type', 20);

            $table->string('icon', 50)->nullable();
            $table->string('color', 20)->nullable();

            $table->boolean('is_active')->default(true);

            $table->timestamps();

            // Same user cannot create duplicate category names
            // within the same category type.
            $table->unique(
                ['user_id', 'type', 'name'],
                'uq_categories_user_type_name'
            );

            // Needed for composite foreign keys from child tables.
            $table->unique(
                ['user_id', 'id'],
                'uq_categories_user_id_id'
            );
        });

        if (DB::getDriverName() !== 'sqlite') {
            DB::statement("
                ALTER TABLE categories
                ADD CONSTRAINT chk_categories_type
                CHECK (type IN ('income', 'expense'))
            ");
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};