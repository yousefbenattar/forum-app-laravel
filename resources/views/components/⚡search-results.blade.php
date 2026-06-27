<?php // resources/views/components/⚡search-results.blade.php

use Livewire\Attributes\Reactive;
use App\Models\Bookmark;
use Livewire\Component;
use Livewire\Attributes\On; // 1. Make sure to import the On attribute!

new class extends Component {
    //#[Reactive]
    public $post;

    public function unbookmark()
    {
        Bookmark::where(['user_id' => auth()->id(),'post_id' => $this->post->id])->delete();
       // 1. Dispatch an event to tell the parent to refresh
        $this->dispatch('bookmark-updated');
    }

};
?>

{{-- <div wire:key="{{ $post->id }}">{{ $post->title }}</div> --}}
<div wire:key="{{ $post->id }}"
    class="flex items-center justify-between group m-5  bg-white border border-gray-200 rounded-md shadow-sm overflow-hidden group-hover:border-[#79af9d]">

    <a href="/posts/{{ $post->id }}" class="flex items-center justify-between" dir="rtl">

        <!-- 1. Image: Now appears on the right in RTL -->
        @if ($post->image)
            <img class="w-32 h-32 object-cover" src="{{ Storage::url($post->image) }}" alt="{{ $post->title }}">

        @else
        @endif
        <!-- 2. Content: Pushes to the left -->
        <div class="flex-1 pt-6 px-4 text-right">
            <h5 class="mb-2 text-2xl font-bold text-gray-900 group-hover:text-[#79af9d]">
                {{ $post->title }}
            </h5>
            <p class="text-gray-600 mb-4">
                {{ Str::limit($post->content, 20) }}
            </p>
        </div>
    </a>

    <form  wire:submit="unbookmark" class="flex flex-row items-center gap-2 mx-6">
        <button type="submit">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                class="bi bi-bookmark-fill" viewBox="0 0 16 16">
                <path
                    d="M2 2v13.5a.5.5 0 0 0 .74.439L8 13.069l5.26 2.87A.5.5 0 0 0 14 15.5V2a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2" />
            </svg>
        </button>

    </form>

</div>