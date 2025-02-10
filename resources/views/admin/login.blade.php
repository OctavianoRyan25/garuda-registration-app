<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="icon" href="{{ asset('assets/logo-udinus.png') }}" type="image/x-icon">
    {{-- <script type="module" src="{{ asset('build/assets/app-C1-XIpUa.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('build/assets/app-7faw23md.css') }}"> --}}
    @vite('resources/css/app.css')
</head>
<body>
    <section class="py-4 md:py-8 ">

        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
            <a href="/" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 ">
                <img class="w-8 h-8 mr-2" src="{{ asset('assets/logo-udinus.png') }}" alt="osher.ai logo">
                    KUI
            </a>
            <div class="w-full bg-white rounded-lg shadow md:mt-0 sm:max-w-md xl:p-0 ">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
                        Sign in to your account
                    </h1>
                    @if (session('success'))
                        <div class="bg-green-500 p-4 rounded-lg mb-6 text-white text-center">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="bg-red-500 p-4 rounded-lg mb-6 text-white text-center">
                            {{ session('error') }}
                        </div>
                    @endif
                <form class="space-y-4 md:space-y-6" method="POST" action="{{ route('admin.login') }}">
                    @csrf
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Your email</label>
                        <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-teal-600 focus:border-teal-600 block w-full p-2.5" placeholder="name@company.com" required="">
                        @error('email')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Password</label>
                        <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-teal-600 focus:border-teal-600 block w-full p-2.5" required="">
                        @error('email')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <input id="remember" aria-describedby="remember" type="checkbox" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-teal-300">
                            </div>
                            <div class="ml-3 text-sm">
                                <label for="remember" class="text-gray-500 dark:text-gray-300">Remember me</label>
                            </div>
                        </div>
                        <a href="" class="text-sm font-medium text-teal-600 hover:underline">Forgot password?</a>
                    </div>

                    <button type="submit" class="text-white bg-teal-600 py-1.5 px-4 rounded font-bold w-full">
                        Sign in
                    </button>

                    <p class="text-sm font-light text-gray-500">
                        Don’t have an account yet? <a href=""
                        class="font-medium text-teal-600 hover:underline">Sign up</a>
                    </p>
                </form>

            </div>
          </div>
        </div>
    </section>
</body>
</html>