@props(['title' => null])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('partials.head')
</head>

<body class="min-h-screen bg-gradient-to-br from-purple-900 via-violet-900 to-indigo-900 dark:from-gray-900 dark:via-purple-900 dark:to-indigo-900 text-white">

    @include('partials.navbar')

    @if (isset($slot))
        {{ $slot }}
    @else
        @yield('content')
    @endif

    @fluxScripts
</body>

</html>
