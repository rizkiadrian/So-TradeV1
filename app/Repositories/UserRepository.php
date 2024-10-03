<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserRepository {
    /**
     * Find a user by the given email address.
     *
     * @param string $email
     * @return User
     */
    public function findByEmail(string $email): User {
        return User::where('email', $email)->first();
    }

    /**
     * Create a new user
     *
     * @param  object $data
     * @return User
     */
    public function create($data): User {
        return User::create([
            'name' => $data->name,
            'email' => $data->email,
            'password' => Hash::make($data->password)
        ]);
    }

    /**
     * Create a new personal super token for the given user.
     *
     * @param  \App\Models\User  $user
     * @param  string  $name
     * @param  array  $abilities
     * @return string
     */
    public function createSuperToken(User $user)
    {
        return $user->createToken('SoTradeV1-Admin', ['*'])->plainTextToken;
    }

    /**
     * Attempt to login a user with the given credentials
     *
     * @param array $credentials
     * @return boolean
     */
    public function attemptLogin(array $credentials)
    {
        return Auth::attempt($credentials);
    }
}