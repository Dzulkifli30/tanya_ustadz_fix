<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login page</title>
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
                <img src="{{ asset('assets/logo.png')}}" class="h-8"
                    alt="logo tanyaustadz" />
                <span class="self-center text-2xl font-semibold whitespace-nowrap text-white">TanyaUstadz</span>
            </a>
        </div>
    </nav>

    <!-- Main content -->
    <div class="flex items-center justify-center">
        <div class="w-full max-w-sm p-4 rounded-lg shadow-2xl drop-shadow-2xl sm:p-6 md:p-8 bg-white my-5 lg:my-20">
            <form class="space-y-6" method="post" action="{{ route('login') }}">
            @csrf
                <h5 class="text-xl font-medium text-gray-900">Login</h5>
                <div>
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Your
                        email</label>
                    <input type="email" name="email" id="email"
                        class="bg-gray-200 border text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        placeholder="name@company.com" required />
                </div>
                <div class="pb-6">
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Your
                        password</label>
                    <input type="password" name="password" id="password" placeholder="••••••••"
                        class="bg-gray-200 border text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        required />
                </div>
                <!-- <div class="flex items-start">
                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input id="remember" type="checkbox" value=""
                                class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300" />
                        </div>
                        <label for="remember" class="ms-2 text-sm font-medium text-gray-900">Remember
                            me</label>
                    </div>
                    <a href="#" class="ms-auto text-sm text-[#2254C5] hover:underline">Lost
                        Password?</a>
                </div> -->
                <button type="submit"
                    class="w-full text-white bg-[#2254C5] hover:bg-blue-900 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-lg px-5 py-2.5 text-center">Login</button>
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
        // Initialization for ES Users
        import { Dropdown, Collapse, initMDB } from "mdb-ui-kit";

        initMDB({ Dropdown, Collapse });
    </script>
</body>

</html>