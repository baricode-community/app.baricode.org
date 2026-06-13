<x-layouts.base :title="__('Ungkapkan dengan Seni')">
    <div class="py-12">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-12 text-center">
                <h1 class="text-4xl font-bold text-white mb-2">{{ __('Ungkapkan dengan Seni') }}</h1>
                <p class="text-gray-300">{{ __('Galeri meme dari komunitas Baricode') }}</p>
            </div>

            <!-- Memes Gallery Section -->
            <livewire:fun.memes-gallery />
        </div>
    </div>

    <!-- Floating Action Button - Buat Meme -->
    <a 
        href="{{ route('meme.create') }}"
        wire:navigate
        class="fixed bottom-8 right-8 inline-flex items-center justify-center w-16 h-16 bg-gradient-to-r from-purple-600 to-indigo-600 rounded-full shadow-2xl shadow-purple-500/50 hover:shadow-purple-500/70 transition-all transform hover:scale-110 group z-40"
        title="{{ __('Buat Meme Baru') }}"
    >
        <i data-lucide="plus" class="w-7 h-7 text-white group-hover:scale-125 transition-transform"></i>
    </a>
</x-layouts.base>
