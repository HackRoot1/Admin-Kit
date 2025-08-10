<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    //
    public function index()
    {
        $roles = Role::all();
        return view('roles.index', compact('roles'));
    }

    public function store(RoleRequest $request)
    {

        $role = Role::create($request->validated());

        if ($role) {
            return redirect()->route('roles.index')->with('success', 'Successfully Created Role');
        }
        return back()->with('error', 'Role Not Created. Please Try Again.');
    }

    public function show($id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        return view('roles.view', compact('role', 'permissions'));
    }

    public function edit($id)
    {
        $role = Role::findOrFail($id);
        return view('roles.edit', compact('role'));
    }

    public function update(RoleRequest $request, $id)
    {
        $role = Role::findOrFail($id);

        $updated = $role->update($request->validated());

        if (!$updated) {
            return back()->with('error', 'Something went wrong');
        }

        return redirect()->route('roles.index')->with('success', 'Role Updated Successfully');
    }

    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $deleted = $role->delete();

        if (!$deleted) {
            return back()->with('error', 'Failed to delete role.');
        }
        return redirect()->route('roles.index')->with('success', 'Role deleted successfully.');
    }

    public function updatePermissions(Request $request, $roleId)
    {
        $role = Role::findOrFail($roleId);

        // Ensure permissions array exists (empty array if none selected)
        $permissions = $request->input('permissions', []);

        // Laratrust method to sync permissions
        $role->syncPermissions($permissions);

        return redirect()->route('role.show', $roleId)
            ->with('success', 'Permissions updated successfully.');
    }
}
