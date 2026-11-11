<?php

namespace Tests\Feature;

use App\Models\Budget;
use App\Models\Category;
use App\Models\Transaction;
use App\Models\User;
use App\Services\BudgetService;
use Carbon\CarbonImmutable;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BudgetServiceTest extends TestCase
{
    use RefreshDatabase;

    private BudgetService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new BudgetService();
    }

    public function test_empty_collection_returned_when_user_has_no_budgets(): void
    {
        $user = User::create([
            'name' => 'No Budget User',
            'email' => 'nobudget_' . uniqid() . '@example.com',
            'password' => bcrypt('password123'),
        ]);

        $month = CarbonImmutable::parse('2026-11-01');
        $progress = $this->service->getMonthlyProgress($user, $month);

        $this->assertTrue($progress->isEmpty());
    }

    public function test_budget_progress_status_normal_warning_and_exceeded(): void
    {
        $user = User::create([
            'name' => 'Budget Master',
            'email' => 'master_' . uniqid() . '@example.com',
            'password' => bcrypt('password123'),
        ]);

        $catNormal = Category::create([
            'user_id' => $user->id,
            'name' => 'Groceries',
            'type' => 'expense',
            'color' => '#10B981',
            'is_active' => true,
        ]);

        $catWarning = Category::create([
            'user_id' => $user->id,
            'name' => 'Dining Out',
            'type' => 'expense',
            'color' => '#F59E0B',
            'is_active' => true,
        ]);

        $catExceeded = Category::create([
            'user_id' => $user->id,
            'name' => 'Electronics',
            'type' => 'expense',
            'color' => '#EF4444',
            'is_active' => true,
        ]);

        $month = CarbonImmutable::parse('2026-11-01');

        // 1. Normal Budget: 10,000, Spent: 5,000 (50%)
        $b1 = Budget::create([
            'user_id' => $user->id,
            'category_id' => $catNormal->id,
            'amount' => 10000.00,
            'budget_month' => '2026-11-01',
        ]);
        Transaction::create([
            'user_id' => $user->id,
            'category_id' => $catNormal->id,
            'title' => 'Grocery Shop',
            'amount' => 5000.00,
            'transaction_date' => '2026-11-05',
            'payment_method' => 'cash',
        ]);

        // 2. Warning Budget: 5,000, Spent: 4,200 (84%)
        $b2 = Budget::create([
            'user_id' => $user->id,
            'category_id' => $catWarning->id,
            'amount' => 5000.00,
            'budget_month' => '2026-11-01',
        ]);
        Transaction::create([
            'user_id' => $user->id,
            'category_id' => $catWarning->id,
            'title' => 'Fancy Restaurant',
            'amount' => 4200.00,
            'transaction_date' => '2026-11-10',
            'payment_method' => 'card',
        ]);

        // 3. Exceeded Budget: 2,000, Spent: 2,500 (125%)
        $b3 = Budget::create([
            'user_id' => $user->id,
            'category_id' => $catExceeded->id,
            'amount' => 2000.00,
            'budget_month' => '2026-11-01',
        ]);
        Transaction::create([
            'user_id' => $user->id,
            'category_id' => $catExceeded->id,
            'title' => 'New Headphones',
            'amount' => 2500.00,
            'transaction_date' => '2026-11-15',
            'payment_method' => 'card',
        ]);

        // Transaction in another month (must not be counted)
        Transaction::create([
            'user_id' => $user->id,
            'category_id' => $catNormal->id,
            'title' => 'Past Month Grocery',
            'amount' => 9999.00,
            'transaction_date' => '2026-10-25',
            'payment_method' => 'cash',
        ]);

        $progress = $this->service->getMonthlyProgress($user, $month)->keyBy('id');

        // Check b1 (Normal)
        $this->assertEquals('10000.00', $progress[$b1->id]['budget_amount']);
        $this->assertEquals('5000.00', $progress[$b1->id]['spent_amount']);
        $this->assertEquals('5000.00', $progress[$b1->id]['remaining_amount']);
        $this->assertEquals(50.0, $progress[$b1->id]['usage_percentage']);
        $this->assertEquals('normal', $progress[$b1->id]['status']);

        // Check b2 (Warning)
        $this->assertEquals('5000.00', $progress[$b2->id]['budget_amount']);
        $this->assertEquals('4200.00', $progress[$b2->id]['spent_amount']);
        $this->assertEquals('800.00', $progress[$b2->id]['remaining_amount']);
        $this->assertEquals(84.0, $progress[$b2->id]['usage_percentage']);
        $this->assertEquals('warning', $progress[$b2->id]['status']);

        // Check b3 (Exceeded)
        $this->assertEquals('2000.00', $progress[$b3->id]['budget_amount']);
        $this->assertEquals('2500.00', $progress[$b3->id]['spent_amount']);
        $this->assertEquals('-500.00', $progress[$b3->id]['remaining_amount']);
        $this->assertEquals(125.0, $progress[$b3->id]['usage_percentage']);
        $this->assertEquals('exceeded', $progress[$b3->id]['status']);
    }

    public function test_budget_controller_index_integration_with_service(): void
    {
        $user = User::create([
            'name' => 'Controller User',
            'email' => 'ctrl_' . uniqid() . '@example.com',
            'password' => bcrypt('password123'),
        ]);

        $cat = Category::create([
            'user_id' => $user->id,
            'name' => 'Transport',
            'type' => 'expense',
            'color' => '#3B82F6',
            'is_active' => true,
        ]);

        Budget::create([
            'user_id' => $user->id,
            'category_id' => $cat->id,
            'amount' => 3000.00,
            'budget_month' => '2026-11-01',
        ]);

        $res = $this->actingAs($user)->get(route('budgets.index'));
        $res->assertOk();
        $res->assertViewHas('budgets');
        $res->assertViewHas('budgetProgress');
        $res->assertViewHas('selectedMonth');
        $res->assertSee('Transport');
        $res->assertSee('3,000.00');
    }
}

