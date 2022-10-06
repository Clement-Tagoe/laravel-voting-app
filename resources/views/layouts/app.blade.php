<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Voting App</title>

        @livewireStyles

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="text-gray-900 bg-gray-100 text-sm">
        <header class="flex flex-col md:flex-row items-center justify-between px-8 py-4">
            <a href="/"><img src="{{asset('images/logo.svg')}}" alt=""></a>
            <div class="flex items-center mt-2 md:mt-0">
                @if (Route::has('login'))
                <div class="px-6 py-4">
                    @auth
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
    
                        <a href="{{ route('logout') }}"
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
                    <img src="{{asset('images/avatar.jpg')}}" alt="avatar" class="w-10 h-10 rounded-full">
                </a>
            </div>
        </header>

        <main class="custom-container mx-auto flex flex-col md:flex-row">
            <div class="w-70 mx-auto md:mx-1 md:mr-10">
               <div class="bg-white md:sticky md:top-8 border-2 border-blue-600 rounded-xl mt-16" style="
                 border-image-source: linear-gradient(to bottom, rgba(50, 138, 241, 0.22), rgba(99, 123, 255, 0));
                 border-image-slice: 1;
                 background-image: linear-gradient(to bottom, #ffffff, #ffffff), linear-gradient(to bottom, rgba(50, 138, 241, 0.22), rgba(99, 123, 255, 0));
                 background-origin: border-box;
                 background-clip: content-box, border-box;">
                 <div class="text-center px-6 py-2 pt-6">
                    <h3 class="font-semibold text-base">Add an Idea</h3>
                    <p class="text-xs mt-4">
                        @auth
                        Let us know what you would like and we'll take a look over!
                        @else
                        Please login to create an idea.
                        @endauth
                    </p>
                 </div>

                 @auth
                    <livewire:create-idea />
                 @else
                    <div class="my-6 text-center">
                        <a href="{{route('login')}}" class="inline-block justify-center w-1/2 h-11 text-xs font-semibold rounded-xl border border-blue-600 bg-blue-600 text-white hover:bg-blue-500 transition duration-150 ease-in px-6 py-3">
                            Login
                        </a>
                        <a href="{{route('register')}}"class="inline-block justify-center w-1/2 h-11 text-xs bg-gray-200 font-semibold rounded-xl border border-gray-200 hover:border-gray-400 transition duration-150 ease-in px-6 py-3 mt-3">
                            Sign Up
                        </a>
                    </div>
                 @endauth
               </div> 
            </div>
            <div class="w-full md:w-175">
                 
                <livewire:status-filters />
                
                <div class="mt-8">
                {{$slot}}
                </div>
            </div>
        </main>
        @livewireScripts
    </body>
</html>
