<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\PostView;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class PostController extends Controller
{
    public function index(Request $request)
    {

        $query = Post::with(['user', 'category']);

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        $posts = $query->latest()->paginate(10)->withQueryString();

        // If it's an AJAX request (from Alpine), return a partial view or JSON
        if ($request->ajax()) {
            return view('posts._list', compact('posts'))->render();
        }

        return view("posts.index", [
            'posts' => $posts,
            'categories' => Category::all(),
        ]);
    }
    public function show(Post $post)
    {
        $cacheKey = 'post_viewed_' . $post->id . '_' . request()->ip();
        if (!cache()->has($cacheKey)) {
            // Increment the main count on the posts table for fast reading
            $post->increment('view_count');
            // Log the view for analytics
            PostView::create([
                'post_id' => $post->id,
                'user_id' => auth()->id(),
                'ip' => request()->ip()
            ]);
            // Set a cooldown for 1 hour
            cache()->put($cacheKey, true, now()->addHours(1));
        }
        return view("posts.show", compact('post'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('posts.create', compact('categories'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => "required|string|max:100",
            'category_id' => 'required|exists:categories,id',
            'image' => "image|mimes:jpg,png,jpeg,gif,svg|max:2048",
            'content' => "required|string"
        ]);
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store("posts", "public");
        }
        $validated['slug'] = Str::slug($validated['title']);
        $validated['user_id'] = auth()->id();
        Post::create($validated);
        return redirect('/');
    }
}
