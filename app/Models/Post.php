<?php

namespace App\Models;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Like;
class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        "title",
        "slug",
        "content",
        "image",
        "category_id",
        "user_id",

    ];
    public function readTime($wordsPerMinute = 100)
    {
        $words = str_word_count(strip_tags($this->content));
        $minutes = ceil($words / $wordsPerMinute);
        return max(1, $minutes);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function likes()
    {
        return $this->hasMany(Like::class);
    }
    public function isLikedByAuthUser()
    {
        return $this->likes()->where('user_id', auth()->id())->exists();
    }
    public function bookmarkedBy()
    {
        return $this->belongsToMany(User::class, 'bookmarks');
    }

    public function isbookmarked()
    {
        return $this->bookmarkedBy()->where('user_id', auth()->id())->exists();
    }
    public function postViews()
    {
        return $this->hasMany(PostView::class);
    }
     public function bookmarks()
    {
        return $this->hasMany(Bookmark::class);
    }
}
