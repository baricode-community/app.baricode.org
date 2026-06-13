<x-layouts.base :title="$cheatSheet->title">

    <div class="max-w-4xl mx-auto px-4 py-8 md:px-8 space-y-6">

        {{-- ─── HEADER ─── --}}
        <div>
            <div class="flex items-center gap-2 text-sm text-purple-400 mb-4">
                <a href="{{ route('cheatsheet.index') }}" class="hover:text-purple-300 transition-colors">Cheat Sheet Library</a>
                <span>/</span>
                <span class="text-purple-300 truncate">{{ $cheatSheet->title }}</span>
            </div>

            <div class="bg-white/5 backdrop-blur-lg rounded-2xl border border-purple-500/20 p-6">
                <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4">
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center gap-2 mb-3 flex-wrap">
                            @if($cheatSheet->category)
                                <span class="text-xs px-2.5 py-1 rounded-full bg-indigo-500/20 text-indigo-300 border border-indigo-500/30">
                                    {{ $cheatSheet->category->name }}
                                </span>
                            @endif
                            @if(!$cheatSheet->is_public)
                                <span class="text-xs px-2.5 py-1 rounded-full bg-amber-500/20 text-amber-300 border border-amber-500/30">
                                    Privat
                                </span>
                            @endif
                        </div>
                        <h1 class="text-white text-xl font-bold leading-snug">{{ $cheatSheet->title }}</h1>
                        @if($cheatSheet->description)
                            <p class="text-purple-300 text-sm mt-2">{{ $cheatSheet->description }}</p>
                        @endif
                        <div class="flex items-center gap-3 mt-4 text-xs text-purple-400">
                            <div class="flex items-center gap-1.5">
                                <div class="w-5 h-5 rounded-full bg-gradient-to-br from-purple-500 to-indigo-500 flex items-center justify-center text-white font-bold text-xs flex-shrink-0">
                                    {{ strtoupper(substr($cheatSheet->user->name ?? '?', 0, 1)) }}
                                </div>
                                <span>{{ $cheatSheet->user->name ?? '-' }}</span>
                            </div>
                            <span>&middot;</span>
                            <span>{{ $cheatSheet->created_at->locale('id')->isoFormat('D MMM YYYY') }}</span>
                        </div>
                    </div>

                    @if(auth()->id() === $cheatSheet->user_id)
                        <div class="flex items-center gap-2 flex-shrink-0">
                            <a href="{{ route('cheatsheet.edit', $cheatSheet->id) }}"
                               class="inline-flex items-center gap-1.5 px-4 py-2 bg-white/5 hover:bg-white/10 border border-purple-500/20 hover:border-purple-400/40 rounded-xl text-purple-200 text-sm transition-all">
                                <i data-lucide="pencil" class="w-3.5 h-3.5"></i>
                                Edit
                            </a>
                            <form method="POST" action="{{ route('cheatsheet.destroy', $cheatSheet->id) }}"
                                  onsubmit="return confirm('Hapus cheat sheet ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="inline-flex items-center gap-1.5 px-4 py-2 bg-red-500/10 hover:bg-red-500/20 border border-red-500/20 hover:border-red-500/40 rounded-xl text-red-400 text-sm transition-all">
                                    <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                                    Hapus
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- ─── CONTENT ─── --}}
        <div class="bg-white/5 backdrop-blur-lg rounded-2xl border border-purple-500/20 overflow-hidden">
            <div class="flex items-center justify-between px-5 py-3 border-b border-purple-500/20">
                <span class="text-purple-400 text-xs font-medium uppercase tracking-wider">Isi Cheat Sheet</span>
                <button onclick="copyContent()"
                        class="inline-flex items-center gap-1.5 text-xs text-purple-400 hover:text-purple-200 transition-colors">
                    <i data-lucide="copy" class="w-3.5 h-3.5"></i>
                    <span id="copy-label">Salin</span>
                </button>
            </div>
            <pre id="sheet-content" class="p-5 text-sm text-purple-100 whitespace-pre-wrap break-words font-mono leading-relaxed overflow-x-auto">{{ $cheatSheet->content }}</pre>
        </div>

        {{-- ─── BACK ─── --}}
        <a href="{{ route('cheatsheet.index') }}"
           class="inline-flex items-center gap-2 text-sm text-purple-400 hover:text-purple-300 transition-colors">
            <i data-lucide="arrow-left" class="w-4 h-4"></i>
            Kembali ke Library
        </a>

    </div>

    <script>
        function copyContent() {
            const text = document.getElementById('sheet-content').innerText;
            navigator.clipboard.writeText(text).then(() => {
                const label = document.getElementById('copy-label');
                label.textContent = 'Tersalin!';
                setTimeout(() => label.textContent = 'Salin', 2000);
            });
        }
    </script>

</x-layouts.base>
