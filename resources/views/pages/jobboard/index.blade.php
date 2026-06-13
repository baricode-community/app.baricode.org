<x-layouts.base :title="__('Job Board — Lowongan IT Komunitas Baricode')">
    {{-- Hero --}}
    <div class="relative py-20 px-4 overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-blue-900/50 via-indigo-900/40 to-gray-900/60 pointer-events-none"></div>
        <div class="relative z-10 max-w-4xl mx-auto text-center">
            <div class="inline-flex items-center gap-2 px-4 py-2 bg-blue-500/20 border border-blue-500/30 rounded-full text-blue-300 text-sm font-medium mb-6">
                <i data-lucide="briefcase" class="w-4 h-4"></i>
                <span>Lowongan dari komunitas IT</span>
            </div>
            <h1 class="text-4xl md:text-6xl font-extrabold mb-4 bg-gradient-to-r from-blue-400 via-indigo-400 to-purple-400 bg-clip-text text-transparent">
                Job Board
            </h1>
            <p class="text-xl text-gray-300 mb-8 max-w-2xl mx-auto">
                Temukan lowongan kerja IT yang dikurasi oleh komunitas Baricode. Semua listing diverifikasi admin.
            </p>
            <div class="flex flex-wrap items-center justify-center gap-3">
                @auth
                    <a href="{{ route('jobboard.post') }}"
                        class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-blue-600 to-indigo-600 rounded-xl font-semibold text-sm hover:from-blue-500 hover:to-indigo-500 transition shadow-lg hover:shadow-blue-500/30">
                        <i data-lucide="plus" class="w-4 h-4"></i>
                        Post Lowongan
                    </a>
                    <a href="{{ route('jobboard.my-listings') }}"
                        class="inline-flex items-center gap-2 px-5 py-2.5 bg-white/10 border border-white/20 rounded-xl font-semibold text-sm hover:bg-white/20 transition">
                        Lowongan Saya
                    </a>
                @else
                    <a href="{{ route('login') }}"
                        class="inline-flex items-center gap-2 px-5 py-2.5 bg-white/10 border border-white/20 rounded-xl font-semibold text-sm hover:bg-white/20 transition">
                        Login untuk Post Lowongan
                    </a>
                @endauth
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 pb-20">

        {{-- Filters --}}
        <form method="GET" action="{{ route('jobboard.index') }}" class="mb-8">
            <div class="flex flex-wrap gap-3 items-end">
                @if ($stacks->isNotEmpty())
                    <div>
                        <label class="block text-xs text-gray-400 mb-1">Tech Stack</label>
                        <select name="stack"
                            class="bg-white/5 border border-white/10 rounded-xl px-3 py-2 text-sm text-white focus:outline-none focus:border-blue-500/60 transition">
                            <option value="">Semua Stack</option>
                            @foreach ($stacks as $stack)
                                <option value="{{ $stack }}" {{ request('stack') === $stack ? 'selected' : '' }}>
                                    {{ $stack }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                @endif

                @if ($locations->isNotEmpty())
                    <div>
                        <label class="block text-xs text-gray-400 mb-1">Lokasi</label>
                        <select name="location"
                            class="bg-white/5 border border-white/10 rounded-xl px-3 py-2 text-sm text-white focus:outline-none focus:border-blue-500/60 transition">
                            <option value="">Semua Lokasi</option>
                            @foreach ($locations as $loc)
                                <option value="{{ $loc }}" {{ request('location') === $loc ? 'selected' : '' }}>
                                    {{ $loc }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                @endif

                <div>
                    <label class="block text-xs text-gray-400 mb-1">Tipe</label>
                    <select name="type"
                        class="bg-white/5 border border-white/10 rounded-xl px-3 py-2 text-sm text-white focus:outline-none focus:border-blue-500/60 transition">
                        <option value="">Semua Tipe</option>
                        @foreach (\App\Enums\JobBoard\JobType::cases() as $type)
                            <option value="{{ $type->value }}" {{ request('type') === $type->value ? 'selected' : '' }}>
                                {{ $type->label() }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <label class="flex items-center gap-2 cursor-pointer mt-4">
                    <input type="checkbox" name="remote" value="1" {{ request('remote') ? 'checked' : '' }}
                        class="w-4 h-4 rounded border-white/20 bg-white/5 text-blue-500">
                    <span class="text-sm text-gray-300">Remote Only</span>
                </label>

                <button type="submit"
                    class="px-4 py-2 bg-blue-600 rounded-xl text-sm font-semibold hover:bg-blue-500 transition">
                    Filter
                </button>

                @if (request()->hasAny(['stack', 'location', 'type', 'remote']))
                    <a href="{{ route('jobboard.index') }}"
                        class="px-4 py-2 bg-white/10 rounded-xl text-sm text-gray-300 hover:bg-white/20 transition">
                        Reset
                    </a>
                @endif
            </div>
        </form>

        {{-- Listings --}}
        @forelse ($listings as $listing)
            <a href="{{ route('jobboard.show', $listing->slug) }}"
                class="block bg-white/5 border border-white/10 hover:border-blue-500/40 hover:bg-white/8 rounded-2xl p-6 mb-4 transition group">
                <div class="flex items-start gap-4">
                    @if ($listing->company_logo)
                        <img src="{{ $listing->company_logo }}" alt="{{ $listing->company_name }}"
                            class="w-14 h-14 rounded-xl object-contain bg-white/10 flex-shrink-0">
                    @else
                        <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-blue-600 to-indigo-600 flex items-center justify-center flex-shrink-0 text-xl font-bold text-white">
                            {{ strtoupper(substr($listing->company_name, 0, 1)) }}
                        </div>
                    @endif

                    <div class="flex-1 min-w-0">
                        <div class="flex flex-wrap items-center gap-2 mb-1">
                            <h2 class="text-lg font-bold text-white group-hover:text-blue-300 transition truncate">
                                {{ $listing->title }}
                            </h2>
                            @if ($listing->is_remote)
                                <span class="px-2 py-0.5 bg-green-500/20 border border-green-500/30 text-green-400 rounded-full text-xs font-medium">Remote</span>
                            @endif
                        </div>

                        <p class="text-gray-400 text-sm mb-3">{{ $listing->company_name }} &bull; {{ $listing->location }}</p>

                        <div class="flex flex-wrap items-center gap-2">
                            <span class="px-2.5 py-1 bg-blue-500/20 border border-blue-500/30 text-blue-300 rounded-full text-xs font-medium">
                                {{ $listing->job_type->label() }}
                            </span>

                            <span class="text-gray-400 text-xs">{{ $listing->formattedSalary() }}</span>

                            @if (! empty($listing->tech_stack))
                                @foreach (array_slice($listing->tech_stack, 0, 4) as $tech)
                                    <span class="px-2.5 py-1 bg-white/5 border border-white/10 text-gray-300 rounded-full text-xs">
                                        {{ $tech }}
                                    </span>
                                @endforeach
                                @if (count($listing->tech_stack) > 4)
                                    <span class="text-gray-500 text-xs">+{{ count($listing->tech_stack) - 4 }} lagi</span>
                                @endif
                            @endif
                        </div>
                    </div>

                    <div class="text-right flex-shrink-0 hidden sm:block">
                        <p class="text-xs text-gray-500">{{ $listing->created_at->diffForHumans() }}</p>
                        @if ($listing->expires_at)
                            <p class="text-xs text-orange-400 mt-1">Hingga {{ $listing->expires_at->format('d M Y') }}</p>
                        @endif
                    </div>
                </div>
            </a>
        @empty
            <div class="text-center py-24">
                <div class="w-20 h-20 mx-auto mb-6 rounded-full bg-white/5 flex items-center justify-center">
                    <i data-lucide="briefcase" class="w-10 h-10 text-gray-600"></i>
                </div>
                <p class="text-gray-400 text-lg">Belum ada lowongan yang tersedia.</p>
                @if (request()->hasAny(['stack', 'location', 'type', 'remote']))
                    <a href="{{ route('jobboard.index') }}" class="mt-4 inline-block text-blue-400 hover:text-blue-300 text-sm transition">
                        Hapus filter
                    </a>
                @endif
            </div>
        @endforelse

        {{-- Pagination --}}
        @if ($listings->hasPages())
            <div class="mt-8">
                {{ $listings->links() }}
            </div>
        @endif
    </div>
</x-layouts.base>
