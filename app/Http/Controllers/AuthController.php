<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //
    public function authenticate(Request $request)
    {
        // 1. Validate request input
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);
        
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        // 2. Attempt to log the user in
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Regenerate session to prevent fixation
            $request->session()->regenerate();
            
            return redirect()->route('index')
            ->with('success', 'You have successfully logged in.');
        }

        // 3. If login fails, redirect back with error
        return back()
            ->withInput()
            ->with([
                'error' => 'The provided credentials do not match our records.',
            ]);
    }

    public function register(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'email' => 'required|email|max:50|unique:users,email',
            'password' => 'required|string|min:6'
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $validated = $validator->validated();
        $user = User::create([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        if ($user) {
            return redirect()
                ->route('index')
                ->with('success', 'Successfully Created Staff');
        }

        return back()
            ->withInput()
            ->with('error', 'Staff Not Created. Please Try Again.');
    }

    public function logout(Request $request)
    {
        Auth::logout(); // Log the user out

        // Invalidate and regenerate the session for security
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('auth.sign-in')->with('success', 'You have been logged out successfully.');
    }
}
