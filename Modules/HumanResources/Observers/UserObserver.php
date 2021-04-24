<?php

namespace Modules\HumanResources\Observers;

use Modules\HumanResources\Entities\User;

class UserObserver
{
    public function creating(User $data)
    {
        if (!empty($data->password)) {
            $data->password = bcrypt($data->password);
        }
    }

    public function updating(User $data)
    {
        if (!empty($data->password)) {
            $data->password = bcrypt($data->password);
        }
    }
}
