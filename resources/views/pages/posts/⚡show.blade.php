<?php

use Livewire\Component;
use Livewire\Attributes\Computed; // 1. Imported the Computed attribute
use App\Models\Post;
use App\Models\Like;
use App\Models\Report;
use App\Models\Comment;

new class extends Component {
    public Post $post;
    public $comment_text = '';

    // 2. Transformed into a Computed Property
    #[Computed]
    public function comments()
    {
        return Comment::where('post_id', $this->post->id)
            ->with('user')
            ->latest()
            ->get();
    }

    public function createComment()
    {
        $this->validate(['comment_text' => 'required|string']);

        Comment::create([
            'post_id' => $this->post->id,
            'user_id' => auth()->id(),
            'content' => $this->comment_text,
        ]);

        $this->comment_text = '';

        // 3. Reset the computed property cache to display the new comment instantly
        unset($this->comments);

        $this->dispatch('notification-received');
    }
};
?>

<div class="py-4">
    <div class="max-w-auto mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">
            <div class="flex items-center justify-between">
                <h1 class="text-2xl mb-4">{{ $post->title }}</h1>
                <livewire:pages::posts.report-component :post="$post" :key="'report-'.$post->id"/>
            </div>
            <livewire:pages::posts.user-card :post="$post" :key="$post->user->id" />
            <livewire:pages::posts.engagement-bar :post="$post" :key="$post->id" />
            
            <div class="mt-8">
                @if ($post->image)
                    <img src="{{ Storage::url($post->image) }}" alt="{{ $post->title }}" class="w-full">
                @endif

                <div class="mt-4">
                    {!! nl2br(e($post->content)) !!}
                </div>
            </div>

            <div class="mt-8">
                <span class="px-4 py-2 bg-gray-200 rounded-2xl">
                    {{ $post->category->name }}
                </span>
            </div>

            @auth
                <div class="mt-8">
                    @if ($this->comments->isNotEmpty())
                        <h2 class="text-xl mb-4">التعليقات</h2>
                    @endif

                    <form wire:submit.prevent="createComment">
                        <div class="w-full mb-4 border border-default-medium rounded-base bg-neutral-secondary-medium shadow-xs">
                            <div class="px-4 py-2 bg-neutral-secondary-medium rounded-t-base">
                                <label for="comment" class="sr-only">تعليقك</label>
                                <textarea wire:model="comment_text"
                                    class="w-full px-0 text-sm text-heading bg-neutral-secondary-medium border-0 focus:ring-0 placeholder:text-body"
                                    placeholder="أكتب تعليقًا..." required></textarea>
                            </div>
                            <button type="submit" class="text-white bg-[#79af9d] m-2 px-6 py-1 rounded-md ">أنشر</button>
                        </div>
                    </form>
                    <p class="ms-auto text-xs text-body">تذكر أن المساهمات في هذا الموضوع يجب أن تتبع قواعدنا في<a href="#" class="text-fg-brand hover:underline"> إرشادات المجتمع</a>.</p>
                </div>
            @endauth

            <div class="mt-8 space-y-6">
                @forelse ($this->comments as $comment)
                    <livewire:pages::posts.comment-component :comment="$comment" :key="$comment->id" />
                @empty
                    <div class="text-center text-gray-400 py-8">لا توجد تعليقات بعد. كن أول من يعلق!</div>
                @endforelse
            </div>
        </div>
    </div>
</div>