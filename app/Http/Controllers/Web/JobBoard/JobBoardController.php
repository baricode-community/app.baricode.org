<?php

namespace App\Http\Controllers\Web\JobBoard;

use App\Http\Controllers\Controller;
use App\Models\JobBoard\JobListing;
use Illuminate\Http\Request;

class JobBoardController extends Controller
{
    public function index(Request $request)
    {
        $query = JobListing::active()->with('poster')->latest();

        if ($stack = $request->query('stack')) {
            $query->whereJsonContains('tech_stack', $stack);
        }

        if ($location = $request->query('location')) {
            $query->where('location', 'like', "%{$location}%");
        }

        if ($type = $request->query('type')) {
            $query->where('job_type', $type);
        }

        if ($request->boolean('remote')) {
            $query->where('is_remote', true);
        }

        $listings = $query->paginate(12)->withQueryString();

        $stacks = JobListing::active()
            ->whereNotNull('tech_stack')
            ->pluck('tech_stack')
            ->flatten()
            ->unique()
            ->sort()
            ->values();

        $locations = JobListing::active()
            ->whereNotNull('location')
            ->pluck('location')
            ->unique()
            ->sort()
            ->values();

        return view('pages.jobboard.index', compact('listings', 'stacks', 'locations'));
    }

    public function show(JobListing $jobListing)
    {
        abort_if(! $jobListing->isApproved(), 404);

        $jobListing->incrementViews();
        $jobListing->load('poster');

        return view('pages.jobboard.show', compact('jobListing'));
    }
}
