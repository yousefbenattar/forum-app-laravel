<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['videos']));

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

foreach (array_filter((['videos']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>




<div class="min-h-screen bg-white p-8 text-black font-sans">
    <h2 class="justify-items-right w-full">أحدث مقاطعنا 👇</h2>
    <?php $__currentLoopData = $videos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $video): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="video-item border border-black rounded-md p-2 my-2">
            <a href="https://www.youtube.com/watch?v=<?php echo e($video['id']['videoId']); ?>" target="_blank">
                <img src="<?php echo e($video['snippet']['thumbnails']['medium']['url']); ?>" alt="<?php echo e($video['snippet']['title']); ?>">
                <p><?php echo e($video['snippet']['title']); ?></p>
            </a>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div><?php /**PATH E:\Laravel-2026\forum\resources\views/components/left-side-bar.blade.php ENDPATH**/ ?>