<?php if(auth()->guard()->check()): ?>

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



    <div class="mt-4 p-4 border-t border-b pl-4 md:flex md:items-center gap-4 justify-between">
        <div class=" flex">
            <div class="flex">
                <div x-data="
                        { Liked : <?php echo e($post->isLikedByAuthUser() ? 'true' : 'false'); ?>,
                          Count : <?php echo e($post->likes_count ?? $post->likes()->count()); ?>}">
                    <button @click="
                            Liked = !Liked;
                            Liked ? Count++ : Count--;
                            axios.post('/<?php echo e($post->id); ?>/like').catch(()=>{
                            Liked = !Liked;
                            Liked ? Count++ : Count--;
                            alert('somthing went wrong');
                            })" type="button" class="flex items-center hover:scale-110 transition-transform">
                        

                        <img :src="Liked ? '<?php echo e(asset('images/thumb-2.png')); ?>' : '<?php echo e(asset('images/thumb-1.png')); ?>' "
                            alt="Liked" class="w-6 h-6 mr-2">

                        
                        <span class="text-sm font-bold " :class="Liked ? 'text-black-600' : 'text-gray-600' }}"
                            x-text="Count">
                        </span>
                    </button>
                </div>

            </div>
            <div class="flex items-center">
                <img src="<?php echo e(asset('images/comment.png')); ?>" alt="Comments" class="w-6 h-6 inline-block mx-2">
                <span class="text-sm font-medium">
                     
                    <p><?php echo e($post->comments?->count() ? $post->comments->count() : 0); ?></p>
                </span>
            </div>

        </div>
        <div class="flex">
            <?php if(!$post->isbookmarked()): ?>
                <form action="/<?php echo e($post->id); ?>/bookmark" method="post">
                    <?php echo csrf_field(); ?>
                    <button type="submit">
                        <img src="<?php echo e(asset('images/bookmark-2.png')); ?>" alt="Clap" class="w-6 h-6 inline-block mr-2">
                    </button>
                </form>
            <?php else: ?>
                <form action="/<?php echo e($post->id); ?>/unbookmark" method="post">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('delete'); ?>
                    <button type="submit">
                        <img src="<?php echo e(asset('images/bookmark-1.png')); ?>" alt="Clap" class="w-6 h-6 inline-block mr-2">
                    </button>
                </form>
            <?php endif; ?>


            <img src="<?php echo e(asset('images/share-8-240.png')); ?>" alt="Clap" class="w-6 h-6 inline-block mr-2">
            <img src="<?php echo e(asset('images/plus-lined-240.png')); ?>" alt="Clap" class="w-6 h-6 inline-block mr-2">
        </div>
    </div>

<?php endif; ?><?php /**PATH E:\Laravel-2026\forum\resources\views/components/engagement-bar.blade.php ENDPATH**/ ?>