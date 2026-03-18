<x-layouts.base :title="__('Ungkapkan dengan Seni')">
    <div class="py-12">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-12 text-center">
                <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-2">{{ __('Ungkapkan dengan Seni') }}</h1>
                <p class="text-gray-600 dark:text-gray-300">{{ __('Galeri meme dari komunitas Baricode') }}</p>
            </div>

            <!-- Memes Gallery Section -->
            <livewire:fun.memes-gallery />
        </div>
    </div>

    <!-- Floating Action Button - Buat Meme -->
    <a 
        href="{{ route('memes.create') }}"
        wire:navigate
        class="fixed bottom-8 right-8 inline-flex items-center justify-center w-16 h-16 bg-gradient-to-r from-purple-600 to-indigo-600 rounded-full shadow-2xl shadow-purple-500/50 hover:shadow-purple-500/70 transition-all transform hover:scale-110 group z-40"
        title="{{ __('Buat Meme Baru') }}"
    >
        <svg class="w-7 h-7 text-white group-hover:scale-125 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
        </svg>
    </a>
</x-layouts.base>
