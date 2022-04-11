<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\RoleResource;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    public function index(Request $request)
    {
        $roles = Role::select([
            'id',
            'name',
            'created_at',
        ])->latest('id')->paginate(10);

        return Inertia::render('Role/Index', [
            'roles' => RoleResource::collection($roles),
            'headers' => [
                [
                    'label' => 'Name',
                    'name' => 'name',
                ],
                [
                    'label' => 'Created At',
                    'name' => 'created_at',
                ],
                [
                    'label' => 'Actions',
                    'name' => 'actions',
                ],
            ],
        ]);
    }
}
