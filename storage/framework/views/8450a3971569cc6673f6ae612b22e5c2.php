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
    <!-- 1. Moved x-data here so EVERYTHING inside can use Alpine variables -->
    <div x-data="{
        categories: <?php echo \Illuminate\Support\Js::from($categories)->toHtml() ?>,
        selectedCategory: '<?php echo e(request('category', '')); ?>',
        loading: false,

        get currentTitle() {
            if (!this.selectedCategory) return 'كل المنشورات';
            let category = this.categories.find(c => c.id == this.selectedCategory);
            return category ? category.name : 'كل المنشورات';
        },

        async filter(targetUrl = null) {
            this.loading = true;
            
            // If a custom URL is passed (from pagination), use it. Otherwise use current URL.
            let url = targetUrl ? new URL(targetUrl) : new URL(window.location.href);
            
            if (!targetUrl) {
                if (this.selectedCategory) {
                    url.searchParams.set('category', this.selectedCategory);
                } else {
                    url.searchParams.delete('category');
                }
                url.searchParams.delete('page'); // Reset page on dropdown change
            }

            try {
                const response = await fetch(url, {
                    headers: { 'X-Requested-With': 'XMLHttpRequest' }
                });
                const html = await response.text();

                // 2. Swaps the entire list AND the pagination links inside the container
                document.getElementById('posts-container').innerHTML = html;
                window.history.pushState({}, '', url);
            } catch (error) {
                console.error('Error fetching posts:', error);
            } finally {
                this.loading = false;
            }
        }
    }" class="w-full">

        <div class="h-20 w-auto flex items-center justify-between pl-5">
            <div class="flex items-center gap-10">
                <select x-model="selectedCategory" @change="filter()" class="rounded-md">
                    <option value="">كل المواضيع</option>
                    <template x-for="category in categories" :key="category.id">
                        <option :selected="category.id == selectedCategory" :value="category.id" x-text="category.name"></option>
                    </template>
                </select>
            </div>
            
            <!-- 3. Fixed: Added x-text so the title actually updates -->
            <h1 class="text-[#79af9d] text-4xl font-bold pr-5" x-text="currentTitle"></h1>
        </div>

        <!-- 4. Fixed: Added the container ID and a smooth loading fade effect -->
        <div id="posts-container" :class="loading ? 'opacity-50 transition-opacity' : 'transition-opacity'">
            <?php echo $__env->make('posts._list', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>

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
<?php endif; ?><?php /**PATH E:\Laravel-2026\forum\resources\views/posts/index.blade.php ENDPATH**/ ?>