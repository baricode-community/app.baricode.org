<x-layouts.base :title="'Menuju ' . $shortLink->title . ' | Baricode'">
    <div class="min-h-screen flex flex-col items-center justify-center px-4 py-20 relative overflow-hidden">

        {{-- Floating decorative elements --}}
        <div class="hidden md:block absolute top-20 left-10 animate-bounce delay-100">
            <div class="bg-purple-500/20 backdrop-blur-lg rounded-3xl p-4 text-4xl">🔗</div>
        </div>
        <div class="hidden md:block absolute top-40 right-20 animate-bounce delay-300">
            <div class="bg-indigo-500/20 backdrop-blur-lg rounded-3xl p-4 text-4xl">🚀</div>
        </div>
        <div class="hidden md:block absolute bottom-40 left-20 animate-bounce delay-500">
            <div class="bg-violet-500/20 backdrop-blur-lg rounded-3xl p-4 text-4xl">💻</div>
        </div>
        <div class="hidden md:block absolute bottom-20 right-10 animate-bounce delay-200">
            <div class="bg-pink-500/20 backdrop-blur-lg rounded-3xl p-4 text-4xl">⚡</div>
        </div>

        {{-- Main card --}}
        <div class="w-full max-w-2xl z-10">

            {{-- Baricode branding --}}
            <div class="text-center mb-8">
                <a href="{{ route('home') }}" class="inline-flex items-center gap-3 group">
                    <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-purple-600 to-indigo-600 flex items-center justify-center text-2xl shadow-lg group-hover:shadow-purple-500/40 transition-all">
                        🔗
                    </div>
                    <span class="text-2xl font-extrabold bg-gradient-to-r from-purple-400 via-violet-400 to-indigo-400 bg-clip-text text-transparent">
                        Baricode
                    </span>
                </a>
                <p class="text-gray-400 text-sm mt-2">Short Link Service</p>
            </div>

            {{-- Countdown card --}}
            <div class="bg-white/5 backdrop-blur-xl rounded-3xl p-8 border border-purple-500/20 shadow-2xl shadow-purple-900/40 mb-8">
                <div class="text-center mb-6">
                    <p class="text-gray-300 text-lg mb-2">Kamu akan diarahkan ke</p>
                    <h1 class="text-2xl md:text-3xl font-bold text-white mb-3">{{ $shortLink->title }}</h1>
                    @if ($shortLink->description)
                        <p class="text-gray-400 text-sm mb-4">{{ $shortLink->description }}</p>
                    @endif
                    <div class="bg-black/30 rounded-xl px-4 py-2 inline-block">
                        <span class="text-purple-300 text-sm font-mono break-all">{{ $shortLink->real_url }}</span>
                    </div>
                </div>

                {{-- Countdown circle --}}
                <div class="flex flex-col items-center justify-center my-8">
                    <div class="relative w-28 h-28">
                        <svg class="w-28 h-28 -rotate-90" viewBox="0 0 120 120">
                            <circle
                                cx="60" cy="60" r="50"
                                fill="none"
                                stroke="rgba(139, 92, 246, 0.15)"
                                stroke-width="10"
                            />
                            <circle
                                id="progress-ring"
                                cx="60" cy="60" r="50"
                                fill="none"
                                stroke="url(#grad)"
                                stroke-width="10"
                                stroke-linecap="round"
                                stroke-dasharray="314"
                                stroke-dashoffset="0"
                                style="transition: stroke-dashoffset 1s linear;"
                            />
                            <defs>
                                <linearGradient id="grad" x1="0%" y1="0%" x2="100%" y2="0%">
                                    <stop offset="0%" style="stop-color:#a855f7"/>
                                    <stop offset="100%" style="stop-color:#6366f1"/>
                                </linearGradient>
                            </defs>
                        </svg>
                        <div class="absolute inset-0 flex items-center justify-center">
                            <span id="countdown" class="text-4xl font-extrabold text-white">3</span>
                        </div>
                    </div>
                    <p class="text-gray-400 text-sm mt-4">detik lagi...</p>
                </div>

                {{-- Skip button --}}
                <div class="text-center">
                    <a id="skip-btn"
                       href="{{ $shortLink->real_url }}"
                       class="inline-block px-8 py-3 bg-gradient-to-r from-purple-600 via-violet-600 to-indigo-600 rounded-full font-bold text-lg shadow-lg hover:shadow-purple-500/40 transition-all transform hover:scale-105 ring-2 ring-purple-400/30 hover:ring-4 hover:ring-indigo-400/40">
                        Lanjut Sekarang →
                    </a>
                </div>
            </div>

            {{-- Baricode promo section --}}
            <div class="bg-gradient-to-r from-purple-600/20 via-violet-600/20 to-indigo-600/20 backdrop-blur-xl rounded-3xl p-8 border border-purple-500/20 shadow-xl">
                <div class="text-center mb-6">
                    <span class="text-3xl">🎉</span>
                    <h2 class="text-xl font-extrabold mt-2 mb-2 bg-gradient-to-r from-purple-400 via-violet-400 to-indigo-400 bg-clip-text text-transparent">
                        Kenalan sama Baricode!
                    </h2>
                    <p class="text-gray-300 text-sm">
                        Komunitas IT terkece di Indonesia. Bersama bertumbuh, belajar, dan berbagi.
                    </p>
                </div>

                <div class="grid grid-cols-2 gap-4 mb-6">
                    <div class="bg-white/5 backdrop-blur-lg rounded-2xl p-4 border border-purple-500/10 text-center">
                        <div class="text-2xl mb-1">💯</div>
                        <p class="text-sm font-semibold text-white">Gratis 100%</p>
                        <p class="text-xs text-gray-400 mt-1">Semua fitur tanpa biaya</p>
                    </div>
                    <div class="bg-white/5 backdrop-blur-lg rounded-2xl p-4 border border-indigo-500/10 text-center">
                        <div class="text-2xl mb-1">🤝</div>
                        <p class="text-sm font-semibold text-white">Kolaborasi</p>
                        <p class="text-xs text-gray-400 mt-1">Proyek bareng tim keren</p>
                    </div>
                    <div class="bg-white/5 backdrop-blur-lg rounded-2xl p-4 border border-violet-500/10 text-center">
                        <div class="text-2xl mb-1">🗺️</div>
                        <p class="text-sm font-semibold text-white">Roadmap Belajar</p>
                        <p class="text-xs text-gray-400 mt-1">Dari pemula ke mahir</p>
                    </div>
                    <div class="bg-white/5 backdrop-blur-lg rounded-2xl p-4 border border-pink-500/10 text-center">
                        <div class="text-2xl mb-1">💬</div>
                        <p class="text-sm font-semibold text-white">Komunitas Aktif</p>
                        <p class="text-xs text-gray-400 mt-1">Tanya kapan aja, ada yang bantu</p>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row gap-3 justify-center">
                    <a href="{{ route('home') }}"
                       class="px-6 py-3 bg-gradient-to-r from-purple-600 via-violet-600 to-indigo-600 rounded-full font-bold text-sm shadow-lg hover:shadow-purple-500/40 transition-all transform hover:scale-105 text-center ring-2 ring-purple-400/30">
                        🚀 Gabung Baricode
                    </a>
                    <a href="https://t.me/baricode_org" target="_blank" rel="noopener noreferrer"
                       class="px-6 py-3 bg-gradient-to-r from-cyan-600 to-blue-600 rounded-full font-bold text-sm shadow-lg hover:shadow-cyan-500/40 transition-all transform hover:scale-105 text-center ring-2 ring-cyan-400/30">
                        📱 Join Telegram
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        (function () {
            const destination = @json($shortLink->real_url);
            const totalSeconds = 3;
            const circumference = 314;
            const ring = document.getElementById('progress-ring');
            const countdownEl = document.getElementById('countdown');
            let remaining = totalSeconds;

            function tick() {
                remaining--;
                countdownEl.textContent = remaining;

                const offset = circumference * (1 - remaining / totalSeconds);
                ring.style.strokeDashoffset = offset;

                if (remaining <= 0) {
                    window.location.href = destination;
                } else {
                    setTimeout(tick, 1000);
                }
            }

            // Start after 1 second so user sees "3" first
            setTimeout(tick, 1000);
        })();
    </script>
</x-layouts.base>
