<x-layouts.base :title="__('My Submissions — RepoHub')">
    <div class="max-w-3xl mx-auto px-4 py-12">

        {{-- Breadcrumb --}}
        <nav class="flex items-center gap-2 text-sm text-purple-400 mb-8">
            <a href="{{ route('repohub.index') }}" class="hover:text-purple-300 transition">RepoHub</a>
            <i data-lucide="chevron-right" class="w-4 h-4 text-gray-600"></i>
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
                <i data-lucide="plus" class="w-4 h-4"></i>
                Submit Repo
            </a>
        </div>

        @if (session('success'))
            <div class="mb-6 p-4 bg-green-500/10 border border-green-500/30 rounded-xl text-green-400 text-sm flex items-center gap-2">
                <i data-lucide="check-circle" class="w-5 h-5 flex-shrink-0"></i>
                {{ session('success') }}
            </div>
        @endif

        @if ($submissions->isEmpty())
            <div class="text-center py-20 text-gray-500">
                <i data-lucide="folder" class="w-12 h-12 mx-auto mb-4 opacity-40"></i>
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
                                    <i data-lucide="external-link" class="w-4 h-4"></i>
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
