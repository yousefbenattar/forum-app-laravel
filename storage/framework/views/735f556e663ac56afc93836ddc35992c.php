<?php
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use App\Ai\Agents\ForumAssistant;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Reactive;
?>

<div class="p-4 flex flex-col justify-between bg-gray-50 h-full max-h-[85vh]">

    
    <div x-data="{}" x-init="" class="flex flex-col gap-2 overflow-y-auto mb-4 p-2 grow">


        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($conversationId): ?>
            


            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $this->messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                <p class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                    'ml-auto bg-emerald-100 p-2 rounded-lg max-w-[75%]' => $message['role'] == 'user',
                    'mr-auto bg-white p-2 rounded-lg max-w-[75%] border border-gray-200' => $message['role'] == 'assistant',
                ]); ?>">
                <?php echo e(is_string($message['content']) ? $message['content'] : json_encode($message['content'])); ?>

                </p>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
        <?php else: ?>
            <h3 class="font-medium flex items-center justify-center text-lg text-gray-400">إبدء محادثة جديدة</h3>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    </div>

    
    <form class="flex gap-2 items-center bg-white p-2 rounded-xl border border-gray-200 shadow-sm"
        wire:submit.prevent="submitMessage">
        <input type="text" wire:model="message" required
            class="w-full border-0 focus:ring-0 focus:outline-none px-3 py-2 text-sm" placeholder="اكتب رسالة..." />
        <button type="submit"
            class="bg-[#79af9d] hover:bg-[#689989] text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
            إرسال
        </button>
    </form>
</div><?php /**PATH E:\Laravel-2026\forum\storage\framework\views/livewire/views/46abdddd.blade.php ENDPATH**/ ?>