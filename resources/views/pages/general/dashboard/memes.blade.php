<x-layouts.dashboard :title="__('Dashboard Meme')">
    <section class="py-6 bg-gray-50 min-h-screen">
        <div class="container mx-auto px-6">
            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-800 mb-2">Dashboard Meme Saya</h1>
                <p class="text-gray-600">Kelola dan lihat statistik meme yang telah diunggah</p>
            </div>

            <!-- Memes Table/Grid Section -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="p-6 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <h2 class="text-xl font-semibold text-gray-800">Daftar Meme Saya</h2>
                        <a href="{{ route('meme.create') }}" class="inline-flex items-center px-4 py-2 bg-pink-600 text-white rounded-lg hover:bg-pink-700 transition-colors">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            {{ __('Buat Meme Baru') }}
                        </a>
                    </div>
                </div>

                <!-- Memes List -->
                <livewire:dashboard.my-memes-list />
            </div>
        </div>
    </section>
</x-layouts.dashboard>
