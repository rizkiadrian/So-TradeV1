<?php

namespace App\Repositories;

use App\Models\UserGoal;
use Illuminate\Support\Facades\Auth;

class UserGoalRepository {
    protected $model;

    
    /**
     * Dependency injection via constructor.
     * 
     * @param UserGoal $model The user goal model that will be used to interact with the database.
     */
    public function __construct(UserGoal $model)
    {
        $this->model = $model;
    }
    
    
    public function create($data): UserGoal {
        $userId = Auth::user()->id;
        
        return $this->model->firstOrCreate(
            ['user_id' => $userId],
            [
            'financial_goals' => $data->financial_goals
        ]);
    }

}