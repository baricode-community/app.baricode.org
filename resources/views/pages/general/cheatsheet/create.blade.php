<x-layouts.base :title="'Buat Cheat Sheet'">

    <div class="max-w-3xl mx-auto px-4 py-8 md:px-8 space-y-6">

        {{-- ─── HEADER ─── --}}
        <div>
            <div class="flex items-center gap-2 text-sm text-purple-400 mb-4">
                <a href="{{ route('cheatsheet.index') }}" class="hover:text-purple-300 transition-colors">Cheat Sheet Library</a>
                <span>/</span>
                <span class="text-purple-300">Buat Baru</span>
            </div>
            <h1 class="text-white text-2xl font-bold">Buat Cheat Sheet</h1>
            <p class="text-purple-300 text-sm mt-1">Tulis referensi cepat untuk dirimu sendiri atau bagikan ke komunitas.</p>
        </div>

        {{-- ─── FORM ─── --}}
        <form method="POST" action="{{ route('cheatsheet.store') }}" class="space-y-5">
            @csrf

            @if($errors->any())
                <div class="bg-red-500/10 border border-red-500/30 rounded-xl p-4">
                    <ul class="list-disc list-inside text-red-300 text-sm space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(session('success'))
                <div class="bg-emerald-500/10 border border-emerald-500/30 rounded-xl p-4 text-emerald-300 text-sm">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white/5 backdrop-blur-lg rounded-2xl border border-purple-500/20 p-6 space-y-5">

                {{-- Title --}}
                <div>
                    <label class="block text-purple-300 text-sm font-medium mb-1.5">Judul <span class="text-red-400">*</span></label>
                    <input type="text" name="title" value="{{ old('title') }}"
                           placeholder="Contoh: Git Commands yang Sering Dipakai"
                           class="w-full px-4 py-2.5 bg-white/5 border border-purple-500/20 rounded-xl text-white placeholder-purple-500 text-sm focus:outline-none focus:border-purple-400/60 transition-colors @error('title') border-red-500/50 @enderror">
                </div>

                {{-- Category --}}
                <div>
                    <label class="block text-purple-300 text-sm font-medium mb-1.5">Kategori <span class="text-red-400">*</span></label>
                    @if($categories->isEmpty())
                        <p class="text-amber-400 text-xs">Belum ada kategori. Hubungi admin untuk menambahkan kategori.</p>
                    @else
                        <select name="cheat_sheet_category_id"
                                class="w-full px-4 py-2.5 bg-white/5 border border-purple-500/20 rounded-xl text-white text-sm focus:outline-none focus:border-purple-400/60 transition-colors @error('cheat_sheet_category_id') border-red-500/50 @enderror">
                            <option value="" class="bg-gray-900">-- Pilih Kategori --</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" class="bg-gray-900"
                                        {{ old('cheat_sheet_category_id') == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                    @endif
                </div>

                {{-- Description --}}
                <div>
                    <label class="block text-purple-300 text-sm font-medium mb-1.5">Deskripsi Singkat <span class="text-purple-500">(opsional)</span></label>
                    <input type="text" name="description" value="{{ old('description') }}"
                           placeholder="Ringkasan singkat isi cheat sheet ini..."
                           maxlength="500"
                           class="w-full px-4 py-2.5 bg-white/5 border border-purple-500/20 rounded-xl text-white placeholder-purple-500 text-sm focus:outline-none focus:border-purple-400/60 transition-colors">
                </div>

                {{-- Content --}}
                <div>
                    <label class="block text-purple-300 text-sm font-medium mb-1.5">Isi Cheat Sheet <span class="text-red-400">*</span></label>
                    <textarea name="content" rows="16"
                              placeholder="Tulis perintah, sintaks, atau referensi di sini...&#10;&#10;Contoh:&#10;# Git Dasar&#10;git init        → inisialisasi repo baru&#10;git add .       → stage semua perubahan&#10;git commit -m   → commit dengan pesan"
                              class="w-full px-4 py-3 bg-black/30 border border-purple-500/20 rounded-xl text-purple-100 placeholder-purple-600 text-sm font-mono focus:outline-none focus:border-purple-400/60 transition-colors resize-y @error('content') border-red-500/50 @enderror">{{ old('content') }}</textarea>
                </div>

                {{-- Visibility --}}
                <div class="flex items-center justify-between py-3 px-4 bg-white/3 rounded-xl border border-purple-500/10">
                    <div>
                        <p class="text-white text-sm font-medium">Tampilkan ke publik</p>
                        <p class="text-purple-400 text-xs mt-0.5">Jika diaktifkan, semua member bisa melihat cheat sheet ini</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="hidden" name="is_public" value="0">
                        <input type="checkbox" name="is_public" value="1" class="sr-only peer"
                               {{ old('is_public', '1') === '1' ? 'checked' : '' }}>
                        <div class="w-11 h-6 bg-purple-900 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-purple-600"></div>
                    </label>
                </div>

            </div>

            <div class="flex items-center gap-3 justify-end">
                <a href="{{ route('cheatsheet.index') }}"
                   class="px-5 py-2.5 bg-white/5 hover:bg-white/10 border border-purple-500/20 rounded-xl text-purple-300 text-sm transition-all">
                    Batal
                </a>
                <button type="submit"
                        class="px-6 py-2.5 bg-gradient-to-r from-purple-600 to-indigo-600 rounded-xl text-white text-sm font-semibold hover:shadow-lg hover:shadow-purple-500/30 transition-all">
                    Simpan Cheat Sheet
                </button>
            </div>
        </form>

    </div>

</x-layouts.base>
