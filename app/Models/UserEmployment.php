<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\ValidationException;

class UserEmployment extends Model
{
    use HasFactory;

    protected $table = 'user_employment';

    protected $fillable = [
        'user_id',
        'employment_status',
    ];

    const EMPLOYMENT_STATUSES = [
        'employed',
        'unemployed',
        'self-employed',
        'freelancer',
        'retired',
    ];

    /**
     * Validates that the given employment status is one of the allowed statuses.
     * 
     * @param string $status The employment status to validate.
     * 
     * @throws ValidationException If the given employment status is not one of the allowed statuses.
     */
    public static function validateEmploymentStatus($status)
    {
        if (!in_array($status, self::EMPLOYMENT_STATUSES)) {
            throw new ValidationException("Invalid employment status: $status");
        }
    }

    /**
     * The user that this employment belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
