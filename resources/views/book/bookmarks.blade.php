<x-app-layout>
    <!-- Page Content -->
    <main class="flex flex-col px-6">

        <div class="flex items-center px-6 py-2 gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-bookmark"
                viewBox="0 0 16 16">
                <path
                    d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1z" />
            </svg>
            <p class="text-2xl">إشاراتي المرجعية : </p>
        </div>

        <form class="px-6 py-4">
            <label for="search" class="block mb-2.5 text-sm font-medium text-heading sr-only ">بحث</label>
            <div class="relative">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-body" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                            d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
                <input type="search" id="search"
                    class="block w-full p-3 ps-9 bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-md focus:ring-brand focus:border-brand shadow-xs placeholder:text-body"
                    placeholder="بحث" required />
            </div>
        </form>


        @forelse ($posts as $post)
            <x-post-item :post="$post"></x-post-item>
        @empty
            <div class="text-center text-gray-400">No Posts Found</div>
        @endforelse
    </main>
</x-app-layout>