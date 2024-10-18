<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Models\Admin\Admin;
use App\Models\Prop\Contact;
use App\Models\Prop\HomeType;
use App\Models\Prop\Image;
use App\Models\Prop\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

use function Laravel\Prompts\alert;

class AdminController extends Controller
{
    public function index()
    {
        $admin = Admin::select()->count();
        $property = Property::select()->count();
        $homeType = HomeType::select()->count();

        return view('admins.index', compact('admin', 'property', 'homeType'));
    }

    public function login()
    {
        return view('admins.login');
    }

    public function check(Request $request)
    {
        $remember_me = $request->has('remember_me') ? true : false;

        if (auth()->guard('admin')->attempt(['email' => $request->input("email"), 'password' => $request->input("password")], $remember_me)) {

            return redirect()->route('admins.dashboard');
        }
        return redirect()->back()->with(['error' => 'error logging in']);
    }

    public function logoutAdmin(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function allAdmin()
    {
        $allAdmin = Admin::select()->get();

        return view('admins.admin.admins', compact('allAdmin'));
    }

    public function createAdmins()
    {
        return view('admins.admin.create');
    }

    public function storeAdmins(Request $request)
    {
        Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        session()->flash('success', 'New Admin Has Been Created');
        return redirect()->route('admins.all');
    }

    public function editAdmins($id)
    {
        $admin = Admin::find($id);

        return view('admins.admin.edit', compact('admin'));
    }

    public function updateAdmins(Request $request, $id)
    {
        $admin = Admin::find($id);
        $admin->name = $request->name;
        $admin->email = $request->email;
        if ($request->has('password') && $request->password != "") {
            $admin->password =  Hash::make($request->password);
        }
        $admin->update();
        session()->flash('update', 'Admin Has Been Updated');
        return redirect()->route('admins.all');
    }

    public function deleteAdmins($id)
    {
        $admin = Admin::find($id);
        $admin->delete();

        session()->flash('delete', 'Admin Has Been Deleted');
        return redirect()->route('admins.all');
    }

    public function HomeTypes()
    {
        $HomeTypes = HomeType::select()->get();

        return view('admins.hometypes.hometypes', compact('HomeTypes'));
    }

    public function createHomeTypes()
    {
        return view('admins.hometypes.create-hometypes');
    }

    public function storeHomeTypes(Request $request)
    {
        $request->validate([
            'hometypes' => 'required|min:5',
        ]);

        HomeType::create([
            'hometypes' => $request->hometypes,
        ]);

        session()->flash('success', 'New Home Types Has Been Added');
        return redirect()->route('admins.hometypes');
    }

    public function editHomeTypes($id)
    {
        $HomeTypes = HomeType::find($id);

        return view('admins.hometypes.edit-hometypes', compact('HomeTypes'));
    }

    public function updateHomeTypes(Request $request, $id)
    {
        $request->validate([
            'hometypes' => 'required',
        ]);

        $HomeTypes = HomeType::find($id);
        $HomeTypes->update($request->all());

        session()->flash('edit', 'Home Types Has Been Updated');
        return redirect()->route('admins.hometypes');
    }

    public function deleteHomeTypes($id)
    {

        $HomeTypes = HomeType::find($id);
        $HomeTypes->delete();

        session()->flash('delete', 'Home Types Has Been Deleted');
        return redirect()->route('admins.hometypes');
    }

    public function allRequest()
    {
        $allRequests = Contact::select()->get();

        return view('admins.requests', compact('allRequests'));
    }

    public function allProperties()
    {
        $allProperties = Property::all();

        return view('admins.properties.properties', compact('allProperties'));
    }

    public function createProperties()
    {
        $hometypes = HomeType::all();
        return view('admins.properties.createprops', compact('hometypes'));
    }

    public function storeProperties(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'price' => 'required',
            'image' => 'required',
            'beds' => 'required',
            'bath' => 'required',
            'area_sqft' => 'required',
            'home_type' => 'required',
            'year_built' => 'required',
            'price_sqft' => 'required',
            'more_info' => 'required',
            'location' => 'required',
            'city' => 'required',
            'agent_name' => 'required',
            'type' => 'required',
        ]);

        $destinationPath = 'assets/images/';
        $myimage = $request->image->getClientOriginalName();
        $request->image->move(public_path($destinationPath), $myimage);

        Property::create([
            'title' => $request->title,
            'price' => $request->price,
            'image' => $myimage,
            'beds' => $request->beds,
            'bath' => $request->bath,
            'area_sqft' => $request->area_sqft,
            'home_type' => $request->home_type,
            'year_built' => $request->year_built,
            'price_sqft' => $request->price_sqft,
            'more_info' => $request->more_info,
            'location' => $request->location,
            'city' => $request->city,
            'agent_name' => $request->agent_name,
            'type' => $request->type,
        ]);

        session()->flash('success', 'New Property Has Been Added');
        return redirect()->route('properties.all');
    }

    public function editProperties($id)
    {
        $hometypes = HomeType::all();
        $property = Property::find($id);

        return view('admins.properties.updateprops', compact('property', 'hometypes'));
    }

    public function updateProperties(Request $request, $id)
    {
        $property = Property::find($id);

        $property->title = $request->title;
        $property->price = $request->price;
        if ($request->has('image')) {
            $destinationPath = 'assets/images/';
            $myimage = $request->image->getClientOriginalName();
            $request->image->move(public_path($destinationPath), $myimage);

            $property->image = "assets/images/$myimage";
        }

        $property->beds = $request->beds;
        $property->bath = $request->bath;
        $property->area_sqft = $request->area_sqft;
        $property->home_type = $request->home_type;
        $property->year_built = $request->year_built;
        $property->price_sqft = $request->price_sqft;
        $property->more_info = $request->more_info;
        $property->location = $request->location;
        $property->city = $request->city;
        $property->agent_name = $request->agent_name;
        $property->type = $request->type;
        $property->update();

        session()->flash('update', 'Property Has Been Updated');
        return redirect()->route('properties.all');
    }

    public function deleteProperties($id)
    {

        $property = Property::find($id);
        if ($property) {
            // Delete Property Image
            if (File::exists(public_path('assets/images/' . $property->image))) {
                File::delete(public_path('assets/images/' . $property->image));
            }

            // Delete Gallery Images
            $gallery = Image::where('property_id', $property->id)->get();
            foreach ($gallery as $item) {
                if (File::exists(public_path('assets/gallery/' . $item->image))) {
                    File::delete(public_path('assets/gallery/' . $item->image));
                }
                // Optionally, you can delete the gallery image record from the database
                $item->delete();
            }

            // Delete the property record from the database
            $property->delete();
        }

        session()->flash('delete', 'Property Has Been Deleted');
        return redirect()->route('properties.all');
    }

    public function createGallery()
    {
        $property = Property::all();

        return view('admins.properties.creategallery', compact('property'));
    }

    public function storeGallery(Request $request)
    {

        $files = [];
        if ($request->hasfile('image')) {
            foreach ($request->file('image') as $file) {
                $path = 'assets/gallery/';
                $name = time() . rand(1, 50) . '.' . $file->extension();
                $file->move(public_path($path), $name);
                $files[] = $name;

                Image::create([
                    'image' => $name,
                    'property_id' => $request->property_id,
                ]);
            }
        }

        session()->flash('gallery', 'New Gallery Has Been Added');
        return redirect()->route('properties.all');
    }
}
