<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
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
            'remember' => 'nullable',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        // 2. Attempt to log the user in
        $credentials = $request->only('email', 'password');

        // "remember" will be true if checkbox is checked
        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            // Regenerate session to prevent fixation
            $request->session()->regenerate();

            return redirect()->intended('index')
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



    // Socialite Login
    public function authProviderRedirect($provider)
    {
        // dd($provider);
        if ($provider) {
            return Socialite::driver($provider)->redirect();
        }

        return redirect()->route('auth.sign-in')->with('error', 'Invalid authentication provider.');
    }

    public function socialAuthentication($provider)
    {
        try {
            if ($provider) {
                $socialUser = Socialite::driver($provider)->user();

                // 1) Try to find user by provider + provider id
                $user = User::where('auth_provider', $provider)
                    ->where('auth_provider_id', $socialUser->id)
                    ->first();

                // dd($user);

                // 2) Fallback: if no provider-linked user, try to find by email and link accounts
                if (! $user && ! empty($socialUser->email)) {
                    $user = User::where('email', $socialUser->email)->first();

                    if ($user) {
                        // Link this social provider to existing account
                        $user->update([
                            'auth_provider' => $provider,
                            'auth_provider_id' => $socialUser->id,
                        ]);
                    }
                }

                // 3) If still no user, create a new one (ensure email exists)
                if (! $user) {
                    if (empty($socialUser->email)) {
                        return redirect()->route('auth.sign-in')->with('error', 'Social provider did not return an email address.');
                    }

                    $nameParts = explode(' ', $socialUser->name ?? '', 2);
                    $first_name = $nameParts[0] ?? '';
                    $last_name = $nameParts[1] ?? '';

                    $user = User::create([
                        'first_name' => $first_name,
                        'last_name' => $last_name,
                        'email' => $socialUser->email,
                        // generate a random password - users can reset later
                        'password' => Str::random(24),
                        'auth_provider_id' => $socialUser->id,
                        'auth_provider' => $provider,
                    ]);
                }

                if ($user) {
                    Auth::login($user);
                    return redirect()->route('index');
                }
            }
        } catch (Exception $e) {
            dd($e->getMessage());
            return redirect()->route('auth.sign-in')->with('error', 'Social authentication failed.');
        }
    }


    // Show forgot password form
    public function showLinkRequestForm()
    {
        return view('auth.forgot-password');
    }

    // Send reset link
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        // Send email
        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    // Show reset form
    public function showResetForm($token)
    {
        return view('auth.reset-password', ['token' => $token]);
    }

    // Handle reset password
    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) use ($request) {
                $user->password = $request->password;
                $user->save();

                Auth::login($user); // Auto login after reset
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('auth.sign-in')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }
}
