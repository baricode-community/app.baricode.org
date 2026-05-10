<?php

use App\Models\CheatSheet;
use App\Models\CheatSheetCategory;
use Livewire\Attributes\Url;
use Livewire\Volt\Component;
use Livewire\WithPagination;

new class extends Component {
    use WithPagination;

    #[Url(as: 'q')]
    public string $search = '';

    #[Url(as: 'category')]
    public string $categoryId = '';

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function updatedCategoryId(): void
    {
        $this->resetPage();
    }

    public function resetFilters(): void
    {
        $this->search = '';
        $this->categoryId = '';
        $this->resetPage();
    }

    public function with(): array
    {
        $publicSheets = CheatSheet::query()
            ->with(['user:id,name,username', 'category'])
            ->where('is_public', true)
            ->when(auth()->check(), fn ($q) => $q->where('user_id', '!=', auth()->id()))
            ->when($this->search, fn ($q) => $q->where(function ($query) {
                $query->where('title', 'like', "%{$this->search}%")
                    ->orWhere('description', 'like', "%{$this->search}%");
            }))
            ->when($this->categoryId, fn ($q) => $q->where('cheat_sheet_category_id', $this->categoryId))
            ->latest()
            ->paginate(12);

        $mySheets = null;
        if (auth()->check()) {
            $mySheets = CheatSheet::query()
                ->with('category')
                ->where('user_id', auth()->id())
                ->when($this->search, fn ($q) => $q->where(function ($query) {
                    $query->where('title', 'like', "%{$this->search}%")
                        ->orWhere('description', 'like', "%{$this->search}%");
                }))
                ->when($this->categoryId, fn ($q) => $q->where('cheat_sheet_category_id', $this->categoryId))
                ->latest()
                ->get();
        }

        $categories = CheatSheetCategory::orderBy('name')->get();

        return compact('publicSheets', 'mySheets', 'categories');
    }
}; ?>

<div class="space-y-8">
    {{-- Filter --}}
    <div class="flex flex-col sm:flex-row gap-3">
        <div class="relative flex-1">
            <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0"/>
            </svg>
            <input
                wire:model.live.debounce.300ms="search"
                type="text"
                placeholder="Cari cheat sheet..."
                class="w-full pl-10 pr-4 py-2.5 bg-white/5 border border-purple-500/20 rounded-xl text-white placeholder-purple-400 text-sm focus:outline-none focus:border-purple-400/60 transition-colors"
            >
        </div>
        <select
            wire:model.live="categoryId"
            class="px-4 py-2.5 bg-white/5 border border-purple-500/20 rounded-xl text-white text-sm focus:outline-none focus:border-purple-400/60 transition-colors min-w-[180px]"
        >
            <option value="" class="bg-gray-900">Semua Kategori</option>
            @foreach ($categories as $cat)
                <option value="{{ $cat->id }}" class="bg-gray-900">{{ $cat->name }}</option>
            @endforeach
        </select>
        @if ($search || $categoryId)
            <button
                wire:click="resetFilters"
                class="px-4 py-2.5 bg-white/5 hover:bg-white/10 border border-purple-500/20 rounded-xl text-purple-300 text-sm transition-colors text-center"
            >
                Reset
            </button>
        @endif
    </div>

    {{-- My Cheat Sheets --}}
    @auth
        <div>
            <div class="flex items-center justify-between mb-3">
                <h2 class="text-purple-300 text-xs font-semibold uppercase tracking-wider">Milik Saya</h2>
                <span class="text-purple-500 text-xs">{{ $mySheets->count() }} cheat sheet</span>
            </div>

            @if ($mySheets->isNotEmpty())
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach ($mySheets as $sheet)
                        <div class="bg-white/5 backdrop-blur-lg rounded-2xl border border-purple-500/20 hover:border-purple-400/40 p-5 transition-all duration-200 hover:-translate-y-0.5 hover:shadow-lg hover:shadow-purple-500/10 flex flex-col">
                            <div class="flex items-start justify-between gap-2 mb-2">
                                @if ($sheet->category)
                                    <span class="text-xs px-2 py-0.5 rounded-full bg-purple-500/20 text-purple-300 border border-purple-500/30 truncate max-w-[130px]">
                                        {{ $sheet->category->name }}
                                    </span>
                                @endif
                                @if (!$sheet->is_public)
                                    <span class="text-xs px-2 py-0.5 rounded-full bg-amber-500/20 text-amber-300 border border-amber-500/30 flex-shrink-0 ml-auto">
                                        Privat
                                    </span>
                                @else
                                    <span class="text-xs px-2 py-0.5 rounded-full bg-emerald-500/20 text-emerald-300 border border-emerald-500/30 flex-shrink-0 ml-auto">
                                        Publik
                                    </span>
                                @endif
                            </div>
                            <h3 class="text-white font-semibold text-sm leading-snug mt-1 mb-1">{{ $sheet->title }}</h3>
                            @if ($sheet->description)
                                <p class="text-purple-400 text-xs line-clamp-2 flex-1">{{ $sheet->description }}</p>
                            @else
                                <div class="flex-1"></div>
                            @endif
                            <div class="flex items-center justify-between mt-4 pt-3 border-t border-purple-500/10">
                                <span class="text-purple-500 text-xs">{{ $sheet->created_at->diffForHumans() }}</span>
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('cheatsheet.edit', $sheet->id) }}" class="text-xs text-purple-400 hover:text-purple-300 transition-colors">Edit</a>
                                    <a href="{{ route('cheatsheet.show', $sheet->id) }}" class="text-xs text-indigo-400 hover:text-indigo-300 transition-colors">Lihat →</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="bg-white/5 backdrop-blur-lg rounded-2xl border border-dashed border-purple-500/30 p-8 text-center">
                    <div class="text-4xl mb-3">📋</div>
                    <p class="text-purple-300 text-sm mb-4">Kamu belum punya cheat sheet.</p>
                    <a href="{{ route('cheatsheet.create') }}"
                       class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-purple-600 to-indigo-600 rounded-xl text-white text-sm font-semibold hover:shadow-lg hover:shadow-purple-500/30 transition-all">
                        Buat Pertama Kamu
                    </a>
                </div>
            @endif
        </div>
    @endauth

    {{-- Public Cheat Sheets --}}
    <div>
        <div class="flex items-center justify-between mb-3">
            <h2 class="text-purple-300 text-xs font-semibold uppercase tracking-wider">Dari Komunitas</h2>
            <span class="text-purple-500 text-xs">{{ $publicSheets->total() }} cheat sheet</span>
        </div>

        @if ($publicSheets->isNotEmpty())
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach ($publicSheets as $sheet)
                    <a href="{{ route('cheatsheet.show', $sheet->id) }}"
                       class="bg-white/5 backdrop-blur-lg rounded-2xl border border-purple-500/20 hover:border-indigo-400/40 p-5 transition-all duration-200 hover:-translate-y-0.5 hover:shadow-lg hover:shadow-indigo-500/10 flex flex-col group">
                        @if ($sheet->category)
                            <span class="text-xs px-2 py-0.5 rounded-full bg-indigo-500/20 text-indigo-300 border border-indigo-500/30 self-start mb-2">
                                {{ $sheet->category->name }}
                            </span>
                        @endif
                        <h3 class="text-white font-semibold text-sm leading-snug mb-1 group-hover:text-indigo-300 transition-colors">{{ $sheet->title }}</h3>
                        @if ($sheet->description)
                            <p class="text-purple-400 text-xs line-clamp-2 flex-1">{{ $sheet->description }}</p>
                        @else
                            <div class="flex-1"></div>
                        @endif
                        <div class="flex items-center justify-between mt-4 pt-3 border-t border-purple-500/10">
                            <div class="flex items-center gap-2">
                                <div class="w-5 h-5 rounded-full bg-gradient-to-br from-purple-500 to-indigo-500 flex items-center justify-center text-white text-xs font-bold flex-shrink-0">
                                    {{ strtoupper(substr($sheet->user->name ?? '?', 0, 1)) }}
                                </div>
                                <span class="text-purple-400 text-xs truncate max-w-[100px]">{{ $sheet->user->name ?? '-' }}</span>
                            </div>
                            <span class="text-purple-500 text-xs">{{ $sheet->created_at->diffForHumans() }}</span>
                        </div>
                    </a>
                @endforeach
            </div>

            <div class="mt-6">
                {{ $publicSheets->links() }}
            </div>
        @else
            <div class="bg-white/5 backdrop-blur-lg rounded-2xl border border-dashed border-purple-500/30 p-10 text-center">
                <div class="text-4xl mb-3">🔍</div>
                <p class="text-purple-300 text-sm">Belum ada cheat sheet publik yang ditemukan.</p>
            </div>
        @endif
    </div>
</div>
