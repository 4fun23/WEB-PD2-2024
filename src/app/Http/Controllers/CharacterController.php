<?php

namespace App\Http\Controllers;

use App\Models\Enduser;
use App\Models\Character;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use App\Http\Requests\CharacterRequest;

class CharacterController extends Controller implements HasMiddleware
{

    private function saveCharacterData(Character $character, CharacterRequest $request): void{
        $validatedData = $request->validated();

        $character->fill($validatedData);

        if ($request->hasFile('image')) {
            $uploadedFile = $request->file('image');
            $extension = $uploadedFile->clientExtension();
            $name = uniqid();
            $character->image = $uploadedFile->storePubliclyAs(
            '/',
            $name . '.' . $extension,
            'uploads'
            );
           }
        $character->save();
    }

    // call auth middleware
    public static function middleware(): array
    {
        return [
            'auth',
        ];
    }

    public function list(): View
    {
        $items = Character::orderBy('username', 'asc')->get();

        return view(
            'character.list',
            [
                'title' => 'Profili',
                'items' => $items
            ]
        );
    }

    // display new Character form
    public function create(): View
    {
        $endusers = Enduser::orderBy('name', 'asc')->get();
        return view(
            'character.form',
            [
                'title' => 'Pievienot profilu',
                'character' => new Character(),
                'endusers' => $endusers,
            ]
        );
    }
    // create new Book entry
    public function put(CharacterRequest $request): RedirectResponse
    {
        $character = new Character();
        $this->saveCharacterData($character, $request);
        return redirect('/characters');
    }

    // display character edit form
    public function update(Character $character): View
    {
        $endusers = Enduser::orderBy('name', 'asc')->get();
        return view(
            'character.form',
            [
                'title' => 'Rediģēt profilu',
                'character' => $character,
                'endusers' => $endusers,
            ]
        );
    }
    // update character data
    public function patch(Character $character, CharacterRequest $request): RedirectResponse
    {
        $this->saveCharacterData($character, $request);
        return redirect('/characters/update/' . $character->id);
    }
    // delete Character
    public function delete(Character $character): RedirectResponse
    {
        if ($character->image) {
            unlink(getcwd() . '/images/' . $character->image);
            }
            
        $character->delete();
        return redirect('/characters');
    }

}
