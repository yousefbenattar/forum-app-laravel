<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'Laravel')); ?></title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-white dark:bg-gray-400">
        <?php echo $__env->make('layouts.navigation', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <!-- Page Heading -->
        <?php if(isset($header)): ?>
            <header class="bg-[#79af9d] dark:bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <?php echo e($header); ?>

                </div>
            </header>
        <?php endif; ?>

        <!-- Page Content -->
        <main class=" ">
            <div class="flex ">
                <div class="w-1/6">
                    
                </div>
                <div class="w-4/6">
                    <?php echo e($slot); ?>

                </div>
                <div class="w-1/6">
                    <?php if (isset($component)) { $__componentOriginal132d8c9b35c256fe36637b5b175f781a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal132d8c9b35c256fe36637b5b175f781a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.right-side-bar','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('right-side-bar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal132d8c9b35c256fe36637b5b175f781a)): ?>
<?php $attributes = $__attributesOriginal132d8c9b35c256fe36637b5b175f781a; ?>
<?php unset($__attributesOriginal132d8c9b35c256fe36637b5b175f781a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal132d8c9b35c256fe36637b5b175f781a)): ?>
<?php $component = $__componentOriginal132d8c9b35c256fe36637b5b175f781a; ?>
<?php unset($__componentOriginal132d8c9b35c256fe36637b5b175f781a); ?>
<?php endif; ?>
                </div>
            </div>
        </main>
    </div>
</body>

</html><?php /**PATH E:\Laravel-2026\forum\resources\views/layouts/app.blade.php ENDPATH**/ ?>