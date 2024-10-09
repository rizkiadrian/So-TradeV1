<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use App\Enums\TokenAbility;

class UserRepository {
    protected $model;

    /**
     * Constructor.
     *
     * @param User $model The user model that will be used to interact with the database.
     */
    public function __construct(User $model)
    {
        $this->model = $model;
    }
    /**
     * Find a user by the given email address.
     *
     * @param string $email
     * @return User
     */
    public function findByEmail(string $email): User {
        return $this->model->where('email', $email)->first();
    }

    /**
     * Create a new user
     *
     * @param  object $data
     * @return User
     */
    public function create($data): User {
        return $this->model->create([
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
        $appname = env('ADMIN_APPNAME');
        $abilities = [TokenAbility::SUPER_ADMIN->value];
        return $user->createToken($appname, $abilities)->plainTextToken;
    }

    /**
     * Create a new personal token for the given user that can access the profile features of the client app.
     *
     * @param  \App\Models\User  $user
     * @return string
     */
    public function createProfileToken(User $user)
    {
        $appname = env('CLIENT_APPNAME');
        $abilities = [TokenAbility::PROFILE_USER->value];
        return $user->createToken($appname, $abilities)->plainTextToken;
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