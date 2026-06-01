<x-layouts.base :title="__('My Submissions — RepoHub')">
    <div class="max-w-3xl mx-auto px-4 py-12">

        {{-- Breadcrumb --}}
        <nav class="flex items-center gap-2 text-sm text-purple-400 mb-8">
            <a href="{{ route('repohub.index') }}" class="hover:text-purple-300 transition">RepoHub</a>
            <svg class="w-4 h-4 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
            </svg>
            <span class="text-gray-400">My Submissions</span>
        </nav>

        {{-- Header --}}
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-3xl font-extrabold text-white mb-1">My Submissions</h1>
                <p class="text-gray-400 text-sm">{{ $submissions->count() }} repo disubmit</p>
            </div>
            <a href="{{ route('repohub.submit') }}"
                class="inline-flex items-center gap-2 px-4 py-2.5 bg-gradient-to-r from-purple-600 to-indigo-600 rounded-xl font-semibold text-sm text-white hover:from-purple-500 hover:to-indigo-500 transition shadow-lg hover:shadow-purple-500/30">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Submit Repo
            </a>
        </div>

        @if (session('success'))
            <div class="mb-6 p-4 bg-green-500/10 border border-green-500/30 rounded-xl text-green-400 text-sm flex items-center gap-2">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                {{ session('success') }}
            </div>
        @endif

        @if ($submissions->isEmpty())
            <div class="text-center py-20 text-gray-500">
                <svg class="w-12 h-12 mx-auto mb-4 opacity-40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/>
                </svg>
                <p class="font-medium mb-1">Belum ada submission</p>
                <p class="text-sm mb-6">Submit repo pertamamu dan bantu komunitas Baricode berkembang.</p>
                <a href="{{ route('repohub.submit') }}" class="text-purple-400 hover:text-purple-300 text-sm underline">Submit sekarang</a>
            </div>
        @else
            <div class="space-y-4">
                @foreach ($submissions as $repo)
                    @php
                        $statusColor = match ($repo->status->value) {
                            'pending' => ['bg' => 'bg-yellow-500/10', 'border' => 'border-yellow-500/20', 'text' => 'text-yellow-400', 'dot' => 'bg-yellow-400'],
                            'approved' => ['bg' => 'bg-green-500/10', 'border' => 'border-green-500/20', 'text' => 'text-green-400', 'dot' => 'bg-green-400'],
                            'rejected' => ['bg' => 'bg-red-500/10', 'border' => 'border-red-500/20', 'text' => 'text-red-400', 'dot' => 'bg-red-400'],
                            default => ['bg' => 'bg-white/5', 'border' => 'border-white/10', 'text' => 'text-gray-400', 'dot' => 'bg-gray-400'],
                        };
                    @endphp
                    <div class="bg-white/5 border border-white/10 rounded-2xl p-5 hover:border-white/20 transition">
                        <div class="flex items-start justify-between gap-4">
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center gap-2 mb-1">
                                    <h3 class="font-semibold text-white truncate">{{ $repo->title }}</h3>
                                </div>
                                <a href="{{ $repo->repo_url }}" target="_blank" rel="noopener noreferrer"
                                    class="text-sm text-purple-400 hover:text-purple-300 transition truncate block max-w-xs">
                                    {{ $repo->repo_url }}
                                </a>
                            </div>
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 {{ $statusColor['bg'] }} {{ $statusColor['border'] }} border rounded-full text-xs font-medium {{ $statusColor['text'] }} flex-shrink-0">
                                <span class="w-1.5 h-1.5 rounded-full {{ $statusColor['dot'] }}"></span>
                                {{ $repo->status->label() }}
                            </span>
                        </div>

                        @if ($repo->tags->isNotEmpty())
                            <div class="flex flex-wrap gap-1.5 mt-3">
                                @foreach ($repo->tags as $tag)
                                    <span class="px-2 py-0.5 bg-purple-500/10 border border-purple-500/20 text-purple-400 rounded-full text-xs">
                                        # {{ $tag->name }}
                                    </span>
                                @endforeach
                            </div>
                        @endif

                        @if ($repo->isRejected() && $repo->rejection_note)
                            <div class="mt-4 p-3 bg-red-500/10 border border-red-500/20 rounded-xl text-sm text-red-300">
                                <p class="font-medium mb-0.5">Alasan penolakan:</p>
                                <p class="text-red-400/80">{{ $repo->rejection_note }}</p>
                            </div>
                        @endif

                        @if ($repo->isApproved())
                            <div class="mt-4">
                                <a href="{{ route('repohub.show', $repo->slug) }}"
                                    class="inline-flex items-center gap-1.5 text-sm text-green-400 hover:text-green-300 transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                    </svg>
                                    Lihat di RepoHub
                                </a>
                            </div>
                        @endif

                        <p class="text-xs text-gray-600 mt-3">Disubmit {{ $repo->created_at->diffForHumans() }}</p>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-layouts.base>
