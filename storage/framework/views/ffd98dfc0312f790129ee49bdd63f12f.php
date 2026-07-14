<?php
use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Report;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Support\Carbon;
?>

<div class="flex flex-col" dir="rtl">
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session()->has('success')): ?>
        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

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

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $this->reports(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $report): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
        <?php
            $reporter = $this->findReporter($report->user_id);
            $reportedUser = $this->findReported($report->report_type, $report->report_id);
            $isPost = $this->isPost($report->report_type);
            $isComment = $this->isComment($report->report_type);
        ?>

        <div class="flex text-base border-b border-gray-100 hover:bg-gray-50 items-center">
            <div class="w-1/6 p-2 flex gap-1">
                <p class="text-gray-500 md:hidden">رقم البلاغ :</p>
                <p><?php echo e($report->id); ?></p>
            </div>

            <div class="w-1/6 p-2">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($reporter): ?>
                    <div class="flex items-center gap-2">
                        <img src="<?php echo e($reporter->avatar ? Storage::url($reporter->avatar) : asset('images/profile.png')); ?>" 
                             class="h-8 w-8 rounded-full object-cover">
                        <p class="truncate"><?php echo e($reporter->name); ?></p>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>

            <div class="w-1/6 p-2">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($reportedUser): ?>
                    <div class="flex items-center gap-2">
                        <img src="<?php echo e($reportedUser->avatar ? Storage::url($reportedUser->avatar) : asset('images/profile.png')); ?>" 
                             class="h-8 w-8 rounded-full object-cover">
                        <p class="truncate"><?php echo e($reportedUser->name); ?></p>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>

            <div class="w-1/6 p-2">
                <span>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isPost): ?> منشور <?php elseif($isComment): ?> تعليق <?php else: ?> حساب <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </span>
            </div>

            <div class="w-1/6 p-2">
                <p class="text-sm text-gray-700"><?php echo e($report->reason); ?></p>
            </div>

            <div class="w-2/6 p-2">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isPost && $post = $this->findPost($report->report_id)): ?>
                    <div class="bg-white p-4 border border-gray-200 rounded-md shadow-sm">
                        <div class="flex items-center justify-between mb-3">
                            <p class="text-sm font-semibold text-gray-800 truncate w-3/4">
                                <?php echo e($post->title); ?>

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
                                            <button type="button" wire:click="deleteReport(<?php echo e($report->id); ?>)" @click="showDeleteReportModal = false" class="px-4 py-2 bg-orange-600 text-white rounded-md hover:bg-orange-700">تأكيد</button>
                                        </div>
                                    </div>
                                </div>

                                <div x-show="showDeletePostModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center">
                                    <div class="fixed inset-0 bg-gray-600/50 backdrop-blur-sm" @click="showDeletePostModal = false"></div>
                                    <div class="bg-white rounded-md p-6 max-w-sm w-full z-10 shadow-2xl">
                                        <h3 class="text-lg font-bold mb-4">هل ترغب فعلاً في حذف هذا المنشور نهائياً؟</h3>
                                        <div class="flex items-center justify-end gap-3">
                                            <button type="button" @click="showDeletePostModal = false" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md">إلغاء</button>
                                            <button type="button" wire:click="deletePost(<?php echo e($report->id); ?>, <?php echo e($report->report_id); ?>)" @click="showDeletePostModal = false" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">حذف</button>
                                        </div>
                                    </div>
                                </div>

                                <div x-show="showWarningUserModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center">
                                    <div class="fixed inset-0 bg-gray-600/50 backdrop-blur-sm" @click="showWarningUserModal = false"></div>
                                    <div class="bg-white rounded-md p-6 max-w-sm w-full z-10 shadow-2xl">
                                        <h3 class="text-lg font-bold mb-4">هل تريد إرسال تحذير رسمي لهذا المستخدم؟</h3>
                                        <div class="flex items-center justify-end gap-3">
                                            <button type="button" @click="showWarningUserModal = false" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md">إلغاء</button>
                                            <button type="button" wire:click="sendWarning(<?php echo e($reportedUser->id ?? 0); ?>)" @click="showWarningUserModal = false" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">تحذير</button>
                                        </div>
                                    </div>
                                </div>

                                <div x-show="showSuspendUserModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center">
                                    <div class="fixed inset-0 bg-gray-600/50 backdrop-blur-sm" @click="showSuspendUserModal = false"></div>
                                    <div class="bg-white rounded-md p-6 max-w-sm w-full z-10 shadow-2xl">
                                        <h3 class="text-lg font-bold mb-4">هل ترغب في تعليق حساب المستخدم لمدة 7 أيام؟</h3>
                                        <div class="flex items-center justify-end gap-3">
                                            <button type="button" @click="showSuspendUserModal = false" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md">إلغاء</button>
                                            <button type="button" wire:click="suspendUser(<?php echo e($reportedUser->id ?? 0); ?>)" @click="showSuspendUserModal = false" class="px-4 py-2 bg-orange-500 text-white rounded-md hover:bg-orange-600">تعليق الحساب</button>
                                        </div>
                                    </div>
                                </div>

                                <div x-show="showBanUserModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center">
                                    <div class="fixed inset-0 bg-gray-600/50 backdrop-blur-sm" @click="showBanUserModal = false"></div>
                                    <div class="bg-white rounded-md p-6 max-w-sm w-full z-10 shadow-2xl">
                                        <h3 class="text-lg font-bold mb-4">هل تريد حظر (تبنيد) هذا المستخدم بشكل دائم؟</h3>
                                        <div class="flex items-center justify-end gap-3">
                                            <button type="button" @click="showBanUserModal = false" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md">إلغاء</button>
                                            <button type="button" wire:click="banUser(<?php echo e($reportedUser->id ?? 0); ?>)" @click="showBanUserModal = false" class="px-4 py-2 bg-red-700 text-white rounded-md hover:bg-red-800">حظر نهائي</button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <a href="/posts/<?php echo e($post->id); ?>" target="_blank"
                           class="inline-flex font-medium items-center text-blue-600 hover:underline text-sm">
                            زيارة المنشور
                            <svg class="w-4 h-4 ms-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/>
                            </svg>
                        </a>
                    </div>
                <?php elseif($isComment && $comment = $this->findComment($report->report_id)): ?>
                    <div class="bg-white p-4 border border-gray-200 rounded-md shadow-sm">
                        <div class="flex items-center justify-between mb-3">
                            <p class="text-sm text-gray-800 truncate w-3/4">
                                <?php echo e($comment->content); ?>

                            </p>
                        </div>
                        <a href="/posts/<?php echo e($comment->post_id); ?>" target="_blank"
                           class="inline-flex font-medium items-center text-blue-600 hover:underline text-sm">
                            مشاهدة السياق (التعليق)
                        </a>
                    </div>
                <?php else: ?>
                    <span class="text-gray-400 text-sm">محتوى غير متوفر أو تم حذفه</span>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
        <div class="p-8 text-center text-gray-500">
            لا توجد بلاغات حالياً.
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</div><?php /**PATH E:\Laravel-2026\forum\storage\framework\views/livewire/views/ad7a6c3d.blade.php ENDPATH**/ ?>