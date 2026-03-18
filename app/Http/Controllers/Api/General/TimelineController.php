<?php

namespace App\Http\Controllers\Api\General;

use App\Http\Controllers\Controller;
use App\Models\Timeline;
use Illuminate\Http\Request;

class TimelineController extends Controller
{
    /**
     * Display a listing of the timelines.
     */
    public function index(Request $request)
    {
        $query = Timeline::query()->with('progressJournals');

        // Filter by status if provided
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $timelines = $query
            ->orderByDesc('created_at')
            ->paginate(10);

        return response()->json($timelines);
    }

    /**
     * Display the specified timeline.
     */
    public function show(Timeline $timeline)
    {
        $timeline->load('progressJournals');

        return response()->json($timeline);
    }
}
