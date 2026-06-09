<?php
use Livewire\Component;
use App\Models\Conversation;
use App\Models\User;
use App\Events\MessageSent;
use App\Models\Message;
?>

<div class="p-4 flex flex-col justify-between bg-gray-50 h-full max-h-[85vh]">

    
    <div
    x-data="{ scrollToBottom (){$el.scrollTop = $el.scrollHeight;}} "
    x-init="scrollToBottom()"
    @scroll-to-bottom.window="$nextTick(() => scrollToBottom())"
    class="flex flex-col gap-2 overflow-y-auto mb-4 p-2 grow">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $this->getMessages(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
            <div class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                'p-2 rounded-lg max-w-[80%] border shadow-sm',
                /// Sent by me (align left or right depending on your RTL preference)
                'bg-[#79af9d] text-white mr-auto' => $message->sender_id === auth()->id(),
                /// Sent by other 
                'bg-white text-gray-800 ml-auto' => $message->sender_id !== auth()->id()
            ]); ?>">
                <p><?php echo e($message->body); ?></p>
                <span class="text-[10px] opacity-70 block text-left mt-1">
                    <?php echo e($message->created_at->format('g:i A')); ?>

                </span>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
  <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0"/>
</svg>
            </div>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            <p class="text-gray-400 text-center m-auto">لا توجد رسائل في هذه المحادثة بعد.</p>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>

    
    <form class="flex gap-2 items-center bg-white p-2 rounded-xl border border-gray-200 shadow-sm"
        wire:submit.prevent="addMessage">
        <input type="text" value="<?php echo e($body); ?>"
        wire:model.defer="body"  required
            class="w-full border-0 focus:ring-0 focus:outline-none px-3 py-2 text-sm" placeholder="اكتب رسالة..." />

        <button type="submit"
            class="bg-[#79af9d] hover:bg-[#689989] text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
            إرسال
        </button>
    </form>

</div><?php /**PATH E:\Laravel-2026\forum\storage\framework\views/livewire/views/be7294c3.blade.php ENDPATH**/ ?>