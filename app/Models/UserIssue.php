<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserIssue extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'current_financial_issues', // File path for the issues
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
