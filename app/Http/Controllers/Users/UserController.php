<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Prop\Contact;
use App\Models\Prop\Favorite;
use App\Models\Prop\Property;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function allRequests()
    {
        if (auth()->user()) {
            $allRequests = Contact::where('user_id', auth()->user()->id)->get();

            return view('users.requests', compact('allRequests'));
        }

        return abort(404);
    }

    public function deleteRequests($id)
    {
        $requests = Contact::find($id);
        $requests->delete();

        return redirect()->route('users.requests');
    }

    public function allFavorites()
    {
        if (auth()->user()) {
            $allFavorites = Favorite::where('user_id', auth()->user()->id)->get();

            return view('users.favorites', compact('allFavorites'));
        }

        return abort(404);
    }

    public function deleteFavorite($id)
    {
        $favorite = Favorite::find($id);
        $favorite->delete();

        return redirect()->route('users.favorites');
    }
}
