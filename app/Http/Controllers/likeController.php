<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Like;
use Termwind\Components\Li;

class LikeController extends Controller
{
    public function create(Post $post)
    {
        $user = auth()->user();
        if ($post->likes()->where('user_id', $user->id)->exists()) {
            $post->likes()->where('user_id', $user->id)->delete();
        } else {
            Like::create([
                'post_id' => $post->id,
                'user_id' => $user->id,
            ]);
        }
        return back();
    }
}
