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
    <div>

        <div class="h-20 w-auto flex items-center justify-between pl-5">
            <div x-data="{
            stats: <?php echo \Illuminate\Support\Js::from($stats)->toHtml() ?>, 
            categories: <?php echo \Illuminate\Support\Js::from($categories)->toHtml() ?>,
            selectedstat :'<?php echo e(request('type')); ?>',
            selectedCategory: '<?php echo e(request('category')); ?>',
            filter() {
           let params = new URLSearchParams(window.location.search);
        if (this.selectedCategory) {
            params.set('category', this.selectedCategory);
        } else {
            params.delete('category');
        }
        params.delete('page');
        window.location.search = params.toString();
             }
      }" class="flex items-center  gap-10">
                

                <!-- Select 2: Topics (Categories) -->
                <select x-model="selectedCategory" @change="filter()" class="rounded-md">
                    <option value="">كل المواضيع</option>
                    <template x-for="category in categories" :key="category.id">
                        <!-- Alpine will automatically select this option if category.id == selectedCategory -->
                        <option :selected="category.id == selectedCategory" :value="category.id" x-text="category.name">
                        </option>
                    </template>
                </select>
            </div>
            <h1 class="text-[#79af9d] text-4xl font-bold pr-5">كل المنشورات</h1>
        </div>
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
            <div class="text-center text-gray-400 py-16">لم يتم العثور على أي منشورات</div>
        <?php endif; ?>
    </div>

    <?php echo e($posts->links()); ?>

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?><?php /**PATH E:\Laravel-2026\forum\resources\views/posts/index.blade.php ENDPATH**/ ?>