<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\PermissionFormRequest;

class PermissionController extends Controller
{
    //
    //
    public function index()
    {
        $permissions = Permission::all();
        return view('permissions.index', compact('permissions'));
    }

    public function store(PermissionFormRequest $request)
    {

        $permission = Permission::create($request->validated());

        if ($permission) {
            return redirect()->route('permissions.index')->with('success', 'Successfully Created Permission');
        }
        return back()->with('error', 'Permission Not Created. Please Try Again.');
    }

    public function show($id)
    {
        $permission = Permission::findOrFail($id);
        return view('permissions.view', compact('permission'));
    }

    public function edit($id)
    {
        $permission = Permission::findOrFail($id);
        return view('permissions.edit', compact('permission'));
    }

    public function update(PermissionFormRequest $request, $id)
    {
        $permission = Permission::find($id);

        $updated = $permission->update($request->validated());

        if (!$updated) {
            return back()->with('error', 'Something went wrong');
        }

        return redirect()->route('permissions.index')->with('success', 'Permission Updated Successfully');
    }

    public function destroy($id)
    {
        $permission = Permission::findOrFail($id);
        $deleted = $permission->delete();

        if (!$deleted) {
            return back()->with('error', 'Failed to delete role.');
        }
        return redirect()->route('permissions.index')->with('success', 'Role deleted successfully.');
    }
}
