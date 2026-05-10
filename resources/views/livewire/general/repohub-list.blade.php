<?php

use App\Models\RepoHub\RepoHub;
use App\Models\RepoHub\RepoHubTag;
use Livewire\Attributes\Url;
use Livewire\Volt\Component;
use Livewire\WithPagination;

new class extends Component {
    use WithPagination;

    #[Url(as: 'q')]
    public string $search = '';

    #[Url(as: 'tag')]
    public string $tagSlug = '';

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function updatedTagSlug(): void
    {
        $this->resetPage();
    }

    public function setTag(string $slug): void
    {
        $this->tagSlug = $this->tagSlug === $slug ? '' : $slug;
        $this->resetPage();
    }

    public function resetFilters(): void
    {
        $this->search = '';
        $this->tagSlug = '';
        $this->resetPage();
    }

    public function with(): array
    {
        $tags = RepoHubTag::orderBy('name')->get();
        $activeTag = $this->tagSlug ? $tags->firstWhere('slug', $this->tagSlug) : null;

        $repos = RepoHub::published()
            ->with('tags')
            ->when($this->search, fn ($query) => $query->where(function ($q) {
                $q->where('title', 'like', "%{$this->search}%")
                    ->orWhere('description', 'like', "%{$this->search}%")
                    ->orWhere('why_recommended', 'like', "%{$this->search}%");
            }))
            ->when($activeTag, fn ($query) => $query->whereHas('tags', fn ($q) => $q->where('repo_hub_tags.id', $activeTag->id)))
            ->latest()
            ->paginate(12);

        return compact('tags', 'activeTag', 'repos');
    }
}; ?>

<div>
    {{-- Search --}}
    <form wire:submit.prevent class="flex gap-3 max-w-lg mx-auto mb-8">
        <input
            wire:model.live.debounce.300ms="search"
            type="text"
            placeholder="Cari repo..."
            class="flex-1 px-5 py-3 rounded-xl bg-white/10 border border-white/20 text-white placeholder-gray-400 focus:outline-none focus:border-purple-400 focus:bg-white/15 transition backdrop-blur"
        />
        @if ($search || $tagSlug)
            <button type="button" wire:click="resetFilters" class="px-4 py-3 bg-white/10 border border-white/20 rounded-xl hover:bg-white/20 transition text-gray-300 flex items-center">✕</button>
        @endif
    </form>

    {{-- Tags Filter --}}
    @if ($tags->count() > 0)
        <div class="flex flex-wrap gap-2 mb-8">
            <button
                wire:click="$set('tagSlug', '')"
                @class([
                    'px-4 py-2 rounded-full text-sm font-medium border transition',
                    'bg-purple-600 border-purple-600 text-white' => !$tagSlug,
                    'bg-white/5 border-white/20 text-gray-300 hover:border-purple-500 hover:text-white' => (bool) $tagSlug,
                ])
            >
                Semua
            </button>
            @foreach ($tags as $tag)
                <button
                    wire:click="setTag('{{ $tag->slug }}')"
                    @class([
                        'px-4 py-2 rounded-full text-sm font-medium border transition',
                        'bg-purple-600 border-purple-600 text-white' => $tagSlug === $tag->slug,
                        'bg-white/5 border-white/20 text-gray-300 hover:border-purple-500 hover:text-white' => $tagSlug !== $tag->slug,
                    ])
                >
                    {{ $tag->name }}
                </button>
            @endforeach
        </div>
    @endif

    {{-- Active filter info --}}
    @if ($search || $tagSlug)
        <div class="flex items-center gap-3 mb-6 text-sm text-gray-400">
            @if ($search)
                <span>Hasil untuk <strong class="text-white">"{{ $search }}"</strong></span>
            @endif
            @if ($activeTag)
                <span class="px-3 py-1 bg-purple-500/20 border border-purple-500/30 text-purple-300 rounded-full">
                    # {{ $activeTag->name }}
                </span>
            @endif
            <span>— {{ $repos->total() }} repo ditemukan</span>
        </div>
    @endif

    {{-- Grid --}}
    @if ($repos->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
            @foreach ($repos as $repo)
                <a href="{{ route('repohub.show', $repo->slug) }}"
                    class="group flex flex-col bg-white/5 backdrop-blur border border-white/10 rounded-2xl p-6 hover:border-purple-500/50 hover:bg-white/10 hover:shadow-xl hover:shadow-purple-500/10 transition-all">
                    @if ($repo->tags->count() > 0)
                        <div class="flex flex-wrap gap-1.5 mb-4">
                            @foreach ($repo->tags->take(3) as $tag)
                                <span class="px-2.5 py-0.5 bg-purple-500/20 border border-purple-500/30 text-purple-300 rounded-full text-xs font-medium">
                                    {{ $tag->name }}
                                </span>
                            @endforeach
                        </div>
                    @endif

                    <h2 class="text-lg font-bold text-white mb-2 group-hover:text-purple-300 transition line-clamp-2">
                        {{ $repo->title }}
                    </h2>
                    <p class="text-gray-400 text-sm flex-1 line-clamp-3 mb-4">
                        {{ $repo->description }}
                    </p>

                    <div class="flex items-center justify-between pt-4 border-t border-white/10">
                        <div class="flex items-center gap-1.5 text-gray-400 text-xs">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"/>
                            </svg>
                            <span class="truncate max-w-[140px]">{{ parse_url($repo->repo_url, PHP_URL_HOST) }}</span>
                        </div>
                        @if ($repo->demo_url)
                            <span class="text-xs text-green-400 font-medium">Live Demo</span>
                        @endif
                    </div>
                </a>
            @endforeach
        </div>

        @if ($repos->hasPages())
            <div class="flex justify-center">
                {{ $repos->links() }}
            </div>
        @endif
    @else
        <div class="text-center py-20">
            <div class="text-6xl mb-4">📭</div>
            <p class="text-gray-400 text-lg">Belum ada repo ditemukan</p>
            @if ($search || $tagSlug)
                <button wire:click="resetFilters" class="mt-4 inline-block text-purple-400 hover:text-purple-300 transition">
                    Lihat semua repo
                </button>
            @endif
        </div>
    @endif
</div>
