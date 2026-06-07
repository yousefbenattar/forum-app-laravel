<?php

use Livewire\Component;
use App\Models\Conversation;

new class extends Component {
    public $conversations = Conversation::where('sender_id', auth()->id())->orWhere(
        'receiver_id',  auth()->id())->with('user')->get();

};
?>

<div class="w-full flex flex-col" x-data="{
conversations: {{ $conversations }},
}">
    <p class="flex flex-col items-end px-4 py-2 text-2xl ">محادثات</p>
    <div class="flex flex-row-reverse gap-2 items-end p-2 ">
        <div class="bg-[#79af9d] rounded-full py-2 px-3 cursor-pointer text-white">الجميع</div>
        <div class="bg-[#79af9d]/80 rounded-full py-2 px-3 cursor-pointer text-white">لم أجبها</div>
    </div>
    <ul class="flex flex-col items-end gap-3 p-2 m-2 ">
        <template x-for="conversation in conversations" :key="conversation.id">
            <li class="flex justify-between items-center gap-3 p-2 border rounded-lg w-full">
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-three-dots-vertical  cursor-pointer" viewBox="0 0 16 16">
                        <path
                            d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0" />
                    </svg>
                </div>
                <div class="flex gap-1">

                    <div>
                        <p x-text="conversation.user.name"></p>

                    </div>
                    <img class="w-10 h-10 rounded-full" src="{{ asset('images/post_default.png') }}" alt="Icon">
                </div>
            </li>
        </template>
    </ul>
</div>