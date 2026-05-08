<?php

use Livewire\Volt\Component;
use App\Models\Fun\Meme;

new class extends Component {
    public $memeId = '';
    public $memeUrl = '';
    public $showModal = false;
    public $copiedNotification = false;

    /**
     * Mount component
     */
    public function mount($memeId)
    {
        $this->memeId = $memeId;
        $meme = Meme::find($memeId);
        $this->memeUrl = route('meme.show', $meme);
    }

    /**
     * Toggle modal
     */
    public function toggleModal()
    {
        $this->showModal = !$this->showModal;
    }

    /**
     * Copy to clipboard
     */
    public function copyToClipboard()
    {
        $this->copiedNotification = true;
        $this->dispatch('clipboard:copy', text: $this->memeUrl);

        // Hide notification after 3 seconds
        $this->dispatch('hideClipboardNotification');
    }

    /**
     * Share to WhatsApp
     */
    public function shareToWhatsapp()
    {
        $text = __('Lihat meme seru ini di Baricode!') . ' ' . $this->memeUrl;
        $whatsappUrl = 'https://wa.me/?text=' . urlencode($text);

        return redirect($whatsappUrl);
    }

    /**
     * Share to Instagram
     */
    public function shareToInstagram()
    {
        // Instagram tidak support direct share via URL, hanya copy link
        $this->copiedNotification = true;
        $this->dispatch('clipboard:copy', text: $this->memeUrl);
    }

    /**
     * Share to Facebook
     */
    public function shareToFacebook()
    {
        $facebookUrl = 'https://www.facebook.com/sharer/sharer.php?u=' . urlencode($this->memeUrl);

        return redirect($facebookUrl);
    }

    /**
     * Hide clipboard notification
     */
    public function hideClipboardNotification()
    {
        $this->copiedNotification = false;
    }
}; ?>

<div class="relative">
    <!-- Clipboard Notification -->
    @if($copiedNotification)
        <div
            class="fixed top-4 right-4 z-[60] animate-in slide-in-from-top-4 fade-in"
            x-data
            x-init="setTimeout(() => $wire.hideClipboardNotification(), 3000)"
        >
            <div class="px-6 py-4 rounded-lg shadow-2xl flex items-center gap-3 backdrop-blur-xl border bg-green-500/10 border-green-500/30 text-green-300">
                <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
                <span class="font-medium text-sm">{{ __('Berhasil disalin ke clipboard!') }}</span>
                <button
                    wire:click="hideClipboardNotification"
                    class="ml-2 text-current opacity-70 hover:opacity-100 transition-opacity"
                >
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
        </div>
    @endif

    <!-- Share Button -->
    <button
        wire:click="toggleModal"
        class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-gradient-to-r from-blue-500 to-cyan-500 hover:shadow-lg hover:shadow-blue-500/50 transition-all transform hover:scale-110 text-white"
        title="{{ __('Bagikan') }}"
    >
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C9.589 12.438 10 11.165 10 9.5C10 5.91 7.09 3 3.5 3S-3 5.91-3 9.5 0 16 3.5 16c1.665 0 2.938-.411 3.842-1.316m0 0l6.368 6.368m0 0a9 9 0 012.828-2.828m-2.828 2.828l6.368 6.368"></path>
        </svg>
    </button>

    <!-- Share Modal -->
    @if($showModal)
        <div
            class="fixed inset-0 z-40 bg-black/70 backdrop-blur-sm transition-opacity duration-300"
            wire:click="toggleModal"
        ></div>

        <div class="fixed inset-4 sm:top-1/2 sm:left-1/2 sm:transform sm:-translate-x-1/2 sm:-translate-y-1/2 sm:inset-auto z-50 animate-in fade-in zoom-in-95 duration-300">
            <div class="bg-gradient-to-br from-gray-900 via-purple-900/20 to-black border border-purple-500/40 rounded-2xl shadow-2xl shadow-purple-500/30 p-6 sm:p-8 w-full sm:w-auto sm:min-w-[500px] max-w-2xl h-full sm:h-auto flex flex-col">
                <!-- Header -->
                <div class="mb-6 flex items-center justify-between">
                    <div>
                        <h3 class="text-2xl sm:text-3xl font-bold text-white mb-1">{{ __('Bagikan Meme') }}</h3>
                        <p class="text-sm text-gray-400">{{ __('Pilih platform untuk berbagi') }}</p>
                    </div>
                    <button
                        wire:click="toggleModal"
                        class="sm:hidden text-gray-400 hover:text-white transition-colors"
                    >
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <!-- Share Options Grid -->
                <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-4 gap-4 sm:gap-5 flex-1 sm:flex-none">
                    <!-- WhatsApp -->
                    <button
                        wire:click="shareToWhatsapp"
                        class="group relative bg-gradient-to-br from-green-500 to-green-600 hover:shadow-lg hover:shadow-green-500/50 rounded-xl p-6 sm:p-8 text-white transition-all transform hover:scale-105 active:scale-95"
                    >
                        <div class="flex flex-col items-center gap-3">
                            <svg class="w-8 h-8 sm:w-10 sm:h-10" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.272-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.67-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.076 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421-7.403h-.004a9.87 9.87 0 00-5.031 1.378c-1.087.713-2.057 1.669-2.723 2.776-1.396 2.291-1.573 5.283-.399 7.995 1.203 2.874 3.907 4.97 7.1 4.97 1.584 0 3.149-.356 4.596-1.036 2.965 1.874 6.5 2.753 9.269 1.288 1.775-.956 2.744-2.637 2.952-4.287.208-1.655-.122-3.589-1.202-5.195-1.137-1.745-2.946-2.718-4.684-2.718h-.004c-1.086 0-2.13.353-3.007.935-1.milwaukee.287-1.42.287-2.852 0-.722-.493-1.797-.779-2.816-.779z"/>
                            </svg>
                            <span class="text-sm sm:text-base font-semibold">{{ __('WhatsApp') }}</span>
                        </div>
                    </button>

                    <!-- Facebook -->
                    <button
                        wire:click="shareToFacebook"
                        class="group relative bg-gradient-to-br from-blue-600 to-blue-700 hover:shadow-lg hover:shadow-blue-500/50 rounded-xl p-6 sm:p-8 text-white transition-all transform hover:scale-105 active:scale-95"
                    >
                        <div class="flex flex-col items-center gap-3">
                            <svg class="w-8 h-8 sm:w-10 sm:h-10" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                            <span class="text-sm sm:text-base font-semibold">{{ __('Facebook') }}</span>
                        </div>
                    </button>

                    <!-- Instagram -->
                    <button
                        wire:click="shareToInstagram"
                        class="group relative bg-gradient-to-br from-pink-500 via-purple-500 to-indigo-500 hover:shadow-lg hover:shadow-pink-500/50 rounded-xl p-6 sm:p-8 text-white transition-all transform hover:scale-105 active:scale-95"
                    >
                        <div class="flex flex-col items-center gap-3">
                            <svg class="w-8 h-8 sm:w-10 sm:h-10" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zM5.838 12a6.162 6.162 0 1112.324 0 6.162 6.162 0 01-12.324 0zM12 16a4 4 0 110-8 4 4 0 010 8zm4.965-10.322a1.44 1.44 0 112.881.001 1.44 1.44 0 01-2.881-.001z"/>
                            </svg>
                            <span class="text-sm sm:text-base font-semibold">{{ __('Instagram') }}</span>
                        </div>
                    </button>

                    <!-- Copy Link -->
                    <button
                        wire:click="copyToClipboard"
                        class="group relative bg-gradient-to-br from-orange-500 to-red-500 hover:shadow-lg hover:shadow-orange-500/50 rounded-xl p-6 sm:p-8 text-white transition-all transform hover:scale-105 active:scale-95"
                    >
                        <div class="flex flex-col items-center gap-3">
                            <svg class="w-8 h-8 sm:w-10 sm:h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                            </svg>
                            <span class="text-sm sm:text-base font-semibold">{{ __('Copy Link') }}</span>
                        </div>
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>

@script
<script>
    Livewire.on('clipboard:copy', (text) => {
        text = text.text;
        console.log('Copying to clipboard:', text);
        navigator.clipboard.writeText(text).then(() => {
            // Notification sudah ditampilkan dari Livewire
        }).catch(err => {
            // Fallback untuk browser lama
            const textarea = document.createElement('textarea');
            textarea.value = text;
            document.body.appendChild(textarea);
            textarea.select();
            document.execCommand('copy');
            document.body.removeChild(textarea);
        });
    });
</script>
@endscript