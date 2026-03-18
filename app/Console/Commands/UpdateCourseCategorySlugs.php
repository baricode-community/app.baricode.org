<?php

namespace App\Console\Commands;

use App\Models\LMS\CourseCategory;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class UpdateCourseCategorySlugs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-course-category-slugs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate and update slugs for all course categories';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $categories = CourseCategory::all();
        $count = 0;

        foreach ($categories as $category) {
            $slug = Str::slug($category->title);

            if ($category->slug !== $slug) {
                $category->update(['slug' => $slug]);
                $this->line("Updated: {$category->title} → {$slug}");
                $count++;
            }
        }

        $this->info("✓ Berhasil update {$count} kategori dengan slug!");
        $this->info("Total kategori: {$categories->count()}");
    }
}
