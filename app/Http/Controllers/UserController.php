<?php

namespace App\Http\Controllers;

use App\Models\User;
use Laratrust\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\UserFormRequest;

class UserController extends Controller
{
    //
    public function index()
    {
        $staffs = User::all();
        return view('staffs.index', compact('staffs'));
    }

    public function store(UserFormRequest $request)
    {
        $validated = $request->validated();

        try {
            DB::transaction(function () use ($validated) {
                // 1. Create user
                $user = User::create([
                    'first_name' => $validated['first_name'],
                    'last_name' => $validated['last_name'],
                    'email' => $validated['email'],
                    'password' => $validated['password'],
                    'contact_number' => $validated['contact_number'] ?? null,
                    'emergency_contact_number' => $validated['emergency_contact_number'] ?? null,
                    'dob' => $validated['dob'] ?? null,
                    'gender' => $validated['gender'] ?? null,
                    'skills' => isset($validated['skills']) ? json_encode($validated['skills']) : null,
                    'department' => $validated['department'] ?? null,
                ]);

                // 2. Create related address
                $user->address()->create([
                    'address_line_1' => $validated['address_line_1'],
                    'address_line_2' => $validated['address_line_2'] ?? null,
                    'country' => $validated['country'],
                    'state' => $validated['state'],
                    'city' => $validated['city'],
                    'zip_code' => $validated['zip_code'],
                ]);
            });

            return redirect()
                ->route('staffs.index')
                ->with('success', 'Successfully Created Staff');
        } catch (\Exception $e) {
            // Optional: log error for debugging
            Log::error('Staff creation failed: ' . $e->getMessage());

            return back()
                ->withInput()
                ->withErrors($validated)
                ->with('error', 'Staff Not Created. Please Try Again.');
        }
    }

    public function show($id)
    {
        $staff = User::with('address', 'roles')->findOrFail($id);
        $roles = Role::all();
        // dd($staff);
        return view('staffs.view', compact('staff', 'roles'));
    }

    public function edit($id)
    {
        $staff = User::with('address')->findOrFail($id);
        return view('staffs.edit', compact('staff'));
    }

    public function update(UserFormRequest $request, $id)
    {
        $data = $request->validated();

        if (empty($data['password'])) {
            unset($data['password']);
        }

        $staff = User::findOrFail($id);
        $updated = $staff->update($data);

        if (!$updated) {
            return back()->with('error', 'Something went wrong');
        }

        return redirect()->route('staffs.index')->with('success', 'User Updated Successfully');
    }

    public function destroy($id)
    {
        $staff = User::findOrFail($id);
        $deleted = $staff->delete();

        if (!$deleted) {
            return back()->with('error', 'Failed to delete role.');
        }
        return redirect()->route('staffs.index')->with('success', 'User deleted successfully.');
    }


    // UserController.php
    public function assignRole(Request $request, $id)
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id',
        ]);

        $user = User::findOrFail($id);
        $user->syncRoles([$request->role_id]); // replaces existing roles with the new one
        // Or use $user->attachRole($request->role_id) if you want multiple roles

        return redirect()->back()->with('success', 'Role assigned successfully.');
    }
}
