<?php

namespace Modules\HumanResources\Entities;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'name',
        'description',
        'status'
    ];

    protected $cast = [
        'status' => 'boolean',
    ];
}
