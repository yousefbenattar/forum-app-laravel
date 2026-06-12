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
        
    </head>
   <body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        <?php echo $__env->make('layouts.navigation', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <!-- Page Heading -->
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($header)): ?>
            <header class="bg-[#79af9d] dark:bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <?php echo e($header); ?>

                </div>
            </header>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <!-- Page Content -->
        <main class=" ">
            <div class="flex ">
                <div class="w-1/5 pr-10">
                    <?php if (isset($component)) { $__componentOriginal13a73d991085de124d329c309f0531ef = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal13a73d991085de124d329c309f0531ef = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.profile_section','data' => ['user' => $user]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('profile_section'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['user' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($user)]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal13a73d991085de124d329c309f0531ef)): ?>
<?php $attributes = $__attributesOriginal13a73d991085de124d329c309f0531ef; ?>
<?php unset($__attributesOriginal13a73d991085de124d329c309f0531ef); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal13a73d991085de124d329c309f0531ef)): ?>
<?php $component = $__componentOriginal13a73d991085de124d329c309f0531ef; ?>
<?php unset($__componentOriginal13a73d991085de124d329c309f0531ef); ?>
<?php endif; ?>
                </div>

                <div class="w-4/5">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        <?php if (isset($component)) { $__componentOriginalfb314f739d8d594f4055ce4bb169c909 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfb314f739d8d594f4055ce4bb169c909 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.post-item','data' => ['post' => $post]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('post-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['post' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($post)]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalfb314f739d8d594f4055ce4bb169c909)): ?>
<?php $attributes = $__attributesOriginalfb314f739d8d594f4055ce4bb169c909; ?>
<?php unset($__attributesOriginalfb314f739d8d594f4055ce4bb169c909); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalfb314f739d8d594f4055ce4bb169c909)): ?>
<?php $component = $__componentOriginalfb314f739d8d594f4055ce4bb169c909; ?>
<?php unset($__componentOriginalfb314f739d8d594f4055ce4bb169c909); ?>
<?php endif; ?>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        <div class="text-center text-gray-400 py-16">No Posts Found</div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </div>

        </main>
    </div>
  
</body>
<footer>
    <div class="bg-[#79af9d]  text-center text-white mt-2 py-4">
    
    جميع الحقوق محفوظة لمنتدى التاريخ البديل
        &copy; <?php echo e(date('Y')); ?>



    </div>
</footer>
   
</html>



 <?php /**PATH E:\Laravel-2026\forum\resources\views/user/show.blade.php ENDPATH**/ ?>