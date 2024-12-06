<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        try {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]);

            $role = 'user';

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $role,
            ]);

            event(new Registered($user));

            Auth::login($user);

            return redirect(route('dashboard', absolute: false))
                ->with('success', 'Registration successful! Welcome to the dashboard.');
        } catch (\Exception $e) {
            return back()
                ->withErrors(['msg' => 'Failed to register. Please try again.'])
                ->withInput($request->except('password', 'password_confirmation'));
        }
    }

    public function createOrganizer()
    {
        return view('auth.register-organizer');
    }

    public function storeOrganizer(Request $request): RedirectResponse
    {
        try {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]);

            $role = 'organizer';

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $role,
            ]);

            Auth::login($user);

            return redirect(route('dashboard', absolute: false))
                ->with('success', 'Registration successful! Welcome to the dashboard.');
        } catch (\Exception $e) {
            return back()
                ->withErrors(['msg' => 'Failed to register as organizer. Please try again.'])
                ->withInput($request->except('password', 'password_confirmation'));
        }
    }
}
