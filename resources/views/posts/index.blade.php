<x-app-layout>
    <div>
        <div class="h-20 w-auto flex items-center justify-between pl-5">
            <div class="flex items-center gap-4">
                <p>فئات</p>
                <p>جميع المواضيع</p>
            </div>
            <h1 class="text-[#79af9d] text-4xl font-bold pr-5">كل المنشورات</h1>
        </div>
        @forelse ($posts as $post)
            <x-post-item :post="$post"></x-post-item>
        @empty
            <div class="text-center text-gray-400 py-16">لم يتم العثور على أي منشورات</div>
        @endforelse
    </div>
</x-app-layout>