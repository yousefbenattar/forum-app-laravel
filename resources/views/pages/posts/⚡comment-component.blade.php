<?php

use Livewire\Component;
use App\Models\Post;
use App\Models\Like;
use App\Models\Report;
use App\Models\Comment;

new class extends Component {
    public $comment;
    public array $likedComments = [];
    public $reason = ''; // 1. Declared the missing property to prevent undefined property crash

    public function mount()
    {
        // 2. Only fetch likes if the user is authenticated
        if (auth()->check()) {
            $this->likedComments = Like::where('user_id', auth()->id())
                ->pluck('comment_id')
                ->toArray();
        }
    }

    public function iscommentLiked($comment_id)
    {
        if (auth()->guest()) {
            return false;
        }

        return Like::where('user_id', auth()->id())
            ->where('comment_id', $comment_id)
            ->exists();
    }

    public function toggleLikeComment($comment_id)
    {
        if (auth()->guest()) {
            return redirect()->route('login'); // Safeguard for guests trying to like
        }

        $like = Like::where('user_id', auth()->id())
            ->where('comment_id', $comment_id);

        if ($like->exists()) {
            $like->delete();
        } else {
            Like::create([
                'user_id' => auth()->id(),
                'comment_id' => $comment_id,
            ]);
        }

        $this->likedComments = Like::where('user_id', auth()->id())
            ->pluck('comment_id')
            ->toArray();
    }
    
    public function reportedComment($comment_id)
    {
        // 3. Prevent "Attempt to read property id on null" crash for guests
        if (auth()->guest()) {
            return false;
        }

        return Report::where("user_id", auth()->id())
            ->where('report_id', $comment_id)
            ->where("report_type", Comment::class) // 4. Fixed: This was checking Post::class instead of Comment::class
            ->exists();
    }

    public function reportComment($comment_id)
    {
        if (auth()->guest()) {
            return redirect()->route('login');
        }

        Report::create([
            "user_id" => auth()->id(),
            "reason" => $this->reason ?: 'No reason provided', // Safety fallback
            "report_id" => $comment_id,
            "report_type" => Comment::class,
        ]);
    }
};
?>

<div class="border-2 border-dashed border-gray-300 rounded-md p-4">
    <div class="flex items-center mb-4">
        @if ($comment->user->avatar)
            <img src="{{ Storage::url($comment->user->avatar) }}" class="h-10 w-10 rounded-full mr-3">
        @else
            <img src="{{ asset('images/profile.png') }}" class="h-10 w-10 rounded-full mr-3">
        @endif
        <div class="font-medium text-heading">
            <p> {{ $comment->user->name }} </p>
            <time datetime="{{ $comment->created_at }}" class="block text-sm text-body">
                {{ $comment->created_at->format('F j, Y') }}
            </time>
        </div>
    </div>

    <p class="mb-2 text-body">{{ $comment->content }}</p>
    <aside>
        <form wire:submit.prevent="toggleLikeComment({{ $comment->id }})" class="flex items-center justify-between">
            <button type="submit">
                @if(in_array($comment->id, $likedComments))
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-hand-thumbs-up-fill" viewBox="0 0 16 16">
                        <path d="M6.956 1.745C7.021.81 7.908.087 8.864.325l.261.066c.463.116.874.456 1.012.965.22.816.533 2.511.062 4.51a10 10 0 0 1 .443-.051c.713-.065 1.669-.072 2.516.21.518.173.994.681 1.2 1.273.184.532.16 1.162-.234 1.733q.086.18.138.363c.077.27.113.567.113.856s-.036.586-.113.856c-.039.135-.09.273-.16.404.169.387.107.819-.003 1.148a3.2 3.2 0 0 1-.488.901c.054.152.076.312.076.465 0 .305-.089.625-.253.912C13.1 15.522 12.437 16 11.5 16H8c-.605 0-1.07-.081-1.466-.218a4.8 4.8 0 0 1-.97-.484l-.048-.03c-.504-.307-.999-.609-2.068-.722C2.682 14.464 2 13.846 2 13V9c0-.85.685-1.432 1.357-1.615.849-.232 1.574-.787 2.132-1.41.56-.627.914-1.28 1.039-1.639.199-.575.356-1.539.428-2.59z" />
                    </svg>
                @else
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                        class="bi bi-hand-thumbs-up hover:scale-110" viewBox="0 0 16 16">
                        <path d="M8.864.046C7.908-.193 7.02.53 6.956 1.466c-.072 1.051-.23 2.016-.428 2.59-.125.36-.479 1.013-1.04 1.639-.557.623-1.282 1.178-2.131 1.41C2.685 7.288 2 7.87 2 8.72v4.001c0 .845.682 1.464 1.448 1.545 1.07.114 1.564.415 2.068.723l.048.03c.272.165.578.348.97.484.397.136.861.217 1.466.217h3.5c.937 0 1.599-.477 1.934-1.064a1.86 1.86 0 0 0 .254-.912c0-.152-.023-.312-.077-.464.201-.263.38-.578.488-.901.11-.33.172-.762.004-1.149.069-.13.12-.269.159-.403.077-.27.113-.568.113-.857 0-.288-.036-.585-.113-.856a2 2 0 0 0-.138-.362 1.9 1.9 0 0 0 .234-1.734c-.206-.592-.682-1.1-1.2-1.272-.847-.282-1.803-.276-2.516-.211a10 10 0 0 0-.443.05 9.4 9.4 0 0 0-.062-4.509A1.38 1.38 0 0 0 9.125.111zM11.5 14.721H8c-.51 0-.863-.069-1.14-.164-.281-.097-.506-.228-.776-.393l-.04-.024c-.555-.339-1.198-.731-2.49-.868-.333-.036-.554-.29-.554-.55V8.72c0-.254.226-.543.62-.65 1.095-.3 1.977-.996 2.614-1.708.635-.71 1.064-1.475 1.238-1.978.243-.7.407-1.768.482-2.85.025-.362.36-.594.667-.518l.262.066c.16.04.258.143.288.255a8.34 8.34 0 0 1-.145 4.725.5.5 0 0 0 .595.644l.003-.001.014-.003.058-.014a9 9 0 0 1 1.036-.157c.663-.06 1.457-.054 2.11.164.175.058.45.3.57.65.107.308.087.67-.266 1.022l-.353.353.353.354c.043.043.105.141.154.315.048.167.075.37.075.581 0 .212-.027.414-.075.582-.05.174-.111.272-.154.315l-.353.353.353.354c.047.047.109.177.005.488a2.2 2.2 0 0 1-.505.805l-.353.353.353.354c.006.005.041.05.041.17a.9.9 0 0 1-.121.416c-.165.288-.503.56-1.066.56z" />
                    </svg>
                @endif
            </button>

            <button type="button" wire:click="reportComment({{ $comment->id }})">
                @if ($this->reportedComment($comment->id))
                    <div class="flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                            class="bi bi-flag-fill text-red-500 hover:scale-110" viewBox="0 0 16 16">
                            <path d="M14.778.085A.5.5 0 0 1 15 .5V8a.5.5 0 0 1-.314.464L14.5 8l.186.464-.003.001-.006.003-.023.009a12 12 0 0 1-.397.15c-.264.095-.631.223-1.047.35-.816.252-1.879.523-2.71.523-.847 0-1.548-.28-2.158-.525l-.028-.01C7.68 8.71 7.14 8.5 6.5 8.5c-.7 0-1.638.23-2.437.477A20 20 0 0 0 3 9.342V15.5a.5.5 0 0 1-1 0V.5a.5.5 0 0 1 1 0v.282c.226-.079.496-.17.79-.26C4.606.272 5.67 0 6.5 0c.84 0 1.524.277 2.121.519l.043.018C9.286.788 9.828 1 10.5 1c.7 0 1.638-.23 2.437-.477a20 20 0 0 0 1.349-.476l.019-.007.004-.002h.001" />
                        </svg>
                        <p>إبلاغ</p>
                    </div>
                @else
                    <div class="flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                            class="bi bi-flag hover:scale-110" viewBox="0 0 16 16">
                            <path d="M14.778.085A.5.5 0 0 1 15 .5V8a.5.5 0 0 1-.314.464L14.5 8l.186.464-.003.001-.006.003-.023.009a12 12 0 0 1-.397.15c-.264.095-.631.223-1.047.35-.816.252-1.879.523-2.71.523-.847 0-1.548-.28-2.158-.525l-.028-.01C7.68 8.71 7.14 8.5 6.5 8.5c-.7 0-1.638.23-2.437.477A20 20 0 0 0 3 9.342V15.5a.5.5 0 0 1-1 0V.5a.5.5 0 0 1 1 0v.282c.226-.079.496-.17.79-.26C4.606.272 5.67 0 6.5 0c.84 0 1.524.277 2.121.519l.043.018C9.286.788 9.828 1 10.5 1c.7 0 1.638-.23 2.437-.477a20 20 0 0 0 1.349-.476l.019-.007.004-.002h.001M14 1.221c-.22.078-.48.167-.766.255-.81.252-1.872.523-2.734.523-.886 0-1.592-.286-2.203-.534l-.008-.003C7.662 1.21 7.139 1 6.5 1c-.669 0-1.606.229-2.415.478A21 21 0 0 0 3 1.845v6.433c.22-.078.48-.167.766-.255C4.576 7.77 5.638 7.5 6.5 7.5c.847 0 1.548.28 2.158.525l.028.01C9.32 8.29 9.86 8.5 10.5 8.5c.668 0 1.606-.229 2.415-.478A21 21 0 0 0 14 7.655V1.222z" />
                        </svg>
                    </div>
                @endif
            </button>
        </form>
    </aside>
</div>