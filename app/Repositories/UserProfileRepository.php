<?php

namespace App\Repositories;

use App\Models\UserProfile;
use Illuminate\Support\Facades\Auth;

use App\Mail\WelcomeEmail;
use Illuminate\Support\Facades\Mail;

class UserProfileRepository {
    protected $model;

    /**
     * Constructor.
     *
     * @param UserProfile $model The user profile model that will be used to interact with the database.
     */
    public function __construct(UserProfile $model)
    {
        $this->model = $model;
    }
    
    /**
     * Create a new user profile.
     * 
     * This method creates a new user profile if one does not already exist for the currently authenticated user.
     * 
     * @param object $data Data to use for creating the user profile. At least 'first_name' and 'last_name' must be present.
     * 
     * @return UserProfile
     */
    public function create($data): UserProfile {
        $userId = Auth::user()->id;
        
        return $this->model->firstOrCreate(
            ['user_id' => $userId],
            [
            'first_name' => $data->first_name,
            'last_name' => $data->last_name,
            'phone_number' => $data->phone_number ?? null,
            'date_of_birth' => $data->date_of_birth ?? null,
            'address' => $data->address
        ]);
    }

    public function sendWelcomeEmail(UserProfile $userProfile): void
    {
        Mail::to($userProfile->user->email)->queue(new WelcomeEmail($userProfile));
    }


}