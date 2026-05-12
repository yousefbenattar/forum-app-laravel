<x-better>
    <div class="py-4">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <h1 class="text-3xl mb-4">Create new post</h1>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">
                <form action="/post" method="post" enctype="multipart/form-data">
                    @csrf
                    <!--Title-->
                    <div>
                        <x-input-label for="title" :value="__('Title')" />
                        <x-text-input
                            id="title" class="block mt-1 w-full"
                            type="text" name="title"
                            :value="old('title')" required
                            autofocus />
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>
                    <!-- Image -->
                    <div>
                        <x-input-label for="image" :value="__('Image')" />
                        <x-text-input id="image" class="block mt-1 w-full" type="file" name="image"
                            :value="old('image')" autofocus />
                        <x-input-error :messages="$errors->get('image')" class="mt-2" />
                    </div>
                    <!-- Category -->
                    <div class="mt-4">
                        <x-input-label for="category_id" :value="__('Category')" />
                        <select id="category_id" name="category_id"
                        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full">
                            <option value="">Select a Category</option>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                @selected(old('category_id')==$category->id)>
                                {{ $category->name }}
                            </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                    </div>
                    <!--Content-->
                    <div>
                        <x-input-label for="content" :value="__('Content')" />
                        <x-input-textarea
                            id="content"
                            class="block mt-1 w-full"
                            type="text"
                            name="content"
                            :value="old('content')"
                            required>

                        </x-input-textarea>
                        <x-input-error :messages="$errors->get('content')" class="mt-2" />
                    </div>
                    <x-primary-button class="mt-4">
                        Submit
                    </x-primary-button>
                </form>

            </div>
        </div>
    </div>
</x-better>