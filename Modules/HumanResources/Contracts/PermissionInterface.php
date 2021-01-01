<?php

namespace Modules\HumanResources\Contracts;


interface PermissionInterface
{
    public function all(array $column = ['*']) : object;
}
