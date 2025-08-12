<?php

namespace App\Http\Controllers;

use App\Models\User;
use Laratrust\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use App\Http\Requests\UserFormRequest;
use Intervention\Image\Drivers\Gd\Driver;

class UserController extends Controller
{
    //
    public function index()
    {
        $staffs = User::latest()->get();
        return view('staffs.index', compact('staffs'));
    }

    public function store(UserFormRequest $request)
    {
        $validated = $request->validated();

        try {
            DB::transaction(function () use ($validated) {
                // 1. Create user
                // Handle profile image
                if (isset($validated['profile'])) {

                    $profile = $validated['profile'];
                    $ext = $profile->getClientOriginalExtension();
                    $profileName = time() . '.' . $ext;
                    $profile->move(public_path('uploads/profile'), $profileName);

                    $manager = new ImageManager(Driver::class);
                    $image = $manager->read(public_path('uploads/profile/' . $profileName));

                    $image->resize(400, 500);

                    $smallDir = public_path('uploads/profile/small');
                    if (!File::exists($smallDir)) {
                        File::makeDirectory($smallDir, 0755, true);
                    }

                    $image->save(public_path('uploads/profile/small/' . $profileName));

                    $validated['profile'] = $profileName;
                } else {
                    unset($validated['profile']);
                }


                $user = User::create([
                    'first_name' => $validated['first_name'],
                    'last_name' => $validated['last_name'],
                    'email' => $validated['email'],
                    'password' => $validated['password'],
                    'contact_number' => $validated['contact_number'] ?? null,
                    'emergency_contact_number' => $validated['emergency_contact_number'] ?? null,
                    'dob' => $validated['dob'] ?? null,
                    'gender' => $validated['gender'] ?? null,
                    'skills' => isset($validated['skills']) ? $validated['skills'] : null,
                    'department' => $validated['department'] ?? null,
                    'profile' => $validated['profile'] ?? null,
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
                ->withErrors('error', $e->getMessage())
                ->with('error', 'Staff Not Created. Please Try Again.');
        }
    }

    public function show($id)
    {
        $staff = User::with('address', 'roles')->findOrFail($id);
        $roles = Role::all();
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

        // Handle password
        if (empty($data['password'])) {
            unset($data['password']);
        }
        // Update staff
        $staff = User::findOrFail($id);


        // Handle profile image
        if ($request->hasFile('profile')) {

            if ($staff->profile != '') {
                if (File::exists(public_path('uploads/profile/' . $staff->profile))) {
                    File::delete(public_path('uploads/profile/' . $staff->profile));
                }

                if (File::exists(public_path('uploads/profile/small/' . $staff->profile))) {
                    File::delete(public_path('uploads/profile/small/' . $staff->profile));
                }
            }

            $profile = $data['profile'];
            $ext = $profile->getClientOriginalExtension();
            $profileName = time() . '.' . $ext;
            $profile->move(public_path('uploads/profile'), $profileName);

            $manager = new ImageManager(Driver::class);
            $image = $manager->read(public_path('uploads/profile/' . $profileName));

            $image->resize(400, 500);

            $smallDir = public_path('uploads/profile/small');
            if (!File::exists($smallDir)) {
                File::makeDirectory($smallDir, 0755, true);
            }

            $image->save(public_path('uploads/profile/small/' . $profileName));
            $image->save();

            $data['profile'] = $profileName;
        } else {
            unset($data['profile']);
        }

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
