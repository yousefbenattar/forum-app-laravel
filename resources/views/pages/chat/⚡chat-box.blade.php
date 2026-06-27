<?php

use Livewire\Component;
use App\Models\Conversation;
use App\Models\User;
use App\Events\MessageSent;
use App\Events\MessageRead;
use App\Models\Message;
use Livewire\Attributes\On;

new class extends Component {
    public $selectedConversation;
    public $body = '';
    public $selectedMessage;

    public function mount($selectedConversation)
    {
        $this->selectedConversation = $selectedConversation;
        $this->markMessagesAsRead();
    }

    public function getMessages()
    {
        // Filter messages dynamically based on who authored each specific message row
        return $this->selectedConversation->messages()
            ->where(function ($query) {
                $query->where(function ($q) {
                    // If I sent this specific message, show it only if I haven't hidden it
                    $q->where('sender_id', auth()->id())
                        ->whereNull('sender_deleted_at');
                })->orWhere(function ($q) {
                    // If I received this specific message, show it only if I haven't hidden it
                    $q->where('receiver_id', auth()->id())
                        ->whereNull('receiver_deleted_at');
                });
            })
            ->get();
    }

    #[On('echo-private:chat.{selectedConversation.id},MessageSent')]
    public function listenForMessages($event)
    {
        $this->markMessagesAsRead();
        $this->dispatch('scroll-to-bottom');
    }

    // UNIFIED LISTENER: Handled beautifully under modern Livewire #[On] attribute
    #[On('echo-private:chat.{selectedConversation.id},MessageRead')]
    public function handleMessagesReadBroadcast($event)
    {
        $this->dispatch('$refresh');
    }

    public function addMessage()
    {
        if (empty(trim($this->body))) {
            return;
        }

        $receiverId = ($this->selectedConversation->sender_id === auth()->id())
            ? $this->selectedConversation->receiver_id
            : $this->selectedConversation->sender_id;

        $message = Message::create([
            'conversation_id' => $this->selectedConversation->id,
            'sender_id' => auth()->id(),
            'receiver_id' => $receiverId,
            'body' => trim($this->body)
        ]);

        MessageSent::dispatch($message);

        $this->reset('body');
        $this->dispatch('scroll-to-bottom');
    }

    public function markMessagesAsRead()
    {
        if (!$this->selectedConversation) {
            return;
        }

        $updatedCount = Message::where('conversation_id', $this->selectedConversation->id)
            ->where('receiver_id', auth()->id())
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        if ($updatedCount > 0) {
            broadcast(new MessageRead($this->selectedConversation->id))->toOthers();
        }
    }

    public function deleteMessage($selectedMessage)
    {
        $message = Message::where('conversation_id', $this->selectedConversation->id)
            ->where('id', $selectedMessage)
            ->first();

        if (!$message) {
            return;
        }

        if ((int) $message->sender_id === auth()->id()) {
            $message->sender_deleted_at = now();
        } else {
            $message->receiver_deleted_at = now();
        }

        $message->save();

        if ($message->sender_deleted_at && $message->receiver_deleted_at) {
            $message->delete();
        }
    }
}
?>

<div class="p-4 flex flex-col justify-between bg-gray-50 h-full max-h-[85vh]">

    {{-- 1. Messages Scroll Area --}}
    <div x-data="{ scrollToBottom () {$el.scrollTop = $el.scrollHeight;} }" x-init="scrollToBottom()"
        @scroll-to-bottom.window="$nextTick(() => scrollToBottom())"
        class="flex flex-col gap-2 overflow-y-auto mb-4 p-2 grow">

        @forelse($this->getMessages() as $message)
            {{-- FIX 1: Added unique wire:key to keep track of exact DOM elements during deletion loops --}}
            <div wire:key="msg-container-{{ $message->id }}" @class([
                'p-2 rounded-lg max-w-[80%] border shadow-sm',
                'bg-[#79af9d] text-white ml-auto' => $message->sender_id === auth()->id(),
                'bg-white text-gray-800 mr-auto' => $message->sender_id !== auth()->id()
            ])>
                <p>{{ $message->body }}</p>
                <span class="text-[10px] opacity-70 block text-left mt-1">
                    {{ $message->created_at->format('g:i A') }}
                </span>

                @if($message->sender_id === auth()->id())
                    <div class="flex items-center justify-between gap-2 mt-1">
                        @if($message->read_at)
                            <svg class="color-white" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-check-all text-sky-200" viewBox="0 0 16 16">
                                <path
                                    d="M8.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L2.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093L8.95 4.992zm-.92 5.14.92.92a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 1 0-1.091-1.028L9.477 9.417l-.485-.486z" />
                            </svg>
                        @else
                            <svg class="color-white" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-check opacity-70" viewBox="0 0 16 16">
                                <path
                                    d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425z" />
                            </svg>
                        @endif

                        <div x-data="{ toggle: false }" class="relative inline-block">
                            <svg @click="toggle = !toggle" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                fill="currentColor"
                                class="bi bi-three-dots-vertical text-white cursor-pointer hover:text-gray-600 transition-colors"
                                viewBox="0 0 16 16">
                                <path
                                    d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0" />
                            </svg>

                            {{-- FIX 2: Fixed class typo from r-0 to right-0 --}}
                            <div x-show="toggle" @click.away="toggle = false"
                                x-transition:enter="transition ease-out duration-100"
                                x-transition:enter-start="transform opacity-0 scale-95"
                                x-transition:enter-end="transform opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-75"
                                x-transition:leave-start="transform opacity-100 scale-100"
                                x-transition:leave-end="transform opacity-0 scale-95"
                                class="absolute z-50 right-0 mt-1 w-32 bg-white rounded-md border border-gray-200 shadow-lg py-1">

                                <form wire:submit.prevent="deleteMessage({{$message->id}})">
                                    <button @click="toggle = false"
                                        class="w-full text-right px-4 py-2 text-xs text-black hover:bg-red-50 transition-colors">
                                        حذف
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="flex items-center justify-between gap-2 mt-1">
                        <div></div>
                        <div x-data="{ toggle: false }" class="relative inline-block">
                            <svg @click="toggle = !toggle" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                fill="currentColor"
                                class="bi bi-three-dots-vertical text-gray-400 cursor-pointer hover:text-gray-600 transition-colors"
                                viewBox="0 0 16 16">
                                <path
                                    d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0" />
                            </svg>

                            <div x-show="toggle" @click.away="toggle = false"
                                x-transition:enter="transition ease-out duration-100"
                                x-transition:enter-start="transform opacity-0 scale-95"
                                x-transition:enter-end="transform opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-75"
                                x-transition:leave-start="transform opacity-100 scale-100"
                                x-transition:leave-end="transform opacity-0 scale-95"
                                class="absolute z-50 left-0 mt-1 w-32 bg-white rounded-md border border-gray-200 shadow-lg py-1">

                                <form wire:submit.prevent="deleteMessage({{$message->id}})">
                                    <button @click="toggle = false"
                                        class="w-full text-right px-4 py-2 text-xs text-black hover:bg-red-50 transition-colors">
                                        حذف
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        @empty
            <p class="text-gray-400 text-center m-auto">لا توجد رسائل في هذه المحادثة بعد.</p>
        @endforelse
    </div>

    {{-- 2. Single Input Form --}}
    <form class="flex gap-2 items-center bg-white p-2 rounded-xl border border-gray-200 shadow-sm"
        wire:submit.prevent="addMessage">
        <input type="text" value="{{ $body }}" wire:model="body" required
            class="w-full border-0 focus:ring-0 focus:outline-none px-3 py-2 text-sm" placeholder="اكتب رسالة..." />
        <button type="submit"
            class="bg-[#79af9d] hover:bg-[#689989] text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
            إرسال
        </button>
    </form>
</div>