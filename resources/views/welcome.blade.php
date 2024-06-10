<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tanya Ustadz - Dashboard</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-white"> <!-- Tailwind CSS class for light and dark mode background -->
    <!-- Navbar -->
    <nav class="bg-[#2254C5] border-gray-200">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="{{ url('/') }}" class="flex items-center space-x-3 rtl:space-x-reverse">
                <img src="{{ asset('storage/logo.png')}}" class="h-10"
                    alt="logo tanyaustadz" />
                <span class="self-center text-2xl italic font-semibold whitespace-nowrap dark:text-white">TANYAUSTADZ</span>
            </a>
            <div class="hidden w-full md:block md:w-auto" id="navbar-default">
                @if (Auth::user() != null)
                    <div>
                        <button type="button" id="profileButton"
                            class="flex flex-col items-center text-white focus:outline-none">
                            <div class="flex items-center justify-center w-10 h-10 bg-white rounded-full">
                                <svg class="w-8 h-8 text-[#2254C5]" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 14c-3.866 0-7 3.134-7 7h14c0-3.866-3.134-7-7-7zm0-4a4 4 0 100-8 4 4 0 000 8z">
                                    </path>
                                </svg>
                            </div>
                            <span class="text-sm font-bold">{{ Auth::user()->name }}</span>
                        </button>
                    </div>
                    <div id="profileMenu"
                        class="hidden origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5">
                        <div class="py-1" role="menu" aria-orientation="vertical" aria-labelledby="profileButton">
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900"
                                role="menuitem">
                                Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                @csrf
                            </form>
                        </div>
                    </div>
                @else
                    <div class="space-x-4">
                        <a href="{{ route('content.create')}}"
                            class="focus:outline-none text-white bg-green-500 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 ">
                            <i class="fa-solid fa-circle-plus mr-2 text-md"></i></i>Buat Pertanyaan
                        </a>
                        <a href="{{ url('/login')}}"
                            class="focus:outline-none text-white bg-gray-700 hover:bg-gray-400 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5">
                            Login
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </nav>

    <!-- Main content -->
    <div class="max-w-screen-xl mx-auto text-start my-5">
        <form class="max-w-full px-5" method="GET" action="{{ route('content.search') }}">
            <div class="relative">
                <input type="search" name="query" id="default-search"
                    class="block w-full p-4 ps-10 text-md text-black border border-black rounded-lg"
                    placeholder="Cari pertanyaan" required />
                <button type="submit"
                    class="text-black absolute end-2.5 bottom-2.5 focus:ring-4 focus:outline-none focus:ring-gray-500 font-medium rounded-lg text-lg py-1 pr-4 ">
                    <svg class="w-8 h-8" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-4.35-4.35M16.65 16.65A7.45 7.45 0 1110.2 3.8a7.45 7.45 0 016.45 12.85z" />
                    </svg>
                </button>
            </div>
        </form>
        <div class="grid grid-cols-2 gap-5 p-5">
            @foreach ($posts as $items)
                <a href="{{ route('content.show', $items->id) }}">
                    <div class="flex flex-col items-start bg-white border border-black rounded-lg p-5">
                        <h5
                            class="mb-5 text-xl font-bold text-[#2254C5] overflow-hidden text-ellipsis whitespace-nowrap w-5/6">
                            {{$items->pertanyaan }}
                        </h5>
                        <p class="mb-3 font-normal text-gray-900 dark:text-gray-400">oleh: {{$items->nama}}</p>
                        @if (empty($items->jawaban))
                            <div
                                class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300">
                                belum dijawab
                            </div>
                        @else
                            <div
                                class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-green-700 rounded-lg hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300">
                                sudah dijawab
                            </div>
                        @endif
                    </div>
                </a>
            @endforeach
        </div>
        <div class="flex justify-center mt-5">
            {{ $posts->links() }}
        </div>
    </div>

    <!-- Footer -->
    <footer class="rounded-lg shadow fixed bottom-0 left-0 w-full">
        <div class="w-full max-w-screen-xl mx-auto md:py-8 border-t-4 border-[#2254C5]">
            <!-- <hr class="my-6 border-t-4 border-[#2254C5] mx-0 lg:my-8" /> -->
            <span class="block text-lg font-bold sm:text-center">KELOMPOK 2 WORKSHOP WEB MULTIMEDIA</span>
        </div>
    </footer>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com/"></script>
    <script>
        document.getElementById('profileButton').addEventListener('click', function () {
            var profileMenu = document.getElementById('profileMenu');
            profileMenu.classList.toggle('hidden');
        });
    </script>
    <script>
        // Initialization for ES Users
        import { Dropdown, Collapse, initMDB } from "mdb-ui-kit";

        initMDB({ Dropdown, Collapse });
    </script>
</body>

</html>