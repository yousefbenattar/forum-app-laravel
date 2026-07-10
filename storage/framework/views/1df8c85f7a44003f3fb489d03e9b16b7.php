<?php
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;
use App\Models\Conversation;
use App\Models\User;
use App\Ai\Agents\ForumAssistant;
use Livewire\Attributes\On;
?>

<div>
    <div
        class="mt-2 fixed h-full flex bg-white border lg:shadow-sm overflow-hidden inset-0 lg:top-16 lg:inset-x-2 m-auto lg:h-[90%] rounded-lg">

        
        <div class="w-1/4 bg-white border-l border-gray-200 flex flex-col p-4 overflow-y-auto gap-2">
            <div class="flex justify-between items-center mb-4">
                <h4 class="font-bold text-gray-700 text-sm">المحادثات السابقة</h4>
                
                <button wire:click="$set('conversationId', null)"
                    class="text-xs text-[#79af9d] hover:underline font-medium">
                    محادثة جديدة +
                </button>
            </div>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($this->pastConversations) > 0): ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $this->pastConversations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <?php $chat = (array) $chat; ?>
                    <button wire:click="loadConversation('<?php echo e($chat['id']); ?>')" class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                        'w-full text-right p-3 text-xs rounded-xl transition-all border text-ellipsis overflow-hidden whitespace-nowrap',
                        'bg-[#eef6f3] border-[#79af9d] text-[#4d7568] font-medium shadow-sm' => $conversationId === $chat['id'],
                        'bg-gray-50 border-gray-100 text-gray-600 hover:bg-gray-100' => $conversationId !== $chat['id']
                    ]); ?>">
                        <?php echo e($chat['title'] ?? 'محادثة بدون عنوان'); ?>

                    </button>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            <?php else: ?>
                <p class="text-xs text-gray-400 text-center py-4">لا توجد محادثات سابقة بعد.</p>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
        
        <div class="relative hidden md:grid w-full border-l h-full overflow-y-auto" style="contain:content">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(true): ?>
                <?php if (isset($__component)) { $__componentOriginal = $__component; } ?>
<?php if (isset($__key)) { $__keyOriginal = $__key; } ?>
<?php if (isset($__attributes)) { $__attributesOriginal = $__attributes; } ?>
<?php if (isset($__slots)) { $__slotsOriginal = $__slots; } ?>
<?php $__component = 'pages::chat_ai.chat-box'; ?>
<?php $__key = null; ?>
<?php $__attributes = ['conversationId' => $conversationId]; ?>
<?php $__slots = []; ?>
<?php ob_start(); ?>
<?php $__slots['default'] = ob_get_clean(); ?>
<?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split($__component, $__attributes);

$__keyOuter = $__key ?? null;

$__key = $__key;
$__componentSlots = $__slots ?? [];

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-1171615131-0', $__key);

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
<?php if (isset($__componentOriginal)) { $__component = $__componentOriginal; unset($__componentOriginal); } ?>
<?php if (isset($__keyOriginal)) { $__key = $__keyOriginal; unset($__keyOriginal); } ?>
<?php if (isset($__attributesOriginal)) { $__attributes = $__attributesOriginal; unset($__attributesOriginal); } ?>
<?php if (isset($__slotsOriginal)) { $__slots = $__slotsOriginal; unset($__slotsOriginal); } ?>

            <?php else: ?>
                <div class="m-auto text-center justify-center flex flex-col gap-3">
                    <h3 class="font-medium text-lg text-gray-400">إسأل أي شيء</h3>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>

    </div>
</div><?php /**PATH E:\Laravel-2026\forum\storage\framework\views/livewire/views/fc4474c2.blade.php ENDPATH**/ ?>