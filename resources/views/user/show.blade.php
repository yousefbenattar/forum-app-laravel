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
     
        
    </head>
   <body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-[#79af9d] dark:bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main class=" ">
            <div class="flex ">
                <div class="w-1/5 pr-10">
                    <x-profile_section :user="$user"></x-profile_section>
                </div>

                <div class="w-4/5">
                    <div class="flex items-center gap-4 mb-6">
                        <h1 class="text-2xl font-bold py-2">منشوراتي</h1>
                        
                    </div>
                    @forelse ($posts as $post)
                        <x-post-item :post="$post"></x-post-item>
                    @empty
                        <div class="text-center text-gray-400 py-16">No Posts Found</div>
                    @endforelse
                </div>
            </div>

        </main>
    </div>
  
</body>
<footer>
    <div class="bg-[#79af9d]  text-center text-white mt-2 py-4">
    
    جميع الحقوق محفوظة لمنتدى التاريخ البديل
        &copy; {{ date('Y') }}


    </div>
</footer>
   
</html>

 