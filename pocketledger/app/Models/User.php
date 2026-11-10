<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function categories(): HasMany
    {
        return $this->hasMany(Category::class);
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    public function budgets(): HasMany
    {
        return $this->hasMany(Budget::class);
    }

    public function settings(): HasOne
    {
        return $this->hasOne(Setting::class);
    }

    public function attachments(): HasMany
    {
        return $this->hasMany(Attachment::class);
    }

    /**
     * Default categories seeded for each user.
     *
     * @return array<int, array{name: string, type: string, icon: string, color: string}>
     */
    public static function defaultCategories(): array
    {
        return [
            // Expense Categories
            ['name' => 'Food & Dining', 'type' => 'expense', 'icon' => 'utensils', 'color' => '#EF4444'],
            ['name' => 'Transportation', 'type' => 'expense', 'icon' => 'car', 'color' => '#F59E0B'],
            ['name' => 'Shopping', 'type' => 'expense', 'icon' => 'shopping-bag', 'color' => '#EC4899'],
            ['name' => 'Bills & Utilities', 'type' => 'expense', 'icon' => 'zap', 'color' => '#3B82F6'],
            ['name' => 'Entertainment', 'type' => 'expense', 'icon' => 'film', 'color' => '#8B5CF6'],
            ['name' => 'Health & Medical', 'type' => 'expense', 'icon' => 'heart-pulse', 'color' => '#10B981'],
            ['name' => 'Education', 'type' => 'expense', 'icon' => 'book-open', 'color' => '#6366F1'],
            ['name' => 'Housing & Rent', 'type' => 'expense', 'icon' => 'home', 'color' => '#0EA5E9'],
            ['name' => 'Other Expense', 'type' => 'expense', 'icon' => 'more-horizontal', 'color' => '#64748B'],

            // Income Categories
            ['name' => 'Salary', 'type' => 'income', 'icon' => 'briefcase', 'color' => '#10B981'],
            ['name' => 'Freelance / Gig', 'type' => 'income', 'icon' => 'laptop', 'color' => '#06B6D4'],
            ['name' => 'Business', 'type' => 'income', 'icon' => 'store', 'color' => '#3B82F6'],
            ['name' => 'Investments & Returns', 'type' => 'income', 'icon' => 'trending-up', 'color' => '#8B5CF6'],
            ['name' => 'Gifts & Allowance', 'type' => 'income', 'icon' => 'gift', 'color' => '#F59E0B'],
            ['name' => 'Other Income', 'type' => 'income', 'icon' => 'dollar-sign', 'color' => '#64748B'],
        ];
    }

    /**
     * Seed default categories for this user if not already present.
     */
    public function createDefaultCategories(): void
    {
        foreach (self::defaultCategories() as $category) {
            $this->categories()->firstOrCreate(
                [
                    'type' => $category['type'],
                    'name' => $category['name'],
                ],
                [
                    'icon' => $category['icon'],
                    'color' => $category['color'],
                    'is_active' => true,
                ]
            );
        }
    }
}