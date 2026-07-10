<?php

namespace App\Http\Controllers;

use App\Models\News;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::latest()->get();
        return view('news.index', ['news' => $news]);
    }
    public function create()
    {
        return view('news.create');
    }

    public function store()
    {
        $validated = request()->validate([
            'title' => "required|string|max:100",
            'image' => "image|mimes:jpg,png,jpeg,gif,svg|max:2048",
            'content' => "required|string"
        ]);
        if (request()->hasFile('image')) {
            $validated['image'] = request()->file('image')->store("posts", "public");
        }
        News::create([
            'user_id' => auth()->user()->id,
            'title' => $validated['title'],
            'content' => $validated['content'],
            'image' => $validated['image'],
        ]);
        return redirect('/news');
    }
    public function show($îd)
    {
        $new = News::findOrFail($îd);
        return view('news.show',compact('new'));
    }
}
