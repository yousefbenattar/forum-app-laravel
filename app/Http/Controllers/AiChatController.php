<?php

namespace App\Http\Controllers;

use App\Ai\Agents\ForumAssistant;
use Illuminate\Http\Request;

class AiChatController extends Controller
{
    // 1. Fetch all historic threads for the sidebar layout
    public function index()
    {
        $conversations = auth()->user()->conversations()
            ->latest('updated_at')
            ->get()
            ->map(fn($chat) => [
                'id' => $chat->id,
                // Fallback to a snippet of the first message if no title exists
                'title' => $chat->title ?? ($chat->messages()->first()?->content ? string_limit($chat->messages()->first()->content, 25) : 'محادثة جديدة'),
                'updated_at' => $chat->updated_at->diffForHumans(),
            ]);

        return response()->json(['conversations' => $conversations]);
    }

    // 2. Load the full message history when a user clicks a past chat
    public function show($id)
    {
        $conversation = auth()->user()->conversations()->findOrFail($id);
        
        $messages = $conversation->messages()
            ->get()
            ->map(fn($msg) => [
                'role' => $msg->role, // 'user' or 'assistant'
                'content' => $msg->content
            ]);

        return response()->json(['messages' => $messages]);
    }

    // 3. Process incoming text prompts
    public function handle(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:2000',
            'conversation_id' => 'nullable|string'
        ]);

        $user = auth()->user();
        $agent = ForumAssistant::make();

        // If continuing an old thread, bind to it. Otherwise, initialize a fresh thread.
        if ($request->conversation_id) {
            $response = $agent->continue($request->conversation_id, as: $user)
                ->prompt($request->message);
            $conversationId = $request->conversation_id;
        } else {
            $response = $agent->forUser($user)
                ->prompt($request->message);
            $conversationId = $response->conversationId;
        }

        $replyText = $response->response ? $response->response->text() : (string) $response;

        return response()->json([
            'conversation_id' => $conversationId,
            'reply' => $replyText
        ]);
    }
}