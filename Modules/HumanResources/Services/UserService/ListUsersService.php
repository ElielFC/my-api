<?php

namespace Modules\HumanResources\Services\UserService;

use Modules\HumanResources\Contracts\UserRepositoryInterface;

class ListUsersService
{
    protected $user_repository;

    public function __construct(UserRepositoryInterface $user_repository)
    {
        $this->user_repository = $user_repository;
    }

    public function execute(array $attributes)
    {
        return $this->user_repository->getByFiltersPaginate($attributes);
    }
}
