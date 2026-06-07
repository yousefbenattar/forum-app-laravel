<x-app-layout>
    <!-- 1. Moved x-data here so EVERYTHING inside can use Alpine variables -->
    <div x-data="{
        categories: @js($categories),
        selectedCategory: '{{ request('category', '') }}',
        loading: false,

        get currentTitle() {
            if (!this.selectedCategory) return 'كل المنشورات';
            let category = this.categories.find(c => c.id == this.selectedCategory);
            return category ? category.name : 'كل المنشورات';
        },

        async filter(targetUrl = null) {
            this.loading = true;
            
            // If a custom URL is passed (from pagination), use it. Otherwise use current URL.
            let url = targetUrl ? new URL(targetUrl) : new URL(window.location.href);
            
            if (!targetUrl) {
                if (this.selectedCategory) {
                    url.searchParams.set('category', this.selectedCategory);
                } else {
                    url.searchParams.delete('category');
                }
                url.searchParams.delete('page'); // Reset page on dropdown change
            }

            try {
                const response = await fetch(url, {
                    headers: { 'X-Requested-With': 'XMLHttpRequest' }
                });
                const html = await response.text();

                // 2. Swaps the entire list AND the pagination links inside the container
                document.getElementById('posts-container').innerHTML = html;
                window.history.pushState({}, '', url);
            } catch (error) {
                console.error('Error fetching posts:', error);
            } finally {
                this.loading = false;
            }
        }
    }" class="w-full">

        <div class="h-20 w-auto flex items-center justify-between pl-5">
            <!-- 3. Fixed: Added x-text so the title actually updates -->
            <h1 class="text-[#79af9d] text-4xl font-bold pr-5" x-text="currentTitle"></h1>

            
            <div class="flex items-center gap-10">
                
                <select x-model="selectedCategory" @change="filter()" class="rounded-md">
                    <option value="">كل المنشورات</option>
                    <template x-for="category in categories" :key="category.id">
                        <option :selected="category.id == selectedCategory" :value="category.id" x-text="category.name"></option>
                    </template>
                </select>

            </div>
            
            
        </div>

        <!-- 4. Fixed: Added the container ID and a smooth loading fade effect -->
        <div id="posts-container" :class="loading ? 'opacity-50 transition-opacity' : 'transition-opacity'">
            @include('posts._list')
        </div>

    </div>
</x-app-layout>