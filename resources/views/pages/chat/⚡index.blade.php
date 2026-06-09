<?php // resources/views/pages/posts/⚡index.blade.php

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;
use App\Models\Conversation;
use App\Models\User;
new #[Layout('layouts::app2')] class extends Component 
{
    #[Computed]
    public ?Conversation $selectedConversation = null;

    public function selectConversation(Conversation $conversation)
    {
        $this->selectedConversation = $conversation;
    }
    public function getConversations()
    {
        $conversations = Conversation::where('sender_id', auth()->id())->orWhere(
            'receiver_id',
            auth()->id()
        )->get();
        return $conversations;
    }

    public function chatwith($conversation)
    {
        if ($conversation->sender_id !== auth()->id()) {
            return User::find($conversation->sender_id);
        } else {
            return User::find($conversation->receiver_id);
        }
    }
};?>

<div>
    <div class="mt-2 fixed h-full flex bg-white border lg:shadow-sm overflow-hidden inset-0 lg:top-16 lg:inset-x-2 m-auto lg:h-[90%] rounded-lg">

        {{-- Conversations Sidebar --}}
        <div class="relative w-full md:w-[320px] xl:w-[480px] overflow-y-auto shrink-0 h-full border">
            <div class="w-full flex flex-col">
                <p class="flex flex-col px-4 py-2 text-2xl">محادثات</p>
                <div class="flex gap-2 p-2">
                    <div class="bg-[#79af9d] rounded-full py-2 px-3 cursor-pointer text-white">الجميع</div>
                    <div class="bg-[#79af9d]/80 rounded-full py-2 px-3 cursor-pointer text-white">لم أجبها</div>
                </div>
                <ul class="flex flex-col items-end gap-3 p-2 m-2">
                    @forelse ($this->getConversations() as $conversation)
                        {{-- FIX: Use wire:click to communicate directly with your PHP component --}}
                        <button wire:click="selectConversation({{ $conversation }})" 
                            @class([
                                'flex justify-between items-center gap-3 p-2 border rounded-lg w-full transition-all',
                                'bg-[#79af9d] text-white border-gray-300 font-bold' => $selectedConversation?->id === $conversation->id,
                                'bg-white hover:bg-gray-50' => $selectedConversation?->id !== $conversation->id
                            ])>
                            <div class="flex gap-3">
                                <img class="w-10 h-10 rounded-full" src="{{ asset('images/profile.png') }}" alt="Icon">
                                <p class="flex items-center">
                                    {{ $this->chatwith($conversation)->name }}
                                </p>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots-vertical cursor-pointer" viewBox="0 0 16 16">
                                <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0" />
                            </svg>
                        </button>
                    @empty
                        <div class="flex flex-col items-center gap-3 p-2 border rounded-lg w-full">
                            <p><span class="text-2xl">لا توجد محادثات بعد</span></p>
                        </div>
                    @endforelse
                </ul>
            </div>
        </div>

        {{-- Dynamic Main Chat Area / Placeholder text --}}
        <div class="relative hidden md:grid w-full border-l h-full overflow-y-auto" style="contain:content">
            @if($selectedConversation)
                {{-- If a chat is active, load up your chat box component! --}}
                <livewire:pages::chat.chat-box :selectedConversation="$selectedConversation" :key="$selectedConversation->id" />
            @else
                {{-- Fallback default layout placeholder info screen --}}
                <div class="m-auto text-center justify-center flex flex-col gap-3">
                    <h3 class="font-medium text-lg text-gray-400">اختر محادثة لبدء الدردشة</h3>
                </div>
            @endif
        </div>
        
    </div>
</div>