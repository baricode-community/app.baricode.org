<x-layouts.base :title="__('RepoHub — Koleksi Repo Keren')">
    {{-- Hero --}}
    <div class="relative py-20 px-4 overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-purple-900/50 via-indigo-900/40 to-gray-900/60 pointer-events-none"></div>
        <div class="relative z-10 max-w-4xl mx-auto text-center">
            <div class="inline-flex items-center gap-2 px-4 py-2 bg-purple-500/20 border border-purple-500/30 rounded-full text-purple-300 text-sm font-medium mb-6">
                <span>🔥</span>
                <span>Dikurasi oleh Baricode</span>
            </div>
            <h1 class="text-4xl md:text-6xl font-extrabold mb-4 bg-gradient-to-r from-purple-400 via-violet-400 to-indigo-400 bg-clip-text text-transparent">
                RepoHub
            </h1>
            <p class="text-xl text-gray-300 mb-8 max-w-2xl mx-auto">
                Kumpulan repositori GitHub pilihan yang kami rekomendasikan untuk developer Indonesia.
            </p>
            <div class="flex flex-wrap items-center justify-center gap-3">
                @auth
                    <a href="{{ route('repohub.submit') }}"
                        class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-purple-600 to-indigo-600 rounded-xl font-semibold text-sm hover:from-purple-500 hover:to-indigo-500 transition shadow-lg hover:shadow-purple-500/30">
                        <i data-lucide="plus" class="w-4 h-4"></i>
                        Submit Repo
                    </a>
                    <a href="{{ route('repohub.my-submissions') }}"
                        class="inline-flex items-center gap-2 px-5 py-2.5 bg-white/10 border border-white/20 rounded-xl font-semibold text-sm hover:bg-white/20 transition">
                        Submission Saya
                    </a>
                @else
                    <a href="{{ route('login') }}"
                        class="inline-flex items-center gap-2 px-5 py-2.5 bg-white/10 border border-white/20 rounded-xl font-semibold text-sm hover:bg-white/20 transition">
                        Login untuk Submit Repo
                    </a>
                @endauth
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 pb-20">
        <livewire:general.repohub-list />
    </div>
</x-layouts.base>
