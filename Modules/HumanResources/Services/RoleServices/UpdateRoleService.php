<?php

namespace Modules\HumanResources\Services\RoleServices;

use Modules\HumanResources\Contracts\RoleInterface;

class UpdateRoleService
{
    protected $role_repository;

    public function __construct(RoleInterface $role_repository)
    {
        $this->role_repository = $role_repository;
    }

    public function execute(int $id, array $attributes)
    {
        return $this->role_repository->update($id, $attributes);
    }
}
