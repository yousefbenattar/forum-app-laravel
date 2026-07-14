<?php

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Report;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Support\Carbon;

new #[Layout('layouts::app3')] class extends Component 
{
    // جلب البلاغات مع العلاقات لتجنب مشكلة الـ N+1 queries مستقبلاً
    public function reports()
    {
        return Report::latest()->get();
    }

    public function findReporter($id)
    {
        return User::find($id);
    }

    public function findReported($type, $id)
    {
        if ($type == Post::class) {
            $post = Post::find($id);
            return $post ? User::find($post->user_id) : null;
        } else {
            $comment = Comment::find($id);
            return $comment ? User::find($comment->user_id) : null;
        }
    }

    public function findPost($id)
    {
        return Post::find($id);
    }

    public function findComment($id)
    {
        return Comment::find($id);
    }

    public function isPost($type)
    {
        return $type === Post::class;
    }

    public function isComment($type)
    {
        return $type === Comment::class;
    }

    // تم تعديل الترتيب هنا ليتوافق مع التمرير من الفرونت إند ($reportId أولاً ثم $postId)
    public function deletePost($reportId, $postId)
    {
        Report::findOrFail($reportId)->delete();
        Post::findOrFail($postId)->delete();

        session()->flash('success', 'تم حذف المنشور بنجاح.');
    }

    public function deleteComment($reportId, $commentId)
    {
        Report::findOrFail($reportId)->delete();
        Comment::findOrFail($commentId)->delete();

        session()->flash('success', 'تم حذف التعليق بنجاح.');
    }

    public function deleteReport($reportId)
    {
        Report::findOrFail($reportId)->delete();

        session()->flash('success', 'تم إغلاق البلاغ بنجاح.');
    }

    public function sendWarning($userId)
    {
        $user = User::findOrFail($userId);
        $user->increment('warning_count');

        session()->flash('success', 'تم إرسال التحذير للمستخدم.');
    }

    public function suspendUser($userId)
    {
        $user = User::findOrFail($userId);
        $user->update([
            'suspended_until' => Carbon::now()->addDays(7),
        ]);

        session()->flash('success', 'تم تعليق الحساب لمدة 7 أيام.');
    }

    public function banUser($userId)
    {
        $user = User::findOrFail($userId);
        $user->update([
            'banned_at' => now(),
        ]);

        session()->flash('success', 'تم حظر الحساب نهائياً.');
    }
};
?>

<div class="flex flex-col" dir="rtl">
    @if (session()->has('success'))
        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex items-center justify-between px-2 py-4">
        <h2 class="text-xl font-bold">البلاغات</h2>
        <div class="flex gap-2">
            <input placeholder="إبحث ..." type="text" class="rounded-md border-gray-300" />
            <select class="rounded-md border-gray-300">
                <option>الأحدث</option>
                <option>الأقدم</option>
                <option>الأكثر إلحاحا</option>
            </select>
        </div>
    </div>

    <div class="flex bg-gray-200 text-base font-semibold">
        <div class="w-1/6 p-2"><p>رقم البلاغ</p></div>
        <div class="w-1/6 p-2"><p>صاحب البلاغ</p></div>
        <div class="w-1/6 p-2"><p>المبلغ عنه</p></div>
        <div class="w-1/6 p-2"><p>النوع</p></div>
        <div class="w-1/6 p-2"><p>السبب</p></div>
        <div class="w-2/6 p-2"><p>المحتوى والإجراءات</p></div>
    </div>

    @forelse ($this->reports() as $report)
        @php
            $reporter = $this->findReporter($report->user_id);
            $reportedUser = $this->findReported($report->report_type, $report->report_id);
            $isPost = $this->isPost($report->report_type);
            $isComment = $this->isComment($report->report_type);
        @endphp

        <div class="flex text-base border-b border-gray-100 hover:bg-gray-50 items-center">
            <div class="w-1/6 p-2 flex gap-1">
                <p class="text-gray-500 md:hidden">رقم البلاغ :</p>
                <p>{{ $report->id }}</p>
            </div>

            <div class="w-1/6 p-2">
                @if($reporter)
                    <div class="flex items-center gap-2">
                        <img src="{{ $reporter->avatar ? Storage::url($reporter->avatar) : asset('images/profile.png') }}" 
                             class="h-8 w-8 rounded-full object-cover">
                        <p class="truncate">{{ $reporter->name }}</p>
                    </div>
                @endif
            </div>

            <div class="w-1/6 p-2">
                @if($reportedUser)
                    <div class="flex items-center gap-2">
                        <img src="{{ $reportedUser->avatar ? Storage::url($reportedUser->avatar) : asset('images/profile.png') }}" 
                             class="h-8 w-8 rounded-full object-cover">
                        <p class="truncate">{{ $reportedUser->name }}</p>
                    </div>
                @endif
            </div>

            <div class="w-1/6 p-2">
                <span>
                    @if($isPost) منشور @elseif($isComment) تعليق @else حساب @endif
                </span>
            </div>

            <div class="w-1/6 p-2">
                <p class="text-sm text-gray-700">{{ $report->reason }}</p>
            </div>

            <div class="w-2/6 p-2">
                @if ($isPost && $post = $this->findPost($report->report_id))
                    <div class="bg-white p-4 border border-gray-200 rounded-md shadow-sm">
                        <div class="flex items-center justify-between mb-3">
                            <p class="text-sm font-semibold text-gray-800 truncate w-3/4">
                                {{ $post->title }}
                            </p>

                            <div x-data="{
                                showActions: false,
                                showDeleteReportModal: false,
                                showDeletePostModal: false,
                                showWarningUserModal: false,
                                showSuspendUserModal: false,
                                showBanUserModal: false,
                            }" class="relative">
                                
                                <button @click="showActions = !showActions" class="text-gray-500 hover:text-gray-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                                        <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0"/>
                                    </svg>
                                </button>

                                <div x-show="showActions" x-cloak @click.outside="showActions = false"
                                     class="absolute left-0 z-40 mt-2 bg-white shadow-xl border border-gray-100 rounded-md flex flex-col w-48 py-1">
                                    
                                    <button @click="showDeleteReportModal = true; showActions = false" class="flex gap-2 items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 w-full text-right">
                                        <span>إخلاء سبيل</span>
                                    </button>

                                    <button @click="showDeletePostModal = true; showActions = false" class="flex gap-2 items-center px-4 py-2 text-sm text-red-600 hover:bg-red-50 w-full text-right">
                                        <span>حذف المنشور</span>
                                    </button>

                                    <button @click="showWarningUserModal = true; showActions = false" class="flex gap-2 items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 w-full text-right">
                                        <span>تحذير المستخدم</span>
                                    </button>

                                    <button @click="showSuspendUserModal = true; showActions = false" class="flex gap-2 items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 w-full text-right">
                                        <span>تعليق الحساب 7 أيام</span>
                                    </button>

                                    <button @click="showBanUserModal = true; showActions = false" class="flex gap-2 items-center px-4 py-2 text-sm text-red-700 hover:bg-red-50 w-full text-right">
                                        <span>حظر نهائي</span>
                                    </button>
                                </div>

                                <div x-show="showDeleteReportModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center">
                                    <div class="fixed inset-0 bg-gray-600/50 backdrop-blur-sm" @click="showDeleteReportModal = false"></div>
                                    <div class="bg-white rounded-md p-6 max-w-sm w-full z-10 shadow-2xl">
                                        <h3 class="text-lg font-bold mb-4">هل تريد إخلاء سبيل هذا المنشور وإغلاق البلاغ؟</h3>
                                        <div class="flex items-center justify-end gap-3">
                                            <button type="button" @click="showDeleteReportModal = false" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md">إلغاء</button>
                                            <button type="button" wire:click="deleteReport({{ $report->id }})" @click="showDeleteReportModal = false" class="px-4 py-2 bg-orange-600 text-white rounded-md hover:bg-orange-700">تأكيد</button>
                                        </div>
                                    </div>
                                </div>

                                <div x-show="showDeletePostModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center">
                                    <div class="fixed inset-0 bg-gray-600/50 backdrop-blur-sm" @click="showDeletePostModal = false"></div>
                                    <div class="bg-white rounded-md p-6 max-w-sm w-full z-10 shadow-2xl">
                                        <h3 class="text-lg font-bold mb-4">هل ترغب فعلاً في حذف هذا المنشور نهائياً؟</h3>
                                        <div class="flex items-center justify-end gap-3">
                                            <button type="button" @click="showDeletePostModal = false" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md">إلغاء</button>
                                            <button type="button" wire:click="deletePost({{ $report->id }}, {{ $report->report_id }})" @click="showDeletePostModal = false" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">حذف</button>
                                        </div>
                                    </div>
                                </div>

                                <div x-show="showWarningUserModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center">
                                    <div class="fixed inset-0 bg-gray-600/50 backdrop-blur-sm" @click="showWarningUserModal = false"></div>
                                    <div class="bg-white rounded-md p-6 max-w-sm w-full z-10 shadow-2xl">
                                        <h3 class="text-lg font-bold mb-4">هل تريد إرسال تحذير رسمي لهذا المستخدم؟</h3>
                                        <div class="flex items-center justify-end gap-3">
                                            <button type="button" @click="showWarningUserModal = false" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md">إلغاء</button>
                                            <button type="button" wire:click="sendWarning({{ $reportedUser->id ?? 0 }})" @click="showWarningUserModal = false" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">تحذير</button>
                                        </div>
                                    </div>
                                </div>

                                <div x-show="showSuspendUserModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center">
                                    <div class="fixed inset-0 bg-gray-600/50 backdrop-blur-sm" @click="showSuspendUserModal = false"></div>
                                    <div class="bg-white rounded-md p-6 max-w-sm w-full z-10 shadow-2xl">
                                        <h3 class="text-lg font-bold mb-4">هل ترغب في تعليق حساب المستخدم لمدة 7 أيام؟</h3>
                                        <div class="flex items-center justify-end gap-3">
                                            <button type="button" @click="showSuspendUserModal = false" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md">إلغاء</button>
                                            <button type="button" wire:click="suspendUser({{ $reportedUser->id ?? 0 }})" @click="showSuspendUserModal = false" class="px-4 py-2 bg-orange-500 text-white rounded-md hover:bg-orange-600">تعليق الحساب</button>
                                        </div>
                                    </div>
                                </div>

                                <div x-show="showBanUserModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center">
                                    <div class="fixed inset-0 bg-gray-600/50 backdrop-blur-sm" @click="showBanUserModal = false"></div>
                                    <div class="bg-white rounded-md p-6 max-w-sm w-full z-10 shadow-2xl">
                                        <h3 class="text-lg font-bold mb-4">هل تريد حظر (تبنيد) هذا المستخدم بشكل دائم؟</h3>
                                        <div class="flex items-center justify-end gap-3">
                                            <button type="button" @click="showBanUserModal = false" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md">إلغاء</button>
                                            <button type="button" wire:click="banUser({{ $reportedUser->id ?? 0 }})" @click="showBanUserModal = false" class="px-4 py-2 bg-red-700 text-white rounded-md hover:bg-red-800">حظر نهائي</button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <a href="/posts/{{ $post->id }}" target="_blank"
                           class="inline-flex font-medium items-center text-blue-600 hover:underline text-sm">
                            زيارة المنشور
                            <svg class="w-4 h-4 ms-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/>
                            </svg>
                        </a>
                    </div>
                @elseif ($isComment && $comment = $this->findComment($report->report_id))
                    <div class="bg-white p-4 border border-gray-200 rounded-md shadow-sm">
                        <div class="flex items-center justify-between mb-3">
                            <p class="text-sm text-gray-800 truncate w-3/4">
                                {{ $comment->content }}
                            </p>
                        </div>
                        <a href="/posts/{{ $comment->post_id }}" target="_blank"
                           class="inline-flex font-medium items-center text-blue-600 hover:underline text-sm">
                            مشاهدة السياق (التعليق)
                        </a>
                    </div>
                @else
                    <span class="text-gray-400 text-sm">محتوى غير متوفر أو تم حذفه</span>
                @endif
            </div>
        </div>
    @empty
        <div class="p-8 text-center text-gray-500">
            لا توجد بلاغات حالياً.
        </div>
    @endforelse
</div>