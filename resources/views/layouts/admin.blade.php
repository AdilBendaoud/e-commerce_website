<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @include('styles')
</head>
<body class="min-h-screen relative">
    <div class="row m-0">
        <x-sidebar />
        <main class="col-12 col-lg-10" style="background-color: var(--background);">
            <button id="mytoggleButton" class=" btn btn-primary"><i class="fa-solid fa-bars text-white"></i></button>
            @yield('content')        
        </main>
    </div>
    
    @include('scripts')
    @yield('script')
    <script>
        const toggleButton = document.getElementById('mytoggleButton');
        const sidebar = document.getElementById('sidebar');

        toggleButton.addEventListener('click', () => {
            sidebar.classList.toggle('show');
            toggleButton.classList.toggle('translate');
        });
    </script>
</body>
</html>