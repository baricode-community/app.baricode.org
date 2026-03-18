<x-layouts.base :title="$repoHub->title . ' — RepoHub'">
    <div class="max-w-4xl mx-auto px-4 py-12">
        <!-- Breadcrumb -->
        <nav class="flex items-center gap-2 text-sm text-purple-400 mb-8">
            <a href="{{ route('repohub.index') }}" class="hover:text-purple-300 transition">RepoHub</a>
            <svg class="w-4 h-4 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
            </svg>
            <span class="text-gray-400 truncate">{{ $repoHub->title }}</span>
        </nav>

        <!-- Header Card -->
        <div class="bg-gradient-to-br from-purple-900/40 via-indigo-900/30 to-gray-900/40 backdrop-blur border border-purple-500/30 rounded-3xl p-8 mb-8">
            <!-- Tags -->
            @if($repoHub->tags->count() > 0)
                <div class="flex flex-wrap gap-2 mb-5">
                    @foreach($repoHub->tags as $tag)
                        <a href="{{ route('repohub.index', ['tag' => $tag->slug]) }}"
                            class="px-3 py-1 bg-purple-500/20 border border-purple-500/40 text-purple-300 rounded-full text-sm font-medium hover:bg-purple-500/30 transition">
                            # {{ $tag->name }}
                        </a>
                    @endforeach
                </div>
            @endif

            <h1 class="text-3xl md:text-4xl font-extrabold text-white mb-4">{{ $repoHub->title }}</h1>
            <p class="text-gray-300 text-lg leading-relaxed mb-6">{{ $repoHub->description }}</p>

            <!-- Action Buttons -->
            <div class="flex flex-wrap gap-3">
                <a href="{{ $repoHub->repo_url }}" target="_blank" rel="noopener noreferrer"
                    class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-purple-600 to-indigo-600 rounded-xl font-semibold hover:from-purple-500 hover:to-indigo-500 transition shadow-lg hover:shadow-purple-500/30">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"/>
                    </svg>
                    Lihat di GitHub
                </a>
                @if($repoHub->demo_url)
                    <a href="{{ $repoHub->demo_url }}" target="_blank" rel="noopener noreferrer"
                        class="inline-flex items-center gap-2 px-6 py-3 bg-white/10 border border-white/20 rounded-xl font-semibold hover:bg-white/20 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                        </svg>
                        Live Demo
                    </a>
                @endif
            </div>
        </div>

        <!-- Why We Recommend -->
        <div class="bg-white/5 backdrop-blur border border-white/10 rounded-3xl p-8 mb-8">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 rounded-full bg-gradient-to-r from-green-500 to-emerald-500 flex items-center justify-center text-lg">
                    ✨
                </div>
                <h2 class="text-xl font-bold text-white">Kenapa Kami Rekomendasikan?</h2>
            </div>
            <p class="text-gray-300 leading-relaxed text-lg">{{ $repoHub->why_recommended }}</p>
        </div>

        <!-- Back link -->
        <div class="text-center">
            <a href="{{ route('repohub.index') }}" class="inline-flex items-center gap-2 text-purple-400 hover:text-purple-300 transition font-medium">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Kembali ke RepoHub
            </a>
        </div>
    </div>
</x-layouts.base>
