<?php

namespace App\Http\Controllers\Props;

use App\Http\Controllers\Controller;
use App\Models\Prop\Contact;
use App\Models\Prop\Favorite;
use App\Models\Prop\Image;
use App\Models\Prop\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PropertiesController extends Controller
{
    public function index()
    {
        $props = Property::select()->take(9)->orderBy('id', 'desc')->get();

        return view('home', compact('props'));
    }

    public function detail($id)
    {
        // Property
        $props = Property::find($id);
        // Property Image
        $images = Image::where('property_id', $id)->get();
        // Related Property
        if ($props !== null) {
            $relatedProps = Property::where('home_type', $props->home_type)
                ->where('id', '!=', $id)
                ->take(3)
                ->orderBy('created_at', 'desc')
                ->get();
        } else {
            abort(404);
        }

        if (auth()->user()) {
            //Validated Form Contact
            $validatedForm = Contact::where('property_id', $id)
                ->where('user_id', auth()->user()->id)
                ->count();

            //Validated Form Contact
            $validatedFavorite = Favorite::where('property_id', $id)
                ->where('user_id', auth()->user()->id)
                ->count();

            return view('property.detail', compact('props', 'images', 'relatedProps', 'validatedForm', 'validatedFavorite'));
        } else {
            return view('property.detail', compact('props', 'images', 'relatedProps'));
        }
    }

    public function insertRequest(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email',
            'phone' => 'required|min:11',
        ]);

        Contact::create([
            'property_id' => $request->property_id,
            'agent_name' => $request->agent_name,
            'user_id' => Auth::user()->id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        session()->flash('success', 'Request Has Been Successful');
        return redirect()->route('property.detail', $request->property_id);
    }

    public function saveFavorite(Request $request)
    {
        Favorite::create([
            'user_id' => Auth::user()->id,
            'property_id' => $request->property_id,
            'title' => $request->title,
            'image' => $request->image,
            'location' => $request->location,
            'price' => $request->price,
        ]);

        session()->flash('favorite', 'Property Has Been Add to Favorite');
        return redirect()->route('property.detail', $request->property_id);
    }

    public function buyProperty()
    {
        $type = 'Sale';
        $buy = Property::select()->where('type', $type)->get();

        return view('property.buy', compact('buy'));
    }

    public function rentProperty()
    {
        $type = 'Rent';
        $rent = Property::select()->where('type', $type)->get();

        return view('property.rent', compact('rent'));
    }

    public function displayHometype($hometype)
    {
        $propertyHomeType = Property::select()->where('home_type', $hometype)->get();

        return view('property.hometype', compact('propertyHomeType', 'hometype'));
    }

    public function priceAsc()
    {
        $priceAsc = Property::select()->take(9)->orderBy('price', 'asc')->get();

        return view('property.priceasc', compact('priceAsc'));
    }

    public function priceDesc()
    {
        $priceDesc = Property::select()->take(9)->orderBy('price', 'desc')->get();

        return view('property.pricedesc', compact('priceDesc'));
    }

    public function searches(Request $request)
    {
        $list_types = $request->get('list_types');
        $offer_types = $request->get('offer_types');
        $select_city = $request->get('select_city');

        $searches = Property::where('home_type', 'LIKE', "%$list_types%")
            ->where('type', 'LIKE', "%$offer_types%")
            ->where('city', 'LIKE', "%$select_city%")
            ->get();

        return view('property.searches', compact('searches'));
    }
}
