<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('components.layouts.dashboard')] class extends Component {
    public string $name = '';
    public string $email = '';
    public string $bio = '';
    public string $phone_number = '';

    public string $current_password = '';
    public string $password = '';
    public string $password_confirmation = '';

    public function mount(): void
    {
        $user = Auth::user();
        $this->name         = $user->name;
        $this->email        = $user->email;
        $this->bio          = $user->bio ?? '';
        $this->phone_number = $user->phone_number ? (string) $user->phone_number : '';
    }

    public function updateProfileInformation(): void
    {
        $user = Auth::user();

        $validated = $this->validate([
            'name'         => ['required', 'string', 'max:255'],
            'email'        => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($user->id)],
            'bio'          => ['nullable', 'string', 'max:500'],
            'phone_number' => ['nullable', 'numeric', 'digits_between:9,15'],
        ]);

        $user->fill([
            'name'         => $validated['name'],
            'email'        => $validated['email'],
            'bio'          => $validated['bio'] ?? null,
            'phone_number' => $validated['phone_number'] ? (int) $validated['phone_number'] : null,
        ]);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        $this->dispatch('profile-updated');
    }

    public function updatePassword(): void
    {
        try {
            $validated = $this->validate([
                'current_password'     => ['required', 'string', 'current_password'],
                'password'             => ['required', 'string', Password::defaults(), 'confirmed'],
                'password_confirmation'=> ['required', 'string'],
            ]);
        } catch (ValidationException $e) {
            $this->reset('current_password', 'password', 'password_confirmation');
            throw $e;
        }

        Auth::user()->update(['password' => $validated['password']]);

        $this->reset('current_password', 'password', 'password_confirmation');

        $this->dispatch('password-updated');
    }

    public function resendVerificationNotification(): void
    {
        $user = Auth::user();

        if ($user->hasVerifiedEmail()) {
            $this->redirectIntended(default: route('dashboard', absolute: false));
            return;
        }

        $user->sendEmailVerificationNotification();
        Session::flash('status', 'verification-link-sent');
    }
}; ?>

<div class="p-6 md:p-10 space-y-12">

    {{-- ===== HEADER ===== --}}
    <div>
        <div class="mb-3">
            <span class="inline-block px-5 py-1.5 bg-gradient-to-r from-violet-500 to-indigo-500 text-white font-semibold rounded-full text-sm shadow">
                ⚙️ Pengaturan Akun
            </span>
        </div>
        <h1 class="text-3xl md:text-4xl font-bold text-white mb-2">Edit Profil</h1>
        <p class="text-purple-200 max-w-xl leading-relaxed">
            Kelola informasi pribadi, keamanan akun, dan preferensi lainnya dalam satu tempat.
        </p>
    </div>

    {{-- ===== INFORMASI PRIBADI ===== --}}
    <div>
        <div class="flex items-center gap-3 mb-6">
            <div class="inline-flex items-center justify-center w-11 h-11 rounded-full bg-gradient-to-br from-violet-500 to-indigo-500 text-white shadow-lg shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
            </div>
            <div>
                <h2 class="text-xl font-bold text-white">Informasi Pribadi</h2>
                <p class="text-sm text-purple-300">Nama, email, bio, dan nomor WhatsApp</p>
            </div>
        </div>

        <div class="bg-gradient-to-br from-violet-500/10 to-transparent backdrop-blur-lg rounded-2xl border border-violet-500/20 hover:border-violet-500/40 p-8 transition-all duration-300 hover:shadow-xl hover:shadow-violet-500/10">
            <form wire:submit="updateProfileInformation" class="space-y-5">

                {{-- Nama --}}
                <div>
                    <label class="block text-sm font-medium text-purple-200 mb-1.5">Nama Lengkap</label>
                    <input
                        wire:model="name"
                        type="text"
                        required
                        autofocus
                        autocomplete="name"
                        placeholder="Masukkan nama lengkap..."
                        class="w-full bg-white/10 border border-violet-500/30 text-white placeholder-purple-400/60 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-violet-500/70 focus:border-violet-500/50 transition"
                    />
                    @error('name') <p class="mt-1.5 text-xs text-red-400">{{ $message }}</p> @enderror
                </div>

                {{-- Email --}}
                <div>
                    <label class="block text-sm font-medium text-purple-200 mb-1.5">Email</label>
                    <input
                        wire:model="email"
                        type="email"
                        required
                        autocomplete="email"
                        placeholder="nama@email.com"
                        class="w-full bg-white/10 border border-violet-500/30 text-white placeholder-purple-400/60 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-violet-500/70 focus:border-violet-500/50 transition"
                    />
                    @error('email') <p class="mt-1.5 text-xs text-red-400">{{ $message }}</p> @enderror

                    @if (auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! auth()->user()->hasVerifiedEmail())
                        <div class="mt-3 p-3 bg-yellow-500/10 border border-yellow-500/30 rounded-lg">
                            <p class="text-sm text-yellow-300">
                                Email belum diverifikasi.
                                <button wire:click.prevent="resendVerificationNotification" class="underline hover:text-yellow-100 cursor-pointer">
                                    Kirim ulang email verifikasi.
                                </button>
                            </p>
                            @if (session('status') === 'verification-link-sent')
                                <p class="mt-2 text-sm font-medium text-green-400">Link verifikasi telah dikirim.</p>
                            @endif
                        </div>
                    @endif
                </div>

                {{-- Bio --}}
                <div>
                    <label class="block text-sm font-medium text-purple-200 mb-1.5">
                        Bio <span class="text-purple-400 font-normal">(opsional)</span>
                    </label>
                    <textarea
                        wire:model="bio"
                        rows="3"
                        maxlength="500"
                        placeholder="Ceritakan sedikit tentang dirimu..."
                        class="w-full bg-white/10 border border-violet-500/30 text-white placeholder-purple-400/60 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-violet-500/70 focus:border-violet-500/50 transition resize-none"
                    ></textarea>
                    @error('bio') <p class="mt-1.5 text-xs text-red-400">{{ $message }}</p> @enderror
                </div>

                {{-- WhatsApp --}}
                <div>
                    <label class="block text-sm font-medium text-purple-200 mb-1.5">
                        Nomor WhatsApp <span class="text-purple-400 font-normal">(opsional)</span>
                    </label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-purple-400 text-sm pointer-events-none select-none">+62</span>
                        <input
                            wire:model="phone_number"
                            type="tel"
                            autocomplete="tel"
                            placeholder="8xxxxxxxxxx"
                            class="w-full bg-white/10 border border-violet-500/30 text-white placeholder-purple-400/60 rounded-xl pl-12 pr-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-violet-500/70 focus:border-violet-500/50 transition"
                        />
                    </div>
                    @error('phone_number') <p class="mt-1.5 text-xs text-red-400">{{ $message }}</p> @enderror
                </div>

                {{-- Submit --}}
                <div class="flex items-center gap-4 pt-2">
                    <button
                        type="submit"
                        class="px-6 py-2.5 bg-gradient-to-r from-violet-500 to-indigo-500 hover:from-violet-600 hover:to-indigo-600 text-white font-semibold rounded-xl shadow transition-all duration-200 disabled:opacity-60"
                        wire:loading.attr="disabled"
                        wire:target="updateProfileInformation"
                    >
                        <span wire:loading.remove wire:target="updateProfileInformation">Simpan Perubahan</span>
                        <span wire:loading wire:target="updateProfileInformation">Menyimpan...</span>
                    </button>

                    <x-action-message on="profile-updated">
                        <span class="text-sm text-green-400 font-medium">✓ Tersimpan</span>
                    </x-action-message>
                </div>
            </form>
        </div>
    </div>

    {{-- ===== GANTI PASSWORD ===== --}}
    <div>
        <div class="flex items-center gap-3 mb-6">
            <div class="inline-flex items-center justify-center w-11 h-11 rounded-full bg-gradient-to-br from-pink-500 to-rose-500 text-white shadow-lg shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                </svg>
            </div>
            <div>
                <h2 class="text-xl font-bold text-white">Keamanan Akun</h2>
                <p class="text-sm text-purple-300">Perbarui kata sandi secara berkala untuk menjaga keamanan</p>
            </div>
        </div>

        <div class="bg-gradient-to-br from-pink-500/10 to-transparent backdrop-blur-lg rounded-2xl border border-pink-500/20 hover:border-pink-500/40 p-8 transition-all duration-300 hover:shadow-xl hover:shadow-pink-500/10">
            <form wire:submit="updatePassword" class="space-y-5">

                <div>
                    <label class="block text-sm font-medium text-purple-200 mb-1.5">Kata Sandi Saat Ini</label>
                    <input
                        wire:model="current_password"
                        type="password"
                        required
                        autocomplete="current-password"
                        placeholder="••••••••"
                        class="w-full bg-white/10 border border-pink-500/30 text-white placeholder-purple-400/60 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-pink-500/70 focus:border-pink-500/50 transition"
                    />
                    @error('current_password') <p class="mt-1.5 text-xs text-red-400">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-purple-200 mb-1.5">Kata Sandi Baru</label>
                    <input
                        wire:model="password"
                        type="password"
                        required
                        autocomplete="new-password"
                        placeholder="••••••••"
                        class="w-full bg-white/10 border border-pink-500/30 text-white placeholder-purple-400/60 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-pink-500/70 focus:border-pink-500/50 transition"
                    />
                    @error('password') <p class="mt-1.5 text-xs text-red-400">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-purple-200 mb-1.5">Konfirmasi Kata Sandi Baru</label>
                    <input
                        wire:model="password_confirmation"
                        type="password"
                        required
                        autocomplete="new-password"
                        placeholder="••••••••"
                        class="w-full bg-white/10 border border-pink-500/30 text-white placeholder-purple-400/60 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-pink-500/70 focus:border-pink-500/50 transition"
                    />
                    @error('password_confirmation') <p class="mt-1.5 text-xs text-red-400">{{ $message }}</p> @enderror
                </div>

                <div class="p-4 bg-pink-500/10 rounded-xl border border-pink-500/20">
                    <p class="text-xs text-pink-200">
                        🔒 Gunakan kombinasi huruf besar, huruf kecil, angka, dan simbol untuk kata sandi yang kuat.
                    </p>
                </div>

                <div class="flex items-center gap-4 pt-2">
                    <button
                        type="submit"
                        class="px-6 py-2.5 bg-gradient-to-r from-pink-500 to-rose-500 hover:from-pink-600 hover:to-rose-600 text-white font-semibold rounded-xl shadow transition-all duration-200 disabled:opacity-60"
                        wire:loading.attr="disabled"
                        wire:target="updatePassword"
                    >
                        <span wire:loading.remove wire:target="updatePassword">Perbarui Kata Sandi</span>
                        <span wire:loading wire:target="updatePassword">Memperbarui...</span>
                    </button>

                    <x-action-message on="password-updated">
                        <span class="text-sm text-green-400 font-medium">✓ Kata sandi diperbarui</span>
                    </x-action-message>
                </div>
            </form>
        </div>
    </div>

    {{-- ===== TEMA WEBSITE ===== --}}
    <div>
        <div class="flex items-center gap-3 mb-6">
            <div class="inline-flex items-center justify-center w-11 h-11 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 text-white shadow-lg shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/>
                </svg>
            </div>
            <div>
                <h2 class="text-xl font-bold text-white">Tampilan</h2>
                <p class="text-sm text-purple-300">Pilih tema yang paling nyaman untuk kamu</p>
            </div>
        </div>

        <div class="bg-gradient-to-br from-indigo-500/10 to-transparent backdrop-blur-lg rounded-2xl border border-indigo-500/20 hover:border-indigo-500/40 p-8 transition-all duration-300 hover:shadow-xl hover:shadow-indigo-500/10" x-data>
            <div class="grid grid-cols-3 gap-3">
                <button
                    @click="$flux.appearance = 'light'"
                    :class="$flux.appearance === 'light' ? 'border-indigo-400 bg-indigo-500/20 text-white' : 'border-indigo-500/20 bg-white/5 text-purple-300 hover:border-indigo-400/50 hover:text-white'"
                    class="flex flex-col items-center gap-2.5 p-4 rounded-xl border transition-all duration-200"
                >
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707M17.657 17.657l-.707-.707M6.343 6.343l-.707-.707M12 8a4 4 0 100 8 4 4 0 000-8z"/>
                    </svg>
                    <span class="text-sm font-medium">Terang</span>
                </button>

                <button
                    @click="$flux.appearance = 'dark'"
                    :class="$flux.appearance === 'dark' ? 'border-indigo-400 bg-indigo-500/20 text-white' : 'border-indigo-500/20 bg-white/5 text-purple-300 hover:border-indigo-400/50 hover:text-white'"
                    class="flex flex-col items-center gap-2.5 p-4 rounded-xl border transition-all duration-200"
                >
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                    </svg>
                    <span class="text-sm font-medium">Gelap</span>
                </button>

                <button
                    @click="$flux.appearance = 'system'"
                    :class="$flux.appearance === 'system' ? 'border-indigo-400 bg-indigo-500/20 text-white' : 'border-indigo-500/20 bg-white/5 text-purple-300 hover:border-indigo-400/50 hover:text-white'"
                    class="flex flex-col items-center gap-2.5 p-4 rounded-xl border transition-all duration-200"
                >
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    <span class="text-sm font-medium">Otomatis</span>
                </button>
            </div>

            <div class="mt-5 p-4 bg-indigo-500/10 rounded-xl border border-indigo-500/20">
                <p class="text-xs text-indigo-200">
                    💡 <strong>Otomatis</strong> akan mengikuti pengaturan tema perangkat kamu secara otomatis.
                </p>
            </div>
        </div>
    </div>

    {{-- ===== HAPUS AKUN ===== --}}
    <div>
        <div class="flex items-center gap-3 mb-6">
            <div class="inline-flex items-center justify-center w-11 h-11 rounded-full bg-gradient-to-br from-red-500 to-rose-600 text-white shadow-lg shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                </svg>
            </div>
            <div>
                <h2 class="text-xl font-bold text-white">Zona Berbahaya</h2>
                <p class="text-sm text-purple-300">Tindakan yang tidak dapat dikembalikan</p>
            </div>
        </div>

        <div class="bg-gradient-to-br from-red-500/10 to-transparent backdrop-blur-lg rounded-2xl border border-red-500/20 hover:border-red-500/40 p-8 transition-all duration-300 hover:shadow-xl hover:shadow-red-500/10">
            <h3 class="text-lg font-semibold text-white mb-1">Hapus Akun</h3>
            <p class="text-sm text-purple-200 mb-6">
                Setelah dihapus, semua data akun Anda akan hilang secara permanen dan tidak dapat dipulihkan.
            </p>
            <livewire:settings.delete-user-form />
        </div>
    </div>

</div>
