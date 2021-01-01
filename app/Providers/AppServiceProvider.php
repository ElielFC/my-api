<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\HumanResources\Contracts\PermissionInterface;
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
        $this->app->bind(PermissionInterface::class, PermissionRepository::class);
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
