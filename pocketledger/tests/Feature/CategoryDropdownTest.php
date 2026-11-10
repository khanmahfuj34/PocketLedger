<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryDropdownTest extends TestCase
{
    use RefreshDatabase;

    public function test_new_user_registration_seeds_default_categories(): void
    {
        $uniqueEmail = 'user_' . uniqid() . '@example.com';

        $response = $this->post(route('register'), [
            'name' => 'John Doe',
            'email' => $uniqueEmail,
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertRedirect(route('dashboard'));

        $user = User::where('email', $uniqueEmail)->first();
        $this->assertNotNull($user);

        $this->assertGreaterThan(0, $user->categories()->where('type', 'expense')->count());
        $this->assertGreaterThan(0, $user->categories()->where('type', 'income')->count());
    }

    public function test_create_transaction_page_loads_categories_and_auto_seeds_if_empty(): void
    {
        $uniqueEmail = 'user_empty_' . uniqid() . '@example.com';
        $user = User::create([
            'name' => 'Empty Cat User',
            'email' => $uniqueEmail,
            'password' => bcrypt('password123'),
        ]);

        $this->assertEquals(0, $user->categories()->count());

        $response = $this->actingAs($user)->get(route('transactions.create'));

        $response->assertOk();
        $response->assertViewHas('categories');

        // User should now have auto-seeded categories
        $this->assertGreaterThan(0, $user->categories()->count());
    }

    public function test_user_can_submit_transaction_with_valid_category(): void
    {
        $uniqueEmail = 'user_tx_' . uniqid() . '@example.com';
        $user = User::create([
            'name' => 'Transaction User',
            'email' => $uniqueEmail,
            'password' => bcrypt('password123'),
        ]);
        $user->createDefaultCategories();

        $category = $user->categories()->where('type', 'expense')->first();

        $response = $this->actingAs($user)->post(route('transactions.store'), [
            'category_id' => $category->id,
            'title' => 'Grocery shopping',
            'amount' => 450.00,
            'transaction_date' => now()->toDateString(),
            'payment_method' => 'cash',
            'note' => 'Weekly vegetables and fruits',
        ]);

        $response->assertRedirect(route('transactions.create'));
        $this->assertDatabaseHas('transactions', [
            'user_id' => $user->id,
            'category_id' => $category->id,
            'title' => 'Grocery shopping',
            'amount' => 450.00,
        ]);
    }

    public function test_user_cannot_use_another_users_category(): void
    {
        $userA = User::create([
            'name' => 'User A',
            'email' => 'usera_' . uniqid() . '@example.com',
            'password' => bcrypt('password123'),
        ]);
        $userA->createDefaultCategories();

        $userB = User::create([
            'name' => 'User B',
            'email' => 'userb_' . uniqid() . '@example.com',
            'password' => bcrypt('password123'),
        ]);
        $userB->createDefaultCategories();

        $categoryOfA = $userA->categories()->first();

        // User B tries to use User A's category
        $response = $this->actingAs($userB)->post(route('transactions.store'), [
            'category_id' => $categoryOfA->id,
            'title' => 'Hacked transaction',
            'amount' => 100.00,
            'transaction_date' => now()->toDateString(),
            'payment_method' => 'cash',
        ]);

        $response->assertSessionHasErrors('category_id');
    }
}
