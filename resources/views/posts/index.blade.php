<x-app-layout>
    <div>

        <div class="h-20 w-auto flex items-center justify-between pl-5">
            <div x-data="{
            stats: @js($stats), 
            categories: @js($categories),
            selectedstat :'{{ request('type') }}',
            selectedCategory: '{{ request('category') }}',
            filter() {
           let params = new URLSearchParams(window.location.search);
        if (this.selectedCategory) {
            params.set('category', this.selectedCategory);
        } else {
            params.delete('category');
        }
        params.delete('page');
        window.location.search = params.toString();
             }
      }" class="flex items-center  gap-10">
                {{-- <select x-model="selectedType" @change="filter()" class="rounded-md w-40">
                    <option value="">كل الفئات</option>
                    <template x-for="stat in stats" :key="stat.id">
                        <option :value="stat.type" x-text="stat.type"></option>
                    </template>
                </select> --}}

                <!-- Select 2: Topics (Categories) -->
                <select x-model="selectedCategory" @change="filter()" class="rounded-md">
                    <option value="">كل المواضيع</option>
                    <template x-for="category in categories" :key="category.id">
                        <!-- Alpine will automatically select this option if category.id == selectedCategory -->
                        <option :selected="category.id == selectedCategory" :value="category.id" x-text="category.name">
                        </option>
                    </template>
                </select>
            </div>
            <h1 class="text-[#79af9d] text-4xl font-bold pr-5">كل المنشورات</h1>
        </div>
        @forelse ($posts as $post)
            <x-post-item :post="$post"></x-post-item>
        @empty
            <div class="text-center text-gray-400 py-16">لم يتم العثور على أي منشورات</div>
        @endforelse
    </div>

    {{ $posts->links() }}
</x-app-layout>