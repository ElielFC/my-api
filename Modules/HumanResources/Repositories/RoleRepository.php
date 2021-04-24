<?php

namespace Modules\HumanResources\Repositories;

use App\Repositories\BaseRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Modules\HumanResources\Contracts\RoleInterface;
use Modules\HumanResources\Entities\Role;

class RoleRepository extends BaseRepository implements RoleInterface
{

    /**
    * RolesRepository constructor.
    *
    * @param Modules\HumanResources\Entities\Role $model
    */
    public function __construct(Role $model)
    {
        parent::__construct($model);
    }

    /**
     * Retorna uma lista paginada de grupos de usuários
     * @param array $attributes
     * @param int $per_page
     * @return Illuminate\Pagination\LengthAwarePaginator model paginada.
     */
    public function getByFiltersPaginate(array $attributes = [], int $per_page = 20) : LengthAwarePaginator
    {
        return $this->model
            ->when(isset($attributes['name']), function ($query) use ($attributes) {
                return $query->where('name', 'like', "%{$attributes['name']}%");
            })
            ->when(isset($attributes['status']), function ($query) use ($attributes) {
                return $query->where('status', '=', $attributes['status']);
            })
            ->paginate($per_page);
    }
}
