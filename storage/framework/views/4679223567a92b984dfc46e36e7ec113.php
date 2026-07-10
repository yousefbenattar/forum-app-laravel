<?php
use Livewire\Component;
use App\Models\User;
?>

<div>
    <div class="flex gap-2 items-center justify-between my-2 text-sm    rounded-md  ">
        <div class="flex w-1/5 items-center gap-2">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($this->user->avatar): ?>
                <img class="h-14 w-14 border rounded-full" src="<?php echo e(Storage::url($this->user->avatar)); ?>">
            <?php else: ?>
                <img class="h-14 w-14 border rounded-full" src="<?php echo e(asset('images/profile.png')); ?>">
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <div class="flex flex-col items-start gap-2">
                <strong><?php echo e($this->user->name); ?></strong>
                <strong><?php echo e($this->user->email); ?></strong>
            </div>
        </div>
        <div class=" w-1/5 pr-8">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($this->user->hasRole('admin')): ?>
                <strong class="text-white bg-green-600 rounded-full p-2">أدمن</strong>
            <?php else: ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($this->user->hasRole('banned')): ?>
                    <strong class="text-white bg-red-600 rounded-full p-2">محظور</strong>
                <?php else: ?>
                    <strong class="text-white bg-blue-600 rounded-full p-2">مستخدم</strong>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>


        <strong class="w-1/5 "><?php echo e($this->user->created_at->format('Y-m-d')); ?></strong>
        <div class=" flex items-start w-1/5">

            <strong class="<?php echo \Illuminate\Support\Arr::toCssClasses([

                'text-white bg-green-600 rounded-full p-2' => $this->user->email_verified_at,
                'text-white bg-red-600 rounded-full p-2' => !$this->user->email_verified_at,

            ]); ?>">
                <?php echo e($this->user->email_verified_at ? 'مؤكد' : 'غير مؤكد'); ?>

            </strong>

        </div>

        <div class="w-1/5 flex justify-between items-center">
            <strong><?php echo e($this->user->created_at->format('Y-m-d')); ?></strong>
            <div x-data="{ openUserMenu: false }" class="pl-2 relative">

                <button @click="openUserMenu = !openUserMenu">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                        <path
                            d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0" />
                    </svg>
                </button>
                <div x-show="openUserMenu" @click.outside="openUserMenu = false" x-transition
                    class="absolute z-50 left-0 mt-2 bg-white shadow-lg rounded-md flex flex-col w-max">
                    <ul class="p-4">
                        <li><button>عرض الملف الشخصي</button></li>

                        <li><button>تعديل</button></li>
                        <li><button>حذف</button></li>
                        <li>
                            <button>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($this->user->hasRole('admin')): ?>
                                    إزالة دور الأدمن
                                <?php else: ?>
                                    إضافة دور الأدمن
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </button>
                        </li>
                        <li>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($this->user->hasRole('banned')): ?>
                                <button>إلغاءالبان</button>
                            <?php else: ?>
                                <button>تبنيد</button>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </li>


                    </ul>
                </div>
            </div>

        </div>

    </div>
</div><?php /**PATH E:\Laravel-2026\forum\storage\framework\views/livewire/views/3b884740.blade.php ENDPATH**/ ?>