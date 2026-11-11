<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Transaction;
use App\Models\User;
use App\Services\ReportService;
use Carbon\CarbonImmutable;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

class ReportServiceTest extends TestCase
{
    use RefreshDatabase;

    private ReportService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new ReportService();
    }

    public function test_monthly_report_calculates_income_expense_and_percentages_correctly(): void
    {
        $user = User::create([
            'name' => 'Report User',
            'email' => 'report_' . uniqid() . '@example.com',
            'password' => bcrypt('password123'),
        ]);

        $incSalary = Category::create([
            'user_id' => $user->id,
            'name' => 'Salary',
            'type' => 'income',
            'color' => '#10B981',
            'is_active' => true,
        ]);

        $expFood = Category::create([
            'user_id' => $user->id,
            'name' => 'Food & Dining',
            'type' => 'expense',
            'color' => '#EF4444',
            'is_active' => true,
        ]);

        $expRent = Category::create([
            'user_id' => $user->id,
            'name' => 'Housing & Rent',
            'type' => 'expense',
            'color' => '#3B82F6',
            'is_active' => true,
        ]);

        // Transactions in Nov 2026
        Transaction::create([
            'user_id' => $user->id,
            'category_id' => $incSalary->id,
            'title' => 'Nov Paycheck',
            'amount' => 50000.00,
            'transaction_date' => '2026-11-01',
            'payment_method' => 'bank_transfer',
        ]);

        Transaction::create([
            'user_id' => $user->id,
            'category_id' => $expFood->id,
            'title' => 'Grocery Trip',
            'amount' => 5000.00,
            'transaction_date' => '2026-11-10',
            'payment_method' => 'card',
        ]);

        // Transaction on the LAST day of the month (Nov 30)
        Transaction::create([
            'user_id' => $user->id,
            'category_id' => $expRent->id,
            'title' => 'Month-End Rent',
            'amount' => 15000.00,
            'transaction_date' => '2026-11-30',
            'payment_method' => 'bank_transfer',
        ]);

        // Transaction in October (must not be included)
        Transaction::create([
            'user_id' => $user->id,
            'category_id' => $expFood->id,
            'title' => 'October Meal',
            'amount' => 9999.00,
            'transaction_date' => '2026-10-31',
            'payment_method' => 'cash',
        ]);

        $report = $this->service->getMonthlyReport($user, CarbonImmutable::parse('2026-11-01'));

        // 1. Summary
        $this->assertEquals(50000.00, $report['summary']['totalIncome']);
        $this->assertEquals(20000.00, $report['summary']['totalExpense']);
        $this->assertEquals(30000.00, $report['summary']['netSavings']);
        $this->assertEquals(60.00, $report['summary']['savingsRate']);

        // 2. Expense Category Breakdown
        $expenseCats = $report['expenseByCategory']->keyBy('category_name');
        $this->assertCount(2, $expenseCats);
        $this->assertEquals(15000.00, $expenseCats['Housing & Rent']->total);
        $this->assertEquals(75.00, $expenseCats['Housing & Rent']->percentage);
        $this->assertEquals(5000.00, $expenseCats['Food & Dining']->total);
        $this->assertEquals(25.00, $expenseCats['Food & Dining']->percentage);

        // 3. Daily Trend
        $trend = $report['trend'];
        $this->assertTrue($trend->count() >= 2);

        // 4. Recent transactions
        $recent = $report['recentTransactions'];
        $this->assertCount(3, $recent);
        $this->assertEquals('Month-End Rent', $recent->first()->title);
    }

    public function test_yearly_report_aggregates_across_entire_year_and_groups_by_month(): void
    {
        $user = User::create([
            'name' => 'Yearly User',
            'email' => 'yearly_' . uniqid() . '@example.com',
            'password' => bcrypt('password123'),
        ]);

        $catInc = Category::create([
            'user_id' => $user->id,
            'name' => 'Consulting',
            'type' => 'income',
            'color' => '#10B981',
            'is_active' => true,
        ]);

        $catExp = Category::create([
            'user_id' => $user->id,
            'name' => 'Software',
            'type' => 'expense',
            'color' => '#8B5CF6',
            'is_active' => true,
        ]);

        // Transactions in Jan, June, and Dec 2026
        Transaction::create([
            'user_id' => $user->id,
            'category_id' => $catInc->id,
            'title' => 'Jan Project',
            'amount' => 20000.00,
            'transaction_date' => '2026-01-15',
            'payment_method' => 'bank_transfer',
        ]);

        Transaction::create([
            'user_id' => $user->id,
            'category_id' => $catExp->id,
            'title' => 'June Tooling',
            'amount' => 4000.00,
            'transaction_date' => '2026-06-20',
            'payment_method' => 'card',
        ]);

        Transaction::create([
            'user_id' => $user->id,
            'category_id' => $catExp->id,
            'title' => 'Dec Server Bill',
            'amount' => 6000.00,
            'transaction_date' => '2026-12-31',
            'payment_method' => 'card',
        ]);

        // Transaction in 2025 (must not be included)
        Transaction::create([
            'user_id' => $user->id,
            'category_id' => $catExp->id,
            'title' => '2025 Archive',
            'amount' => 50000.00,
            'transaction_date' => '2025-12-31',
            'payment_method' => 'cash',
        ]);

        $report = $this->service->getYearlyReport($user, 2026);

        $this->assertEquals(20000.00, $report['summary']['totalIncome']);
        $this->assertEquals(10000.00, $report['summary']['totalExpense']);
        $this->assertEquals(10000.00, $report['summary']['netSavings']);
        $this->assertEquals(50.00, $report['summary']['savingsRate']);

        // Trend is grouped by month
        $trendPeriods = $report['trend']->pluck('period')->toArray();
        $this->assertContains('2026-01', $trendPeriods);
        $this->assertContains('2026-06', $trendPeriods);
        $this->assertContains('2026-12', $trendPeriods);
        $this->assertNotContains('2025-12', $trendPeriods);
    }

    public function test_custom_range_report_dynamic_grouping(): void
    {
        $user = User::create([
            'name' => 'Custom User',
            'email' => 'custom_' . uniqid() . '@example.com',
            'password' => bcrypt('password123'),
        ]);

        $cat = Category::create([
            'user_id' => $user->id,
            'name' => 'General',
            'type' => 'expense',
            'color' => '#64748B',
            'is_active' => true,
        ]);

        Transaction::create([
            'user_id' => $user->id,
            'category_id' => $cat->id,
            'title' => 'Mid Range Bill',
            'amount' => 1250.00,
            'transaction_date' => '2026-04-10',
            'payment_method' => 'cash',
        ]);

        // Range <= 31 days (groups by day)
        $shortReport = $this->service->getCustomReport(
            $user,
            CarbonImmutable::parse('2026-04-01'),
            CarbonImmutable::parse('2026-04-15')
        );
        $this->assertEquals(1250.00, $shortReport['summary']['totalExpense']);
        $this->assertEquals('2026-04-10', $shortReport['trend']->first()->period);

        // Range > 31 days (groups by month)
        $longReport = $this->service->getCustomReport(
            $user,
            CarbonImmutable::parse('2026-01-01'),
            CarbonImmutable::parse('2026-05-31')
        );
        $this->assertEquals(1250.00, $longReport['summary']['totalExpense']);
        $this->assertEquals('2026-04', $longReport['trend']->first()->period);
    }

    public function test_user_isolation_and_soft_deletes_enforcement(): void
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
            'name' => 'User A Inc',
            'type' => 'income',
            'color' => '#10B981',
            'is_active' => true,
        ]);

        $catB = Category::create([
            'user_id' => $userB->id,
            'name' => 'User B Inc',
            'type' => 'income',
            'color' => '#10B981',
            'is_active' => true,
        ]);

        // User A Active
        Transaction::create([
            'user_id' => $userA->id,
            'category_id' => $catA->id,
            'title' => 'User A Valid',
            'amount' => 1000.00,
            'transaction_date' => '2026-11-05',
            'payment_method' => 'cash',
        ]);

        // User A Soft-Deleted (must be excluded)
        $txDeleted = Transaction::create([
            'user_id' => $userA->id,
            'category_id' => $catA->id,
            'title' => 'User A Deleted',
            'amount' => 8888.00,
            'transaction_date' => '2026-11-06',
            'payment_method' => 'cash',
        ]);
        $txDeleted->delete();

        // User B Active (must be isolated)
        Transaction::create([
            'user_id' => $userB->id,
            'category_id' => $catB->id,
            'title' => 'User B Private',
            'amount' => 5000.00,
            'transaction_date' => '2026-11-05',
            'payment_method' => 'cash',
        ]);

        $reportA = $this->service->getMonthlyReport($userA, CarbonImmutable::parse('2026-11-01'));
        $this->assertEquals(1000.00, $reportA['summary']['totalIncome']);
        $this->assertCount(1, $reportA['recentTransactions']);
        $this->assertEquals('User A Valid', $reportA['recentTransactions']->first()->title);
    }

    public function test_report_controller_endpoint_authentication_and_filtering(): void
    {
        // 1. Guest redirected to login
        $this->get(route('reports.index'))->assertRedirect(route('login'));

        $user = User::create([
            'name' => 'Endpoint User',
            'email' => 'endpoint_' . uniqid() . '@example.com',
            'password' => bcrypt('password123'),
        ]);

        // 2. Default monthly report (current month)
        $resDefault = $this->actingAs($user)->getJson(route('reports.index'));
        $resDefault->assertOk();
        $this->assertEquals('monthly', $resDefault->json('reportType'));
        $this->assertNotNull($resDefault->json('selectedMonth'));
        $this->assertNotNull($resDefault->json('report.summary'));

        // 3. Yearly report
        $resYearly = $this->actingAs($user)->getJson(route('reports.index', [
            'type' => 'yearly',
            'year' => 2026,
        ]));
        $resYearly->assertOk();
        $this->assertEquals('yearly', $resYearly->json('reportType'));
        $this->assertEquals(2026, $resYearly->json('selectedYear'));

        // 4. Custom range report
        $resCustom = $this->actingAs($user)->getJson(route('reports.index', [
            'type' => 'custom',
            'start_date' => '2026-03-01',
            'end_date' => '2026-03-31',
        ]));
        $resCustom->assertOk();
        $this->assertEquals('custom', $resCustom->json('reportType'));
        $this->assertEquals('2026-03-01', $resCustom->json('startDate'));
        $this->assertEquals('2026-03-31', $resCustom->json('endDate'));

        // 5. Invalid custom range (start_date > end_date) triggers 422
        $resInvalid = $this->actingAs($user)->getJson(route('reports.index', [
            'type' => 'custom',
            'start_date' => '2026-04-10',
            'end_date' => '2026-04-01',
        ]));
        $resInvalid->assertStatus(422);
        $resInvalid->assertJsonValidationErrors(['end_date']);
    }

    public function test_reports_view_renders_successfully_for_monthly_report(): void
    {
        $user = User::create([
            'name' => 'View User',
            'email' => 'view_' . uniqid() . '@example.com',
            'password' => bcrypt('password123'),
        ]);

        $incomeCat = Category::create([
            'user_id' => $user->id,
            'name' => 'Salary',
            'type' => 'income',
            'color' => '#10B981',
            'is_active' => true,
        ]);

        $expenseCat = Category::create([
            'user_id' => $user->id,
            'name' => 'Food',
            'type' => 'expense',
            'color' => '#EF4444',
            'is_active' => true,
        ]);

        Transaction::create([
            'user_id' => $user->id,
            'category_id' => $incomeCat->id,
            'title' => 'Monthly Salary',
            'amount' => 75000.00,
            'transaction_date' => '2026-11-05',
            'payment_method' => 'bank_transfer',
        ]);

        Transaction::create([
            'user_id' => $user->id,
            'category_id' => $expenseCat->id,
            'title' => 'Groceries',
            'amount' => 12500.00,
            'transaction_date' => '2026-11-12',
            'payment_method' => 'card',
        ]);

        $response = $this->actingAs($user)->get(route('reports.index', [
            'type' => 'monthly',
            'month' => '2026-11',
        ]));

        $response->assertOk();
        $response->assertViewIs('reports.index');
        $response->assertSee('Financial Reports');
        $response->assertSee('Total Income');
        $response->assertSee('Total Expense');
        $response->assertSee('Net Savings');
        $response->assertSee('Savings Rate');
        $response->assertSee('Income vs Expense');
        $response->assertSee('Expense by Category');
        $response->assertSee('Income by Category');
        $response->assertSee('Budget vs Actual');
        $response->assertSee('Recent Transactions');
        $response->assertSee('Monthly Salary');
        $response->assertSee('Groceries');
    }

    public function test_reports_view_renders_successfully_for_yearly_and_custom_reports(): void
    {
        $user = User::create([
            'name' => 'Yearly User',
            'email' => 'yearly_' . uniqid() . '@example.com',
            'password' => bcrypt('password123'),
        ]);

        // Yearly report HTML
        $responseYearly = $this->actingAs($user)->get(route('reports.index', [
            'type' => 'yearly',
            'year' => 2026,
        ]));
        $responseYearly->assertOk();
        $responseYearly->assertViewIs('reports.index');
        $responseYearly->assertSee('Financial Reports');

        // Custom range report HTML
        $responseCustom = $this->actingAs($user)->get(route('reports.index', [
            'type' => 'custom',
            'start_date' => '2026-01-01',
            'end_date' => '2026-06-30',
        ]));
        $responseCustom->assertOk();
        $responseCustom->assertViewIs('reports.index');
        $responseCustom->assertSee('Financial Reports');
    }

    public function test_reports_view_handles_empty_dataset_gracefully(): void
    {
        $user = User::create([
            'name' => 'Empty User',
            'email' => 'empty_' . uniqid() . '@example.com',
            'password' => bcrypt('password123'),
        ]);

        $response = $this->actingAs($user)->get(route('reports.index'));

        $response->assertOk();
        $response->assertViewIs('reports.index');
        $response->assertSee('No timeline trend data recorded for this period.');
        $response->assertSee('No expense transactions recorded in this period.');
        $response->assertSee('No transactions recorded for this period.');
    }
}

