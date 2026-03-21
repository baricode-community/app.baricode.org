<x-layouts.dashboard :title="__('Baricode LMS - ' . $course->title)">
    <div class="max-w-7xl mx-auto px-4 py-8">
        <!-- Course Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <h1 class="text-4xl font-bold text-white mb-2">{{ $course->title }}</h1>
                    <p class="text-purple-300">{{ $course->description }}</p>
                </div>
                @can('update', $course)
                    <a href="/admin-lms/courses/{{ $course->id }}/edit"
                        class="inline-flex items-center px-4 py-2 bg-amber-500 hover:bg-amber-600 text-white rounded-lg transition font-medium">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                            </path>
                        </svg>
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
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                </svg>
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
                            <h2 class="text-xl font-bold text-white">{{ $category->title }}</h2>
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
                            <a href="{{ route('lms.lesson', $lesson) }}"
                                class="block px-6 py-4 hover:bg-purple-500/10 transition group">
                                <div class="flex items-start justify-between">
                                    <div class="flex-1">
                                        <h3
                                            class="text-lg font-semibold text-white group-hover:text-purple-300 transition">
                                            {{ $lesson->title }}</h3>
                                        @if ($lesson->description)
                                            <p class="text-purple-400 text-sm mt-1">{{ $lesson->description }}</p>
                                        @endif
                                    </div>
                                    <div class="ml-4 flex items-center gap-2">
                                        @can('update', $lesson)
                                            <a href="/admin-lms/lessons/{{ $lesson->id }}/edit"
                                                class="inline-flex items-center px-4 py-2 bg-amber-500 hover:bg-amber-600 text-white rounded-lg transition font-medium">
                                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                    </path>
                                                </svg>
                                                Edit
                                            </a>
                                        @endcan
                                        @if ($lesson->duration)
                                            <span
                                                class="px-3 py-1 bg-purple-500/20 text-purple-300 text-sm rounded border border-purple-500/20">
                                                {{ $lesson->duration }} min
                                            </span>
                                        @endif
                                        <svg class="w-5 h-5 text-purple-500" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5.951-1.429 5.951 1.429a1 1 0 001.169-1.409l-7-14z">
                                            </path>
                                        </svg>
                                    </div>
                                </div>
                            </a>
                        @empty
                            <div class="px-6 py-8 text-center text-purple-400">
                                No lessons available in this category
                            </div>
                        @endforelse
                    </div>
                </div>
            @empty
                <div class="bg-white/5 backdrop-blur-lg rounded-lg border border-purple-500/20 px-6 py-12 text-center">
                    <p class="text-purple-300 text-lg">No categories available for this course yet.</p>
                </div>
            @endforelse
        </div>
    </div>
</x-layouts.dashboard>
