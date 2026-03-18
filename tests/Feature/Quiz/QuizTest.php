<?php

use App\Livewire\Quiz\TakeQuiz;
use App\Models\Quiz\Option;
use App\Models\Quiz\Question;
use App\Models\Quiz\Quiz;
use App\Models\Quiz\QuizResult;
use Livewire\Livewire;

// ─── Routes ──────────────────────────────────────────────────────────────────

test('quiz index page is accessible', function () {
    $this->get(route('lms.quiz.index'))->assertStatus(200);
});

test('quiz show page is accessible for active quiz', function () {
    $quiz = Quiz::factory()->active()->create();
    Question::factory()->create(['quiz_id' => $quiz->id]);

    $this->get(route('lms.quiz.show', $quiz))->assertStatus(200);
});

test('quiz show page returns 404 for inactive quiz', function () {
    $quiz = Quiz::factory()->inactive()->create();

    $this->get(route('lms.quiz.show', $quiz))->assertStatus(404);
});

// ─── Index page ───────────────────────────────────────────────────────────────

test('index shows only active quizzes', function () {
    Quiz::factory()->active()->create(['title' => 'Quiz Aktif']);
    Quiz::factory()->inactive()->create(['title' => 'Quiz Nonaktif']);

    $this->get(route('lms.quiz.index'))
        ->assertSee('Quiz Aktif')
        ->assertDontSee('Quiz Nonaktif');
});

test('index shows empty state when no active quiz', function () {
    Quiz::factory()->inactive()->create();

    $this->get(route('lms.quiz.index'))
        ->assertSee('Belum ada quiz tersedia');
});

// ─── Rendering ───────────────────────────────────────────────────────────────

test('renders quiz questions and options', function () {
    $quiz = Quiz::factory()->active()->create();
    $question = Question::factory()->create(['quiz_id' => $quiz->id, 'question_text' => 'Apa itu Laravel?']);
    Option::factory()->create(['question_id' => $question->id, 'option_text' => 'PHP Framework']);
    Option::factory()->create(['question_id' => $question->id, 'option_text' => 'JavaScript Library']);

    Livewire::test(TakeQuiz::class, ['quiz' => $quiz])
        ->assertSee('Apa itu Laravel?')
        ->assertSee('PHP Framework')
        ->assertSee('JavaScript Library');
});

// ─── Validation ──────────────────────────────────────────────────────────────

test('requires at least one option selected per question', function () {
    $quiz = Quiz::factory()->active()->create();
    $question = Question::factory()->create(['quiz_id' => $quiz->id]);
    Option::factory()->count(3)->create(['question_id' => $question->id]);

    Livewire::test(TakeQuiz::class, ['quiz' => $quiz])
        ->call('submitQuiz')
        ->assertHasErrors(["answers.{$question->id}"]);
});

// ─── Scoring ─────────────────────────────────────────────────────────────────

test('calculates total score from selected options', function () {
    $quiz = Quiz::factory()->active()->create();
    $question = Question::factory()->create(['quiz_id' => $quiz->id]);
    $optionA = Option::factory()->create(['question_id' => $question->id, 'score' => 10]);
    $optionB = Option::factory()->create(['question_id' => $question->id, 'score' => 5]);
    Option::factory()->create(['question_id' => $question->id, 'score' => 3]);

    Livewire::test(TakeQuiz::class, ['quiz' => $quiz])
        ->set('answers', [$question->id => [$optionA->id, $optionB->id]])
        ->call('submitQuiz')
        ->assertSet('totalScore', 15)
        ->assertSet('submitted', true);
});

test('score is zero when options have no score value', function () {
    $quiz = Quiz::factory()->active()->create();
    $question = Question::factory()->create(['quiz_id' => $quiz->id]);
    $option = Option::factory()->create(['question_id' => $question->id, 'score' => 0]);

    Livewire::test(TakeQuiz::class, ['quiz' => $quiz])
        ->set('answers', [$question->id => [$option->id]])
        ->call('submitQuiz')
        ->assertSet('totalScore', 0);
});

test('accumulates score across multiple questions', function () {
    $quiz = Quiz::factory()->active()->create();

    $q1 = Question::factory()->create(['quiz_id' => $quiz->id]);
    $o1 = Option::factory()->create(['question_id' => $q1->id, 'score' => 10]);

    $q2 = Question::factory()->create(['quiz_id' => $quiz->id]);
    $o2a = Option::factory()->create(['question_id' => $q2->id, 'score' => 7]);
    $o2b = Option::factory()->create(['question_id' => $q2->id, 'score' => 3]);

    Livewire::test(TakeQuiz::class, ['quiz' => $quiz])
        ->set('answers', [
            $q1->id => [$o1->id],
            $q2->id => [$o2a->id, $o2b->id],
        ])
        ->call('submitQuiz')
        ->assertSet('totalScore', 20);
});

// ─── Persistence ─────────────────────────────────────────────────────────────

test('saves quiz result to database after submission', function () {
    $quiz = Quiz::factory()->active()->create();
    $question = Question::factory()->create(['quiz_id' => $quiz->id]);
    $option = Option::factory()->create(['question_id' => $question->id, 'score' => 20]);

    Livewire::test(TakeQuiz::class, ['quiz' => $quiz])
        ->set('answers', [$question->id => [$option->id]])
        ->call('submitQuiz');

    expect(QuizResult::count())->toBe(1);
    expect(QuizResult::first()->total_score)->toBe(20);
});

test('quiz result stores answers as json array', function () {
    $quiz = Quiz::factory()->active()->create();
    $question = Question::factory()->create(['quiz_id' => $quiz->id]);
    $option = Option::factory()->create(['question_id' => $question->id, 'score' => 5]);

    Livewire::test(TakeQuiz::class, ['quiz' => $quiz])
        ->set('answers', [$question->id => [$option->id]])
        ->call('submitQuiz');

    $result = QuizResult::first();
    expect($result->answers)->toBeArray();
    expect($result->answers[(string) $question->id])->toContain((string) $option->id);
});

// ─── Retake ───────────────────────────────────────────────────────────────────

test('retakeQuiz resets state', function () {
    $quiz = Quiz::factory()->active()->create();
    $question = Question::factory()->create(['quiz_id' => $quiz->id]);
    $option = Option::factory()->create(['question_id' => $question->id, 'score' => 10]);

    Livewire::test(TakeQuiz::class, ['quiz' => $quiz])
        ->set('answers', [$question->id => [$option->id]])
        ->call('submitQuiz')
        ->call('retakeQuiz')
        ->assertSet('submitted', false)
        ->assertSet('totalScore', null)
        ->assertSet('answers', [$question->id => []]);
});
