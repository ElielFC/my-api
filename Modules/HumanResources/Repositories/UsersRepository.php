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
        return $this->_users->create($data);
    }

    public function update(array $data, int $id) : object
    {
        $user = $this->_users->findOrFail($id);
        return tap($user)->update($data);
    }

    public function destroy(int $id) : bool
    {
        $user = $this->_users->findOrFail($id);
        return $user->delete();
    }
}
