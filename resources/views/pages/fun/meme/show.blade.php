<x-layouts.base :title="__('Meme oleh ') . $meme->user->name">
    <div class="py-12">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Main Content -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Meme Image Section -->
                <div class="lg:col-span-2">
                    <div class="bg-gradient-to-br from-gray-900 to-black rounded-2xl overflow-hidden border border-purple-500/30 shadow-2xl">
                        <!-- Image Container -->
                        @if($meme->image_path)
                            <div class="relative bg-gray-800">
                                <img 
                                    src="{{ asset('storage/' . $meme->image_path) }}" 
                                    alt="{{ $meme->caption }}"
                                    class="w-full h-auto object-contain max-h-[600px]"
                                >
                            </div>
                        @else
                            <div class="w-full h-96 flex items-center justify-center bg-gray-800">
                                <i data-lucide="image" class="w-24 h-24 text-gray-700"></i>
                            </div>
                        @endif

                        <!-- Caption -->
                        @if($meme->caption)
                            <div class="p-6 border-t border-gray-800">
                                <p class="text-gray-300 text-lg leading-relaxed">{{ $meme->caption }}</p>
                            </div>
                        @endif

                        <!-- Vote Section -->
                        <div class="px-6 py-4 border-t border-gray-800 flex items-center justify-between">
                            <div class="flex items-center gap-6">
                                <!-- Upvotes -->
                                <div class="flex items-center gap-2">
                                    <i data-lucide="thumbs-up" class="w-6 h-6 text-green-400"></i>
                                    <span class="text-green-400 font-bold text-lg">{{ $meme->upvotesCount() }}</span>
                                </div>

                                <!-- Downvotes -->
                                <div class="flex items-center gap-2">
                                    <i data-lucide="thumbs-down" class="w-6 h-6 text-red-400"></i>
                                    <span class="text-red-400 font-bold text-lg">{{ $meme->downvotesCount() }}</span>
                                </div>

                                <!-- Total Votes -->
                                <div class="flex items-center gap-2 pl-4 border-l border-gray-700">
                                    <i data-lucide="zap" class="w-6 h-6 text-purple-400"></i>
                                    <span class="text-purple-400 font-bold text-lg">{{ $meme->upvotesCount() + $meme->downvotesCount() }}</span>
                                </div>
                            </div>

                            <!-- Vote Buttons -->
                            <livewire:fun.meme-vote-button :memeId="$meme->id" />
                        </div>

                        <!-- Action Buttons -->
                        <div class="px-6 py-4 border-t border-gray-800 flex items-center gap-3">
                            <!-- Share Button -->
                            @php
                                $shareUrl = route('meme.show', $meme->id);
                            @endphp
                            <livewire:fun.meme-share :memeId="$meme->id" />
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="space-y-6">
                    <!-- Creator Card -->
                    <div class="bg-gradient-to-br from-purple-600 to-indigo-600 rounded-2xl p-6 shadow-lg">
                        <div class="flex items-center gap-4 mb-4">
                            <div class="w-16 h-16 rounded-full bg-gradient-to-br from-pink-400 to-purple-400 flex items-center justify-center text-white font-bold text-xl shadow-lg">
                                {{ $meme->user->initials() }}
                            </div>
                            <div class="flex-1">
                                <h3 class="text-white font-bold text-lg">{{ $meme->user->name }}</h3>
                                <p class="text-purple-200 text-sm">{{ '@' . $meme->user->username }}</p>
                            </div>
                        </div>

                        @if($meme->user->bio)
                            <p class="text-purple-100 text-sm mb-4">{{ $meme->user->bio }}</p>
                        @endif

                        <a
                            href="{{ route('meme.user', $meme->user->username) }}"
                            wire:navigate
                            class="block w-full bg-white text-purple-600 hover:bg-purple-50 text-center py-2 rounded-lg font-semibold transition-colors"
                        >
                            {{ __('Lihat Profil') }}
                        </a>
                    </div>

                    <!-- Creator Stats -->
                    @php
                        $creatorMemes = \App\Models\Fun\Meme::where('user_id', $meme->user->id)->get();
                        $creatorUpvotes = $creatorMemes->sum(fn($m) => $m->upvotesCount());
                        $creatorDownvotes = $creatorMemes->sum(fn($m) => $m->downvotesCount());
                    @endphp

                    <div class="bg-gray-900 border border-purple-500/20 rounded-2xl p-6 space-y-4">
                        <h4 class="text-white font-bold text-lg">{{ __('Statistik Kreator') }}</h4>

                        <div class="space-y-3">
                            <!-- Total Memes -->
                            <div class="flex items-center justify-between">
                                <span class="text-gray-400 flex items-center gap-2">
                                    <i data-lucide="image" class="w-4 h-4"></i>
                                    {{ __('Total Meme') }}
                                </span>
                                <span class="text-white font-bold">{{ $creatorMemes->count() }}</span>
                            </div>

                            <!-- Total Upvotes -->
                            <div class="flex items-center justify-between">
                                <span class="text-green-400 flex items-center gap-2">
                                    <i data-lucide="check-circle" class="w-4 h-4"></i>
                                    {{ __('Upvote') }}
                                </span>
                                <span class="text-green-400 font-bold">{{ $creatorUpvotes }}</span>
                            </div>

                            <!-- Total Downvotes -->
                            <div class="flex items-center justify-between">
                                <span class="text-red-400 flex items-center gap-2">
                                    <i data-lucide="x-circle" class="w-4 h-4"></i>
                                    {{ __('Downvote') }}
                                </span>
                                <span class="text-red-400 font-bold">{{ $creatorDownvotes }}</span>
                            </div>

                            <!-- Rating Percentage -->
                            @php
                                $totalVotes = $creatorUpvotes + $creatorDownvotes;
                                $ratingPercentage = $totalVotes > 0 ? round(($creatorUpvotes / $totalVotes) * 100) : 0;
                            @endphp

                            <div class="flex items-center justify-between">
                                <span class="text-purple-400 flex items-center gap-2">
                                    <i data-lucide="zap" class="w-4 h-4"></i>
                                    {{ __('Rating') }}
                                </span>
                                <span class="text-purple-400 font-bold">{{ $ratingPercentage }}%</span>
                            </div>
                        </div>

                        <!-- Rating Bar -->
                        @if($totalVotes > 0)
                            <div class="mt-4 pt-4 border-t border-gray-800">
                                <div class="w-full bg-gray-800 rounded-full h-3 overflow-hidden">
                                    <div 
                                        class="bg-gradient-to-r from-green-500 to-emerald-500 h-full rounded-full transition-all"
                                        style="width: {{ $ratingPercentage }}%"
                                    ></div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Meme Info -->
                    <div class="bg-gray-900 border border-purple-500/20 rounded-2xl p-6 space-y-4">
                        <h4 class="text-white font-bold text-lg">{{ __('Informasi Meme') }}</h4>

                        <div class="space-y-3 text-sm">
                            <div>
                                <span class="text-gray-500">{{ __('ID') }}</span>
                                <p class="text-white font-mono text-xs mt-1">{{ $meme->id }}</p>
                            </div>

                            <div>
                                <span class="text-gray-500">{{ __('Dibuat') }}</span>
                                <p class="text-white mt-1">{{ $meme->created_at->format('d M Y H:i') }}</p>
                            </div>

                            <div>
                                <span class="text-gray-500">{{ __('Terakhir Diperbarui') }}</span>
                                <p class="text-white mt-1">{{ $meme->updated_at->format('d M Y H:i') }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Back Button -->
                    <a
                        href="{{ route('meme.index') }}"
                        wire:navigate
                        class="w-full inline-flex items-center justify-center gap-2 bg-gradient-to-r from-purple-600 to-indigo-600 hover:shadow-lg hover:shadow-purple-500/50 text-white py-3 rounded-lg font-semibold transition-all"
                    >
                        <i data-lucide="arrow-left" class="w-5 h-5"></i>
                        {{ __('Kembali ke Galeri') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-layouts.base>
