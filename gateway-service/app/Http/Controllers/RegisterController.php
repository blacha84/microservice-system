<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterUserRequest;
use App\Services\RegisterUserService;
use Illuminate\Contracts\View\Factory;

class RegisterController extends Controller
{
    /**
     * @param RegisterUserService $registerUserService
     */
    public function __construct(
        private RegisterUserService $registerUserService
    ) {}

    /**
     * @return Factory|\Illuminate\Contracts\View\View
     */
    public function show()
    {
        return view('register');
    }

    /**
     * @param RegisterUserRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(RegisterUserRequest $request)
    {
        $this->registerUserService->register(
            $request->validated()
        );

        return redirect()->route('register.success');
    }
}
