<?php
use Livewire\Component;
use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
?>

<div x-data="{
showFilters: false,

}" class="p-4 ">
    <h2>المستخدمين</h2>
    <div class="flex gap-2 items-center my-2 justify-between">
        <div class="flex">
            <p>المستخدمون</p>
            <p>(<?php echo e($this->getusers()->total()); ?>)</p>
        </div>

        <div class="flex gap-2 items-center text-lg">
            <input wire:model.live="query" type="text" placeholder="ابحث عن مستخدم"
                class="border border-gray-300 rounded-md px-2 py-1">
            <div class="flex items-center gap-2">

                <div class="flex items-center gap-1 p-1 rounded-md">
                    <p>أضف</p>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-plus-square" viewBox="0 0 16 16">
                        <path
                            d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z" />
                        <path
                            d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
                    </svg>
                </div>
            </div>
        </div>
    </div>
    <div class="flex gap-2 items-center my-2 justify-between text-sm bg-gray-200 p-2 rounded-md">

        <strong class="w-1/5">إسم المستخدم</strong>
        <strong class="w-1/5  pr-8">الدور</strong>
        <strong class="w-1/5">تاريخ الإنضمام</strong>
        <strong class="w-1/5">البريد الإلكتروني</strong>
        <strong class="w-1/5">أخر تفاعل</strong>

    </div>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $this->getusers(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
        <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('pages::admin.user', ['user' => $user]);

$__keyOuter = $__key ?? null;

$__key = $user->id;
$__componentSlots = [];

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-1513983688-0', $__key);

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
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>

    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <?php echo e($this->getusers()->links()); ?>

</div><?php /**PATH E:\Laravel-2026\forum\storage\framework\views/livewire/views/98038b18.blade.php ENDPATH**/ ?>