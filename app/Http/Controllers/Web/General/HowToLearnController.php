<?php

namespace App\Http\Controllers\Web\General;

use App\Http\Controllers\Controller;

class HowToLearnController extends Controller
{
    public function index()
    {
        return view('pages.general.how-to-learn.index');
    }
}
