<?php

namespace App\Ai\Agents;

use Laravel\Ai\Promptable;
use Laravel\Ai\Contracts\Agent;
use Laravel\Ai\Contracts\Conversational;
use Laravel\Ai\Concerns\RemembersConversations;

class ForumAssistant implements Agent, Conversational
{
    use Promptable, RemembersConversations;

    /**
     * Define the core instructions and personality for Gemini.
     */
    public function instructions(): string
    {
        return 'You are a helpful resident AI assistant on our community forum. Keep your answers clear, concise, and helpful.';
    }

    /**
     * Specify the model to use. Flash is perfect for fast, conversational chat.
     */
    public function model(): string
    {
        return 'gemini-2.5-flash';
    }
}