<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Http;
use OpenAI\Laravel\Facades\OpenAI;

class OpenAIService
{
    protected array $messages = [];

    public function systemMessage(string $message): static
    {
        $this->messages[] = [
            'role' => 'system',
            'content' => $message
        ];

        return $this;
    }

    public function send(string $message): string
    {
        $this->messages[] = [
            'role' => 'user',
            'content' => $message
        ];

        $response = OpenAI::chat()->create(
            [
                [
                    "model" => "gpt-3.5-turbo",
                    "messages" => $this->messages,
                ]
            ]
        )->choices[0]->message->content;

        if ($response) {
            $this->messages[] = [
                'role' => 'assistant',
                'content' => $response
            ];
        }

        return $response;
    }

    public function replay(string $message): string
    {
        return $this->send($message);
    }
    public function messages()
    {
        return $this->messages;
    }
}
