<?php

namespace Modules\HumanResources\Contracts;

use App\Contracts\BaseRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface UserRepositoryInterface extends BaseRepositoryInterface
{
    public function getByFiltersPaginate(array $attributes = [], int $limit = 20) : LengthAwarePaginator;
}
