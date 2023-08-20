<?php

namespace App\Policies;

use App\Models\Menu\MenuSideItem;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MenuSideItemPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {

    }

    public function view(User $user, MenuSideItem $menuSideItem)
    {
    }

    public function create(User $user)
    {
    }

    public function update(User $user, MenuSideItem $menuSideItem)
    {
    }

    public function delete(User $user, MenuSideItem $menuSideItem)
    {
    }

    public function restore(User $user, MenuSideItem $menuSideItem)
    {
    }

    public function forceDelete(User $user, MenuSideItem $menuSideItem)
    {
    }
}
