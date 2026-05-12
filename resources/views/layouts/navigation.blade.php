<nav x-data="{ sidebarOpen: false }"
    class="bg-[#79af9d] dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
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

                    
                  
                     <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-search"
                        viewBox="0 0 16 16">
                        <path
                            d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                    </svg>
                    <a href="{{ route('posts.create') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                            class="bi bi-feather color-white" viewBox="0 0 16 16">
                            <path
                                d="M15.807.531c-.174-.177-.41-.289-.64-.363a3.8 3.8 0 0 0-.833-.15c-.62-.049-1.394 0-2.252.175C10.365.545 8.264 1.415 6.315 3.1S3.147 6.824 2.557 8.523c-.294.847-.44 1.634-.429 2.268.005.316.05.62.154.88q.025.061.056.122A68 68 0 0 0 .08 15.198a.53.53 0 0 0 .157.72.504.504 0 0 0 .705-.16 68 68 0 0 1 2.158-3.26c.285.141.616.195.958.182.513-.02 1.098-.188 1.723-.49 1.25-.605 2.744-1.787 4.303-3.642l1.518-1.55a.53.53 0 0 0 0-.739l-.729-.744 1.311.209a.5.5 0 0 0 .443-.15l.663-.684c.663-.68 1.292-1.325 1.763-1.892.314-.378.585-.752.754-1.107.163-.345.278-.773.112-1.188a.5.5 0 0 0-.112-.172M3.733 11.62C5.385 9.374 7.24 7.215 9.309 5.394l1.21 1.234-1.171 1.196-.027.03c-1.5 1.789-2.891 2.867-3.977 3.393-.544.263-.99.378-1.324.39a1.3 1.3 0 0 1-.287-.018Zm6.769-7.22c1.31-1.028 2.7-1.914 4.172-2.6a7 7 0 0 1-.4.523c-.442.533-1.028 1.134-1.681 1.804l-.51.524zm3.346-3.357C9.594 3.147 6.045 6.8 3.149 10.678c.007-.464.121-1.086.37-1.806.533-1.535 1.65-3.415 3.455-4.976 1.807-1.561 3.746-2.36 5.31-2.68a8 8 0 0 1 1.564-.173" />
                        </svg>
                    </a>
                   
                    
                      <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none"
                        stroke="#000000" stroke-width="1" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M15.5 13a3.5 3.5 0 0 0 -3.5 3.5v1a3.5 3.5 0 0 0 7 0v-1.8" />
                        <path d="M8.5 13a3.5 3.5 0 0 1 3.5 3.5v1a3.5 3.5 0 0 1 -7 0v-1.8" />
                        <path d="M17.5 16a3.5 3.5 0 0 0 0 -7h-.5" />
                        <path d="M19 9.3v-2.8a3.5 3.5 0 0 0 -7 0" />
                        <path d="M6.5 16a3.5 3.5 0 0 1 0 -7h.5" />
                        <path d="M5 9.3v-2.8a3.5 3.5 0 0 1 7 0v10" />
                    </svg>
                    <div x-data="{ ring : true }" class="flex items-center gap-2">
                        <span @click="ring = !ring"
                            class="flex items-center hover:scale-110 transition-transform cursor-pointer">
                            <svg style="hidden" x-show="ring" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                fill="currentColor" class="bi bi-bell" viewBox="0 0 16 16">
                                <path
                                    d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2M8 1.918l-.797.161A4 4 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4 4 0 0 0-3.203-3.92zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5 5 0 0 1 13 6c0 .88.32 4.2 1.22 6" />
                            </svg>
                            <svg style="hidden" x-show="!ring" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                fill="currentColor" class="bi bi-bell-fill" viewBox="0 0 16 16">
                                <path
                                    d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2m.995-14.901a1 1 0 1 0-1.99 0A5 5 0 0 0 3 6c0 1.098-.5 6-2 7h14c-1.5-1-2-5.902-2-7 0-2.42-1.72-4.44-4.005-4.901" />
                            </svg>
                        </span>
                    </div>
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

    <!-- Responsive Navigation Menu -->

    <template x-teleport="body">
        <div>
            <div x-show="sidebarOpen" x-transition.opacity @click="sidebarOpen = false"
                class="fixed inset-0 bg-black/50 backdrop-blur-sm z-40"></div>

            <div x-show="sidebarOpen" x-transition:enter="transition transform duration-300"
                x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
                x-transition:leave="transition transform duration-300" x-transition:leave-start="translate-x-0"
                x-transition:leave-end="translate-x-full"
                class="fixed inset-y-0 right-0 w-60 bg-[#79af9d] text-white z-50 p-6 shadow-2xl">

                <div class="flex flex-col h-full">
                    <div class="mb-8">
                        @auth
                            <div>
                                <img class="h-20"
                                    src="{{ auth()->user()->avatar ? Storage::url(auth()->user()->avatar) : asset("images/profile.png")}}" />
                            </div>

                        @endauth
                        <div>
                            <h2 class="text-xl font-bold">{{ Auth::user()->name ?? 'User' }}</h2>
                            <p class="text-xs text-black-400 font-mono">{{ Auth::user()->email ?? '' }}</p>
                        </div>
                    </div>
                    @auth

                        <nav class="space-y-4 font-mono  ">
                            <a href="/{{auth()->user()->id}}/bookmarks"
                                class="block text-lg hover:border rounded-md px-2">My Bookmarks </a>
                            <a href={{ url('@' . auth()->user()->username) }}
                                class="block text-lg hover:border rounded-md  px-2">My Profile </a>
                            <a href="#" class="block text-lg hover:border rounded-md  px-2">Settings </a>
                        </nav>
                    @endauth

                    <div class="mt-auto pt-6 border-t border-white-800">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class=" font-mono text-sm hover:text-xl">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </template>

</nav>