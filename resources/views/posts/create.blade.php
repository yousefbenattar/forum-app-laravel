<x-better>
    <div class="py-4 text-xl">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <h1 class="text-3xl mb-4 text-right">إنشاء منشور جديد</h1>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">
                <form action="/post" method="post" enctype="multipart/form-data">
                    @csrf
                    <!--Title-->
                    <div class="flex flex-col my-4">


                        <x-input-label for="title" :value="__('العنوان')" />

                        <x-text-input id="title" class="block mt-1 w-full text-right" type="text" name="title"
                            :value="old('title')" required autofocus />
                        <x-input-error :messages="$errors->get('title')" class="mt-2 text-right" />
                    </div>
                    <!-- Image -->
                    <div class="flex flex-col my-4">

                        <x-input-label for="image" :value="__('صورة (اختياري)')" />

                        <x-text-input id="image" class="block mt-1 w-full text-right" type="file" name="image"
                            :value="old('image')" placeholder="صورة (اختياري)" autofocus />
                        <x-input-error :messages="$errors->get('image')" class="mt-2 text-right" />
                    </div>
                    <!-- Category -->
                    <div class="flex flex-col my-4">
                       
                            <x-input-label for="category_id" :value="__('الفئة')" />
                        
                        <select id="category_id" name="category_id" dir="rtl"
                            class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full text-right">
                            <option value="">اختر فئة</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('category_id')" class="mt-2 text-right" />
                    </div>
                    <!--Content-->
                    <div class="flex flex-col my-4">

                        <x-input-label for="content" :value="__('المحتوى')" />

                        <x-input-textarea id="content" 
                        class="block mt-1 w-full text-right rounded-md shadow-sm" type="text" name="content"
                            :value="old('content')" required>
                        </x-input-textarea>
                        <x-input-error :messages="$errors->get('content')" class="mt-2 text-right" />
                    </div>
                    <div class="flex justify-between items-center direction-rtl">
                        <x-primary-button class="mt-4 px-8 text-lg">
                            نشر
                        </x-primary-button>
                        <button type="button" onclick="window.history.back()"
                            class="mt-4 text-gray-600 hover:text-gray-900">
                            إلغاء
                        </button>

                    </div>
                </form>
            </div>
        </div>
    </div>
</x-better>