<?php

use Livewire\Component;
use App\Models\Post;
use App\Models\Follow;
use App\Notifications\NewFollowerNotification;

new class extends Component {
    public Post $post;

    public function toggleFollow()
    {
        // 1. Safe guard for guests
        if (auth()->guest()) {
            return redirect()->route('login');
        }

        // 2. Safe guard if the author's account was deleted
        if (!$this->post->user) {
            return;
        }

        $userId = auth()->id();
        $authorId = $this->post->user->id;

        // Don't let users follow themselves
        if ($userId === $authorId) {
            return;
        }

        $follow = Follow::where('follower_id', $userId)
            ->where('following_id', $authorId)
            ->first();

        if ($follow) {
            $follow->delete();
        } else {
            $follower = Follow::create([
                'follower_id' => $userId,
                'following_id' => $authorId,
            ]);

            $this->post->user->notify(new NewFollowerNotification($follower));
        }
    }

    public function isFollowing()
    {
        if (auth()->guest() || !$this->post->user) {
            return false;
        }

        return Follow::where('follower_id', auth()->id())
            ->where('following_id', $this->post->user->id)
            ->exists();
    }

    public function isDifferent()
    {
        if (auth()->guest() || !$this->post->user) {
            return false;
        }

        return auth()->id() !== $this->post->user->id;
    }
};
?>

<div class="pl-4 md:flex md:items-center gap-4">
    @if ($post->user?->avatar)
        <img src="{{ Storage::url($post->user->avatar) }}" class="h-10 w-10 rounded-full mr-3">
    @else
        <img src="{{ asset('images/profile.png') }}" class="h-10 w-10 rounded-full mr-3">
    @endif

    @if ($post->user)
        <a href="{{ '/@' . $post->user->username }}">
            <h3>{{ $post->user->name }}</h3>
        </a>
    @else
        <h3>مستخدم محذوف</h3>
    @endif

    @auth
        @if ($this->isDifferent())
            <form wire:submit.prevent="toggleFollow">
                @if ($this->isFollowing())
                    <button type="submit" class="text-sm text-red-500 hover:underline">إلغاء المتابعة</button>
                @else
                    <button type="submit" class="text-sm text-green-500 hover:underline">متابعة</button>
                @endif
            </form>
        @endif
    @endauth

    <div class="flex gap-2 text-sm text-gray-500">
        {{ $post->readTime() }} دقيقة قراءة
        &middot;
        {{ $post->created_at->format('M d, Y') }}
    </div>
</div>