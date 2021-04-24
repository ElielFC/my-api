<?php

namespace Modules\HumanResources\Services\RoleServices;

use Modules\HumanResources\Contracts\RoleInterface;

class ListRolesService
{
    protected $role_repository;

    public function __construct(RoleInterface $role_repository)
    {
        $this->role_repository = $role_repository;
    }

    public function execute(array $attributes)
    {
        return $this->role_repository->getByFiltersPaginate($attributes);
    }
}
