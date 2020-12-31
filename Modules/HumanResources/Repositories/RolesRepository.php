<?php

namespace Modules\HumanResources\Repositories;

use Modules\HumanResources\Contracts\RoleInterface;
use Modules\HumanResources\Entities\Role;

class RolesRepository implements RoleInterface
{
    private $_role;

    public function __construct(Role $role)
    {
        $this->_role = $role;
    }

    public function filter(array $conditions, int $limit = 20) : array
    {
        return $this->_role
            ->when(isset($conditions['name']), function ($query) use ($conditions) {
                return $query->where('name', 'like', "%{$conditions['name']}%");
            })
            ->when(isset($conditions['status']), function ($query) use ($conditions) {
                return $query->where('status', '=', $conditions['status']);
            })
            ->paginate($limit);
    }

    public function getById(int $id) : object
    {
        return $this->_role->findOrFail($id);
    }

    public function store(array $data) : object
    {
        return $this->_role->create($data);
    }

    public function update(array $data, int $id) : object
    {
        $role = $this->_role->findOrFail($id);
        return tap($role)->update($data);
    }

    public function destroy(int $id) : bool
    {
        $role = $this->_role->findOrFail($id);
        return $role->delete();
    }
}
