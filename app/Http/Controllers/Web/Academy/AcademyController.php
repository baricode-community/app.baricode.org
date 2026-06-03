<?php

namespace App\Http\Controllers\Web\Academy;

use App\Http\Controllers\Controller;
use App\Models\Academy\AcademyBatch;
use App\Models\Academy\AcademyEnrollment;
use App\Models\Academy\AcademyProgram;

class AcademyController extends Controller
{
    public function index()
    {
        $programs = AcademyProgram::where('is_published', true)
            ->with(['activeBatches'])
            ->get();

        return view('pages.academy.index', compact('programs'));
    }

    public function show(AcademyProgram $program)
    {
        abort_unless($program->is_published, 404);

        $program->load(['batches' => function ($q) {
            $q->where('is_active', true)->with('enrollments')->orderBy('created_at');
        }]);

        $userEnrollments = [];
        if (auth()->check()) {
            $userEnrollments = AcademyEnrollment::where('user_id', auth()->id())
                ->pluck('academy_batch_id')
                ->toArray();
        }

        return view('pages.academy.show', compact('program', 'userEnrollments'));
    }

    public function batch(AcademyBatch $batch)
    {
        $batch->load(['program', 'sessions', 'enrollments']);

        $enrollment = null;
        if (auth()->check()) {
            $enrollment = AcademyEnrollment::where('user_id', auth()->id())
                ->where('academy_batch_id', $batch->id)
                ->first();
        }

        return view('pages.academy.batch', compact('batch', 'enrollment'));
    }

    public function dashboard()
    {
        $enrollments = AcademyEnrollment::where('user_id', auth()->id())
            ->with(['batch.program', 'batch.sessions'])
            ->orderByDesc('enrolled_at')
            ->get();

        return view('pages.academy.dashboard', compact('enrollments'));
    }
}
