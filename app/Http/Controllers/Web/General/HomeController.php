<?php

namespace App\Http\Controllers\Web\General;

use App\Http\Controllers\Controller;
use App\Models\Timeline;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        $planned = Timeline::where(['status' => 'planned'])->orderBy('start_date', 'asc')->count();
        $ongoing = Timeline::where(['status' => 'ongoing'])->orderBy('start_date', 'asc')->count();
        $completed = Timeline::where(['status' => 'completed'])->orderBy('end_date', 'desc')->count();
        $timelines = [
            'planned' => $planned,
            'ongoing' => $ongoing,
            'completed' => $completed,
        ];

        return view('pages.general.home.index', [
            'timelines' => $timelines,
        ]);
    }

    public function profile(?User $user = null)
    {
        $user = $user ?? auth()->user();
        if (! $user) {
            abort(404);
        }

        return view('pages.general.home.profile', ['user' => $user]);
    }
}
