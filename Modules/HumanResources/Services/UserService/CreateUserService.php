<?php

namespace Modules\HumanResources\Services\UserService;

use Modules\HumanResources\Contracts\UserRepositoryInterface;

class CreateUserService
{
    protected $user_repository;

    public function __construct(UserRepositoryInterface $user_repository)
    {
        $this->user_repository = $user_repository;
    }

    /**
     * Cria um novo registro de usuário
     * @param array $attributes
     * @return \Modules\HumanResources\Entities\User
     */
    public function execute(array $attributes)
    {
        if($attributes['control_permissions_by'] === 'I') {
            $attributes['role_id'] = null;
        }

        $user = $this->user_repository->create($attributes);

        if (!empty($attributes['permissions'])) {
            $this->setPermissions($user, $attributes['permissions']);
        }

        return $user;
    }

    private function setPermissions($user, array $permissions)
    {
        if ($user->control_permissions_by === 'I') {
            return $user->permissions()->sync($permissions);
        }

        return $user->role->permissions()->sync($permissions);
    }
}
