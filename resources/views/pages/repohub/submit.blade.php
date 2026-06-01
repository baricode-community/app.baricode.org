<x-layouts.base :title="__('Submit Repo — RepoHub')">
    <div class="max-w-2xl mx-auto px-4 py-12">

        {{-- Breadcrumb --}}
        <nav class="flex items-center gap-2 text-sm text-purple-400 mb-8">
            <a href="{{ route('repohub.index') }}" class="hover:text-purple-300 transition">RepoHub</a>
            <svg class="w-4 h-4 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
            </svg>
            <span class="text-gray-400">Submit Repo</span>
        </nav>

        {{-- Header --}}
        <div class="mb-8">
            <h1 class="text-3xl font-extrabold text-white mb-2">Submit Repo</h1>
            <p class="text-gray-400">Rekomendasikan repositori keren ke komunitas Baricode. Akan direview oleh admin sebelum dipublikasikan.</p>
        </div>

        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-500/10 border border-red-500/30 rounded-xl text-red-400 text-sm space-y-1">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('repohub.submit.store') }}" class="space-y-6">
            @csrf

            {{-- Title --}}
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1.5">
                    Nama Repo <span class="text-red-400">*</span>
                </label>
                <input type="text" name="title" value="{{ old('title') }}"
                    placeholder="cth: Laravel Breeze, shadcn/ui"
                    class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-purple-500/60 focus:ring-1 focus:ring-purple-500/30 transition @error('title') border-red-500/50 @enderror">
            </div>

            {{-- Repo URL --}}
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1.5">
                    Repository URL <span class="text-red-400">*</span>
                </label>
                <input type="url" name="repo_url" value="{{ old('repo_url') }}"
                    placeholder="https://github.com/username/repo"
                    class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-purple-500/60 focus:ring-1 focus:ring-purple-500/30 transition @error('repo_url') border-red-500/50 @enderror">
            </div>

            {{-- Demo URL --}}
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1.5">
                    Demo URL <span class="text-gray-500 font-normal">(opsional)</span>
                </label>
                <input type="url" name="demo_url" value="{{ old('demo_url') }}"
                    placeholder="https://demo.example.com"
                    class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-purple-500/60 focus:ring-1 focus:ring-purple-500/30 transition @error('demo_url') border-red-500/50 @enderror">
            </div>

            {{-- Description --}}
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1.5">
                    Deskripsi <span class="text-red-400">*</span>
                </label>
                <textarea name="description" rows="4"
                    placeholder="Jelaskan apa yang dilakukan repo ini..."
                    class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-purple-500/60 focus:ring-1 focus:ring-purple-500/30 transition resize-none @error('description') border-red-500/50 @enderror">{{ old('description') }}</textarea>
            </div>

            {{-- Why Recommended --}}
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1.5">
                    Kenapa Rekomendasikan? <span class="text-red-400">*</span>
                </label>
                <textarea name="why_recommended" rows="4"
                    placeholder="Apa yang membuat repo ini layak direkomendasikan ke developer Indonesia?"
                    class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-purple-500/60 focus:ring-1 focus:ring-purple-500/30 transition resize-none @error('why_recommended') border-red-500/50 @enderror">{{ old('why_recommended') }}</textarea>
            </div>

            {{-- Tags --}}
            @php $allTags = \App\Models\RepoHub\RepoHubTag::orderBy('name')->get(); @endphp
            @if ($allTags->isNotEmpty())
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">
                        Tags <span class="text-gray-500 font-normal">(opsional)</span>
                    </label>
                    <div class="flex flex-wrap gap-2">
                        @foreach ($allTags as $tag)
                            <label class="cursor-pointer">
                                <input type="checkbox" name="tags[]" value="{{ $tag->id }}" class="sr-only peer"
                                    {{ in_array($tag->id, old('tags', [])) ? 'checked' : '' }}>
                                <span class="px-3 py-1.5 rounded-full text-sm border border-white/10 text-gray-400 peer-checked:bg-purple-500/20 peer-checked:border-purple-500/40 peer-checked:text-purple-300 hover:border-white/20 transition select-none">
                                    # {{ $tag->name }}
                                </span>
                            </label>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- Info --}}
            <div class="flex items-start gap-3 p-4 bg-blue-500/10 border border-blue-500/20 rounded-xl text-sm text-blue-300">
                <svg class="w-5 h-5 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <p>Submission kamu akan direview oleh admin Baricode. Cek status di <a href="{{ route('repohub.my-submissions') }}" class="underline hover:text-blue-200">My Submissions</a>.</p>
            </div>

            {{-- Submit --}}
            <div class="flex items-center gap-4 pt-2">
                <button type="submit"
                    class="px-6 py-3 bg-gradient-to-r from-purple-600 to-indigo-600 rounded-xl font-semibold text-white hover:from-purple-500 hover:to-indigo-500 transition shadow-lg hover:shadow-purple-500/30">
                    Submit Repo
                </button>
                <a href="{{ route('repohub.index') }}" class="text-gray-400 hover:text-gray-300 transition text-sm">
                    Batal
                </a>
            </div>
        </form>
    </div>
</x-layouts.base>
