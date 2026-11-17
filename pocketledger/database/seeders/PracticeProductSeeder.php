<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class PracticeProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         DB::table('practice_products')->insert([
        [
            'name' => 'Laptop',
            'price' => 75000.00,
            'description' => 'A high performance laptop',
            'stock_quantity' => 10,
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'name' => 'Keyboard',
            'price' => 1500.00,
            'description' => 'Mechanical keyboard',
            'stock_quantity' => 25,
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'name' => 'Mouse',
            'price' => 800.00,
            'description' => 'Wireless mouse',
            'stock_quantity' => 30,
            'created_at' => now(),
            'updated_at' => now(),
        ],
    ]);
    }
}
