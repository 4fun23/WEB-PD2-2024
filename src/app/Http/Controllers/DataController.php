<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Character;

use Illuminate\Http\JsonResponse;

class DataController extends Controller
{
    public function getTopCharacters(): JsonResponse{

        $characters = Character::where([])
            ->inRandomOrder()
            ->take(3)
            ->get()
        
        ;
        return response()->json($characters);
    }

    // Return selected Character
    public function getCharacter(Character $character): JsonResponse
    {
    $selectedCharacter = Character::where([
            'id' => $character->id,
        ])
        ->firstOrFail();
    
    return response()->json($selectedCharacter);
    }
    
    // Return 3 characters in random order- except the selected character
    public function getRelatedCharacters(Character $character): JsonResponse
    {
    $characters = Character::
        where('id', '<>', $character->id)
        ->inRandomOrder()
        ->take(3)
        ->get();
    
    return response()->json($characters);
    }

}

