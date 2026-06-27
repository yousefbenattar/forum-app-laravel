<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;
class ActivityController extends Controller
{
    public function index(){
       $activities = Activity::where('user_id', auth()->id())->with('subject')->latest()->get();
        return view('user.activity', compact('activities'));
    }
    }
