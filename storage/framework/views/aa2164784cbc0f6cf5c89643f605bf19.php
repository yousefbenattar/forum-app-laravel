<?php
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;
?>

<div>
<div
    class="mt-2 fixed h-full flex bg-white border lg:shadow-sm overflow-hidden inset-0 lg:top-16 lg:inset-x-2 m-auto lg:h-[90%] rounded-lg">
    
    <div class="relative hidden md:grid w-full border-l h-full overflow-y-auto" style="contain:content">
        <div class="m-auto text-center justify-center flex flex-col gap-3">
            <h3 class="front-medium text-lg">اختر محادثة لبدء الدردشة</h3>
        </div>
    </div>
    <div class="relative w-full md:w-[320px] xl:w-[480px] overflow-y-auto shrink-0 h-full border">
     <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('pages::chat.chat-list', []);

$__keyOuter = $__key ?? null;

$__key = null;
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
    </div>
</div>
</div><?php /**PATH E:\Laravel-2026\forum\storage\framework\views/livewire/views/726eed0d.blade.php ENDPATH**/ ?>