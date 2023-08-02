<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" type="image/png" href="/images/favicon.png" sizes="16x16">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" 
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <link rel="stylesheet" href="/css/app.css">
        <link rel="script" href="/js/app.js">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <style>
            #phone_number::-webkit-inner-spin-button,
            #phone_number::-webkit-outer-spin-button {
                -webkit-appearance: none;
                margin: 0;
            }
        </style>
    </head>
    <body style="background-color: var(--background);">
        <!-- this layout dedicated to login and register forms -->
        <div>
            {{ $slot }}
        </div>
    </body>
</html>
