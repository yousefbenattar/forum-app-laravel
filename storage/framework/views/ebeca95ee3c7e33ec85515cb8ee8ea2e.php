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
<div class="flex-col bg:gray-200 mt-10">
        <img src="<?php echo e($user->avatar ? Storage::url($user->avatar) : asset('images/profile.png')); ?>"
        class="h-20">
    <h3 class="mt-6"><?php echo e($user->followers?->count() ? $user->followers->count() . ' followers' : ''); ?>

    </h3>
    <h2 class="text-xl font-bold"><?php echo e($user->name ?? 'User'); ?></h2>
    <p class="text-xs text-black-400 font-mono"><?php echo e($user->email ?? ''); ?></p>

    <p class="mt-6"> <?php echo e($user->bio); ?> </p>



    <?php if(Auth::id() == $user->id): ?>
        <a href=" <?php echo e(route('profile.edit')); ?>"><button class="bg-[#79af9d] text-white px-4 py-2 rounded-lg my-2">Edit</button></a>
    <?php else: ?>
        <?php if(auth()->guard()->check()): ?>
            <?php if(Auth::id() !== $user->id): ?>
                
                <?php if(Auth::user()->following->contains($user->id)): ?>
                    
                    <form action="/unfollow/<?php echo e($user->id); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="text-sm text-red-500 hover:underline">Unfollow</button>
                    </form>
                <?php else: ?>
                    
                    <form action="/follow/<?php echo e($user->id); ?>" method="post">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="text-sm text-green-500 hover:underline">Follow</button>
                    </form>
                <?php endif; ?>
            <?php endif; ?>
        <?php endif; ?>
    <?php endif; ?>
</div><?php /**PATH E:\Laravel-2026\forum\resources\views/components/profile_section.blade.php ENDPATH**/ ?>