<?php

namespace App\Policies;

use App\Models\Menu\MenuItem;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MenuItemPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {

    }

    public function view(User $user, MenuItem $menuItem)
    {
    }

    public function create(User $user)
    {
    }

    public function update(User $user, MenuItem $menuItem)
    {
    }

    public function delete(User $user, MenuItem $menuItem)
    {
    }

    public function restore(User $user, MenuItem $menuItem)
    {
    }

    public function forceDelete(User $user, MenuItem $menuItem)
    {
    }
}
