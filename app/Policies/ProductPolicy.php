<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
{
    use HandlesAuthorization;

    public function update(User $user, Product $product)
    {
        if ($user->id != $product->creator_id) {
            return false;
        }

        if ($user->can('edit product')) {
            return true;
        }
    }

    public function delete(User $user, Product $product)
    {
        if ($user->id != $product->creator_id) {
            return false;
        }

        if ($user->can('delete product')) {
            return true;
        }
    }
}
