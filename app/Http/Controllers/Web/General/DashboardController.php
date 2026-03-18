<?php

namespace App\Http\Controllers\Web\General;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('pages.general.dashboard.index');
    }

    public function analytics()
    {
        return view('pages.general.dashboard.analytics');
    }

    public function settings()
    {
        return view('pages.general.dashboard.settings');
    }

    public function fun()
    {
        return view('pages.general.dashboard.fun');
    }

    public function memes()
    {
        return view('pages.general.dashboard.memes');
    }
}
