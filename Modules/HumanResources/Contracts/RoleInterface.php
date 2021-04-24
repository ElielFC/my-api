<?php

namespace Modules\HumanResources\Contracts;

use App\Contracts\BaseRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

interface RoleInterface extends BaseRepositoryInterface
{
    /**
     * Retorna uma lista paginada de grupos de usuários
     * @param array $attributes
     * @param int $per_page
     * @return Illuminate\Pagination\LengthAwarePaginator model paginada.
     */
    public function getByFiltersPaginate(array $attributes = [], int $per_page = 20) : LengthAwarePaginator;
}
