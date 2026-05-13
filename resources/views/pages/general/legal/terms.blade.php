<x-layouts.base :title="__('Syarat & Ketentuan - Baricode')">
    <div class="min-h-screen">

        <!-- Hero Section -->
        <section class="relative min-h-[400px] flex items-center justify-center px-4 py-20">
            <div class="hidden md:absolute md:block top-20 left-10 animate-bounce delay-100">
                <div class="bg-purple-500/20 backdrop-blur-lg rounded-3xl p-4 text-4xl">📜</div>
            </div>
            <div class="hidden md:absolute md:block top-40 right-20 animate-bounce delay-300">
                <div class="bg-indigo-500/20 backdrop-blur-lg rounded-3xl p-4 text-4xl">⚖️</div>
            </div>

            <div class="max-w-4xl mx-auto text-center z-10">
                <h1 class="text-5xl md:text-6xl font-extrabold mb-6 bg-gradient-to-r from-purple-400 via-violet-400 to-indigo-400 bg-clip-text text-transparent drop-shadow-lg">
                    Syarat & Ketentuan
                </h1>
                <p class="text-xl text-gray-300 max-w-2xl mx-auto">
                    Ketentuan penggunaan platform komunitas Baricode. Harap baca dengan seksama sebelum menggunakan layanan kami.
                </p>
                <p class="text-sm text-gray-500 mt-4">
                    Terakhir diperbarui: {{ \Carbon\Carbon::parse('2025-01-01')->translatedFormat('d F Y') }}
                </p>
            </div>
        </section>

        <!-- Table of Contents -->
        <section class="py-10 px-4">
            <div class="max-w-4xl mx-auto">
                <div class="bg-gradient-to-r from-purple-600/20 via-violet-600/20 to-indigo-600/20 backdrop-blur-xl rounded-3xl p-8 border border-purple-500/30">
                    <h2 class="text-xl font-bold mb-6 text-gray-200">Daftar Isi</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3 text-sm">
                        <a href="#akun" class="flex items-center gap-2 text-purple-300 hover:text-purple-200 transition-colors">
                            <span class="text-gray-500">01</span> Akun & Keanggotaan
                        </a>
                        <a href="#konten" class="flex items-center gap-2 text-purple-300 hover:text-purple-200 transition-colors">
                            <span class="text-gray-500">02</span> Konten yang Diperbolehkan & Dilarang
                        </a>
                        <a href="#direktori" class="flex items-center gap-2 text-purple-300 hover:text-purple-200 transition-colors">
                            <span class="text-gray-500">03</span> Direktori Komunitas (Family)
                        </a>
                        <a href="#kekayaan-intelektual" class="flex items-center gap-2 text-purple-300 hover:text-purple-200 transition-colors">
                            <span class="text-gray-500">04</span> Konten & Kekayaan Intelektual
                        </a>
                        <a href="#lms" class="flex items-center gap-2 text-purple-300 hover:text-purple-200 transition-colors">
                            <span class="text-gray-500">05</span> Kursus & LMS
                        </a>
                        <a href="#penghentian" class="flex items-center gap-2 text-purple-300 hover:text-purple-200 transition-colors">
                            <span class="text-gray-500">06</span> Penghentian Akun
                        </a>
                        <a href="#perubahan" class="flex items-center gap-2 text-purple-300 hover:text-purple-200 transition-colors">
                            <span class="text-gray-500">07</span> Perubahan Ketentuan
                        </a>
                        <a href="#batasan" class="flex items-center gap-2 text-purple-300 hover:text-purple-200 transition-colors">
                            <span class="text-gray-500">08</span> Batasan Tanggung Jawab
                        </a>
                        <a href="#hukum" class="flex items-center gap-2 text-purple-300 hover:text-purple-200 transition-colors">
                            <span class="text-gray-500">09</span> Hukum yang Berlaku
                        </a>
                        <a href="#kontak" class="flex items-center gap-2 text-purple-300 hover:text-purple-200 transition-colors">
                            <span class="text-gray-500">10</span> Hubungi Kami
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
                        Selamat datang di <span class="text-purple-300 font-semibold">Baricode</span> — platform komunitas IT Indonesia untuk belajar, berbagi, dan berkolaborasi. Dengan mendaftarkan diri atau menggunakan layanan Baricode, kamu menyatakan telah membaca, memahami, dan menyetujui seluruh Syarat & Ketentuan yang berlaku di bawah ini.
                    </p>
                    <p class="text-gray-400 mt-4 leading-relaxed text-sm">
                        Syarat & Ketentuan ini berlaku bagi semua pengguna platform, termasuk pengunjung, anggota terdaftar, dan pengguna kursus.
                    </p>
                </div>

                <!-- 01. Akun & Keanggotaan -->
                <div id="akun" class="scroll-mt-20">
                    <div class="flex items-center gap-4 mb-6">
                        <span class="flex-shrink-0 w-10 h-10 rounded-xl bg-purple-500/20 border border-purple-500/30 flex items-center justify-center text-purple-300 font-bold text-sm">01</span>
                        <h2 class="text-2xl font-bold text-white">Akun & Keanggotaan</h2>
                    </div>
                    <div class="bg-white/5 backdrop-blur-xl rounded-3xl p-8 border border-white/10 space-y-4 text-gray-300 leading-relaxed">
                        <p>Untuk menggunakan fitur penuh Baricode, kamu perlu membuat akun dengan informasi yang akurat dan lengkap.</p>
                        <ul class="space-y-3 mt-4">
                            <li class="flex gap-3">
                                <span class="flex-shrink-0 w-1.5 h-1.5 rounded-full bg-purple-400 mt-2"></span>
                                <span>Kamu harus berusia minimal <strong class="text-white">13 tahun</strong> untuk mendaftar. Pengguna di bawah 17 tahun wajib mendapat izin dari orang tua atau wali.</span>
                            </li>
                            <li class="flex gap-3">
                                <span class="flex-shrink-0 w-1.5 h-1.5 rounded-full bg-purple-400 mt-2"></span>
                                <span>Setiap orang hanya diperbolehkan memiliki <strong class="text-white">satu akun aktif</strong>. Pembuatan akun ganda dapat mengakibatkan pemblokiran.</span>
                            </li>
                            <li class="flex gap-3">
                                <span class="flex-shrink-0 w-1.5 h-1.5 rounded-full bg-purple-400 mt-2"></span>
                                <span>Kamu bertanggung jawab penuh atas <strong class="text-white">keamanan akun dan password</strong> kamu. Jangan bagikan kredensial login kepada siapa pun.</span>
                            </li>
                            <li class="flex gap-3">
                                <span class="flex-shrink-0 w-1.5 h-1.5 rounded-full bg-purple-400 mt-2"></span>
                                <span>Segera hubungi kami jika kamu mendeteksi akses tidak sah ke akunmu.</span>
                            </li>
                            <li class="flex gap-3">
                                <span class="flex-shrink-0 w-1.5 h-1.5 rounded-full bg-purple-400 mt-2"></span>
                                <span>Baricode berhak menonaktifkan akun yang terbukti melanggar ketentuan ini <strong class="text-white">tanpa pemberitahuan sebelumnya</strong>.</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- 02. Konten -->
                <div id="konten" class="scroll-mt-20">
                    <div class="flex items-center gap-4 mb-6">
                        <span class="flex-shrink-0 w-10 h-10 rounded-xl bg-violet-500/20 border border-violet-500/30 flex items-center justify-center text-violet-300 font-bold text-sm">02</span>
                        <h2 class="text-2xl font-bold text-white">Konten yang Diperbolehkan & Dilarang</h2>
                    </div>
                    <div class="bg-white/5 backdrop-blur-xl rounded-3xl p-8 border border-white/10 space-y-6 text-gray-300 leading-relaxed">
                        <p>Baricode adalah ruang kolaborasi positif. Kami mengharapkan setiap anggota menjaga kualitas dan keamanan konten yang dibagikan.</p>

                        <div>
                            <h3 class="text-green-400 font-semibold mb-3 flex items-center gap-2">
                                <span>✓</span> Konten yang Diperbolehkan
                            </h3>
                            <ul class="space-y-2 text-sm">
                                <li class="flex gap-3"><span class="flex-shrink-0 w-1.5 h-1.5 rounded-full bg-green-400 mt-1.5"></span> Tutorial, cheatsheet, dan materi belajar pemrograman</li>
                                <li class="flex gap-3"><span class="flex-shrink-0 w-1.5 h-1.5 rounded-full bg-green-400 mt-1.5"></span> Berbagi repository dan proyek open source</li>
                                <li class="flex gap-3"><span class="flex-shrink-0 w-1.5 h-1.5 rounded-full bg-green-400 mt-1.5"></span> Diskusi teknis, pertanyaan, dan berbagi pengalaman</li>
                                <li class="flex gap-3"><span class="flex-shrink-0 w-1.5 h-1.5 rounded-full bg-green-400 mt-1.5"></span> Konten humor dan hiburan yang tidak menyinggung (fitur Meme)</li>
                            </ul>
                        </div>

                        <div>
                            <h3 class="text-red-400 font-semibold mb-3 flex items-center gap-2">
                                <span>✗</span> Konten yang Dilarang
                            </h3>
                            <ul class="space-y-2 text-sm">
                                <li class="flex gap-3"><span class="flex-shrink-0 w-1.5 h-1.5 rounded-full bg-red-400 mt-1.5"></span> Spam, promosi produk atau layanan yang tidak relevan</li>
                                <li class="flex gap-3"><span class="flex-shrink-0 w-1.5 h-1.5 rounded-full bg-red-400 mt-1.5"></span> Konten berbau SARA (Suku, Agama, Ras, Antargolongan), pornografi, dan kekerasan</li>
                                <li class="flex gap-3"><span class="flex-shrink-0 w-1.5 h-1.5 rounded-full bg-red-400 mt-1.5"></span> Plagiarisme — mengklaim karya atau kode orang lain sebagai milikmu</li>
                                <li class="flex gap-3"><span class="flex-shrink-0 w-1.5 h-1.5 rounded-full bg-red-400 mt-1.5"></span> Menyebarkan malware, kode berbahaya, atau eksploit untuk tujuan merusak</li>
                                <li class="flex gap-3"><span class="flex-shrink-0 w-1.5 h-1.5 rounded-full bg-red-400 mt-1.5"></span> <em>Doxxing</em> — membagikan informasi pribadi orang lain tanpa izin mereka</li>
                                <li class="flex gap-3"><span class="flex-shrink-0 w-1.5 h-1.5 rounded-full bg-red-400 mt-1.5"></span> Pelecehan, intimidasi, atau bullying terhadap anggota lain</li>
                                <li class="flex gap-3"><span class="flex-shrink-0 w-1.5 h-1.5 rounded-full bg-red-400 mt-1.5"></span> Konten yang melanggar hukum Republik Indonesia</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- 03. Direktori Komunitas -->
                <div id="direktori" class="scroll-mt-20">
                    <div class="flex items-center gap-4 mb-6">
                        <span class="flex-shrink-0 w-10 h-10 rounded-xl bg-indigo-500/20 border border-indigo-500/30 flex items-center justify-center text-indigo-300 font-bold text-sm">03</span>
                        <h2 class="text-2xl font-bold text-white">Direktori Komunitas (Family)</h2>
                    </div>
                    <div class="bg-amber-500/10 border border-amber-500/30 rounded-3xl p-8 space-y-4 text-gray-300 leading-relaxed">
                        <div class="flex gap-3 items-start">
                            <span class="text-2xl flex-shrink-0">⚠️</span>
                            <div>
                                <p class="text-amber-300 font-semibold mb-2">Profil kamu bersifat publik</p>
                                <p class="text-sm">Dengan mendaftar di Baricode, profil kamu — termasuk nama, username, foto, dan informasi yang kamu isi — akan <strong class="text-white">secara otomatis tampil di direktori komunitas (Family)</strong> dan dapat dilihat oleh siapa saja, termasuk pengunjung yang tidak login.</p>
                            </div>
                        </div>
                        <ul class="space-y-3 text-sm mt-4">
                            <li class="flex gap-3">
                                <span class="flex-shrink-0 w-1.5 h-1.5 rounded-full bg-amber-400 mt-1.5"></span>
                                <span>Alamat email dan nomor telepon <strong class="text-white">tidak ditampilkan</strong> di direktori publik.</span>
                            </li>
                            <li class="flex gap-3">
                                <span class="flex-shrink-0 w-1.5 h-1.5 rounded-full bg-amber-400 mt-1.5"></span>
                                <span>Kamu dapat mengatur informasi profil yang ingin ditampilkan melalui halaman <strong class="text-white">Pengaturan Profil</strong>.</span>
                            </li>
                            <li class="flex gap-3">
                                <span class="flex-shrink-0 w-1.5 h-1.5 rounded-full bg-amber-400 mt-1.5"></span>
                                <span>Jika kamu tidak ingin profilmu muncul di direktori, kamu dapat menghapus akunmu kapan saja.</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- 04. Kekayaan Intelektual -->
                <div id="kekayaan-intelektual" class="scroll-mt-20">
                    <div class="flex items-center gap-4 mb-6">
                        <span class="flex-shrink-0 w-10 h-10 rounded-xl bg-pink-500/20 border border-pink-500/30 flex items-center justify-center text-pink-300 font-bold text-sm">04</span>
                        <h2 class="text-2xl font-bold text-white">Konten & Kekayaan Intelektual</h2>
                    </div>
                    <div class="bg-white/5 backdrop-blur-xl rounded-3xl p-8 border border-white/10 space-y-4 text-gray-300 leading-relaxed">
                        <ul class="space-y-3">
                            <li class="flex gap-3">
                                <span class="flex-shrink-0 w-1.5 h-1.5 rounded-full bg-pink-400 mt-2"></span>
                                <span>Konten yang kamu buat dan unggah — termasuk cheatsheet, repository, dan catatan — tetap menjadi <strong class="text-white">milik kamu</strong>.</span>
                            </li>
                            <li class="flex gap-3">
                                <span class="flex-shrink-0 w-1.5 h-1.5 rounded-full bg-pink-400 mt-2"></span>
                                <span>Dengan menggunggah konten, kamu memberikan Baricode <strong class="text-white">lisensi non-eksklusif</strong> untuk menampilkan, mendistribusikan, dan mempromosikannya dalam konteks platform komunitas.</span>
                            </li>
                            <li class="flex gap-3">
                                <span class="flex-shrink-0 w-1.5 h-1.5 rounded-full bg-pink-400 mt-2"></span>
                                <span>Kamu <strong class="text-white">dilarang mengunggah</strong> konten yang melanggar hak cipta orang lain atau pihak ketiga.</span>
                            </li>
                            <li class="flex gap-3">
                                <span class="flex-shrink-0 w-1.5 h-1.5 rounded-full bg-pink-400 mt-2"></span>
                                <span>Semua merek dagang, logo, dan identitas visual Baricode adalah milik pengelola platform dan tidak boleh digunakan tanpa izin tertulis.</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- 05. LMS & Kursus -->
                <div id="lms" class="scroll-mt-20">
                    <div class="flex items-center gap-4 mb-6">
                        <span class="flex-shrink-0 w-10 h-10 rounded-xl bg-blue-500/20 border border-blue-500/30 flex items-center justify-center text-blue-300 font-bold text-sm">05</span>
                        <h2 class="text-2xl font-bold text-white">Kursus & LMS</h2>
                    </div>
                    <div class="bg-white/5 backdrop-blur-xl rounded-3xl p-8 border border-white/10 space-y-4 text-gray-300 leading-relaxed">
                        <ul class="space-y-3">
                            <li class="flex gap-3">
                                <span class="flex-shrink-0 w-1.5 h-1.5 rounded-full bg-blue-400 mt-2"></span>
                                <span>Akses kursus diberikan sesuai dengan status enrollment kamu dan bersifat <strong class="text-white">personal</strong> — tidak boleh disebarluaskan, dijual kembali, atau dibagikan kepada pihak lain.</span>
                            </li>
                            <li class="flex gap-3">
                                <span class="flex-shrink-0 w-1.5 h-1.5 rounded-full bg-blue-400 mt-2"></span>
                                <span>Progress belajar, sertifikat, dan pencapaian kursus terikat pada akun pribadimu dan tidak dapat dipindahtangankan.</span>
                            </li>
                            <li class="flex gap-3">
                                <span class="flex-shrink-0 w-1.5 h-1.5 rounded-full bg-blue-400 mt-2"></span>
                                <span>Baricode berhak memperbarui, merevisi, atau menghapus konten kursus sewaktu-waktu demi menjaga kualitas materi.</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- 06. Penghentian Akun -->
                <div id="penghentian" class="scroll-mt-20">
                    <div class="flex items-center gap-4 mb-6">
                        <span class="flex-shrink-0 w-10 h-10 rounded-xl bg-red-500/20 border border-red-500/30 flex items-center justify-center text-red-300 font-bold text-sm">06</span>
                        <h2 class="text-2xl font-bold text-white">Penghentian Akun</h2>
                    </div>
                    <div class="bg-white/5 backdrop-blur-xl rounded-3xl p-8 border border-white/10 space-y-4 text-gray-300 leading-relaxed">
                        <ul class="space-y-3">
                            <li class="flex gap-3">
                                <span class="flex-shrink-0 w-1.5 h-1.5 rounded-full bg-red-400 mt-2"></span>
                                <span>Kamu dapat meminta penghapusan akun kapan saja melalui halaman Pengaturan atau dengan menghubungi tim Baricode.</span>
                            </li>
                            <li class="flex gap-3">
                                <span class="flex-shrink-0 w-1.5 h-1.5 rounded-full bg-red-400 mt-2"></span>
                                <span>Baricode berhak <strong class="text-white">menangguhkan atau menghapus akun</strong> yang melanggar Syarat & Ketentuan ini, termasuk tanpa pemberitahuan terlebih dahulu untuk pelanggaran berat.</span>
                            </li>
                            <li class="flex gap-3">
                                <span class="flex-shrink-0 w-1.5 h-1.5 rounded-full bg-red-400 mt-2"></span>
                                <span>Setelah akun dihapus, data yang terkait akan dihapus sesuai dengan Kebijakan Privasi kami.</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- 07. Perubahan Ketentuan -->
                <div id="perubahan" class="scroll-mt-20">
                    <div class="flex items-center gap-4 mb-6">
                        <span class="flex-shrink-0 w-10 h-10 rounded-xl bg-emerald-500/20 border border-emerald-500/30 flex items-center justify-center text-emerald-300 font-bold text-sm">07</span>
                        <h2 class="text-2xl font-bold text-white">Perubahan Ketentuan</h2>
                    </div>
                    <div class="bg-white/5 backdrop-blur-xl rounded-3xl p-8 border border-white/10 space-y-4 text-gray-300 leading-relaxed">
                        <p>Baricode dapat memperbarui Syarat & Ketentuan ini sewaktu-waktu. Perubahan yang bersifat signifikan akan diinformasikan melalui:</p>
                        <ul class="space-y-3 mt-2">
                            <li class="flex gap-3">
                                <span class="flex-shrink-0 w-1.5 h-1.5 rounded-full bg-emerald-400 mt-2"></span>
                                <span>Notifikasi di dalam platform, atau</span>
                            </li>
                            <li class="flex gap-3">
                                <span class="flex-shrink-0 w-1.5 h-1.5 rounded-full bg-emerald-400 mt-2"></span>
                                <span>Pengiriman email ke alamat yang terdaftar.</span>
                            </li>
                        </ul>
                        <p class="text-sm text-gray-400 mt-4">Melanjutkan penggunaan platform setelah perubahan berlaku dianggap sebagai persetujuan terhadap ketentuan yang baru.</p>
                    </div>
                </div>

                <!-- 08. Batasan Tanggung Jawab -->
                <div id="batasan" class="scroll-mt-20">
                    <div class="flex items-center gap-4 mb-6">
                        <span class="flex-shrink-0 w-10 h-10 rounded-xl bg-yellow-500/20 border border-yellow-500/30 flex items-center justify-center text-yellow-300 font-bold text-sm">08</span>
                        <h2 class="text-2xl font-bold text-white">Batasan Tanggung Jawab</h2>
                    </div>
                    <div class="bg-white/5 backdrop-blur-xl rounded-3xl p-8 border border-white/10 space-y-4 text-gray-300 leading-relaxed">
                        <ul class="space-y-3">
                            <li class="flex gap-3">
                                <span class="flex-shrink-0 w-1.5 h-1.5 rounded-full bg-yellow-400 mt-2"></span>
                                <span>Platform Baricode disediakan dalam kondisi <em>"sebagaimana adanya"</em> (<em>as is</em>) tanpa jaminan ketersediaan 100% atau bebas dari gangguan teknis.</span>
                            </li>
                            <li class="flex gap-3">
                                <span class="flex-shrink-0 w-1.5 h-1.5 rounded-full bg-yellow-400 mt-2"></span>
                                <span>Baricode tidak bertanggung jawab atas kerugian yang timbul akibat konten yang diunggah atau disebarkan oleh pengguna lain.</span>
                            </li>
                            <li class="flex gap-3">
                                <span class="flex-shrink-0 w-1.5 h-1.5 rounded-full bg-yellow-400 mt-2"></span>
                                <span>Penggunaan kode, tutorial, atau materi dari platform sepenuhnya menjadi tanggung jawab pengguna.</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- 09. Hukum yang Berlaku -->
                <div id="hukum" class="scroll-mt-20">
                    <div class="flex items-center gap-4 mb-6">
                        <span class="flex-shrink-0 w-10 h-10 rounded-xl bg-purple-500/20 border border-purple-500/30 flex items-center justify-center text-purple-300 font-bold text-sm">09</span>
                        <h2 class="text-2xl font-bold text-white">Hukum yang Berlaku</h2>
                    </div>
                    <div class="bg-white/5 backdrop-blur-xl rounded-3xl p-8 border border-white/10 space-y-4 text-gray-300 leading-relaxed">
                        <p>Syarat & Ketentuan ini tunduk pada dan ditafsirkan berdasarkan <strong class="text-white">hukum Republik Indonesia</strong>. Setiap perselisihan yang timbul akan diselesaikan secara musyawarah, atau jika tidak tercapai kesepakatan, melalui jalur hukum yang berlaku di Indonesia.</p>
                    </div>
                </div>

                <!-- 10. Kontak -->
                <div id="kontak" class="scroll-mt-20">
                    <div class="flex items-center gap-4 mb-6">
                        <span class="flex-shrink-0 w-10 h-10 rounded-xl bg-indigo-500/20 border border-indigo-500/30 flex items-center justify-center text-indigo-300 font-bold text-sm">10</span>
                        <h2 class="text-2xl font-bold text-white">Hubungi Kami</h2>
                    </div>
                    <div class="bg-gradient-to-r from-purple-600/20 via-violet-600/20 to-indigo-600/20 backdrop-blur-xl rounded-3xl p-8 border border-purple-500/30 text-gray-300 leading-relaxed">
                        <p>Jika kamu memiliki pertanyaan atau keberatan terkait Syarat & Ketentuan ini, silakan hubungi kami:</p>
                        <div class="mt-4 space-y-2 text-sm">
                            <p><span class="text-gray-400">Platform:</span> <span class="text-purple-300">Baricode Community</span></p>
                            <p><span class="text-gray-400">Email:</span> <span class="text-purple-300">hello@baricode.id</span></p>
                        </div>
                        <div class="mt-6 pt-6 border-t border-white/10 flex flex-wrap gap-4 text-sm">
                            <a href="{{ route('privacy') }}" class="text-purple-400 hover:text-purple-300 transition-colors">
                                Kebijakan Privasi →
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
