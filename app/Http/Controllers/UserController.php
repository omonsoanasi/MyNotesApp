<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();

        return view('user.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required','max:255','string',
            'email' => 'required', 'string', 'email', 'max:255', 'unique:users',
            'password' => 'required', 'string', 'min:8',
            'roles' => 'required'
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        $user->syncRoles($validatedData['roles']);

        return redirect()->route('user.index')->with('success', 'User created successfully.');

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
    public function edit(User $user)
    {
        $roles = Role::all();
        $userRoles = $user->roles->pluck('name','name')->all();
        return view('user.edit', compact('user','roles','userRoles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name' => 'required','max:255','string',
            'email' => 'required', 'string', 'email', 'max:255', 'unique:users',
            'password' => 'nullable', 'string', 'min:8',
            'roles' => 'required'
        ]);

        $data = [
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
        ];

        if(!empty($validatedData['password'])){
           $data += ['password' => Hash::make($validatedData['password'])];
        }

        $user->update($data);
        $user->syncRoles($validatedData['roles']);
        return redirect()->route('user.index')->with('message', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('user.index')->with('message', 'User deleted successfully.');
    }
}
