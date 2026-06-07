<?php // resources/views/pages/posts/⚡index.blade.php

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;
new #[Layout('layouts::app2')] class extends Component
{
     #[Computed]
     public function posts()
    {
        return 'text';
    }
};
?>

<div>
<div
    class="mt-2 fixed h-full flex bg-white border lg:shadow-sm overflow-hidden inset-0 lg:top-16 lg:inset-x-2 m-auto lg:h-[90%] rounded-lg">
    
    <div class="relative hidden md:grid w-full border-l h-full overflow-y-auto" style="contain:content">
        <div class="m-auto text-center justify-center flex flex-col gap-3">
            <h3 class="front-medium text-lg">اختر محادثة لبدء الدردشة</h3>
        </div>
    </div>
    <div class="relative w-full md:w-[320px] xl:w-[480px] overflow-y-auto shrink-0 h-full border">
     <livewire:pages::chat.chat-list/>
    </div>
</div>
</div>