<?php

namespace Modules\HumanResources\Contracts;


interface RoleInterface
{
    public function filter(array $conditions, int $limit = 20) : array;
    public function getById(int $id) : object;
    public function store(array $data) : object;
    public function update(array $data, int $id) : object;
    public function destroy(int $id) : bool;
}
