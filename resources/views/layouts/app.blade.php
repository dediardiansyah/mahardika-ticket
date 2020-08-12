<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    
    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
    @yield('style')
    <style>
        .dropdown:hover .dropdown-menu{
            display: block;
        }
    </style>
</head>
<body class="bg-gray-200 font-sans leading-normal tracking-normal mt-12">

    <!--Nav-->
    <nav class="bg-white text-gray-900 pt-2 md:pt-1 pb-1 px-1 mt-0 h-auto fixed w-full z-20 top-0">

        <div class="flex flex-wrap justify-between">
            <div class="flex flex-shrink md:w-1/3 justify-center md:justify-start text-gray-900">
                <a href="{{ url('/') }}" class="text-lg no-underline flex">
                    <img src="{{asset('images/logo.png')}}" class="h-10" alt="" srcset=""><span class="self-center ml-2">Mahardika Ticket</span>
                </a>    
            </div>

            <div class="flex w-full pt-2 content-center justify-between md:w-1/3 md:justify-end">
                <ul class="list-reset flex justify-between flex-1 md:flex-none items-center">
                    <li class="flex-1 md:flex-none md:mr-3">
                        <a class="inline-block py-2 px-4 text-gray-900 no-underline" href="#">Home</a>
                    </li>
                    <li class="flex-1 md:flex-none md:mr-3">
                        <a class="inline-block text-gray-600 no-underline hover:text-gray-200 hover:text-underline py-2 px-4" href="#">About Us</a>
                    </li>
                    <li class="flex-1 md:flex-none md:mr-3">
                        <a class="inline-block text-gray-600 no-underline hover:text-gray-200 hover:text-underline py-2 px-4" href="#">Contact</a>
                    </li>
                    <li class="flex-1 md:flex-none md:mr-3">
                        <div class="relative inline-block">
                            <button onclick="toggleDD('myDropdown')" class="drop-button text-gray-900 focus:outline-none"> <span class="pr-2"></span> Hi, @if (Auth::check()) {{ Auth::user()->name }} @else {{ 'User' }} @endif <svg class="h-3 fill-current inline" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg></button>
                            <div id="myDropdown" class=" shadow dropdownlist absolute bg-white text-gray-900 right-0 mt-4 px-3 pb-3 overflow-auto z-30 invisible w-40 ">
                                @guest()
                                    <a href="{{ route('login') }}" class="block py-1 md:py-3 pl-1 align-middle  no-underline border-b-2 border-gray-900 hover:border-blue-600"><i class="fas fa-sign-in-alt fa-fw"></i><span class="text-gray-900 ml-2">Login</span></a>
                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}" class="block py-1 md:py-3 pl-1 align-middle  no-underline border-b-2 border-gray-900 hover:border-blue-600"><i class="fas fa-user-plus"></i><span class="text-gray-900 ml-2">Registration</span></a>
                                    @endif
                                @else
                                    @if(Auth::user()->role == "user")
                                        <a href="/events/booked" class="block py-1 md:py-3 pl-1 align-middle  no-underline border-b-2 border-gray-900 hover:border-blue-600">Event Booked</a>
                                    @endif
                                    <a href="{{ route('logout') }}" class="block py-1 md:py-3 pl-1 align-middle  no-underline border-b-2 border-gray-900 hover:border-blue-600" onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt fa-fw"></i><span class="text-gray-900 ml-2">{{ __('Logout') }}</span></a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                            {{ csrf_field() }}
                                        </form>
                                @endguest
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    @yield('content')
    <script src="{{ asset('js/jquery-3.5.1.min.js') }}"></script>
    <script>
        /*Toggle dropdown list*/
        function toggleDD(myDropMenu) {
            document.getElementById(myDropMenu).classList.toggle("invisible");
        }
        /*Filter dropdown options*/
        function filterDD(myDropMenu, myDropMenuSearch) {
            var input, filter, ul, li, a, i;
            input = document.getElementById(myDropMenuSearch);
            filter = input.value.toUpperCase();
            div = document.getElementById(myDropMenu);
            a = div.getElementsByTagName("a");
            for (i = 0; i < a.length; i++) {
                if (a[i].innerHTML.toUpperCase().indexOf(filter) > -1) {
                    a[i].style.display = "";
                } else {
                    a[i].style.display = "none";
                }
            }
        }
        // Close the dropdown menu if the user clicks outside of it
        window.onclick = function(event) {
            if (!event.target.matches('.drop-button') && !event.target.matches('.drop-search')) {
                var dropdowns = document.getElementsByClassName("dropdownlist");
                for (var i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (!openDropdown.classList.contains('invisible')) {
                        openDropdown.classList.add('invisible');
                    }
                }
            }
        }
    </script>
    @yield('script')
    </body>
</html>
