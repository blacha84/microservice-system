<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class ActivationController extends Controller
{
    /**
     * Activate user account
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function activate(Request $request): RedirectResponse
    {
        $token = $request->get('token');

        if (!$token) {
            return redirect()
                ->route('register.form')
                ->with('error', 'Invalid activation link.');
        }

        $user = User::where('activation_token', $token)->first();

        if (!$user) {
            return redirect()
                ->route('register.form')
                ->with('error', 'Invalid or expired activation link.');
        }

        if ($user->is_active) {
            return redirect()
                ->route('login.form')
                ->with('info', 'Your account is already activated.');
        }

        $user->is_active = true;
        $user->save();

        return redirect()
            ->route('login.form')
            ->with('success', 'Your account has been activated. You can now log in.');
    }
}
