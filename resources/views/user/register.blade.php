<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <link rel="icon" href="{{ asset('assets/logo-udinus.png') }}" type="image/x-icon">
    <script type="module" src="{{ asset('build/assets/app-C1-XIpUa.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('build/assets/app-7faw23md.css') }}">

</head>

<body>
    <!-- component -->
    <section class="flex flex-col md:flex-row h-screen items-center">
        <div class="bg-indigo-600 hidden lg:block w-full md:w-1/2 xl:w-2/3 h-screen">
            <img src="{{ asset('assets/udinus.jpg') }}" alt="" class="w-full h-full object-cover">
        </div>
        <div
            class="bg-white w-full md:max-w-md lg:max-w-full md:mx-auto md:mx-0 md:w-1/2 xl:w-1/3 h-screen px-6 lg:px-16 xl:px-12
            flex items-center justify-center">
            <div class="w-full h-100">
                <h1 class="text-xl md:text-2xl font-bold leading-tight mt-12">Register your account</h1>
                @if (session('error'))
                    <div class="bg-red-500 p-4 rounded-lg mb-6 mt-3 text-white text-center">
                        {{ session('error') }}
                    </div>
                @endif
                <form id="registerForm" class="mt-6" action="#" method="POST"
                    action="{{ route('user.register') }}">
                    @csrf
                    <div>
                        <label id="email" class="block text-gray-700">Email Address</label>
                        <input type="email" name="email" id="" placeholder="Enter Email Address"
                            class="w-full px-4 py-3 rounded-lg bg-gray-200 mt-2 border focus:border-blue-500 focus:bg-white focus:outline-none"
                            autofocus autocomplete required>
                        @error('email')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mt-4">
                        <label id="password" class="block text-gray-700">Password</label>
                        <input type="password" name="password" id="" placeholder="Enter Password"
                            minlength="6"
                            class="w-full px-4 py-3 rounded-lg bg-gray-200 mt-2 border focus:border-blue-500
                        focus:bg-white focus:outline-none"
                            required>
                        @error('password')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mt-4">
                        <label class="block text-gray-700">Confirm Password</label>
                        <input type="password" name="password_confirmation" id="" placeholder="Enter Password"
                            minlength="6"
                            class="w-full px-4 py-3 rounded-lg bg-gray-200 mt-2 border focus:border-blue-500
                        focus:bg-white focus:outline-none"
                            required>
                        @error('password_confirmation')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="text-right mt-2">
                        <a href="#"
                            class="text-sm font-semibold text-gray-700 hover:text-yellow-700 focus:text-yellow-700">Forgot
                            Password?</a>
                    </div>
                    <button id="buttonSubmit" type="submit"
                        class="w-full flex items-center justify-center bg-yellow-500 hover:bg-yellow-400 focus:bg-yellow-400 text-white font-semibold rounded-lg px-4 py-3 mt-6 gap-2">
                        <svg id="spinner" width="24" height="24" class="text-blue-500 hidden"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <style>
                                .spinner_5nOS {
                                    transform-origin: center;
                                    animation: spinner_sEAn .75s infinite linear
                                }

                                @keyframes spinner_sEAn {
                                    100% {
                                        transform: rotate(360deg)
                                    }
                                }
                            </style>
                            <path d="M12,1A11,11,0,1,0,23,12,11,11,0,0,0,12,1Zm0,19a8,8,0,1,1,8-8A8,8,0,0,1,12,20Z"
                                opacity=".25" />
                            <path
                                d="M10.72,19.9a8,8,0,0,1-6.5-9.79A7.77,7.77,0,0,1,10.4,4.16a8,8,0,0,1,9.49,6.52A1.54,1.54,0,0,0,21.38,12h.13a1.37,1.37,0,0,0,1.38-1.54,11,11,0,1,0-12.7,12.39A1.54,1.54,0,0,0,12,21.34h0A1.47,1.47,0,0,0,10.72,19.9Z"
                                class="spinner_5nOS" />
                        </svg>
                        <span id="buttonText">Register</span>
                    </button>

                </form>
                <hr class="my-6 border-gray-300 w-full">
                {{-- <button type="button" class="w-full block bg-white hover:bg-gray-100 focus:bg-gray-100 text-gray-900 font-semibold rounded-lg px-4 py-3 border border-gray-300">
                    <div class="flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="w-6 h-6" viewBox="0 0 48 48"><defs><path id="a" d="M44.5 20H24v8.5h11.8C34.7 33.9 30.1 37 24 37c-7.2 0-13-5.8-13-13s5.8-13 13-13c3.1 0 5.9 1.1 8.1 2.9l6.4-6.4C34.6 4.1 29.6 2 24 2 11.8 2 2 11.8 2 24s9.8 22 22 22c11 0 21-8 21-22 0-1.3-.2-2.7-.5-4z"/></defs><clipPath id="b"><use xlink:href="#a" overflow="visible"/></clipPath><path clip-path="url(#b)" fill="#FBBC05" d="M0 37V11l17 13z"/><path clip-path="url(#b)" fill="#EA4335" d="M0 11l17 13 7-6.1L48 14V0H0z"/><path clip-path="url(#b)" fill="#34A853" d="M0 37l30-23 7.9 1L48 0v48H0z"/><path clip-path="url(#b)" fill="#4285F4" d="M48 48L17 24l-4-3 35-10z"/></svg>
                            <span class="ml-4">
                            Log in
                            with
                            Google
                            </span>
                    </div>
                </button> --}}
                <p class="mt-8">Already have an account? <a href="/login"
                        class="text-yellow-500 hover:text-yellow-700 font-semibold">Login</a></p>
            </div>
        </div>
    </section>
</body>
<script>
    document.getElementById('registerForm').addEventListener('submit', function(event) {
        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;
        const buttonSubmit = document.getElementById('buttonSubmit');
        const spinner = document.getElementById('spinner');
        const buttonText = document.getElementById('buttonText');

        if (email === '' || password === '') {
            alert('Email dan Password tidak boleh kosong!');
            event.preventDefault();
            return;
        }

        buttonSubmit.disabled = true;
        buttonText.innerText = 'Loading...';
        spinner.classList.remove('hidden');
    });
</script>


</html>
