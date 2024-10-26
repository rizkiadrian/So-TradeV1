<?php

namespace App\Http\Controllers\api\v1;

use App\Helpers\TransactionHelper;
use App\Helpers\FileHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserProfileRequest;
use App\Http\Requests\UserEmploymentRequest;
use App\Http\Requests\UserFinancialRequest;
use App\Http\Requests\UserGoalRequest;
use App\Http\Requests\UserFinancialIssueRequest;

use App\Http\Responses\ApiResponse;
use App\Repositories\UserProfileRepository;
use App\Repositories\UserEmploymentRepository;
use App\Repositories\UserFinancialRepository;
use App\Repositories\UserGoalRepository;
use App\Repositories\UserFinancialIssueRepository;

use App\Jobs\SaveFPFileJob;

class ProfileController extends Controller
{
    protected $userProfileRepository;
    protected $userEmploymentRepository;
    protected $userFinancialRepository;
    protected $userGoalRepository;
    protected $userFinancialIssueRepository;

    /**
     * Dependency injection via constructor.
     * 
     * @param UserProfileRepository $userRepository Instance of App\Repositories\UserRepository
     */
    public function __construct(
        UserProfileRepository $userProfileRepository,
        UserEmploymentRepository $userEmploymentRepository,
        UserFinancialRepository $userFinancialRepository,
        UserGoalRepository $userGoalRepository,
        UserFinancialIssueRepository $userFinancialIssueRepository
        ) 
    {
        $this->userProfileRepository = $userProfileRepository;
        $this->userEmploymentRepository = $userEmploymentRepository;
        $this->userFinancialRepository = $userFinancialRepository;
        $this->userGoalRepository = $userGoalRepository;
        $this->userFinancialIssueRepository = $userFinancialIssueRepository;
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

    /**
     * Create a new user financial.
     * 
     * This endpoint handles the creation of a new user financial.
     * 
     * @param UserFinancialRequest $request Instance of App\Http\Requests\UserFinancialRequest
     * 
     * @return JsonResponse
     */
    public function financialCreate(UserFinancialRequest $request)
    {
        // Create an object from the validated request data
        $financialData = (object) $request->validated();

        $result = TransactionHelper::execute(function () use ($financialData) {
            // Attempt to create the user
                return $this->userFinancialRepository->create($financialData);
        });

        return ApiResponse::success($result, 'User Financial created successfully', 201);
    }

    /**
     * Create a new user goal.
     * 
     * This endpoint handles the creation of a new user goal.
     * 
     * @param UserGoalRequest $request Instance of App\Http\Requests\UserGoalRequest
     * 
     * @return JsonResponse
     */
    public function goalCreate(UserGoalRequest $request)
    {
        // Create an object from the validated request data
        $goalData = (object) $request->validated();

        $result = TransactionHelper::execute(function () use ($goalData) {
            // Attempt to create the user
                return $this->userGoalRepository->create($goalData);
        });

        return ApiResponse::success($result, 'User Goal created successfully', 201);
    }

    /**
     * Create a new user financial issue.
     * 
     * This endpoint handles the creation of a new user financial issue.
     * 
     * @param UserFinancialRequest $request Instance of App\Http\Requests\UserFinancialRequest
     * 
     * @return JsonResponse
     */
    public function financialIssueCreate(UserFinancialIssueRequest $request)
    {
        $financialIssueData = (object) $request->validated();
        // Generate file metadata for storing financial issue data
        $fileMeta = FileHelper::createFilePath(config('filesuffix.financial_problem'));

        // Dispatch a job to save the financial issue data to a file
        SaveFPFileJob::dispatch($financialIssueData, $fileMeta);

        $result = TransactionHelper::execute(function () use ($fileMeta)
        {
            $transform = (object) [
                "current_financial_issues" => $fileMeta['file_path']
            ];
            return $this->userFinancialIssueRepository->create($transform);
        });
        return ApiResponse::success($result, 'User Financial Issue Created Successfully', 201);

    }
}
