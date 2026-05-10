<?php

namespace App\Http\Controllers\Web\General;

use App\Http\Controllers\Controller;
use App\Models\RepoHub\RepoHub;

class RepoHubController extends Controller
{
    public function index()
    {
        return view('pages.repohub.index');
    }

    public function show(RepoHub $repoHub)
    {
        abort_if(! $repoHub->is_published, 404);

        $repoHub->load('tags');

        return view('pages.repohub.show', compact('repoHub'));
    }
}
