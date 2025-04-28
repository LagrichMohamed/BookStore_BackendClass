<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Digital Library - My Book</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Source+Sans+Pro:wght@400;600&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-gray-50">
    <div class="relative overflow-hidden min-h-screen bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900">
        <div class="absolute inset-0 bg-[url('/img/pattern.svg')] opacity-10"></div>

        <div class="max-w-7xl mx-auto">
            <div class="relative z-10 pb-8 sm:pb-16 md:pb-20 lg:w-full">
                <div class="relative pt-6 px-4 sm:px-6 lg:px-8">
                    <nav class="relative flex items-center justify-between sm:h-10">
                        <div class="flex items-center flex-grow flex-shrink-0 lg:flex-grow-0">
                            <div class="flex items-center justify-between w-full md:w-auto">
                                <a href="/" class="flex items-center text-3xl font-serif font-bold text-white">
                                    <img src="{{ asset('Logo_Lib.svg') }}" alt="Digital Library Logo" class="w-10 h-10 mr-3">
                                    Digital <span class="text-indigo-400">Library</span>
                                </a>
                            </div>
                        </div>
                        <div class="flex items-center gap-4">
                            @auth
                                <a href="{{ route('dashboard') }}" class="text-white hover:text-gray-200">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}" class="text-white hover:text-gray-200">Login</a>
                                <a href="{{ route('register') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                                    Register
                                </a>
                            @endauth
                        </div>
                    </nav>
                </div>

                <!-- Hero Content -->
                <div class="relative">
                    <div class="pt-16 pb-12 sm:pt-24 sm:pb-20">
                        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 sm:static">
                            <div class="sm:max-w-lg">
                                <h1 class="font-serif text-4xl font-bold tracking-tight text-white sm:text-6xl">
                                    Your Gateway to Literary Excellence
                                </h1>
                                <p class="mt-4 text-xl text-gray-300">
                                    Explore our vast collection of books, from timeless classics to contemporary masterpieces.
                                    Join our community of readers and embark on your literary journey.
                                </p>
                                <div class="mt-5 sm:mt-8 sm:flex sm:justify-center lg:justify-start">
                                    <div class="rounded-md shadow">
                                        <a href="{{ route('register') }}" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 md:py-4 md:text-lg md:px-10">
                                            Get Started
                                        </a>
                                    </div>
                                    <div class="mt-3 sm:mt-0 sm:ml-3">
                                        <a href="{{ route('login') }}" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-indigo-600 bg-white hover:bg-gray-50 md:py-4 md:text-lg md:px-10">
                                            Sign In
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
