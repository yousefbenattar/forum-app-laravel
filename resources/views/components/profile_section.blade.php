@props(['user'])
<div class="flex-col bg:gray-200 mt-10">
        <img src="{{ $user->avatar ? Storage::url($user->avatar) : asset('images/profile.png')}}"
        class="h-20">
    <h3 class="mt-6">{{ $user->followers?->count() ? $user->followers->count() . ' followers' : ''   }}
    </h3>
    <h2 class="text-xl font-bold">{{ $user->name ?? 'User' }}</h2>
    <p class="text-xs text-black-400 font-mono">{{ $user->email ?? '' }}</p>

    <p class="mt-6"> {{ $user->bio }} </p>



    @if (Auth::id() == $user->id)
        <a href=" {{ route('profile.edit') }}"><button class="bg-[#79af9d] text-white px-4 py-2 rounded-lg my-2">Edit</button></a>
    @else
        @auth
            @if (Auth::id() !== $user->id)
                {{-- 2. Check if the user is already following the author --}}
                @if (Auth::user()->following->contains($user->id))
                    {{-- User is following: Show Unfollow --}}
                    <form action="/unfollow/{{ $user->id }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-sm text-red-500 hover:underline">Unfollow</button>
                    </form>
                @else
                    {{-- User is not following: Show Follow --}}
                    <form action="/follow/{{ $user->id }}" method="post">
                        @csrf
                        <button type="submit" class="text-sm text-green-500 hover:underline">Follow</button>
                    </form>
                @endif
            @endif
        @endauth
    @endif
</div>