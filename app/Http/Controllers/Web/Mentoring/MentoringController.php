<?php

namespace App\Http\Controllers\Web\Mentoring;

use App\Enums\Mentoring\MentoringEnrollmentStatus;
use App\Http\Controllers\Controller;
use App\Models\Mentoring\MentoringEnrollment;
use App\Models\Mentoring\MentoringProgram;
use Illuminate\Http\Request;

class MentoringController extends Controller
{
    public function index()
    {
        $programs = MentoringProgram::where('is_open', true)->get();

        return view('pages.mentoring.index', compact('programs'));
    }

    public function dashboard()
    {
        $enrollments = MentoringEnrollment::where('user_id', auth()->id())
            ->with('program')
            ->withCount('sessions')
            ->orderByDesc('created_at')
            ->get();

        return view('pages.mentoring.dashboard', compact('enrollments'));
    }

    public function show(MentoringEnrollment $enrollment)
    {
        abort_if($enrollment->user_id !== auth()->id(), 403);

        $enrollment->load(['program', 'sessions']);

        return view('pages.mentoring.show', compact('enrollment'));
    }

    public function apply(Request $request)
    {
        $request->validate([
            'mentoring_program_id' => ['required', 'exists:mentoring_programs,id'],
            'goal_notes' => ['nullable', 'string', 'max:1000'],
        ]);

        $alreadyEnrolled = MentoringEnrollment::where('user_id', auth()->id())
            ->where('mentoring_program_id', $request->mentoring_program_id)
            ->whereIn('status', [
                MentoringEnrollmentStatus::Pending->value,
                MentoringEnrollmentStatus::Active->value,
            ])
            ->exists();

        if ($alreadyEnrolled) {
            return back()->with('error', 'Kamu sudah terdaftar atau sedang menunggu persetujuan untuk program ini.');
        }

        MentoringEnrollment::create([
            'mentoring_program_id' => $request->mentoring_program_id,
            'user_id' => auth()->id(),
            'goal_notes' => $request->goal_notes,
            'status' => MentoringEnrollmentStatus::Pending,
        ]);

        return redirect()->route('mentoring.dashboard')
            ->with('success', 'Permohonan bimbingan berhasil dikirim. Tunggu konfirmasi dari mentor.');
    }
}
