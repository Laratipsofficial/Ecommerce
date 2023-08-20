<?php

namespace App\Policies;

use App\Models\Tables\Table;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TablePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {

    }

    public function view(User $user, Table $table)
    {
    }

    public function create(User $user)
    {
    }

    public function update(User $user, Table $table)
    {
    }

    public function delete(User $user, Table $table)
    {
    }

    public function restore(User $user, Table $table)
    {
    }

    public function forceDelete(User $user, Table $table)
    {
    }
}
