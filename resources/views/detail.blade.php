<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile GWEJ</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-white"> <!-- Tailwind CSS class for light and dark mode background -->
    <!-- Navbar -->
    <nav class="bg-[#2254C5] border-gray-200">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="{{ url('/') }}" class="flex items-center space-x-3 rtl:space-x-reverse">
                <img src="https://media.tenor.com/NwpHYmzgh0gAAAAi/yelan-genshin-impact.gif" class="h-8"
                    alt="logo tanyaustadz" />
                <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">TanyaUstadz</span>
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
    <div class="flex items-center justify-center">
        <div class="w-full max-w-screen-lg rounded-lg shadow-2xl drop-shadow-2xl pb-4 sm:pb-6 md:pb-8 bg-white my-8">
            <div class="space-y-2">
                <div class="w-full bg-[#2254C5] p-4 px-4 sm:px-6 md:px-8 rounded-t-lg">
                    <h5 class="text-xl font-medium text-white">Pertanyaan</h5>
                </div>
                <div class="mx-4 sm:mx-6 md:mx-8">
                    <p class="block text-sm font-normal text-gray-600">Oleh: {{ $post->nama }}
                    </p>
                </div>
                <div class="mx-4 sm:mx-6 md:mx-8 pt-4">
                    <p class="block mb-2 text-md font-normal text-gray-900">{{ $post->pertanyaan }}
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="flex items-center justify-center">
        <div class="w-full max-w-screen-lg rounded-lg shadow-2xl drop-shadow-2xl pb-4 sm:pb-6 md:pb-8 bg-white mb-8">
            <div class="space-y-2">
                <div class="w-full bg-[#2254C5] p-4 px-4 sm:px-6 md:px-8 rounded-t-lg">
                    <h5 class="text-xl font-medium text-white">Jawab</h5>
                </div>
                <div class="mx-4 sm:mx-6 md:mx-8">
                    <p class="block text-sm font-normal text-gray-600">Oleh: penanya
                    </p>
                </div>
                @if ($post->jawaban == null)
                    <div class="mx-4 sm:mx-6 md:mx-8 pt-4">
                        <p class="block mb-2 text-md font-normal text-gray-900">belum ada jawaban
                        </p>
                    </div>
                @else
                    <div class="mx-4 sm:mx-6 md:mx-8 mb-5 flex justify-center">
                        <video width="320" height="240" controls>
                            <source src="{{ Storage::url($post->jawaban) }}" type="video/webm">
                            Your browser does not support the video tag.
                        </video>
                    </div>
                @endif
                @if (Auth::user() != null && $post->jawaban == null)
                    <div class="mx-4 sm:mx-6 md:mx-8 pt-4 align-center">
                        <a href="{{ route('content.jawab', $post->id) }}"
                            class="focus:outline-none text-white bg-green-800 hover:bg-green-500 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5">
                            jawab pertanyaan
                        </a>
                    </div>
                @endif

            </div>
        </div>
    </div>


    <!-- Footer -->
    <footer class="rounded-lg shadow flex bottom-0 left-0 w-full">
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