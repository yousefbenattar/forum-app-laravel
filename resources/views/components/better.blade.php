<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? config('app.name') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="font-sans antialiased bg-white">
    <div class="min-h-screen ">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-[#79af9d] shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset
        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>
    @livewireScripts
</body>
<footer>
    <div class="bg-[#79af9d]  text-center text-white mt-2 py-4">

        جميع الحقوق محفوظة لمنتدى التاريخ البديل
        &copy; {{ date('Y') }}


    </div>
</footer>

</html>