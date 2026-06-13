<x-layouts.dashboard :title="__('Baricode LMS - ' . $course->title)">
    <div class="max-w-7xl mx-auto px-4 py-8">
        <!-- Course Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <h1 class="text-2xl font-bold text-white mb-1.5">{{ $course->title }}</h1>
                    <p class="text-purple-300 text-sm">{{ $course->description }}</p>
                </div>
                @can('update', $course)
                    <a href="/admin/courses/{{ $course->id }}/edit"
                        class="inline-flex items-center px-4 py-2 bg-amber-500 hover:bg-amber-600 text-white rounded-lg transition font-medium">
                        <i data-lucide="pencil" class="w-5 h-5 mr-2"></i>
                        Edit
                    </a>
                @endcan
            </div>
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

        <!-- Enrollment Status -->
        @auth
            <div class="mb-8 bg-white/5 backdrop-blur-lg rounded-lg border border-purple-500/20 px-6 py-5">
                @if(!$enrollment)
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-white font-semibold">Bergabung dengan kursus ini</p>
                            <p class="text-purple-400 text-sm mt-1">Daftarkan diri dan tunggu persetujuan admin untuk mulai belajar.</p>
                        </div>
                        <form method="POST" action="{{ route('lms.enroll', $course->slug) }}">
                            @csrf
                            <button type="submit"
                                class="inline-flex items-center px-5 py-2.5 bg-purple-600 hover:bg-purple-500 text-white rounded-lg transition font-medium">
                                <i data-lucide="plus" class="w-5 h-5 mr-2"></i>
                                Daftar Kursus
                            </button>
                        </form>
                    </div>

                @elseif($enrollment->status === \App\Enums\LMS\EnrollmentStatus::Pending)
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <span class="px-3 py-1 bg-yellow-500/20 text-yellow-300 border border-yellow-500/30 rounded-full text-sm font-medium">
                                Menunggu Persetujuan
                            </span>
                            <p class="text-purple-300 text-sm">Permintaan enrollment kamu sedang ditinjau oleh admin.</p>
                        </div>
                    </div>

                @elseif($enrollment->status === \App\Enums\LMS\EnrollmentStatus::Active)
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <span class="px-3 py-1 bg-green-500/20 text-green-300 border border-green-500/30 rounded-full text-sm font-medium">
                                Terdaftar Aktif
                            </span>
                            @if($enrollment->approved_at)
                                <p class="text-purple-400 text-sm">Sejak {{ $enrollment->approved_at->format('d M Y') }}</p>
                            @endif
                        </div>
                        <form method="POST" action="{{ route('lms.unenroll', $course->slug) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                onclick="return confirm('Yakin ingin mengajukan permintaan keluar dari kursus ini?')"
                                class="inline-flex items-center px-4 py-2 bg-red-500/20 hover:bg-red-500/30 text-red-300 border border-red-500/30 rounded-lg transition text-sm">
                                Ajukan Keluar
                            </button>
                        </form>
                    </div>

                @elseif($enrollment->status === \App\Enums\LMS\EnrollmentStatus::UnenrollRequested)
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <span class="px-3 py-1 bg-orange-500/20 text-orange-300 border border-orange-500/30 rounded-full text-sm font-medium">
                                Permintaan Keluar Dikirim
                            </span>
                            <p class="text-purple-400 text-sm">Menunggu persetujuan admin.</p>
                        </div>
                        <form method="POST" action="{{ route('lms.unenroll.cancel', $course->slug) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 bg-white/5 hover:bg-white/10 text-purple-300 border border-purple-500/20 rounded-lg transition text-sm">
                                Batalkan Permintaan
                            </button>
                        </form>
                    </div>

                @elseif($enrollment->status === \App\Enums\LMS\EnrollmentStatus::Completed)
                    <div class="flex items-center gap-3">
                        <span class="px-3 py-1 bg-blue-500/20 text-blue-300 border border-blue-500/30 rounded-full text-sm font-medium">
                            ✓ Kursus Selesai
                        </span>
                        @if($enrollment->completed_at)
                            <p class="text-purple-400 text-sm">Diselesaikan pada {{ $enrollment->completed_at->format('d M Y') }}</p>
                        @endif
                    </div>

                @elseif($enrollment->status === \App\Enums\LMS\EnrollmentStatus::Rejected)
                    <div class="flex items-center justify-between">
                        <div>
                            <span class="px-3 py-1 bg-red-500/20 text-red-300 border border-red-500/30 rounded-full text-sm font-medium">
                                Enrollment Ditolak
                            </span>
                            @if($enrollment->rejection_reason)
                                <p class="text-purple-400 text-sm mt-2">Alasan: {{ $enrollment->rejection_reason }}</p>
                            @endif
                        </div>
                        <form method="POST" action="{{ route('lms.enroll', $course->slug) }}">
                            @csrf
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 bg-purple-600 hover:bg-purple-500 text-white rounded-lg transition text-sm">
                                Daftar Ulang
                            </button>
                        </form>
                    </div>
                @endif
            </div>
        @endauth

        <!-- How To Learn Guides -->
        @if($howToLearns->isNotEmpty())
            <div class="mb-8">
                <h2 class="text-lg font-bold text-white mb-3 flex items-center gap-2">
                    <i data-lucide="book-open" class="w-6 h-6 text-purple-400"></i>
                    Panduan Belajar
                </h2>

                <div class="grid gap-4">
                    @foreach($howToLearns as $guide)
                        <div x-data="{ open: false }"
                             class="bg-white/5 backdrop-blur-lg rounded-lg border border-purple-500/20 overflow-hidden">

                            {{-- Header (clickable toggle) --}}
                            <button type="button"
                                @click="open = !open"
                                class="w-full flex items-start justify-between px-6 py-4 text-left hover:bg-purple-500/10 transition">
                                <div class="flex-1 pr-4">
                                    <h3 class="text-sm font-semibold text-white">{{ $guide->title }}</h3>
                                    @if($guide->description)
                                        <p class="text-purple-400 text-xs mt-0.5">{{ $guide->description }}</p>
                                    @endif
                                </div>
                                <i data-lucide="chevron-down" class="w-5 h-5 text-purple-400 flex-shrink-0 mt-1 transition-transform duration-200" :class="open ? 'rotate-180' : ''"></i>
                            </button>

                            {{-- Markdown content (collapsible) --}}
                            <div x-show="open"
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="opacity-0 -translate-y-2"
                                 x-transition:enter-end="opacity-100 translate-y-0"
                                 x-transition:leave="transition ease-in duration-150"
                                 x-transition:leave-start="opacity-100 translate-y-0"
                                 x-transition:leave-end="opacity-0 -translate-y-2"
                                 class="border-t border-purple-500/20 px-6 py-5">
                                <div class="prose prose-invert prose-purple max-w-none
                                            prose-headings:text-white prose-headings:font-bold
                                            prose-h2:text-base prose-h3:text-sm
                                            prose-p:text-purple-200 prose-p:leading-relaxed
                                            prose-a:text-purple-400 prose-a:no-underline hover:prose-a:text-purple-300
                                            prose-strong:text-white
                                            prose-code:text-purple-300 prose-code:bg-purple-900/40 prose-code:px-1.5 prose-code:py-0.5 prose-code:rounded prose-code:text-sm prose-code:font-mono
                                            prose-pre:bg-gray-900/80 prose-pre:border prose-pre:border-purple-500/20 prose-pre:rounded-lg
                                            prose-blockquote:border-l-purple-500 prose-blockquote:text-purple-300 prose-blockquote:bg-purple-900/20 prose-blockquote:rounded-r-lg prose-blockquote:py-1
                                            prose-ul:text-purple-200 prose-ol:text-purple-200
                                            prose-li:marker:text-purple-400
                                            prose-hr:border-purple-500/30
                                            prose-table:text-purple-200 prose-th:text-white prose-th:border-purple-500/30 prose-td:border-purple-500/20">
                                    {!! \Illuminate\Support\Str::markdown($guide->content, [
                                        'html_input'         => 'strip',
                                        'allow_unsafe_links' => false,
                                    ]) !!}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Categories and Lessons -->
        <div class="grid gap-6">
            @forelse($categories as $category)
                @php
                    $catProgress = $categoryProgressMap->get($category->id);
                @endphp
                <div class="bg-white/5 backdrop-blur-lg rounded-lg border border-purple-500/20 overflow-hidden">
                    <!-- Category Header -->
                    <div class="bg-gradient-to-r from-purple-700 to-indigo-700 px-6 py-4 flex items-center justify-between">
                        <div>
                            <h2 class="text-base font-bold text-white">{{ $category->title }}</h2>
                            @if ($category->description)
                                <p class="text-purple-200 text-sm mt-1">{{ $category->description }}</p>
                            @endif
                        </div>
                        @if($catProgress)
                            @php
                                $badgeClass = match($catProgress->status) {
                                    \App\Enums\LMS\CategoryProgressStatus::Approved => 'bg-green-500/20 text-green-300 border-green-500/40',
                                    \App\Enums\LMS\CategoryProgressStatus::Submitted => 'bg-yellow-500/20 text-yellow-300 border-yellow-500/40',
                                    default => 'bg-white/10 text-white/60 border-white/20',
                                };
                            @endphp
                            <span class="px-3 py-1 text-xs font-medium rounded-full border {{ $badgeClass }}">
                                {{ $catProgress->status->label() }}
                            </span>
                        @endif
                    </div>

                    <!-- Lessons List -->
                    <div class="divide-y divide-purple-500/10">
                        @forelse($category->lessons as $lesson)
                            <div class="flex items-center px-6 py-4 hover:bg-purple-500/10 transition group">
                                <a href="{{ route('lms.lesson', $lesson) }}" class="flex-1 min-w-0">
                                    <h3 class="text-sm font-semibold text-white group-hover:text-purple-300 transition">
                                        {{ $lesson->title }}</h3>
                                    @if ($lesson->description)
                                        <p class="text-purple-400 text-sm mt-1">{{ $lesson->description }}</p>
                                    @endif
                                </a>
                                <div class="ml-4 flex items-center gap-2 shrink-0">
                                    @if ($lesson->duration)
                                        <span class="px-3 py-1 bg-purple-500/20 text-purple-300 text-sm rounded border border-purple-500/20">
                                            {{ $lesson->duration }} min
                                        </span>
                                    @endif
                                    @can('update', $lesson)
                                        <a href="/admin/lessons/{{ $lesson->id }}/edit"
                                            class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-amber-500/20 hover:bg-amber-500/40 text-amber-300 border border-amber-500/30 rounded-lg transition text-sm font-medium">
                                            <i data-lucide="pencil" class="w-4 h-4"></i>
                                            Edit
                                        </a>
                                    @endcan
                                </div>
                            </div>
                        @empty
                            <div class="px-6 py-8 text-center text-purple-400">
                                No lessons available in this category
                            </div>
                        @endforelse
                    </div>
                </div>
            @empty
                <div class="bg-white/5 backdrop-blur-lg rounded-lg border border-purple-500/20 px-6 py-12 text-center">
                    <p class="text-purple-300 text-sm">No categories available for this course yet.</p>
                </div>
            @endforelse
        </div>
    </div>
</x-layouts.dashboard>
