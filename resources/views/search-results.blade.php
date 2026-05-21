{{-- Assuming you have a main app layout wrapper --}}
<x-app-layout>
    <div class="max-w-4xl mx-auto py-12 px-4" dir="rtl">
        
        <h1 class="text-3xl font-bold text-gray-900 mb-2">نتائج البحث</h1>
        <p class="text-gray-600 mb-8">
            نتائج البحث عن الكلمة المفتاحية: <span class="font-semibold text-emerald-600">"{{ $query }}"</span>
        </p>

        @if($posts->count() > 0)
            <div class="space-y-6">
                @foreach($posts as $post)
                    <a href=""><x-post-item :post="$post"></x-post-item></a>
                @endforeach
            </div>

            <div class="mt-8">
                {{ $posts->appends(['q' => $query])->links() }}
            </div>
        @else
            <div class="text-center py-12 bg-white rounded-xl border border-dashed border-gray-200">
                <p class="text-xl text-gray-500 font-medium">عذراً، لم نجد أي نتائج تطابق بحثك.</p>
                <p class="text-gray-400 text-sm mt-2">جرب البحث بكلمات مختلفة أو أكثر عمومية.</p>
            </div>
        @endif

    </div>
</x-app-layout>