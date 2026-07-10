<?php if (isset($component)) { $__componentOriginalb6ae7b16225a8198d83db1c2d27f7827 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb6ae7b16225a8198d83db1c2d27f7827 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.better','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('better'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <?php echo $__env->make('profile.partials.update-profile-information-form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <?php echo $__env->make('profile.partials.update-password-form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <?php echo $__env->make('profile.partials.delete-user-form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                </div>
            </div>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb6ae7b16225a8198d83db1c2d27f7827)): ?>
<?php $attributes = $__attributesOriginalb6ae7b16225a8198d83db1c2d27f7827; ?>
<?php unset($__attributesOriginalb6ae7b16225a8198d83db1c2d27f7827); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb6ae7b16225a8198d83db1c2d27f7827)): ?>
<?php $component = $__componentOriginalb6ae7b16225a8198d83db1c2d27f7827; ?>
<?php unset($__componentOriginalb6ae7b16225a8198d83db1c2d27f7827); ?>
<?php endif; ?>
<?php /**PATH E:\Laravel-2026\forum\resources\views/profile/edit.blade.php ENDPATH**/ ?>