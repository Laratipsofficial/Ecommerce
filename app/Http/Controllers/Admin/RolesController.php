<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RolesRequest;
use App\Http\Resources\PermissionResource;
use App\Http\Resources\RoleResource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    private string $routeResourceName = 'roles';

    public function __construct()
    {
        $this->middleware('can:view roles list')->only('index');
        $this->middleware('can:create role')->only(['create', 'store']);
        $this->middleware('can:edit role')->only(['edit', 'update']);
        $this->middleware('can:delete role')->only('destroy');
    }

    public function index(Request $request)
    {
        $roles = Role::query()
            ->select([
                'id',
                'name',
                'created_at',
            ])
            ->when($request->name, fn (Builder $builder, $name) => $builder->where('name', 'like', "%{$name}%"))
            ->latest('id')
            ->paginate(10);

        return Inertia::render('Role/Index', [
            'title' => 'Roles',
            'items' => RoleResource::collection($roles),
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
            'filters' => (object) $request->all(),
            'routeResourceName' => $this->routeResourceName,
            'can' => [
                'create' => $request->user()->can('create role'),
            ],
        ]);
    }

    public function create()
    {
        return Inertia::render('Role/Create', [
            'edit' => false,
            'title' => 'Add Role',
            'routeResourceName' => $this->routeResourceName,
        ]);
    }

    public function store(RolesRequest $request)
    {
        $role = Role::create($request->validated());

        return redirect()->route("admin.{$this->routeResourceName}.edit", $role)->with('success', 'Role created successfully.');
    }

    public function edit(Role $role)
    {
        $role->load(['permissions:permissions.id,permissions.name']);

        return Inertia::render('Role/Create', [
            'edit' => true,
            'title' => 'Edit Role',
            'item' => new RoleResource($role),
            'routeResourceName' => $this->routeResourceName,
            'permissions' => PermissionResource::collection(Permission::oldest('id')->get(['id', 'name'])),
        ]);
    }

    public function update(RolesRequest $request, Role $role)
    {
        $role->update($request->validated());

        return redirect()->route("admin.{$this->routeResourceName}.index")->with('success', 'Role updated successfully.');
    }

    public function destroy(Role $role)
    {
        $role->delete();

        return back()->with('success', 'Role deleted successfully.');
    }
}
