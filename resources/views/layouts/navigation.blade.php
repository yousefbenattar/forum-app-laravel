<nav x-data="{
sidebarOpen: false ,
searchOpen :false ,
chatAiOpen :false ,
ring : true ,
}" class="bg-[#79af9d] dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class=" mx-auto px-4 sm:px-6 lg:px-8 bg-[#79af9d]">
        <div class="flex justify-between h-16">

            <div class="flex">

                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="/">
                        <img class="block h-10 w-auto fill-current text-gray-800 dark:text-gray-200"
                            src="{{ asset('images/banner.png')}}" />
                    </a>
                </div>



            </div>
            @auth
                <div class="hidden  flex sm:flex sm:items-center sm:ms-6 gap-4">



                    <button @click="searchOpen = true" type="button"
                        class="border rounded-lg px-2 py-1  font-bold  flex text-white items-center gap-2">

                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                            class="bi bi-search" viewBox="0 0 16 16">
                            <path
                                d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                        </svg>
                        <p> إبحث</p>

                    </button>
                    <a href="{{ route('posts.create') }}">
                        <div class="border rounded-lg px-2 py-1  font-bold  flex text-white items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                class="bi bi-feather color-white" viewBox="0 0 16 16">
                                <path
                                    d="M15.807.531c-.174-.177-.41-.289-.64-.363a3.8 3.8 0 0 0-.833-.15c-.62-.049-1.394 0-2.252.175C10.365.545 8.264 1.415 6.315 3.1S3.147 6.824 2.557 8.523c-.294.847-.44 1.634-.429 2.268.005.316.05.62.154.88q.025.061.056.122A68 68 0 0 0 .08 15.198a.53.53 0 0 0 .157.72.504.504 0 0 0 .705-.16 68 68 0 0 1 2.158-3.26c.285.141.616.195.958.182.513-.02 1.098-.188 1.723-.49 1.25-.605 2.744-1.787 4.303-3.642l1.518-1.55a.53.53 0 0 0 0-.739l-.729-.744 1.311.209a.5.5 0 0 0 .443-.15l.663-.684c.663-.68 1.292-1.325 1.763-1.892.314-.378.585-.752.754-1.107.163-.345.278-.773.112-1.188a.5.5 0 0 0-.112-.172M3.733 11.62C5.385 9.374 7.24 7.215 9.309 5.394l1.21 1.234-1.171 1.196-.027.03c-1.5 1.789-2.891 2.867-3.977 3.393-.544.263-.99.378-1.324.39a1.3 1.3 0 0 1-.287-.018Zm6.769-7.22c1.31-1.028 2.7-1.914 4.172-2.6a7 7 0 0 1-.4.523c-.442.533-1.028 1.134-1.681 1.804l-.51.524zm3.346-3.357C9.594 3.147 6.045 6.8 3.149 10.678c.007-.464.121-1.086.37-1.806.533-1.535 1.65-3.415 3.455-4.976 1.807-1.561 3.746-2.36 5.31-2.68a8 8 0 0 1 1.564-.173" />
                            </svg>
                            <p> أنشر</p>
                        </div>
                    </a>



                    <button @click="chatAiOpen = true"
                        class="border rounded-lg px-2 py-1 font-bold  flex text-white items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-anthropic" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M9.218 2h2.402L16 12.987h-2.402zM4.379 2h2.512l4.38 10.987H8.82l-.895-2.308h-4.58l-.896 2.307H0L4.38 2.001zm2.755 6.64L5.635 4.777 4.137 8.64z" />
                        </svg>
                        <p>ذكاء صناعي</p>
                    </button>


                    <img @click="sidebarOpen = !sidebarOpen" class="h-10 w-10 rounded-full cursor-pointer"
                        src="{{ auth()->user()->avatar ? Storage::url(auth()->user()->avatar) : asset('images/profile.png')}}"
                        alt="Profile Picture">
                </div>
            @endauth
            @guest
                <div class="flex items-center space-x-4">
                    <a href="/register" class="text-white">الإنضمام</a>
                    <a href="/login" class="text-white">تسجيل الدخول</a>

                </div>
            @endguest

        </div>
    </div>


            @include('layouts._sidebarOpen')
            @include('layouts._searchOpen')
            @include('layouts._chatAiOpen')

    

    <!-- ========================================== -->
    <!-- 2. GEMINI AI CHATBOT SIDEBAR (Slides from RIGHT) -->
    <!-- ========================================== -->
   


</nav>