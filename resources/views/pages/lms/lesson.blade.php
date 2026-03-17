<x-layouts.dashboard :title="__('Baricode LMS - ' . $lesson->title)">
    <div class="p-2">
        <!-- Breadcrumb -->
        <div class="mb-6 flex items-center text-sm text-purple-400">
            <a href="{{ route('lms.course', $course->slug) }}" class="text-purple-300 hover:text-white transition">{{ $course->title }}</a>
            <span class="mx-2">/</span>
            <a href="{{ route('lms.category', $category->slug) }}" class="text-purple-300 hover:text-white transition">{{ $category->title }}</a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Konten Utama -->
            <div class="lg:col-span-2">
                <!-- Judul Pelajaran dan Metadata -->
                <div class="bg-white/5 backdrop-blur-lg rounded-lg border border-purple-500/20 p-6 mb-6">
                    <div class="flex items-start justify-between mb-4">
                        <div>
                            <h1 class="text-3xl font-bold text-white">{{ $lesson->title }}</h1>
                            <p class="text-purple-300 mt-2">{{ $lesson->description }}</p>
                        </div>
                    </div>
                </div>

                <!-- Bagian Video -->
                @if($youtubeVideos->count() > 0)
                    <div class="mb-6">
                        <div class="bg-white/5 backdrop-blur-lg rounded-lg border border-purple-500/20 overflow-hidden mb-4" x-data="videoPlayer()" x-init="init()">
                            <div class="relative w-full aspect-video bg-black">
                                <iframe
                                    class="w-full h-full"
                                    :src="getEmbedUrl(currentVideo.youtube_url)"
                                    frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; fullscreen"
                                    allowfullscreen
                                    :title="currentVideo.title">
                                </iframe>
                            </div>

                            <!-- Judul Video -->
                            <div class="p-4 border-b border-purple-500/10">
                                <h3 class="text-lg font-bold text-white" x-text="currentVideo.title"></h3>
                            </div>

                            <!-- Deskripsi Video -->
                            <template x-if="currentVideo.description">
                                <div class="p-4 bg-purple-500/5 text-purple-300 text-sm" x-text="currentVideo.description"></div>
                            </template>

                            <!-- Pemilih Video Alternatif -->
                            @if($youtubeVideos->count() > 1)
                                <div class="p-4 bg-gradient-to-r from-purple-500/10 to-indigo-500/10 border-t border-purple-500/10">
                                    <div class="flex items-start gap-3 mb-4">
                                        <svg class="w-5 h-5 text-purple-400 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"></path>
                                        </svg>
                                        <div>
                                            <p class="text-sm text-white font-semibold">Pilihan Video Pembelajaran</p>
                                            <p class="text-xs text-purple-400 mt-1">Tersedia {{ $youtubeVideos->count() }} video. Silakan pilih salah satu untuk memulai pembelajaran (atau sesuai arahan yang disediakan).</p>
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-2">
                                        @foreach($youtubeVideos as $index => $video)
                                            <button
                                                @click="selectVideo({{ $index }})"
                                                :class="activeIndex === {{ $index }} ? 'bg-purple-600 border-purple-400 ring-2 ring-purple-400/50' : 'bg-white/5 border-purple-500/20 hover:bg-purple-500/20 hover:border-purple-500/40'"
                                                class="px-3 py-2 rounded-lg border transition text-xs text-purple-300 hover:text-white truncate font-medium"
                                                :title="videos[{{ $index }}].title"
                                            >
                                                <span class="inline-block w-4 text-center">{{ $index + 1 }}</span>
                                            </button>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            <script>
                                function videoPlayer() {
                                    return {
                                        activeIndex: 0,
                                        videos: {!! json_encode($youtubeVideos->map(fn($v) => [
                                            'title' => $v->title,
                                            'description' => $v->description,
                                            'youtube_url' => $v->youtube_url
                                        ])->values()) !!},
                                        get currentVideo() {
                                            return this.videos[this.activeIndex] || {};
                                        },
                                        init() {
                                            this.activeIndex = 0;
                                        },
                                        selectVideo(index) {
                                            this.activeIndex = index;
                                        },
                                        getEmbedUrl(url) {
                                            if (!url) return '';
                                            let embedUrl = url
                                                .replace(/youtube\.com\/watch\?v=/, 'youtube.com/embed/')
                                                .replace(/youtu\.be\//, 'youtube.com/embed/')
                                                .split('?')[0];
                                            return embedUrl + '?fs=1&showinfo=0&rel=0';
                                        }
                                    }
                                }
                            </script>
                        </div>
                    </div>
                @endif

                <!-- Konten Pelajaran -->
                @if($lesson->content)
                    <div class="bg-white/5 backdrop-blur-lg rounded-lg border border-purple-500/20 p-6 mb-6">
                        <div id="lesson-content" class="prose prose-invert prose-purple max-w-none
                            prose-headings:text-white prose-headings:font-bold
                            prose-p:text-purple-100
                            prose-a:text-purple-300 prose-a:no-underline hover:prose-a:text-white
                            prose-strong:text-white
                            prose-code:text-pink-300 prose-code:bg-white/10 prose-code:px-1.5 prose-code:py-0.5 prose-code:rounded prose-code:font-mono prose-code:text-sm prose-code:before:content-none prose-code:after:content-none
                            prose-pre:bg-transparent prose-pre:p-0 prose-pre:rounded-none
                            prose-blockquote:border-purple-400 prose-blockquote:text-purple-300
                            prose-hr:border-purple-500/30
                            prose-ul:text-purple-100 prose-ol:text-purple-100
                            prose-li:marker:text-purple-400
                            prose-table:text-purple-100
                            prose-th:text-white prose-th:border-purple-500/30
                            prose-td:border-purple-500/20">
                            {!! Str::markdown($lesson->content, ['html_input' => 'strip', 'allow_unsafe_links' => false]) !!}
                        </div>
                    </div>

                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.11.1/styles/github-dark-dimmed.min.css">
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.11.1/highlight.min.js"></script>
                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            const content = document.getElementById('lesson-content');

                            // Wrap pre>code blocks dengan container styling
                            content.querySelectorAll('pre').forEach(function (pre) {
                                const wrapper = document.createElement('div');
                                wrapper.className = 'relative rounded-lg overflow-hidden border border-purple-500/20 my-4';

                                // Cek bahasa dari class
                                const code = pre.querySelector('code');
                                const lang = code ? (code.className.match(/language-(\w+)/) || [])[1] : null;

                                // Label bahasa di pojok kanan atas
                                if (lang) {
                                    const label = document.createElement('div');
                                    label.className = 'absolute top-2 right-3 text-xs text-purple-400 font-mono uppercase tracking-wider z-10';
                                    label.textContent = lang;
                                    wrapper.appendChild(label);
                                }

                                // Tombol copy
                                const copyBtn = document.createElement('button');
                                copyBtn.className = 'absolute top-2 ' + (lang ? 'right-14' : 'right-3') + ' text-xs text-purple-400 hover:text-white transition z-10 flex items-center gap-1';
                                copyBtn.innerHTML = '<svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg> Copy';
                                copyBtn.addEventListener('click', function () {
                                    navigator.clipboard.writeText(code ? code.innerText : pre.innerText).then(function () {
                                        copyBtn.innerHTML = '<svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg> Copied!';
                                        setTimeout(function () {
                                            copyBtn.innerHTML = '<svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg> Copy';
                                        }, 2000);
                                    });
                                });
                                wrapper.appendChild(copyBtn);

                                pre.parentNode.insertBefore(wrapper, pre);
                                pre.style.margin = '0';
                                pre.style.borderRadius = '0';
                                wrapper.appendChild(pre);
                            });

                            // Jalankan highlight.js
                            hljs.highlightAll();
                        });
                    </script>
                @endif

                <!-- Tombol Navigasi -->
                <div class="flex gap-2 justify-center">
                    @if($prevLesson)
                        <a href="{{ route('lms.lesson', $prevLesson) }}"
                            class="flex items-center px-4 py-2 bg-white/5 border border-purple-500/20 hover:bg-purple-500/20 text-white rounded-lg transition">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                            Sebelumnya
                        </a>
                    @else
                        <button disabled class="flex items-center px-4 py-2 bg-white/5 text-purple-700 rounded-lg opacity-50 cursor-not-allowed">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                            Sebelumnya
                        </button>
                    @endif

                    @if($nextLesson)
                        <a href="{{ route('lms.lesson', $nextLesson) }}"
                            class="flex items-center px-4 py-2 bg-purple-600 hover:bg-purple-500 text-white rounded-lg transition">
                            Selanjutnya
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    @else
                        <button disabled class="flex items-center px-4 py-2 bg-white/5 text-purple-700 rounded-lg opacity-50 cursor-not-allowed">
                            Selanjutnya
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </button>
                    @endif
                </div>
            </div>

            <!-- Sidebar -->
            <div>
                <div class="bg-white/5 backdrop-blur-lg rounded-lg border border-purple-500/20 p-6 mb-6 sticky top-6">
                    <h3 class="text-lg font-bold text-white mb-4">Informasi Kursus</h3>

                    <div class="mb-4">
                        <p class="text-sm text-purple-400 mb-1">Kursus</p>
                        <p class="text-white font-semibold">{{ $course->title }}</p>
                    </div>

                    <div class="mb-4">
                        <p class="text-sm text-purple-400 mb-1">Kategori</p>
                        <p class="text-white font-semibold">{{ $category->title }}</p>
                    </div>

                    <div class="mb-4 pb-4 border-b border-purple-500/20">
                        <p class="text-sm text-purple-400 mb-1">Durasi Pelajaran</p>
                        <p class="text-white font-semibold">
                            @if($lesson->duration)
                                {{ $lesson->duration }} menit
                            @else
                                -
                            @endif
                        </p>
                    </div>

                    <!-- Pelajaran Terkait -->
                    <h4 class="text-white font-semibold mb-3">Pelajaran dalam Kategori Ini</h4>
                    <div class="space-y-2">
                        <ol class="list-decimal list-inside space-y-2">
                            @foreach($category->lessons()->where('is_published', true)->orderBy('order')->get() as $relatedLesson)
                                <li>
                                    <a href="{{ route('lms.lesson', $relatedLesson) }}"
                                        class="{{ $relatedLesson->id === $lesson->id ? 'text-purple-300 font-semibold' : 'text-purple-400 hover:text-white' }} transition text-sm">
                                        {{ $relatedLesson->title }}
                                    </a>
                                </li>
                            @endforeach
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.dashboard>