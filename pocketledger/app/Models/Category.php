<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Scopes\ActiveCategoryScope;

class Category extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'type',
        'icon',
        'color',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }
    protected static function booted(): void
    {
        static::addGlobalScope(new ActiveCategoryScope);
    }
    public function budgets(): HasMany
    {
        return $this->hasMany(Budget::class);
    }
}