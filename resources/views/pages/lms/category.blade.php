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
            <div class="flex items-center gap-4 mb-2">
                <h1 class="text-4xl font-bold text-white">{{ $category->title }}</h1>
                @if($categoryProgress)
                    @php
                        $badgeClass = match($categoryProgress->status) {
                            \App\Enums\LMS\CategoryProgressStatus::Approved => 'bg-green-500/20 text-green-300 border-green-500/40',
                            \App\Enums\LMS\CategoryProgressStatus::Submitted => 'bg-yellow-500/20 text-yellow-300 border-yellow-500/40',
                            \App\Enums\LMS\CategoryProgressStatus::Rejected => 'bg-red-500/20 text-red-300 border-red-500/40',
                            default => 'bg-white/10 text-white/60 border-white/20',
                        };
                    @endphp
                    <span class="px-3 py-1 text-sm font-medium rounded-full border {{ $badgeClass }}">
                        {{ $categoryProgress->status->label() }}
                    </span>
                @endif
            </div>
            @if ($category->description)
                <p class="text-purple-300 text-lg">{{ $category->description }}</p>
            @endif
        </div>

        <!-- Flash Messages -->
        @if(session('success'))
            <div class="mb-6 px-4 py-3 bg-green-500/20 border border-green-500/40 rounded-lg text-green-300">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="mb-6 px-4 py-3 bg-red-500/20 border border-red-500/40 rounded-lg text-red-300">
                {{ session('error') }}
            </div>
        @endif

        <!-- Admin note if category was rejected -->
        @if($categoryProgress && $categoryProgress->status === \App\Enums\LMS\CategoryProgressStatus::InProgress && $categoryProgress->admin_note)
            <div class="mb-6 px-4 py-3 bg-orange-500/10 border border-orange-500/30 rounded-lg">
                <p class="text-orange-300 text-sm font-medium mb-1">Catatan dari Admin:</p>
                <p class="text-orange-200 text-sm">{{ $categoryProgress->admin_note }}</p>
            </div>
        @endif

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
            <div class="bg-gradient-to-r from-purple-700 to-indigo-700 px-6 py-4 flex items-center justify-between">
                <h2 class="text-xl font-bold text-white">Lessons</h2>
                @if($categoryProgress && $categoryProgress->status === \App\Enums\LMS\CategoryProgressStatus::Approved)
                    <span class="text-sm text-green-300 flex items-center gap-1">
                        <i data-lucide="check-circle" class="w-4 h-4"></i>
                        Kategori Disetujui &amp; Terkunci
                    </span>
                @endif
            </div>

            <!-- Lessons -->
            <div class="divide-y divide-purple-500/10">
                @forelse($lessons as $lesson)
                    @php
                        $lp = $lessonProgressMap->get($lesson->id);
                        $isCompleted = $lp && $lp->is_completed;
                    @endphp
                    <div class="flex items-start justify-between px-6 py-4 hover:bg-purple-500/10 transition group">
                        <a href="{{ route('lms.lesson', $lesson) }}" class="flex items-start gap-4 flex-1 min-w-0">
                            <!-- Lesson Number / Checkmark -->
                            <div class="flex-shrink-0">
                                @if($isCompleted)
                                    <div class="flex items-center justify-center w-9 h-9 rounded-full bg-green-600/40 border border-green-500/60 text-green-300">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                @else
                                    <div class="flex items-center justify-center w-9 h-9 rounded-full bg-purple-600/40 border border-purple-500/40 text-purple-200 font-bold text-sm">
                                        {{ $loop->iteration }}
                                    </div>
                                @endif
                            </div>

                            <!-- Lesson Info -->
                            <div class="flex-1 min-w-0">
                                <h3 class="text-lg font-semibold {{ $isCompleted ? 'text-green-300' : 'text-white' }} group-hover:text-purple-300 transition">
                                    {{ $lesson->title }}
                                </h3>
                                @if ($lesson->description)
                                    <p class="text-purple-400 text-sm mt-1">{{ $lesson->description }}</p>
                                @endif
                            </div>
                        </a>

                        <!-- Duration, Progress Toggle, and Arrow -->
                        <div class="ml-4 flex items-center gap-3 flex-shrink-0">
                            @if ($lesson->duration)
                                <span class="px-3 py-1 bg-purple-500/20 text-purple-300 text-sm rounded border border-purple-500/20 whitespace-nowrap">
                                    {{ $lesson->duration }} min
                                </span>
                            @endif

                            @if($enrollment)
                                @if($categoryProgress && $categoryProgress->isLocked())
                                    {{-- Category is locked, show lock icon --}}
                                    <span title="{{ $isCompleted ? 'Selesai & Terkunci' : 'Terkunci' }}"
                                        class="w-8 h-8 flex items-center justify-center rounded-full {{ $isCompleted ? 'text-green-400' : 'text-purple-600' }}">
                                        <i data-lucide="lock" class="w-5 h-5"></i>
                                    </span>
                                @else
                                    {{-- Toggle completion button --}}
                                    <form method="POST" action="{{ route('lms.lesson.progress.toggle', $lesson) }}">
                                        @csrf
                                        <button type="submit"
                                            title="{{ $isCompleted ? 'Batalkan selesai' : 'Tandai selesai' }}"
                                            class="w-8 h-8 flex items-center justify-center rounded-full border transition
                                                {{ $isCompleted
                                                    ? 'bg-green-600/30 border-green-500/60 text-green-300 hover:bg-red-500/20 hover:border-red-500/40 hover:text-red-300'
                                                    : 'bg-white/5 border-purple-500/30 text-purple-500 hover:bg-green-600/20 hover:border-green-500/40 hover:text-green-300' }}">
                                            @if($isCompleted)
                                                <i data-lucide="check" class="w-5 h-5"></i>
                                            @else
                                                <i data-lucide="check" class="w-5 h-5"></i>
                                            @endif
                                        </button>
                                    </form>
                                @endif
                            @endif

                            <a href="{{ route('lms.lesson', $lesson) }}">
                                <svg class="w-5 h-5 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="px-6 py-12 text-center text-purple-400">
                        <i data-lucide="file-text" class="w-16 h-16 mx-auto text-purple-700 mb-4"></i>
                        <p class="text-lg">No lessons available in this category yet.</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Submit Category for Approval -->
        @if($enrollment && $categoryProgress && $categoryProgress->status === \App\Enums\LMS\CategoryProgressStatus::InProgress)
            @php
                $totalLessons = $lessons->count();
                $completedLessons = $lessonProgressMap->where('is_completed', true)->count();
                $allDone = $totalLessons > 0 && $completedLessons >= $totalLessons;
            @endphp
            @if($allDone)
                <div class="mt-6 bg-green-500/10 border border-green-500/20 rounded-lg px-6 py-5">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-white font-semibold">Semua lesson selesai!</p>
                            <p class="text-green-300 text-sm mt-1">Ajukan persetujuan admin untuk menyelesaikan kategori ini.</p>
                        </div>
                        <form method="POST" action="{{ route('lms.category.progress.submit', $category->slug) }}">
                            @csrf
                            <button type="submit"
                                onclick="return confirm('Yakin ingin mengajukan persetujuan untuk kategori ini?')"
                                class="inline-flex items-center px-5 py-2.5 bg-green-600 hover:bg-green-500 text-white rounded-lg transition font-medium">
                                <i data-lucide="check-circle" class="w-5 h-5 mr-2"></i>
                                Ajukan Persetujuan
                            </button>
                        </form>
                    </div>
                </div>
            @else
                <div class="mt-6 bg-white/5 border border-purple-500/20 rounded-lg px-6 py-4">
                    <div class="flex items-center justify-between">
                        <p class="text-purple-400 text-sm">
                            Progress: <span class="text-white font-semibold">{{ $completedLessons }}/{{ $totalLessons }}</span> lesson selesai
                        </p>
                        <div class="w-48 bg-white/10 rounded-full h-2">
                            <div class="bg-purple-500 h-2 rounded-full" style="width: {{ $totalLessons > 0 ? ($completedLessons / $totalLessons * 100) : 0 }}%"></div>
                        </div>
                    </div>
                </div>
            @endif
        @elseif($enrollment && $categoryProgress && $categoryProgress->status === \App\Enums\LMS\CategoryProgressStatus::Submitted)
            <div class="mt-6 bg-yellow-500/10 border border-yellow-500/20 rounded-lg px-6 py-4">
                <p class="text-yellow-300 text-sm">Kategori ini sedang menunggu persetujuan admin. Kamu tidak dapat mengubah progress lesson sementara ini.</p>
            </div>
        @endif

        <!-- Navigation -->
        <div class="mt-8">
            <a href="{{ route('lms.course', $course->slug) }}"
                class="inline-flex items-center px-4 py-2 bg-white/5 hover:bg-white/10 border border-purple-500/20 hover:border-purple-500/40 text-purple-300 hover:text-purple-200 rounded-lg transition">
                <i data-lucide="chevron-left" class="w-5 h-5 mr-2"></i>
                Back to Course
            </a>
        </div>
    </div>
</x-layouts.dashboard>
