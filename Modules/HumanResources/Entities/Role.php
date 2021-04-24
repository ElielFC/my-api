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

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'role_permission', 'role_id', 'permission_id');
    }
}
