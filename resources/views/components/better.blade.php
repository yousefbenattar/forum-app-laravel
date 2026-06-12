<!DOCTYPE html>
<html lang="ar" dir="rtl">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? config('app.name') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

 <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
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
        @livewireStyles
    </head>
   <body class="font-sans antialiased bg-white">
    <div class="min-h-screen ">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-[#79af9d] shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main >
          
            
                <div >
                    {{ $slot }}
                </div>
               
         
          
            
                 
                
         </main>
    </div>
             @livewireScripts
</body>
<footer>
    <div class="bg-[#79af9d]  text-center text-white mt-2 py-4">
    
    جميع الحقوق محفوظة لمنتدى التاريخ البديل
        &copy; {{ date('Y') }}


    </div>
</footer>
   
</html>
