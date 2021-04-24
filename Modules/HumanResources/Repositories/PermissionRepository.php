<?php

namespace Modules\HumanResources\Repositories;

use App\Repositories\BaseRepository;
use Modules\HumanResources\Contracts\PermissionRepositoryInterface;
use Modules\HumanResources\Entities\Permission;

class PermissionRepository extends BaseRepository implements PermissionRepositoryInterface
{
    public function __construct(Permission $permission)
    {
        parent::__construct($permission);
    }
}
