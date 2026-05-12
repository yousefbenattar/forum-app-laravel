@auth

    @props(['post'])



    <div class="mt-4 p-4 border-t border-b pl-4 md:flex md:items-center gap-4 justify-between">
        <div class=" flex">
            <div class="flex">
                <div x-data="
                        { Liked : {{ $post->isLikedByAuthUser() ? 'true' : 'false' }},
                          Count : {{ $post->likes_count ?? $post->likes()->count() }}}">
                    <button @click="
                            Liked = !Liked;
                            Liked ? Count++ : Count--;
                            axios.post('/{{ $post->id }}/like').catch(()=>{
                            Liked = !Liked;
                            Liked ? Count++ : Count--;
                            alert('somthing went wrong');
                            })" type="button" class="flex items-center hover:scale-110 transition-transform">
                        {{-- Toggle Icon based on Like status --}}

                        <img :src="Liked ? '{{ asset('images/thumb-2.png') }}' : '{{ asset('images/thumb-1.png') }}' "
                            alt="Liked" class="w-6 h-6 mr-2">

                        {{-- Show the count --}}
                        <span class="text-sm font-bold " :class="Liked ? 'text-black-600' : 'text-gray-600' }}"
                            x-text="Count">
                        </span>
                    </button>
                </div>

            </div>
            <div class="flex items-center">
                <img src="{{ asset('images/comment.png') }}" alt="Comments" class="w-6 h-6 inline-block mx-2">
                <span class="text-sm font-medium">
                     
                    <p>{{ $post->comments?->count() ? $post->comments->count() : 0 }}</p>
                </span>
            </div>

        </div>
        <div class="flex">
            @if (!$post->isbookmarked())
                <form action="/{{ $post->id }}/bookmark" method="post">
                    @csrf
                    <button type="submit">
                        <img src="{{ asset('images/bookmark-2.png') }}" alt="Clap" class="w-6 h-6 inline-block mr-2">
                    </button>
                </form>
            @else
                <form action="/{{ $post->id }}/unbookmark" method="post">
                    @csrf
                    @method('delete')
                    <button type="submit">
                        <img src="{{ asset('images/bookmark-1.png') }}" alt="Clap" class="w-6 h-6 inline-block mr-2">
                    </button>
                </form>
            @endif


            <img src="{{ asset('images/share-8-240.png') }}" alt="Clap" class="w-6 h-6 inline-block mr-2">
            <img src="{{ asset('images/plus-lined-240.png') }}" alt="Clap" class="w-6 h-6 inline-block mr-2">
        </div>
    </div>

@endauth