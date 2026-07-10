<?php

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;
use App\Models\Conversation;
use App\Models\User;
use App\Ai\Agents\ForumAssistant;
use Livewire\Attributes\On;

new #[Layout('layouts::app2')] class extends Component
 {
    public ?string $conversationId = null;

    #[Computed]
    public function pastConversations()
    {
        return DB::table('agent_conversations')
            ->where('user_id', auth()->id())
            ->orderBy('updated_at', 'desc')
            ->get()
            ->toArray();
    }
    public function loadConversation($id)
    {
        $this->conversationId = $id;
    }
};
?>

<div>
    <div
        class="mt-2 fixed h-full flex bg-white border lg:shadow-sm overflow-hidden inset-0 lg:top-16 lg:inset-x-2 m-auto lg:h-[90%] rounded-lg">

        {{-- 1. Sidebar Panel (Previous Conversations) --}}
        <div class="w-1/4 bg-white border-l border-gray-200 flex flex-col p-4 overflow-y-auto gap-2">
            <div class="flex justify-between items-center mb-4">
                <h4 class="font-bold text-gray-700 text-sm">المحادثات السابقة</h4>
                {{-- Optional Button to start completely fresh --}}
                <button wire:click="$set('conversationId', null)"
                    class="text-xs text-[#79af9d] hover:underline font-medium">
                    محادثة جديدة +
                </button>
            </div>

            @if(count($this->pastConversations) > 0)
                @foreach($this->pastConversations as $chat)
                    @php $chat = (array) $chat; @endphp
                    <button wire:click="loadConversation('{{ $chat['id'] }}')" @class([
                        'w-full text-right p-3 text-xs rounded-xl transition-all border text-ellipsis overflow-hidden whitespace-nowrap',
                        'bg-[#eef6f3] border-[#79af9d] text-[#4d7568] font-medium shadow-sm' => $conversationId === $chat['id'],
                        'bg-gray-50 border-gray-100 text-gray-600 hover:bg-gray-100' => $conversationId !== $chat['id']
                    ])>
                        {{ $chat['title'] ?? 'محادثة بدون عنوان' }}
                    </button>
                @endforeach
            @else
                <p class="text-xs text-gray-400 text-center py-4">لا توجد محادثات سابقة بعد.</p>
            @endif
        </div>
        {{-- Dynamic Main Chat Area --}}
        <div class="relative hidden md:grid w-full border-l h-full overflow-y-auto" style="contain:content">
            @if(true)
                <livewire:pages::chat_ai.chat-box :conversationId="$conversationId"></livewire:pages::chat_ai.chat-box>
            @else
                <div class="m-auto text-center justify-center flex flex-col gap-3">
                    <h3 class="font-medium text-lg text-gray-400">إسأل أي شيء</h3>
                </div>
            @endif
        </div>

    </div>
</div>