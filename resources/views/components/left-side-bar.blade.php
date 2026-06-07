@props(['videos'])


<div class="min-h-screen bg-white text-black font-sans pl-2">
    <p class="flex justify-center w-full text-2xl py-2">أحدث مقاطعنا 👇</p>
    @foreach($videos as $video)
        <div class="video-item border border-black ">
            <a href="https://www.youtube.com/watch?v={{ $video['id']['videoId'] }}" target="_blank">
                <img src="{{ $video['snippet']['thumbnails']['medium']['url'] }}" alt="{{ $video['snippet']['title'] }}">
                <p>{{ $video['snippet']['title'] }}</p>
            </a>
        </div>
    @endforeach
</div>