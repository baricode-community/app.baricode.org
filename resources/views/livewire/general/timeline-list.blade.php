<?php

use App\Models\Timeline;
use Livewire\Attributes\Url;
use Livewire\Volt\Component;
use Livewire\WithPagination;

new class extends Component {
    use WithPagination;

    #[Url]
    public string $status = '';

    public function updatedStatus(): void
    {
        $this->resetPage();
    }

    public function with(): array
    {
        $timelines = Timeline::query()
            ->when($this->status, fn ($q) => $q->where('status', $this->status))
            ->orderByDesc('created_at')
            ->paginate(10);

        return compact('timelines');
    }
}; ?>

<div>
    {{-- Filter Buttons --}}
    <nav class="mb-8 flex flex-wrap gap-3" aria-label="Filter Timeline">
        @php
            $filters = [
                '' => 'Semua',
                'pending' => 'Tertunda',
                'ongoing' => 'Berlangsung',
                'completed' => 'Selesai',
                'cancelled' => 'Dibatalkan',
            ];
        @endphp

        @foreach ($filters as $value => $label)
            <button
                wire:click="$set('status', '{{ $value }}')"
                @class([
                    'px-4 py-2 rounded-lg font-medium transition border',
                    'bg-purple-600 text-white border-purple-600' => $status === $value,
                    'bg-white/5 text-purple-300 border-purple-500/20 hover:bg-purple-500/20' => $status !== $value,
                ])
            >
                {{ $label }}
            </button>
        @endforeach
    </nav>

    {{-- Timeline List --}}
    <div class="space-y-6">
        @forelse ($timelines as $timeline)
            @php
                $borderColor = match ($timeline->status) {
                    'pending' => 'border-l-yellow-500',
                    'ongoing' => 'border-l-blue-500',
                    'completed' => 'border-l-green-500',
                    'cancelled' => 'border-l-red-500',
                    default => 'border-l-purple-500',
                };
            @endphp

            <a href="{{ route('timeline.show', $timeline) }}"
                class="group block bg-white/5 backdrop-blur-lg rounded-lg border border-purple-500/20 border-l-4 {{ $borderColor }} hover:border-purple-500/50 hover:shadow-xl hover:shadow-purple-500/10 transition-all duration-300 transform hover:-translate-y-1">

                <div class="p-6">
                    <div class="flex flex-col md:flex-row md:items-start justify-between gap-4 mb-4">
                        <div class="flex-1">
                            <h2 class="text-2xl font-bold text-white group-hover:text-purple-300 transition-colors">
                                {{ $timeline->title }}
                            </h2>
                            <x-timeline.status-badge :status="$timeline->status" :label="$timeline->status_label" class="mt-2" />
                        </div>
                    </div>

                    @if ($timeline->description)
                        <p class="text-purple-300/80 mb-6 leading-relaxed line-clamp-2">
                            {{ $timeline->description }}
                        </p>
                    @endif

                    <div class="mb-6">
                        <div class="flex justify-between items-center mb-2 text-sm">
                            <span class="font-medium text-purple-400">Progress</span>
                            <span class="font-bold text-white">{{ $timeline->progress }}%</span>
                        </div>
                        <div class="w-full bg-purple-900/30 rounded-full h-2.5 overflow-hidden">
                            <div class="bg-gradient-to-r from-purple-600 to-purple-400 h-full transition-all duration-500"
                                style="width: {{ $timeline->progress }}%">
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm border-t border-purple-500/10 pt-4">
                        <div class="flex items-center gap-2">
                            <span class="text-purple-400">Mulai:</span>
                            <time class="font-medium text-white">{{ $timeline->start_date?->format('d M Y') ?? '-' }}</time>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="text-purple-400">Selesai:</span>
                            <time class="font-medium text-white">{{ $timeline->end_date?->format('d M Y') ?? '-' }}</time>
                        </div>
                    </div>

                    <div class="mt-4 flex justify-between items-center text-[11px] uppercase tracking-wider text-purple-500/60">
                        <span>ID: #{{ str_pad($timeline->id, 5, '0', STR_PAD_LEFT) }}</span>
                        <span class="group-hover:text-purple-300 transition-colors">Detail Project &rarr;</span>
                    </div>
                </div>
            </a>
        @empty
            <div class="flex flex-col items-center justify-center py-20 text-center bg-white/5 rounded-2xl border border-dashed border-purple-500/30">
                <div class="p-4 bg-purple-500/10 rounded-full mb-4">
                    <i data-lucide="clock" class="h-12 w-12 text-purple-500"></i>
                </div>
                <h3 class="text-xl font-semibold text-white">Belum Ada Timeline</h3>
                <p class="text-purple-400 mt-2 max-w-xs">Data yang Anda cari tidak ditemukan atau belum ditambahkan.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-10">
        {{ $timelines->links() }}
    </div>
</div>
