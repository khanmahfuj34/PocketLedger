<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Scopes\ActiveCategoryScope;

class Transaction extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'amount',
        'transaction_date',
        'payment_method',
        'note',
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
            'transaction_date' => 'date',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class)->withoutGlobalScope(ActiveCategoryScope::class);
    }

    public function attachments(): HasMany
    {
        return $this->hasMany(Attachment::class);
    }
    public function scopeHighAmount(Builder $query): void
    {
        $query->where('amount', '>', 1000);
    }
    public function scopeRecent(Builder $query): void
    {
        $query->where(
            'transaction_date',
            '>=',
            now()->subDays(30)->toDateString()
        );
    }
}