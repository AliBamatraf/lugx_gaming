<?php

namespace App\Http\Services;

use App\Events\ResponseAdded;
use App\Models\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResponseService
{
    public function sendResponse(Request $request) :Response
    {
        $user = Auth::user();
        $response = Response::query()->create([
            'user_id' => $user->id,
            'game_id' => $request->game_id,
            'text' => $request->text
        ]);

        // Trigger event for real-time update
        broadcast(new ResponseAdded($response))->toOthers();

        return $response;
    }
}
