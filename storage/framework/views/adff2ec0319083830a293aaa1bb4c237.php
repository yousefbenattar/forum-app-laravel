<!DOCTYPE html>
<html lang="ar" dir="rtl">


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'Laravel')); ?></title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css']); ?>
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
        <main>

            <?php echo e($slot); ?>



        </main>
    </div>
    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::scripts(); ?>

</body>

</html><?php /**PATH E:\Laravel-2026\forum\resources\views/layouts/app2.blade.php ENDPATH**/ ?>