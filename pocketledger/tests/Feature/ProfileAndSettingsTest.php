<?php

namespace Tests\Feature;

use App\Models\Attachment;
use App\Models\Budget;
use App\Models\Category;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ProfileAndSettingsTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_access_profile_or_settings(): void
    {
        $this->get(route('profile.edit'))->assertRedirect(route('login'));
        $this->get(route('settings.index'))->assertRedirect(route('login'));
    }

    public function test_profile_page_renders_with_user_details_and_dropdown(): void
    {
        $user = User::create([
            'name' => 'Jane Ledger',
            'email' => 'jane_' . uniqid() . '@example.com',
            'password' => Hash::make('secret1234'),
        ]);

        $response = $this->actingAs($user)->get(route('profile.edit'));

        $response->assertOk();
        $response->assertViewIs('profile.edit');
        $response->assertSee('My Profile');
        $response->assertSee('Jane Ledger');
        $response->assertSee($user->email);
        $response->assertSee('profileDropdownButton');
        $response->assertSee('Theme Mode');
    }

    public function test_user_can_update_profile_information(): void
    {
        $user = User::create([
            'name' => 'Original Name',
            'email' => 'orig_' . uniqid() . '@example.com',
            'password' => Hash::make('secret1234'),
        ]);

        $newEmail = 'updated_' . uniqid() . '@example.com';

        $response = $this->actingAs($user)->put(route('profile.update'), [
            'name' => 'Updated Name',
            'email' => $newEmail,
        ]);

        $response->assertRedirect(route('profile.edit'));
        $response->assertSessionHas('success');

        $user->refresh();
        $this->assertEquals('Updated Name', $user->name);
        $this->assertEquals($newEmail, $user->email);
    }

    public function test_profile_update_validates_unique_email(): void
    {
        $existing = User::create([
            'name' => 'Existing User',
            'email' => 'existing_' . uniqid() . '@example.com',
            'password' => Hash::make('secret1234'),
        ]);

        $user = User::create([
            'name' => 'Another User',
            'email' => 'another_' . uniqid() . '@example.com',
            'password' => Hash::make('secret1234'),
        ]);

        $response = $this->actingAs($user)->put(route('profile.update'), [
            'name' => 'Changed Name',
            'email' => $existing->email,
        ]);

        $response->assertSessionHasErrors(['email']);
        $user->refresh();
        $this->assertEquals('Another User', $user->name);
    }

    public function test_user_can_update_password_with_correct_current_password(): void
    {
        $user = User::create([
            'name' => 'Pass User',
            'email' => 'pass_' . uniqid() . '@example.com',
            'password' => Hash::make('old-password-123'),
        ]);

        $response = $this->actingAs($user)->put(route('profile.password'), [
            'current_password' => 'old-password-123',
            'password' => 'new-secure-password-456',
            'password_confirmation' => 'new-secure-password-456',
        ]);

        $response->assertRedirect(route('profile.edit'));
        $response->assertSessionHas('success');

        $user->refresh();
        $this->assertTrue(Hash::check('new-secure-password-456', $user->password));
    }

    public function test_user_cannot_update_password_with_wrong_current_password(): void
    {
        $user = User::create([
            'name' => 'Wrong Pass User',
            'email' => 'wrongpass_' . uniqid() . '@example.com',
            'password' => Hash::make('correct-password-123'),
        ]);

        $response = $this->actingAs($user)->put(route('profile.password'), [
            'current_password' => 'incorrect-current-pass',
            'password' => 'new-secure-password-456',
            'password_confirmation' => 'new-secure-password-456',
        ]);

        $response->assertSessionHasErrors(['current_password']);
        $user->refresh();
        $this->assertTrue(Hash::check('correct-password-123', $user->password));
    }

    public function test_settings_page_renders_with_data_footprint_and_danger_zone(): void
    {
        $user = User::create([
            'name' => 'Settings User',
            'email' => 'settings_' . uniqid() . '@example.com',
            'password' => Hash::make('secret1234'),
        ]);

        $response = $this->actingAs($user)->get(route('settings.index'));

        $response->assertOk();
        $response->assertViewIs('settings.index');
        $response->assertSee('Settings');
        $response->assertSee('Danger Zone — Clear All My Data');
        $response->assertSee('Confirm Data Purge');
        $response->assertSee('CLEAR');
    }

    public function test_clear_data_deletes_only_authenticated_user_financial_records(): void
    {
        Storage::fake('public');

        // User A (Victim of wipe)
        $userA = User::create([
            'name' => 'User A',
            'email' => 'usera_' . uniqid() . '@example.com',
            'password' => Hash::make('my-password-123'),
        ]);

        $catA = Category::create([
            'user_id' => $userA->id,
            'name' => 'Food A',
            'type' => 'expense',
            'color' => '#EF4444',
            'is_active' => true,
        ]);

        $txA1 = Transaction::create([
            'user_id' => $userA->id,
            'category_id' => $catA->id,
            'title' => 'Lunch A',
            'amount' => 500.00,
            'transaction_date' => '2026-11-01',
            'payment_method' => 'cash',
        ]);

        $txA2 = Transaction::create([
            'user_id' => $userA->id,
            'category_id' => $catA->id,
            'title' => 'Soft Deleted Dinner A',
            'amount' => 1200.00,
            'transaction_date' => '2026-11-02',
            'payment_method' => 'card',
        ]);
        $txA2->delete(); // soft delete

        // Attachment for User A
        Storage::disk('public')->put('receipts/tx_a.jpg', 'fake-image-bytes');
        Attachment::create([
            'user_id' => $userA->id,
            'transaction_id' => $txA1->id,
            'storage_disk' => 'public',
            'file_path' => 'receipts/tx_a.jpg',
            'original_name' => 'receipt.jpg',
            'mime_type' => 'image/jpeg',
            'size_bytes' => 1024,
        ]);

        // Budget for User A
        Budget::create([
            'user_id' => $userA->id,
            'category_id' => $catA->id,
            'budget_month' => '2026-11-01',
            'amount' => 10000.00,
        ]);

        // User B (Other user whose data MUST NOT be touched)
        $userB = User::create([
            'name' => 'User B',
            'email' => 'userb_' . uniqid() . '@example.com',
            'password' => Hash::make('userb-password'),
        ]);

        $catB = Category::create([
            'user_id' => $userB->id,
            'name' => 'Food B',
            'type' => 'expense',
            'color' => '#10B981',
            'is_active' => true,
        ]);

        $txB = Transaction::create([
            'user_id' => $userB->id,
            'category_id' => $catB->id,
            'title' => 'Important Transaction B',
            'amount' => 9999.00,
            'transaction_date' => '2026-11-05',
            'payment_method' => 'bank_transfer',
        ]);

        Budget::create([
            'user_id' => $userB->id,
            'category_id' => $catB->id,
            'budget_month' => '2026-11-01',
            'amount' => 50000.00,
        ]);

        // Submit Clear Data request as User A
        $response = $this->actingAs($userA)->post(route('settings.clear-data'), [
            'password' => 'my-password-123',
            'confirmation' => 'CLEAR',
        ]);

        $response->assertRedirect(route('settings.index'));
        $response->assertSessionHas('success');

        // Verify User A financial data is completely wiped
        $this->assertEquals(0, $userA->transactions()->withTrashed()->count());
        $this->assertEquals(0, $userA->budgets()->count());
        $this->assertEquals(0, $userA->attachments()->count());
        Storage::disk('public')->assertMissing('receipts/tx_a.jpg');

        // Verify User A account STILL EXISTS
        $this->assertDatabaseHas('users', ['id' => $userA->id]);

        // Verify User B data is COMPLETELY INTACT
        $this->assertEquals(1, $userB->transactions()->count());
        $this->assertEquals(1, $userB->budgets()->count());
        $this->assertDatabaseHas('transactions', ['id' => $txB->id, 'user_id' => $userB->id]);
    }

    public function test_clear_data_fails_with_invalid_password_or_confirmation(): void
    {
        $user = User::create([
            'name' => 'Guard User',
            'email' => 'guard_' . uniqid() . '@example.com',
            'password' => Hash::make('correct-pass-123'),
        ]);

        $cat = Category::create([
            'user_id' => $user->id,
            'name' => 'Salary',
            'type' => 'income',
            'color' => '#10B981',
            'is_active' => true,
        ]);

        $tx = Transaction::create([
            'user_id' => $user->id,
            'category_id' => $cat->id,
            'title' => 'Salary Nov',
            'amount' => 60000.00,
            'transaction_date' => '2026-11-01',
            'payment_method' => 'bank_transfer',
        ]);

        // 1. Wrong confirmation string
        $resWrongConfirm = $this->actingAs($user)->post(route('settings.clear-data'), [
            'password' => 'correct-pass-123',
            'confirmation' => 'clear', // lowercase should fail
        ]);
        $resWrongConfirm->assertSessionHasErrors(['confirmation']);
        $this->assertEquals(1, $user->transactions()->count());

        // 2. Wrong password
        $resWrongPass = $this->actingAs($user)->post(route('settings.clear-data'), [
            'password' => 'wrong-pass-999',
            'confirmation' => 'CLEAR',
        ]);
        $resWrongPass->assertSessionHasErrors(['password']);
        $this->assertEquals(1, $user->transactions()->count());
    }
}
