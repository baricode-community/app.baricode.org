<?php

use App\Models\Fun\Meme;
use Livewire\Volt\Component;

new class extends Component {
    public $memes = [];
    public $totalMemes = 0;

    public function mount()
    {
        $this->loadMemes();
    }

    public function loadMemes()
    {
        $userId = auth()->id();
        $query = Meme::where('user_id', $userId)
            ->with('votes')
            ->orderBy('created_at', 'desc');

        $this->totalMemes = $query->count();
        $this->memes = $query->get()->map(function ($meme) {
            return [
                'id' => $meme->id,
                'caption' => $meme->caption,
                'image_path' => $meme->image_path,
                'created_at' => $meme->created_at,
                'upvotes' => $meme->upvotesCount(),
                'downvotes' => $meme->downvotesCount(),
                'totalVotes' => $meme->upvotesCount() + $meme->downvotesCount(),
            ];
        })->toArray();
    }

    public function deleteMeme($memeId)
    {
        $meme = Meme::find($memeId);
        
        if ($meme && $meme->user_id === auth()->id()) {
            // Delete image from storage
            if ($meme->image_path && \Storage::exists('public/' . $meme->image_path)) {
                \Storage::delete('public/' . $meme->image_path);
            }
            
            $meme->delete();
            
            // Reload memes
            $this->loadMemes();
            
            session()->flash('message', 'Meme berhasil dihapus');
        }
    }
}; ?>

<div>
    @if (count($memes) > 0)
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-100 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700">Gambar</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700">Caption</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700">Dibuat</th>
                        <th class="px-6 py-3 text-center text-xs font-semibold text-gray-700">👍</th>
                        <th class="px-6 py-3 text-center text-xs font-semibold text-gray-700">👎</th>
                        <th class="px-6 py-3 text-center text-xs font-semibold text-gray-700">Total Vote</th>
                        <th class="px-6 py-3 text-center text-xs font-semibold text-gray-700">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($memes as $meme)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <!-- Image -->
                            <td class="px-6 py-4">
                                <div class="w-12 h-12 rounded-lg overflow-hidden flex-shrink-0">
                                    <img 
                                        src="{{ asset('storage/' . $meme['image_path']) }}"
                                        alt="Meme"
                                        class="w-full h-full object-cover"
                                    />
                                </div>
                            </td>

                            <!-- Caption -->
                            <td class="px-6 py-4">
                                <p class="text-sm text-gray-700 truncate max-w-xs">{{ $meme['caption'] ?? '-' }}</p>
                            </td>

                            <!-- Created At -->
                            <td class="px-6 py-4">
                                <p class="text-sm text-gray-600">
                                    {{ \Carbon\Carbon::parse($meme['created_at'])->diffForHumans() }}
                                </p>
                            </td>

                            <!-- Upvotes -->
                            <td class="px-6 py-4 text-center">
                                <span class="inline-flex items-center justify-center px-2 py-1 bg-green-100 text-green-700 rounded-full text-sm font-semibold">
                                    {{ $meme['upvotes'] }}
                                </span>
                            </td>

                            <!-- Downvotes -->
                            <td class="px-6 py-4 text-center">
                                <span class="inline-flex items-center justify-center px-2 py-1 bg-red-100 text-red-700 rounded-full text-sm font-semibold">
                                    {{ $meme['downvotes'] }}
                                </span>
                            </td>

                            <!-- Total Votes -->
                            <td class="px-6 py-4 text-center">
                                <span class="inline-flex items-center justify-center px-2 py-1 bg-purple-100 text-purple-700 rounded-full text-sm font-semibold">
                                    {{ $meme['totalVotes'] }}
                                </span>
                            </td>

                            <!-- Actions -->
                            <td class="px-6 py-4 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <button
                                        wire:click="deleteMeme('{{ $meme['id'] }}')"
                                        wire:confirm="Apakah Anda yakin ingin menghapus meme ini?"
                                        class="inline-flex items-center px-2 py-1 bg-red-100 text-red-700 rounded hover:bg-red-200 transition-colors text-xs font-semibold"
                                        title="{{ __('Hapus') }}"
                                    >
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Total Info -->
        <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 text-sm text-gray-600">
            {{ __('Total') }} <span class="font-semibold">{{ $totalMemes }}</span> {{ __('meme') }}
        </div>
    @else
        <!-- Empty State -->
        <div class="px-6 py-12 text-center">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-100 mb-4">
                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
            </div>
            <h3 class="text-lg font-semibold text-gray-800 mb-2">{{ __('Belum Ada Meme') }}</h3>
            <p class="text-gray-600 mb-6">{{ __('Anda belum membuat meme apapun. Mulai membuat meme sekarang!') }}</p>
            <a
                href="{{ route('meme.create') }}"
                class="inline-flex items-center px-6 py-2 bg-pink-600 text-white rounded-lg hover:bg-pink-700 transition-colors font-semibold"
            >
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                {{ __('Buat Meme Baru') }}
            </a>
        </div>
    @endif
</div>
