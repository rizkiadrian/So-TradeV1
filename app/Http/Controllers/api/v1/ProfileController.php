<?php

namespace App\Http\Controllers\api\v1;

use App\Helpers\TransactionHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserProfileRequest;
use App\Http\Requests\UserEmploymentRequest;

use App\Http\Responses\ApiResponse;
use App\Repositories\UserProfileRepository;
use App\Repositories\UserEmploymentRepository;

class ProfileController extends Controller
{
    protected $userProfileRepository;
    protected $userEmploymentRepository;

    /**
     * Dependency injection via constructor.
     * 
     * @param UserProfileRepository $userRepository Instance of App\Repositories\UserRepository
     */
    public function __construct(
        UserProfileRepository $userProfileRepository,
        UserEmploymentRepository $userEmploymentRepository
        ) 
    {
        $this->userProfileRepository = $userProfileRepository;
        $this->userEmploymentRepository = $userEmploymentRepository;
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

    /**
     * Create a new user employment.
     * 
     * This endpoint handles the creation of a new user employment.
     * 
     * @param UserEmploymentRequest $request Instance of App\Http\Requests\UserEmploymentRequest
     * 
     * @return JsonResponse
     */
    public function employmentCreate(UserEmploymentRequest $request)
    {
        // Create an object from the validated request data
       $employmentData = (object) $request->validated();

       $result = TransactionHelper::execute(function () use ($employmentData) {
        // Attempt to create the user
            return $this->userEmploymentRepository->create($employmentData);
        });
    
        return ApiResponse::success($result, 'User Employment created successfully', 201);

    }
}
