<?php

namespace App\Http\Controllers;

use App\Http\Requests\Response\SendResponseRequest;
use App\Http\Services\ResponseService;
use App\Models\Game;
use App\Models\Response;
use Illuminate\Http\Request;

class ResponseController extends Controller
{
    public function send(ResponseService $responseService, SendResponseRequest $request)
    {
        $response = $responseService->sendResponse($request);
        $game = Game::findOrFail($response->game_id);
        return redirect()->route('game.show', $game)->with('success', 'Response submitted!');
    }

    public function index($gameId)
    {
        $responses = Response::where('game_id', $gameId)->latest()->get();
        return response()->json($responses);
    }
}
