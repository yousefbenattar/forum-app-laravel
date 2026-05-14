<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stat extends Model
{
    protected $fillable = ['type'];
    public function post ()
    {
        return $this->belongsTo(Post::class);
    }
}
