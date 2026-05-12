<x-layouts.dashboard :title="__('Onboarding Tasks')">
    <div class="max-w-3xl mx-auto px-4 py-6 md:px-8 space-y-6">

        {{-- Header --}}
        <div class="flex items-center gap-4 pb-6 border-b border-purple-700/50">
            <a href="{{ route('dashboard') }}"
               class="text-purple-400 hover:text-purple-300 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </a>
            <div>
                <h1 class="text-white text-xl font-bold">Onboarding Tasks</h1>
                <p class="text-purple-300 text-sm">Semua langkah untuk memulai di Baricode</p>
            </div>
        </div>

        {{-- Task list --}}
        <div class="space-y-3">
            @forelse($tasks as $task)
                <a href="{{ route('dashboard.onboarding.show', $task->slug) }}"
                   class="flex items-center gap-4 bg-white/5 backdrop-blur-lg rounded-2xl border
                          {{ $task->is_completed ? 'border-emerald-500/30' : 'border-purple-500/20 hover:border-purple-400/40' }}
                          p-4 transition-all duration-200 hover:-translate-y-0.5 hover:shadow-lg group">

                    {{-- Status icon --}}
                    <div class="w-9 h-9 rounded-xl flex items-center justify-center flex-shrink-0
                                {{ $task->is_completed
                                    ? 'bg-gradient-to-br from-emerald-500 to-teal-500'
                                    : 'bg-white/10' }}">
                        @if($task->is_completed)
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                            </svg>
                        @elseif($task->icon)
                            <span class="text-lg">{{ $task->icon }}</span>
                        @else
                            <div class="w-3 h-3 rounded-full border-2 border-purple-400/50"></div>
                        @endif
                    </div>

                    {{-- Content --}}
                    <div class="flex-1 min-w-0">
                        <p class="font-semibold text-sm
                                  {{ $task->is_completed ? 'text-emerald-300 line-through' : 'text-white group-hover:text-purple-300' }}
                                  transition-colors">
                            {{ $task->title }}
                        </p>
                        @if($task->description)
                            <p class="text-purple-400 text-xs mt-0.5 truncate">{{ $task->description }}</p>
                        @endif
                    </div>

                    <svg class="w-4 h-4 text-purple-500 group-hover:text-purple-300 flex-shrink-0 transition-colors"
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            @empty
                <div class="text-center py-12 text-purple-400 text-sm">
                    Belum ada onboarding task yang aktif.
                </div>
            @endforelse
        </div>

    </div>
</x-layouts.dashboard>
