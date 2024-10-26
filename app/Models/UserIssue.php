<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserIssue extends Model
{
    use HasFactory;

    protected $table = 'user_financial_issues';

    protected $fillable = [
        'user_id',
        'current_financial_issues', // File path for the issues
    ];

    const TYPE_OF_DEBTS = ['Bank', 'Installment', 'Student Loan', 'Other', 'House', 'Vehicle'];
    const STORAGE_SUFFIX = 'fp';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
