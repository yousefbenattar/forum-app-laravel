<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminLog extends Model
{
    protected $guarded = [];
    protected $casts = ['meta_data' => 'array'];

    // The Admin who performed the action
    public function admin()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // The object that was acted upon (User, Post, etc.)
    public function target()
    {
        return $this->morphTo();
    }


}
