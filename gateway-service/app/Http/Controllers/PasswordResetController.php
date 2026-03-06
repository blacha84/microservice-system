<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

use App\Services\PasswordResetService;
use App\Http\Requests\ForgotPasswordRequest;
use App\Http\Requests\ResetPasswordRequest;

class PasswordResetController extends Controller
{
    /**
     * @return Factory|View
     */
    public function show(): Factory|View
    {
        return view('forgot-password');
    }

    /**
     * @param ForgotPasswordRequest $request
     * @param PasswordResetService $passwordResetService
     * @return RedirectResponse
     */
    public function send(
        ForgotPasswordRequest $request,
        PasswordResetService $passwordResetService
    ): RedirectResponse {

        $passwordResetService->send($request->email);

        return back()->with(
            'success',
            'If the account exists, a password reset email has been sent.'
        );
    }

    /**
     * @param Request $request
     * @return Factory|View
     */
    public function showResetForm(Request $request): Factory|View
    {
        return view('reset-password', [
            'token' => $request->token
        ]);
    }

    /**
     * @param ResetPasswordRequest $request
     * @param PasswordResetService $passwordResetService
     * @return RedirectResponse
     * @throws \Exception
     */
    public function reset(
        ResetPasswordRequest $request,
        PasswordResetService $passwordResetService
    ): RedirectResponse {

        $passwordResetService->reset(
            $request->email,
            $request->token,
            $request->password
        );

        return redirect('/login')->with(
            'success',
            'Your password has been reset successfully.'
        );
    }
}
