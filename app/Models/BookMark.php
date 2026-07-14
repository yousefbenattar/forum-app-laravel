<?php

namespace App\Models;

use Illuminate\Container\Attributes\Auth;
use Illuminate\Database\Eloquent\Model;

class BookMark extends Model
{
    // Explicitly set the table name to match your database
    protected $table = 'bookmarks';
    protected $fillable = [
        'user_id',
        'post_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

  
}
