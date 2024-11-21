<?php

namespace App\Http\Services;

use App\Models\Game;
use App\Models\User;
use App\Notifications\NewGameNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;

class GameService
{
    public function storeGameService(Request $request)
    {
        //put the categoryIds into array 
        $categoryIds = $request->input('category_id', []);

        //check the path of image
        $path = null;
        if ($request->hasFile('image')) {
            $path = Storage::disk('public')->put('/images/games', $request->image);
        }

        //create the game
        $game = Game::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'image' => $path,
        ]);

        //Link the category Ids to the game
        $game->categories()->attach($categoryIds);

        //Send notification to all users about new added game
        $users = User::all();
        Notification::send($users, new NewGameNotification($game->name));
    }

    public function updateGameService(Request $request, Game $game)
    {
        //put the categoryIds into list 
        $categoryIds = $request->input('category_id', []);
        //check the path of image
        $path = $game->image ?? null;

        if ($request->hasFile('image')) {
            if ($game->image) {
                Storage::disk('public')->delete($game->image);
            }
            $path = Storage::disk('public')->put('/images/games', $request->image);
        }

        //create the game
        $game->update([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'image' => $path,
        ]);
        //Link the category Ids to the game
        $game->categories()->sync($categoryIds);
    }

    public function deleteGameService(Game $game)
    {
        Storage::disk('public')->delete($game->image);

        $game->delete();
    }
}
