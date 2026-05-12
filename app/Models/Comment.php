<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Post;

class Comment extends Model
{
    protected $fillable = [
        'user_id',
        'post_id',
        'parent_id',
        'content',
    ];
    public function user (){
      return $this->belongsTo(User::class);
    }
    public function post (){
      return $this->belongsTo(Post::class);
    }
    // Replies (nested comments)
    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }

    // Parent comment
    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    public function like (){
        return $this->hasMany(Like::class);
    }
}
