<x-layouts.dashboard :title="__('Pengaturan Platform')">
    <style>
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-slideIn {
            animation: slideIn 0.6s ease-out forwards;
        }

        .settings-card:nth-child(1) {
            animation-delay: 0.1s;
        }

        .settings-card:nth-child(2) {
            animation-delay: 0.2s;
        }

        .settings-card:nth-child(3) {
            animation-delay: 0.3s;
        }
    </style>

    <!-- Main Content -->

    <div class="">
        <!-- Header Section -->
        <div class="mb-16 md:mb-20">
            <div class="mb-4">
                <span
                    class="inline-block px-6 py-2 bg-gradient-to-r from-purple-500 to-indigo-500 text-white font-semibold rounded-full text-sm shadow">⚙️
                    Konfigurasi</span>
            </div>
            <h1 class="text-4xl md:text-5xl font-bold text-white leading-tight mb-4">
                Pengaturan Platform
            </h1>
            <p class="text-lg text-purple-200 max-w-2xl leading-relaxed">
                Kelola preferensi akun dan tampilan platform Anda sesuai kebutuhan. Semua perubahan akan disimpan secara
                otomatis untuk memberikan pengalaman terbaik.
            </p>
        </div>

        <!-- Settings Sections -->
        <div class="space-y-12">
            <!-- Appearance Settings Section -->
            <div class="animate-slideIn">
                <div class="flex items-center gap-2 mb-6">
                    <div
                        class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-gradient-to-r from-purple-500 to-indigo-500 text-white shadow-lg">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01">
                            </path>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-white">Tampilan & Tema</h2>
                </div>

                @if (auth()->user()->hasRole('admin'))
                    <div
                        class="bg-gradient-to-br from-purple-500/10 to-transparent backdrop-blur-lg rounded-2xl border border-purple-500/20 hover:border-purple-500/50 p-8 transition-all duration-300 hover:shadow-xl hover:shadow-purple-500/20">
                        <p class="text-purple-200 mb-8">
                            Pilih tema tampilan yang paling nyaman untuk Anda. Tema akan menyesuaikan dengan preferensi
                            sistem atau pilihan Anda secara manual.
                        </p>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <flux:radio.group x-data variant="segmented" x-model="$flux.appearance"
                                class="grid grid-cols-3 w-full">
                                <flux:radio value="light" icon="sun">{{ __('Terang') }}</flux:radio>
                                <flux:radio value="dark" icon="moon">{{ __('Gelap') }}</flux:radio>
                                <flux:radio value="system" icon="computer-desktop">{{ __('Sistem') }}</flux:radio>
                            </flux:radio.group>
                        </div>

                        <div class="mt-6 p-4 bg-purple-500/20 backdrop-blur-lg rounded-lg border border-purple-500/30">
                            <p class="text-sm text-purple-200">
                                💡 <strong>Tips:</strong> Pilih "Sistem" untuk mengikuti preferensi perangkat Anda
                                secara
                                otomatis.
                            </p>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Account Settings Section -->
            <div class="animate-slideIn" style="animation-delay: 0.1s;">
                <div class="flex items-center gap-2 mb-6">
                    <div
                        class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-gradient-to-r from-violet-500 to-indigo-500 text-white shadow-lg">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-white">Informasi Akun</h2>
                </div>

                <div
                    class="bg-gradient-to-br from-violet-500/10 to-transparent backdrop-blur-lg rounded-2xl border border-violet-500/20 hover:border-violet-500/50 p-8 transition-all duration-300 hover:shadow-xl hover:shadow-violet-500/20">
                    <p class="text-purple-200 mb-8">
                        Lihat dan kelola informasi akun Anda. Untuk mengubah profil atau keamanan akun, kunjungi halaman
                        profil.
                    </p>

                    <div class="space-y-4">
                        <a href="{{ route('profile.edit') }}"
                            class="flex items-center justify-between p-6 bg-white/5 backdrop-blur-lg rounded-xl border border-violet-500/20 hover:border-violet-500/60 transition-all hover:shadow-xl hover:shadow-violet-500/20 group">
                            <div class="flex items-center gap-4">
                                <div
                                    class="inline-flex items-center justify-center w-12 h-12 rounded-lg bg-gradient-to-r from-violet-500 to-indigo-500 text-white group-hover:shadow-lg transition-all">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                        </path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-white">Edit Profil</h3>
                                    <p class="text-sm text-purple-300">Kelola informasi pribadi dan foto profil</p>
                                </div>
                            </div>
                            <svg class="w-5 h-5 text-purple-300 group-hover:text-violet-400 transition-colors"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                </path>
                            </svg>
                        </a>
                    </div>

                    <div class="mt-6 p-4 bg-violet-500/20 backdrop-blur-lg rounded-lg border border-violet-500/30">
                        <p class="text-sm text-purple-200">
                            👤 <strong>Informasi Akun:</strong> Anda masuk sebagai <span
                                class="font-semibold">{{ auth()->user()->name }}</span>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Security Section -->
            <div class="animate-slideIn" style="animation-delay: 0.2s;">
                <div class="flex items-center gap-2 mb-6">
                    <div
                        class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-gradient-to-r from-pink-500 to-rose-500 text-white shadow-lg">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                            </path>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-white">Keamanan & Privasi</h2>
                </div>

                <div
                    class="bg-gradient-to-br from-pink-500/10 to-transparent backdrop-blur-lg rounded-2xl border border-pink-500/20 hover:border-pink-500/50 p-8 transition-all duration-300 hover:shadow-xl hover:shadow-pink-500/20">
                    <p class="text-purple-200 mb-8">
                        Jaga keamanan akun Anda dengan mengelola sesi dan keluar dari perangkat lain.
                    </p>

                    <form method="POST" action="{{ route('logout') }}" class="inline-block w-full">
                        @csrf
                        <flux:button type="submit" variant="danger" class="w-full md:w-auto">
                            {{ __('Keluar dari Akun') }}
                        </flux:button>
                    </form>

                    <div class="mt-6 p-4 bg-pink-500/20 backdrop-blur-lg rounded-lg border border-pink-500/30">
                        <p class="text-sm text-pink-200">
                            🔒 <strong>Catatan:</strong> Anda akan keluar dari sesi ini. Untuk alasan keamanan, Anda
                            mungkin perlu login kembali.
                        </p>
                    </div>
                </div>
            </div>

            <!-- System Settings Section -->
            <div class="animate-slideIn" style="animation-delay: 0.3s;">
                <div class="flex items-center gap-2 mb-6">
                    <div
                        class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-gradient-to-r from-indigo-500 to-purple-500 text-white shadow-lg">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                            </path>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-white">Pengaturan Sistem</h2>
                </div>

                <div
                    class="bg-gradient-to-br from-indigo-500/10 to-transparent backdrop-blur-lg rounded-2xl border border-indigo-500/20 hover:border-indigo-500/50 p-8 transition-all duration-300 hover:shadow-xl hover:shadow-indigo-500/20">
                    <p class="text-purple-200 mb-8">
                        Informasi sistem dan konfigurasi teknis platform.
                    </p>

                    <div class="mt-6 p-4 bg-indigo-500/20 backdrop-blur-lg rounded-lg border border-indigo-500/30">
                        <p class="text-sm text-indigo-200">
                            ✨ <strong>Update:</strong> Fitur sistem akan segera tersedia di versi mendatang.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer Info -->
        <div class="mt-16 pt-8 border-t border-purple-700">
            <p class="text-center text-purple-300 text-sm">
                Butuh bantuan? Hubungi tim support kami melalui halaman bantuan atau email support@baricode.id
            </p>
        </div>
    </div>
</x-layouts.dashboard>
