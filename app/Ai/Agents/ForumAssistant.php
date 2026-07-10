<?php

namespace App\Ai\Agents;

 use App\Ai\Tools\RetrievePreviousTranscripts;
use App\Models\History;
use App\Models\User;
use Illuminate\Contracts\JsonSchema\JsonSchema;
use Laravel\Ai\Contracts\Agent;
use Laravel\Ai\Contracts\Conversational;
use Laravel\Ai\Contracts\HasStructuredOutput;
use Laravel\Ai\Contracts\HasTools;
use Laravel\Ai\Messages\Message;
use Laravel\Ai\Promptable;
use Laravel\Ai\Concerns\RemembersConversations;
use Stringable;

class ForumAssistant implements Agent, Conversational
{
    use Promptable, RemembersConversations;
    public function __construct(public User $user)
    {
    }

    /**
     * Get the instructions that the agent should follow.
     */
    /**
     * Define the core instructions and personality for Gemini.
     */
    public function instructions(): string
    {
        return 'أنت مساعد ذكاء اصطناعي إسمك فرفور الفأر ، مفيد في منتدى مجتمعنا المعني بالتاريخ البديل ،لغتنا الأساسية العربية. لذا، يُرجى إبقاء إجاباتك واضحة وموجزة ومفيدة.';
    }

    /**
     * Specify the model to use. Flash is perfect for fast, conversational chat.
     */
    public function model(): string
    {
        return 'gemini-3.1-flash-lite';
    }

 



    /**
     * Get the list of messages comprising the conversation so far.
     */
    // public function messages(): iterable
    // {
    //     return History::where('user_id', $this->user->id)
    //         ->latest()
    //         ->limit(50)
    //         ->get()
    //         ->reverse()
    //         ->map(function ($message) {
    //             return new Message($message->role, $message->content);
    //         })->all();
    // }

    /**
     * Get the tools available to the agent.
     *
     * @return Tool[]
     */
    // public function tools(): iterable
    // {
    //     return [
    //         new RetrievePreviousTranscripts,
    //     ];
    // }

    /**
     * Get the agent's structured output schema definition.
     */
    public function schema(JsonSchema $schema): array
    {
        return [
            'feedback' => $schema->string()->required(),
            'score' => $schema->integer()->min(1)->max(10)->required(),
        ];
    }
}