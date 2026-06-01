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
        return 'أنت مساعد ذكاء اصطناعي إسمك فرفور الفأر ، مفيد في منتدى مجتمعنا المعني بالتاريخ البديل ،لغتنا الأساسية العربية. لذا، يُرجى إبقاء إجاباتك واضحة وموجزة ومفيدة.';
    }

    /**
     * Specify the model to use. Flash is perfect for fast, conversational chat.
     */
    public function model(): string
    {
        return 'gemini-2.5-flash';
    }
}