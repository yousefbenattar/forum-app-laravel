<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['user']));

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

foreach (array_filter((['user']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<div class="flex-col pr-6 mt-10 mr-6">
     
    <div class="flex flex-col gap-4">
        <?php $__currentLoopData = $user->following; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $followedUser): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <img src="<?php echo e(Storage::url($followedUser->avatar)); ?>" class="h-10 w-10 rounded-full mr-3">
                    <a href="/users/<?php echo e($followedUser->username); ?>">
                        <h3><?php echo e($followedUser->name); ?></h3>
                    </a>
                </div>

                <?php if(auth()->guard()->check()): ?>
                    
                    <?php if(Auth::id() !== $followedUser->id): ?>
                        <?php if(Auth::user()->following->contains($followedUser->id)): ?>
                            <form action="/unfollow/<?php echo e($followedUser->id); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="text-sm text-red-500 hover:underline">Unfollow</button>
                            </form>
                        <?php else: ?>
                            <form action="/follow/<?php echo e($followedUser->id); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="text-sm text-green-500 hover:underline">Follow</button>
                            </form>
                        <?php endif; ?>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
<?php /**PATH E:\Laravel-2026\forum\resources\views/components/following.blade.php ENDPATH**/ ?>