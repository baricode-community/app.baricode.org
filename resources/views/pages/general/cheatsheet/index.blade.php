<x-layouts.base :title="'Cheat Sheet Library'">
    <style>
        @keyframes slideIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-slideIn { animation: slideIn 0.4s ease-out forwards; }
    </style>

    <div class="max-w-6xl mx-auto px-4 py-8 md:px-8 space-y-8">
        {{-- Header --}}
        <div class="animate-slideIn flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 pb-6 border-b border-purple-700/50">
            <div>
                <h1 class="text-white text-2xl font-bold">Cheat Sheet Library</h1>
                <p class="text-purple-300 text-sm mt-1">Kumpulan referensi cepat dari komunitas Baricode</p>
            </div>
            @auth
                <a href="{{ route('cheatsheet.create') }}"
                   class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-purple-600 to-indigo-600 rounded-xl text-white text-sm font-semibold hover:shadow-lg hover:shadow-purple-500/30 transition-all flex-shrink-0">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Buat Cheat Sheet
                </a>
            @endauth
        </div>

        <livewire:general.cheatsheet-list />
    </div>
</x-layouts.base>
