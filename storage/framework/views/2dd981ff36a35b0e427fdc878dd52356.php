<template x-teleport="body">
        <div x-show="searchOpen" class="fixed inset-0 z-50 bg-black/50 flex items-center py-20 justify-center">
            <div x-show="searchOpen" @click.outside="searchOpen = false"
                class="flex flex-col gap-2 p-10 bg-[#79af9d] rounded shadow-lg items-center">
                <h2 class="text-white text-2xl font-bold">
                    إبدء البحث
                </h2>
                <form class="flex gap-2" method="get" action="/search" @keydown.escape="searchOpen = false">
                    <input required type="text" name="query" id="query" placeholder="اكتب هنا للبحث..." class="rounded-lg p-2
                        flex-grow w-[400px] border-0 text-gray-800 focus:ring-2 focus:ring-emerald-600">
                    <button type="submit" class="border border-white rounded text-white px-4 py-2">بحث</button>
                </form>

            </div>
        </div>
    </template><?php /**PATH E:\Laravel-2026\forum\resources\views/layouts/_searchOpen.blade.php ENDPATH**/ ?>