<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('partials.head')
</head>

<body>
    @include('partials.navbar')

    <div class="min-h-screen bg-gradient-to-br from-purple-900 via-violet-900 to-indigo-900 dark:from-gray-900 dark:via-gray-800 dark:to-black text-white">
        {{ $slot }}
    </div>

    @fluxScripts
</body>

</html>
