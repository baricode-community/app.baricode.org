<x-layouts.base :title="$certificate->title">
    <div class="min-h-screen py-12 px-4">
        <div class="max-w-4xl mx-auto">

            {{-- Back --}}
            <a href="{{ url()->previous() }}"
               class="inline-flex items-center text-indigo-400 hover:text-indigo-300 mb-8 transition-colors">
                ← Kembali
            </a>

            @php
                $colorMap = [
                    'purple' => ['from' => 'from-purple-600',  'to' => 'to-violet-600',  'text' => 'text-purple-300',  'border' => 'border-purple-500/30',  'badge' => 'bg-purple-500/20 text-purple-300',  'glow' => 'shadow-purple-500/30'],
                    'indigo' => ['from' => 'from-indigo-600',  'to' => 'to-blue-600',    'text' => 'text-indigo-300',  'border' => 'border-indigo-500/30',  'badge' => 'bg-indigo-500/20 text-indigo-300',  'glow' => 'shadow-indigo-500/30'],
                    'blue'   => ['from' => 'from-blue-600',    'to' => 'to-cyan-600',    'text' => 'text-blue-300',    'border' => 'border-blue-500/30',    'badge' => 'bg-blue-500/20 text-blue-300',      'glow' => 'shadow-blue-500/30'],
                    'green'  => ['from' => 'from-emerald-600', 'to' => 'to-teal-600',    'text' => 'text-emerald-300', 'border' => 'border-emerald-500/30', 'badge' => 'bg-emerald-500/20 text-emerald-300', 'glow' => 'shadow-emerald-500/30'],
                    'yellow' => ['from' => 'from-yellow-500',  'to' => 'to-orange-500',  'text' => 'text-yellow-300',  'border' => 'border-yellow-500/30',  'badge' => 'bg-yellow-500/20 text-yellow-300',  'glow' => 'shadow-yellow-500/30'],
                    'orange' => ['from' => 'from-orange-600',  'to' => 'to-red-500',     'text' => 'text-orange-300',  'border' => 'border-orange-500/30',  'badge' => 'bg-orange-500/20 text-orange-300',  'glow' => 'shadow-orange-500/30'],
                    'red'    => ['from' => 'from-red-600',     'to' => 'to-pink-600',    'text' => 'text-red-300',     'border' => 'border-red-500/30',     'badge' => 'bg-red-500/20 text-red-300',        'glow' => 'shadow-red-500/30'],
                    'pink'   => ['from' => 'from-pink-600',    'to' => 'to-rose-600',    'text' => 'text-pink-300',    'border' => 'border-pink-500/30',    'badge' => 'bg-pink-500/20 text-pink-300',      'glow' => 'shadow-pink-500/30'],
                    'gray'   => ['from' => 'from-gray-500',    'to' => 'to-slate-600',   'text' => 'text-gray-300',    'border' => 'border-gray-500/30',    'badge' => 'bg-gray-500/20 text-gray-300',      'glow' => 'shadow-gray-500/30'],
                ];
                $c = $colorMap[$certificate->badge_color] ?? $colorMap['purple'];
            @endphp

            {{-- Hero --}}
            <div class="bg-gray-800/50 backdrop-blur-sm border {{ $c['border'] }} rounded-xl p-8 md:p-12 mb-8">
                <div class="flex flex-col md:flex-row items-center gap-8">

                    {{-- Icon --}}
                    <div class="flex-shrink-0">
                        <div class="w-28 h-28 rounded-2xl bg-gradient-to-br {{ $c['from'] }} {{ $c['to'] }}
                                    flex items-center justify-center shadow-xl {{ $c['glow'] }}">
                            @if($certificate->icon)
                                <span class="text-5xl">{{ $certificate->icon }}</span>
                            @else
                                <i data-lucide="award" class="w-14 h-14 text-white"></i>
                            @endif
                        </div>
                    </div>

                    {{-- Info --}}
                    <div class="flex-1 text-center md:text-left">
                        <span class="inline-block text-xs font-semibold px-3 py-1 rounded-full {{ $c['badge'] }} mb-3">
                            Sertifikat Baricode
                        </span>
                        <h1 class="text-3xl md:text-4xl font-extrabold text-white mb-3">
                            {{ $certificate->title }}
                        </h1>
                        @if($certificate->description)
                            <p class="text-gray-300 text-lg leading-relaxed">
                                {{ $certificate->description }}
                            </p>
                        @endif
                        <p class="{{ $c['text'] }} text-sm mt-3 font-medium">
                            {{ $holders->count() }} pemegang sertifikat
                        </p>
                    </div>
                </div>
            </div>

            {{-- Holders --}}
            <div class="bg-gray-800/50 backdrop-blur-sm border border-gray-700 rounded-xl p-6 md:p-8">
                <h2 class="text-xl font-bold text-white mb-6">Pemegang Sertifikat</h2>

                @if($holders->isEmpty())
                    <div class="text-center py-10">
                        <p class="text-gray-400">Belum ada pemegang sertifikat ini.</p>
                    </div>
                @else
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                        @foreach($holders as $holder)
                            <a href="{{ route('family.show', $holder->username) }}"
                               class="flex items-center gap-3 bg-gray-700/40 hover:bg-gray-700/70
                                      border border-gray-600/50 hover:{{ $c['border'] }}
                                      rounded-xl p-4 transition-all duration-200 group">

                                {{-- Avatar --}}
                                <div class="w-10 h-10 rounded-full bg-gradient-to-br {{ $c['from'] }} {{ $c['to'] }}
                                            flex items-center justify-center flex-shrink-0 text-white font-bold text-sm">
                                    {{ \Illuminate\Support\Str::upper(mb_substr($holder->name, 0, 1)) }}
                                </div>

                                <div class="min-w-0">
                                    <p class="text-white text-sm font-semibold truncate group-hover:{{ $c['text'] }} transition-colors">
                                        {{ $holder->name }}
                                    </p>
                                    <p class="text-gray-400 text-xs truncate">@{{ $holder->username }}</p>
                                    <p class="text-gray-500 text-xs">
                                        {{ \Carbon\Carbon::parse($holder->pivot->issued_at)->format('d M Y') }}
                                    </p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-layouts.base>
