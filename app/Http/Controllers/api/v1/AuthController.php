<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Responses\ApiResponse;
use App\Helpers\TransactionHelper;


class AuthController extends Controller
{
    protected $userRepository;

    /**
     * Dependency injection via constructor.
     * 
     * @param UserRepository $userRepository Instance of App\Repositories\UserRepository
     */
    public function __construct(UserRepository $userRepository) 
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Registers a new user with the given request data.
     * 
     * This endpoint handles the registration of a new user.
     * 
     * @param RegisterRequest $request Instance of App\Http\Requests\RegisterRequest
     * 
     * @return JsonResponse
     */
    public function register(RegisterRequest $request) {
        // Create an object from the validated request data
        $userData = (object) $request->validated();

        // Call the transaction helper
        $result = TransactionHelper::execute(function () use ($userData) {
            // Attempt to create the user
            return $this->userRepository->create($userData);
        });

        return ApiResponse::success($result, 'User created successfully', 201);
    }

    /**
     * Logs in an existing user with the given request data.
     * 
     * This endpoint handles the login of an existing user.
     * 
     * @param LoginRequest $request Instance of App\Http\Requests\LoginRequest
     * 
     * @return JsonResponse
     */
    public function login (LoginRequest $request) {
        // Create an object from the validated request data
        $loginData= (object) $request->validated();

        // Attempt to log the user in
        if ($this->userRepository->attemptLogin($request->only('email', 'password'))) {
            $user = $this->userRepository->findByEmail($request->email);
            $token = $this->userRepository->createProfileToken($user); // Specify abilities here
            $collect = [
                "user" => $user,
                "token" => $token
            ];

            return ApiResponse::success($collect, 'User logged in successfully', 200);
        }
        return ApiResponse::fail((object)null, 401, 'Invalid credentials');
    }
}
