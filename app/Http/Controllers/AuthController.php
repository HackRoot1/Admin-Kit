<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;

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

    public function googleLogin()
    {
        return Socialite::driver('google')->redirect();
    }

    public function googleAuthentication()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            $user = User::where('google_id', $googleUser->id)->first();

            if ($user) {
                Auth::login($user);
                return redirect()->route('index');
            } else {
                $nameParts = explode(' ', $googleUser->name, 2);
                $first_name = $nameParts[0] ?? '';
                $last_name = $nameParts[1] ?? '';

                $userData = User::create([
                    'first_name' => $first_name,
                    'last_name' => $last_name,
                    'email' => $googleUser->email,
                    'password' => Hash::make('Password@123'),
                    'google_id' => $googleUser->id,
                ]);

                if ($userData) {
                    Auth::login($userData);
                    return redirect()->route('index');
                }
            }
        } catch (Exception $e) {
            dd($e);
        }
    }
}
