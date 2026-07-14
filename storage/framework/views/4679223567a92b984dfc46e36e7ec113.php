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
                <div x-cloak x-show="openUserMenu" @click.outside="openUserMenu = false" x-transition
                    class="absolute z-50 left-0 mt-2 bg-white shadow-lg rounded-md flex flex-col w-max">
                    <ul class="p-2">

                        <li>
                            <a href="<?php echo e('/@' . $this->user->username); ?>"
                                class="flex items-center gap-2 p-2 hover:bg-gray-200 w-full rounded-md">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-person-fill" viewBox="0 0 16 16">
                                    <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
                                </svg>
                                <p>عرض بروفايل</p>
                            </a>

                        </li>

                        <li class="flex items-center gap-2 p-2 hover:bg-gray-200 w-full rounded-md">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-pen" viewBox="0 0 16 16">
                                <path
                                    d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001m-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708z" />
                            </svg>
                            <p>تعديل</p>
                        </li>
                        <li>
                            <div x-data="{
                            showDeleteModal : false,
                            }">
                                <button @click="showDeleteModal = true" @click.outside="showDeleteModal = false"
                                    x-transition
                                    class="flex items-center gap-2 p-2 hover:bg-gray-200 w-full rounded-md">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-trash" viewBox="0 0 16 16">
                                        <path
                                            d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                                        <path
                                            d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
                                    </svg>
                                    <p>
                                        حذف
                                    </p>
                                </button>
                                <div x-show="showDeleteModal">
                                    <div class="fixed inset-0 z-40 h-full w-full bg-black/50 backdrop-blur-sm"></div>
                                    <div class="fixed inset-0 z-50 flex items-center justify-center">
                                        <div class="flex flex-col gap-6 items-center p-6 rounded-md bg-white ">
                                            <p>هل أنت متأكد من أنك تريد مسح هذه الحساب من قاعدة البيانات ؟</p>

                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($this->user->avatar): ?>
                                                <img class="h-14 w-14 border rounded-full"
                                                    src="<?php echo e(Storage::url($this->user->avatar)); ?>">
                                            <?php else: ?>
                                                <img class="h-14 w-14 border rounded-full"
                                                    src="<?php echo e(asset('images/profile.png')); ?>">
                                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                            <div class="flex flex-col items-center gap-2">
                                                <strong><?php echo e($this->user->name); ?></strong>
                                                <strong><?php echo e($this->user->email); ?></strong>
                                            </div>
                                            <div class="w-full flex justify-between text-white text-strong">
                                                <form wire:submit="deleteUser">
                                                    <button type="submit"
                                                        class="py-3 px-5 bg-red-600 rounded-md">مسح</button>
                                                </form>
                                                <button @click="showDeleteModal = false"
                                                    class="py-3 px-5 bg-green-600 rounded-md">إلغاء</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </li>
                        <li class="flex items-center gap-2 p-2 hover:bg-gray-200 w-full rounded-md">
                            <div x-data="{showAdminModal : false}">
                                <button @click="showAdminModal = true" @click.outside="showAdminModal = false">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($this->user->hasRole('admin')): ?>
                                        <div class="flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-person-dash" viewBox="0 0 16 16">
                                                <path
                                                    d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7M11 12h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1 0-1m0-7a3 3 0 1 1-6 0 3 3 0 0 1 6 0M8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4" />
                                                <path
                                                    d="M8.256 14a4.5 4.5 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10q.39 0 .74.025c.226-.341.496-.65.804-.918Q8.844 9.002 8 9c-5 0-6 3-6 4s1 1 1 1z" />
                                            </svg>
                                            <p>إزالة أدمن</p>
                                        </div>

                                    <?php else: ?>
                                        <div class="flex items-center gap-2">
                                            <?php if (isset($component)) { $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c = $attributes; } ?>
<?php $component = BladeUI\Icons\Components\Svg::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('clarity-administrator-line'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\BladeUI\Icons\Components\Svg::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'h-6 w-6']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c)): ?>
<?php $attributes = $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c; ?>
<?php unset($__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal643fe1b47aec0b76658e1a0200b34b2c)): ?>
<?php $component = $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c; ?>
<?php unset($__componentOriginal643fe1b47aec0b76658e1a0200b34b2c); ?>
<?php endif; ?>
                                            <p>إضافة أدمن</p>
                                        </div>

                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </button>
                                <div x-show="showAdminModal">
                                    <div class="fixed inset-0 z-40 h-full w-full bg-black/50 backdrop-blur-sm"></div>
                                    <div class="fixed inset-0 z-50 flex items-center justify-center">
                                        <div class="flex flex-col items-center gap-4 bg-white rounded-md p-7">
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($this->user->hasRole('admin')): ?>
                                                <p>هل أنت متأكد من أنك تريد إزالته من أدمن ؟</p>
                                            <?php else: ?>
                                               
                                               <p>هل أنت متأكد من أنك تريد ترقيته إلى أدمن ؟</p>
                                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                        

                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($this->user->avatar): ?>
                                                <img class="h-14 w-14 border rounded-full"
                                                    src="<?php echo e(Storage::url($this->user->avatar)); ?>">
                                            <?php else: ?>
                                                <img class="h-14 w-14 border rounded-full"
                                                    src="<?php echo e(asset('images/profile.png')); ?>">
                                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                            <div class="flex flex-col items-center gap-2">
                                                <strong><?php echo e($this->user->name); ?></strong>
                                                <strong><?php echo e($this->user->email); ?></strong>
                                            </div>
                                            <div class="w-full flex justify-between text-white text-strong">
                                                <form wire:submit="toggelAdmin">
                                                    <button type="submit"
                                                        class="py-3 px-5 bg-red-600 rounded-md">
                                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($this->user->hasRole('admin')): ?>
                                                <p>إزالة</p>
                                            <?php else: ?>
                                               
                                               <p>إجعله أدمن</p>
                                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                                    </button>
                                                </form>
                                                <button @click="showDeleteModal = false"
                                                    class="py-3 px-5 bg-green-600 rounded-md">إلغاء</button>
                                            </div>
                                        </div>
                                       
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="flex items-center gap-2 p-2 hover:bg-gray-200 w-full rounded-md">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($this->user->hasRole('banned')): ?>
                                <button class="flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-check-circle" viewBox="0 0 16 16">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                                        <path
                                            d="m10.97 4.97-.02.022-3.473 4.425-2.093-2.094a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05" />
                                    </svg>
                                    <p> إلغاءالبان</p>
                                </button>
                            <?php else: ?>
                                <button class="flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-ban" viewBox="0 0 16 16">
                                        <path
                                            d="M15 8a6.97 6.97 0 0 0-1.71-4.584l-9.874 9.875A7 7 0 0 0 15 8M2.71 12.584l9.874-9.875a7 7 0 0 0-9.874 9.874ZM16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0" />
                                    </svg>
                                    <p>تبنيد</p>

                                </button>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </li>


                    </ul>
                </div>
            </div>

        </div>

    </div>



</div><?php /**PATH E:\Laravel-2026\forum\storage\framework\views/livewire/views/3b884740.blade.php ENDPATH**/ ?>