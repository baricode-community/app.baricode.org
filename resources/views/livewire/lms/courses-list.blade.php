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
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0"/>
                </svg>
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
                            <svg class="w-20 h-20 text-white mx-auto mb-2 group-hover:scale-110 transition duration-300" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"/>
                            </svg>
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
                                <svg class="w-4 h-4 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M2 6a2 2 0 012-2h12a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zm2 1a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2h-1z"/>
                                </svg>
                                {{ $course->categories->count() }} Modul
                            </span>
                            <span class="flex items-center gap-1">
                                <svg class="w-4 h-4 text-orange-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"/>
                                </svg>
                                {{ $course->categories->sum(fn ($cat) => $cat->lessons->count()) }} Lessons
                            </span>
                        </div>

                        <div class="inline-block px-3 py-1 bg-green-500/10 border border-green-500/30 rounded-full text-green-400 text-xs font-semibold mb-4">
                            ✓ Gratis
                        </div>

                        <div class="pt-4 border-t border-purple-500/20 flex items-center justify-between">
                            <span class="text-xs text-purple-400">Klik untuk membuka →</span>
                            <div class="group-hover:translate-x-1 transition">
                                <svg class="w-5 h-5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
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
            <svg class="w-24 h-24 mx-auto text-purple-700 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
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
