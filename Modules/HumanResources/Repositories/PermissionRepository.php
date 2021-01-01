<?php

namespace Modules\HumanResources\Repositories;

use Modules\HumanResources\Contracts\PermissionInterface;
use Modules\HumanResources\Entities\Permission;

class PermissionRepository implements PermissionInterface
{
    private $_permission;

    public function __construct(Permission $permission)
    {
        $this->_permission = $permission;
    }

    public function all(array $column = ['*']) : object
    {
        return $this->_permission->get($column);
    }
}
