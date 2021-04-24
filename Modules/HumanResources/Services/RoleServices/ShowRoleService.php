<?php

namespace Modules\HumanResources\Services\RoleServices;

use Modules\HumanResources\Contracts\RoleInterface;

class ShowRoleService
{
    protected $role_repository;

    public function __construct(RoleInterface $role_repository)
    {
        $this->role_repository = $role_repository;
    }

    public function execute(int $id)
    {
        return $this->role_repository->getById($id);
    }
}
