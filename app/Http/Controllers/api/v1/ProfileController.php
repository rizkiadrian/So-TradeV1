<?php

namespace App\Http\Controllers\api\v1;

use App\Helpers\TransactionHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UserProfileRequest;

use App\Http\Responses\ApiResponse;
use App\Repositories\UserProfileRepository;

class ProfileController extends Controller
{
    protected $userProfileRepository;

    /**
     * Dependency injection via constructor.
     * 
     * @param UserProfileRepository $userRepository Instance of App\Repositories\UserRepository
     */
    public function __construct(UserProfileRepository $userProfileRepository) 
    {
        $this->userProfileRepository = $userProfileRepository;
    }
    public function index()
    {
        $test = [
            "key" => "value"
        ];
        return ApiResponse::success($test);
    }

    /**
     * Create a new user profile.
     * 
     * This endpoint handles the creation of a new user profile.
     * 
     * @param UserProfileRequest $request Instance of App\Http\Requests\UserProfileRequest
     * 
     * @return JsonResponse
     */
    public function profileCreate(UserProfileRequest $request)
    {
       // Create an object from the validated request data
       $userData = (object) $request->validated(); 

       $result = TransactionHelper::execute(function () use ($userData) {
        // Attempt to create the user
        return $this->userProfileRepository->create($userData);
    });
    // Send welcome email
    if ($result->wasRecentlyCreated) {
        $this->userProfileRepository->sendWelcomeEmail($result);
    }

    return ApiResponse::success($result, 'User Profile created successfully', 201);

    }
}
