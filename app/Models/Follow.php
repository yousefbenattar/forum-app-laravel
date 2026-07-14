<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    public const UPDATED_AT = null;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function follower()
    {
        return $this->belongsTo(User::class);
    }
}
