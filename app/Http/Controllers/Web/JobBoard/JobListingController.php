<?php

namespace App\Http\Controllers\Web\JobBoard;

use App\Enums\JobBoard\JobListingStatus;
use App\Enums\JobBoard\JobType;
use App\Http\Controllers\Controller;
use App\Models\JobBoard\JobListing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class JobListingController extends Controller
{
    public function create()
    {
        $jobTypes = JobType::cases();

        return view('pages.jobboard.create', compact('jobTypes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'company_name' => ['required', 'string', 'max:255'],
            'company_logo' => ['nullable', 'url', 'max:500'],
            'description' => ['required', 'string', 'max:5000'],
            'requirements' => ['required', 'string', 'max:3000'],
            'location' => ['required', 'string', 'max:255'],
            'is_remote' => ['boolean'],
            'job_type' => ['required', Rule::enum(JobType::class)],
            'tech_stack' => ['nullable', 'string', 'max:500'],
            'salary_min' => ['nullable', 'integer', 'min:0'],
            'salary_max' => ['nullable', 'integer', 'min:0', 'gte:salary_min'],
            'salary_currency' => ['required', 'string', 'max:10'],
            'apply_url' => ['nullable', 'url', 'max:500', 'required_without:apply_email'],
            'apply_email' => ['nullable', 'email', 'max:255', 'required_without:apply_url'],
            'expires_at' => ['nullable', 'date', 'after:today'],
        ]);

        $techStack = null;
        if (! empty($validated['tech_stack'])) {
            $techStack = array_values(array_filter(array_map('trim', explode(',', $validated['tech_stack']))));
        }

        JobListing::create([
            'user_id' => Auth::id(),
            'slug' => JobListing::generateSlug(),
            'title' => $validated['title'],
            'company_name' => $validated['company_name'],
            'company_logo' => $validated['company_logo'] ?? null,
            'description' => $validated['description'],
            'requirements' => $validated['requirements'],
            'location' => $validated['location'],
            'is_remote' => $request->boolean('is_remote'),
            'job_type' => $validated['job_type'],
            'tech_stack' => $techStack,
            'salary_min' => $validated['salary_min'] ?? null,
            'salary_max' => $validated['salary_max'] ?? null,
            'salary_currency' => $validated['salary_currency'],
            'apply_url' => $validated['apply_url'] ?? null,
            'apply_email' => $validated['apply_email'] ?? null,
            'status' => JobListingStatus::Pending,
            'expires_at' => $validated['expires_at'] ?? null,
        ]);

        return redirect()->route('jobboard.my-listings')
            ->with('success', 'Lowongan berhasil disubmit! Menunggu review dari admin.');
    }

    public function myListings()
    {
        $listings = JobListing::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('pages.jobboard.my-listings', compact('listings'));
    }
}
