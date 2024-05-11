<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\UserRepository;
use App\Repositories\CountryRepository;
use App\Repositories\ServiceRepository;
use App\Repositories\CompanyRepository;
use App\Services\Services;
use App\Services\CompanyService;
use App\Services\CountryService;
use App\Services\UserService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepository::class, function ($app) {
            return new UserRepository();
        });
        $this->app->bind(CountryRepository::class, function ($app) {
            return new CountryRepository();
        });
        $this->app->bind(CompanyRepository::class, function ($app) {
            return new CompanyRepository();
        });
        $this->app->bind(ServiceRepository::class, function ($app) {
            return new ServiceRepository();
        });
        $this->app->bind(Services::class, function ($app) {
            $companyRepository = $app->make(CompanyRepository::class);
            $serviceRepository = $app->make(ServiceRepository::class);
            return new Services($companyRepository, $serviceRepository);
        });
        $this->app->bind(CompanyService::class, function ($app) {
            $companyRepository = $app->make(CompanyRepository::class);
            return new CompanyService($companyRepository);
        });
        $this->app->bind(CountryService::class, function ($app) {
            $countryRepository = $app->make(CountryRepository::class);
            return new CountryService($countryRepository);
        });
        $this->app->bind(UserService::class, function ($app) {
            $userRepository = $app->make(UserRepository::class);
            $companyService = $app->make(CompanyService::class);
            $countryService = $app->make(CountryService::class);
            return new UserService($userRepository,$companyService,$countryService);
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
