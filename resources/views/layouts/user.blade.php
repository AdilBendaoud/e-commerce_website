<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }}</title>
    @include('styles')
</head>
<body>
    @include('navigation-menu')
    
    <main style="background-color: var(--background);">
        @yield('content')
    </main>

    <x-footer />

    @include('scripts')
    @yield('script')
</body>
</html>