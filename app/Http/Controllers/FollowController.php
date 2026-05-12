<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\Follow;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    public function follow(User $user)
    {
        $follower = auth()->user();
        $follower->following()->attach($user->id);
        // auth()->user()->notify(new Follow($user));
        return back();
    }
    public function unfollow(User $user)
    {
        $follower = auth()->user();
        $follower->following()->detach($user->id);
        return back();
    }
}
