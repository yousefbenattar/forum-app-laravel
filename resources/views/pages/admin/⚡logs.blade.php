<?php

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\User;
use App\Models\AdminLog;

new #[Layout('layouts::app3')] class extends Component
{
    public $query = '';
    public $user_id = '';
    public $date = '';
    public function getAdmins(){
        return User::role('admin')->orderBy('id')->get();
    }
    
    public function getadmin($user_id)
    {
        return User::findOrFail($user_id);
    }

    public function getLogs()
    {
        $query = $this->query;
        $date = $this->date;
        $user_id = $this->user_id;
        return AdminLog::query()
        // 1. Filter by specific Admin if selected in dropdown
        ->when($user_id, function ($q) use ($user_id) {
            $q->where('user_id', $user_id); // Strict match instead of 'like'
        })
        
        // 2. Filter by Date Range if dates are provided
        ->when($date, function ($q) use ($date) {
            $q->whereDate('created_at', 'like', "%{$date}%");
        })
        // 3. Search Text (grouped inside a where clause so it doesn't break the filters above)
        ->when($query, function ($q) use ($query) {
            $q->where(function ($subQuery) use ($query) {
                $subQuery->where('action', 'like', "%{$query}%")
                         ->orWhere('target_type', 'like', "%{$query}%")
                         ->orWhere('reason', 'like', "%{$query}%");
            });
        })
        ->orderBy('created_at', 'desc')
        ->paginate(10)
        ->withQueryString();
    }
};
?>

<div class="flex flex-col p-4 gap-2">

    <p>سجل نشاطات الأدمنز :</p>

    <div class="flex items-center gap-4">
        <input wire:model.live="query" type="text" placeholder="ابحث"
            class="border border-gray-300 rounded-md px-2 py-1">
        <div class="flex items-center gap-1 text-sm">
            <p>تاريخ البدء</p>
            <input wire:model.live="date" type="date" class="border rounded p-2">
        </div>
 
         <select wire:model.live="user_id" class="overflow-auto border border-gray-300 rounded-md ">
            <option default value="">كل الأدمن</option>
            @forelse ($this->getAdmins() as $admin)
                <option value="{{ $admin->id }}">{{ $admin->name }}</option>
                @empty
                    <option value="">لا يوجد أدمن</option>
                @endforelse
         </select>

    </div>
    <div class="flex items-center gap-2 text-sm font-bold border-b border-gray-600 bg-gray-100 py-2">
        <div class="w-1/6">الأدمن</div>
        <div class="w-2/6">الفعل</div>
        <div class="w-2/6">السبب </div>
        <div class="w-1/6">تاريخ الإنشاء</div>
     
    </div>
    @forelse ($this->getLogs() as $log)
        <div class="flex items-center gap-2 text-sm font-bold border-b border-gray-600 bg-gray-100 py-2">
        <div class="w-1/6 flex items-center gap-2">
            <img src="{{ $this->getadmin($log->user_id)->avatar ? Storage::url($this->getadmin($log->user_id)->avatar) : asset('images/profile.png')}}" 
            
            class="h-10 w-10 rounded-full">
            {{ $this->getadmin($log->user_id)->name ?? 'N/A' }}
        </div>
        <div class="w-2/6">{{ $log->action }}</div>
        <div class="w-2/6">{{ $log->reason }} </div>
        <div class="w-1/6">{{ $log->created_at->format('Y-m-d') }}</div>
    </div>
    @empty
        <P>لا شيء</P>
    @endforelse
</div>