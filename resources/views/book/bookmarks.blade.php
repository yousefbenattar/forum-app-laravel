<x-better>
     <!-- Page Content -->
        <main class=" ">
            <div class="flex flex-col">
                 
                    @forelse ($posts as $post)
                        <x-post-item :post="$post"></x-post-item>
                    @empty
                        <div class="text-center text-gray-400 py-16">No Posts Found</div>
                    @endforelse
                
                
            </div>

        </main>
</x-better>