<?php

use App\Enums\Mentoring\MentoringEnrollmentStatus;
use App\Models\Mentoring\MentoringEnrollment;
use App\Models\Mentoring\MentoringProgram;
use App\Models\User;

// --- Index ---

test('mentoring index page loads successfully', function () {
    $this->get(route('mentoring.index'))
        ->assertOk();
});

test('mentoring index shows open programs', function () {
    MentoringProgram::factory()->create(['title' => 'Program Terbuka']);
    MentoringProgram::factory()->closed()->create(['title' => 'Program Tertutup']);

    $this->get(route('mentoring.index'))
        ->assertSee('Program Terbuka')
        ->assertDontSee('Program Tertutup');
});

// --- Dashboard ---

test('mentoring dashboard requires authentication', function () {
    $this->get(route('mentoring.dashboard'))
        ->assertRedirect(route('login'));
});

test('mentoring dashboard shows only current user enrollments', function () {
    $user = User::factory()->create();
    $otherUser = User::factory()->create();
    $program = MentoringProgram::factory()->create();

    MentoringEnrollment::factory()->for($user)->for($program, 'program')->create();
    MentoringEnrollment::factory()->for($otherUser)->for($program, 'program')->create(['goal_notes' => 'Catatan pengguna lain']);

    $this->actingAs($user)
        ->get(route('mentoring.dashboard'))
        ->assertOk()
        ->assertDontSee('Catatan pengguna lain');
});

// --- Apply ---

test('mentoring apply requires authentication', function () {
    $program = MentoringProgram::factory()->create();

    $this->post(route('mentoring.apply'), ['mentoring_program_id' => $program->id])
        ->assertRedirect(route('login'));
});

test('mentoring apply creates enrollment', function () {
    $user = User::factory()->create();
    $program = MentoringProgram::factory()->create();

    $this->actingAs($user)
        ->post(route('mentoring.apply'), ['mentoring_program_id' => $program->id])
        ->assertRedirect(route('mentoring.dashboard'));

    $this->assertDatabaseHas('mentoring_enrollments', [
        'user_id' => $user->id,
        'mentoring_program_id' => $program->id,
        'status' => MentoringEnrollmentStatus::Pending->value,
    ]);
});

test('mentoring apply prevents duplicate pending enrollment', function () {
    $user = User::factory()->create();
    $program = MentoringProgram::factory()->create();

    MentoringEnrollment::factory()->for($user)->for($program, 'program')->pending()->create();

    $this->actingAs($user)
        ->post(route('mentoring.apply'), ['mentoring_program_id' => $program->id])
        ->assertRedirect()
        ->assertSessionHas('error');

    $this->assertDatabaseCount('mentoring_enrollments', 1);
});

test('mentoring apply prevents duplicate active enrollment', function () {
    $user = User::factory()->create();
    $program = MentoringProgram::factory()->create();

    MentoringEnrollment::factory()->for($user)->for($program, 'program')->active()->create();

    $this->actingAs($user)
        ->post(route('mentoring.apply'), ['mentoring_program_id' => $program->id])
        ->assertRedirect()
        ->assertSessionHas('error');
});

// --- Show ---

test('mentoring show requires authentication', function () {
    $user = User::factory()->create();
    $program = MentoringProgram::factory()->create();
    $enrollment = MentoringEnrollment::factory()->for($user)->for($program, 'program')->create();

    $this->get(route('mentoring.show', $enrollment->uuid))
        ->assertRedirect(route('login'));
});

test('mentoring show allows owner to view their enrollment', function () {
    $user = User::factory()->create();
    $program = MentoringProgram::factory()->create();
    $enrollment = MentoringEnrollment::factory()->for($user)->for($program, 'program')->create();

    $this->actingAs($user)
        ->get(route('mentoring.show', $enrollment->uuid))
        ->assertOk();
});

test('mentoring show blocks other users from viewing enrollment', function () {
    $owner = User::factory()->create();
    $intruder = User::factory()->create();
    $program = MentoringProgram::factory()->create();
    $enrollment = MentoringEnrollment::factory()->for($owner)->for($program, 'program')->create();

    $this->actingAs($intruder)
        ->get(route('mentoring.show', $enrollment->uuid))
        ->assertForbidden();
});
