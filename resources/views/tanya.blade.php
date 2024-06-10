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
                <img src="{{ asset('storage/logo.png')}}" class="h-10" alt="logo tanyaustadz" />
                <span
                    class="self-center text-2xl italic font-semibold whitespace-nowrap dark:text-white">TANYAUSTADZ</span>
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
            <form class="" action="{{ route('content.store')}}" method="post">
                @csrf <!-- {{ csrf_field() }} -->
                <div class="w-full bg-[#2254C5] p-4 rounded-t-lg mb-5">
                    <h5 class="text-xl font-medium text-white text-center">Buat Pertanyaan</h5>
                </div>
                <div class="mx-4 sm:mx-6 md:mx-8 mb-5">
                    <label for="nama" class="block mb-2 text-sm font-medium text-gray-900">Masukan Nama</label>
                    <input type="nama" name="nama" id="nama"
                        class="bg-gray-200 border text-black text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        placeholder="nama terserah anda" required />
                </div>
                <div class="mx-4 sm:mx-6 md:mx-8 mb-5">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Masukan email</label>
                    <input type="email" name="email" id="email"
                        class="bg-gray-200 border text-black text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        placeholder="name@company.com" required />
                </div>
                <div class="mx-4 sm:mx-6 md:mx-8 mb-5">
                    <label for="pertanyaan" class="block mb-2 text-sm font-medium text-gray-900">Masukan
                        Pertanyaan</label>
                    <textarea id="pertanyaan" name="pertanyaan" rows="4"
                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-200 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Tulis pertanyaanmu......"></textarea>
                </div>
                <div class="mx-4 sm:mx-6 md:mx-8">
                    <button type="submit"
                        class="w-full text-white bg-[#2254C5] hover:bg-blue-900 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-lg px-5 py-2.5 text-center">Kirim
                        Pertanyaan</button>
                </div>
            </form>
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