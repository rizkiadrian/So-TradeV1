<?php

namespace App\Repositories;

use App\Models\UserIssue;
use Illuminate\Support\Facades\Auth;

class UserFinancialIssueRepository {
    protected $model;

    
    /**
     * Dependency injection via constructor.
     * 
     * @param UserIssue $model The user issue model that will be used to interact with the database.
     */
    public function __construct(UserIssue $model)
    {
        $this->model = $model;
    }
    
    

    
    /**
     * Create a new user financial issue.
     * 
     * This method creates a new user financial issue if one does not already exist for the currently authenticated user.
     * 
     * @param object $data Data to use for creating the user financial issue. At least 'current_financial_issues' must be present.
     * 
     * @return UserIssue
     */
    public function create($data): UserIssue {
        $userId = Auth::user()->id;
        
        return $this->model->create(
            [
            'user_id' => $userId,
            'current_financial_issues' => $data->current_financial_issues ?? null
            ]);
    }

}