<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::all();
        return view('permission.index', compact('permissions'));
    }
    public function create()
    {
        return view('permission.create');
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required','string','max:255','unique:permissions,name',
        ]);

//        $permission = new Permission();
//        $permission->name = $request->input('name');
//        $permission->save();
        $permission = Permission::create($validatedData);

        return redirect()->route('permission.index')->with('message','Permission created successfully');
    }
    public function show($id)
    {

    }
    public function edit(Permission $permission)
    {
        return view('permission.edit', compact('permission'));
    }
    public function update(Request $request, Permission $permission)
    {
        $validatedData = $request->validate([
            'name' => 'required','string','max:255','unique:permissions,name,'.$permission->id,
        ]);
        $permission->update($validatedData);

        return redirect()->route('permission.index')->with('message','Permission updated successfully');
    }
    public function destroy(Permission $permission)
    {
        $permission->delete();

        return redirect()->route('permission.index')->with('message','Permission deleted successfully');
    }
}
