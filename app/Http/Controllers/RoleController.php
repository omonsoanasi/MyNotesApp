<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller implements HasMiddleware
{

    public static function middleware(): array
    {
        return [
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('delete'), only:['destroy']),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all();

        return view('role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('role.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:roles|max:255',
        ]);

        $role = Role::create($validatedData);

        return redirect()->route('role.index')->with('message', 'Role created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        return view('role.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
        ]);

        $role->update($validatedData);

        return redirect()->route('role.index')->with('message', 'Role updated successfully.');
    }

    public function addPermission(Role $role)
    {
        $permissions = Permission::all();
        //get the permissions assigned to this role
        $rolePermissions = DB::table("role_has_permissions")->where('role_id', $role->id)->pluck('permission_id','permission_id')->all();

        return view('role.add-permissions', compact('role', 'permissions', 'rolePermissions'));
    }

    public function givePermission(Request $request,  Role $role, Permission $permission)
    {
        $validatedData = $request->validate([
            'permission' => 'required|array',
        ]);

        $role->syncPermissions($validatedData);

        return redirect()->route('role.index')->with('message', 'Permission(s) added successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->delete();

        return redirect()->route('role.index')->with('message', 'Role deleted successfully.');
    }
}
