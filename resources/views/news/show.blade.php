<x-app-layout>
    <div class="py-4">

        <div class="max-w-auto mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">
                <h1 class="text-2xl mb-4">{{ $new->title }}</h1>
                {{-- <x-user-card :new="$new" /> --}}
                <!-- Content Section -->
                <div class="mt-8">
                    @if ($new->image)
                        <img src="{{ Storage::url($new->image) }}" alt="{{ $new->title }}" class="w-full">
                    @else

                    @endif

                    <div class="mt-4">
                        {!! nl2br(e($new->content)) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>