@props(['user'])

<div class="flex-col pr-6 mt-10 mr-6">
     
    <div class="flex flex-col gap-4">
        @foreach ($user->following as $followedUser)
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <img src="{{ Storage::url($followedUser->avatar) }}" class="h-10 w-10 rounded-full mr-3">
                    <a href="/users/{{ $followedUser->username }}">
                        <h3>{{ $followedUser->name }}</h3>
                    </a>
                </div>

                @auth
                    {{-- Don't show the button if the person in the list is the logged-in user --}}
                    @if (Auth::id() !== $followedUser->id)
                        @if (Auth::user()->following->contains($followedUser->id))
                            <form action="/unfollow/{{ $followedUser->id }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-sm text-red-500 hover:underline">Unfollow</button>
                            </form>
                        @else
                            <form action="/follow/{{ $followedUser->id }}" method="POST">
                                @csrf
                                <button type="submit" class="text-sm text-green-500 hover:underline">Follow</button>
                            </form>
                        @endif
                    @endif
                @endauth
            </div>
        @endforeach
    </div>
</div>
