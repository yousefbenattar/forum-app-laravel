<?php
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;
use App\Models\Conversation;
use App\Models\User;
?>

<div>
    <div class="mt-2 fixed h-full flex bg-white border lg:shadow-sm overflow-hidden inset-0 lg:top-16 lg:inset-x-2 m-auto lg:h-[90%] rounded-lg">

        
        <div class="relative w-full md:w-[320px] xl:w-[480px] overflow-y-auto shrink-0 h-full border">
            <div class="w-full flex flex-col">
                <p class="flex flex-col px-4 py-2 text-2xl">محادثات</p>
                <div class="flex gap-2 p-2">
                    <div class="bg-[#79af9d] rounded-full py-2 px-3 cursor-pointer text-white">الجميع</div>
                    <div class="bg-[#79af9d]/80 rounded-full py-2 px-3 cursor-pointer text-white">لم أجبها</div>
                </div>
                <ul class="flex flex-col items-end gap-3 p-2 m-2">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $this->getConversations(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $conversation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        
                        <button wire:click="selectConversation(<?php echo e($conversation); ?>)" 
                            class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                                'flex justify-between items-center gap-3 p-2 border rounded-lg w-full transition-all',
                                'bg-[#79af9d] text-white border-gray-300 font-bold' => $selectedConversation?->id === $conversation->id,
                                'bg-white hover:bg-gray-50' => $selectedConversation?->id !== $conversation->id
                            ]); ?>">
                            <div class="flex gap-3">
                                <img class="w-10 h-10 rounded-full" src="<?php echo e(asset('images/profile.png')); ?>" alt="Icon">
                                <p class="flex items-center">
                                    <?php echo e($this->chatwith($conversation)->name); ?>

                                </p>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots-vertical cursor-pointer" viewBox="0 0 16 16">
                                <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0" />
                            </svg>
                        </button>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        <div class="flex flex-col items-center gap-3 p-2 border rounded-lg w-full">
                            <p><span class="text-2xl">لا توجد محادثات بعد</span></p>
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