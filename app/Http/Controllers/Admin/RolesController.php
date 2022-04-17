<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RolesRequest;
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

    public function create()
    {
        return Inertia::render('Role/Create', [
            'edit' => false,
            'title' => 'Add Role',
        ]);
    }

    public function store(RolesRequest $request)
    {
        Role::create($request->validated());

        return redirect()->route('admin.roles.index')->with('success', 'Role created successfully.');
    }

    public function edit(Role $role)
    {
        return Inertia::render('Role/Create', [
            'edit' => true,
            'title' => 'Edit Role',
            'role' => new RoleResource($role),
        ]);
    }

    public function update(RolesRequest $request, Role $role)
    {
        $role->update($request->validated());

        return redirect()->route('admin.roles.index')->with('success', 'Role updated successfully.');
    }
}
