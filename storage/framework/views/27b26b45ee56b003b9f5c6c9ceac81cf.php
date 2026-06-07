  <template x-teleport="body">
        <div>
            <div x-show="sidebarOpen" x-transition.opacity @click="sidebarOpen = false"
                class="fixed inset-0 bg-black/50 backdrop-blur-sm z-40">
            </div>

            <div x-show="sidebarOpen"
                 
                class="fixed inset-y-0 left-0 w-60 bg-[#79af9d] text-white z-50 p-6 shadow-2xl">

                <div class="flex flex-col justify-end h-full">
                    <div class="mb-8">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->guard()->check()): ?>
                            <div>
                                <img class="h-20"
                                    src="<?php echo e(auth()->user()->avatar ? Storage::url(auth()->user()->avatar) : asset("images/profile.png")); ?>" />
                            </div>

                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <div>
                            <h2 class="text-xl font-bold"><?php echo e(Auth::user()->name ?? 'User'); ?></h2>
                            <p class="text-xs text-black-400 font-mono"><?php echo e(Auth::user()->email ?? ''); ?></p>
                        </div>
                    </div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->guard()->check()): ?>

                        <nav class="space-y-4 font-mono  ">
                            <a href="/<?php echo e(auth()->user()->id); ?>/bookmarks"
                                class="block text-lg hover:border rounded-md px-2">إشاراتي المرجعية</a>
                            <a href=<?php echo e(url('@' . auth()->user()->username)); ?>

                                class="block text-lg hover:border rounded-md  px-2">ملفي الشخصي </a>
                            <a href="#" class="block text-lg hover:border rounded-md  px-2">إعدادات</a>
                        </nav>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    <div class="mt-auto pt-6 border-t border-white-800">
                        <form method="POST" action="<?php echo e(route('logout')); ?>">
                            <?php echo csrf_field(); ?>
                            <button class=" font-mono text-sm hover:text-xl">تسجيل الخروج</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </template><?php /**PATH E:\Laravel-2026\forum\resources\views/layouts/_sidebarOpen.blade.php ENDPATH**/ ?>