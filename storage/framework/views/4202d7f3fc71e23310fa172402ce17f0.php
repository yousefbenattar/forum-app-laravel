<?php
use Livewire\Component;
use App\Models\Post;
use App\Models\Report;
?>

<div x-data="{ showPostReportModal: false }">
    <button @click="showPostReportModal = true">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($this->reportedPost()): ?>
            <div class="flex items-center gap-1 bg-gray-600 text-white rounded-full hover:scale-110 py-1 px-2">
                <p>تم الإبلاغ</p>
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                    class="bi bi-flag-fill hover:scale-110" viewBox="0 0 16 16">
                    <path d="M14.778.085A.5.5 0 0 1 15 .5V8a.5.5 0 0 1-.314.464L14.5 8l.186.464-.003.001-.006.003-.023.009a12 12 0 0 1-.397.15c-.264.095-.631.223-1.047.35-.816.252-1.879.523-2.71.523-.847 0-1.548-.28-2.158-.525l-.028-.01C7.68 8.71 7.14 8.5 6.5 8.5c-.7 0-1.638.23-2.437.477A20 20 0 0 0 3 9.342V15.5a.5.5 0 0 1-1 0V.5a.5.5 0 0 1 1 0v.282c.226-.079.496-.17.79-.26C4.606.272 5.67 0 6.5 0c.84 0 1.524.277 2.121.519l.043.018C9.286.788 9.828 1 10.5 1c.7 0 1.638-.23 2.437-.477a20 20 0 0 0 1.349-.476l.019-.007.004-.002h.001" />
                </svg>
            </div>
        <?php else: ?>
            <div class="flex items-center gap-1 bg-gray-200 text-black rounded-full hover:scale-110 py-1 px-2">
                <p>إبلاغ</p>
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                    class="bi bi-flag" viewBox="0 0 16 16">
                    <path d="M14.778.085A.5.5 0 0 1 15 .5V8a.5.5 0 0 1-.314.464L14.5 8l.186.464-.003.001-.006.003-.023.009a12 12 0 0 1-.397.15c-.264.095-.631.223-1.047.35-.816.252-1.879.523-2.71.523-.847 0-1.548-.28-2.158-.525l-.028-.01C7.68 8.71 7.14 8.5 6.5 8.5c-.7 0-1.638.23-2.437.477A20 20 0 0 0 3 9.342V15.5a.5.5 0 0 1-1 0V.5a.5.5 0 0 1 1 0v.282c.226-.079.496-.17.79-.26C4.606.272 5.67 0 6.5 0c.84 0 1.524.277 2.121.519l.043.018C9.286.788 9.828 1 10.5 1c.7 0 1.638-.23 2.437-.477a20 20 0 0 0 1.349-.476l.019-.007.004-.002h.001M14 1.221c-.22.078-.48.167-.766.255-.81.252-1.872.523-2.734.523-.886 0-1.592-.286-2.203-.534l-.008-.003C7.662 1.21 7.139 1 6.5 1c-.669 0-1.606.229-2.415.478A21 21 0 0 0 3 1.845v6.433c.22-.078.48-.167.766-.255C4.576 7.77 5.638 7.5 6.5 7.5c.847 0 1.548.28 2.158.525l.028.01C9.32 8.29 9.86 8.5 10.5 8.5c.668 0 1.606-.229 2.415-.478A21 21 0 0 0 14 7.655V1.222z" />
                </svg>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </button>

    <div x-show="showPostReportModal" x-cloak>
        <div class="fixed inset-0 z-40 bg-black/50 backdrop-blur-sm"></div>
        <div class="fixed inset-0 z-50 flex items-center justify-center">
            <div class="bg-white p-6 flex flex-col rounded-md max-w-md w-full mx-4" @click.outside="showPostReportModal = false">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($this->reportedPost()): ?>
                    <p class="text-center font-medium">لقد قمت بالفعل بالإبلاغ عن هذا المنشور</p>
                    <button @click="showPostReportModal = false" class="mt-4 px-4 py-2 bg-blue-600 text-white rounded-md">إغلاق</button>
                <?php else: ?>
                    <p class="font-bold text-lg">هل تريد الإبلاغ عن هذا المنشور ؟</p>
                    <div class="flex items-center gap-4 mt-4">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($post->user->avatar): ?>
                            <img src="<?php echo e(Storage::url($post->user->avatar)); ?>" class="h-10 w-10 rounded-full">
                        <?php else: ?>
                            <img src="<?php echo e(asset('images/profile.png')); ?>" class="h-10 w-10 rounded-full">
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <p class="font-medium text-gray-800"><?php echo e($post->user->name); ?></p>
                    </div>
                    <p class="mt-2 text-gray-600 border-l-2 border-gray-300 pl-2 italic"><?php echo e($post->title); ?></p>
                    
                    <p class="py-2 mt-4 font-semibold">سبب الإبلاغ</p>
                    <textarea class="rounded-md border-gray-300 w-full" wire:model="reason" rows="3"></textarea>
                    
                    <div class="w-full flex justify-between text-white mt-4">
                        <form wire:submit.prevent="reportPost">
                            <button type="submit" @click="showPostReportModal = false" 
                            class="px-4 py-2 bg-red-600 rounded-md hover:bg-red-700 transition">
                                إبلاغ
                            </button>
                        </form>
                        <button @click="showPostReportModal = false" class="px-4 py-2 bg-blue-600 rounded-md hover:bg-blue-700 transition">إلغاء</button>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>
    </div>
</div><?php /**PATH E:\Laravel-2026\forum\storage\framework\views/livewire/views/ed53d00b.blade.php ENDPATH**/ ?>