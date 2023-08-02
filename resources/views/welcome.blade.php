<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>       
    </head>
    <body class="antialiased">
        <div>
            @if (Route::has('login'))
                <div style="background-color:gray;">
                    @auth
                        <div>@include('navigation-menu')</div>
                        <a href="{{ url('/dashboard') }}" class="btn btn-danger  text-sm text-gray-700 dark:text-gray-500 underline">Dashboard</a>
                    @endauth
                </div>
            @endif
        </div>

        <h1>Home page</h1>
        
    </body>
</html>
