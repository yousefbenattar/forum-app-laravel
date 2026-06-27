<!-- Added dir="rtl" and a font suitable for Arabic -->
<a href="/posts/{{ $post->id }}" class="group" dir="rtl">
    <div 
        class="m-5 flex flex-row bg-white border border-gray-200 rounded-md shadow-sm overflow-hidden group-hover:border-[#79af9d]">

        <!-- 1. Image: Now appears on the right in RTL -->
        @if ($post->image)
            <img class="w-32 h-32 object-cover" src="{{ Storage::url($post->image) }}" alt="{{ $post->title }}">

        @else
        @endif
        <!-- 2. Content: Pushes to the left -->
        <div class="flex-1 pt-6 px-4 text-right">
            <h5 class="mb-2 text-2xl font-bold text-gray-900 group-hover:text-[#79af9d]">
                {{ $post->title }}
            </h5>
            <p class="text-gray-600 mb-4">
                {{ Str::limit($post->content, 70) }}
            </p>
        </div>

        <!-- 3. Metadata: Now on the far left -->
        <div class="flex flex-row items-center justify-between gap-6 p-4 border-r border-gray-100">
            <p class="font-mono text-sm">{{ Str::limit($post->user->username, 10) }}</p>
            <p class="text-sm text-gray-500">{{ $post->created_at->format('Y/m/d') }}</p>

            <!-- Comments -->
            <div class="flex flex-row items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-chat-text" viewBox="0 0 16 16">
                    <path
                        d="M2.678 11.894a1 1 0 0 1 .287.801 11 11 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8 8 0 0 0 8 14c3.996 0 7-2.807 7-6s-3.004-6-7-6-7 2.808-7 6c0 1.468.617 2.83 1.678 3.894m-.493 3.905a22 22 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a10 10 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9 9 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105" />
                    <path
                        d="M4 5.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8m0 2.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5" />
                </svg>
                <p>{{ $post->comments?->count() ?? 0 }}</p>
            </div>

            <!-- Views -->
            <div class="flex flex-row items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye"
                    viewBox="0 0 16 16">
                    <path
                        d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z" />
                    <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0" />
                </svg>
                <p>{{ $post->view_count ?? 0 }}</p>
            </div>
        </div>
    </div>
</a>
