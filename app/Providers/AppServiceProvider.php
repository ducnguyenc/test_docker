<?php

namespace App\Providers;

use App\Http\Repositories\LoginRepository;
use App\Http\Repositories\LoginRepositoryInterface;
use App\Http\Repositories\RegisterRepository;
use App\Http\Repositories\RegisterRepositoryInterface;
use App\Http\Services\LoginService;
use App\Http\Services\LoginServiceInterface;
use App\Http\Services\RegisterService;
use App\Http\Services\RegisterServiceInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(RegisterServiceInterface::class, RegisterService::class);
        $this->app->singleton(RegisterRepositoryInterface::class, RegisterRepository::class);

        $this->app->singleton(LoginServiceInterface::class, LoginService::class);
        $this->app->singleton(LoginRepositoryInterface::class, LoginRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
