<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('partials.head')
</head>

<body>
    @include('partials.navbar')

    <div
        class="min-h-screen bg-gradient-to-br from-purple-900 via-violet-900 to-indigo-900 dark:from-gray-900 dark:via-purple-900 dark:to-indigo-900 text-white dark:text-white">
        <div class="p-2">
            @if (isset($slot))
                {{ $slot }}
            @else
                @yield('content')
            @endif
        </div>
    </div>

    @fluxScripts
</body>

</html>
