<div
    <?php echo e($attributes
            ->merge([
                'id' => $getId(),
            ], escape: false)
            ->merge($getExtraAttributes(), escape: false)); ?>

>
    <?php echo e($getChildSchema()); ?>

</div>
<?php /**PATH E:\Laravel-2026\forum\vendor\filament\schemas\resources\views/components/grid.blade.php ENDPATH**/ ?>