<x-app-layout>
   <div class="space-y-4">
    @foreach($activities as $activity)
        <div class="p-4 bg-white shadow rounded-lg flex items-center justify-between" dir="rtl">
            <a href="{{ $activity->subject->url ?? '#' }}" class="flex items-center space-x-4">
                <span class="text-xs text-gray-500 block">
                    {{ $activity->created_at->diffForHumans() }}
                </span>

                @switch($activity->type ?? $activity->activity_type)
                    @case('posted')
                        <p>لقد قمت بنشر منشور جديد: <strong>{{ $activity->subject->title ?? $activity->title }}</strong></p>
                        @break

                    @case('liked')
                        <p>لقد أعجبك منشور.</p>
                        @break

                    @case('commented')
                        <p>لقد علّقت: <em>"{{ Str::limit($activity->subject->body ?? $activity->body, 50) }}"</em></p>
                        @break

                    @case('followed')
                        <p>لقد بدأت في متابعة شخص جديد.</p>
                        @break

                    @case('bookmarked')
                        <p>لقد أضفت عنصراً إلى الإشارات المرجعية.</p>
                        @break
                @endswitch
            </a>
        </div>
    @endforeach
</div>

</x-app-layout>