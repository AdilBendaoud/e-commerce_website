<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @include('styles')
</head>
<body class=" min-h-screen flex">
    
    <x-sidebar />

    <main class="w-100" style="background-color: var(--background);">
        @yield('content')        
    </main>
    
    @include('scripts')
    @yield('script')
</body>
</html>