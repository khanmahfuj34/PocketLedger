<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IPhoneUiViewsTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_can_render_login_and_register_pages(): void
    {
        $loginRes = $this->get(route('login'));
        $loginRes->assertOk();
        $loginRes->assertSee('PocketLedger');
        $loginRes->assertDontSee('dynamicIsland');

        $registerRes = $this->get(route('register'));
        $registerRes->assertOk();
        $registerRes->assertSee('Create Account');
        $registerRes->assertDontSee('dynamicIsland');
    }

    public function test_authenticated_user_can_render_dashboard(): void
    {
        $user = User::create([
            'name' => 'Demo User',
            'email' => 'demo_' . uniqid() . '@example.com',
            'password' => bcrypt('password123'),
        ]);

        $res = $this->actingAs($user)->get(route('dashboard'));
        $res->assertOk();
        $res->assertSee('Dashboard');
        $res->assertDontSee('dynamicIsland');
        $res->assertSee('Monthly Expense Trend');
    }

    public function test_authenticated_user_can_render_transactions_index_and_create(): void
    {
        $user = User::create([
            'name' => 'Demo User',
            'email' => 'demo_tx_' . uniqid() . '@example.com',
            'password' => bcrypt('password123'),
        ]);

        $indexRes = $this->actingAs($user)->get(route('transactions.index'));
        $indexRes->assertOk();
        $indexRes->assertSee('Transactions');
        $indexRes->assertDontSee('dynamicIsland');

        $createRes = $this->actingAs($user)->get(route('transactions.create'));
        $createRes->assertOk();
        $createRes->assertSee('Add Transaction');
        $createRes->assertDontSee('dynamicIsland');
    }
}

