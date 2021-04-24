<?php

namespace Modules\HumanResources\Services\UserService;

use Modules\HumanResources\Contracts\UserRepositoryInterface;

class UpdateUserService
{
    protected $user_repository;

    public function __construct(UserRepositoryInterface $user_repository)
    {
        $this->user_repository = $user_repository;
    }

    public function execute(int $id, array $attributes)
    {
        return $this->user_repository->update($id, $attributes);
    }
}
