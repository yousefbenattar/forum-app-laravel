<?php

namespace App\Http\Controllers;

use App\Models\BookMark;
use App\Models\User;
use Illuminate\Http\Request;

class BookMarkController extends Controller
{
    public function create($post_id)
    {
        $user_id = auth()->id();

        BookMark::firstOrCreate(
            [
                'user_id' => $user_id,
                'post_id' => $post_id
            ]
        );
        return back();
    }
    public function delete($post_id)
    {
        $user_id = auth()->id();

        BookMark::where(
            [
                'user_id' => $user_id,
                'post_id' => $post_id
            ]
        )->delete();
        return back();

    }

    public function show()
    {
        $user = User::findOrFail(auth()->user()->id);

        $posts = $user->bookmarkedPosts()->latest()->get();

        return view("book.bookmarks", compact('posts'));
    }
}
