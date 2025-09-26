<?php

namespace Modules\Expenses\Domain\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Expense extends Model
{
    use HasFactory;

    protected $table = 'expenses';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'title',
        'amount',
        'category',
        'expense_date',
        'notes',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'expense_date' => 'date',
    ];

    protected static function booted(): void
    {
        static::creating(function (self $model) {
            if (!$model->getKey()) {
                $model->setAttribute($model->getKeyName(), (string) Str::uuid());
            }
        });
    }

    /**
     * Map this model to its factory explicitly.
     */
    protected static function newFactory(): \Database\Factories\ExpenseFactory
    {
        return \Database\Factories\ExpenseFactory::new();
    }
}
