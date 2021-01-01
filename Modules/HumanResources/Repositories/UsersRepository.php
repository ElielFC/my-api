<?php

namespace Modules\HumanResources\Repositories;

use Modules\HumanResources\Contracts\UserInterface;
use Modules\HumanResources\Entities\User;

class UsersRepository implements UserInterface
{
    private $_users;

    public function __construct(User $user)
    {
        $this->_users = $user;
    }

    public function filter(array $conditions, int $limit = 20) : array
    {
        return $this->_users
            ->when(isset($conditions['name']), function ($query) use ($conditions) {
                return $query->where('name', 'like', "%{$conditions['name']}%");
            })
            ->when(isset($conditions['email']), function ($query) use ($conditions) {
                return $query->where('email', '=', $conditions['email']);
            })
            ->paginate($limit);
    }

    public function getById(int $id) : object
    {
        return $this->_users->findOrFail($id);
    }

    public function store(array $data) : object
    {
        $user = $this->_users->create($data);

        if (!empty($data['permissions'])) {
            $user->permissions()->sync($data['permissions']);
        }

        return $user;
    }

    public function update(array $data, int $id) : object
    {
        $user = $this->_users->findOrFail($id);
        $user->update($data);

        if (!empty($data['permissions'])) {
            $user->permissions()->sync($data['permissions']);
        }

        return $user;
    }

    public function destroy(int $id) : bool
    {
        $user = $this->_users->findOrFail($id);
        return $user->delete();
    }

    public function hasPermission(int $permission_id): bool
    {
        if ($this->_users->control_permissions_by === 'I') {
            return $this->_users->permissions()->where('id', '=', $permission_id)->exists();
        }

        if ($this->_users->role->status ?? false) {
            return $this->_users->role->permissions()->where('id', '=', $permission_id)->exists();
        }

        return false;
    }
}
