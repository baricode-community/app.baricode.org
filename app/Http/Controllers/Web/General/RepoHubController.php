<?php

namespace App\Http\Controllers\Web\General;

use App\Http\Controllers\Controller;
use App\Models\RepoHub\RepoHub;
use App\Models\RepoHub\RepoHubTag;
use Illuminate\Http\Request;

class RepoHubController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('q');
        $tagSlug = $request->get('tag');

        $tags = RepoHubTag::orderBy('name')->get();
        $activeTag = $tagSlug ? RepoHubTag::where('slug', $tagSlug)->first() : null;

        $repos = RepoHub::published()
            ->with('tags')
            ->when($search, fn ($query) => $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhere('why_recommended', 'like', "%{$search}%");
            }))
            ->when($activeTag, fn ($query) => $query->whereHas('tags', fn ($q) => $q->where('repo_hub_tags.id', $activeTag->id)))
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('pages.repohub.index', compact('repos', 'tags', 'activeTag', 'search'));
    }

    public function show(RepoHub $repoHub)
    {
        abort_if(! $repoHub->is_published, 404);

        $repoHub->load('tags');

        return view('pages.repohub.show', compact('repoHub'));
    }
}
