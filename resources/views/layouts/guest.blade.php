<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen flex">
        <div class="w-[30%]">
            <div class="logo absolute top-[10%] left-[5%]">
                <img src="{{ asset('/build/images/ttl_logo.png') }}" alt="">
            </div>
            <div class="flex flex-col sm:justify-center min-h-screen items-center pt-6 sm:pt-0 bg-white">
                <div class="w-[70%] mx-auto">
                    <h1 class="font-bold text-[#081185] text-[40px] line-height-60">Sign In</h1>
                    <p class="text-[16px] pt-5">This is a secure site. Please enter your login information to enter or
                        you can register yourself
                    </p>
                </div>

                <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white overflow-hidden sm:rounded-lg">
                    {{ $slot }}
                </div>
            </div>
        </div>
        <div class="w-[70%]">
            <img src="{{ asset('/build/images/Vector 1.png') }}" alt="" class="object-cover h-[100vh] w-[100%]">
        </div>
    </div>
</body>

</html>