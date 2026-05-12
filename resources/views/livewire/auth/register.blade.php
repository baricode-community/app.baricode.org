<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    @include('partials.head')
</head>
<body>
    <div class="min-h-screen bg-gradient-to-br from-gray-900 via-purple-900 to-indigo-900 text-white overflow-hidden flex items-center justify-center px-4 py-20">
        
        <!-- Background Code Snippets -->
        <div class="fixed inset-0 opacity-5 pointer-events-none">
            <pre class="text-purple-300 text-sm">
function register() {
    const user = createUser();
    return user.save();
}
            </pre>
        </div>

        <!-- Floating Decorations -->
        <div class="absolute top-20 right-10 animate-bounce delay-100">
            <div class="bg-purple-500/20 backdrop-blur-lg rounded-3xl p-4 text-4xl">✨</div>
        </div>
        <div class="absolute bottom-40 left-20 animate-bounce delay-500">
            <div class="bg-indigo-500/20 backdrop-blur-lg rounded-3xl p-4 text-4xl">🚀</div>
        </div>

        <div class="max-w-md w-full z-10">
            <!-- Logo Section -->
            <div class="text-center mb-12">
                <h1 class="text-4xl font-bold mb-3 bg-gradient-to-r from-purple-400 via-violet-400 to-indigo-400 bg-clip-text text-transparent">
                    {{ __('Mulai Belajar') }}
                </h1>
                <p class="text-gray-300 text-lg">
                    {{ __('Bergabung dengan ribuan developer di Baricode') }}
                </p>
            </div>

            <!-- Session Status -->
            @if (session('status'))
                <div class="mb-6 p-4 bg-green-500/20 border border-green-500/50 rounded-2xl text-green-300 text-sm">
                    {{ session('status') }}
                </div>
            @endif

            <!-- Register Form -->
            <div class="bg-gradient-to-br from-purple-500/10 to-indigo-500/10 backdrop-blur-xl rounded-3xl p-8 border border-purple-500/20 mb-8">
                <form method="POST" action="{{ route('register.store') }}" class="flex flex-col gap-5">
                    @csrf

                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-300 mb-2">
                            {{ __('Nama Lengkap') }}
                        </label>
                        <input
                            id="name"
                            name="name"
                            type="text"
                            :value="old('name')"
                            required
                            autocomplete="name"
                            placeholder="Nama kamu"
                            class="w-full px-4 py-3 bg-white/5 border border-purple-500/30 rounded-xl text-white placeholder-gray-400 focus:outline-none focus:border-purple-500/60 focus:ring-2 focus:ring-purple-500/20 transition-all"
                        />
                        @error('name')
                            <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Username -->
                    <div>
                        <label for="username" class="block text-sm font-medium text-gray-300 mb-2">
                            {{ __('Username') }}
                        </label>
                        <input
                            id="username"
                            name="username"
                            type="text"
                            :value="old('username')"
                            required
                            autocomplete="username"
                            placeholder="username_kamu"
                            class="w-full px-4 py-3 bg-white/5 border border-purple-500/30 rounded-xl text-white placeholder-gray-400 focus:outline-none focus:border-purple-500/60 focus:ring-2 focus:ring-purple-500/20 transition-all"
                        />
                        @error('username')
                            <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email Address -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-300 mb-2">
                            {{ __('Email') }}
                        </label>
                        <input
                            id="email"
                            name="email"
                            type="email"
                            :value="old('email')"
                            required
                            autocomplete="email"
                            placeholder="kamu@example.com"
                            class="w-full px-4 py-3 bg-white/5 border border-purple-500/30 rounded-xl text-white placeholder-gray-400 focus:outline-none focus:border-purple-500/60 focus:ring-2 focus:ring-purple-500/20 transition-all"
                        />
                        @error('email')
                            <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-300 mb-2">
                            {{ __('Password') }}
                        </label>
                        <input
                            id="password"
                            name="password"
                            type="password"
                            required
                            autocomplete="new-password"
                            placeholder="Minimal 8 karakter"
                            class="w-full px-4 py-3 bg-white/5 border border-purple-500/30 rounded-xl text-white placeholder-gray-400 focus:outline-none focus:border-purple-500/60 focus:ring-2 focus:ring-purple-500/20 transition-all"
                        />
                        @error('password')
                            <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-300 mb-2">
                            {{ __('Konfirmasi Password') }}
                        </label>
                        <input
                            id="password_confirmation"
                            name="password_confirmation"
                            type="password"
                            required
                            autocomplete="new-password"
                            placeholder="Ulangi password"
                            class="w-full px-4 py-3 bg-white/5 border border-purple-500/30 rounded-xl text-white placeholder-gray-400 focus:outline-none focus:border-purple-500/60 focus:ring-2 focus:ring-purple-500/20 transition-all"
                        />
                        @error('password_confirmation')
                            <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Family Info -->
                    <div class="bg-gradient-to-r from-indigo-500/20 to-purple-500/20 border border-indigo-500/30 rounded-xl p-4">
                        <div class="flex gap-3">
                            <div class="flex-shrink-0 text-2xl">👨‍👩‍👧‍👦</div>
                            <div>
                                <p class="text-sm text-gray-100 font-semibold mb-1">
                                    Setiap akun yang terdaftar otomatis menjadi bagian dari <span class="text-indigo-300">Keluarga Baricode</span>
                                </p>
                                <p class="text-xs text-gray-300">
                                    Profil kamu akan muncul di direktori komunitas dan dapat dilihat oleh semua member.
                                    <a href="{{ route('family.index') }}" class="text-indigo-400 hover:text-indigo-300 font-semibold transition-colors">
                                        Lihat Keluarga →
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Terms Agreement -->
                    <div class="flex items-start gap-3">
                        <input
                            id="agree_terms"
                            name="agree_terms"
                            type="checkbox"
                            required
                            class="h-4 w-4 rounded border-purple-500/30 bg-white/5 text-purple-600 focus:ring-purple-500/20 cursor-pointer mt-1"
                        />
                        <label for="agree_terms" class="text-sm text-gray-300 cursor-pointer">
                            {{ __('Saya setuju dengan') }}
                            <a href="#" class="text-purple-400 hover:text-purple-300 transition-colors">
                                {{ __('Syarat & Ketentuan') }}
                            </a>
                            {{ __('dan') }}
                            <a href="#" class="text-purple-400 hover:text-purple-300 transition-colors">
                                {{ __('Kebijakan Privasi') }}
                            </a>
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <button
                        type="submit"
                        class="w-full px-4 py-3 bg-gradient-to-r from-purple-600 to-indigo-600 rounded-xl font-semibold text-lg hover:shadow-2xl hover:shadow-purple-500/50 transition-all transform hover:scale-105 mt-2"
                        data-test="register-user-button"
                    >
                        {{ __('Daftar Sekarang') }}
                    </button>
                </form>

                <!-- Divider -->
                <div class="flex items-center gap-4 my-6">
                    <div class="flex-1 h-px bg-gradient-to-r from-purple-500/0 to-purple-500/50"></div>
                    <span class="text-sm text-gray-400">{{ __('atau') }}</span>
                    <div class="flex-1 h-px bg-gradient-to-r from-purple-500/50 to-purple-500/0"></div>
                </div>

                <!-- Google Register Button -->
                <a
                    href="{{ route('auth.google') }}"
                    class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-xl font-semibold text-lg hover:bg-white/20 transition-all transform hover:scale-105 flex items-center justify-center gap-3"
                >
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                        <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                        <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                        <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                    </svg>
                    {{ __('Daftar dengan Google') }}
                </a>
            </div>

            <!-- Login Link -->
            <div class="text-center">
                <p class="text-gray-300">
                    {{ __('Sudah punya akun?') }}
                    <a href="{{ route('login') }}" class="text-purple-400 font-semibold hover:text-purple-300 transition-colors" wire:navigate>
                        {{ __('Masuk di sini') }}
                    </a>
                </p>
            </div>

            <!-- Back to Home -->
            <div class="text-center mt-6">
                <a href="{{ route('home') }}" class="text-sm text-gray-400 hover:text-gray-300 transition-colors" wire:navigate>
                    ← {{ __('Kembali ke Beranda') }}
                </a>
            </div>
        </div>
    </div>

    @fluxScripts
</body>
</html>
