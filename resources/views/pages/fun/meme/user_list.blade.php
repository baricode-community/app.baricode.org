<x-layouts.base :title="__('Profile Memer List')">
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="mb-12">
                <h1 class="text-5xl font-bold text-white mb-3">{{ __('Komunitas Memer') }}</h1>
                <p class="text-gray-300 text-lg max-w-2xl">{{ __('Temukan kreator meme terbaik di komunitas Baricode. Lihat performa dan kontribusi mereka!') }}</p>
            </div>

            <!-- Users Grid Section -->
            @if($users->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($users as $userStats)
                        <a
                            href="{{ route('meme.user', $userStats['user']->username) }}"
                            class="group relative bg-gradient-to-br from-gray-900 to-black border border-purple-500/30 rounded-2xl overflow-hidden hover:border-purple-500/60 transition-all duration-300 hover:shadow-2xl hover:shadow-purple-500/20"
                            wire:navigate
                        >
                            <!-- Animated Background Gradient -->
                            <div class="absolute inset-0 bg-gradient-to-br from-purple-600/10 via-transparent to-indigo-600/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

                            <!-- Content -->
                            <div class="relative p-6 z-10">
                                <!-- Profile Header -->
                                <div class="flex items-start justify-between mb-4">
                                    <div class="flex items-center gap-4 flex-1">
                                        <!-- Avatar -->
                                        <div class="w-14 h-14 rounded-full bg-gradient-to-br from-purple-400 via-pink-400 to-indigo-400 flex items-center justify-center text-white font-bold text-lg flex-shrink-0 shadow-lg group-hover:scale-110 transition-transform">
                                            {{ $userStats['user']->initials() }}
                                        </div>
                                        <!-- User Info -->
                                        <div class="flex-1 min-w-0">
                                            <h2 class="text-white font-bold text-lg truncate group-hover:text-purple-300 transition-colors">{{ $userStats['user']->name }}</h2>
                                            <p class="text-gray-400 text-sm">@{{ $userStats['user']->username }}</p>
                                        </div>
                                    </div>
                                    <!-- Badge -->
                                    <div class="ml-2">
                                        @if($userStats['totalVotes'] >= 50)
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold bg-yellow-500/20 text-yellow-300 border border-yellow-500/30">
                                                ⭐ Star
                                            </span>
                                        @elseif($userStats['totalVotes'] >= 20)
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold bg-purple-500/20 text-purple-300 border border-purple-500/30">
                                                🔥 Hot
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <!-- Bio -->
                                @if($userStats['user']->bio)
                                    <p class="text-gray-400 text-sm mb-4 line-clamp-2">{{ $userStats['user']->bio }}</p>
                                @endif

                                <!-- Divider -->
                                <div class="h-px bg-gradient-to-r from-purple-500/0 via-purple-500/30 to-purple-500/0 mb-4"></div>

                                <!-- Stats Grid -->
                                <div class="grid grid-cols-4 gap-2">
                                    <!-- Total Memes -->
                                    <div class="bg-blue-500/10 rounded-lg p-3 text-center border border-blue-500/20 group-hover:border-blue-500/40 transition-colors">
                                        <div class="text-xl font-bold text-blue-400">{{ $userStats['totalMemes'] }}</div>
                                        <div class="text-xs text-gray-400 mt-1">Meme</div>
                                    </div>

                                    <!-- Total Votes -->
                                    <div class="bg-green-500/10 rounded-lg p-3 text-center border border-green-500/20 group-hover:border-green-500/40 transition-colors">
                                        <div class="text-xl font-bold text-green-400">{{ $userStats['totalVotes'] }}</div>
                                        <div class="text-xs text-gray-400 mt-1">Vote</div>
                                    </div>

                                    <!-- Upvotes -->
                                    <div class="bg-emerald-500/10 rounded-lg p-3 text-center border border-emerald-500/20 group-hover:border-emerald-500/40 transition-colors">
                                        <div class="text-xl font-bold text-emerald-400">{{ $userStats['totalUpvotes'] }}</div>
                                        <div class="text-xs text-gray-400 mt-1">👍</div>
                                    </div>

                                    <!-- Downvotes -->
                                    <div class="bg-red-500/10 rounded-lg p-3 text-center border border-red-500/20 group-hover:border-red-500/40 transition-colors">
                                        <div class="text-xl font-bold text-red-400">{{ $userStats['totalDownvotes'] }}</div>
                                        <div class="text-xs text-gray-400 mt-1">👎</div>
                                    </div>
                                </div>

                                <!-- Rating Bar -->
                                @if($userStats['totalVotes'] > 0)
                                    <div class="mt-4 pt-4 border-t border-gray-800">
                                        <div class="flex items-center justify-between mb-2">
                                            <span class="text-xs text-gray-400">Rating</span>
                                            <span class="text-sm font-semibold text-purple-400">
                                                {{ round(($userStats['totalUpvotes'] / $userStats['totalVotes']) * 100) }}%
                                            </span>
                                        </div>
                                        <div class="w-full bg-gray-800 rounded-full h-2 overflow-hidden">
                                            <div 
                                                class="bg-gradient-to-r from-green-500 to-emerald-500 h-full rounded-full transition-all duration-300"
                                                style="width: {{ ($userStats['totalUpvotes'] / $userStats['totalVotes']) * 100 }}%"
                                            ></div>
                                        </div>
                                    </div>
                                @endif

                                <!-- Hover CTA -->
                                <div class="mt-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    <div class="inline-flex items-center text-purple-400 text-sm font-semibold">
                                        {{ __('Lihat Profil') }}
                                        <i data-lucide="chevron-right" class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform"></i>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>

                <!-- Leaderboard Section -->
                <div class="mt-16 pt-12 border-t border-gray-800">
                    <h2 class="text-3xl font-bold text-white mb-8">🏆 {{ __('Top Memer') }}</h2>
                    <div class="bg-gradient-to-r from-gray-900 to-black border border-purple-500/20 rounded-2xl overflow-hidden">
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead>
                                    <tr class="border-b border-gray-800 bg-gray-900/50">
                                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-400">{{ __('Rank') }}</th>
                                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-400">{{ __('Pengguna') }}</th>
                                        <th class="px-6 py-4 text-right text-sm font-semibold text-gray-400">{{ __('Meme') }}</th>
                                        <th class="px-6 py-4 text-right text-sm font-semibold text-gray-400">{{ __('Total Vote') }}</th>
                                        <th class="px-6 py-4 text-right text-sm font-semibold text-gray-400">{{ __('Rating') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users->take(10) as $index => $userStats)
                                        <tr class="border-b border-gray-800 hover:bg-gray-900/50 transition-colors">
                                            <td class="px-6 py-4">
                                                <div class="flex items-center justify-center w-8 h-8 rounded-full bg-gradient-to-br from-purple-500 to-indigo-500 text-white font-bold text-sm">
                                                    {{ $index + 1 }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4">
                                                <a href="{{ route('meme.user', $userStats['user']->username) }}" wire:navigate class="flex items-center gap-3 hover:text-purple-400 transition-colors">
                                                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-purple-400 to-indigo-400 flex items-center justify-center text-white font-bold text-sm">
                                                        {{ $userStats['user']->initials() }}
                                                    </div>
                                                    <div>
                                                        <div class="text-white font-semibold">{{ $userStats['user']->name }}</div>
                                                        <div class="text-xs text-gray-400">@{{ $userStats['user']->username }}</div>
                                                    </div>
                                                </a>
                                            </td>
                                            <td class="px-6 py-4 text-right">
                                                <span class="inline-flex items-center px-3 py-1 rounded-full bg-blue-500/10 text-blue-400 text-sm font-semibold border border-blue-500/20">
                                                    {{ $userStats['totalMemes'] }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 text-right">
                                                <span class="font-bold text-green-400">{{ $userStats['totalVotes'] }}</span>
                                            </td>
                                            <td class="px-6 py-4 text-right">
                                                <div class="flex items-center justify-end gap-2">
                                                    <span class="font-semibold text-purple-400">
                                                        {{ $userStats['totalVotes'] > 0 ? round(($userStats['totalUpvotes'] / $userStats['totalVotes']) * 100) : 0 }}%
                                                    </span>
                                                    @if($userStats['totalUpvotes'] > $userStats['totalDownvotes'])
                                                        <i data-lucide="thumbs-up" class="w-4 h-4 text-green-400"></i>
                                                    @else
                                                        <i data-lucide="thumbs-down" class="w-4 h-4 text-red-400"></i>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @else
                <!-- Empty State -->
                <div class="text-center py-20">
                    <i data-lucide="user" class="w-24 h-24 text-gray-700 mx-auto mb-6"></i>
                    <h3 class="text-2xl font-bold text-gray-300 mb-2">{{ __('Belum Ada Kreator Meme') }}</h3>
                    <p class="text-gray-400 mb-6">{{ __('Mulai buat meme pertamamu sekarang!') }}</p>
                    <a 
                        href="{{ route('meme.create') }}"
                        wire:navigate
                        class="inline-flex items-center px-8 py-3 bg-gradient-to-r from-purple-600 to-indigo-600 text-white rounded-lg font-semibold hover:shadow-lg transition-all"
                    >
                        <i data-lucide="plus" class="w-5 h-5 mr-2"></i>
                        {{ __('Buat Meme') }}
                    </a>
                </div>
            @endif
        </div>
    </div>
</x-layouts.base>
