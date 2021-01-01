<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Gate;
use Modules\HumanResources\Contracts\PermissionInterface;
use Modules\HumanResources\Repositories\UsersRepository;

class AuthorizeMiddleware
{
    private $_permissions;

    public function __construct(PermissionInterface $permissions)
    {
        $this->_permissions = $permissions;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $this->_permissions->all()
            ->each(function($permission) {
                Gate::define($permission->alias, function($user) use ($permission) {

                    if (App::runningInConsole()) {
                        return true;
                    }

                    $user_repository = new UsersRepository($user);
                    return $user_repository->hasPermission($permission->id);
                });
            });
        return $next($request);
    }
}
