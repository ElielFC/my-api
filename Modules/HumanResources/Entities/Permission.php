<?php

namespace Modules\HumanResources\Entities;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = [
        'name',
        'description',
        'alias'
    ];
}
