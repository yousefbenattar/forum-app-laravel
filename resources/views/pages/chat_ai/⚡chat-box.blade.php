<?php
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use App\Ai\Agents\ForumAssistant;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Reactive;
new class extends Component {
    #[Reactive]
    public $conversationId;
    public $message = '';




    public function submitMessage()
    {
        $this->validate([
            'message' => 'required|string|max:2000',
        ]);

        $user = auth()->user();

        if ($this->conversationId) {
            // CONTINUING CHAT: Use the SDK's exact continue() method
            $response = ForumAssistant::make(user: $user)
                ->continue($this->conversationId, as: $user)
                ->prompt($this->message);
        } else {
            // STARTING CHAT: Use the SDK's exact forUser() method to seed a new thread
            $response = ForumAssistant::make(user: $user)
                ->forUser($user)
                ->prompt($this->message);

            // Save the newly assigned UUID
            $this->conversationId = $response->conversationId;
        }

        // Reset the input field
        $this->message = '';
    }

    #[Computed]
    public function messages()
    {
        if (!$this->conversationId) {
            return [];
        }

        return DB::table('agent_conversation_messages')
            ->where('conversation_id', $this->conversationId)
            ->orderBy('created_at', 'asc')
            ->get()
            ->map(function ($message) {
                // Convert to array to easily modify elements if needed
                $msgArray = (array) $message;
                $msgArray['content'] = (string) ($msgArray['content'] ?? '');
                return $msgArray;
            })
            ->toArray(); // 🌟 CRITICAL: This fixes the array_merge crash!
    }
};
?>

<div class="p-4 flex flex-col justify-between bg-gray-50 h-full max-h-[85vh]">

    {{-- 1. Messages Scroll Area --}}
    <div x-data="{}" x-init="" class="flex flex-col gap-2 overflow-y-auto mb-4 p-2 grow">


        @if ($conversationId)
            {{-- Temporary debug tool to see the object properties --}}


            @foreach ($this->messages as $message)
                <p @class([
                    'ml-auto bg-emerald-100 p-2 rounded-lg max-w-[75%]' => $message['role'] == 'user',
                    'mr-auto bg-white p-2 rounded-lg max-w-[75%] border border-gray-200' => $message['role'] == 'assistant',
                ])>
                {{ is_string($message['content']) ? $message['content'] : json_encode($message['content']) }}
                </p>
            @endforeach
        @else
            <h3 class="font-medium flex items-center justify-center text-lg text-gray-400">إبدء محادثة جديدة</h3>
        @endif

    </div>

    {{-- 2. Single Input Form --}}
    <form class="flex gap-2 items-center bg-white p-2 rounded-xl border border-gray-200 shadow-sm"
        wire:submit.prevent="submitMessage">
        <input type="text" wire:model="message" required
            class="w-full border-0 focus:ring-0 focus:outline-none px-3 py-2 text-sm" placeholder="اكتب رسالة..." />
        <button type="submit"
            class="bg-[#79af9d] hover:bg-[#689989] text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
            إرسال
        </button>
    </form>
</div>