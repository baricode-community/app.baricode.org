<x-layouts.base :title="$jobListing->title . ' at ' . $jobListing->company_name . ' — Job Board'">
    <div class="max-w-4xl mx-auto px-4 py-12">

        {{-- Breadcrumb --}}
        <nav class="flex items-center gap-2 text-sm text-blue-400 mb-8">
            <a href="{{ route('jobboard.index') }}" class="hover:text-blue-300 transition">Job Board</a>
            <svg class="w-4 h-4 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
            </svg>
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
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            {{ $jobListing->job_type->label() }}
                        </span>

                        <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-white/10 border border-white/20 text-gray-300 rounded-full text-sm">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            {{ $jobListing->location }}
                        </span>

                        @if ($jobListing->is_remote)
                            <span class="px-3 py-1 bg-green-500/20 border border-green-500/30 text-green-400 rounded-full text-sm font-medium">
                                Remote
                            </span>
                        @endif

                        <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-white/5 border border-white/10 text-gray-400 rounded-full text-sm">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
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
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                        </svg>
                        Apply Sekarang
                    </a>
                @endif

                @if ($jobListing->apply_email)
                    <a href="mailto:{{ $jobListing->apply_email }}"
                        class="inline-flex items-center gap-2 px-6 py-3 bg-white/10 border border-white/20 rounded-xl font-semibold hover:bg-white/20 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
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
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Kembali ke Job Board
        </a>
    </div>
</x-layouts.base>
