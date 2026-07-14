<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $guarded = [];
    // الفاعل
    public function user(){
        return $this->belongsTo(User::class);
    }
    //المفعول به
    public function target()
    {
        return $this->morphTo();
    }
}
