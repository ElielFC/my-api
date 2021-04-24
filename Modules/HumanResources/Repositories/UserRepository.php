<?php

namespace Modules\HumanResources\Repositories;

use App\Repositories\BaseRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Modules\HumanResources\Contracts\UserRepositoryInterface;
use Modules\HumanResources\Entities\User;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{

    public function __construct(User $user)
    {
        parent::__construct($user);
    }

    public function getByFiltersPaginate(array $attributes = [], int $per_page = 20) : LengthAwarePaginator
    {
        return $this->model
            ->when(isset($attributes['name']), function ($query) use ($attributes) {
                return $query->where('name', 'like', "%{$attributes['name']}%");
            })
            ->when(isset($attributes['email']), function ($query) use ($attributes) {
                return $query->where('email', '=', $attributes['email']);
            })
            ->paginate($per_page);
    }
}
