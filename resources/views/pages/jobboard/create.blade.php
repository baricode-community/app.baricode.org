<x-layouts.base :title="__('Post Lowongan — Job Board')">
    <div class="w-full p-4">

        {{-- Breadcrumb --}}
        <nav class="flex items-center gap-2 text-sm text-blue-400 mb-8">
            <a href="{{ route('jobboard.index') }}" class="hover:text-blue-300 transition">Job Board</a>
            <svg class="w-4 h-4 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
            </svg>
            <span class="text-gray-400">Post Lowongan</span>
        </nav>

        {{-- Header --}}
        <div class="mb-8">
            <h1 class="text-3xl font-extrabold text-white mb-2">Post Lowongan</h1>
            <p class="text-gray-400">Bagikan lowongan kerja ke komunitas Baricode. Akan direview oleh admin sebelum dipublikasikan.</p>
        </div>

        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-500/10 border border-red-500/30 rounded-xl text-red-400 text-sm space-y-1">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('jobboard.post.store') }}" class="space-y-6">
            @csrf

            {{-- Judul --}}
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1.5">
                    Judul Posisi <span class="text-red-400">*</span>
                </label>
                <input type="text" name="title" value="{{ old('title') }}"
                    placeholder="cth: Backend Engineer, Frontend Developer"
                    class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-blue-500/60 focus:ring-1 focus:ring-blue-500/30 transition @error('title') border-red-500/50 @enderror">
            </div>

            {{-- Perusahaan --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-1.5">
                        Nama Perusahaan <span class="text-red-400">*</span>
                    </label>
                    <input type="text" name="company_name" value="{{ old('company_name') }}"
                        placeholder="cth: PT Teknologi Maju"
                        class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-blue-500/60 focus:ring-1 focus:ring-blue-500/30 transition @error('company_name') border-red-500/50 @enderror">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-1.5">
                        URL Logo <span class="text-gray-500 font-normal">(opsional)</span>
                    </label>
                    <input type="url" name="company_logo" value="{{ old('company_logo') }}"
                        placeholder="https://..."
                        class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-blue-500/60 focus:ring-1 focus:ring-blue-500/30 transition @error('company_logo') border-red-500/50 @enderror">
                </div>
            </div>

            {{-- Tipe & Lokasi --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-1.5">
                        Tipe Pekerjaan <span class="text-red-400">*</span>
                    </label>
                    <select name="job_type"
                        class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-blue-500/60 focus:ring-1 focus:ring-blue-500/30 transition @error('job_type') border-red-500/50 @enderror">
                        <option value="">Pilih tipe...</option>
                        @foreach ($jobTypes as $type)
                            <option value="{{ $type->value }}" {{ old('job_type') === $type->value ? 'selected' : '' }}>
                                {{ $type->label() }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-1.5">
                        Lokasi <span class="text-red-400">*</span>
                    </label>
                    <input type="text" name="location" value="{{ old('location') }}"
                        placeholder="cth: Jakarta, Bandung, Remote"
                        class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-blue-500/60 focus:ring-1 focus:ring-blue-500/30 transition @error('location') border-red-500/50 @enderror">
                </div>
            </div>

            {{-- Remote --}}
            <label class="flex items-center gap-3 cursor-pointer">
                <div class="relative">
                    <input type="hidden" name="is_remote" value="0">
                    <input type="checkbox" name="is_remote" value="1" {{ old('is_remote') ? 'checked' : '' }}
                        class="sr-only peer">
                    <div class="w-11 h-6 bg-white/10 border border-white/20 rounded-full peer-checked:bg-blue-600 transition"></div>
                    <div class="absolute top-0.5 left-0.5 w-5 h-5 bg-white rounded-full transition peer-checked:translate-x-5"></div>
                </div>
                <span class="text-sm text-gray-300">Posisi ini bisa dikerjakan secara remote</span>
            </label>

            {{-- Tech Stack --}}
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1.5">
                    Tech Stack <span class="text-gray-500 font-normal">(opsional)</span>
                </label>
                <input type="text" name="tech_stack" value="{{ old('tech_stack') }}"
                    placeholder="cth: Laravel, Vue.js, PostgreSQL, Docker"
                    class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-blue-500/60 focus:ring-1 focus:ring-blue-500/30 transition @error('tech_stack') border-red-500/50 @enderror">
                <p class="mt-1.5 text-xs text-gray-500">Pisahkan dengan koma</p>
            </div>

            {{-- Deskripsi --}}
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1.5">
                    Deskripsi Pekerjaan <span class="text-red-400">*</span>
                </label>
                <textarea name="description" rows="5"
                    placeholder="Jelaskan tanggung jawab, lingkungan kerja, benefit, dll..."
                    class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-blue-500/60 focus:ring-1 focus:ring-blue-500/30 transition resize-none @error('description') border-red-500/50 @enderror">{{ old('description') }}</textarea>
            </div>

            {{-- Persyaratan --}}
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1.5">
                    Persyaratan <span class="text-red-400">*</span>
                </label>
                <textarea name="requirements" rows="4"
                    placeholder="Pengalaman minimum, skill yang dibutuhkan, pendidikan, dsb..."
                    class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-blue-500/60 focus:ring-1 focus:ring-blue-500/30 transition resize-none @error('requirements') border-red-500/50 @enderror">{{ old('requirements') }}</textarea>
            </div>

            {{-- Salary --}}
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1.5">
                    Rentang Gaji <span class="text-gray-500 font-normal">(opsional)</span>
                </label>
                <div class="grid grid-cols-3 gap-3">
                    <div>
                        <select name="salary_currency"
                            class="w-full bg-white/5 border border-white/10 rounded-xl px-3 py-3 text-white text-sm focus:outline-none focus:border-blue-500/60 transition">
                            <option value="IDR" {{ old('salary_currency', 'IDR') === 'IDR' ? 'selected' : '' }}>IDR</option>
                            <option value="USD" {{ old('salary_currency') === 'USD' ? 'selected' : '' }}>USD</option>
                            <option value="SGD" {{ old('salary_currency') === 'SGD' ? 'selected' : '' }}>SGD</option>
                        </select>
                    </div>
                    <div>
                        <input type="number" name="salary_min" value="{{ old('salary_min') }}"
                            placeholder="Minimum"
                            class="w-full bg-white/5 border border-white/10 rounded-xl px-3 py-3 text-white placeholder-gray-500 text-sm focus:outline-none focus:border-blue-500/60 transition @error('salary_min') border-red-500/50 @enderror">
                    </div>
                    <div>
                        <input type="number" name="salary_max" value="{{ old('salary_max') }}"
                            placeholder="Maksimum"
                            class="w-full bg-white/5 border border-white/10 rounded-xl px-3 py-3 text-white placeholder-gray-500 text-sm focus:outline-none focus:border-blue-500/60 transition @error('salary_max') border-red-500/50 @enderror">
                    </div>
                </div>
            </div>

            {{-- Apply --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-1.5">
                        URL Lamaran
                    </label>
                    <input type="url" name="apply_url" value="{{ old('apply_url') }}"
                        placeholder="https://careers.perusahaan.com/..."
                        class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-blue-500/60 focus:ring-1 focus:ring-blue-500/30 transition @error('apply_url') border-red-500/50 @enderror">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-1.5">
                        Email Lamaran
                    </label>
                    <input type="email" name="apply_email" value="{{ old('apply_email') }}"
                        placeholder="hrd@perusahaan.com"
                        class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-blue-500/60 focus:ring-1 focus:ring-blue-500/30 transition @error('apply_email') border-red-500/50 @enderror">
                </div>
            </div>
            <p class="text-xs text-gray-500 -mt-4">Minimal satu dari URL atau email lamaran harus diisi.</p>

            {{-- Expires At --}}
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1.5">
                    Kadaluarsa <span class="text-gray-500 font-normal">(opsional)</span>
                </label>
                <input type="date" name="expires_at" value="{{ old('expires_at') }}"
                    min="{{ now()->addDay()->format('Y-m-d') }}"
                    class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-blue-500/60 focus:ring-1 focus:ring-blue-500/30 transition @error('expires_at') border-red-500/50 @enderror">
            </div>

            {{-- Info --}}
            <div class="flex items-start gap-3 p-4 bg-blue-500/10 border border-blue-500/20 rounded-xl text-sm text-blue-300">
                <svg class="w-5 h-5 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <p>Lowongan kamu akan direview oleh admin Baricode sebelum tayang. Cek status di <a href="{{ route('jobboard.my-listings') }}" class="underline hover:text-blue-200">Lowongan Saya</a>.</p>
            </div>

            {{-- Submit --}}
            <div class="flex items-center gap-4 pt-2">
                <button type="submit"
                    class="px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 rounded-xl font-semibold text-white hover:from-blue-500 hover:to-indigo-500 transition shadow-lg hover:shadow-blue-500/30">
                    Submit Lowongan
                </button>
                <a href="{{ route('jobboard.index') }}" class="text-gray-400 hover:text-gray-300 transition text-sm">
                    Batal
                </a>
            </div>
        </form>
    </div>
</x-layouts.base>
