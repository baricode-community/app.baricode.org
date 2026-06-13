<x-layouts.base :title="__('Buat Meme Baru')">
    <div class="py-12">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Back Button -->
            <div class="mb-8">
                <a
                    href="{{ route('meme.index') }}"
                    wire:navigate
                    class="inline-flex items-center gap-2 text-purple-300 hover:text-purple-200 transition-colors"
                >
                    <i data-lucide="arrow-left" class="w-5 h-5"></i>
                    {{ __('Kembali ke Feed') }}
                </a>
            </div>

            <!-- Create Meme Form -->
            <livewire:fun.create-meme />
        </div>
    </div>
</x-layouts.base>
