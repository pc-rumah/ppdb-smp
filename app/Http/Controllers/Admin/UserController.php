<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->paginate(5);
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::pluck('name', 'id');
        return view('admin.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|exists:roles,name',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole($request->role);

        return redirect()->route('kelolausers.index')->with('success', 'User created');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(User $kelolauser)
    {
        $roles = Role::pluck('name', 'id');
        $userRole = $kelolauser->roles->first();
        return view('admin.users.edit', compact('kelolauser', 'roles', 'userRole'));
    }

    public function update(Request $request, User $kelolauser)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $kelolauser->id,
            'role_id' => 'required|exists:roles,id',
        ]);

        $kelolauser->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);

        // Update role
        $kelolauser->syncRoles(Role::find($validated['role_id'])->name);

        return redirect()->route('kelolausers.index')->with('success', 'User updated');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return back()->with('success', 'User deleted');
    }
}
