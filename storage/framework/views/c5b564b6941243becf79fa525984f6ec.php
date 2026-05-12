<!-- <div class="flex-col px-10 mt-10">
     <?php
        $osactive = request()->is("/");
    ?>
    <a href="/"><p class="<?php echo e($osactive ? 'text-[#79af9d] text-2xl' : ''); ?>">All</p>
</a>
    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
            $isactive = request()->is("category/" . $category['id']);
        ?>
            <div class="flex-col">
                <a href="/category/<?php echo e($category['id']); ?>">
                    <p class="text-black <?php echo e($isactive ? 'text-[#79af9d] text-xl' : ''); ?>  cursor-pointer"><?php echo e($category['name']); ?></p>
                </a>

            </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>  -->


<div class="min-h-screen bg-white p-8 text-gray-400 font-sans">
    <h2 class="mb-4 text-sm font-semibold uppercase tracking-wider text-gray-500">Categories</h2>

    <nav x-data="{ activeId: null }" class="flex flex-col space-y-1 border-l border-gray-800">

        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="/category/<?php echo e($category->id); ?>"
            @click="activeId = <?php echo e($category->id); ?>"
            :class="activeId === <?php echo e($category->id); ?> ? ' border-l-2 border-[##79af9d] text-blue-400' : 'border-l-2 border-[##79af9d] text-gray-400'"
           class="block py-2 pl-6 border-l-2 font-medium transition-all">
                <?php echo e($category->name); ?>

            </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </nav>
</div><?php /**PATH E:\Laravel-2026\forum\resources\views/components/side-bar.blade.php ENDPATH**/ ?>