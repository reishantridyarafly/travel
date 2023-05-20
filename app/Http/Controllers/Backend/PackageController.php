<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Package;

class PackageController extends Controller
{
    public function index()
    {
        // get data
        $packages = Package::all();

        return view('backend.package.index', compact('packages'));
    }

    public function create()
    {
        return view('backend.package.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'name' => 'required|max:255',
            'location' => 'required|max:255',
            'price' => 'required|max:11',
            'benefit' => 'required',
        ]);

        // process upload image
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/packages');
            $imageName = basename($imagePath);
        } else {
            $imageName = '';
        }

        // remove currency symbol and thousand separators from price field
        $price = str_replace(['Rp ', '.', ','], ['', '', ''], $request->price);

        // insert to table packages
        Package::create([
            'image' => $imageName,
            'name' => $request->name,
            'slug'  => Str::slug($request->name, '-'),
            'location' => $request->location,
            'price' => $price,
            'benefit' => $request->benefit,
        ]);

        return redirect('packages')->with('message', 'Paket berhasil ditambahkan!');
    }

    public function edit($id)
    {
        // find data by id
        $package = Package::find($id);

        return view('backend.package.edit', compact('package'));
    }

    public function update(Request $request,$id)
    {
        // validation
        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg|max:2048',
            'name' => 'required|max:255',
            'location' => 'required|max:255',
            'price' => 'required|max:11',
            'benefit' => 'required',
        ]);

        // get data find or fail by id
        $package = Package::findOrFail($id);

        // process upload image
        if ($request->hasFile('image')) {
            Storage::delete('public/packages/' . $package->image);
            $imagePath = $request->file('image')->store('public/packages');
            $imageName = basename($imagePath);
        } else {
            $imageName = $package->image;
        }

        // remove currency symbol and thousand separators from price field
        $price = str_replace(['Rp ', '.', ','], ['', '', ''], $request->price);

        // update to table packages
        $package->update([
            'image' => $imageName,
            'name' => $request->name,
            'slug'  => Str::slug($request->name, '-'),
            'location' => $request->location,
            'price' => $price,
            'benefit' => $request->benefit,
        ]);

        return redirect('packages')->with('message', 'Paket berhasil diubah!');
    }

    public function destroy($id)
    {
        // get data find or fail by id
        $package = Package::findOrFail($id);

        // process delete image
        if ($package->image) {
            Storage::delete('public/packages/' . $package->image);
        }

        // delete data
        $package->delete();

        return response()->json(['message' => 'Paket berhasil dihapus!']);
    }
}
