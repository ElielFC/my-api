<?php

namespace Modules\HumanResources\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;
use Modules\HumanResources\Contracts\{
    UserInterface,
    RoleInterface
};
use Modules\HumanResources\Entities\User;
use Modules\HumanResources\Observers\UserObserver;
use Modules\HumanResources\Repositories\{
    RolesRepository,
    UsersRepository
};

class HumanResourcesServiceProvider extends ServiceProvider
{
    /**
     * @var string $moduleName
     */
    protected $moduleName = 'HumanResources';

    /**
     * @var string $moduleNameLower
     */
    protected $moduleNameLower = 'humanresources';

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerConfig();
        $this->registerFactories();
        $this->registerObservers();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
        $this->app->bind(UserInterface::class, UsersRepository::class);
        $this->app->bind(RoleInterface::class, RolesRepository::class);
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            module_path($this->moduleName, 'Config/config.php') => config_path($this->moduleNameLower . '.php'),
        ], 'config');
        $this->mergeConfigFrom(
            module_path($this->moduleName, 'Config/config.php'), $this->moduleNameLower
        );
    }

    /**
     * Register an additional directory of factories.
     *
     * @return void
     */
    public function registerFactories()
    {
        if (! app()->environment('production') && $this->app->runningInConsole()) {
            app(Factory::class)->load(module_path($this->moduleName, 'Database/factories'));
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
    /**
     * Get the services observers by the provider.
     *
     * @return array
     */
    public function registerObservers()
    {
        User::observe(UserObserver::class);
    }
}
