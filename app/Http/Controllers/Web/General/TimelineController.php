<?php

namespace App\Http\Controllers\Web\General;

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
        $query = Timeline::query();

        // Filter by status if provided
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $timelines = $query
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('pages.timelines.index', compact('timelines'));
    }

    /**
     * Display the specified timeline.
     */
    public function show(Timeline $timeline)
    {
        return view('pages.timelines.show', compact('timeline'));
    }

    /**
     * Get border color based on status
     */
    protected function getBorderColor(string $status): string
    {
        return match ($status) {
            'pending' => 'border-yellow-500',
            'ongoing' => 'border-blue-500',
            'completed' => 'border-green-500',
            'cancelled' => 'border-red-500',
            default => 'border-gray-500',
        };
    }

    /**
     * Get status badge classes
     */
    protected function getStatusBadgeClass(string $status): string
    {
        return match ($status) {
            'pending' => 'bg-yellow-100 text-yellow-800',
            'ongoing' => 'bg-blue-100 text-blue-800',
            'completed' => 'bg-green-100 text-green-800',
            'cancelled' => 'bg-red-100 text-red-800',
            default => 'bg-gray-100 text-gray-800',
        };
    }
}
