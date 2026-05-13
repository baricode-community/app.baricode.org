<x-layouts.base :title="__('Kebijakan Privasi - Baricode')">
    <div class="min-h-screen">

        <!-- Hero Section -->
        <section class="relative min-h-[400px] flex items-center justify-center px-4 py-20">
            <div class="hidden md:absolute md:block top-20 right-10 animate-bounce delay-100">
                <div class="bg-indigo-500/20 backdrop-blur-lg rounded-3xl p-4 text-4xl">🔒</div>
            </div>
            <div class="hidden md:absolute md:block bottom-40 left-20 animate-bounce delay-500">
                <div class="bg-purple-500/20 backdrop-blur-lg rounded-3xl p-4 text-4xl">🛡️</div>
            </div>

            <div class="max-w-4xl mx-auto text-center z-10">
                <h1 class="text-5xl md:text-6xl font-extrabold mb-6 bg-gradient-to-r from-indigo-400 via-violet-400 to-purple-400 bg-clip-text text-transparent drop-shadow-lg">
                    Kebijakan Privasi
                </h1>
                <p class="text-xl text-gray-300 max-w-2xl mx-auto">
                    Bagaimana Baricode mengumpulkan, menggunakan, dan melindungi data pribadi kamu.
                </p>
                <p class="text-sm text-gray-500 mt-4">
                    Terakhir diperbarui: {{ \Carbon\Carbon::parse('2025-01-01')->translatedFormat('d F Y') }}
                </p>
            </div>
        </section>

        <!-- Table of Contents -->
        <section class="py-10 px-4">
            <div class="max-w-4xl mx-auto">
                <div class="bg-gradient-to-r from-indigo-600/20 via-violet-600/20 to-purple-600/20 backdrop-blur-xl rounded-3xl p-8 border border-indigo-500/30">
                    <h2 class="text-xl font-bold mb-6 text-gray-200">Daftar Isi</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3 text-sm">
                        <a href="#data-dikumpulkan" class="flex items-center gap-2 text-indigo-300 hover:text-indigo-200 transition-colors">
                            <span class="text-gray-500">01</span> Data yang Dikumpulkan
                        </a>
                        <a href="#penggunaan-data" class="flex items-center gap-2 text-indigo-300 hover:text-indigo-200 transition-colors">
                            <span class="text-gray-500">02</span> Bagaimana Data Digunakan
                        </a>
                        <a href="#data-publik" class="flex items-center gap-2 text-indigo-300 hover:text-indigo-200 transition-colors">
                            <span class="text-gray-500">03</span> Data yang Tampil Secara Publik
                        </a>
                        <a href="#berbagi-data" class="flex items-center gap-2 text-indigo-300 hover:text-indigo-200 transition-colors">
                            <span class="text-gray-500">04</span> Berbagi Data dengan Pihak Ketiga
                        </a>
                        <a href="#keamanan" class="flex items-center gap-2 text-indigo-300 hover:text-indigo-200 transition-colors">
                            <span class="text-gray-500">05</span> Keamanan Data
                        </a>
                        <a href="#hak-pengguna" class="flex items-center gap-2 text-indigo-300 hover:text-indigo-200 transition-colors">
                            <span class="text-gray-500">06</span> Hak Pengguna
                        </a>
                        <a href="#cookie" class="flex items-center gap-2 text-indigo-300 hover:text-indigo-200 transition-colors">
                            <span class="text-gray-500">07</span> Cookie & Penyimpanan Lokal
                        </a>
                        <a href="#kontak-privasi" class="flex items-center gap-2 text-indigo-300 hover:text-indigo-200 transition-colors">
                            <span class="text-gray-500">08</span> Hubungi Kami
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Content Sections -->
        <section class="py-10 px-4 pb-24">
            <div class="max-w-4xl mx-auto space-y-12">

                <!-- Pendahuluan -->
                <div class="bg-white/5 backdrop-blur-xl rounded-3xl p-8 border border-white/10">
                    <p class="text-gray-300 leading-relaxed">
                        Baricode berkomitmen untuk melindungi privasi setiap anggota komunitas. Kebijakan Privasi ini menjelaskan data apa yang kami kumpulkan, bagaimana kami menggunakannya, dan hak-hak kamu sebagai pengguna platform kami.
                    </p>
                    <p class="text-gray-400 mt-4 leading-relaxed text-sm">
                        Dengan menggunakan platform Baricode, kamu menyetujui praktik yang dijelaskan dalam Kebijakan Privasi ini.
                    </p>
                </div>

                <!-- 01. Data yang Dikumpulkan -->
                <div id="data-dikumpulkan" class="scroll-mt-20">
                    <div class="flex items-center gap-4 mb-6">
                        <span class="flex-shrink-0 w-10 h-10 rounded-xl bg-indigo-500/20 border border-indigo-500/30 flex items-center justify-center text-indigo-300 font-bold text-sm">01</span>
                        <h2 class="text-2xl font-bold text-white">Data yang Dikumpulkan</h2>
                    </div>
                    <div class="bg-white/5 backdrop-blur-xl rounded-3xl p-8 border border-white/10 space-y-6 text-gray-300 leading-relaxed">

                        <div>
                            <h3 class="text-indigo-300 font-semibold mb-3">Data yang kamu berikan langsung:</h3>
                            <ul class="space-y-2 text-sm">
                                <li class="flex gap-3"><span class="flex-shrink-0 w-1.5 h-1.5 rounded-full bg-indigo-400 mt-1.5"></span> Nama lengkap dan username</li>
                                <li class="flex gap-3"><span class="flex-shrink-0 w-1.5 h-1.5 rounded-full bg-indigo-400 mt-1.5"></span> Alamat email</li>
                                <li class="flex gap-3"><span class="flex-shrink-0 w-1.5 h-1.5 rounded-full bg-indigo-400 mt-1.5"></span> Password (disimpan dalam bentuk terenkripsi)</li>
                                <li class="flex gap-3"><span class="flex-shrink-0 w-1.5 h-1.5 rounded-full bg-indigo-400 mt-1.5"></span> Informasi profil opsional (bio, foto, link sosial media)</li>
                                <li class="flex gap-3"><span class="flex-shrink-0 w-1.5 h-1.5 rounded-full bg-indigo-400 mt-1.5"></span> Konten yang kamu buat (cheatsheet, repository, komentar)</li>
                            </ul>
                        </div>

                        <div>
                            <h3 class="text-indigo-300 font-semibold mb-3">Data yang dikumpulkan otomatis:</h3>
                            <ul class="space-y-2 text-sm">
                                <li class="flex gap-3"><span class="flex-shrink-0 w-1.5 h-1.5 rounded-full bg-violet-400 mt-1.5"></span> Data aktivitas dan progress belajar (kursus, quiz, commit tracker)</li>
                                <li class="flex gap-3"><span class="flex-shrink-0 w-1.5 h-1.5 rounded-full bg-violet-400 mt-1.5"></span> Log login dan logout untuk keperluan keamanan</li>
                                <li class="flex gap-3"><span class="flex-shrink-0 w-1.5 h-1.5 rounded-full bg-violet-400 mt-1.5"></span> Informasi perangkat dan browser (untuk keamanan sesi)</li>
                            </ul>
                        </div>

                        <div>
                            <h3 class="text-indigo-300 font-semibold mb-3">Data dari pihak ketiga:</h3>
                            <ul class="space-y-2 text-sm">
                                <li class="flex gap-3"><span class="flex-shrink-0 w-1.5 h-1.5 rounded-full bg-purple-400 mt-1.5"></span> Jika kamu mendaftar/masuk menggunakan <strong class="text-white">Google</strong>, kami menerima nama, email, dan foto profil dari akun Google kamu sesuai izin yang kamu berikan.</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- 02. Penggunaan Data -->
                <div id="penggunaan-data" class="scroll-mt-20">
                    <div class="flex items-center gap-4 mb-6">
                        <span class="flex-shrink-0 w-10 h-10 rounded-xl bg-violet-500/20 border border-violet-500/30 flex items-center justify-center text-violet-300 font-bold text-sm">02</span>
                        <h2 class="text-2xl font-bold text-white">Bagaimana Data Digunakan</h2>
                    </div>
                    <div class="bg-white/5 backdrop-blur-xl rounded-3xl p-8 border border-white/10 space-y-4 text-gray-300 leading-relaxed">
                        <p>Data yang kami kumpulkan digunakan untuk:</p>
                        <ul class="space-y-3 text-sm mt-2">
                            <li class="flex gap-3"><span class="flex-shrink-0 w-1.5 h-1.5 rounded-full bg-violet-400 mt-1.5"></span> Membuat dan mengelola akun kamu</li>
                            <li class="flex gap-3"><span class="flex-shrink-0 w-1.5 h-1.5 rounded-full bg-violet-400 mt-1.5"></span> Menampilkan profil di direktori komunitas (Family)</li>
                            <li class="flex gap-3"><span class="flex-shrink-0 w-1.5 h-1.5 rounded-full bg-violet-400 mt-1.5"></span> Melacak progress belajar dan aktivitas di platform</li>
                            <li class="flex gap-3"><span class="flex-shrink-0 w-1.5 h-1.5 rounded-full bg-violet-400 mt-1.5"></span> Mengirimkan notifikasi dan pembaruan penting terkait akun</li>
                            <li class="flex gap-3"><span class="flex-shrink-0 w-1.5 h-1.5 rounded-full bg-violet-400 mt-1.5"></span> Meningkatkan fitur dan layanan platform</li>
                            <li class="flex gap-3"><span class="flex-shrink-0 w-1.5 h-1.5 rounded-full bg-violet-400 mt-1.5"></span> Menjaga keamanan platform dan mendeteksi aktivitas mencurigakan</li>
                        </ul>
                        <p class="text-sm text-gray-400 mt-4">Kami <strong class="text-white">tidak menjual</strong> data pribadi kamu kepada pihak ketiga untuk keperluan pemasaran.</p>
                    </div>
                </div>

                <!-- 03. Data Publik -->
                <div id="data-publik" class="scroll-mt-20">
                    <div class="flex items-center gap-4 mb-6">
                        <span class="flex-shrink-0 w-10 h-10 rounded-xl bg-amber-500/20 border border-amber-500/30 flex items-center justify-center text-amber-300 font-bold text-sm">03</span>
                        <h2 class="text-2xl font-bold text-white">Data yang Tampil Secara Publik</h2>
                    </div>
                    <div class="bg-amber-500/10 border border-amber-500/30 rounded-3xl p-8 space-y-4 text-gray-300 leading-relaxed">
                        <p>Informasi berikut <strong class="text-white">dapat dilihat publik</strong> melalui direktori komunitas (Family) dan halaman profil:</p>
                        <ul class="space-y-2 text-sm mt-2">
                            <li class="flex gap-3"><span class="flex-shrink-0 w-1.5 h-1.5 rounded-full bg-amber-400 mt-1.5"></span> Nama dan username</li>
                            <li class="flex gap-3"><span class="flex-shrink-0 w-1.5 h-1.5 rounded-full bg-amber-400 mt-1.5"></span> Foto profil</li>
                            <li class="flex gap-3"><span class="flex-shrink-0 w-1.5 h-1.5 rounded-full bg-amber-400 mt-1.5"></span> Bio dan informasi profil yang kamu isi secara sukarela</li>
                            <li class="flex gap-3"><span class="flex-shrink-0 w-1.5 h-1.5 rounded-full bg-amber-400 mt-1.5"></span> Konten publik yang kamu buat (cheatsheet, repository)</li>
                        </ul>
                        <div class="mt-4 pt-4 border-t border-amber-500/20">
                            <p class="text-sm text-amber-200 font-medium">Data yang TIDAK ditampilkan secara publik:</p>
                            <ul class="space-y-2 text-sm mt-2">
                                <li class="flex gap-3"><span class="flex-shrink-0 w-1.5 h-1.5 rounded-full bg-green-400 mt-1.5"></span> Alamat email</li>
                                <li class="flex gap-3"><span class="flex-shrink-0 w-1.5 h-1.5 rounded-full bg-green-400 mt-1.5"></span> Nomor telepon</li>
                                <li class="flex gap-3"><span class="flex-shrink-0 w-1.5 h-1.5 rounded-full bg-green-400 mt-1.5"></span> Password</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- 04. Berbagi Data -->
                <div id="berbagi-data" class="scroll-mt-20">
                    <div class="flex items-center gap-4 mb-6">
                        <span class="flex-shrink-0 w-10 h-10 rounded-xl bg-pink-500/20 border border-pink-500/30 flex items-center justify-center text-pink-300 font-bold text-sm">04</span>
                        <h2 class="text-2xl font-bold text-white">Berbagi Data dengan Pihak Ketiga</h2>
                    </div>
                    <div class="bg-white/5 backdrop-blur-xl rounded-3xl p-8 border border-white/10 space-y-4 text-gray-300 leading-relaxed">
                        <p>Baricode tidak menjual atau menyewakan data pribadimu. Data dapat dibagikan hanya dalam kondisi berikut:</p>
                        <ul class="space-y-3 text-sm mt-2">
                            <li class="flex gap-3">
                                <span class="flex-shrink-0 w-1.5 h-1.5 rounded-full bg-pink-400 mt-1.5"></span>
                                <span><strong class="text-white">Penyedia layanan infrastruktur</strong> (seperti layanan cloud penyimpanan file) yang membantu kami menjalankan platform, terikat oleh perjanjian kerahasiaan.</span>
                            </li>
                            <li class="flex gap-3">
                                <span class="flex-shrink-0 w-1.5 h-1.5 rounded-full bg-pink-400 mt-1.5"></span>
                                <span><strong class="text-white">Kewajiban hukum</strong> — jika diwajibkan oleh hukum atau permintaan otoritas yang berwenang.</span>
                            </li>
                            <li class="flex gap-3">
                                <span class="flex-shrink-0 w-1.5 h-1.5 rounded-full bg-pink-400 mt-1.5"></span>
                                <span><strong class="text-white">Dengan persetujuanmu</strong> — untuk keperluan lain yang kamu setujui secara eksplisit.</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- 05. Keamanan -->
                <div id="keamanan" class="scroll-mt-20">
                    <div class="flex items-center gap-4 mb-6">
                        <span class="flex-shrink-0 w-10 h-10 rounded-xl bg-emerald-500/20 border border-emerald-500/30 flex items-center justify-center text-emerald-300 font-bold text-sm">05</span>
                        <h2 class="text-2xl font-bold text-white">Keamanan Data</h2>
                    </div>
                    <div class="bg-white/5 backdrop-blur-xl rounded-3xl p-8 border border-white/10 space-y-4 text-gray-300 leading-relaxed">
                        <p>Kami menerapkan langkah-langkah teknis dan organisasional untuk melindungi data kamu, antara lain:</p>
                        <ul class="space-y-3 text-sm mt-2">
                            <li class="flex gap-3"><span class="flex-shrink-0 w-1.5 h-1.5 rounded-full bg-emerald-400 mt-1.5"></span> Enkripsi password menggunakan algoritma hash yang aman</li>
                            <li class="flex gap-3"><span class="flex-shrink-0 w-1.5 h-1.5 rounded-full bg-emerald-400 mt-1.5"></span> Fitur autentikasi dua faktor (2FA) yang dapat diaktifkan</li>
                            <li class="flex gap-3"><span class="flex-shrink-0 w-1.5 h-1.5 rounded-full bg-emerald-400 mt-1.5"></span> Log audit aktivitas login dan logout</li>
                            <li class="flex gap-3"><span class="flex-shrink-0 w-1.5 h-1.5 rounded-full bg-emerald-400 mt-1.5"></span> Penyimpanan file menggunakan layanan cloud yang aman</li>
                        </ul>
                        <p class="text-sm text-gray-400 mt-4">Meski demikian, tidak ada sistem yang 100% aman. Jika kamu menemukan celah keamanan, harap segera laporkan kepada kami.</p>
                    </div>
                </div>

                <!-- 06. Hak Pengguna -->
                <div id="hak-pengguna" class="scroll-mt-20">
                    <div class="flex items-center gap-4 mb-6">
                        <span class="flex-shrink-0 w-10 h-10 rounded-xl bg-blue-500/20 border border-blue-500/30 flex items-center justify-center text-blue-300 font-bold text-sm">06</span>
                        <h2 class="text-2xl font-bold text-white">Hak Pengguna</h2>
                    </div>
                    <div class="bg-white/5 backdrop-blur-xl rounded-3xl p-8 border border-white/10 space-y-4 text-gray-300 leading-relaxed">
                        <p>Sebagai pengguna Baricode, kamu memiliki hak berikut:</p>
                        <ul class="space-y-3 text-sm mt-2">
                            <li class="flex gap-3">
                                <span class="flex-shrink-0 w-1.5 h-1.5 rounded-full bg-blue-400 mt-1.5"></span>
                                <span><strong class="text-white">Akses data</strong> — kamu dapat melihat dan mengedit informasi profil kamu melalui halaman Pengaturan.</span>
                            </li>
                            <li class="flex gap-3">
                                <span class="flex-shrink-0 w-1.5 h-1.5 rounded-full bg-blue-400 mt-1.5"></span>
                                <span><strong class="text-white">Hapus akun</strong> — kamu dapat meminta penghapusan akun beserta data terkait kapan saja.</span>
                            </li>
                            <li class="flex gap-3">
                                <span class="flex-shrink-0 w-1.5 h-1.5 rounded-full bg-blue-400 mt-1.5"></span>
                                <span><strong class="text-white">Kelola profil publik</strong> — kamu dapat mengatur informasi apa yang tampil di direktori komunitas.</span>
                            </li>
                            <li class="flex gap-3">
                                <span class="flex-shrink-0 w-1.5 h-1.5 rounded-full bg-blue-400 mt-1.5"></span>
                                <span><strong class="text-white">Pertanyaan & keberatan</strong> — kamu dapat menghubungi kami terkait penggunaan data pribadimu.</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- 07. Cookie -->
                <div id="cookie" class="scroll-mt-20">
                    <div class="flex items-center gap-4 mb-6">
                        <span class="flex-shrink-0 w-10 h-10 rounded-xl bg-yellow-500/20 border border-yellow-500/30 flex items-center justify-center text-yellow-300 font-bold text-sm">07</span>
                        <h2 class="text-2xl font-bold text-white">Cookie & Penyimpanan Lokal</h2>
                    </div>
                    <div class="bg-white/5 backdrop-blur-xl rounded-3xl p-8 border border-white/10 space-y-4 text-gray-300 leading-relaxed">
                        <p>Baricode menggunakan cookie dan mekanisme penyimpanan sesi untuk:</p>
                        <ul class="space-y-3 text-sm mt-2">
                            <li class="flex gap-3"><span class="flex-shrink-0 w-1.5 h-1.5 rounded-full bg-yellow-400 mt-1.5"></span> Menjaga sesi login kamu tetap aktif</li>
                            <li class="flex gap-3"><span class="flex-shrink-0 w-1.5 h-1.5 rounded-full bg-yellow-400 mt-1.5"></span> Menyimpan preferensi tampilan (misalnya mode gelap)</li>
                            <li class="flex gap-3"><span class="flex-shrink-0 w-1.5 h-1.5 rounded-full bg-yellow-400 mt-1.5"></span> Keamanan token CSRF untuk melindungi formulir</li>
                        </ul>
                        <p class="text-sm text-gray-400 mt-4">Cookie yang kami gunakan bersifat fungsional dan tidak digunakan untuk pelacakan iklan.</p>
                    </div>
                </div>

                <!-- 08. Kontak -->
                <div id="kontak-privasi" class="scroll-mt-20">
                    <div class="flex items-center gap-4 mb-6">
                        <span class="flex-shrink-0 w-10 h-10 rounded-xl bg-indigo-500/20 border border-indigo-500/30 flex items-center justify-center text-indigo-300 font-bold text-sm">08</span>
                        <h2 class="text-2xl font-bold text-white">Hubungi Kami</h2>
                    </div>
                    <div class="bg-gradient-to-r from-indigo-600/20 via-violet-600/20 to-purple-600/20 backdrop-blur-xl rounded-3xl p-8 border border-indigo-500/30 text-gray-300 leading-relaxed">
                        <p>Jika kamu memiliki pertanyaan atau keberatan terkait Kebijakan Privasi ini, silakan hubungi kami:</p>
                        <div class="mt-4 space-y-2 text-sm">
                            <p><span class="text-gray-400">Platform:</span> <span class="text-indigo-300">Baricode Community</span></p>
                            <p><span class="text-gray-400">Email:</span> <span class="text-indigo-300">hello@baricode.id</span></p>
                        </div>
                        <div class="mt-6 pt-6 border-t border-white/10 flex flex-wrap gap-4 text-sm">
                            <a href="{{ route('terms') }}" class="text-indigo-400 hover:text-indigo-300 transition-colors">
                                Syarat & Ketentuan →
                            </a>
                            <a href="{{ route('home') }}" class="text-gray-400 hover:text-gray-300 transition-colors">
                                ← Kembali ke Beranda
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </section>

    </div>
</x-layouts.base>
