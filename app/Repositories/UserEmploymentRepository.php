<?php

namespace App\Repositories;

use App\Models\UserEmployment;
use Illuminate\Support\Facades\Auth;

class UserEmploymentRepository {
    protected $model;

    
    /**
     * Dependency injection via constructor.
     * 
     * @param UserEmployment $model The user employment model that will be used to interact with the database.
     */
    public function __construct(UserEmployment $model)
    {
        $this->model = $model;
    }
    
    
    /**
     * Create a new user employment.
     * 
     * This method creates a new user employment if one does not already exist for the currently authenticated user.
     * 
     * @param object $data Data to use for creating the user employment. At least 'employment_status' must be present.
     * 
     * @return UserEmployment
     */
    public function create($data): UserEmployment {
        $userId = Auth::user()->id;
        
        return $this->model->firstOrCreate(
            ['user_id' => $userId],
            [
            'employment_status' => $data->employment_status
        ]);
    }

}