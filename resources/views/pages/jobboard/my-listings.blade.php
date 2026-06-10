<x-layouts.base :title="__('Lowongan Saya — Job Board')">
    <div class="w-full p-4">

        {{-- Breadcrumb --}}
        <nav class="flex items-center gap-2 text-sm text-blue-400 mb-8">
            <a href="{{ route('jobboard.index') }}" class="hover:text-blue-300 transition">Job Board</a>
            <svg class="w-4 h-4 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
            </svg>
            <span class="text-gray-400">Lowongan Saya</span>
        </nav>

        {{-- Header --}}
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-3xl font-extrabold text-white mb-1">Lowongan Saya</h1>
                <p class="text-gray-400">Pantau status lowongan yang kamu submit.</p>
            </div>
            <a href="{{ route('jobboard.post') }}"
                class="inline-flex items-center gap-2 px-4 py-2.5 bg-gradient-to-r from-blue-600 to-indigo-600 rounded-xl font-semibold text-sm hover:from-blue-500 hover:to-indigo-500 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Post Baru
            </a>
        </div>

        @if (session('success'))
            <div class="mb-6 p-4 bg-green-500/10 border border-green-500/30 rounded-xl text-green-400 text-sm">
                {{ session('success') }}
            </div>
        @endif

        @forelse ($listings as $listing)
            @php
                $statusColors = [
                    'pending' => 'text-yellow-400 bg-yellow-500/10 border-yellow-500/30',
                    'approved' => 'text-green-400 bg-green-500/10 border-green-500/30',
                    'rejected' => 'text-red-400 bg-red-500/10 border-red-500/30',
                ];
                $statusColor = $statusColors[$listing->status->value] ?? 'text-gray-400 bg-white/5 border-white/10';
            @endphp

            <div class="bg-white/5 border border-white/10 rounded-2xl p-6 mb-4">
                <div class="flex items-start justify-between gap-4">
                    <div class="flex-1 min-w-0">
                        <div class="flex flex-wrap items-center gap-2 mb-1">
                            <h2 class="text-lg font-bold text-white truncate">{{ $listing->title }}</h2>
                            <span class="px-2.5 py-0.5 text-xs font-medium border rounded-full {{ $statusColor }}">
                                {{ $listing->status->label() }}
                            </span>
                        </div>
                        <p class="text-gray-400 text-sm mb-3">{{ $listing->company_name }} &bull; {{ $listing->location }} &bull; {{ $listing->job_type->label() }}</p>

                        @if ($listing->isRejected() && $listing->rejection_note)
                            <div class="p-3 bg-red-500/10 border border-red-500/20 rounded-xl text-sm text-red-300 mb-3">
                                <span class="font-medium">Alasan penolakan:</span> {{ $listing->rejection_note }}
                            </div>
                        @endif

                        <div class="flex flex-wrap items-center gap-4 text-xs text-gray-500">
                            <span>Disubmit {{ $listing->created_at->diffForHumans() }}</span>
                            @if ($listing->isApproved())
                                <span>{{ $listing->views_count }} views</span>
                                @if ($listing->expires_at)
                                    <span class="{{ $listing->isExpired() ? 'text-red-400' : 'text-orange-400' }}">
                                        {{ $listing->isExpired() ? 'Kadaluarsa' : 'Berlaku hingga' }} {{ $listing->expires_at->format('d M Y') }}
                                    </span>
                                @endif
                            @endif
                        </div>
                    </div>

                    @if ($listing->isApproved() && ! $listing->isExpired())
                        <a href="{{ route('jobboard.show', $listing->slug) }}"
                            class="flex-shrink-0 px-4 py-2 bg-white/10 border border-white/20 rounded-xl text-sm text-gray-300 hover:bg-white/20 transition">
                            Lihat
                        </a>
                    @endif
                </div>
            </div>
        @empty
            <div class="text-center py-24">
                <div class="w-20 h-20 mx-auto mb-6 rounded-full bg-white/5 flex items-center justify-center">
                    <svg class="w-10 h-10 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
                <p class="text-gray-400 text-lg mb-2">Belum ada lowongan yang kamu submit.</p>
                <a href="{{ route('jobboard.post') }}" class="text-blue-400 hover:text-blue-300 text-sm transition">
                    Post lowongan pertamamu
                </a>
            </div>
        @endforelse
    </div>
</x-layouts.base>
