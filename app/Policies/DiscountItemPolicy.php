<?php

namespace App\Policies;

use App\Models\Discount\DiscountItem;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DiscountItemPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {

    }

    public function view(User $user, DiscountItem $discountItem)
    {
    }

    public function create(User $user)
    {
    }

    public function update(User $user, DiscountItem $discountItem)
    {
    }

    public function delete(User $user, DiscountItem $discountItem)
    {
    }

    public function restore(User $user, DiscountItem $discountItem)
    {
    }

    public function forceDelete(User $user, DiscountItem $discountItem)
    {
    }
}
