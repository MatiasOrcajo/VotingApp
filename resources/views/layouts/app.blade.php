<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Laracasts votingApp</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans bg-gray-background antialiased text-gray-900 text-sm">
       <header class="flex items-center justify-between px-8 py-4">
            <a href="#">
                <img src="{{asset('img/logo.svg')}}">
            </a>
           <div class="flex items-center">
               @if (Route::has('login'))
                   <div class="px-6 py-4 sm:block">
                       @auth
                           <form method="POST" action="{{ route('logout') }}">
                               @csrf

                               <a href="{{route('logout')}}"
                                                onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                   {{ __('Log Out') }}
                               </a>
                           </form>
                       @else
                           <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

                           @if (Route::has('register'))
                               <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                           @endif
                       @endauth
                   </div>
               @endif
               <a href="#">
                   <img src="{{asset('img/user_icon.png')}}" class="w-10 h-10 rounded-full">
               </a>
           </div>
       </header>

        <main class="container mx-auto max-w-custom flex">
            <div class="w-70 mr-5">
                Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno en documentos electrónicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creación de las hojas "Letraset", las cuales contenian pasajes de Lorem Ipsum, y más recientemente con software de autoedición, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.
            </div>
            <div class="w-175">
                <nav class="flex items-center justify-between text-xs">
                    <ul class="flex uppercase font-semibold border-b-4 pb-3 space-x-10">
                        <li>
                            <a href="#" class="border-b-4 pb-3 border-blue">
                                All Ideas
                            </a>
                        </li>
                        <li>
                            <a href="#" class="text-gray-400 transition duration-500 ease-in border-b-4 pb-3 hover:border-blue">
                                Considering
                            </a>
                        </li>
                        <li>
                            <a href="#" class="text-gray-400 transition duration-500 ease-in border-b-4 pb-3 hover:border-blue">
                                In Progress
                            </a>
                        </li>
                    </ul>
                    <ul class="flex uppercase font-semibold border-b-4 pb-3 space-x-10">
                        <li>
                            <a href="#" class="border-b-4 pb-3 hover:border-blue">
                                Implemented
                            </a>
                        </li>
                        <li>
                            <a href="#" class="text-gray-400 transition duration-500 ease-in border-b-4 pb-3 hover:border-blue">
                                Closed
                            </a>
                        </li>
                    </ul>
                </nav>

                <div class="mt-8">
                    @include('index')
                </div>

            </div>
        </main>

    </body>
</html>
