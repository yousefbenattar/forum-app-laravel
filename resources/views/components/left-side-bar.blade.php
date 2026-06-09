@props(['videos'])


<div class="min-h-full bg-white text-black font-sans">
    @foreach($videos as $video)
        <div class="video-item border border-black rounded py-2 mb-1">
            <a href="https://www.youtube.com/watch?v={{ $video['id']['videoId'] }}" target="_blank">
                <img src="{{ $video['snippet']['thumbnails']['medium']['url'] }}" alt="{{ $video['snippet']['title'] }}">
                <p>{{ $video['snippet']['title'] }}</p>
            </a>
        </div>
    @endforeach
</div>