<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;
class ActivityController extends Controller
{
    public function index(){
        $activities  = [];
       /// $activities = Activity::where('user_id', auth()->id())->latest()->get();
        return view('user.activity', compact('activities'));
    }
    }
