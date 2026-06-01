<x-app-layout>
   <div class="space-y-4">
    @foreach($activities as $activity)
        <div class="p-4 bg-white shadow rounded-lg flex items-center justify-between">
            <div>
                <span class="text-xs text-gray-500 block">
                    {{ $activity->created_at->diffForHumans() }}
                </span>

                @switch($activity->type ?? $activity->activity_type)
                    @case('posted')
                        <p>You published a new post: <strong>{{ $activity->subject->title ?? $activity->title }}</strong></p>
                        @break

                    @case('liked')
                        <p>You liked a post.</p>
                        @break

                    @case('commented')
                        <p>You commented: <em>"{{ Str::limit($activity->subject->body ?? $activity->body, 50) }}"</em></p>
                        @break

                    @case('followed')
                        <p>You started following someone new.</p>
                        @break

                    @case('bookmarked')
                        <p>You bookmarked an item.</p>
                        @break
                @endswitch
            </div>
        </div>
    @endforeach
</div>

{{-- If you used Method 1, you can render pagination links smoothly: --}}
@if(method_exists($activities, 'links'))
    <div class="mt-4">
        {{ $activities->links() }}
    </div>
@endif
</x-app-layout>