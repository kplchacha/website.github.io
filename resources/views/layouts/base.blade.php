<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @hasSection ('title')
    <title>@yield('title') | {{ config('app.name') }}</title>
    @else
    <title>{{ config('app.name') }}</title>
    @endif

    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    @livewireStyles
    @stack('styles')
</head>

<body>

    @yield('content')

    @stack('modals')

    @livewireScripts
    <script src="{{ mix('js/app.js') }}"></script>
    @stack('scripts')

</body>
</html>