<x-better>
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
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
</x-better>