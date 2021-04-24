<?php

namespace App\Http\Middleware;

use App\Services\HasPermissionService;
use Closure;
use Illuminate\Support\Facades\Gate;
use Modules\HumanResources\Contracts\PermissionRepositoryInterface;

class AuthorizeMiddleware
{
    private $permissions_repository;
    private $has_permission_service;

    public function __construct(
        PermissionRepositoryInterface $permissions_repository,
        HasPermissionService $has_permission_service
    ) {
        $this->permissions_repository = $permissions_repository;
        $this->has_permission_service = $has_permission_service;
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
        $this->permissions_repository->all()
            ->each(function ($permission) {
                Gate::define($permission->alias, function ($user) use ($permission) {
                    return $this->has_permission_service->execute($user, $permission->id);
                });
            });

        return $next($request);
    }
}
