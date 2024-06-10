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
    <style>
        .video-container {
            width: 100%;
            max-width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        video {
            width: 100%;
            max-width: 100%;
        }
    </style>
</head>

<body class="bg-white">
    <!-- Navbar -->
    <nav class="bg-[#2254C5] border-gray-200">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="{{ url('/') }}" class="flex items-center space-x-3 rtl:space-x-reverse">
                <img src="{{ asset('storage/logo.png')}}" class="h-10" alt="logo tanyaustadz" />
                <span
                    class="self-center text-2xl italic font-semibold whitespace-nowrap dark:text-white">TANYAUSTADZ</span>
            </a>
            <button data-collapse-toggle="navbar-default" type="button"
                class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                aria-controls="navbar-default" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M1 1h15M1 7h15M1 13h15" />
                </svg>
            </button>
            <div class="hidden w-full md:block md:w-auto" id="navbar-default">
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
            </div>
        </div>
    </nav>

    <!-- Main content -->
    <div class="flex items-center justify-center">
        <div class="w-full max-w-screen-lg rounded-lg shadow-2xl drop-shadow-2xl pb-4 sm:pb-6 md:pb-8 bg-white my-8">
            <form id="jawabanForm" action="{{ route('kirim.jawaban') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="w-full bg-[#2254C5] p-4 rounded-t-lg mb-5">
                    <h5 class="text-xl font-medium text-white text-center">Rekam Jawaban</h5>
                </div>
                <div class="mx-4 sm:mx-6 md:mx-8 mb-5">
                    <label for="nama" class="block mb-2 text-sm font-medium text-gray-900">Pertanyaan</label>
                    <p>{{ $post->pertanyaan }}</p>
                </div>
                <div class="mx-4 sm:mx-6 md:mx-8 mb-5">
                    <label for="pertanyaan" class="block mb-2 text-sm font-medium text-gray-900">Rekam Jawaban</label>
                    <div class="video-container">
                        <video id="preview" autoplay muted></video>
                        <button type="button" id="startRecord"
                            class="px-3 py-2 text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 my-2">Mulai
                            Rekam</button>
                        <button type="button" id="stopRecord"
                            class="px-3 py-2 text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 my-2"
                            disabled>Berhenti Rekam</button>
                        <video id="recorded" controls class="hidden mt-4"></video>
                    </div>
                </div>
                <div class="mx-4 sm:mx-6 md:mx-8">
                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                    <input type="hidden" name="video" id="videoData">
                    <button type="submit"
                        class="w-full text-white bg-[#2254C5] hover:bg-blue-900 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-lg px-5 py-2.5 text-center">Kirim
                        jawaban</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <footer class="rounded-lg shadow flex bottom-0 left-0 w-full">
        <div class="w-full max-w-screen-xl mx-auto md:py-8 border-t-4 border-[#2254C5]">
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
        let mediaRecorder;
        let recordedBlobs;

        const preview = document.getElementById('preview');
        const startRecordButton = document.getElementById('startRecord');
        const stopRecordButton = document.getElementById('stopRecord');
        const recordedVideo = document.getElementById('recorded');
        const videoData = document.getElementById('videoData');

        navigator.mediaDevices.getUserMedia({ video: true, audio: true })
            .then(stream => {
                preview.srcObject = stream;
                window.stream = stream;

                startRecordButton.addEventListener('click', startRecording);
                stopRecordButton.addEventListener('click', stopRecording);
            })
            .catch(error => {
                console.error('Error accessing media devices.', error);
            });

        function startRecording() {
            recordedBlobs = [];
            const options = { mimeType: 'video/webm;codecs=vp9,opus' };
            try {
                mediaRecorder = new MediaRecorder(window.stream, options);
            } catch (e) {
                console.error('Exception while creating MediaRecorder:', e);
                return;
            }

            startRecordButton.disabled = true;
            stopRecordButton.disabled = false;

            mediaRecorder.onstop = (event) => {
                const superBuffer = new Blob(recordedBlobs, { type: 'video/webm' });
                recordedVideo.src = window.URL.createObjectURL(superBuffer);
                recordedVideo.classList.remove('hidden');

                const reader = new FileReader();
                reader.readAsDataURL(superBuffer);
                reader.onloadend = () => {
                    videoData.value = reader.result;
                };
            };

            mediaRecorder.ondataavailable = handleDataAvailable;
            mediaRecorder.start();
        }

        function stopRecording() {
            mediaRecorder.stop();
            startRecordButton.disabled = false;
            stopRecordButton.disabled = true;
        }

        function handleDataAvailable(event) {
            if (event.data && event.data.size > 0) {
                recordedBlobs.push(event.data);
            }
        }
    </script>
</body>

</html>