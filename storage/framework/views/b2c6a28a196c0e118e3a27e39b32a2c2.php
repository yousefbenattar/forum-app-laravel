<!DOCTYPE html>
<html lang="ar" dir="rtl">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title><?php echo e($title ?? config('app.name')); ?></title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

 <!-- Scripts -->
        <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    <script>
    document.addEventListener('alpine:init', () => {
        Alpine.store('aiChat', {
            newMessage: '',
            pastConversations: [],
            activeMessages: [],
            activeConversationId: null,
            isLoading: false,

            loadConversations() {
                fetch('/ai/conversations')
                    .then(res => res.json())
                    .then(data => {
                        this.pastConversations = data.conversations;
                    });
            },

            selectConversation(id) {
                this.activeConversationId = id;
                this.isLoading = true;
                fetch(`/ai/conversations/${id}`)
                    .then(res => res.json())
                    .then(data => {
                        this.activeMessages = data.messages;
                        this.isLoading = false;
                    });
            },

            startNewChat() {
                this.activeConversationId = null;
                this.activeMessages = [];
            },

            sendMessage() {
                if (this.newMessage.trim() === '' || this.isLoading) return;

                const userPrompt = this.newMessage;
                this.activeMessages.push({ role: 'user', content: userPrompt });
                this.newMessage = '';
                this.isLoading = true;

                fetch('/ai-chat', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        message: userPrompt,
                        conversation_id: this.activeConversationId
                    })
                })
                .then(res => res.json())
                .then(data => {
                    this.activeMessages.push({ role: 'assistant', content: data.reply });
                    this.isLoading = false;

                    if (!this.activeConversationId) {
                        this.activeConversationId = data.conversation_id;
                        this.loadConversations();
                    }
                })
                .catch(() => {
                    this.isLoading = false;
                });
            }
        });
    });
</script>
        <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::styles(); ?>

    </head>
   <body class="font-sans antialiased bg-white">
    <div class="min-h-screen bg-white dark:bg-gray-400">
        <?php echo $__env->make('layouts.navigation', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <!-- Page Heading -->
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($header)): ?>
            <header class="bg-[#79af9d] shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <?php echo e($header); ?>

                </div>
            </header>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <!-- Page Content -->
        <main class="flex ">
            <div class="w-1/6">
                    <?php if (isset($component)) { $__componentOriginal132d8c9b35c256fe36637b5b175f781a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal132d8c9b35c256fe36637b5b175f781a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.right-side-bar','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('right-side-bar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal132d8c9b35c256fe36637b5b175f781a)): ?>
<?php $attributes = $__attributesOriginal132d8c9b35c256fe36637b5b175f781a; ?>
<?php unset($__attributesOriginal132d8c9b35c256fe36637b5b175f781a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal132d8c9b35c256fe36637b5b175f781a)): ?>
<?php $component = $__componentOriginal132d8c9b35c256fe36637b5b175f781a; ?>
<?php unset($__componentOriginal132d8c9b35c256fe36637b5b175f781a); ?>
<?php endif; ?>
                </div>
                 
                <div class="w-4/6">
                    <?php echo e($slot); ?>

                </div>
                <div class="w-1/6">
                    <?php if (isset($component)) { $__componentOriginalce686daa3476e91f7e507f0ea53cd73d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce686daa3476e91f7e507f0ea53cd73d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.left-side-bar','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('left-side-bar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalce686daa3476e91f7e507f0ea53cd73d)): ?>
<?php $attributes = $__attributesOriginalce686daa3476e91f7e507f0ea53cd73d; ?>
<?php unset($__attributesOriginalce686daa3476e91f7e507f0ea53cd73d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalce686daa3476e91f7e507f0ea53cd73d)): ?>
<?php $component = $__componentOriginalce686daa3476e91f7e507f0ea53cd73d; ?>
<?php unset($__componentOriginalce686daa3476e91f7e507f0ea53cd73d); ?>
<?php endif; ?>
                    
                </div>
         </main>
    </div>
        <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::scripts(); ?>

</body>
<footer>
    <div class="bg-[#79af9d]  text-center text-white mt-2 py-4">
    
    جميع الحقوق محفوظة لمنتدى التاريخ البديل
        &copy; <?php echo e(date('Y')); ?>



    </div>
</footer>
   
</html>
<?php /**PATH E:\Laravel-2026\forum\resources\views/layouts/app.blade.php ENDPATH**/ ?>