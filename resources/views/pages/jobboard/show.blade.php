<x-layouts.base :title="$jobListing->title . ' at ' . $jobListing->company_name . ' — Job Board'">
    <div class="w-full p-4">

        {{-- Breadcrumb --}}
        <nav class="flex items-center gap-2 text-sm text-blue-400 mb-8">
            <a href="{{ route('jobboard.index') }}" class="hover:text-blue-300 transition">Job Board</a>
            <i data-lucide="chevron-right" class="w-4 h-4 text-gray-600"></i>
            <span class="text-gray-400 truncate">{{ $jobListing->title }}</span>
        </nav>

        {{-- Header Card --}}
        <div class="bg-gradient-to-br from-blue-900/40 via-indigo-900/30 to-gray-900/40 backdrop-blur border border-blue-500/30 rounded-3xl p-8 mb-8">
            <div class="flex items-start gap-6 mb-6">
                @if ($jobListing->company_logo)
                    <img src="{{ $jobListing->company_logo }}" alt="{{ $jobListing->company_name }}"
                        class="w-20 h-20 rounded-2xl object-contain bg-white/10 flex-shrink-0">
                @else
                    <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-blue-600 to-indigo-600 flex items-center justify-center flex-shrink-0 text-3xl font-bold text-white">
                        {{ strtoupper(substr($jobListing->company_name, 0, 1)) }}
                    </div>
                @endif

                <div class="flex-1 min-w-0">
                    <h1 class="text-3xl font-extrabold text-white mb-1">{{ $jobListing->title }}</h1>
                    <p class="text-gray-300 text-lg mb-3">{{ $jobListing->company_name }}</p>

                    <div class="flex flex-wrap items-center gap-2">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-blue-500/20 border border-blue-500/30 text-blue-300 rounded-full text-sm font-medium">
                            <i data-lucide="briefcase" class="w-3.5 h-3.5"></i>
                            {{ $jobListing->job_type->label() }}
                        </span>

                        <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-white/10 border border-white/20 text-gray-300 rounded-full text-sm">
                            <i data-lucide="map-pin" class="w-3.5 h-3.5"></i>
                            {{ $jobListing->location }}
                        </span>

                        @if ($jobListing->is_remote)
                            <span class="px-3 py-1 bg-green-500/20 border border-green-500/30 text-green-400 rounded-full text-sm font-medium">
                                Remote
                            </span>
                        @endif

                        <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-white/5 border border-white/10 text-gray-400 rounded-full text-sm">
                            <i data-lucide="dollar-sign" class="w-3.5 h-3.5"></i>
                            {{ $jobListing->formattedSalary() }}
                        </span>
                    </div>
                </div>
            </div>

            {{-- Apply Buttons --}}
            <div class="flex flex-wrap gap-3">
                @if ($jobListing->apply_url)
                    <a href="{{ $jobListing->apply_url }}" target="_blank" rel="noopener noreferrer"
                        class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 rounded-xl font-semibold hover:from-blue-500 hover:to-indigo-500 transition shadow-lg hover:shadow-blue-500/30">
                        <i data-lucide="external-link" class="w-5 h-5"></i>
                        Apply Sekarang
                    </a>
                @endif

                @if ($jobListing->apply_email)
                    <a href="mailto:{{ $jobListing->apply_email }}"
                        class="inline-flex items-center gap-2 px-6 py-3 bg-white/10 border border-white/20 rounded-xl font-semibold hover:bg-white/20 transition">
                        <i data-lucide="mail" class="w-5 h-5"></i>
                        Kirim Email
                    </a>
                @endif
            </div>

            {{-- Meta info --}}
            <div class="flex flex-wrap items-center gap-4 mt-5 pt-5 border-t border-white/10 text-xs text-gray-500">
                <span>Dipost {{ $jobListing->created_at->diffForHumans() }}</span>
                <span>{{ $jobListing->views_count }} views</span>
                @if ($jobListing->expires_at)
                    <span class="text-orange-400">Berlaku hingga {{ $jobListing->expires_at->format('d M Y') }}</span>
                @endif
                @if ($jobListing->poster)
                    <span>Dipost oleh <span class="text-gray-400">{{ $jobListing->poster->name }}</span></span>
                @endif
            </div>
        </div>

        {{-- Tech Stack --}}
        @if (! empty($jobListing->tech_stack))
            <div class="bg-white/5 backdrop-blur border border-white/10 rounded-3xl p-6 mb-6">
                <h2 class="text-lg font-bold text-white mb-4">Tech Stack</h2>
                <div class="flex flex-wrap gap-2">
                    @foreach ($jobListing->tech_stack as $tech)
                        <a href="{{ route('jobboard.index', ['stack' => $tech]) }}"
                            class="px-3 py-1.5 bg-blue-500/20 border border-blue-500/40 text-blue-300 rounded-full text-sm font-medium hover:bg-blue-500/30 transition">
                            {{ $tech }}
                        </a>
                    @endforeach
                </div>
            </div>
        @endif

        {{-- Deskripsi --}}
        <div class="bg-white/5 backdrop-blur border border-white/10 rounded-3xl p-8 mb-6">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 rounded-full bg-gradient-to-r from-blue-500 to-indigo-500 flex items-center justify-center text-lg">
                    📋
                </div>
                <h2 class="text-xl font-bold text-white">Deskripsi Pekerjaan</h2>
            </div>
            <div class="text-gray-300 leading-relaxed whitespace-pre-wrap">{{ $jobListing->description }}</div>
        </div>

        {{-- Persyaratan --}}
        <div class="bg-white/5 backdrop-blur border border-white/10 rounded-3xl p-8 mb-6">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 rounded-full bg-gradient-to-r from-purple-500 to-pink-500 flex items-center justify-center text-lg">
                    ✅
                </div>
                <h2 class="text-xl font-bold text-white">Persyaratan</h2>
            </div>
            <div class="text-gray-300 leading-relaxed whitespace-pre-wrap">{{ $jobListing->requirements }}</div>
        </div>

        {{-- Back --}}
        <a href="{{ route('jobboard.index') }}"
            class="inline-flex items-center gap-2 text-sm text-gray-400 hover:text-gray-300 transition">
            <i data-lucide="chevron-left" class="w-4 h-4"></i>
            Kembali ke Job Board
        </a>
    </div>
</x-layouts.base>
