<?php // resources/views/pages/posts/⚡index.blade.php

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;
use App\Models\Conversation;
use App\Models\User;
use App\Notifications\NewMessageNotification;
use Livewire\Attributes\On;

new #[Layout('layouts::app2')] class extends Component
{
    #[Computed]
    public ?Conversation $selectedConversation = null;

    public function mount($conversation = null)
    {
        if ($conversation) {
            $this->selectedConversation = Conversation::find($conversation);
        }
        
    }

    public function selectConversation(Conversation $conversation)
    {
        $this->selectedConversation = $conversation;
    }

    public function getConversations()
    {
        return Conversation::where(function ($query) {
            $query->where('sender_id', auth()->id())
                ->orWhere('receiver_id', auth()->id());
        })
        ->withCount([
            'unreadMessages' => function ($query) {
                $query->where('receiver_id', auth()->id());
            }
        ])
        ->with('latestMessage')
        ->get()
        ->sortByDesc(function ($conversation) {
            return $conversation->latestMessage?->created_at;
        });
    }

    public function chatwith($conversation)
    {
        if ($conversation->sender_id !== auth()->id()) {
            return User::find($conversation->sender_id);
        } else {
            return User::find($conversation->receiver_id);
        }
    }

    protected function getListeners()
    {
        return [
            "echo-private:user." . auth()->id() . ",MessageSent" => 'handleIncomingMessageSidebar',
        ];
    }

    public function handleIncomingMessageSidebar($event)
    {
        $this->dispatch('$refresh');
    }
};
?>

<div>
    <div class="mt-2 fixed h-full flex bg-white border lg:shadow-sm overflow-hidden inset-0 lg:top-16 lg:inset-x-2 m-auto lg:h-[90%] rounded-lg">

        {{-- Conversations Sidebar --}}
        <div class="relative w-full md:w-[320px] xl:w-[480px] overflow-y-auto shrink-0 h-full border">
            <div class="w-full flex flex-col">
                <p class="flex flex-col px-4 py-2 text-2xl">محادثات</p>
                <div class="flex gap-2 p-2">
                    <button class="bg-[#79af9d] rounded-full py-2 px-3 cursor-pointer text-white">الجميع</button>
                    <button class="bg-[#79af9d]/50 rounded-full py-2 px-3 cursor-pointer text-white">لم أجبها</button>
                </div>
                <ul class="flex flex-col items-end gap-3 p-2 m-2">
                    @forelse ($this->getConversations() as $conversation)
                        <a href="{{ route('chat.index', ['conversation' => $conversation->id]) }}" wire:navigate @class([
                            'flex justify-between items-center gap-3 p-2 border rounded-lg w-full transition-all',
                            'bg-[#79af9d] text-white border-gray-300 font-bold' => $selectedConversation?->id === $conversation->id,
                            'bg-white hover:bg-gray-50 text-gray-800' => $selectedConversation?->id !== $conversation->id
                        ])>
                            <div class="flex gap-3">
                                <img class="w-10 h-10 rounded-full" src="{{ asset('images/profile.png') }}" alt="Icon">
                                <div class="flex flex-col">
                                    <p class="flex items-center @if($selectedConversation?->id === $conversation->id) text-white @else text-gray-900 @endif">
                                        {{ $this->chatwith($conversation)->name }}
                                    </p>
                                    <div class="flex items-center gap-1 text-xs @if($selectedConversation?->id === $conversation->id) text-teal-50 @else text-gray-500 @endif">
                                        {{-- Optional: Show checkmarks if you sent the last message preview --}}
                                        @if($conversation->latestMessage?->sender_id === auth()->id())
                                            @if($conversation->latestMessage->read_at)
                                                {{-- Double Blue/White Checks --}}
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-check-all @if($selectedConversation?->id === $conversation->id) text-white @else text-blue-500 @endif" viewBox="0 0 16 16">
                                                    <path d="M8.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L2.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093L8.95 4.992zm-.92 5.14.92.92a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 1 0-1.091-1.028L9.477 9.417l-.485-.486z"/>
                                                </svg>
                                            @else
                                                {{-- Single Check --}}
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-check opacity-60" viewBox="0 0 16 16">
                                                    <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425z"/>
                                                </svg>
                                            @endif
                                        @endif
                                        <p>{{ Str::limit($conversation->latestMessage?->body, 30) ?? "" }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center gap-4">
                                {{-- FIXED: Changed unreadMessages_count to snake_case unread_messages_count --}}
                                @if($conversation->unread_messages_count > 0)
                                    <span class="bg-[#79af9d] rounded-full min-w-6 h-6 px-2 flex items-center justify-center text-white text-xs font-bold ">
                                        {{ $conversation->unread_messages_count }}
                                    </span>
                                @endif

                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots-vertical cursor-pointer opacity-60 hover:opacity-100" viewBox="0 0 16 16">
                                    <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0" />
                                </svg>
                            </div>
                        </a>
                    @empty
                        <div class="flex flex-col items-center gap-3 p-2 border rounded-lg w-full text-gray-400">
                            <p><span class="text-lg">لا توجد محادثات بعد</span></p>
                        </div>
                    @endforelse
                </ul>
            </div>
        </div>

        {{-- Dynamic Main Chat Area --}}
        <div class="relative hidden md:grid w-full border-l h-full overflow-y-auto" style="contain:content">
            @if($selectedConversation)
                <livewire:pages::chat.chat-box :selectedConversation="$selectedConversation" :key="$selectedConversation->id" />
            @else
                <div class="m-auto text-center justify-center flex flex-col gap-3">
                    <h3 class="font-medium text-lg text-gray-400">اختر محادثة لبدء الدردشة</h3>
                </div>
            @endif
        </div>

    </div>
</div>