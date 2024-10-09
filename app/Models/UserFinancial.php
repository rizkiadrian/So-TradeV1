<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserFinancial extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'income_level',
        'household_size',
        'monthly_expenses',
        'savings_amount',
    ];

    /**
     * Get the user that owns the UserFinance
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
