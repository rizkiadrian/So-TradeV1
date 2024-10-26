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
    
    
    /**
     * Create a new user goal.
     * 
     * This method creates a new user goal if one does not already exist for the currently authenticated user.
     * 
     * @param object $data Data to use for creating the user goal. At least 'financial_goals' must be present.
     * 
     * @return UserGoal
     */
    public function create($data): UserGoal {
        $userId = Auth::user()->id;
        
        return $this->model->create(
            [
                'user_id' => $userId,
                'financial_goals' => $data->financial_goals
            ]
        );
    }

}