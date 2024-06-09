<?php

namespace App\Http\Controllers;

use App\Models\Enduser;
use App\Models\Character;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;

class CharacterController extends Controller implements HasMiddleware
{

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
    public function put(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'username' => 'required|min:2|max:12',
            'enduser_id' => 'required',
            'bio' => 'nullable',
            'totalLevel' => 'nullable|numeric',
            'questPoints' => 'numeric',
            'image' => 'nullable|image',
            'collectionLogSlots' => 'nullable',
        ]);

        $character = new Character();
        $character->username = $validatedData['username'];
        $character->enduser_id = $validatedData['enduser_id'];
        $character->bio = $validatedData['bio'];
        $character->totalLevel = $validatedData['totalLevel'];
        $character->questPoints = $validatedData['questPoints'];
        $character->collectionLogSlots = $validatedData['collectionLogSlots'];

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
    public function patch(Character $character, Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'username' => 'required|min:2|max:12',
            'enduser_id' => 'required',
            'bio' => 'nullable',
            'totalLevel' => 'nullable|numeric',
            'questPoints' => 'numeric',
            'image' => 'nullable|image',
            'collectionLogSlots' => 'nullable',
        ]);

        $character->username = $validatedData['username'];
        $character->enduser_id = $validatedData['enduser_id'];
        $character->bio = $validatedData['bio'];
        $character->totalLevel = $validatedData['totalLevel'];
        $character->questPoints = $validatedData['questPoints'];
        $character->collectionLogSlots = $validatedData['collectionLogSlots'];
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
