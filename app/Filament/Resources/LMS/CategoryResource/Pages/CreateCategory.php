<?php

namespace App\Filament\Resources\LMS\CategoryResource\Pages;

use App\Filament\Resources\LMS\CategoryResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCategory extends CreateRecord
{
    protected static string $resource = CategoryResource::class;

    public function mount(): void
    {
        parent::mount();

        // Pre-fill course_id from query parameter
        $courseId = request()->query('course');
        if ($courseId) {
            $this->form->fill([
                'course_id' => $courseId,
            ]);
        }
    }
}
