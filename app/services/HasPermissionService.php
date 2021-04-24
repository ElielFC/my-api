<?php

namespace App\Services;

use Illuminate\Contracts\Auth\Authenticatable;

class HasPermissionService
{
    public function execute(Authenticatable $user, int $permission_id)
    {
        if ($user->control_permissions_by === 'I') {
            return $this->existsIndividualPermission($user, $permission_id);
        }

        return $this->existsGroupPermission($user, $permission_id);
    }

    private function existsIndividualPermission(Authenticatable $user, int $permission_id): bool
    {
        return $user->permissions()->where('id', $permission_id)->exists();
    }

    private function existsGroupPermission(Authenticatable $user, int $permission_id): bool
    {
        return $user->role->permissions()->where('id', $permission_id)->exists();
    }
}
