<?php

use App\Models\LMS\Course;
use App\Models\LMS\HowToLearn;

// ─── Routes ──────────────────────────────────────────────────────────────────

test('course detail page is accessible for published course', function () {
    $course = Course::factory()->create(['is_published' => true]);

    $this->get(route('lms.course', $course->slug))->assertStatus(200);
});

// ─── HowToLearn ditampilkan di halaman course ─────────────────────────────────

test('course page menampilkan panduan belajar aktif', function () {
    $course = Course::factory()->create(['is_published' => true]);
    $guide  = HowToLearn::factory()->active()->create(['title' => 'Panduan Aktif Test']);
    $course->howToLearns()->attach($guide->id);

    $this->get(route('lms.course', $course->slug))
        ->assertStatus(200)
        ->assertSee('Panduan Aktif Test');
});

test('course page tidak menampilkan panduan belajar nonaktif', function () {
    $course = Course::factory()->create(['is_published' => true]);
    $guide  = HowToLearn::factory()->inactive()->create(['title' => 'Panduan Nonaktif Test']);
    $course->howToLearns()->attach($guide->id);

    $this->get(route('lms.course', $course->slug))
        ->assertStatus(200)
        ->assertDontSee('Panduan Nonaktif Test');
});

test('course page tidak menampilkan section panduan belajar jika kosong', function () {
    $course = Course::factory()->create(['is_published' => true]);

    $this->get(route('lms.course', $course->slug))
        ->assertStatus(200)
        ->assertDontSee('Panduan Belajar');
});

test('course page menampilkan deskripsi panduan belajar', function () {
    $course = Course::factory()->create(['is_published' => true]);
    $guide  = HowToLearn::factory()->active()->create([
        'title'       => 'Panduan Test',
        'description' => 'Deskripsi panduan test ini',
    ]);
    $course->howToLearns()->attach($guide->id);

    $this->get(route('lms.course', $course->slug))
        ->assertSee('Deskripsi panduan test ini');
});

test('course page menampilkan banyak panduan belajar aktif', function () {
    $course  = Course::factory()->create(['is_published' => true]);
    $guide1  = HowToLearn::factory()->active()->create(['title' => 'Panduan Pertama']);
    $guide2  = HowToLearn::factory()->active()->create(['title' => 'Panduan Kedua']);
    $guide3  = HowToLearn::factory()->inactive()->create(['title' => 'Panduan Ketiga Nonaktif']);

    $course->howToLearns()->attach([$guide1->id, $guide2->id, $guide3->id]);

    $this->get(route('lms.course', $course->slug))
        ->assertSee('Panduan Pertama')
        ->assertSee('Panduan Kedua')
        ->assertDontSee('Panduan Ketiga Nonaktif');
});

// ─── Relasi many-to-many ──────────────────────────────────────────────────────

test('satu panduan dapat dimiliki banyak courses', function () {
    $guide   = HowToLearn::factory()->active()->create();
    $course1 = Course::factory()->create(['is_published' => true]);
    $course2 = Course::factory()->create(['is_published' => true]);

    $guide->courses()->attach([$course1->id, $course2->id]);

    expect($guide->courses()->count())->toBe(2);
});

test('satu course dapat memiliki banyak panduan', function () {
    $course = Course::factory()->create(['is_published' => true]);
    $guides = HowToLearn::factory()->active()->count(3)->create();

    $course->howToLearns()->attach($guides->pluck('id'));

    expect($course->howToLearns()->count())->toBe(3);
});

test('pivot course_how_to_learn mencegah duplikasi', function () {
    $course = Course::factory()->create();
    $guide  = HowToLearn::factory()->create();

    $course->howToLearns()->attach($guide->id);

    expect(fn () => $course->howToLearns()->attach($guide->id))
        ->toThrow(\Illuminate\Database\QueryException::class);
});

test('menghapus relasi tanpa menghapus panduan atau course', function () {
    $course = Course::factory()->create();
    $guide  = HowToLearn::factory()->create();
    $course->howToLearns()->attach($guide->id);

    $course->howToLearns()->detach($guide->id);

    expect($course->howToLearns()->count())->toBe(0);
    expect(Course::find($course->id))->not->toBeNull();
    expect(HowToLearn::find($guide->id))->not->toBeNull();
});

// ─── Model HowToLearn ─────────────────────────────────────────────────────────

test('howToLearn default is_active adalah true', function () {
    $guide = HowToLearn::factory()->create();

    expect($guide->is_active)->toBeTrue();
});

test('howToLearn dapat dibuat dengan factory inactive', function () {
    $guide = HowToLearn::factory()->inactive()->create();

    expect($guide->is_active)->toBeFalse();
});

test('howToLearn menyimpan konten markdown dengan benar', function () {
    $markdown = "## Judul\n\nIni adalah **konten** markdown.";
    $guide    = HowToLearn::factory()->create(['content' => $markdown]);

    expect(HowToLearn::find($guide->id)->content)->toBe($markdown);
});

test('howToLearn fillable fields tersimpan dengan benar', function () {
    $guide = HowToLearn::create([
        'title'       => 'Test Title',
        'description' => 'Test Description',
        'content'     => '## Content',
        'is_active'   => false,
    ]);

    expect($guide->title)->toBe('Test Title');
    expect($guide->description)->toBe('Test Description');
    expect($guide->content)->toBe('## Content');
    expect($guide->is_active)->toBeFalse();
});
