<template x-teleport="body">
    <div>
        <!-- Backdrop -->
        <div x-show="chatAiOpen" 
             x-transition.opacity 
             @click="chatAiOpen = false"
             class="fixed inset-0 bg-black/50 backdrop-blur-sm z-40"></div>

        <!-- Chat Panel -->
        <!-- x-init watches the parent scope's variable safely -->
        <div x-show="chatAiOpen" 
             x-init="$watch('chatAiOpen', value => { if (value) $store.aiChat.loadConversations() })"
             x-transition:enter="transition transform duration-300"
             x-transition:enter-start="translate-x-full" 
             x-transition:enter-end="translate-x-0"
             x-transition:leave="transition transform duration-300" 
             x-transition:leave-start="translate-x-0"
             x-transition:leave-end="translate-x-full"
             class="fixed inset-y-0 right-0 w-full sm:w-1/2 md:w-1/3 bg-white text-black z-50 p-6 shadow-2xl flex flex-col justify-between h-full"
             dir="rtl">

            <!-- 1. CHAT HEADER -->
            <div class="flex flex-row justify-between items-center border-b border-gray-200 pb-4">
                <h3 class="font-bold text-lg flex items-center gap-2">🤖 مساعد الذكاء الاصطناعي</h3>
                <div class="flex items-center gap-2">
                    <button @click="$store.aiChat.startNewChat()" class="text-xs bg-emerald-50 text-emerald-700 hover:bg-emerald-100 px-2.5 py-1.5 rounded-lg transition-colors font-medium">
                        + محادثة جديدة
                    </button>
                    <button @click="chatAiOpen = false" class="text-gray-500 hover:text-black transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- 2. SCROLLABLE CONTENT BODY -->
            <div class="flex-1 my-4 overflow-y-auto pl-2 space-y-6">
                
                <div class="space-y-3">
                    <!-- Default Greeting -->
                    <template x-if="$store.aiChat.activeMessages.length === 0">
                        <div class="bg-gray-100 text-gray-800 p-3 rounded-xl text-sm inline-block max-w-[85%] shadow-sm">
                            مرحباً بك! كيف يمكنني مساعدتك في المنتدى اليوم؟
                        </div>
                    </template>

                    <!-- Message Loop -->
                    <template x-for="(msg, index) in $store.aiChat.activeMessages" :key="index">
                        <div class="w-full flex" :class="msg.role === 'user' ? 'justify-start' : 'justify-end'">
                            <div :class="msg.role === 'user' ? 'bg-emerald-50 text-emerald-900 border border-emerald-100' : 'bg-gray-100 text-gray-800'"
                                 class="p-3 rounded-xl text-sm inline-block max-w-[85%] shadow-sm"
                                 x-text="msg.content">
                            </div>
                        </div>
                    </template>
                </div>

                <!-- Past History Section -->
                <div class="pt-4 border-t border-gray-100">
                    <h4 class="font-bold text-sm text-gray-500 mb-3">محادثاتنا السابقة</h4>
                    
                    <div class="space-y-2">
                        <template x-for="item in $store.aiChat.pastConversations" :key="item.id">
                            <div @click="$store.aiChat.selectConversation(item.id)"
                                 :class="$store.aiChat.activeConversationId == item.id ? 'border-emerald-500 bg-emerald-50/50' : 'border-gray-200 bg-gray-50 hover:bg-gray-100'"
                                 class="w-full flex justify-between items-center text-gray-800 rounded-lg p-3 border cursor-pointer transition-all">
                                <p class="text-sm font-medium truncate max-w-[80%]" x-text="item.title"></p>
                                <span class="text-[10px] text-gray-400 font-mono" x-text="item.updated_at"></span>
                            </div>
                        </template>
                    </div>
                </div>
            </div>

            <!-- 3. FOOTER INPUT BOX -->
            <div class="border-t border-gray-200 pt-4 bg-white">
                <form @submit.prevent="$store.aiChat.sendMessage()" class="relative flex items-center">
                    <input type="text" 
                           x-model="$store.aiChat.newMessage"
                           :disabled="$store.aiChat.isLoading"
                           placeholder="ابدأ محادثة الآن..."
                           class="w-full text-sm text-black rounded-xl p-3 pl-12 pr-4 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-emerald-600 focus:border-transparent transition-all shadow-inner disabled:bg-gray-50" />
                    
                    <button type="submit" :disabled="$store.aiChat.isLoading" class="absolute left-3 text-emerald-600 hover:text-emerald-800 transition-colors disabled:text-gray-300">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 transform rotate-180">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
                        </svg>
                    </button>
                </form>
            </div>

        </div>
    </div>
</template><?php /**PATH E:\Laravel-2026\forum\resources\views/layouts/_chatAiOpen.blade.php ENDPATH**/ ?>