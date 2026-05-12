<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['post']));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['post']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php if(auth()->guard()->check()): ?>
    <!-- Clap Section -->
    <div class="mt-4 p-4 border-t border-b pl-4 md:flex md:items-center gap-4 justify-between">
        <div class=" ">

            <img src="<?php echo e(asset('images/thumb-1-240.png')); ?>" alt="Clap" class="w-6 h-6 inline-block mr-2">
            1
            <img src="<?php echo e(asset('images/comment.png')); ?>" alt="Clap" class="w-6 h-6 inline-block mr-2">
            82

        </div>
        <div>
            <img src="<?php echo e(asset('images/bookmark-2-240.png')); ?>" alt="Clap" class="w-6 h-6 inline-block mr-2">
            <img src="<?php echo e(asset('images/share-8-240.png')); ?>" alt="Clap" class="w-6 h-6 inline-block mr-2">
            <img src="<?php echo e(asset('images/plus-lined-240.png')); ?>" alt="Clap" class="w-6 h-6 inline-block mr-2">
        </div>
    </div>
    <!-- Clap Section -->
<?php endif; ?><?php /**PATH E:\Laravel-2026\forum\resources\views/components/like-button.blade.php ENDPATH**/ ?>