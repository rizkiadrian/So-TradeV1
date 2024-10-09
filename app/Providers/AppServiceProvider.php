<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Repositories\UserRepository;
use App\Models\User;

use App\Repositories\UserProfileRepository;
use App\Models\UserProfile;

use App\Repositories\UserEmploymentRepository;
use App\Models\UserEmployment;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //

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
