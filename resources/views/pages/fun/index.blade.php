<x-layouts.base :title="__('Platform Bahagia')">
    <div class="py-12">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-12 text-center">
                <h1 class="text-4xl font-bold text-white mb-2">{{ __('Platform Bahagia') }}</h1>
                <p class="text-gray-300">{{ __('Selamat datang di Baricode Fun, tempat di mana kreativitas dan hiburan bertemu! Jelajahi berbagai meme lucu, buat meme Anda sendiri, dan bagikan tawa dengan komunitas kami.') }}</p>
                <a href="{{ route('dashboard') }}" class="inline-block mt-6 px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                    {{ __('Menuju Dashboard') }}
                </a>
            </div>
        </div>
    </div>

    {{-- Some features --}}
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 mb-16 grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 text-center">
            <div class="mb-4">
                <i data-lucide="play" class="w-12 h-12 mx-auto text-purple-500"></i>
            </div>
            <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">{{ __('Jelajahi Meme') }}</h3>
            <p class="text-gray-600 dark:text-gray-300">{{ __('Telusuri galeri meme yang dibuat oleh komunitas kami dan temukan tawa baru setiap hari.') }}</p>
            <a href="{{ route('meme.index') }}" class="inline-block mt-4 px-6 py-2 bg-purple-600 text-white rounded hover:bg-purple-700 transition">{{ __('Lihat Meme') }}</a>
        </div>
    </div>
</x-layouts.base>
