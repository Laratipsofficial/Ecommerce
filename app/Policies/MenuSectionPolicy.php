<?php

namespace App\Policies;

use App\Models\Menu\MenuSection;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MenuSectionPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {

    }

    public function view(User $user, MenuSection $menuSection)
    {
    }

    public function create(User $user)
    {
    }

    public function update(User $user, MenuSection $menuSection)
    {
    }

    public function delete(User $user, MenuSection $menuSection)
    {
    }

    public function restore(User $user, MenuSection $menuSection)
    {
    }

    public function forceDelete(User $user, MenuSection $menuSection)
    {
    }
}
