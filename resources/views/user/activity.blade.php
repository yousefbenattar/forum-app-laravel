<x-app-layout>
   <div class="space-y-4">
    @foreach($activities as $activity)
        <div class="mt-1 p-4 bg-white shadow rounded-lg flex items-center gap-2" dir="rtl">
                <span class="text-xs text-gray-500 block">
                    {{ $activity->created_at->diffForHumans() }}
                </span>
                @switch($activity->type)
                    @case('posted')
                        <p>لقد قمت بنشر منشور جديد : <strong>{{ $activity->subject->title }}</strong></p>
                        @break
                    @case('liked')
                        <p>
        لقد أعجبك منشور: 
        <strong>{{ $activity->subject?->post?->title ?? 'منشور غير موجود' }}</strong>
    </p>  @break
                    @case('commented')
                        <p>لقد علّقت: <em>"{{ Str::limit( $activity->subject->content, 50) }}"</em></p>
                        @break
                    @case('followed')
                        <p>لقد بدأت في متابعة شخص جديد.</p>
                        @break
                    @case('bookmarked')
                        <p>لقد أضفت عنصراً إلى الإشارات المرجعية.</p>
                        @break
                @endswitch
        </div>
    @endforeach
</div>
</x-app-layout>