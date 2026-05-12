<?php

use App\Models\User;
use Livewire\Attributes\Url;
use Livewire\Volt\Component;
use Livewire\WithPagination;

new class extends Component {
    use WithPagination;

    #[Url(as: 'q')]
    public string $search = '';

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function with(): array
    {
        $members = User::query()
            ->select(['name', 'username', 'bio', 'created_at'])
            ->when($this->search, fn ($q) => $q->where(function ($query) {
                $query->where('name', 'like', "%{$this->search}%")
                    ->orWhere('username', 'like', "%{$this->search}%");
            }))
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return compact('members');
    }
}; ?>

<div>
    {{-- Search --}}
    <div class="mb-8">
        <input
            wire:model.live.debounce.300ms="search"
            type="text"
            placeholder="Cari nama atau username..."
            class="w-full px-4 py-3 rounded-lg bg-gray-800/50 border border-gray-700 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500"
        >
    </div>

    <p class="text-gray-300 text-base mb-6">
        @if ($search)
            Hasil untuk "<span class="text-white font-medium">{{ $search }}</span>" — {{ $members->total() }} anggota
        @else
            Temui {{ $members->total() }} anggota komunitas kami yang luar biasa
        @endif
    </p>

    {{-- Members Grid --}}
    @if ($members->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
            @foreach ($members as $member)
                <a href="{{ route('family.show', $member->username) }}" class="group">
                    <div class="bg-gray-800/50 backdrop-blur-sm border border-gray-700 rounded-xl p-6 hover:border-indigo-500 hover:bg-gray-800/70 transition-all duration-300">
                        <div class="w-16 h-16 rounded-full bg-gradient-to-br from-purple-500 to-indigo-500 flex items-center justify-center mb-4 group-hover:shadow-lg group-hover:shadow-indigo-500/40 transition-all">
                            <span class="text-2xl font-bold text-white">
                                {{ $member->initials() }}
                            </span>
                        </div>

                        <h3 class="text-lg font-bold text-white mb-1 group-hover:text-indigo-300 transition-colors">
                            {{ $member->name }}
                        </h3>
                        <p class="text-gray-300 text-sm line-clamp-2 mb-4">
                            {{ $member->bio ?? 'Belum ada bio.' }}
                        </p>
                        <p class="text-gray-500 text-xs">
                            Bergabung {{ $member->created_at->format('M Y') }}
                        </p>
                    </div>
                </a>
            @endforeach
        </div>

        @if ($members->hasPages())
            @php
                $currentPage = $members->currentPage();
                $lastPage = $members->lastPage();
                $range = 2;
            @endphp
            <div class="flex flex-col items-center gap-4 mt-4">
                <div class="flex items-center gap-2">
                    {{-- Previous --}}
                    <button
                        wire:click="previousPage"
                        @disabled($members->onFirstPage())
                        class="px-4 py-2 rounded-lg text-sm font-medium transition-all
                            {{ $members->onFirstPage()
                                ? 'bg-gray-800/30 text-gray-600 cursor-not-allowed'
                                : 'bg-gray-800/50 border border-gray-700 text-gray-300 hover:border-indigo-500 hover:text-white cursor-pointer' }}"
                    >
                        ← Prev
                    </button>

                    {{-- First page + dots --}}
                    @if ($currentPage > $range + 1)
                        <button wire:click="gotoPage(1)" class="px-3 py-2 rounded-lg text-sm bg-gray-800/50 border border-gray-700 text-gray-300 hover:border-indigo-500 hover:text-white transition-all cursor-pointer">1</button>
                        @if ($currentPage > $range + 2)
                            <span class="text-gray-600 px-1 select-none">···</span>
                        @endif
                    @endif

                    {{-- Page numbers around current --}}
                    @for ($page = max(1, $currentPage - $range); $page <= min($lastPage, $currentPage + $range); $page++)
                        <button
                            wire:click="gotoPage({{ $page }})"
                            class="px-3 py-2 rounded-lg text-sm font-medium transition-all
                                {{ $page === $currentPage
                                    ? 'bg-gradient-to-r from-purple-500 to-indigo-500 text-white shadow-lg shadow-indigo-500/30 cursor-default'
                                    : 'bg-gray-800/50 border border-gray-700 text-gray-300 hover:border-indigo-500 hover:text-white cursor-pointer' }}"
                        >
                            {{ $page }}
                        </button>
                    @endfor

                    {{-- Dots + last page --}}
                    @if ($currentPage < $lastPage - $range)
                        @if ($currentPage < $lastPage - $range - 1)
                            <span class="text-gray-600 px-1 select-none">···</span>
                        @endif
                        <button wire:click="gotoPage({{ $lastPage }})" class="px-3 py-2 rounded-lg text-sm bg-gray-800/50 border border-gray-700 text-gray-300 hover:border-indigo-500 hover:text-white transition-all cursor-pointer">{{ $lastPage }}</button>
                    @endif

                    {{-- Next --}}
                    <button
                        wire:click="nextPage"
                        @disabled(!$members->hasMorePages())
                        class="px-4 py-2 rounded-lg text-sm font-medium transition-all
                            {{ !$members->hasMorePages()
                                ? 'bg-gray-800/30 text-gray-600 cursor-not-allowed'
                                : 'bg-gray-800/50 border border-gray-700 text-gray-300 hover:border-indigo-500 hover:text-white cursor-pointer' }}"
                    >
                        Next →
                    </button>
                </div>

                <p class="text-gray-500 text-xs">
                    Halaman {{ $currentPage }} dari {{ $lastPage }}
                </p>
            </div>
        @endif
    @else
        <div class="text-center py-16">
            <div class="text-6xl mb-4">🔍</div>
            <h3 class="text-2xl font-bold text-white mb-2">Tidak ada anggota ditemukan</h3>
            <p class="text-gray-400 mb-8">
                @if ($search)
                    Coba cari dengan nama atau username yang berbeda
                @else
                    Belum ada anggota komunitas.
                @endif
            </p>
            @if ($search)
                <button wire:click="$set('search', '')" class="text-indigo-400 hover:text-indigo-300">
                    ← Kembali ke daftar
                </button>
            @endif
        </div>
    @endif
</div>
