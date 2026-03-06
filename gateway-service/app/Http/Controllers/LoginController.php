<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Show login form
     *
     * @return Factory|\Illuminate\Contracts\View\View
     */
    public function show(): Factory|\Illuminate\Contracts\View\View
    {
        return view('login');
    }

    /**
     * Handle login
     *
     * @param LoginRequest $request
     * @return RedirectResponse
     */
    public function login(LoginRequest $request): RedirectResponse
    {
        $credentials = $request->validated();

        if (!Auth::attempt($credentials)) {

            return back()
                ->withInput()
                ->withErrors([
                    'email' => 'Invalid credentials'
                ]);
        }

        $user = Auth::user();

        if (!$user->is_active) {

            Auth::logout();

            return back()
                ->withErrors([
                    'email' => 'Please activate your account first.'
                ]);
        }

        $request->session()->regenerate();

        return redirect()
            ->route('dashboard')
            ->with('success', 'Login successful');
    }
}
