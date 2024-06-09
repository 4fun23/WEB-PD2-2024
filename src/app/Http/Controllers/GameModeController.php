<?php

namespace App\Http\Controllers;

use App\Models\Enduser;
use App\Models\Character;
use App\Models\GameMode;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;


class GameModeController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            'auth',
        ];
    }

    public function list(): View
    {
        $items = GameMode::orderBy('name', 'asc')->get();
        return view(
            'gameMode.list',
            [
                'title' => 'Spēļu režīmi',
                'items' => $items
            ]
        );
    }

    // display new Book form
    public function create(): View
    {
        return view(
            'gameMode.form',
            [
                'title' => 'Pievienot spēles režīmu',
                'gameMode' => new GameMode,
            ]
        );
    }

    // create new gameMode entry
    public function put(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|min:3|max:50',

        ]);
        $gameMode = new GameMode();
        $gameMode->name = $validatedData['name'];
        $gameMode->save();
        return redirect('/gameModes');
    }

    public function update(GameMode $gameMode): View{
        return view(
    'gameMode.form',
    [
        'title' => 'Rediģēt režīmu',
        'gameMode' => $gameMode,
    ]
    );
    }

    public function patch(GameMode $gameMode, Request $request): RedirectResponse{
        $validatedData = $request->validate([
            'name'=> 'required|string|max:50',
        ]);

        $gameMode->name = $validatedData['name'];
        $gameMode->save();

        return redirect('/gameModes');
    }

    public function delete(GameMode $gameMode): RedirectResponse{
        $gameMode->delete();
        return redirect('/gameModes');
    }
}
