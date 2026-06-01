<?php

namespace App\Http\Controllers\Web\General;

use App\Http\Controllers\Controller;
use App\Models\User;

class FamilyController extends Controller
{
    public function index()
    {
        return view('pages.general.family.index');
    }

    public function show(User $user)
    {
        $user->load(['meme', 'dailyCommitTrackers', 'meets', 'certificates', 'activeEnrollments.course']);

        return view('pages.general.family.show', compact('user'));
    }
}
