<x-layouts.base :title="__('Buat Meme Baru')">
    <div class="py-12">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Back Button -->
            <div class="mb-8">
                <a 
                    href="{{ route('memes.index') }}" 
                    wire:navigate
                    class="inline-flex items-center gap-2 text-purple-700 dark:text-purple-300 hover:text-purple-900 dark:hover:text-purple-200 transition-colors"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    {{ __('Kembali ke Feed') }}
                </a>
            </div>

            <!-- Create Meme Form -->
            <livewire:fun.create-meme />
        </div>
    </div>
</x-layouts.base>
