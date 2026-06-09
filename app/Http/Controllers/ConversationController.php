<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConversationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(int $id)
    {
        $sender_id = Auth::id();
        $receiver_id = $id;

        $exists = Conversation::where(['sender_id' => $sender_id, 'receiver_id' => $receiver_id,])
            ->orWhere([
                'sender_id' => $receiver_id,
                'receiver_id' => $sender_id,
            ])
            ->exists();
        if ($sender_id === $receiver_id) {
            return back();
        }
        if ($exists) {
            return redirect()->route('chat.index');

        }


        Conversation::create(
            [
                "sender_id" => $sender_id,
                "receiver_id" => $receiver_id
            ]
        );
        return redirect()->route('chat.index');



    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
