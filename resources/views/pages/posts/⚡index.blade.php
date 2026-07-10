<?php

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;
use App\Models\Category;
use App\Models\Post;
use Livewire\WithPagination; // 1. Import the trait
new #[Layout('layouts::app')] class extends Component
{
    use WithPagination;

    public $category = '';

    public function updatingCategory()
    {
        $this->resetPage();
    }

    #[Computed]
    public function posts()
    {
        return Post::latest()
            ->when($this->category, function ($query) {
                $query->where('category_id', $this->category);
            })
            ->paginate(10);
    }

    #[Computed]
    public function categories()
    {
        return Category::all();
    }
};
?>

<div class="w-full">
    <div class="h-20 w-auto flex items-center justify-between pl-5">
        <h1 class="text-[#79af9d] text-4xl font-bold pr-5">
            {{ $this->category ? $this->categories->firstWhere('id', $this->category)?->name : 'كل المنشورات' }}
        </h1>

        <div class="flex items-center gap-10">
            <select wire:model.live="category" class="rounded-md">
                <option value="">كل المنشورات</option>
                @foreach ($this->categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div>
        @php $postsCollection = $this->posts; @endphp

        @forelse ($postsCollection as $post)
            <x-post-item :post="$post"></x-post-item>
        @empty
            <div class="text-center text-gray-400 py-16">لم يتم العثور على أي منشورات</div>
        @endforelse

        <div class="mt-4 px-5">
            {{ $postsCollection->links(data: ['scrollTo' => false]) }}
        </div>
    </div>
</div>