<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Repositories\UserRepository;
use App\Models\User;

use App\Repositories\UserProfileRepository;
use App\Models\UserProfile;

use App\Repositories\UserEmploymentRepository;
use App\Models\UserEmployment;

use App\Repositories\UserFinancialRepository;
use App\Models\UserFinancial;

use App\Repositories\UserGoalRepository;
use App\Models\UserGoal;

use App\Repositories\UserFinancialIssueRepository;
use App\Models\UserIssue;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Bind UserFinancialIssueRepository
        $this->app->bind(UserFinancialIssueRepository::class, function($app) {
            return new UserFinancialIssueRepository(new UserIssue());
        });
        
        //Bind UserGoalRepository
        $this->app->bind(UserGoalRepository::class, function($app)
        {
            return new UserGoalRepository(new UserGoal());
        });
        
        //Bind UserFinancialRepository
        $this->app->bind(UserFinancialRepository::class, function($app)
        {
            return new UserFinancialRepository(new UserFinancial());
        });

        // Bind UserEmploymentRepository
        $this->app->bind(UserEmploymentRepository::class, function ($app) {
            return new UserEmploymentRepository(new UserEmployment());
        });

        // Bind UserRepository
        $this->app->bind(UserRepository::class, function ($app) {
            return new UserRepository(new User());
        });

        // Bind UserRepository
        $this->app->bind(UserProfileRepository::class, function ($app) {
            return new UserProfileRepository(new UserProfile());
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
