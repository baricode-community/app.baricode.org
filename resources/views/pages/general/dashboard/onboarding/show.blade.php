<x-layouts.dashboard :title="$task->title">
    <div class="max-w-3xl mx-auto px-4 py-6 md:px-8 space-y-6">

        {{-- Navigation --}}
        <div class="flex items-center gap-3">
            <a href="{{ route('dashboard') }}"
               class="text-purple-400 hover:text-purple-300 transition-colors text-xs flex items-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Dashboard
            </a>
            <span class="text-purple-600 text-xs">/</span>
            <a href="{{ route('dashboard.onboarding.index') }}"
               class="text-purple-400 hover:text-purple-300 transition-colors text-xs">
                Onboarding
            </a>
            <span class="text-purple-600 text-xs">/</span>
            <span class="text-purple-300 text-xs truncate">{{ $task->title }}</span>
        </div>

        {{-- Task header --}}
        <div class="bg-white/5 backdrop-blur-lg rounded-2xl border border-purple-500/20 p-6">
            <div class="flex items-start gap-4">
                @if($task->icon)
                    <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-purple-500 to-indigo-600 flex items-center justify-center text-2xl flex-shrink-0">
                        {{ $task->icon }}
                    </div>
                @endif
                <div class="flex-1 min-w-0">
                    <h1 class="text-white text-xl font-bold leading-tight">{{ $task->title }}</h1>
                    @if($task->description)
                        <p class="text-purple-300 text-sm mt-1">{{ $task->description }}</p>
                    @endif
                </div>
                @if($isCompleted)
                    <span class="flex-shrink-0 inline-flex items-center gap-1.5 px-3 py-1 bg-emerald-500/20 border border-emerald-500/30 rounded-full text-emerald-300 text-xs font-medium">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                        </svg>
                        Selesai
                    </span>
                @endif
            </div>

            {{-- Toggle button --}}
            <form method="POST" action="{{ route('dashboard.onboarding.toggle', $task->slug) }}" class="mt-5 pt-5 border-t border-white/5">
                @csrf
                <button type="submit"
                        class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl text-sm font-semibold transition-all duration-200
                               {{ $isCompleted
                                    ? 'bg-white/5 hover:bg-white/10 border border-purple-500/20 hover:border-purple-400/40 text-purple-300'
                                    : 'bg-gradient-to-r from-purple-600 to-indigo-600 hover:shadow-lg hover:shadow-purple-500/30 text-white' }}">
                    @if($isCompleted)
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                        Tandai Belum Selesai
                    @else
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                        </svg>
                        Tandai Selesai
                    @endif
                </button>
            </form>
        </div>

        {{-- Markdown content --}}
        <div class="bg-white/5 backdrop-blur-lg rounded-2xl border border-purple-500/20 p-6">
            <div class="prose prose-invert prose-sm max-w-none
                        prose-headings:text-white prose-headings:font-bold
                        prose-p:text-purple-200 prose-p:leading-relaxed
                        prose-a:text-purple-400 prose-a:no-underline hover:prose-a:text-purple-300
                        prose-strong:text-white
                        prose-code:text-purple-300 prose-code:bg-white/10 prose-code:px-1.5 prose-code:py-0.5 prose-code:rounded
                        prose-pre:bg-white/5 prose-pre:border prose-pre:border-purple-500/20
                        prose-blockquote:border-purple-500/50 prose-blockquote:text-purple-300
                        prose-li:text-purple-200
                        prose-hr:border-purple-500/20">
                {!! Str::markdown($task->content, ['html_input' => 'strip']) !!}
            </div>
        </div>

    </div>
</x-layouts.dashboard>
