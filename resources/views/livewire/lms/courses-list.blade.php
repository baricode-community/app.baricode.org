<?php

use App\Models\LMS\Course;
use Livewire\Attributes\Url;
use Livewire\Volt\Component;
use Livewire\WithPagination;

new class extends Component {
    use WithPagination;

    #[Url(as: 'search')]
    public string $search = '';

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function with(): array
    {
        $courses = Course::with(['categories.lessons' => function ($query) {
            $query->where('is_published', true)->orderBy('order');
        }])
            ->where('is_published', true)
            ->when($this->search, fn ($query) => $query->where(function ($q) {
                $q->where('title', 'like', "%{$this->search}%")
                    ->orWhere('description', 'like', "%{$this->search}%");
            }))
            ->paginate(12);

        return compact('courses');
    }
}; ?>

<div>
    {{-- Search --}}
    <div class="mb-12">
        <div class="relative group max-w-2xl">
            <input
                wire:model.live.debounce.300ms="search"
                type="text"
                placeholder="Cari kursus berdasarkan judul atau deskripsi..."
                class="w-full px-6 py-4 bg-white/5 backdrop-blur-lg border-2 border-purple-500/30 rounded-lg text-white placeholder-purple-400 focus:outline-none focus:border-purple-500 focus:ring-2 focus:ring-purple-500/50 transition"
            >
            <div class="absolute right-3 top-1/2 -translate-y-1/2 text-purple-400">
                <i data-lucide="search" class="w-5 h-5"></i>
            </div>
        </div>

        @if ($search)
            <div class="mt-4 p-4 bg-purple-500/10 border border-purple-500/30 rounded-lg flex items-center justify-between max-w-2xl">
                <p class="text-purple-300">Hasil pencarian untuk: <span class="font-bold text-white">{{ $search }}</span></p>
                <button wire:click="$set('search', '')" class="text-purple-400 hover:text-purple-300 text-sm">Bersihkan</button>
            </div>
        @endif
    </div>

    {{-- Courses Grid --}}
    @if ($courses->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
            @foreach ($courses as $course)
                <a
                    href="{{ route('lms.course', $course->slug) }}"
                    class="group bg-white/5 backdrop-blur-lg border border-purple-500/20 rounded-xl overflow-hidden hover:border-purple-500/60 hover:shadow-2xl hover:shadow-purple-500/20 transition duration-300 transform hover:scale-105 hover:-translate-y-1"
                >
                    <div class="relative h-48 bg-gradient-to-br from-purple-600 to-indigo-600 flex items-center justify-center overflow-hidden">
                        <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition duration-300">
                            <div class="absolute inset-0 bg-gradient-to-r from-purple-500 via-violet-500 to-indigo-500 animate-pulse"></div>
                        </div>
                        <div class="relative z-10 text-center">
                            <i data-lucide="bar-chart-2" class="w-20 h-20 text-white mx-auto mb-2 group-hover:scale-110 transition duration-300"></i>
                        </div>
                    </div>

                    <div class="p-6">
                        <h3 class="text-lg font-bold text-white group-hover:text-purple-300 transition mb-2 line-clamp-2">
                            {{ $course->title }}
                        </h3>
                        <p class="text-purple-300 text-sm mb-4 line-clamp-2">
                            {{ $course->description }}
                        </p>

                        <div class="flex items-center justify-between mb-4 text-xs text-purple-400">
                            <span class="flex items-center gap-1">
                                <i data-lucide="folder" class="w-4 h-4 text-blue-400"></i>
                                {{ $course->categories->count() }} Modul
                            </span>
                            <span class="flex items-center gap-1">
                                <i data-lucide="book-open" class="w-4 h-4 text-orange-400"></i>
                                {{ $course->categories->sum(fn ($cat) => $cat->lessons->count()) }} Lessons
                            </span>
                        </div>

                        <div class="inline-block px-3 py-1 bg-green-500/10 border border-green-500/30 rounded-full text-green-400 text-xs font-semibold mb-4">
                            ✓ Gratis
                        </div>

                        <div class="pt-4 border-t border-purple-500/20 flex items-center justify-between">
                            <span class="text-xs text-purple-400">Klik untuk membuka →</span>
                            <div class="group-hover:translate-x-1 transition">
                                <i data-lucide="chevron-right" class="w-5 h-5 text-purple-400"></i>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>

        <div class="flex justify-center">
            {{ $courses->links() }}
        </div>
    @else
        <div class="text-center py-16">
            <i data-lucide="frown" class="w-24 h-24 mx-auto text-purple-700 mb-6"></i>
            <h3 class="text-2xl font-bold text-white mb-2">Tidak Ada Kursus Ditemukan</h3>
            <p class="text-purple-300 mb-6">
                Maaf, tidak ada kursus yang sesuai dengan pencarian "<span class="font-semibold text-white">{{ $search }}</span>"
            </p>
            <button wire:click="$set('search', '')" class="inline-block px-6 py-3 bg-purple-600 hover:bg-purple-500 text-white rounded-lg transition">
                Lihat Semua Kursus
            </button>
        </div>
    @endif
</div>
