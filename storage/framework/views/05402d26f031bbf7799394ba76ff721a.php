<?php
use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\User;
use App\Models\AdminLog;
?>

<div class="flex flex-col p-4 gap-2">

    <p>سجل نشاطات الأدمنز :</p>

    <div class="flex items-center gap-4">
        <input wire:model.live="query" type="text" placeholder="ابحث"
            class="border border-gray-300 rounded-md px-2 py-1">
        <div class="flex items-center gap-1 text-sm">
            <p>تاريخ البدء</p>
            <input wire:model.live="date" type="date" class="border rounded p-2">
        </div>
 
         <select wire:model.live="user_id" class="overflow-auto border border-gray-300 rounded-md ">
            <option default value="">كل الأدمن</option>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $this->getAdmins(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $admin): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                <option value="<?php echo e($admin->id); ?>"><?php echo e($admin->name); ?></option>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    <option value="">لا يوجد أدمن</option>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
         </select>

    </div>
    <div class="flex items-center gap-2 text-sm font-bold border-b border-gray-600 bg-gray-100 py-2">
        <div class="w-1/6">الأدمن</div>
        <div class="w-2/6">الفعل</div>
        <div class="w-2/6">السبب </div>
        <div class="w-1/6">تاريخ الإنشاء</div>
     
    </div>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $this->getLogs(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
        <div class="flex items-center gap-2 text-sm font-bold border-b border-gray-600 bg-gray-100 py-2">
        <div class="w-1/6 flex items-center gap-2">
            <img src="<?php echo e($this->getadmin($log->user_id)->avatar ? Storage::url($this->getadmin($log->user_id)->avatar) : asset('images/profile.png')); ?>" 
            
            class="h-10 w-10 rounded-full">
            <?php echo e($this->getadmin($log->user_id)->name ?? 'N/A'); ?>

        </div>
        <div class="w-2/6"><?php echo e($log->action); ?></div>
        <div class="w-2/6"><?php echo e($log->reason); ?> </div>
        <div class="w-1/6"><?php echo e($log->created_at->format('Y-m-d')); ?></div>
    </div>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
        <P>لا شيء</P>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</div><?php /**PATH E:\Laravel-2026\forum\storage\framework\views/livewire/views/20e2dab6.blade.php ENDPATH**/ ?>