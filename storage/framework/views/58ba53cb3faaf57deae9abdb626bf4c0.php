
<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <div class="max-w-4xl mx-auto py-12 px-4" dir="rtl">
        
        <h1 class="text-3xl font-bold text-gray-900 mb-2">نتائج البحث</h1>
        <p class="text-gray-600 mb-8">
            نتائج البحث عن الكلمة المفتاحية: <span class="font-semibold text-emerald-600">"<?php echo e($query); ?>"</span>
        </p>

        <?php if($posts->count() > 0): ?>
            <div class="space-y-6">
                <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href=""><?php if (isset($component)) { $__componentOriginalfb314f739d8d594f4055ce4bb169c909 = $component; } ?>
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
<?php endif; ?></a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <div class="mt-8">
                <?php echo e($posts->appends(['q' => $query])->links()); ?>

            </div>
        <?php else: ?>
            <div class="text-center py-12 bg-white rounded-xl border border-dashed border-gray-200">
                <p class="text-xl text-gray-500 font-medium">عذراً، لم نجد أي نتائج تطابق بحثك.</p>
                <p class="text-gray-400 text-sm mt-2">جرب البحث بكلمات مختلفة أو أكثر عمومية.</p>
            </div>
        <?php endif; ?>

    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?><?php /**PATH E:\Laravel-2026\forum\resources\views/search-results.blade.php ENDPATH**/ ?>