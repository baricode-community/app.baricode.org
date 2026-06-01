<?php

namespace App\Http\Controllers\Web\General;

use App\Enums\RepoHub\RepoHubStatus;
use App\Http\Controllers\Controller;
use App\Models\RepoHub\RepoHub;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RepoHubSubmissionController extends Controller
{
    public function create()
    {
        return view('pages.repohub.submit');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'repo_url' => ['required', 'url', 'max:500'],
            'demo_url' => ['nullable', 'url', 'max:500'],
            'description' => ['required', 'string', 'max:2000'],
            'why_recommended' => ['required', 'string', 'max:2000'],
            'tags' => ['nullable', 'array'],
            'tags.*' => ['integer', 'exists:repo_hub_tags,id'],
        ]);

        $repo = RepoHub::create([
            'title' => $validated['title'],
            'slug' => RepoHub::generateSlug(),
            'repo_url' => $validated['repo_url'],
            'demo_url' => $validated['demo_url'] ?? null,
            'description' => $validated['description'],
            'why_recommended' => $validated['why_recommended'],
            'is_published' => false,
            'submitted_by' => Auth::id(),
            'status' => RepoHubStatus::Pending,
        ]);

        if (! empty($validated['tags'])) {
            $repo->tags()->sync($validated['tags']);
        }

        return redirect()->route('repohub.my-submissions')
            ->with('success', 'Repo berhasil disubmit! Menunggu review dari admin.');
    }

    public function mySubmissions()
    {
        $submissions = RepoHub::where('submitted_by', Auth::id())
            ->with('tags')
            ->latest()
            ->get();

        return view('pages.repohub.my-submissions', compact('submissions'));
    }
}
