<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Gate;
use Modules\HumanResources\Entities\Permission;
use Modules\HumanResources\Repositories\UsersRepository;

class AuthorizeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        Permission::all(['id', 'alias'])
            ->each(function($permission) {
                Gate::define($permission->alias, function($user) use ($permission) {
                    $user_repository = new UsersRepository($user);
                    return $user_repository->hasPermission($permission->id);
                });
            });
        return $next($request);
    }
}
