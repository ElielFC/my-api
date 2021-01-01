<?php

namespace Modules\HumanResources\Contracts;


interface UserInterface
{
    public function filter(array $conditions, int $limit = 20) : array;
    public function getById(int $id) : object;
    public function store(array $data) : object;
    public function update(array $data, int $id) : object;
    public function destroy(int $id) : bool;
    public function hasPermission(int $permission_id) : bool;
}
