<x-layouts.dashboard :title="__('Baricode LMS - ' . $category->title)">
    <div class="max-w-7xl mx-auto px-4 py-8">
        <!-- Breadcrumb -->
        <div class="mb-6 flex items-center text-sm text-purple-400">
            <a href="{{ route('lms.index') }}" class="text-purple-300 hover:text-purple-200 transition">LMS</a>
            <span class="mx-2">/</span>
            <a href="{{ route('lms.course', $course->slug) }}"
                class="text-purple-300 hover:text-purple-200 transition">{{ $course->title }}</a>
            <span class="mx-2">/</span>
            <span class="text-purple-500">{{ $category->title }}</span>
        </div>

        <!-- Category Header -->
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-white mb-2">{{ $category->title }}</h1>
            @if ($category->description)
                <p class="text-purple-300 text-lg">{{ $category->description }}</p>
            @endif
        </div>

        <!-- Course Info Card -->
        <div class="bg-white/5 backdrop-blur-lg border border-purple-500/20 rounded-lg px-6 py-4 mb-8">
            <div class="flex items-center gap-2">
                <svg class="w-5 h-5 text-purple-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M12.316 3.051a1 1 0 01.633 1.265l-4 12a1 1 0 11-1.898-.632l4-12a1 1 0 011.265-.633zM5.707 6.293a1 1 0 010 1.414L3.414 10l2.293 2.293a1 1 0 11-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0zm8.586 0a1 1 0 011.414 0l3 3a1 1 0 010 1.414l-3 3a1 1 0 11-1.414-1.414L16.586 10l-2.293-2.293a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg>
                <span class="text-purple-300 font-semibold">Course: {{ $course->title }}</span>
            </div>
        </div>

        <!-- Lessons List -->
        <div class="bg-white/5 backdrop-blur-lg rounded-lg border border-purple-500/20 overflow-hidden">
            <!-- Section Header -->
            <div class="bg-gradient-to-r from-purple-700 to-indigo-700 px-6 py-4">
                <h2 class="text-xl font-bold text-white">Lessons</h2>
            </div>

            <!-- Lessons -->
            <div class="divide-y divide-purple-500/10">
                @forelse($lessons as $lesson)
                    <a href="{{ route('lms.lesson', $lesson) }}"
                        class="flex items-start justify-between px-6 py-4 hover:bg-purple-500/10 transition group">
                        <div class="flex items-start gap-4 flex-1">
                            <!-- Lesson Number -->
                            <div class="flex-shrink-0">
                                <div
                                    class="flex items-center justify-center w-9 h-9 rounded-full bg-purple-600/40 border border-purple-500/40 text-purple-200 font-bold text-sm">
                                    {{ $loop->iteration }}
                                </div>
                            </div>

                            <!-- Lesson Info -->
                            <div class="flex-1">
                                <h3 class="text-lg font-semibold text-white group-hover:text-purple-300 transition">
                                    {{ $lesson->title }}</h3>
                                @if ($lesson->description)
                                    <p class="text-purple-400 text-sm mt-1">{{ $lesson->description }}</p>
                                @endif
                            </div>
                        </div>

                        <!-- Duration and Arrow -->
                        <div class="ml-4 flex items-center gap-3">
                            @if ($lesson->duration)
                                <span
                                    class="px-3 py-1 bg-purple-500/20 text-purple-300 text-sm rounded border border-purple-500/20 whitespace-nowrap">
                                    {{ $lesson->duration }} min
                                </span>
                            @endif
                            <svg class="w-5 h-5 text-purple-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7"></path>
                            </svg>
                        </div>
                    </a>
                @empty
                    <div class="px-6 py-12 text-center text-purple-400">
                        <svg class="w-16 h-16 mx-auto text-purple-700 mb-4" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                        <p class="text-lg">No lessons available in this category yet.</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Navigation -->
        <div class="mt-8">
            <a href="{{ route('lms.course', $course->slug) }}"
                class="inline-flex items-center px-4 py-2 bg-white/5 hover:bg-white/10 border border-purple-500/20 hover:border-purple-500/40 text-purple-300 hover:text-purple-200 rounded-lg transition">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7">
                    </path>
                </svg>
                Back to Course
            </a>
        </div>
    </div>
</x-layouts.dashboard>
