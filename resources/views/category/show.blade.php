<x-app-layout>
            <div>
            @forelse ($posts as $post)
            <x-post-item :post="$post"></x-post-item>
            @empty
            <div class="text-center text-gray-400 py-16">No Posts Found</div>
            @endforelse
        </div>
</x-app-layout>