<x-layouts.base :title="$user->name . ' - ' . __('Profile Memer')">
    <div class="py-12">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Profile Header Card -->
            <div class="mb-12 mt-12 bg-gradient-to-r from-purple-700 via-indigo-700 to-blue-700 rounded-3xl shadow-2xl">
                <!-- Decorative Blobs -->
                <div class="px-10 pb-10 relative z-10">
                    <div class="flex flex-col sm:flex-row sm:items-end sm:space-x-8 -mt-20 pt-6">
                        <!-- Avatar -->
                        <div class="flex-shrink-0 mb-6 sm:mb-0">
                            <div class="w-36 h-36 bg-gradient-to-br from-pink-500 via-purple-500 to-indigo-500 rounded-full flex items-center justify-center shadow-2xl border-4 border-white ring-4 ring-indigo-300">
                                <span class="text-5xl font-extrabold text-white drop-shadow-lg">{{ $user->initials() }}</span>
                            </div>
                        </div>

                        <!-- User Info -->
                        <div class="flex-1 mb-6 sm:mb-0">
                            <h1 class="text-4xl font-extrabold text-white mb-2 tracking-tight drop-shadow">{{ $user->name }}</h1>
                            <p class="text-indigo-200 text-lg font-mono mb-2">{{ '@' . $user->username }}</p>
                            @if($user->bio)
                                <p class="text-indigo-100 mt-2 max-w-xl italic">{{ $user->bio }}</p>
                            @endif
                        </div>

                        <!-- Action Button -->
                        @if(Auth::check() && Auth::user()->id === $user->id)
                            <div class="flex-shrink-0">
                                <a
                                    href="{{ route('meme.create') }}"
                                    wire:navigate
                                    class="inline-flex items-center px-5 py-2.5 bg-white/20 hover:bg-white/30 text-white rounded-xl font-semibold transition-all backdrop-blur-sm border border-white/30"
                                >
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                    </svg>
                                    {{ __('Buat Meme') }}
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Statistics Section -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
                <!-- Total Memes -->
                <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl p-6 shadow-lg hover:shadow-xl transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-blue-200 text-sm font-semibold uppercase tracking-wider">{{ __('Total Meme') }}</p>
                            <p class="text-4xl font-bold text-white mt-2">{{ $totalMemes }}</p>
                        </div>
                        <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Total Upvotes -->
                <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-xl p-6 shadow-lg hover:shadow-xl transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-green-200 text-sm font-semibold uppercase tracking-wider">{{ __('Upvote') }}</p>
                            <p class="text-4xl font-bold text-white mt-2">{{ $totalUpvotes }}</p>
                        </div>
                        <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center">
                            <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm3.5-9H13V7h-2v4H8.5l3.5-3.5 3.5 3.5z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Total Downvotes -->
                <div class="bg-gradient-to-br from-red-500 to-red-600 rounded-xl p-6 shadow-lg hover:shadow-xl transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-red-200 text-sm font-semibold uppercase tracking-wider">{{ __('Downvote') }}</p>
                            <p class="text-4xl font-bold text-white mt-2">{{ $totalDownvotes }}</p>
                        </div>
                        <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center">
                            <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm-3.5-9H11v4h2v-4h3.5l-3.5 3.5-3.5-3.5z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Average Votes -->
                <div class="bg-gradient-to-br from-purple-500 to-indigo-600 rounded-xl p-6 shadow-lg hover:shadow-xl transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-purple-200 text-sm font-semibold uppercase tracking-wider">{{ __('Rata-rata Vote') }}</p>
                            <p class="text-4xl font-bold text-white mt-2">{{ $averageVotes }}</p>
                        </div>
                        <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Memes Gallery Section -->
            @if($totalMemes > 0)
                <div class="mb-12">
                    <h2 class="text-2xl font-bold text-white mb-8">{{ __('Galeri Meme') }}</h2>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($memes as $meme)
                            <div class="group bg-gray-900 rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:scale-105">
                                <!-- Meme Image -->
                                <div class="relative overflow-hidden bg-gray-800 h-64">
                                    @if($meme->image_path)
                                        <img 
                                            src="{{ asset('storage/' . $meme->image_path) }}" 
                                            alt="{{ $meme->caption }}"
                                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300"
                                        >
                                    @else
                                        <div class="w-full h-full flex items-center justify-center">
                                            <svg class="w-16 h-16 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                    @endif
                                </div>

                                <!-- Meme Info -->
                                <div class="p-4">
                                    @if($meme->caption)
                                        <p class="text-white text-sm line-clamp-2 mb-3">{{ $meme->caption }}</p>
                                    @endif

                                    <!-- Vote Stats -->
                                    <div class="flex items-center justify-between bg-gray-800 rounded-lg p-3">
                                        <div class="flex items-center space-x-4">
                                            <div class="flex items-center space-x-1">
                                                <svg class="w-5 h-5 text-green-400" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm3.5-9H13V7h-2v4H8.5l3.5-3.5 3.5 3.5z"></path>
                                                </svg>
                                                <span class="text-green-400 font-semibold">{{ $meme->upvotesCount() }}</span>
                                            </div>
                                            <div class="flex items-center space-x-1">
                                                <svg class="w-5 h-5 text-red-400" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm-3.5-9H11v4h2v-4h3.5l-3.5 3.5-3.5-3.5z"></path>
                                                </svg>
                                                <span class="text-red-400 font-semibold">{{ $meme->downvotesCount() }}</span>
                                            </div>
                                        </div>
                                        <span class="text-gray-400 text-xs">ID: {{ $meme->id }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <!-- Empty State -->
                <div class="text-center py-16">
                    <svg class="w-20 h-20 text-gray-700 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <h3 class="text-xl font-semibold text-gray-300 mb-2">{{ __('Belum Ada Meme') }}</h3>
                    <p class="text-gray-400 mb-6">{{ $user->name }} {{ __('belum membuat meme apapun.') }}</p>
                    @if(Auth::check() && Auth::user()->id === $user->id)
                        <a 
                            href="{{ route('meme.create') }}"
                            wire:navigate
                            class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-purple-600 to-indigo-600 text-white rounded-lg font-semibold hover:shadow-lg transition-all"
                        >
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            {{ __('Buat Meme Pertama') }}
                        </a>
                    @endif
                </div>
            @endif

            <!-- Back Button -->
            <div class="mt-12">
                <a 
                    href="{{ route('meme.index') }}"
                    wire:navigate
                    class="inline-flex items-center text-purple-400 hover:text-purple-300 transition-colors"
                >
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    {{ __('Kembali ke Galeri') }}
                </a>
            </div>
        </div>
    </div>
</x-layouts.base>
