<?php

namespace App\Http\Controllers\Web\General;

use App\Http\Controllers\Controller;
use App\Models\Timeline;

class TimelineController extends Controller
{
    public function index()
    {
        return view('pages.timelines.index');
    }

    public function show(Timeline $timeline)
    {
        return view('pages.timelines.show', compact('timeline'));
    }
}
