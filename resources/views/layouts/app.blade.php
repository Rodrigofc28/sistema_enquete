<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Enquetes</title>
        <link rel="stylesheet" href="{{asset('css/style.css')}}">
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
       @vite(['resources/css/app.css', 'resources/js/app.js'])
       <script  src="https://js.pusher.com/7.0/pusher.min.js"></script>
       <script type="module" src="https://cdn.jsdelivr.net/npm/laravel-echo@~1.10/dist/echo.js"></script>

        <!-- Scripts -->
       
    </head>
    <body >
        
        <div class="conteiner" >
           <main>
                {{ $slot }}
            
            </main>
        </div>
        
        
    </body>
</html>

           
