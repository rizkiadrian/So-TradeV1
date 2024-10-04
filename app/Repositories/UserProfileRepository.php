<?php

namespace App\Repositories;

use App\Models\UserProfile;
use Illuminate\Support\Facades\Auth;

class UserProfileRepository {
    
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
        
        return UserProfile::firstOrCreate(
            ['user_id' => $userId],
            [
            'first_name' => $data->first_name,
            'last_name' => $data->last_name,
            'phone_number' => $data->phone_number ?? null,
            'date_of_birth' => $data->date_of_birth ?? null,
            'address' => $data->address
        ]);
    }


}