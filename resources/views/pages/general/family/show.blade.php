<x-layouts.base :title="$user->name">
    <div class="min-h-screen py-12 px-4">
        <div class="max-w-4xl mx-auto">
            <!-- Back Button -->
            <a href="{{ route('family.index') }}" class="inline-flex items-center text-indigo-400 hover:text-indigo-300 mb-8 transition-colors">
                ← Kembali ke Keluarga
            </a>

            <!-- Hero Section -->
            <div class="bg-gray-800/50 backdrop-blur-sm border border-gray-700 rounded-xl p-8 md:p-12 mb-8">
                <div class="flex flex-col md:flex-row items-center gap-8 md:gap-12">
                    <!-- Avatar -->
                    <div class="flex-shrink-0">
                        <div class="w-32 h-32 md:w-40 md:h-40 rounded-full bg-gradient-to-br from-purple-500 to-indigo-500 flex items-center justify-center shadow-lg shadow-indigo-500/40">
                            <span class="text-6xl md:text-7xl font-bold text-white">
                                {{ $user->initials() }}
                            </span>
                        </div>
                    </div>

                    <!-- Info -->
                    <div class="flex-1 text-center md:text-left">
                        <h1 class="text-4xl md:text-5xl font-extrabold text-white mb-2">
                            {{ $user->name }}
                        </h1>
                        <p class="text-gray-400">
                            Member sejak <span class="font-semibold text-indigo-300">{{ $user->created_at->format('F Y') }}</span>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Bio Section -->
            @if ($user->bio)
                <div class="bg-gray-800/50 backdrop-blur-sm border border-gray-700 rounded-xl p-6 md:p-8 mb-8">
                    <h2 class="text-xl font-bold text-white mb-4">Tentang</h2>
                    <p class="text-gray-300 text-lg leading-relaxed">
                        {{ $user->bio }}
                    </p>
                </div>
            @endif

            <!-- Stats Section -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <!-- Daily Commits -->
                <div class="bg-gray-800/50 backdrop-blur-sm border border-gray-700 rounded-xl p-6">
                    <div class="text-3xl font-bold text-indigo-400 mb-2">
                        {{ $user->dailyCommitTrackers->count() }}
                    </div>
                    <p class="text-gray-400">Daily Commits Tracked</p>
                </div>

                <!-- Events/Meets -->
                <div class="bg-gray-800/50 backdrop-blur-sm border border-gray-700 rounded-xl p-6">
                    <div class="text-3xl font-bold text-purple-400 mb-2">
                        {{ $user->meets->count() }}
                    </div>
                    <p class="text-gray-400">Events Attended</p>
                </div>

                <!-- Memes -->
                <div class="bg-gray-800/50 backdrop-blur-sm border border-gray-700 rounded-xl p-6">
                    <div class="text-3xl font-bold text-violet-400 mb-2">
                        @if ($user->meme)
                            1
                        @else
                            0
                        @endif
                    </div>
                    <p class="text-gray-400">Memes Shared</p>
                </div>
            </div>

            <!-- Meme Section -->
            @if ($user->meme)
                <div class="bg-gray-800/50 backdrop-blur-sm border border-gray-700 rounded-xl p-6 md:p-8 mb-8">
                    <h2 class="text-xl font-bold text-white mb-4">Featured Meme</h2>
                    <div class="bg-gray-900/50 rounded-lg overflow-hidden">
                        @if ($user->meme->image)
                            <img src="{{ $user->meme->image }}" alt="Meme" class="w-full max-h-96 object-cover">
                        @else
                            <div class="h-64 flex items-center justify-center text-gray-400">
                                No image available
                            </div>
                        @endif
                    </div>
                    @if ($user->meme->title)
                        <p class="text-gray-300 mt-4">
                            <span class="font-semibold">{{ $user->meme->title }}</span>
                        </p>
                    @endif
                </div>
            @endif

            <!-- Links Section -->
            <div class="flex justify-center gap-4">
                <a href="{{ route('family.index') }}" class="px-6 py-3 bg-gray-800/50 border border-gray-700 rounded-lg text-gray-300 hover:text-white hover:border-indigo-500 transition-colors">
                    ← Kembali
                </a>
            </div>
        </div>
    </div>
</x-layouts.base>
