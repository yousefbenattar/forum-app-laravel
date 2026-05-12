<div class="pl-4 md:flex md:items-center gap-4">
    <img src="<?php echo e(Storage::url($post->user->avatar)); ?>" class="h-10 w-10 rounded-full mr-3">
    <a href="<?php echo e('/@' . $post->user->username); ?>">
        <h3><?php echo e($post->user->name); ?></h3>
    </a>
    
    <?php if(auth()->guard()->check()): ?>
        <?php if(Auth::id() !== $post->user->id): ?>

        
        <?php if(Auth::user()->following->contains($post->user->id)): ?>
            
            <form action="/unfollow/<?php echo e($post->user->id); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <?php echo method_field('DELETE'); ?>
                <button type="submit" class="text-sm text-red-500 hover:underline">Unfollow</button>
            </form>
        <?php else: ?>
            
            <form action="/follow/<?php echo e($post->user->id); ?>" method="post">
                <?php echo csrf_field(); ?>
                <button type="submit" class="text-sm text-green-500 hover:underline">Follow</button>
            </form>
        <?php endif; ?>

    <?php endif; ?>
    <?php endif; ?>


    <div class="flex gap-2 text-sm text-gray-500">
        <?php echo e($post->readTime()); ?> min read
        &middot;
        <?php echo e($post->created_at->format('M d, Y')); ?>

    </div>
</div><?php /**PATH E:\Laravel-2026\forum\resources\views/components/user-card.blade.php ENDPATH**/ ?>