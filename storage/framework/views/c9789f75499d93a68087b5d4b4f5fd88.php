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
     <!-- Page Content -->
        <main class=" ">
            <div class="flex flex-col">
                 
                    <?php $__empty_1 = true; $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <?php if (isset($component)) { $__componentOriginalfb314f739d8d594f4055ce4bb169c909 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfb314f739d8d594f4055ce4bb169c909 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.post-item','data' => ['post' => $post]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('post-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['post' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($post)]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalfb314f739d8d594f4055ce4bb169c909)): ?>
<?php $attributes = $__attributesOriginalfb314f739d8d594f4055ce4bb169c909; ?>
<?php unset($__attributesOriginalfb314f739d8d594f4055ce4bb169c909); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalfb314f739d8d594f4055ce4bb169c909)): ?>
<?php $component = $__componentOriginalfb314f739d8d594f4055ce4bb169c909; ?>
<?php unset($__componentOriginalfb314f739d8d594f4055ce4bb169c909); ?>
<?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <div class="text-center text-gray-400 py-16">No Posts Found</div>
                    <?php endif; ?>
                
                
            </div>

        </main>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb6ae7b16225a8198d83db1c2d27f7827)): ?>
<?php $attributes = $__attributesOriginalb6ae7b16225a8198d83db1c2d27f7827; ?>
<?php unset($__attributesOriginalb6ae7b16225a8198d83db1c2d27f7827); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb6ae7b16225a8198d83db1c2d27f7827)): ?>
<?php $component = $__componentOriginalb6ae7b16225a8198d83db1c2d27f7827; ?>
<?php unset($__componentOriginalb6ae7b16225a8198d83db1c2d27f7827); ?>
<?php endif; ?><?php /**PATH E:\Laravel-2026\forum\resources\views/book/bookmarks.blade.php ENDPATH**/ ?>