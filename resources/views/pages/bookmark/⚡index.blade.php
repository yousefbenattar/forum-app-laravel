<?php // resources/views/pages/posts/⚡index.blade.php

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On; // 1. Make sure to import the On attribute!

new #[Layout('layouts::app')] class extends Component 
{

    public string $search = "";

    // 1. Listen for the event here to force the component to re-render from scratch
    #[On('bookmark-updated')]
    public function refreshList()
    {
        // Intentionally blank! This breaks the request cache and forces a re-render.
    }

    // 2. Change this from a property to a normal method
    public function posts()
    {
        return auth()->user()->bookmarkedPosts()
            ->where(function ($query) {
                $query->where('posts.title', 'like', "%{$this->search}%")
                    ->orWhere('posts.content', 'like', "%{$this->search}%");
            })
            ->latest('posts.created_at')
            ->get();
    }

    public function render()
    {
        return view('pages.bookmark.⚡index', [
            'posts' => $this->posts() // Call it as a method
        ]);
    }
};
?>

<div>
    <main class="flex flex-col px-6">

        <div class="flex items-center px-6 py-2 gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-bookmark"
                viewBox="0 0 16 16">
                <path
                    d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1z" />
            </svg>
            <p class="text-2xl">إشاراتي المرجعية : </p>
        </div>


        <form class="px-6 py-4" wire:submit="refreshList">
            <label for="search" class="block mb-2.5 text-sm font-medium text-heading sr-only">بحث</label>
            <div class="relative">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-body" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                            d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
                <input wire:model.live="search" type="search" id="search"
                    class="block w-full p-3 ps-9 bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-md focus:ring-brand focus:border-brand shadow-xs placeholder:text-body"
                    placeholder="بحث" required />
            </div>
        </form>


        @forelse ($this->posts() as $post)
            <livewire:pages::bookmark.search-results :post="$post" :key="$post->id" />

        @empty
            <div class="text-center text-gray-400">لم يتم العثور على أي منشورات محفوظة</div>
        @endforelse
    </main>
</div>