<div class="pl-4 md:flex md:items-center gap-4">
    @if ($post->user->avatar)
        <img src="{{Storage::url($post->user->avatar)}}" class="h-10 w-10 rounded-full mr-3">
    @else
        <img src="{{asset('images/profile.png')}}" class="h-10 w-10 rounded-full mr-3">
        
    @endif
    <a href="{{'/@' . $post->user->username }}">
        <h3>{{ $post->user->name }}</h3>
    </a>
    {{-- 1. Check if the logged-in user is NOT the author --}}
    @auth
        @if (Auth::id() !== $post->user->id)

        {{-- 2. Check if the user is already following the author --}}
        @if (Auth::user()->following->contains($post->user->id))
            {{-- User is following: Show Unfollow --}}
            <form action="/unfollow/{{ $post->user->id }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-sm text-red-500 hover:underline">Unfollow</button>
            </form>
        @else
            {{-- User is not following: Show Follow --}}
            <form action="/follow/{{ $post->user->id }}" method="post">
                @csrf
                <button type="submit" class="text-sm text-green-500 hover:underline">Follow</button>
            </form>
        @endif

    @endif
    @endauth


    <div class="flex gap-2 text-sm text-gray-500">
        {{ $post->readTime() }} min read
        &middot;
        {{ $post->created_at->format('M d, Y') }}
    </div>
</div>