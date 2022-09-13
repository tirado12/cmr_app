<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" type="image/png"  href="{{ asset('image/Icono CMR White.png') }}">
        <title>@yield('title')</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="https://kit.fontawesome.com/8b291b3295.js" crossorigin="anonymous"></script>
        
    </head>
    
    <body class="bg-white">
        <div class="flex h-screen bg-gray-200" x-data="{ sidebar: false }">
            <div x-show="sidebar"  @click.away="sidebar = false" class="fixed z-40 inset-y-0 left-0 w-60 transition duration-300 transform bg-gray-900 overflow-y-auto lg:translate-x-0 lg:static lg:inset-0">
                @include('componentes.sidebar')
            </div>
            <div class="flex-1 flex flex-col overflow-hidden">
                <header class="justify-between bg-white  border-indigo-600">
                    
                    @include('componentes.navbar')
                    
                </header>
                {{-- main --}}
                <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 ">
                    <div class="container max-w-7xl mx-auto px-2 sm:px-6 lg:px-8 py-8">
                        {{-- contenido --}}
                        @yield('contenido')
                        
                    </div>
                </main>
            </div>
        </div>        
       
    </body>
</html>