@props(['user'])
<div class="flex-col bg:gray-200 mt-10">
    <img src="{{ $user->avatar ? Storage::url($user->avatar) : asset('images/profile.png')}}" class="h-20">
    <h3 class="mt-6">{{ $user->followers?->count() ? $user->followers->count() . ' followers' : ''   }}
    </h3>
    <div class="flex gap-4 items-center">
        <h2 class="text-xl font-bold">{{ $user->name ?? 'User' }}</h2>


        @if (Auth::id() == $user->id)
            <a href=" {{ route('profile.edit') }}"><button
                    class="bg-[#79af9d] text-white px-4 py-2 rounded-lg my-2">Edit</button></a>
        @else
            @auth
                @if (Auth::id() !== $user->id)
                    <form action="/add_to_conversations/{{ $user->id }}" method="post">
                        @csrf
                        <button type="submit">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                class="bi bi-chat-text" viewBox="0 0 16 16">
                                <path
                                    d="M2.678 11.894a1 1 0 0 1 .287.801 11 11 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8 8 0 0 0 8 14c3.996 0 7-2.807 7-6s-3.004-6-7-6-7 2.808-7 6c0 1.468.617 2.83 1.678 3.894m-.493 3.905a22 22 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a10 10 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9 9 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105" />
                                <path
                                    d="M4 5.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8m0 2.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5" />
                            </svg>
                        </button>
                    </form>
                    {{-- 2. Check if the user is already following the author --}}
                    @if (Auth::user()->following->contains($user->id))
                        {{-- User is following: Show Unfollow --}}
                        <form action="/unfollow/{{ $user->id }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-sm text-red-500 hover:underline">إلغاء المتابعة</button>
                        </form>
                    @else
                        {{-- User is not following: Show Follow --}}
                        <form action="/follow/{{ $user->id }}" method="post">
                            @csrf
                            <button type="submit" class="text-sm text-green-500 hover:underline">متابعة</button>
                        </form>
                    @endif
                @endif
            @endauth
        @endif
    </div>


    <p class="mt-6"> {{ $user->bio }} </p>




</div>