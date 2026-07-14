<x-app-layout>
    <div class="py-2" dir="rtl">
        <div class="max-w-3xl mx-auto lg:px-8">
            <h1 class="text-2xl font-bold mb-6 text-gray-900 flex items-center gap-2">
                <span>مركز الإشعارات</span>
            </h1>

            <div class="bg-white overflow-hidden  sm:rounded-lg border border-gray-600">
                @if($notifications->isEmpty())
                    <div class="p-8 text-center text-gray-500">
                        <svg class="mx-auto h-12 w-12 text-gray-300 mb-3" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0a2 2 0 01-2 2H6a2 2 0 01-2-2m16 0V9a2 2 0 00-2-2H6a2 2 0 00-2 2v4h16z" />
                        </svg>
                        <p>لا توجد إشعارات حالياً.</p>
                    </div>
                @else
                    <div class="divide-y divide-gray-100">
                        @foreach($notifications as $notification)
                            <div class="p-4 hover:bg-gray-50 transition duration-150 flex items-start justify-between
                                                    {{ $notification->read_at === null ? 'bg-indigo-50/40' : '' }}">
                                @php
                                    $user = null;

                                    // 1. Safely check if 'sender_id' exists inside the notification data array
                                    if (isset($notification->data['sender_id'])) {

                                        // 2. Use find() instead of findOrFail so your whole page doesn't crash 
                                        // with a 404 error if a user deletes their account.
                                        $user = App\Models\User::findOrFail($notification->data['sender_id']);
                                    }
                                    if (isset($notification->data['follower_id'])) {

                                        // 2. Use find() instead of findOrFail so your whole page doesn't crash 
                                        // with a 404 error if a user deletes their account.
                                        $user = App\Models\User::findOrFail($notification->data['follower_id']);
                                    }
                                @endphp
                                <div class="flex items-center gap-1">
                                    <div
                                        class="mt-1 h-8 w-8 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center font-bold text-sm">
                                        🔔
                                    </div>

                                     
                                        <p class="text-sm font-medium text-gray-800">
                                            {{ $notification->data['message'] ?? 'إشعار جديد' }}
                                            {{ '' }}
                                        </p>
                                        @if ($user)
                                            <div class="flex items-center gap-1">
                                                <p class="text-sm font-medium text-gray-800">من طرف :</p>
                                                <a class="flex items-center gap-1" href="/chat">
                                                    @if ($user->avatar)
                                                        <img class="h-8 w-8 rounded-full" src=" {{Storage::url($user->avatar)}}"/>
                                                    @else
                                                        <img class="h-8 w-8 rounded-full" src=" {{asset("images/profile.png")}}"/>
                                                    @endif
                                                     <p> {{$user->name}}</p>
                                                </a>
                                            </div>
                                        @endif
                                        @if(isset($notification->data['url']))
                                            <a href="{{ $notification->data['url'] }}"
                                                class="text-xs text-indigo-600 hover:underline mt-1 inline-block">
                                                عرض التفاصيل ←
                                            </a>
                                        @endif
                                    
                                </div>

                                <span class="text-xs text-gray-400 whitespace-nowrap">
                                    {{ $notification->created_at->diffForHumans() }}
                                </span>
                            </div>
                        @endforeach
                    </div>

                    <div class="p-4 bg-gray-50 border-t border-gray-100">
                        {{ $notifications->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>