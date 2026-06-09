  <template x-teleport="body">
        <div>
            <div x-show="sidebarOpen" x-transition.opacity @click="sidebarOpen = false"
                class="fixed inset-0 bg-black/50 backdrop-blur-sm z-40">
            </div>

            <div x-show="sidebarOpen"
                 
                class="fixed inset-y-0 right-0 w-60 bg-[#79af9d] text-white z-50 p-6 shadow-2xl">

                <div class="flex flex-col justify-end h-full">
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
                                class="block text-lg hover:border rounded-md px-2">إشاراتي المرجعية</a>
                            <a href={{ url('@' . auth()->user()->username) }}
                                class="block text-lg hover:border rounded-md  px-2">ملفي الشخصي </a>
                            <a href="#" class="block text-lg hover:border rounded-md  px-2">إعدادات</a>
                        </nav>
                    @endauth

                    <div class="mt-auto pt-6 border-t border-white-800">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class=" font-mono text-sm hover:text-xl">تسجيل الخروج</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </template>