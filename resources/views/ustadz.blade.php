<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DashBoard ustadz</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-white"> <!-- Tailwind CSS class for light and dark mode background -->
    <!-- Navbar -->
    <nav class="bg-[#2254C5] border-gray-200">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto px-4 py-2">
            <a href="{{ url('/') }}" class="flex items-center space-x-3 rtl:space-x-reverse">
                <img src="{{ asset('assets/logo.png')}}" class="h-10" alt="logo tanyaustadz" />
                <span
                    class="self-center text-2xl italic font-semibold whitespace-nowrap dark:text-white">TANYAUSTADZ</span>
            </a>
            <div class="hidden w-full md:block md:w-auto" id="navbar-default">
                <div class="relative inline-block text-left">
                    <div>
                        <button type="button" id="profileButton"
                            class="flex flex-col items-center text-white focus:outline-none">
                            <div class="flex items-center justify-center w-10 h-10 bg-white rounded-full">
                                <svg class="w-8 h-8 text-[#2254C5]" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
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
                </div>
            </div>
        </div>
    </nav>

    <!-- Main content -->
    <div class="flex items-start justify-center p-4 pt-12">
        <!-- form edit ustadz -->
        <div class="w-full max-w-xs mr-4">
            <div class="bg-white shadow-2xl drop-shadow-2xl rounded-lg p-6">
                <h2 class="text-2xl font-semibold text-gray-900 mb-4">edit Profil</h2>
                <form action="{{ route('ustadz.update') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 font-bold mb-2">Nama Ustadz:</label>
                        <input type="text" id="name" name="name"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            placeholder="Masukkan nama" value="{{ old('name', $user->name) }}">
                    </div>
                    <div class="mb-4">
                        <label for="password" class="block text-gray-700 font-bold mb-2">Password Baru:</label>
                        <input type="password" id="password" name="password"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            placeholder="Masukkan password baru">
                    </div>
                    <div class="mb-4">
                        <label for="password_confirmation" class="block text-gray-700 font-bold mb-2">Konfirmasi
                            Password:</label>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            placeholder="Konfirmasi password baru">
                    </div>
                    <div class="flex items-center justify-between">
                        <button type="submit"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Ubah Profil
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <!-- list pertanyaan belum dijawab -->
        <div class="w-full max-w-screen-md rounded-lg">
            @foreach ($show as $items)
                <a href="{{ route('content.show', $items->id) }}">
                    <div class="flex flex-col items-start bg-white border border-black rounded-lg p-5 mb-5">
                        <h5
                            class="mb-5 text-xl font-bold text-[#2254C5] overflow-hidden text-ellipsis whitespace-nowrap w-5/6">
                            {{ $items->pertanyaan }}
                        </h5>
                        <p class="mb-3 font-normal text-gray-900 dark:text-gray-400">oleh: {{ $items->nama}}</p>
                        <div
                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300">
                            belum dijawab
                        </div>
                    </div>
                </a>
            @endforeach
            <div class="flex justify-center mt-5">
                {{ $show->links() }}
            </div>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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