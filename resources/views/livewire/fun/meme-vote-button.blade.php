<?php

use App\Models\Fun\Meme;
use App\Models\Fun\MemeVote;
use Livewire\Volt\Component;

new class extends Component {
    public $memeId;
    public $upvotes = 0;
    public $downvotes = 0;
    public $userVote = null;

    public function mount($memeId)
    {
        $this->memeId = $memeId;
        $this->loadVoteStats();
    }

    public function loadVoteStats()
    {
        $meme = Meme::find($this->memeId);
        if (!$meme) return;

        $this->upvotes = $meme->upvotesCount();
        $this->downvotes = $meme->downvotesCount();
        
        if (auth()->check()) {
            $vote = $meme->votes()->where('user_id', auth()->id())->first();
            $this->userVote = $vote ? $vote->vote_type : null;
        }
    }

    public function vote($type)
    {
        if (!auth()->check()) {
            return $this->redirect(route('login'));
        }

        $meme = Meme::find($this->memeId);
        if (!$meme) return;

        $user = auth()->user();
        
        // Check if user already voted
        $existingVote = $meme->votes()->where('user_id', $user->id)->first();

        if ($existingVote) {
            // If same vote type, remove it (toggle)
            if ($existingVote->vote_type === $type) {
                $existingVote->delete();
                $this->userVote = null;
            } else {
                // Update to new vote type
                $existingVote->update(['vote_type' => $type]);
                $this->userVote = $type;
            }
        } else {
            // Create new vote
            MemeVote::create([
                'meme_id' => $this->memeId,
                'user_id' => $user->id,
                'vote_type' => $type,
            ]);
            $this->userVote = $type;
        }

        $this->loadVoteStats();
    }
}; ?>

<div class="flex items-center gap-2">
    <button
        wire:click="vote('up')"
        class="flex items-center gap-2 px-3 py-2 rounded-lg transition-all duration-200 {{ $userVote === 'up' ? 'bg-green-500/30 border border-green-500/50' : 'bg-gray-500/10 border border-gray-500/20 hover:bg-green-500/20 hover:border-green-500/30' }}"
        title="{{ __('Suka') }}"
    >
        <span class="text-lg">👍</span>
        <span class="text-xs font-medium text-white">{{ $upvotes }}</span>
    </button>

    <button
        wire:click="vote('down')"
        class="flex items-center gap-2 px-3 py-2 rounded-lg transition-all duration-200 {{ $userVote === 'down' ? 'bg-red-500/30 border border-red-500/50' : 'bg-gray-500/10 border border-gray-500/20 hover:bg-red-500/20 hover:border-red-500/30' }}"
        title="{{ __('Tidak Suka') }}"
    >
        <span class="text-lg">👎</span>
        <span class="text-xs font-medium text-white">{{ $downvotes }}</span>
    </button>
</div>
