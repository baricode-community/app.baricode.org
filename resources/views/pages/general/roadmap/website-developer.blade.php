<x-layouts.base :title="__('Roadmap Website Developer - Baricode')">
    <div class="min-h-screen">

        {{-- Hero Section --}}
        <section class="relative min-h-[500px] flex items-center justify-center px-4 py-20">
            <div class="hidden md:absolute md:block top-20 left-10 animate-bounce delay-100">
                <div class="bg-cyan-500/20 backdrop-blur-lg rounded-3xl p-4 text-4xl">🌐</div>
            </div>
            <div class="hidden md:absolute md:block top-40 right-20 animate-bounce delay-300">
                <div class="bg-blue-500/20 backdrop-blur-lg rounded-3xl p-4 text-4xl">💻</div>
            </div>
            <div class="hidden md:absolute md:block bottom-40 left-20 animate-bounce delay-500">
                <div class="bg-indigo-500/20 backdrop-blur-lg rounded-3xl p-4 text-4xl">🚀</div>
            </div>
            <div class="hidden md:absolute md:block bottom-20 right-10 animate-bounce delay-200">
                <div class="bg-violet-500/20 backdrop-blur-lg rounded-3xl p-4 text-4xl">⚡</div>
            </div>

            <div class="max-w-4xl mx-auto text-center z-10">
                <div class="inline-flex items-center gap-2 bg-cyan-500/10 border border-cyan-500/30 text-cyan-300 text-sm px-4 py-2 rounded-full mb-6 font-medium">
                    <span>🗺️</span> Roadmap Lengkap
                </div>
                <h1 class="text-5xl md:text-6xl font-extrabold mb-8 bg-gradient-to-r from-cyan-400 via-blue-400 to-indigo-400 bg-clip-text text-transparent drop-shadow-lg">
                    Roadmap Website Developer
                </h1>
                <p class="text-xl md:text-2xl text-gray-200 mb-8 max-w-3xl mx-auto font-medium drop-shadow">
                    Panduan alur belajar dari nol hingga siap kerja sebagai Website Developer
                </p>
                <p class="text-lg text-gray-400 max-w-2xl mx-auto">
                    Ikuti tahapan ini secara berurutan. Setiap fase membangun pondasi untuk fase berikutnya.
                </p>
                <div class="flex flex-wrap justify-center gap-4 mt-8">
                    <div class="bg-white/5 border border-white/10 rounded-full px-5 py-2 text-sm text-gray-300">
                        ⏱ Estimasi total: <strong class="text-cyan-300">6–18 bulan</strong>
                    </div>
                    <div class="bg-white/5 border border-white/10 rounded-full px-5 py-2 text-sm text-gray-300">
                        📅 Konsisten: <strong class="text-blue-300">1–2 jam/hari</strong>
                    </div>
                    <div class="bg-white/5 border border-white/10 rounded-full px-5 py-2 text-sm text-gray-300">
                        🎯 Level: <strong class="text-indigo-300">Pemula → Siap Kerja</strong>
                    </div>
                </div>
            </div>
        </section>

        {{-- Phase Overview --}}
        <section class="py-12 px-4">
            <div class="max-w-5xl mx-auto">
                <div class="bg-gradient-to-r from-cyan-600/20 via-blue-600/20 to-indigo-600/20 backdrop-blur-xl rounded-3xl p-8 border border-cyan-500/30">
                    <h2 class="text-2xl font-bold mb-6 text-center">Overview Perjalanan Belajar</h2>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                        <a href="#phase-1" class="p-4 bg-white/5 rounded-xl border border-white/10 hover:bg-white/10 hover:border-cyan-400/50 transition-all text-center">
                            <div class="text-2xl mb-2">🏗️</div>
                            <div class="text-sm font-semibold text-cyan-300">Fase 1</div>
                            <div class="text-xs text-gray-400 mt-1">Fondasi Web</div>
                        </a>
                        <a href="#phase-2" class="p-4 bg-white/5 rounded-xl border border-white/10 hover:bg-white/10 hover:border-yellow-400/50 transition-all text-center">
                            <div class="text-2xl mb-2">⚡</div>
                            <div class="text-sm font-semibold text-yellow-300">Fase 2</div>
                            <div class="text-xs text-gray-400 mt-1">JavaScript</div>
                        </a>
                        <a href="#phase-3" class="p-4 bg-white/5 rounded-xl border border-white/10 hover:bg-white/10 hover:border-blue-400/50 transition-all text-center">
                            <div class="text-2xl mb-2">⚛️</div>
                            <div class="text-sm font-semibold text-blue-300">Fase 3</div>
                            <div class="text-xs text-gray-400 mt-1">Frontend Framework</div>
                        </a>
                        <a href="#phase-4" class="p-4 bg-white/5 rounded-xl border border-white/10 hover:bg-white/10 hover:border-green-400/50 transition-all text-center">
                            <div class="text-2xl mb-2">🖥️</div>
                            <div class="text-sm font-semibold text-green-300">Fase 4</div>
                            <div class="text-xs text-gray-400 mt-1">Backend & Database</div>
                        </a>
                        <a href="#phase-5" class="p-4 bg-white/5 rounded-xl border border-white/10 hover:bg-white/10 hover:border-orange-400/50 transition-all text-center">
                            <div class="text-2xl mb-2">🗄️</div>
                            <div class="text-sm font-semibold text-orange-300">Fase 5</div>
                            <div class="text-xs text-gray-400 mt-1">API & Auth</div>
                        </a>
                        <a href="#phase-6" class="p-4 bg-white/5 rounded-xl border border-white/10 hover:bg-white/10 hover:border-purple-400/50 transition-all text-center">
                            <div class="text-2xl mb-2">🚀</div>
                            <div class="text-sm font-semibold text-purple-300">Fase 6</div>
                            <div class="text-xs text-gray-400 mt-1">Deployment</div>
                        </a>
                        <a href="#phase-7" class="p-4 bg-white/5 rounded-xl border border-white/10 hover:bg-white/10 hover:border-pink-400/50 transition-all text-center">
                            <div class="text-2xl mb-2">💼</div>
                            <div class="text-sm font-semibold text-pink-300">Fase 7</div>
                            <div class="text-xs text-gray-400 mt-1">Portfolio & Karir</div>
                        </a>
                        <a href="#tools" class="p-4 bg-white/5 rounded-xl border border-white/10 hover:bg-white/10 hover:border-emerald-400/50 transition-all text-center">
                            <div class="text-2xl mb-2">🛠️</div>
                            <div class="text-sm font-semibold text-emerald-300">Tools</div>
                            <div class="text-xs text-gray-400 mt-1">Wajib Dikuasai</div>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        {{-- Phase 1: Fondasi Web --}}
        <section id="phase-1" class="py-16 px-4">
            <div class="max-w-5xl mx-auto">
                <div class="flex items-center gap-4 mb-8">
                    <div class="flex-shrink-0 w-14 h-14 rounded-2xl bg-cyan-500/20 flex items-center justify-center text-3xl">🏗️</div>
                    <div>
                        <div class="text-xs font-semibold text-cyan-400 uppercase tracking-widest mb-1">Fase 1 · Estimasi 1–2 Bulan</div>
                        <h2 class="text-3xl font-bold">Fondasi Web: HTML, CSS & Tools</h2>
                    </div>
                </div>

                <p class="text-gray-300 text-lg mb-8">Sebelum apapun, kamu harus paham cara kerja web. HTML adalah struktur, CSS adalah tampilan. Ini fondasi yang tidak bisa dilewati.</p>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                    <div class="bg-white/5 backdrop-blur-lg rounded-2xl p-6 border border-cyan-500/20">
                        <h3 class="text-lg font-semibold text-cyan-300 mb-4">📄 HTML — Struktur Halaman</h3>
                        <ul class="space-y-2 text-sm text-gray-300">
                            <li class="flex gap-2"><span class="text-cyan-400 mt-0.5">✓</span> Elemen & tag dasar (div, p, h1-h6, a, img)</li>
                            <li class="flex gap-2"><span class="text-cyan-400 mt-0.5">✓</span> Semantic HTML (header, nav, main, footer, section, article)</li>
                            <li class="flex gap-2"><span class="text-cyan-400 mt-0.5">✓</span> Form & input (text, email, checkbox, button)</li>
                            <li class="flex gap-2"><span class="text-cyan-400 mt-0.5">✓</span> Tabel & list</li>
                            <li class="flex gap-2"><span class="text-cyan-400 mt-0.5">✓</span> Atribut HTML (id, class, href, src, alt)</li>
                            <li class="flex gap-2"><span class="text-cyan-400 mt-0.5">✓</span> Struktur dokumen HTML5 yang benar</li>
                        </ul>
                    </div>

                    <div class="bg-white/5 backdrop-blur-lg rounded-2xl p-6 border border-blue-500/20">
                        <h3 class="text-lg font-semibold text-blue-300 mb-4">🎨 CSS — Tampilan & Desain</h3>
                        <ul class="space-y-2 text-sm text-gray-300">
                            <li class="flex gap-2"><span class="text-blue-400 mt-0.5">✓</span> Selector, properti & nilai CSS</li>
                            <li class="flex gap-2"><span class="text-blue-400 mt-0.5">✓</span> Box model (margin, padding, border)</li>
                            <li class="flex gap-2"><span class="text-blue-400 mt-0.5">✓</span> Flexbox — layout horizontal & vertikal</li>
                            <li class="flex gap-2"><span class="text-blue-400 mt-0.5">✓</span> CSS Grid — layout 2 dimensi</li>
                            <li class="flex gap-2"><span class="text-blue-400 mt-0.5">✓</span> Responsive design & media queries</li>
                            <li class="flex gap-2"><span class="text-blue-400 mt-0.5">✓</span> CSS Variables & basic animations</li>
                        </ul>
                    </div>

                    <div class="bg-white/5 backdrop-blur-lg rounded-2xl p-6 border border-indigo-500/20">
                        <h3 class="text-lg font-semibold text-indigo-300 mb-4">🛠️ Setup Environment</h3>
                        <ul class="space-y-2 text-sm text-gray-300">
                            <li class="flex gap-2"><span class="text-indigo-400 mt-0.5">✓</span> Install VS Code + ekstensi penting (Prettier, Live Server)</li>
                            <li class="flex gap-2"><span class="text-indigo-400 mt-0.5">✓</span> Cara kerja browser & DevTools</li>
                            <li class="flex gap-2"><span class="text-indigo-400 mt-0.5">✓</span> Dasar command line / terminal</li>
                            <li class="flex gap-2"><span class="text-indigo-400 mt-0.5">✓</span> Git & GitHub — version control dasar</li>
                            <li class="flex gap-2"><span class="text-indigo-400 mt-0.5">✓</span> Buat akun GitHub & push proyek pertama</li>
                        </ul>
                    </div>

                    <div class="bg-gradient-to-br from-cyan-500/10 to-blue-500/10 backdrop-blur-lg rounded-2xl p-6 border border-cyan-500/20">
                        <h3 class="text-lg font-semibold text-white mb-4">🎯 Project Fase 1</h3>
                        <div class="space-y-3 text-sm text-gray-300">
                            <div class="bg-white/5 rounded-lg p-3">
                                <div class="font-semibold text-cyan-300 mb-1">Halaman Profil Pribadi</div>
                                <div>Buat halaman HTML+CSS yang menampilkan nama, foto, bio, dan list skills kamu. Deploy ke GitHub Pages.</div>
                            </div>
                            <div class="bg-white/5 rounded-lg p-3">
                                <div class="font-semibold text-blue-300 mb-1">Landing Page Produk</div>
                                <div>Clone tampilan landing page sederhana — hero section, fitur, pricing, footer. Fokus pada responsive design.</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white/5 rounded-2xl p-5 border border-white/10">
                    <div class="text-sm font-semibold text-gray-300 mb-3">📚 Rekomendasi Sumber Belajar</div>
                    <div class="flex flex-wrap gap-2">
                        <span class="bg-cyan-500/10 border border-cyan-500/20 text-cyan-300 text-xs px-3 py-1 rounded-full">MDN Web Docs</span>
                        <span class="bg-blue-500/10 border border-blue-500/20 text-blue-300 text-xs px-3 py-1 rounded-full">freeCodeCamp</span>
                        <span class="bg-indigo-500/10 border border-indigo-500/20 text-indigo-300 text-xs px-3 py-1 rounded-full">The Odin Project</span>
                        <span class="bg-white/5 border border-white/10 text-gray-300 text-xs px-3 py-1 rounded-full">W3Schools</span>
                        <span class="bg-white/5 border border-white/10 text-gray-300 text-xs px-3 py-1 rounded-full">CSS-Tricks</span>
                        <span class="bg-white/5 border border-white/10 text-gray-300 text-xs px-3 py-1 rounded-full">Flexbox Froggy (game)</span>
                        <span class="bg-white/5 border border-white/10 text-gray-300 text-xs px-3 py-1 rounded-full">Grid Garden (game)</span>
                    </div>
                </div>
            </div>
        </section>

        {{-- Connector --}}
        <div class="flex justify-center py-2">
            <div class="w-0.5 h-10 bg-gradient-to-b from-cyan-500/50 to-yellow-500/50"></div>
        </div>

        {{-- Phase 2: JavaScript --}}
        <section id="phase-2" class="py-16 px-4">
            <div class="max-w-5xl mx-auto">
                <div class="flex items-center gap-4 mb-8">
                    <div class="flex-shrink-0 w-14 h-14 rounded-2xl bg-yellow-500/20 flex items-center justify-center text-3xl">⚡</div>
                    <div>
                        <div class="text-xs font-semibold text-yellow-400 uppercase tracking-widest mb-1">Fase 2 · Estimasi 2–3 Bulan</div>
                        <h2 class="text-3xl font-bold">JavaScript — Bahasa Web</h2>
                    </div>
                </div>

                <p class="text-gray-300 text-lg mb-8">JavaScript membuat website jadi hidup dan interaktif. Ini adalah bahasa paling penting yang harus dikuasai seorang web developer. Jangan buru-buru pindah ke framework sebelum JavaScript dasarmu kuat.</p>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                    <div class="bg-white/5 backdrop-blur-lg rounded-2xl p-6 border border-yellow-500/20">
                        <h3 class="text-base font-semibold text-yellow-300 mb-4">🔤 Dasar JavaScript</h3>
                        <ul class="space-y-1.5 text-sm text-gray-300">
                            <li class="flex gap-2"><span class="text-yellow-400">✓</span> Variables (var, let, const)</li>
                            <li class="flex gap-2"><span class="text-yellow-400">✓</span> Tipe data & operator</li>
                            <li class="flex gap-2"><span class="text-yellow-400">✓</span> Kondisional (if/else, switch)</li>
                            <li class="flex gap-2"><span class="text-yellow-400">✓</span> Loop (for, while, forEach)</li>
                            <li class="flex gap-2"><span class="text-yellow-400">✓</span> Function & arrow function</li>
                            <li class="flex gap-2"><span class="text-yellow-400">✓</span> Array & Object</li>
                            <li class="flex gap-2"><span class="text-yellow-400">✓</span> DOM manipulation</li>
                            <li class="flex gap-2"><span class="text-yellow-400">✓</span> Event listener</li>
                        </ul>
                    </div>

                    <div class="bg-white/5 backdrop-blur-lg rounded-2xl p-6 border border-orange-500/20">
                        <h3 class="text-base font-semibold text-orange-300 mb-4">🔥 JavaScript Menengah</h3>
                        <ul class="space-y-1.5 text-sm text-gray-300">
                            <li class="flex gap-2"><span class="text-orange-400">✓</span> ES6+ (destructuring, spread, optional chaining)</li>
                            <li class="flex gap-2"><span class="text-orange-400">✓</span> Higher-order functions (map, filter, reduce)</li>
                            <li class="flex gap-2"><span class="text-orange-400">✓</span> Promise & async/await</li>
                            <li class="flex gap-2"><span class="text-orange-400">✓</span> Fetch API & HTTP request</li>
                            <li class="flex gap-2"><span class="text-orange-400">✓</span> Error handling (try/catch)</li>
                            <li class="flex gap-2"><span class="text-orange-400">✓</span> Module (import/export)</li>
                            <li class="flex gap-2"><span class="text-orange-400">✓</span> LocalStorage & SessionStorage</li>
                        </ul>
                    </div>

                    <div class="bg-white/5 backdrop-blur-lg rounded-2xl p-6 border border-red-500/20">
                        <h3 class="text-base font-semibold text-red-300 mb-4">⚠️ Konsep Penting</h3>
                        <ul class="space-y-1.5 text-sm text-gray-300">
                            <li class="flex gap-2"><span class="text-red-400">✓</span> Scope & closure</li>
                            <li class="flex gap-2"><span class="text-red-400">✓</span> Hoisting</li>
                            <li class="flex gap-2"><span class="text-red-400">✓</span> this keyword</li>
                            <li class="flex gap-2"><span class="text-red-400">✓</span> Prototype & class</li>
                            <li class="flex gap-2"><span class="text-red-400">✓</span> Event loop & call stack</li>
                            <li class="flex gap-2"><span class="text-red-400">✓</span> JSON & parsing data</li>
                            <li class="flex gap-2"><span class="text-red-400">✓</span> Regular expressions dasar</li>
                        </ul>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="bg-gradient-to-br from-yellow-500/10 to-orange-500/10 backdrop-blur-lg rounded-2xl p-6 border border-yellow-500/20">
                        <h3 class="text-base font-semibold text-white mb-4">🎯 Project Fase 2</h3>
                        <div class="space-y-2 text-sm text-gray-300">
                            <div class="bg-white/5 rounded-lg p-3">
                                <div class="font-semibold text-yellow-300 mb-1">To-Do List App</div>
                                <div>CRUD sederhana: tambah, edit, hapus, tandai selesai. Simpan di localStorage.</div>
                            </div>
                            <div class="bg-white/5 rounded-lg p-3">
                                <div class="font-semibold text-orange-300 mb-1">Weather App</div>
                                <div>Ambil data cuaca dari API publik, tampilkan kondisi & forecast dengan desain menarik.</div>
                            </div>
                            <div class="bg-white/5 rounded-lg p-3">
                                <div class="font-semibold text-red-300 mb-1">Quiz App</div>
                                <div>Buat kuis dengan soal, pilihan jawaban, scoring, dan timer countdown.</div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white/5 rounded-2xl p-5 border border-white/10 flex flex-col justify-between">
                        <div>
                            <div class="text-sm font-semibold text-gray-300 mb-3">📚 Sumber Belajar</div>
                            <div class="flex flex-wrap gap-2 mb-4">
                                <span class="bg-yellow-500/10 border border-yellow-500/20 text-yellow-300 text-xs px-3 py-1 rounded-full">javascript.info</span>
                                <span class="bg-orange-500/10 border border-orange-500/20 text-orange-300 text-xs px-3 py-1 rounded-full">Eloquent JavaScript</span>
                                <span class="bg-white/5 border border-white/10 text-gray-300 text-xs px-3 py-1 rounded-full">You Don't Know JS</span>
                                <span class="bg-white/5 border border-white/10 text-gray-300 text-xs px-3 py-1 rounded-full">freeCodeCamp JS</span>
                            </div>
                        </div>
                        <div class="bg-amber-500/10 border border-amber-500/20 rounded-xl p-4">
                            <div class="text-xs font-semibold text-amber-300 mb-1">💡 Penting!</div>
                            <div class="text-xs text-gray-300">Jangan langsung loncat ke React/Vue sebelum benar-benar nyaman dengan JavaScript murni. Minimal bisa buat 2-3 project tanpa framework dulu.</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Connector --}}
        <div class="flex justify-center py-2">
            <div class="w-0.5 h-10 bg-gradient-to-b from-yellow-500/50 to-blue-500/50"></div>
        </div>

        {{-- Phase 3: Frontend Framework --}}
        <section id="phase-3" class="py-16 px-4">
            <div class="max-w-5xl mx-auto">
                <div class="flex items-center gap-4 mb-8">
                    <div class="flex-shrink-0 w-14 h-14 rounded-2xl bg-blue-500/20 flex items-center justify-center text-3xl">⚛️</div>
                    <div>
                        <div class="text-xs font-semibold text-blue-400 uppercase tracking-widest mb-1">Fase 3 · Estimasi 2–3 Bulan</div>
                        <h2 class="text-3xl font-bold">Frontend Framework & CSS Framework</h2>
                    </div>
                </div>

                <p class="text-gray-300 text-lg mb-8">Framework membuat kamu produktif dalam membangun UI yang kompleks. Pilih <strong class="text-blue-300">salah satu</strong> framework JS (React direkomendasikan untuk karir) dan kuasai betul-betul.</p>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                    <div class="bg-gradient-to-br from-blue-500/15 to-cyan-500/10 backdrop-blur-lg rounded-2xl p-6 border border-blue-500/30 relative overflow-hidden">
                        <div class="absolute top-3 right-3 bg-blue-500/20 border border-blue-500/30 text-blue-300 text-xs px-2 py-0.5 rounded-full">⭐ Direkomendasikan</div>
                        <h3 class="text-lg font-semibold text-blue-300 mb-4">⚛️ React.js</h3>
                        <ul class="space-y-1.5 text-sm text-gray-300 mb-4">
                            <li class="flex gap-2"><span class="text-blue-400">✓</span> Konsep component & JSX</li>
                            <li class="flex gap-2"><span class="text-blue-400">✓</span> Props & State</li>
                            <li class="flex gap-2"><span class="text-blue-400">✓</span> Hooks (useState, useEffect, useContext)</li>
                            <li class="flex gap-2"><span class="text-blue-400">✓</span> React Router (navigasi halaman)</li>
                            <li class="flex gap-2"><span class="text-blue-400">✓</span> Fetching data dari API</li>
                            <li class="flex gap-2"><span class="text-blue-400">✓</span> State management (Context API / Zustand)</li>
                            <li class="flex gap-2"><span class="text-blue-400">✓</span> Next.js (React framework full-stack)</li>
                        </ul>
                        <div class="text-xs text-gray-400">Paling banyak dipakai di industri. Ekosistem & lowongan kerja terbesar.</div>
                    </div>

                    <div class="bg-white/5 backdrop-blur-lg rounded-2xl p-6 border border-green-500/20">
                        <h3 class="text-lg font-semibold text-green-300 mb-4">💚 Vue.js (Alternatif)</h3>
                        <ul class="space-y-1.5 text-sm text-gray-300 mb-4">
                            <li class="flex gap-2"><span class="text-green-400">✓</span> Composition API & Options API</li>
                            <li class="flex gap-2"><span class="text-green-400">✓</span> Template syntax & directives (v-if, v-for)</li>
                            <li class="flex gap-2"><span class="text-green-400">✓</span> Reactive data & computed</li>
                            <li class="flex gap-2"><span class="text-green-400">✓</span> Vue Router & Pinia (state)</li>
                            <li class="flex gap-2"><span class="text-green-400">✓</span> Nuxt.js (Vue framework full-stack)</li>
                        </ul>
                        <div class="text-xs text-gray-400">Curve lebih landai dari React. Bagus untuk proyek Indonesia & startup lokal.</div>
                    </div>

                    <div class="bg-white/5 backdrop-blur-lg rounded-2xl p-6 border border-purple-500/20">
                        <h3 class="text-lg font-semibold text-purple-300 mb-4">💅 CSS Framework</h3>
                        <div class="space-y-3 text-sm text-gray-300">
                            <div>
                                <div class="font-semibold text-purple-300 mb-1">Tailwind CSS <span class="text-xs text-gray-400">(utility-first)</span></div>
                                <div class="text-xs text-gray-400">Class langsung di HTML, sangat fleksibel, production ready. Paling populer saat ini.</div>
                            </div>
                            <div>
                                <div class="font-semibold text-blue-300 mb-1">Bootstrap <span class="text-xs text-gray-400">(component-based)</span></div>
                                <div class="text-xs text-gray-400">Cepat untuk prototyping, banyak komponen siap pakai, mudah dipelajari pemula.</div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gradient-to-br from-blue-500/10 to-indigo-500/10 backdrop-blur-lg rounded-2xl p-6 border border-blue-500/20">
                        <h3 class="text-base font-semibold text-white mb-4">🎯 Project Fase 3</h3>
                        <div class="space-y-2 text-sm text-gray-300">
                            <div class="bg-white/5 rounded-lg p-3">
                                <div class="font-semibold text-blue-300 mb-1">E-commerce Mini</div>
                                <div>Halaman produk, keranjang belanja, checkout. Gunakan React + Tailwind.</div>
                            </div>
                            <div class="bg-white/5 rounded-lg p-3">
                                <div class="font-semibold text-cyan-300 mb-1">Dashboard Admin</div>
                                <div>Tampilkan data statistik, tabel, grafik. Integrasikan dengan fake API (json-server).</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Connector --}}
        <div class="flex justify-center py-2">
            <div class="w-0.5 h-10 bg-gradient-to-b from-blue-500/50 to-green-500/50"></div>
        </div>

        {{-- Phase 4: Backend & Database --}}
        <section id="phase-4" class="py-16 px-4">
            <div class="max-w-5xl mx-auto">
                <div class="flex items-center gap-4 mb-8">
                    <div class="flex-shrink-0 w-14 h-14 rounded-2xl bg-green-500/20 flex items-center justify-center text-3xl">🖥️</div>
                    <div>
                        <div class="text-xs font-semibold text-green-400 uppercase tracking-widest mb-1">Fase 4 · Estimasi 2–3 Bulan</div>
                        <h2 class="text-3xl font-bold">Backend & Database</h2>
                    </div>
                </div>

                <p class="text-gray-300 text-lg mb-8">Backend adalah "otak" dari aplikasi web. Di sini logic bisnis, autentikasi, dan pengelolaan data terjadi. Pilih <strong class="text-green-300">satu bahasa backend</strong> dan kuasai dengan framework-nya.</p>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                    <div class="bg-gradient-to-br from-yellow-500/15 to-orange-500/10 backdrop-blur-lg rounded-2xl p-6 border border-yellow-500/30 relative">
                        <div class="absolute top-3 right-3 bg-yellow-500/20 border border-yellow-500/30 text-yellow-300 text-xs px-2 py-0.5 rounded-full">Paling Fleksibel</div>
                        <h3 class="text-lg font-semibold text-yellow-300 mb-3">🟨 Node.js + Express</h3>
                        <ul class="space-y-1.5 text-sm text-gray-300 mb-3">
                            <li class="flex gap-2"><span class="text-yellow-400">✓</span> JavaScript di server</li>
                            <li class="flex gap-2"><span class="text-yellow-400">✓</span> RESTful API dengan Express</li>
                            <li class="flex gap-2"><span class="text-yellow-400">✓</span> Middleware & routing</li>
                            <li class="flex gap-2"><span class="text-yellow-400">✓</span> Prisma / Mongoose (ORM)</li>
                        </ul>
                        <div class="text-xs text-gray-400">1 bahasa (JS) untuk frontend & backend. Cocok jika sudah nyaman JS.</div>
                    </div>

                    <div class="bg-gradient-to-br from-blue-500/15 to-indigo-500/10 backdrop-blur-lg rounded-2xl p-6 border border-blue-500/30 relative">
                        <div class="absolute top-3 right-3 bg-blue-500/20 border border-blue-500/30 text-blue-300 text-xs px-2 py-0.5 rounded-full">Populer di ID</div>
                        <h3 class="text-lg font-semibold text-blue-300 mb-3">🐘 PHP + Laravel</h3>
                        <ul class="space-y-1.5 text-sm text-gray-300 mb-3">
                            <li class="flex gap-2"><span class="text-blue-400">✓</span> PHP dasar & OOP</li>
                            <li class="flex gap-2"><span class="text-blue-400">✓</span> MVC pattern dengan Laravel</li>
                            <li class="flex gap-2"><span class="text-blue-400">✓</span> Eloquent ORM</li>
                            <li class="flex gap-2"><span class="text-blue-400">✓</span> Blade templating</li>
                        </ul>
                        <div class="text-xs text-gray-400">Banyak lowongan di Indonesia. Laravel sangat mature & produktif.</div>
                    </div>

                    <div class="bg-white/5 backdrop-blur-lg rounded-2xl p-6 border border-green-500/20">
                        <h3 class="text-lg font-semibold text-green-300 mb-3">🐍 Python + Django/FastAPI</h3>
                        <ul class="space-y-1.5 text-sm text-gray-300 mb-3">
                            <li class="flex gap-2"><span class="text-green-400">✓</span> Python syntax & OOP</li>
                            <li class="flex gap-2"><span class="text-green-400">✓</span> Django ORM & admin</li>
                            <li class="flex gap-2"><span class="text-green-400">✓</span> FastAPI untuk API modern</li>
                            <li class="flex gap-2"><span class="text-green-400">✓</span> Cocok jika mau ke AI/ML</li>
                        </ul>
                        <div class="text-xs text-gray-400">Sintaks bersih, produktif. Plus bisa lanjut ke Data Science/AI.</div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="bg-white/5 backdrop-blur-lg rounded-2xl p-6 border border-cyan-500/20">
                        <h3 class="text-lg font-semibold text-cyan-300 mb-4">🗄️ Database</h3>
                        <div class="space-y-3 text-sm text-gray-300">
                            <div>
                                <div class="font-semibold text-cyan-300 mb-1">SQL (Relational) — Wajib Dipelajari Dulu</div>
                                <ul class="space-y-1 ml-3 text-gray-400">
                                    <li>• MySQL / PostgreSQL</li>
                                    <li>• SELECT, INSERT, UPDATE, DELETE</li>
                                    <li>• JOIN, relasi tabel, foreign key</li>
                                    <li>• Index & query optimization dasar</li>
                                </ul>
                            </div>
                            <div>
                                <div class="font-semibold text-green-300 mb-1">NoSQL — Kenali juga</div>
                                <ul class="space-y-1 ml-3 text-gray-400">
                                    <li>• MongoDB (document-based)</li>
                                    <li>• Redis (caching & session)</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gradient-to-br from-green-500/10 to-cyan-500/10 backdrop-blur-lg rounded-2xl p-6 border border-green-500/20">
                        <h3 class="text-base font-semibold text-white mb-4">🎯 Project Fase 4</h3>
                        <div class="space-y-2 text-sm text-gray-300">
                            <div class="bg-white/5 rounded-lg p-3">
                                <div class="font-semibold text-green-300 mb-1">Blog API</div>
                                <div>CRUD artikel, komentar, user. Endpoint GET/POST/PUT/DELETE lengkap.</div>
                            </div>
                            <div class="bg-white/5 rounded-lg p-3">
                                <div class="font-semibold text-cyan-300 mb-1">Sistem Manajemen Tugas</div>
                                <div>User bisa register, login, buat task, assign ke user lain. Database MySQL.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Connector --}}
        <div class="flex justify-center py-2">
            <div class="w-0.5 h-10 bg-gradient-to-b from-green-500/50 to-orange-500/50"></div>
        </div>

        {{-- Phase 5: API & Auth --}}
        <section id="phase-5" class="py-16 px-4">
            <div class="max-w-5xl mx-auto">
                <div class="flex items-center gap-4 mb-8">
                    <div class="flex-shrink-0 w-14 h-14 rounded-2xl bg-orange-500/20 flex items-center justify-center text-3xl">🗄️</div>
                    <div>
                        <div class="text-xs font-semibold text-orange-400 uppercase tracking-widest mb-1">Fase 5 · Estimasi 1–2 Bulan</div>
                        <h2 class="text-3xl font-bold">API Design, Auth & Security</h2>
                    </div>
                </div>

                <p class="text-gray-300 text-lg mb-8">Aplikasi modern berkomunikasi lewat API. Kamu harus paham cara membuat, mendokumentasikan, dan mengamankan API yang baik.</p>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                    <div class="bg-white/5 backdrop-blur-lg rounded-2xl p-6 border border-orange-500/20">
                        <h3 class="text-lg font-semibold text-orange-300 mb-4">🔌 RESTful API</h3>
                        <ul class="space-y-1.5 text-sm text-gray-300">
                            <li class="flex gap-2"><span class="text-orange-400">✓</span> HTTP methods (GET, POST, PUT, PATCH, DELETE)</li>
                            <li class="flex gap-2"><span class="text-orange-400">✓</span> Status codes (200, 201, 400, 401, 404, 500)</li>
                            <li class="flex gap-2"><span class="text-orange-400">✓</span> Request & Response format (JSON)</li>
                            <li class="flex gap-2"><span class="text-orange-400">✓</span> Query params, path params, body</li>
                            <li class="flex gap-2"><span class="text-orange-400">✓</span> API versioning (/api/v1/)</li>
                            <li class="flex gap-2"><span class="text-orange-400">✓</span> Dokumentasi dengan Swagger/Postman</li>
                            <li class="flex gap-2"><span class="text-orange-400">✓</span> Rate limiting & pagination</li>
                        </ul>
                    </div>

                    <div class="bg-white/5 backdrop-blur-lg rounded-2xl p-6 border border-red-500/20">
                        <h3 class="text-lg font-semibold text-red-300 mb-4">🔒 Autentikasi & Keamanan</h3>
                        <ul class="space-y-1.5 text-sm text-gray-300">
                            <li class="flex gap-2"><span class="text-red-400">✓</span> JWT (JSON Web Token)</li>
                            <li class="flex gap-2"><span class="text-red-400">✓</span> Session-based auth</li>
                            <li class="flex gap-2"><span class="text-red-400">✓</span> OAuth 2.0 (login dengan Google)</li>
                            <li class="flex gap-2"><span class="text-red-400">✓</span> Password hashing (bcrypt)</li>
                            <li class="flex gap-2"><span class="text-red-400">✓</span> HTTPS & SSL</li>
                            <li class="flex gap-2"><span class="text-red-400">✓</span> CORS & CSRF protection</li>
                            <li class="flex gap-2"><span class="text-red-400">✓</span> Input validation & sanitization</li>
                            <li class="flex gap-2"><span class="text-red-400">✓</span> SQL injection prevention</li>
                        </ul>
                    </div>

                    <div class="bg-white/5 backdrop-blur-lg rounded-2xl p-6 border border-yellow-500/20 col-span-1 md:col-span-2">
                        <h3 class="text-lg font-semibold text-yellow-300 mb-4">🛠️ Tools Testing & Development</h3>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-3 text-sm text-gray-300">
                            <div class="bg-white/5 rounded-lg p-3 text-center">
                                <div class="text-2xl mb-2">📬</div>
                                <div class="font-semibold">Postman</div>
                                <div class="text-xs text-gray-400 mt-1">Test & dokumentasi API</div>
                            </div>
                            <div class="bg-white/5 rounded-lg p-3 text-center">
                                <div class="text-2xl mb-2">⚡</div>
                                <div class="font-semibold">Thunder Client</div>
                                <div class="text-xs text-gray-400 mt-1">API client di VS Code</div>
                            </div>
                            <div class="bg-white/5 rounded-lg p-3 text-center">
                                <div class="text-2xl mb-2">🐛</div>
                                <div class="font-semibold">Browser DevTools</div>
                                <div class="text-xs text-gray-400 mt-1">Debug network request</div>
                            </div>
                            <div class="bg-white/5 rounded-lg p-3 text-center">
                                <div class="text-2xl mb-2">🔍</div>
                                <div class="font-semibold">TablePlus / DBeaver</div>
                                <div class="text-xs text-gray-400 mt-1">GUI untuk database</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Connector --}}
        <div class="flex justify-center py-2">
            <div class="w-0.5 h-10 bg-gradient-to-b from-orange-500/50 to-purple-500/50"></div>
        </div>

        {{-- Phase 6: Deployment --}}
        <section id="phase-6" class="py-16 px-4">
            <div class="max-w-5xl mx-auto">
                <div class="flex items-center gap-4 mb-8">
                    <div class="flex-shrink-0 w-14 h-14 rounded-2xl bg-purple-500/20 flex items-center justify-center text-3xl">🚀</div>
                    <div>
                        <div class="text-xs font-semibold text-purple-400 uppercase tracking-widest mb-1">Fase 6 · Estimasi 1 Bulan</div>
                        <h2 class="text-3xl font-bold">Deployment & DevOps Dasar</h2>
                    </div>
                </div>

                <p class="text-gray-300 text-lg mb-8">Aplikasi yang bagus harus bisa diakses orang lain. Pelajari cara mendeploy aplikasi ke internet agar portfolio kamu bisa dilihat siapa saja.</p>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                    <div class="bg-white/5 backdrop-blur-lg rounded-2xl p-6 border border-purple-500/20">
                        <h3 class="text-lg font-semibold text-purple-300 mb-4">☁️ Platform Deployment</h3>
                        <div class="space-y-3 text-sm text-gray-300">
                            <div>
                                <div class="font-semibold text-purple-300 mb-1">Frontend</div>
                                <ul class="space-y-1 ml-3 text-gray-400">
                                    <li>• Vercel (React/Next.js — mudah & gratis)</li>
                                    <li>• Netlify (static sites & JAMstack)</li>
                                    <li>• GitHub Pages (HTML/CSS sederhana)</li>
                                    <li>• Cloudflare Pages</li>
                                </ul>
                            </div>
                            <div>
                                <div class="font-semibold text-blue-300 mb-1">Backend</div>
                                <ul class="space-y-1 ml-3 text-gray-400">
                                    <li>• Railway (Node.js, Laravel, DB — gratis)</li>
                                    <li>• Render (web services & cron)</li>
                                    <li>• Fly.io (Docker-based)</li>
                                    <li>• VPS (DigitalOcean, Vultr, Contabo)</li>
                                </ul>
                            </div>
                            <div>
                                <div class="font-semibold text-green-300 mb-1">Database Cloud</div>
                                <ul class="space-y-1 ml-3 text-gray-400">
                                    <li>• Supabase (PostgreSQL gratis)</li>
                                    <li>• PlanetScale (MySQL serverless)</li>
                                    <li>• MongoDB Atlas</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white/5 backdrop-blur-lg rounded-2xl p-6 border border-violet-500/20">
                        <h3 class="text-lg font-semibold text-violet-300 mb-4">🛠️ Konsep DevOps Dasar</h3>
                        <ul class="space-y-1.5 text-sm text-gray-300">
                            <li class="flex gap-2"><span class="text-violet-400">✓</span> Git workflow (branching, PR, merge)</li>
                            <li class="flex gap-2"><span class="text-violet-400">✓</span> CI/CD dasar (GitHub Actions)</li>
                            <li class="flex gap-2"><span class="text-violet-400">✓</span> Environment variables (.env)</li>
                            <li class="flex gap-2"><span class="text-violet-400">✓</span> Docker dasar (container, image)</li>
                            <li class="flex gap-2"><span class="text-violet-400">✓</span> Nginx sebagai web server / reverse proxy</li>
                            <li class="flex gap-2"><span class="text-violet-400">✓</span> Domain & DNS setup</li>
                            <li class="flex gap-2"><span class="text-violet-400">✓</span> SSL certificate (Let's Encrypt)</li>
                            <li class="flex gap-2"><span class="text-violet-400">✓</span> Monitoring error dasar (Sentry)</li>
                        </ul>
                    </div>
                </div>

                <div class="bg-gradient-to-r from-purple-500/10 to-violet-500/10 rounded-2xl p-5 border border-purple-500/20">
                    <div class="text-sm font-semibold text-purple-300 mb-3">🎯 Target Fase 6</div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-3 text-sm text-gray-300">
                        <div class="bg-white/5 rounded-lg p-3 text-center">
                            <div class="font-semibold text-purple-300 mb-1">Deploy Frontend</div>
                            <div class="text-xs text-gray-400">React app live di Vercel dengan domain custom</div>
                        </div>
                        <div class="bg-white/5 rounded-lg p-3 text-center">
                            <div class="font-semibold text-violet-300 mb-1">Deploy Backend + DB</div>
                            <div class="text-xs text-gray-400">API live di Railway dengan database PostgreSQL</div>
                        </div>
                        <div class="bg-white/5 rounded-lg p-3 text-center">
                            <div class="font-semibold text-blue-300 mb-1">CI/CD Setup</div>
                            <div class="text-xs text-gray-400">Auto deploy setiap push ke main branch</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Connector --}}
        <div class="flex justify-center py-2">
            <div class="w-0.5 h-10 bg-gradient-to-b from-purple-500/50 to-pink-500/50"></div>
        </div>

        {{-- Phase 7: Portfolio & Karir --}}
        <section id="phase-7" class="py-16 px-4">
            <div class="max-w-5xl mx-auto">
                <div class="flex items-center gap-4 mb-8">
                    <div class="flex-shrink-0 w-14 h-14 rounded-2xl bg-pink-500/20 flex items-center justify-center text-3xl">💼</div>
                    <div>
                        <div class="text-xs font-semibold text-pink-400 uppercase tracking-widest mb-1">Fase 7 · Ongoing</div>
                        <h2 class="text-3xl font-bold">Portfolio, Soft Skills & Karir</h2>
                    </div>
                </div>

                <p class="text-gray-300 text-lg mb-8">Technical skills saja tidak cukup. Kamu perlu menampilkan dirimu dengan baik dan memiliki skill komunikasi yang kuat untuk sukses di dunia kerja.</p>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                    <div class="bg-white/5 backdrop-blur-lg rounded-2xl p-6 border border-pink-500/20">
                        <h3 class="text-lg font-semibold text-pink-300 mb-4">📁 Bangun Portfolio yang Kuat</h3>
                        <ul class="space-y-2 text-sm text-gray-300">
                            <li class="flex gap-2"><span class="text-pink-400">✓</span> <strong>Website portfolio pribadi</strong> — showcase skill & proyek</li>
                            <li class="flex gap-2"><span class="text-pink-400">✓</span> Minimal <strong>3–5 proyek</strong> yang diverse & live</li>
                            <li class="flex gap-2"><span class="text-pink-400">✓</span> Setiap proyek punya README yang baik di GitHub</li>
                            <li class="flex gap-2"><span class="text-pink-400">✓</span> Sertakan problem yang diselesaikan & tech stack</li>
                            <li class="flex gap-2"><span class="text-pink-400">✓</span> Contribution graph GitHub yang aktif</li>
                            <li class="flex gap-2"><span class="text-pink-400">✓</span> Submisi ke <strong>RepoHub Baricode</strong> untuk exposure</li>
                        </ul>
                    </div>

                    <div class="bg-white/5 backdrop-blur-lg rounded-2xl p-6 border border-rose-500/20">
                        <h3 class="text-lg font-semibold text-rose-300 mb-4">🎤 Soft Skills yang Dibutuhkan</h3>
                        <ul class="space-y-2 text-sm text-gray-300">
                            <li class="flex gap-2"><span class="text-rose-400">✓</span> Komunikasi — jelaskan teknis ke non-teknis</li>
                            <li class="flex gap-2"><span class="text-rose-400">✓</span> Problem solving & debugging mindset</li>
                            <li class="flex gap-2"><span class="text-rose-400">✓</span> Baca dokumentasi & mandiri belajar</li>
                            <li class="flex gap-2"><span class="text-rose-400">✓</span> Kolaborasi dengan tim (Git workflow)</li>
                            <li class="flex gap-2"><span class="text-rose-400">✓</span> Manajemen waktu & task prioritization</li>
                            <li class="flex gap-2"><span class="text-rose-400">✓</span> Growth mindset — tidak takut salah & minta feedback</li>
                        </ul>
                    </div>

                    <div class="bg-white/5 backdrop-blur-lg rounded-2xl p-6 border border-amber-500/20">
                        <h3 class="text-lg font-semibold text-amber-300 mb-4">💡 Cara Dapat Pengalaman</h3>
                        <ul class="space-y-2 text-sm text-gray-300">
                            <li class="flex gap-2"><span class="text-amber-400">1.</span> <strong>Freelance</strong> — Upwork, Sribulancer, Fiverr. Mulai dari proyek kecil.</li>
                            <li class="flex gap-2"><span class="text-amber-400">2.</span> <strong>Kontribusi Open Source</strong> — Fix bug, tambah docs, buat PR</li>
                            <li class="flex gap-2"><span class="text-amber-400">3.</span> <strong>Hackathon</strong> — Build fast, network, kadang ada prize</li>
                            <li class="flex gap-2"><span class="text-amber-400">4.</span> <strong>Magang / Internship</strong> — Real-world experience terbaik</li>
                            <li class="flex gap-2"><span class="text-amber-400">5.</span> <strong>Proyek sendiri</strong> — Solve masalah nyata kamu atau orang sekitar</li>
                        </ul>
                    </div>

                    <div class="bg-white/5 backdrop-blur-lg rounded-2xl p-6 border border-emerald-500/20">
                        <h3 class="text-lg font-semibold text-emerald-300 mb-4">📝 Tips Interview Teknis</h3>
                        <ul class="space-y-2 text-sm text-gray-300">
                            <li class="flex gap-2"><span class="text-emerald-400">✓</span> Pelajari struktur data & algoritma dasar</li>
                            <li class="flex gap-2"><span class="text-emerald-400">✓</span> Latihan di LeetCode (easy & medium)</li>
                            <li class="flex gap-2"><span class="text-emerald-400">✓</span> Bisa jelaskan setiap baris kode di portfolio</li>
                            <li class="flex gap-2"><span class="text-emerald-400">✓</span> Pahami konsep fundamental (OOP, SOLID, REST)</li>
                            <li class="flex gap-2"><span class="text-emerald-400">✓</span> Mock interview dengan teman atau mentor</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        {{-- Tools Section --}}
        <section id="tools" class="py-16 px-4">
            <div class="max-w-5xl mx-auto">
                <div class="flex items-center gap-4 mb-8">
                    <div class="flex-shrink-0 w-14 h-14 rounded-2xl bg-emerald-500/20 flex items-center justify-center text-3xl">🛠️</div>
                    <div>
                        <h2 class="text-3xl font-bold">Tools Wajib Seorang Web Developer</h2>
                    </div>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                    @foreach ([
                        ['VS Code', 'Text editor utama', '💻', 'cyan'],
                        ['Git & GitHub', 'Version control', '🐙', 'gray'],
                        ['Chrome DevTools', 'Debug & inspect', '🔍', 'blue'],
                        ['Figma', 'Desain & prototyping', '🎨', 'pink'],
                        ['Postman', 'Test API', '📬', 'orange'],
                        ['Docker', 'Containerization', '🐳', 'blue'],
                        ['Terminal / CLI', 'Command line', '🖥️', 'green'],
                        ['ESLint / Prettier', 'Code quality', '✨', 'purple'],
                        ['npm / yarn / pnpm', 'Package manager', '📦', 'red'],
                        ['Webpack / Vite', 'Build tools', '⚡', 'yellow'],
                        ['Jest / Vitest', 'Testing', '🧪', 'emerald'],
                        ['Notion / Obsidian', 'Notes & docs', '📝', 'gray'],
                    ] as $tool)
                    <div class="bg-white/5 backdrop-blur-lg rounded-xl p-4 border border-white/10 hover:bg-white/10 transition-all text-center">
                        <div class="text-2xl mb-2">{{ $tool[2] }}</div>
                        <div class="text-sm font-semibold text-white">{{ $tool[0] }}</div>
                        <div class="text-xs text-gray-400 mt-1">{{ $tool[1] }}</div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Timeline Visual --}}
        <section class="py-16 px-4">
            <div class="max-w-4xl mx-auto">
                <h2 class="text-3xl font-bold mb-10 text-center">📅 Timeline Estimasi Belajar</h2>
                <div class="bg-gradient-to-r from-cyan-600/20 via-blue-600/20 to-purple-600/20 backdrop-blur-xl rounded-3xl p-8 border border-cyan-500/30">
                    <div class="space-y-4">
                        @foreach ([
                            ['Bulan 1–2', 'Fondasi Web (HTML, CSS, Git)', 'cyan', 2],
                            ['Bulan 3–5', 'JavaScript (Dasar & Menengah)', 'yellow', 3],
                            ['Bulan 6–8', 'Frontend Framework (React + Tailwind)', 'blue', 3],
                            ['Bulan 9–11', 'Backend + Database', 'green', 3],
                            ['Bulan 12', 'API Design, Auth & Security', 'orange', 1],
                            ['Bulan 13', 'Deployment & DevOps Dasar', 'purple', 1],
                            ['Bulan 14+', 'Portfolio, Karir & Terus Belajar', 'pink', 2],
                        ] as $phase)
                        <div class="flex items-center gap-4">
                            <div class="text-xs font-mono text-gray-400 w-24 flex-shrink-0">{{ $phase[0] }}</div>
                            <div class="flex-1 bg-white/5 rounded-full overflow-hidden h-8 relative">
                                <div class="h-full rounded-full bg-{{ $phase[2] }}-500/40 border border-{{ $phase[2] }}-500/40 flex items-center px-3" style="width: {{ ($phase[3] / 14) * 100 + 20 }}%">
                                    <span class="text-xs font-medium text-{{ $phase[2] }}-300 truncate">{{ $phase[1] }}</span>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="mt-6 text-center text-sm text-gray-400">
                        * Estimasi dengan belajar 1–2 jam per hari secara konsisten. Lebih banyak waktu = lebih cepat.
                    </div>
                </div>
            </div>
        </section>

        {{-- FAQ --}}
        <section class="py-16 px-4">
            <div class="max-w-4xl mx-auto">
                <h2 class="text-3xl font-bold mb-10 text-center">❓ FAQ</h2>
                <div class="space-y-4">
                    <details class="bg-white/5 backdrop-blur-lg rounded-xl p-6 border border-white/10 cursor-pointer group">
                        <summary class="text-lg font-semibold text-cyan-300 flex justify-between items-center">
                            Harus belajar semuanya? Atau bisa pilih-pilih?
                            <span class="group-open:rotate-180 transition-transform flex-shrink-0 ml-4">▼</span>
                        </summary>
                        <p class="text-gray-300 mt-4">Fase 1–2 (HTML, CSS, JavaScript) wajib untuk semua web developer. Setelah itu tergantung jalur: <strong class="text-cyan-300">Frontend</strong> fokus ke Fase 3, <strong class="text-green-300">Backend</strong> ke Fase 4, <strong class="text-purple-300">Full-stack</strong> pelajari keduanya. Deployment (Fase 6) tetap perlu dipelajari siapapun.</p>
                    </details>

                    <details class="bg-white/5 backdrop-blur-lg rounded-xl p-6 border border-white/10 cursor-pointer group">
                        <summary class="text-lg font-semibold text-yellow-300 flex justify-between items-center">
                            Framework mana yang harus dipilih pertama?
                            <span class="group-open:rotate-180 transition-transform flex-shrink-0 ml-4">▼</span>
                        </summary>
                        <p class="text-gray-300 mt-4">Untuk <strong class="text-yellow-300">frontend</strong>: pilih React (paling banyak lowongan, ekosistem terbesar). Untuk <strong class="text-blue-300">backend</strong>: jika sudah nyaman JS pilih Node.js/Express; jika mau karir di Indonesia pilih Laravel; jika mau ke AI/ML pilih Python+FastAPI. Yang paling penting: kuasai satu dengan baik dulu, jangan loncat-loncat.</p>
                    </details>

                    <details class="bg-white/5 backdrop-blur-lg rounded-xl p-6 border border-white/10 cursor-pointer group">
                        <summary class="text-lg font-semibold text-green-300 flex justify-between items-center">
                            Apakah perlu kuliah IT untuk jadi web developer?
                            <span class="group-open:rotate-180 transition-transform flex-shrink-0 ml-4">▼</span>
                        </summary>
                        <p class="text-gray-300 mt-4">Tidak wajib. Banyak web developer profesional yang otodidak atau dari bootcamp. Yang paling penting adalah <strong class="text-green-300">portfolio yang kuat</strong> dan kemampuan nyata. Kuliah IT tetap berguna untuk fundamental computer science yang lebih dalam, tapi bukan halangan jika kamu konsisten belajar mandiri.</p>
                    </details>

                    <details class="bg-white/5 backdrop-blur-lg rounded-xl p-6 border border-white/10 cursor-pointer group">
                        <summary class="text-lg font-semibold text-purple-300 flex justify-between items-center">
                            Berapa lama hingga bisa dapat kerja pertama?
                            <span class="group-open:rotate-180 transition-transform flex-shrink-0 ml-4">▼</span>
                        </summary>
                        <p class="text-gray-300 mt-4">Dengan 1–2 jam belajar per hari secara konsisten, kebanyakan orang bisa siap apply kerja dalam <strong class="text-purple-300">6–12 bulan</strong>. Kuncinya adalah memiliki portfolio proyek yang bisa dilihat dan berani apply meski merasa belum sempurna. Junior developer tidak diharapkan tahu segalanya.</p>
                    </details>

                    <details class="bg-white/5 backdrop-blur-lg rounded-xl p-6 border border-white/10 cursor-pointer group">
                        <summary class="text-lg font-semibold text-pink-300 flex justify-between items-center">
                            Setelah jadi web developer, apa yang dipelajari selanjutnya?
                            <span class="group-open:rotate-180 transition-transform flex-shrink-0 ml-4">▼</span>
                        </summary>
                        <p class="text-gray-300 mt-4">Pilihan terbuka lebar: <strong class="text-pink-300">TypeScript</strong> (type safety), <strong class="text-blue-300">Testing</strong> (unit & integration), <strong class="text-green-300">System Design</strong> (arsitektur skala besar), <strong class="text-orange-300">Cloud (AWS/GCP)</strong>, <strong class="text-yellow-300">Mobile (React Native)</strong>, atau spesialisasi ke <strong class="text-cyan-300">AI/ML integration</strong>. Industri tech selalu bergerak — terus belajar adalah kuncinya.</p>
                    </details>
                </div>
            </div>
        </section>

        {{-- CTA --}}
        <section class="py-16 px-4">
            <div class="max-w-4xl mx-auto">
                <div class="bg-gradient-to-r from-cyan-600/40 via-blue-600/40 to-indigo-600/40 backdrop-blur-xl rounded-3xl p-12 border border-cyan-500/30 text-center">
                    <h2 class="text-4xl font-bold mb-6">Siap Mulai Perjalananmu? 🚀</h2>
                    <p class="text-xl text-gray-200 mb-8 max-w-2xl mx-auto">
                        Ribuan developer Indonesia sudah memulai dari sini. Langkah terpenting adalah langkah pertama.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        @auth
                        <a href="{{ route('lms.courses') }}" class="px-10 py-4 bg-gradient-to-r from-cyan-600 to-blue-600 rounded-full font-bold text-lg hover:shadow-lg hover:shadow-cyan-500/40 transition-all transform hover:scale-105">
                            📚 Mulai Belajar Sekarang
                        </a>
                        @else
                        <a href="{{ route('register') }}" class="px-10 py-4 bg-gradient-to-r from-cyan-600 to-blue-600 rounded-full font-bold text-lg hover:shadow-lg hover:shadow-cyan-500/40 transition-all transform hover:scale-105">
                            ✨ Daftar Gratis
                        </a>
                        @endauth
                        <a href="{{ route('how-to-learn') }}" class="px-10 py-4 bg-white/10 border border-white/20 rounded-full font-bold text-lg hover:bg-white/20 transition-all transform hover:scale-105">
                            📖 Cara Belajar di Baricode
                        </a>
                    </div>
                    <p class="text-gray-400 mt-6 text-sm">
                        Sudah punya akun? <a href="{{ route('login') }}" class="text-cyan-300 hover:underline">Login sekarang</a>
                    </p>
                </div>
            </div>
        </section>

        {{-- Final --}}
        <section class="py-12 px-4">
            <div class="max-w-4xl mx-auto text-center">
                <h2 class="text-2xl font-bold mb-4 bg-gradient-to-r from-cyan-400 via-blue-400 to-indigo-400 bg-clip-text text-transparent">
                    Ingat: Semua Senior Developer Pernah Jadi Pemula 💙
                </h2>
                <p class="text-gray-400 max-w-xl mx-auto">
                    Prosesnya panjang, tapi setiap baris kode yang kamu tulis hari ini adalah investasi untuk masa depanmu. Konsisten, sabar, dan jangan berhenti belajar.
                </p>
                <p class="text-sm text-cyan-400 font-semibold mt-4 italic">"Bersama Bertumbuh, Belajar, dan Berbagi" 💜</p>
            </div>
        </section>

    </div>
</x-layouts.base>
