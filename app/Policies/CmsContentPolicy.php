<?php

namespace App\Policies;

use App\Models\Content\CmsContent;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CmsContentPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {

    }

    public function view(User $user, CmsContent $cmsContent)
    {
    }

    public function create(User $user)
    {
    }

    public function update(User $user, CmsContent $cmsContent)
    {
    }

    public function delete(User $user, CmsContent $cmsContent)
    {
    }

    public function restore(User $user, CmsContent $cmsContent)
    {
    }

    public function forceDelete(User $user, CmsContent $cmsContent)
    {
    }
}
