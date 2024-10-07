<?php

namespace App\Policies;

use App\Models\Area;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AreaPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->company !== null;
    }

    public function view(User $user, Area $area)
    {
        return $user->company_id === $area->company_id;
    }

    public function create(User $user)
    {
        return $user->company !== null;
    }

    public function update(User $user, Area $area)
    {
        return $user->company_id === $area->company_id;
    }

    public function delete(User $user, Area $area)
    {
        return $user->company_id === $area->company_id;
    }
}