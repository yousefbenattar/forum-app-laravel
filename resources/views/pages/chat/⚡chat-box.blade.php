<?php

use Livewire\Component;
use App\Models\Conversation;
use App\Models\User;
use App\Events\MessageSent;
use App\Models\Message;

new class extends Component {
    public $selectedConversation;
    public $body = '';
    public function mount($selectedConversation)
    {
        $this->selectedConversation = $selectedConversation;
    }

    public function getMessages()
    {
        if (!$this->selectedConversation) {
            return collect();
        }
        return $this->selectedConversation->messages()->get();

    }

    public function addMessage()
    {
        if (empty(trim($this->body))) {
        return;
    }
        if ($this->body) {
             $message = Message::create([
                'conversation_id' => $this->selectedConversation->id,
                'sender_id' => auth()->id(),
                'receiver_id' => $this->selectedConversation->receiver_id,
                'body' => $this->body
            ]);
            
           
           
            MessageSent::dispatch($message);
            // ⚡ THE MAGIC LINE: Dispatch a browser event down to Alpine!
            $this->reset('body');
             
            $this->dispatch('scroll-to-bottom');
            
        }

    }
 
}
?>

<div class="p-4 flex flex-col justify-between bg-gray-50 h-full max-h-[85vh]">

    {{-- 1. Messages Scroll Area --}}
    <div
    x-data="{ scrollToBottom (){$el.scrollTop = $el.scrollHeight;}} "
    x-init="scrollToBottom()"
    @scroll-to-bottom.window="$nextTick(() => scrollToBottom())"
    class="flex flex-col gap-2 overflow-y-auto mb-4 p-2 grow">
        @forelse($this->getMessages() as $message)
            <div @class([
                'p-2 rounded-lg max-w-[80%] border shadow-sm',
                /// Sent by me (align left or right depending on your RTL preference)
                'bg-[#79af9d] text-white mr-auto' => $message->sender_id === auth()->id(),
                /// Sent by other 
                'bg-white text-gray-800 ml-auto' => $message->sender_id !== auth()->id()
            ])>
                <p>{{ $message->body }}</p>
                <span class="text-[10px] opacity-70 block text-left mt-1">
                    {{ $message->created_at->format('g:i A') }}
                </span>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
  <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0"/>
</svg>
            </div>
        @empty
            <p class="text-gray-400 text-center m-auto">لا توجد رسائل في هذه المحادثة بعد.</p>
        @endforelse
    </div>

    {{-- 2. Single Input Form (Safely sitting outside the message list loop) --}}
    <form class="flex gap-2 items-center bg-white p-2 rounded-xl border border-gray-200 shadow-sm"
        wire:submit.prevent="addMessage">
        <input type="text" value="{{ $body }}"
        wire:model.defer="body"  required
            class="w-full border-0 focus:ring-0 focus:outline-none px-3 py-2 text-sm" placeholder="اكتب رسالة..." />

        <button type="submit"
            class="bg-[#79af9d] hover:bg-[#689989] text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
            إرسال
        </button>
    </form>

</div>