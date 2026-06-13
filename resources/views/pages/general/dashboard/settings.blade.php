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
                        <i data-lucide="palette" class="w-6 h-6"></i>
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
                        <i data-lucide="info" class="w-6 h-6"></i>
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
                                    <i data-lucide="user" class="w-6 h-6"></i>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-white">Edit Profil</h3>
                                    <p class="text-sm text-purple-300">Kelola informasi pribadi dan foto profil</p>
                                </div>
                            </div>
                            <i data-lucide="chevron-right" class="w-5 h-5 text-purple-300 group-hover:text-violet-400 transition-colors"></i>
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
                        <i data-lucide="lock" class="w-6 h-6"></i>
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
                        <i data-lucide="settings" class="w-6 h-6"></i>
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
