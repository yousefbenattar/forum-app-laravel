<div class="min-h-screen bg-[#020817] p-8 text-gray-400 font-sans">
    <h2 class="mb-4 text-sm font-semibold uppercase tracking-wider text-gray-500">Discussions</h2>

    <nav x-data="{ active: 'Popular This Week' }" class="flex flex-col space-y-1 border-l border-gray-800">

        <template x-for="item in ['Popular This Week', 'Popular All Time', 'Solved', 'Unsolved',
         'No Replies Yet']">
            <a href="#" @click.prevent="active = item" :class="{
                    'border-l-2 border-blue-500 text-blue-400 bg-blue-500/5': active === item,
                    'border-l-2 border-transparent hover:text-gray-200': active !== item
                }"
                class="block py-2 pl-6 text-lg font-medium transition-all duration-200 -ml-[2px]"
                x-text="item">
            </a>
        </template>

    </nav>
</div>