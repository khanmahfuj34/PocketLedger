<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GlobalMonthSelectorTest extends TestCase
{
    use RefreshDatabase;

    public function test_default_dashboard_uses_current_month(): void
    {
        $user = User::create([
            'name' => 'Demo User',
            'email' => 'user_' . uniqid() . '@example.com',
            'password' => bcrypt('password123'),
        ]);

        $response = $this->actingAs($user)->get(route('dashboard'));

        $response->assertOk();
        $response->assertSee(now()->format('M Y'));
        $response->assertSee(now()->format('F Y'));
    }

    public function test_selecting_specific_month_scopes_income_and_expense_accurately(): void
    {
        $user = User::create([
            'name' => 'John Doe',
            'email' => 'john_' . uniqid() . '@example.com',
            'password' => bcrypt('password123'),
        ]);
        $user->created_at = \Carbon\Carbon::parse('2026-01-01');
        $user->save();

        $incomeCat = Category::create([
            'user_id' => $user->id,
            'name' => 'Salary',
            'type' => 'income',
            'color' => '#10B981',
            'is_active' => true,
        ]);

        $expenseCat = Category::create([
            'user_id' => $user->id,
            'name' => 'Groceries',
            'type' => 'expense',
            'color' => '#EF4444',
            'is_active' => true,
        ]);

        // Nov 2026 transaction
        Transaction::create([
            'user_id' => $user->id,
            'category_id' => $incomeCat->id,
            'title' => 'November Salary',
            'amount' => 50000.00,
            'transaction_date' => '2026-11-05',
            'payment_method' => 'bank_transfer',
        ]);

        Transaction::create([
            'user_id' => $user->id,
            'category_id' => $expenseCat->id,
            'title' => 'November Grocery',
            'amount' => 12000.00,
            'transaction_date' => '2026-11-15',
            'payment_method' => 'cash',
        ]);

        // Oct 2026 transaction (should NOT be counted in November)
        Transaction::create([
            'user_id' => $user->id,
            'category_id' => $expenseCat->id,
            'title' => 'October Shopping',
            'amount' => 9999.00,
            'transaction_date' => '2026-10-20',
            'payment_method' => 'card',
        ]);

        // Dec 2026 transaction (should NOT be counted in November)
        Transaction::create([
            'user_id' => $user->id,
            'category_id' => $expenseCat->id,
            'title' => 'December Travel',
            'amount' => 8888.00,
            'transaction_date' => '2026-12-01',
            'payment_method' => 'card',
        ]);

        // Request November 2026
        $resNov = $this->actingAs($user)->get(route('dashboard', ['month' => '2026-11']));
        $resNov->assertOk();
        $resNov->assertSee('Nov 2026');
        $resNov->assertSee('November 2026');
        // Total monthly income: 50,000.00
        $resNov->assertSee('50,000.00');
        // Total monthly expense: 12,000.00
        $resNov->assertSee('12,000.00');
        // Net savings: 38,000.00
        $resNov->assertSee('38,000.00');
        // Transactions from adjacent months must not appear in November's list
        $resNov->assertSee('November Grocery');
        $resNov->assertDontSee('October Shopping');
        $resNov->assertDontSee('December Travel');

        // Available month in dropdown menu
        $resNov->assertSee('month=2026-10');
        // Future month must NOT appear in dropdown
        $resNov->assertDontSee('month=2026-12');

        // Request October 2026
        $resOct = $this->actingAs($user)->get(route('dashboard', ['month' => '2026-10']));
        $resOct->assertOk();
        $resOct->assertSee('Oct 2026');
        $resOct->assertSee('October 2026');
        $resOct->assertSee('9,999.00');
        $resOct->assertDontSee('November Grocery');
    }

    public function test_february_leap_year_handling(): void
    {
        $user = User::create([
            'name' => 'Leap User',
            'email' => 'leap_' . uniqid() . '@example.com',
            'password' => bcrypt('password123'),
        ]);
        $user->created_at = \Carbon\Carbon::parse('2024-01-01');
        $user->save();

        $cat = Category::create([
            'user_id' => $user->id,
            'name' => 'Leap Expense',
            'type' => 'expense',
            'color' => '#F59E0B',
            'is_active' => true,
        ]);

        // Transaction on Feb 29, 2024 (leap day)
        Transaction::create([
            'user_id' => $user->id,
            'category_id' => $cat->id,
            'title' => 'Leap Day Bill',
            'amount' => 450.00,
            'transaction_date' => '2024-02-29',
            'payment_method' => 'cash',
        ]);

        $res = $this->actingAs($user)->get(route('dashboard', ['month' => '2024-02']));
        $res->assertOk();
        $res->assertSee('Feb 2024');
        $res->assertSee('February 2024');
        $res->assertSee('450.00');
        $res->assertSee('Leap Day Bill');
    }

    public function test_empty_month_renders_zero_and_friendly_empty_states(): void
    {
        $user = User::create([
            'name' => 'Empty Month User',
            'email' => 'empty_' . uniqid() . '@example.com',
            'password' => bcrypt('password123'),
        ]);
        $user->created_at = \Carbon\Carbon::parse('2025-01-01');
        $user->save();

        $res = $this->actingAs($user)->get(route('dashboard', ['month' => '2025-05']));
        $res->assertOk();
        $res->assertSee('May 2025');
        $res->assertSee('৳ 0.00');
        $res->assertSee('No transactions recorded for May 2025');
        $res->assertSee('No expense categories recorded for May 2025');
    }

    public function test_user_data_isolation_with_month_selector(): void
    {
        $userA = User::create([
            'name' => 'User A',
            'email' => 'userA_' . uniqid() . '@example.com',
            'password' => bcrypt('password123'),
        ]);

        $userB = User::create([
            'name' => 'User B',
            'email' => 'userB_' . uniqid() . '@example.com',
            'password' => bcrypt('password123'),
        ]);

        $catA = Category::create([
            'user_id' => $userA->id,
            'name' => 'User A Groceries',
            'type' => 'expense',
            'color' => '#10B981',
            'is_active' => true,
        ]);

        $catB = Category::create([
            'user_id' => $userB->id,
            'name' => 'User B Secret Expense',
            'type' => 'expense',
            'color' => '#EF4444',
            'is_active' => true,
        ]);

        Transaction::create([
            'user_id' => $userA->id,
            'category_id' => $catA->id,
            'title' => 'Secret Item for User A',
            'amount' => 1500.00,
            'transaction_date' => '2026-11-10',
            'payment_method' => 'cash',
        ]);

        Transaction::create([
            'user_id' => $userB->id,
            'category_id' => $catB->id,
            'title' => 'User B Private Record',
            'amount' => 8800.00,
            'transaction_date' => '2026-11-10',
            'payment_method' => 'card',
        ]);

        // User A should only see User A's data
        $resA = $this->actingAs($userA)->get(route('dashboard', ['month' => '2026-11']));
        $resA->assertOk();
        $resA->assertSee('1,500.00');
        $resA->assertSee('Secret Item for User A');
        $resA->assertDontSee('User B Private Record');
        $resA->assertDontSee('8,800.00');

        // User B should only see User B's data
        $resB = $this->actingAs($userB)->get(route('dashboard', ['month' => '2026-11']));
        $resB->assertOk();
        $resB->assertSee('8,800.00');
        $resB->assertSee('User B Private Record');
        $resB->assertDontSee('Secret Item for User A');
        $resB->assertDontSee('1,500.00');
    }

    public function test_third_summary_card_switches_between_remaining_balance_and_net_monthly_savings(): void
    {
        $tz = config('app.timezone', 'Asia/Dhaka');
        $currentMonth = \Carbon\Carbon::now($tz)->format('Y-m');
        $prevMonth = \Carbon\Carbon::now($tz)->subMonth()->format('Y-m');

        $user = User::create([
            'name' => 'Card Switcher',
            'email' => 'switcher_' . uniqid() . '@example.com',
            'password' => bcrypt('password123'),
        ]);
        $user->created_at = \Carbon\Carbon::now($tz)->subMonths(3);
        $user->save();

        $incCat = Category::create([
            'user_id' => $user->id,
            'name' => 'Income Switch',
            'type' => 'income',
            'color' => '#10B981',
            'is_active' => true,
        ]);

        $expCat = Category::create([
            'user_id' => $user->id,
            'name' => 'Expense Switch',
            'type' => 'expense',
            'color' => '#EF4444',
            'is_active' => true,
        ]);

        // 1. Current month with positive balance
        Transaction::create([
            'user_id' => $user->id,
            'category_id' => $incCat->id,
            'title' => 'Current Inc',
            'amount' => 5000.00,
            'transaction_date' => $currentMonth . '-05',
            'payment_method' => 'cash',
        ]);
        Transaction::create([
            'user_id' => $user->id,
            'category_id' => $expCat->id,
            'title' => 'Current Exp',
            'amount' => 2000.00,
            'transaction_date' => $currentMonth . '-10',
            'payment_method' => 'cash',
        ]);

        $resCurrent = $this->actingAs($user)->get(route('dashboard', ['month' => $currentMonth]));
        $resCurrent->assertOk();
        $resCurrent->assertSee('Remaining Balance');
        $resCurrent->assertSee("Remaining balance from this month's income", false);
        $resCurrent->assertSee('3,000.00');
        $resCurrent->assertSee('text-emerald-800');
        $resCurrent->assertDontSee('Net Monthly Savings');

        // 2. Previous month
        Transaction::create([
            'user_id' => $user->id,
            'category_id' => $incCat->id,
            'title' => 'Prev Inc',
            'amount' => 10000.00,
            'transaction_date' => $prevMonth . '-05',
            'payment_method' => 'cash',
        ]);
        Transaction::create([
            'user_id' => $user->id,
            'category_id' => $expCat->id,
            'title' => 'Prev Exp',
            'amount' => 6000.00,
            'transaction_date' => $prevMonth . '-10',
            'payment_method' => 'cash',
        ]);

        $resPrev = $this->actingAs($user)->get(route('dashboard', ['month' => $prevMonth]));
        $resPrev->assertOk();
        $resPrev->assertSee('Net Monthly Savings');
        $resPrev->assertSee('savings rate (Income - Expense)');
        $resPrev->assertSee('4,000.00');
        $resPrev->assertDontSee('Remaining Balance');

        // 3. Current month with negative balance
        Transaction::create([
            'user_id' => $user->id,
            'category_id' => $expCat->id,
            'title' => 'Huge Deficit',
            'amount' => 10000.00,
            'transaction_date' => $currentMonth . '-12',
            'payment_method' => 'cash',
        ]);

        $resDeficit = $this->actingAs($user)->get(route('dashboard', ['month' => $currentMonth]));
        $resDeficit->assertOk();
        $resDeficit->assertSee('Remaining Balance');
        $resDeficit->assertSee('border-rose-100');
        $resDeficit->assertSee('text-rose-800');
        $resDeficit->assertSee('-৳ 7,000.00');
    }

    public function test_dropdown_available_months_bounded_by_account_creation_and_current_month(): void
    {
        $tz = config('app.timezone', 'Asia/Dhaka');
        $currentDate = \Carbon\Carbon::now($tz)->startOfMonth();

        // User A created in June 2025
        $userA = User::create([
            'name' => 'Older User',
            'email' => 'older_' . uniqid() . '@example.com',
            'password' => bcrypt('password123'),
        ]);
        $userA->created_at = \Carbon\Carbon::parse('2025-06-15', $tz);
        $userA->save();

        $resA = $this->actingAs($userA)->get(route('dashboard'));
        $resA->assertOk();
        $availableA = $resA->viewData('availableMonths');

        // Oldest available month must be 2025-06
        $oldestA = end($availableA);
        $this->assertEquals('2025-06', $oldestA['key']);
        $this->assertEquals($currentDate->format('Y-m'), $availableA[0]['key']);

        // May 2025 must NOT appear in HTML
        $resA->assertDontSee('month=2025-05');
        // June 2025 must appear in HTML
        $resA->assertSee('month=2025-06');
        $resA->assertSee('June 2025');

        // User B created in current month
        $userB = User::create([
            'name' => 'Brand New User',
            'email' => 'new_' . uniqid() . '@example.com',
            'password' => bcrypt('password123'),
        ]);

        $resB = $this->actingAs($userB)->get(route('dashboard'));
        $resB->assertOk();
        $availableB = $resB->viewData('availableMonths');

        // Brand new user should have exactly 1 month available (the current month)
        $this->assertCount(1, $availableB);
        $this->assertEquals($currentDate->format('Y-m'), $availableB[0]['key']);
    }

    public function test_future_and_preregistration_months_safely_reset_to_current_month(): void
    {
        $tz = config('app.timezone', 'Asia/Dhaka');
        $currentMonth = \Carbon\Carbon::now($tz)->format('Y-m');

        // User registered in Feb 2026
        $user = User::create([
            'name' => 'Boundary User',
            'email' => 'boundary_' . uniqid() . '@example.com',
            'password' => bcrypt('password123'),
        ]);
        $user->created_at = \Carbon\Carbon::parse('2026-02-10', $tz);
        $user->save();

        // 1. Future Month Request (e.g. 2099-01) -> Safely resets to current month
        $resFuture = $this->actingAs($user)->get(route('dashboard', ['month' => '2099-01']));
        $resFuture->assertOk();
        $this->assertEquals($currentMonth, $resFuture->viewData('selectedMonth'));
        $this->assertTrue($resFuture->viewData('isCurrentMonth'));

        // 2. Pre-registration Month Request (2026-01, before Feb 2026 registration) -> Safely resets to current month
        $resPreReg = $this->actingAs($user)->get(route('dashboard', ['month' => '2026-01']));
        $resPreReg->assertOk();
        $this->assertEquals($currentMonth, $resPreReg->viewData('selectedMonth'));
        $this->assertTrue($resPreReg->viewData('isCurrentMonth'));

        // 3. Malformed / Invalid Month Parameter -> Safely resets to current month
        $resInvalid = $this->actingAs($user)->get(route('dashboard', ['month' => 'invalid-month']));
        $resInvalid->assertOk();
        $this->assertEquals($currentMonth, $resInvalid->viewData('selectedMonth'));
        $this->assertTrue($resInvalid->viewData('isCurrentMonth'));

        // 4. Legitimate allowed month within boundary (e.g. 2026-02) -> Accepted
        $resValid = $this->actingAs($user)->get(route('dashboard', ['month' => '2026-02']));
        $resValid->assertOk();
        $this->assertEquals('2026-02', $resValid->viewData('selectedMonth'));
    }
}
