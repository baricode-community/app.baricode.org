<x-layouts.dashboard :title="__('Semua Kursus - Baricode LMS')">
    {{-- Header --}}
    <div class="bg-gradient-to-r from-purple-800 to-indigo-800 text-white py-12 border-b border-purple-600">
        <div class="max-w-7xl mx-auto px-4">
            <h1 class="text-4xl font-bold mb-2">Jelajahi Semua Kursus 🚀</h1>
            <p class="text-purple-200 text-lg mb-6">Temukan kursus yang tepat untuk mengembangkan skill coding kamu</p>

            <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4 flex-wrap">
                <div class="flex items-center gap-3 bg-white/10 backdrop-blur-sm px-4 py-2 rounded-lg border border-white/20">
                    <i data-lucide="package" class="w-5 h-5 flex-shrink-0"></i>
                    <span class="text-sm font-medium">Belajar Mandiri - Kapan Saja, Dimana Saja 📚</span>
                </div>

                <a href="https://chat.whatsapp.com/Fb2ZFMIKDz7JJZyBVpzXws" target="_blank" class="flex items-center gap-2 bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded-lg font-semibold transition transform hover:scale-105 shadow-lg">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.67-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.076 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421-7.403h-.004a9.87 9.87 0 00-5.031 1.378c-3.055 2.169-3.865 6.15-1.728 9.244 1.592 2.238 4.165 2.728 5.55 2.468h.004c.3-.038.573-.125.855-.236l3.686 1.237-.96-3.02c.2-.537.34-1.115.34-1.727C14.596 11.366 11.172 7.979 6.951 7.979z"/>
                    </svg>
                    Bergabung WhatsApp Group
                </a>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 py-12">
        <livewire:lms.courses-list />
    </div>

    <style>
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        .animate-float { animation: float 3s ease-in-out infinite; }
    </style>
</x-layouts.dashboard>
