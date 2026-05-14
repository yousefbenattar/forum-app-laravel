@props(['videos'])

{{-- <div class="flex-col px-10 mt-10">
    @php
    $osactive = request()->is("/");
    @endphp
    <a href="/">
        <p class="{{ $osactive ? 'text-[#79af9d] text-2xl' : '' }}">All</p>
    </a>
    @foreach ($categories as $category)
    @php
    $isactive = request()->is("category/" . $category['id']);
    @endphp
    <div class="flex-col">
        <a href="/category/{{$category['id']}}">
            <p class="text-black {{ $isactive ? 'text-[#79af9d] text-xl' : '' }}  cursor-pointer">
                {{ $category['name'] }}</p>
        </a>

    </div>
    @endforeach
</div> --}}


<div class="min-h-screen bg-white p-8 text-black font-sans">
    <h2 class="justify-items-right w-full">أحدث مقاطعنا 👇</h2>
    @foreach($videos as $video)
        <div class="video-item border border-black rounded-md p-2 my-2">
            <a href="https://www.youtube.com/watch?v={{ $video['id']['videoId'] }}" target="_blank">
                <img src="{{ $video['snippet']['thumbnails']['medium']['url'] }}" alt="{{ $video['snippet']['title'] }}">
                <p>{{ $video['snippet']['title'] }}</p>
            </a>
        </div>
    @endforeach
</div>