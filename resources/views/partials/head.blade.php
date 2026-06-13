<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta name="description" content="{{ $description ?? 'Komunitas IT Keren di Indonesia. | Bersama Bertumbuh, Belajar, dan Berbagi' }}" />
<meta name="theme-color" content="#1e1b4b" />

<meta property="og:type" content="website" />
<meta property="og:site_name" content="{{ config('app.name') }}" />
<meta property="og:title" content="{{ $title ?? config('app.name') }}" />
<meta property="og:description" content="{{ $description ?? 'Komunitas IT Keren di Indonesia. | Bersama Bertumbuh, Belajar, dan Berbagi' }}" />
<meta property="og:image" content="{{ config('app.url') }}/pwa-512x512.png" />
<meta property="og:image:width" content="512" />
<meta property="og:image:height" content="512" />
<meta name="twitter:card" content="summary" />
<meta name="twitter:title" content="{{ $title ?? config('app.name') }}" />
<meta name="twitter:description" content="{{ $description ?? 'Komunitas IT Keren di Indonesia. | Bersama Bertumbuh, Belajar, dan Berbagi' }}" />
<meta name="twitter:image" content="{{ config('app.url') }}/pwa-512x512.png" />

<title>{{ $title ?? config('app.name') }}</title>

<link rel="icon" href="/favicon.ico" sizes="any">
<link rel="icon" href="/favicon.svg" type="image/svg+xml">
<link rel="apple-touch-icon" href="/apple-touch-icon.png">
<link rel="manifest" href="/build/manifest.webmanifest">

<link rel="preconnect" href="https://fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

@vite(['resources/css/app.css', 'resources/js/app.js'])
@fluxAppearance

{{-- PWA Service Worker Registration with Auto-Update --}}
@if(file_exists(public_path('build/sw.js')))
<script>
    if ('serviceWorker' in navigator) {
        window.addEventListener('load', async () => {
            try {
                const registration = await navigator.serviceWorker.register('/build/sw.js', { scope: '/' });
                
                // Check for updates periodically (every 60 seconds)
                setInterval(() => {
                    registration.update();
                }, 60000);
                
                // Listen for new service worker installation
                registration.addEventListener('updatefound', () => {
                    const newWorker = registration.installing;
                    
                    newWorker.addEventListener('statechange', () => {
                        if (newWorker.state === 'installed' && navigator.serviceWorker.controller) {
                            // New content is available, show update notification
                            if (confirm('Update baru tersedia! Muat ulang halaman untuk mendapatkan versi terbaru?')) {
                                newWorker.postMessage({ type: 'SKIP_WAITING' });
                                window.location.reload();
                            }
                        }
                    });
                });
                
                // Handle controller change (when new SW takes over)
                navigator.serviceWorker.addEventListener('controllerchange', () => {
                    window.location.reload();
                });
                
                console.log('PWA Service Worker registered successfully');
            } catch (error) {
                console.error('PWA Service Worker registration failed:', error);
            }
        });
    }
</script>
@endif
