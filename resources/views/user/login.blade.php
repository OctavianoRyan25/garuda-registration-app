<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="icon" href="{{ asset('assets/logo-udinus.png') }}" type="image/x-icon">
    <script type="module" src="{{ asset('build/assets/app-C1-XIpUa.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('build/assets/app-C6H2NvHB.css') }}">

</head>
<body>
    <!-- component -->
    <section class="flex flex-col md:flex-row h-screen items-center">
        <div class="bg-indigo-600 hidden lg:block w-full md:w-1/2 xl:w-2/3 h-screen">
            <img src="{{ asset('assets/udinus.jpg') }}" alt="" class="w-full h-full object-cover">
        </div>
        <div class="bg-white w-full md:max-w-md lg:max-w-full md:mx-auto md:mx-0 md:w-1/2 xl:w-1/3 h-screen px-6 lg:px-16 xl:px-12
            flex items-center justify-center">
            <div class="w-full h-100">
                <h1 class="text-xl md:text-2xl font-bold leading-tight mt-12">Log in to your account</h1>
                {{-- if session has success --}}
                @if (session('success'))
                    <div class="mt-10 bg-green-500 p-4 rounded-lg mb-6 text-white text-center">
                        {{ session('success') }}
                    </div>
                @endif
                {{-- if session has an error --}}
                @if (session('error'))
                    <div class="mt-10 bg-red-500 p-4 rounded-lg mb-6 text-white text-center">
                        {{ session('error') }}
                    </div>
                @endif
                <form class="mt-6" action="{{ route('user.login') }}" method="POST">
                    @csrf
                    <div>
                        <label class="block text-gray-700">Email Address</label>
                        <input type="email" name="email" id="" placeholder="Enter Email Address" class="w-full px-4 py-3 rounded-lg bg-gray-200 mt-2 border focus:border-blue-500 focus:bg-white focus:outline-none" value="{{ old('email') }}" autofocus autocomplete required>
                        @error('email')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mt-4">
                        <label class="block text-gray-700">Password</label>
                        <input type="password" name="password" id="" placeholder="Enter Password" minlength="8" class="w-full px-4 py-3 rounded-lg bg-gray-200 mt-2 border focus:border-blue-500
                        focus:bg-white focus:outline-none" required>
                        @error('password')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="text-right mt-2">
                        <a href="#" class="text-sm font-semibold text-gray-700 hover:text-yellow-700 focus:text-yellow-700" id="forgot-password-link">Forgot Password?</a>
                    </div>
                    <button type="submit" class="w-full block bg-yellow-500 hover:bg-yellow-400 focus:bg-yellow-400 text-white font-semibold rounded-lg
                    px-4 py-3 mt-6">Log In</button>
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
                <p class="mt-8">Need an account? <a href="/register" class="text-yellow-500 hover:text-yellow-700 font-semibold">Create an
                    account</a></p>
                </div>
            </div>
        </section>

        {{-- Modal --}}
        <div class="fixed z-10 inset-0 overflow-y-auto hidden opacity-0 transition-opacity ease-out duration-300" id="forgot-password-modal">
            <div class="flex items-center justify-center min-h-screen px-4">
                <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                </div>
    
                <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full scale-95 ease-out duration-300" id="modal-content">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-yellow-100 sm:mx-0 sm:h-10 sm:w-10">
                                <!-- Heroicon name: exclamation -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-key" viewBox="0 0 16 16">
                                    <path d="M0 8a4 4 0 0 1 7.465-2H14a.5.5 0 0 1 .354.146l1.5 1.5a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0L13 9.207l-.646.647a.5.5 0 0 1-.708 0L11 9.207l-.646.647a.5.5 0 0 1-.708 0L9 9.207l-.646.647A.5.5 0 0 1 8 10h-.535A4 4 0 0 1 0 8m4-3a3 3 0 1 0 2.712 4.285A.5.5 0 0 1 7.163 9h.63l.853-.854a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.793-.793-1-1h-6.63a.5.5 0 0 1-.451-.285A3 3 0 0 0 4 5"/>
                                    <path d="M4 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0"/>
                                </svg>
                            </div>
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Forgot Your Password</h3>
                                <div class="mt-2">
                                    <form action="" method="POST">
                                        @csrf
                                        <input type="email" name="email" id="email" placeholder="Enter your email here" required class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md px-4 py-3">
                                        @error('email')
                                            <div class="text-red-500 mt-2">{{ $message }}</div>
                                        @enderror
                                        <div class="mt-3 sm:mt-4">
                                            <button type="submit" class="inline-flex justify-center w-full rounded-md border border-transparent shadow-sm px-4 py-2 bg-yellow-500 text-base font-medium text-white hover:bg-yellow-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-400 sm:text-sm">
                                                Send Reset Link
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm" id="close-modal">
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>
        {{-- End modal --}}
        <!-- Scripts -->
    <script>
        const forgotPasswordLink = document.getElementById('forgot-password-link');
        const forgotPasswordModal = document.getElementById('forgot-password-modal');
        const modalContent = document.getElementById('modal-content');
        const closeModal = document.getElementById('close-modal');

        forgotPasswordLink.addEventListener('click', function(e) {
            e.preventDefault();
            forgotPasswordModal.classList.remove('hidden');
            setTimeout(() => {
                forgotPasswordModal.classList.remove('opacity-0');
                modalContent.classList.remove('scale-95');
            }, 10); // slight delay for smooth transition
        });

        closeModal.addEventListener('click', function() {
            forgotPasswordModal.classList.add('opacity-0');
            modalContent.classList.add('scale-95');
            setTimeout(() => {
                forgotPasswordModal.classList.add('hidden');
            }, 300); // match the duration of the transition
        });
    </script>
</body>
</html>