<?php

use App\Models\Conversation;
use Illuminate\Support\Facades\Broadcast;


Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});


// Match the exact channel structure from your Event class
Broadcast::channel('chat.{conversationId}', function ($user, $conversationId) {
    $conversation = Conversation::find($conversationId);

    if (!$conversation) {
        return false;
    }

    // A user can ONLY join this private channel if they are the sender OR the receiver!
    return (int) $user->id === (int) $conversation->sender_id || 
           (int) $user->id === (int) $conversation->receiver_id;
});
