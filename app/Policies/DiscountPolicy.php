<?php

namespace App\Policies;

use App\Models\Discount\Discount;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DiscountPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {

    }

    public function view(User $user, Discount $discount)
    {
    }

    public function create(User $user)
    {
    }

    public function update(User $user, Discount $discount)
    {
    }

    public function delete(User $user, Discount $discount)
    {
    }

    public function restore(User $user, Discount $discount)
    {
    }

    public function forceDelete(User $user, Discount $discount)
    {
    }
}
