<?php
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;
use App\Models\Conversation;
use App\Models\User;
use App\Notifications\NewMessageNotification;
use Livewire\Attributes\On;
?>

<div>
    <div class="mt-2 fixed h-full flex bg-white border lg:shadow-sm overflow-hidden inset-0 lg:top-16 lg:inset-x-2 m-auto lg:h-[90%] rounded-lg">

        
        <div class="relative w-full md:w-[320px] xl:w-[480px] overflow-y-auto shrink-0 h-full border">
            <div class="w-full flex flex-col">
                <p class="flex flex-col px-4 py-2 text-2xl">محادثات</p>
                <div class="flex gap-2 p-2">
                    <button class="bg-[#79af9d] rounded-full py-2 px-3 cursor-pointer text-white">الجميع</button>
                    <button class="bg-[#79af9d]/50 rounded-full py-2 px-3 cursor-pointer text-white">لم أجبها</button>
                </div>
                <ul class="flex flex-col items-end gap-3 p-2 m-2">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $this->getConversations(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $conversation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        <a href="<?php echo e(route('chat.index', ['conversation' => $conversation->id])); ?>" wire:navigate class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                            'flex justify-between items-center gap-3 p-2 border rounded-lg w-full transition-all',
                            'bg-[#79af9d] text-white border-gray-300 font-bold' => $selectedConversation?->id === $conversation->id,
                            'bg-white hover:bg-gray-50 text-gray-800' => $selectedConversation?->id !== $conversation->id
                        ]); ?>">
                            <div class="flex gap-3">
                                <img class="w-10 h-10 rounded-full" src="<?php echo e(asset('images/profile.png')); ?>" alt="Icon">
                                <div class="flex flex-col">
                                    <p class="flex items-center <?php if($selectedConversation?->id === $conversation->id): ?> text-white <?php else: ?> text-gray-900 <?php endif; ?>">
                                        <?php echo e($this->chatwith($conversation)->name); ?>

                                    </p>
                                    <div class="flex items-center gap-1 text-xs <?php if($selectedConversation?->id === $conversation->id): ?> text-teal-50 <?php else: ?> text-gray-500 <?php endif; ?>">
                                        
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($conversation->latestMessage?->sender_id === auth()->id()): ?>
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($conversation->latestMessage->read_at): ?>
                                                
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-check-all <?php if($selectedConversation?->id === $conversation->id): ?> text-white <?php else: ?> text-blue-500 <?php endif; ?>" viewBox="0 0 16 16">
                                                    <path d="M8.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L2.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093L8.95 4.992zm-.92 5.14.92.92a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 1 0-1.091-1.028L9.477 9.417l-.485-.486z"/>
                                                </svg>
                                            <?php else: ?>
                                                
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-check opacity-60" viewBox="0 0 16 16">
                                                    <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425z"/>
                                                </svg>
                                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                        <p><?php echo e(Str::limit($conversation->latestMessage?->body, 30) ?? ""); ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center gap-4">
                                
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($conversation->unread_messages_count > 0): ?>
                                    <span class="bg-[#79af9d] rounded-full min-w-6 h-6 px-2 flex items-center justify-center text-white text-xs font-bold ">
                                        <?php echo e($conversation->unread_messages_count); ?>

                                    </span>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots-vertical cursor-pointer opacity-60 hover:opacity-100" viewBox="0 0 16 16">
                                    <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0" />
                                </svg>
                            </div>
                        </a>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        <div class="flex flex-col items-center gap-3 p-2 border rounded-lg w-full text-gray-400">
                            <p><span class="text-lg">لا توجد محادثات بعد</span></p>
                        </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </ul>
            </div>
        </div>

        
        <div class="relative hidden md:grid w-full border-l h-full overflow-y-auto" style="contain:content">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($selectedConversation): ?>
                <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('pages::chat.chat-box', ['selectedConversation' => $selectedConversation]);

$__keyOuter = $__key ?? null;

$__key = $selectedConversation->id;
$__componentSlots = [];

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-1474002347-0', $__key);

$__html = app('livewire')->mount($__name, $__params, $__key, $__componentSlots);

echo $__html;

unset($__html);
unset($__key);
$__key = $__keyOuter;
unset($__keyOuter);
unset($__name);
unset($__params);
unset($__componentSlots);
unset($__split);
?>
            <?php else: ?>
                <div class="m-auto text-center justify-center flex flex-col gap-3">
                    <h3 class="font-medium text-lg text-gray-400">اختر محادثة لبدء الدردشة</h3>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>

    </div>
</div><?php /**PATH E:\Laravel-2026\forum\storage\framework\views/livewire/views/726eed0d.blade.php ENDPATH**/ ?>