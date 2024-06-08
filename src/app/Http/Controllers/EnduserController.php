<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\View\View;

use App\Models\Enduser;

use Illuminate\Http\RedirectResponse;

class EnduserController extends Controller
{
    public function list(): View {
        $items = Enduser::orderBy('name', 'asc')->get();
        return view(
        'enduser.list',
    [
        'title' => 'Lietotāji',
        'items' => $items,
    ]);
    }

    //display new Enduser form
    public function create(): View {
        return view(
            'enduser.form',
            [
                'title' => 'Pievienot lietotāju'
            ]
            );
    }

    //Creates new Enduser data
    public function put(Request $request): RedirectResponse {
        $validatedData = $request->validate([
            'name' => 'required|String|max:255',
        ]);

        $enduser = new Enduser();
        $enduser->name = $validatedData['name'];
        $enduser->save();

        return redirect('/endusers');
    }
}
