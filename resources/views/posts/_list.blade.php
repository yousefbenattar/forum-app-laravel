{{-- resources/views/posts/_list.blade.php --}}

@forelse ($posts as $post)
    <x-post-item :post="$post"></x-post-item>
@empty
    <div class="text-center text-gray-400 py-16">لم يتم العثور على أي منشورات</div>
@endforelse

<!-- Put pagination HERE inside the partial view -->
<div class="mt-4 px-5" @click.prevent="if($event.target.tagName === 'A') filter($event.target.href)">
    {{ $posts->links() }}
</div>