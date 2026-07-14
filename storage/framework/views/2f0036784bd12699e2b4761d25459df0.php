<?php
use Livewire\Component;
use App\Models\Post;
use App\Models\Follow;
use App\Notifications\NewFollowerNotification;
?>

<div class="pl-4 md:flex md:items-center gap-4">
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($post->user?->avatar): ?>
        <img src="<?php echo e(Storage::url($post->user->avatar)); ?>" class="h-10 w-10 rounded-full mr-3">
    <?php else: ?>
        <img src="<?php echo e(asset('images/profile.png')); ?>" class="h-10 w-10 rounded-full mr-3">
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($post->user): ?>
        <a href="<?php echo e('/@' . $post->user->username); ?>">
            <h3><?php echo e($post->user->name); ?></h3>
        </a>
    <?php else: ?>
        <h3>مستخدم محذوف</h3>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->guard()->check()): ?>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($this->isDifferent()): ?>
            <form wire:submit.prevent="toggleFollow">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($this->isFollowing()): ?>
                    <button type="submit" class="text-sm text-red-500 hover:underline">إلغاء المتابعة</button>
                <?php else: ?>
                    <button type="submit" class="text-sm text-green-500 hover:underline">متابعة</button>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </form>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <div class="flex gap-2 text-sm text-gray-500">
        <?php echo e($post->readTime()); ?> دقيقة قراءة
        &middot;
        <?php echo e($post->created_at->format('M d, Y')); ?>

    </div>
</div><?php /**PATH E:\Laravel-2026\forum\storage\framework\views/livewire/views/0ecbf05f.blade.php ENDPATH**/ ?>