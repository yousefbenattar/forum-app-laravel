<?php
use Livewire\Component;
use App\Models\Conversation;
use App\Models\User;
use App\Events\MessageSent;
use App\Events\MessageRead;
use App\Models\Message;
use Livewire\Attributes\On;
?>

<div class="p-4 flex flex-col justify-between bg-gray-50 h-full max-h-[85vh]">

    
    <div x-data="{ scrollToBottom () {$el.scrollTop = $el.scrollHeight;} }" x-init="scrollToBottom()"
        @scroll-to-bottom.window="$nextTick(() => scrollToBottom())"
        class="flex flex-col gap-2 overflow-y-auto mb-4 p-2 grow">

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $this->getMessages(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
            
            <div <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::$currentLoop['key'] = 'msg-container-'.e($message->id).''; ?>wire:key="msg-container-<?php echo e($message->id); ?>" class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                'p-2 rounded-lg max-w-[80%] border shadow-sm',
                'bg-[#79af9d] text-white ml-auto' => $message->sender_id === auth()->id(),
                'bg-white text-gray-800 mr-auto' => $message->sender_id !== auth()->id()
            ]); ?>">
                <p><?php echo e($message->body); ?></p>
                <span class="text-[10px] opacity-70 block text-left mt-1">
                    <?php echo e($message->created_at->format('g:i A')); ?>

                </span>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($message->sender_id === auth()->id()): ?>
                    <div class="flex items-center justify-between gap-2 mt-1">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($message->read_at): ?>
                            <svg class="color-white" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-check-all text-sky-200" viewBox="0 0 16 16">
                                <path
                                    d="M8.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L2.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093L8.95 4.992zm-.92 5.14.92.92a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 1 0-1.091-1.028L9.477 9.417l-.485-.486z" />
                            </svg>
                        <?php else: ?>
                            <svg class="color-white" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-check opacity-70" viewBox="0 0 16 16">
                                <path
                                    d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425z" />
                            </svg>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        <div x-data="{ toggle: false }" class="relative inline-block">
                            <svg @click="toggle = !toggle" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                fill="currentColor"
                                class="bi bi-three-dots-vertical text-white cursor-pointer hover:text-gray-600 transition-colors"
                                viewBox="0 0 16 16">
                                <path
                                    d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0" />
                            </svg>

                            
                            <div x-show="toggle" @click.away="toggle = false"
                                x-transition:enter="transition ease-out duration-100"
                                x-transition:enter-start="transform opacity-0 scale-95"
                                x-transition:enter-end="transform opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-75"
                                x-transition:leave-start="transform opacity-100 scale-100"
                                x-transition:leave-end="transform opacity-0 scale-95"
                                class="absolute z-50 right-0 mt-1 w-32 bg-white rounded-md border border-gray-200 shadow-lg py-1">

                                <form wire:submit.prevent="deleteMessage(<?php echo e($message->id); ?>)">
                                    <button @click="toggle = false"
                                        class="w-full text-right px-4 py-2 text-xs text-black hover:bg-red-50 transition-colors">
                                        حذف
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="flex items-center justify-between gap-2 mt-1">
                        <div></div>
                        <div x-data="{ toggle: false }" class="relative inline-block">
                            <svg @click="toggle = !toggle" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                fill="currentColor"
                                class="bi bi-three-dots-vertical text-gray-400 cursor-pointer hover:text-gray-600 transition-colors"
                                viewBox="0 0 16 16">
                                <path
                                    d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0" />
                            </svg>

                            <div x-show="toggle" @click.away="toggle = false"
                                x-transition:enter="transition ease-out duration-100"
                                x-transition:enter-start="transform opacity-0 scale-95"
                                x-transition:enter-end="transform opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-75"
                                x-transition:leave-start="transform opacity-100 scale-100"
                                x-transition:leave-end="transform opacity-0 scale-95"
                                class="absolute z-50 left-0 mt-1 w-32 bg-white rounded-md border border-gray-200 shadow-lg py-1">

                                <form wire:submit.prevent="deleteMessage(<?php echo e($message->id); ?>)">
                                    <button @click="toggle = false"
                                        class="w-full text-right px-4 py-2 text-xs text-black hover:bg-red-50 transition-colors">
                                        حذف
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            <p class="text-gray-400 text-center m-auto">لا توجد رسائل في هذه المحادثة بعد.</p>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>

    
    <form class="flex gap-2 items-center bg-white p-2 rounded-xl border border-gray-200 shadow-sm"
        wire:submit.prevent="addMessage">
        <input type="text" value="<?php echo e($body); ?>" wire:model="body" required
            class="w-full border-0 focus:ring-0 focus:outline-none px-3 py-2 text-sm" placeholder="اكتب رسالة..." />
        <button type="submit"
            class="bg-[#79af9d] hover:bg-[#689989] text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
            إرسال
        </button>
    </form>
</div><?php /**PATH E:\Laravel-2026\forum\storage\framework\views/livewire/views/be7294c3.blade.php ENDPATH**/ ?>