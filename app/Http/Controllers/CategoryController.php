<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show ($id) {
       $posts = Post::where("category_id" , $id)->get();
       return view('category.show',['posts' => $posts]);
    }
}
