<?php

namespace App\Repositories;

use App\Models\UserFinancial;
use Illuminate\Support\Facades\Auth;

class UserFinancialRepository {
    protected $model;

    
    /**
     * Dependency injection via constructor.
     * 
     * @param UserFinancial $model The user employment model that will be used to interact with the database.
     */
    public function __construct(UserFinancial $model)
    {
        $this->model = $model;
    }
    
    
    
    /**
     * Create a new user financial.
     * 
     * This method creates a new user financial if one does not already exist for the currently authenticated user.
     * 
     * @param object $data Data to use for creating the user financial. At least 'income_level', 'household_size', 'monthly_expenses', and 'savings_amount' must be present.
     * 
     * @return UserFinancial
     */
    public function create($data): UserFinancial {
        $userId = Auth::user()->id;
        
        return $this->model->firstOrCreate(
            ['user_id' => $userId],
            [
            'income_level' => $data->income_level ?? null,
            'household_size' => $data->household_size ?? null,
            'monthly_expenses' => $data->monthly_expenses ?? null,
            'savings_amount' => $data->savings_amount ?? null
        ]);
    }

}