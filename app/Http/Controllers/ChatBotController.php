<?php

namespace App\Http\Controllers;

use App\Ai\Agents\ForumAssistant;
use App\Models\Discussion;
use Illuminate\Http\Request;
class ChatBotController extends Controller
{
    public function store(Request $request, Discussion $discussion)
    {
        $request->validate([
            'message' => 'required|string|max:2000',
        ]);

        // 1. Save the user's message to the forum thread database
        $discussion->posts()->create([
            'user_id' => auth()->id(),
            'role' => 'user',
            'content' => $request->message,
        ]);

        // 2. Use the ForumAssistant agent to process the conversation
        // The SDK automatically updates the stored conversation history
        $response = (new ForumAssistant)
            ->continue($discussion->ai_conversation_id, as: auth()->user())
            ->prompt($request->message);

        // 3. Save the chatbot's response to the forum thread
        $botPost = $discussion->posts()->create([
            'user_id' => null, // null indicates it is the bot, or use a system user ID
            'role' => 'model',
            'content' => $response->text(),
        ]);

        // Return a response (or broadcast an event for live updates)
        return response()->json([
            'message' => 'Success',
            'bot_reply' => $botPost->content,
        ]);
    }
}
