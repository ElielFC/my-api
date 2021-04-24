<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\HumanResources\Contracts\PermissionRepositoryInterface;
use Modules\HumanResources\Repositories\PermissionRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(PermissionRepositoryInterface::class, PermissionRepository::class);
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
