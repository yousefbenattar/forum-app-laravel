<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
{
    $notifications = auth()->user()->notifications()->paginate(10);
    
    // Mark them as read so the bell stops ringing next time they load a page
    auth()->user()->unreadNotifications->markAsRead();

    return view('notifications.index', compact('notifications'));
}
}
