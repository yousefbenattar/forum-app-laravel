<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{       public function show($username)
    {
        $user = User::where('username', $username)->firstOrFail();
        $posts = $user->posts;
        return view("user.show", ['user' => $user, "posts" => $posts]);
    }
}
