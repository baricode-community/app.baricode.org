<div class="space-y-6">
    {{-- Status Badge --}}
    <div class="flex items-center gap-2 mb-4">
        @if($isEditing)
            <span class="inline-flex items-center gap-1 px-3 py-1 bg-blue-100 text-blue-800 text-xs font-semibold rounded-full">
                <i data-lucide="pencil" class="w-4 h-4"></i>
                Mode Edit
            </span>
            <p class="text-sm text-gray-600">Anda dapat mengedit catatan untuk hari ini</p>
        @else
            <span class="inline-flex items-center gap-1 px-3 py-1 bg-green-100 text-green-800 text-xs font-semibold rounded-full">
                <i data-lucide="check-circle" class="w-4 h-4"></i>
                Mode Buat Baru
            </span>
            <p class="text-sm text-gray-600">Buat catatan baru untuk hari ini</p>
        @endif
    </div>

    <form wire:submit="save" class="space-y-6">
        {{-- Title --}}
        <div>
            <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">
                Judul Catatan <span class="text-red-500">*</span>
            </label>
            <input 
                type="text" 
                id="title" 
                wire:model="title"
                placeholder="Contoh: Belajar Laravel Livewire"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all"
            />
            @error('title') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
        </div>

        {{-- Message --}}
        <div>
            <label for="message" class="block text-sm font-semibold text-gray-700 mb-2">
                Catatan/Pesan <span class="text-red-500">*</span>
            </label>
            <textarea 
                id="message" 
                wire:model="message"
                rows="5"
                placeholder="Jelaskan apa yang telah kamu kerjakan hari ini, fitur apa yang berhasil diimplementasikan, atau masalah apa yang berhasil dipecahkan..."
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all resize-none"
            ></textarea>
            @error('message') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
        </div>

        {{-- Impression --}}
        <div>
            <label for="impression" class="block text-sm font-semibold text-gray-700 mb-2">
                Kesan Pribadi <span class="text-red-500">*</span>
            </label>
            <textarea 
                id="impression" 
                wire:model="impression"
                rows="4"
                placeholder="Tuliskan kesan pribadi Anda tentang hari ini. Apa yang menurutmu berjalan baik? Apa yang perlu ditingkatkan?"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all resize-none"
            ></textarea>
            @error('impression') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
        </div>

        {{-- Success Level --}}
        <div>
            <label for="success_level" class="block text-sm font-semibold text-gray-700 mb-2">
                Level Keberhasilan <span class="text-red-500">*</span>
            </label>
            <div class="flex items-center gap-4">
                <input 
                    type="range" 
                    id="success_level" 
                    wire:model.live="success_level"
                    min="1" 
                    max="10"
                    class="flex-1 h-2 bg-gradient-to-r from-red-500 via-yellow-500 to-green-500 rounded-lg appearance-none cursor-pointer accent-orange-600"
                />
                <div class="text-center">
                    <span class="text-3xl font-bold text-orange-600">{{ $success_level }}</span>
                    <span class="text-gray-600 text-sm">/10</span>
                </div>
            </div>
            <div class="mt-3 flex justify-between text-xs text-gray-500">
                <span>Sangat Buruk</span>
                <span>Sempurna</span>
            </div>
            @error('success_level') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
        </div>

        {{-- Submit Button --}}
        <div class="flex gap-4 pt-6">
            <button 
                type="submit"
                wire:loading.attr="disabled"
                class="flex-1 bg-gradient-to-r from-orange-500 to-amber-600 text-white font-semibold py-3 px-6 rounded-lg hover:shadow-lg transition-all disabled:opacity-50 disabled:cursor-not-allowed flex items-center justify-center gap-2"
            >
                <i data-lucide="check" class="w-5 h-5"></i>
                <span wire:loading.remove>
                    @if($isEditing)
                        💾 Update Catatan
                    @else
                        ✨ Simpan Catatan Baru
                    @endif
                </span>
                <span wire:loading>⏳ Menyimpan...</span>
            </button>
        </div>
    </form>

    {{-- Success Message --}}
    <div class="mt-6">
        @if (session()->has('message'))
            <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg flex items-start gap-3">
                <i data-lucide="check-circle" class="w-5 h-5 mt-0.5 flex-shrink-0"></i>
                <div>
                    <p class="font-semibold">{{ session('message') }}</p>
                </div>
            </div>
        @endif

        @if (session()->has('error'))
            <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg flex items-start gap-3">
                <i data-lucide="x-circle" class="w-5 h-5 mt-0.5 flex-shrink-0"></i>
                <div>
                    <p class="font-semibold">{{ session('error') }}</p>
                </div>
            </div>
        @endif
    </div>

    <script>
        document.addEventListener('livewire:navigated', function() {
            const successMsg = document.querySelector('[role="alert"]');
            if (successMsg) {
                setTimeout(() => {
                    successMsg.remove();
                }, 5000);
            }
        });
    </script>
</div>
