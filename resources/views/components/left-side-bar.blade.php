<!-- <div class="flex-col px-10 mt-10">
     @php
        $osactive = request()->is("/");
    @endphp
    <a href="/"><p class="{{ $osactive ? 'text-[#79af9d] text-2xl' : '' }}">All</p>
</a>
    @foreach ($categories as $category)
        @php
            $isactive = request()->is("category/" . $category['id']);
        @endphp
            <div class="flex-col">
                <a href="/category/{{$category['id']}}">
                    <p class="text-black {{ $isactive ? 'text-[#79af9d] text-xl' : '' }}  cursor-pointer">{{ $category['name'] }}</p>
                </a>

            </div>
    @endforeach
</div>  -->


<div class="min-h-screen bg-white p-8 text-gray-400 font-sans">


    <nav class="flex flex-col space-y-1 border-l border-gray-800">

        @foreach ($categories as $category)
            <a href="/category/{{$category->id}}" class="block py-2 pl-6 border-l-2 font-medium transition-all">
                {{ $category->name }}
            </a>
        @endforeach
    </nav>
</div>