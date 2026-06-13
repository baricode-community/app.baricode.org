import { createIcons, icons } from 'lucide';

function initLucide() {
    createIcons({ icons });
}

document.addEventListener('DOMContentLoaded', initLucide);

document.addEventListener('livewire:navigated', initLucide);
document.addEventListener('livewire:update', initLucide);

if (window.Livewire) {
    document.addEventListener('livewire:initialized', () => {
        Livewire.hook('morph.updated', () => initLucide());
        Livewire.hook('commit', ({ component, commit, respond, succeed, fail }) => {
            succeed(({ snapshot, effect }) => {
                setTimeout(initLucide, 50);
            });
        });
    });
}
