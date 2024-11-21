<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\OpenAIService;

class AiController extends Controller
{
    protected $openAIService;

    public function __construct(OpenAIService $openAIService)
    {
        $this->openAIService = $openAIService;
    }

    /**
     * Handle user's question and maintain the conversation.
     */
    public function askQuestion(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'question' => 'required|string',
            'conversation' => 'nullable|array',
        ]);

        $question = $request->input('question');
        $conversation = $request->input('conversation', []);

        // Set up the conversation context
        foreach ($conversation as $message) {
            $this->openAIService->systemMessage($message['content']);
        }

        // Send the question to the OpenAI service
        $response = $this->openAIService->send($question);

        return response()->json([
            'response' => $response,
        ]);
    }
}
