<?php

use App\Models\Fun\Meme;
use Livewire\Volt\Component;

new class extends Component {
    public $memes = [];
    public $totalMemes = 0;
    public $itemsPerLoad = 5;
    public $isLoading = false;
    public $hasMoreMemes = true;

    public function mount()
    {
        $this->loadMoreMemes();
    }

    public function loadMoreMemes()
    {
        $this->isLoading = true;

        $query = Meme::with('user')->orderBy('created_at', 'desc');

        $this->totalMemes = $query->count();
        
        $skip = count($this->memes);
        $newMemes = $query->skip($skip)->take($this->itemsPerLoad)->get();
        
        $this->memes = array_merge($this->memes, $newMemes->toArray());
        
        $this->hasMoreMemes = count($this->memes) < $this->totalMemes;
        $this->isLoading = false;
    }

    #[\Livewire\Attributes\On('meme-created')]
    public function refreshMemes()
    {
        $this->memes = [];
        $this->hasMoreMemes = true;
        $this->loadMoreMemes();
    }
}; ?>
<div class="mt-16">
    @if (count($memes) > 0)
        <!-- Memes Feed -->
        <div class="max-w-2xl mx-auto space-y-8 mb-12"
            x-data="{ observer: null }"
            x-init="
                observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting && !@json($isLoading) && @json($hasMoreMemes)) {
                            @this.call('loadMoreMemes');
                        }
                    });
                }, { rootMargin: '200px' });
                
                const sentinel = document.getElementById('infinite-scroll-sentinel');
                if (sentinel) observer.observe(sentinel);
            "
        >

            @foreach ($memes as $meme)
                <div class="bg-gradient-to-br 
                            from-purple-500/5 to-indigo-500/5 
                            dark:from-purple-500/10 dark:to-indigo-500/10
                            backdrop-blur-xl rounded-2xl 
                            border border-purple-500/20 dark:border-purple-500/30
                            overflow-hidden hover:border-purple-500/40 dark:hover:border-purple-500/50
                            transition-all">

                    <!-- Header -->
                    <div class="flex items-center justify-between 
                                p-4 border-b 
                                border-purple-500/10 dark:border-purple-500/20">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 rounded-full bg-gradient-to-br from-purple-400 to-indigo-400
                                        flex items-center justify-center text-white font-bold">
                                {{ substr($meme['user']['name'], 0, 1) }}
                            </div>

                            <div>
                                <a href="{{ route('meme.user', $meme['user']['username']) }}"
                                    wire:navigate
                                    class="text-gray-800 dark:text-white font-semibold hover:text-purple-500 dark:hover:text-purple-300 transition-colors block">
                                    {{ $meme['user']['name'] }}
                                </a>
                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                    {{ $meme['user']['username'] }}
                                </p>
                            </div>
                        </div>

                        <div class="text-xs text-gray-500 dark:text-gray-400">
                            {{ \Carbon\Carbon::parse($meme['created_at'])->diffForHumans() }}
                        </div>
                    </div>

                    <!-- Image -->
                    <div class="w-full bg-gray-100 dark:bg-black/30 overflow-hidden">
                        <img src="{{ asset('storage/' . $meme['image_path']) }}"
                            alt="{{ $meme['caption'] ?? 'Meme' }}"
                            class="w-full h-auto object-cover" />
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex items-center justify-between p-4 border-b border-purple-500/10 dark:border-purple-500/20">
                        <div class="flex gap-3">
                            <livewire:fun.meme-vote-button :memeId="$meme['id']" />
                            <livewire:fun.meme-share :memeId="$meme['id']" />
                        </div>
                    </div>

                    <!-- Caption -->
                    @if ($meme['caption'])
                        <div class="px-4 py-3">
                            <p class="text-gray-700 dark:text-gray-200 text-sm leading-relaxed">
                                {{ $meme['caption'] }}
                            </p>
                        </div>
                    @endif
                </div>
            @endforeach

            <!-- Infinite Scroll Sentinel -->
            <div id="infinite-scroll-sentinel" class="w-full h-1"></div>
        </div>

        <!-- Loading -->
        @if ($isLoading)
            <div class="max-w-2xl mx-auto flex justify-center py-8 mb-8">
                <div class="flex items-center gap-2">
                    <div class="w-3 h-3 bg-purple-500 rounded-full animate-bounce"></div>
                    <div class="w-3 h-3 bg-purple-500 rounded-full animate-bounce" style="animation-delay: .1s"></div>
                    <div class="w-3 h-3 bg-purple-500 rounded-full animate-bounce" style="animation-delay: .2s"></div>
                </div>
            </div>
        @endif

        <!-- End Message -->
        @if (!$hasMoreMemes && count($memes) > 0)
            <div class="max-w-2xl mx-auto text-center py-8">
                <p class="text-gray-500 dark:text-gray-400 text-sm">{{ __('Tidak ada meme lagi') }} 😅</p>
                <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">{{ __('Total') }} {{ $totalMemes }} {{ __('meme dimuat') }}</p>
            </div>
        @endif

    @else
        <!-- Empty State -->
        <div class="text-center py-20">
            <div class="inline-flex items-center justify-center w-24 h-24 rounded-full
                        bg-purple-500/10 dark:bg-purple-500/20 
                        border border-purple-500/20 dark:border-purple-500/30 mb-6">
                <svg class="w-12 h-12 text-purple-500 dark:text-purple-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
            </div>

            <h3 class="text-2xl font-semibold text-gray-800 dark:text-white mb-3">
                {{ __('Belum Ada Meme') }}
            </h3>

            <p class="text-gray-500 dark:text-gray-400 mb-8 max-w-md mx-auto">
                {{ __('Jadilah yang pertama membuat meme di komunitas kami! Bagikan kreativitasmu dan buat orang lain tertawa.') }}
            </p>

            <a href="{{ route('meme.create') }}"
                wire:navigate
                class="inline-block px-8 py-4 bg-gradient-to-r from-purple-600 to-indigo-600 rounded-xl font-semibold text-white hover:shadow-2xl hover:shadow-purple-500/50 transition-all transform hover:scale-105">
                {{ __('Buat Meme Pertamamu') }}
            </a>
        </div>
    @endif
</div>
