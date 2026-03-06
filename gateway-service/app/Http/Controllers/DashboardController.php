<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;

class DashboardController extends Controller
{
    /**
     * @return Factory|\Illuminate\Contracts\View\View
     */
    public function show(): Factory|\Illuminate\Contracts\View\View
    {
        return view('dashboard');
    }
}
