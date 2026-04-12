@props(['title' => null])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    @include('partials.head')
</head>

<body class="min-h-screen bg-gradient-to-br from-gray-900 via-purple-900 to-indigo-900 text-white">

    @if (isset($slot))
        {{ $slot }}
    @else
        @yield('content')
    @endif

    @fluxScripts
</body>

</html>
