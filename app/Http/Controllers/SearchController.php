<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request){
        // 1. Get the search query from the URL parameter '?q='
        $query = $request->input('query');
        // 2. Initialize an empty collection in case there's no query
        $posts = collect();
        if(!empty($query)){
           $posts = Post::where('title', 'LIKE', "%{$query}%")
            ->orWhere('content','LIKE',"%{$query}%")
            ->latest()->paginate(10);
        }
        return view('search-results', compact('posts', 'query'));
    }
}
