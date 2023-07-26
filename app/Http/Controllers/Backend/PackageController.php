<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Package;
use App\Models\Benefit;
use App\Models\Image;

class PackageController extends Controller
{
    public function index()
    {
        // Check user role
        if (!auth()->user()->hasRole('admin')) {
            return redirect()->back();
        }

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
            'image' => 'required|max:2048',
            'image.*' => 'image|mimes:jpeg,png,jpg|max:2048',
            'name' => 'required|max:255',
            'location' => 'required|max:255',
            'price' => 'required|max:15',
            'benefits' => 'required',
            'duration' => 'required|max:12',
            'description' => 'required',
        ]);

        // remove currency symbol and thousand separators from price field
        $price = str_replace(['Rp ', '.', ','], ['', '', ''], $request->price);

        // insert to table packages
        $packages = Package::create([
            'name' => $request->name,
            'slug'  => Str::slug($request->name, '-'),
            'location' => $request->location,
            'price' => $price,
            'duration' => $request->duration,
            'description' => $request->description,
        ]);

        // split benefits into array
        $benefits = explode(',', $request->benefits);

        // insert new benefits
        foreach ($benefits as $benefit) {
            Benefit::create([
                'name' => $benefit,
                'package_id' => $packages->id,
            ]);
        }

        // process upload image multiple
        if ($request->hasFile('image')) {
            $images = $request->file('image');
            foreach ($images as $image) {
                $path = basename($image->store('public/packages'));

                Image::create([
                    'path' => $path,
                    'package_id' => $packages->id,
                ]);
            }
        }

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
            'image' => 'max:2048',
            'image.*' => 'image|mimes:jpeg,png,jpg|max:2048',
            'name' => 'required|max:255',
            'location' => 'required|max:255',
            'price' => 'required|max:15',
            'benefits' => 'required',
            'duration' => 'required',
            'description' => 'required',
        ]);

        // get data find or fail by id
        $package = Package::findOrFail($id);

        // remove currency symbol and thousand separators from price field
        $price = str_replace(['Rp ', '.', ','], ['', '', ''], $request->price);

        // update to table packages
        $package->update([
            'name' => $request->name,
            'slug'  => Str::slug($request->name, '-'),
            'location' => $request->location,
            'price' => $price,
            'duration' => $request->duration,
            'description' => $request->description,
        ]);

        // split benefits into array
        $benefits = explode(',', $request->benefits);

        // delete existing benefits
        $package->benefits()->delete();

        // insert new benefits
        foreach ($benefits as $benefit) {
            Benefit::create([
                'name' => $benefit,
                'package_id' => $package->id,
            ]);
        }

        // process upload image multiple
        if ($request->hasFile('image')) {
            foreach ($package->images as $image) {
                Storage::delete('public/packages/' . $image->path);
                $image->delete();
            }

            $images = $request->file('image');
            foreach ($images as $image) {
                $path = basename($image->store('public/packages'));

                Image::create([
                    'path' => $path,
                    'package_id' => $package->id,
                ]);
            }
        }

        return redirect('packages')->with('message', 'Paket berhasil diubah!');
    }

    public function destroy($id)
    {
        // get data find or fail by id
        $package = Package::findOrFail($id);

        // process delete image
        foreach ($package->images as $image) {
            Storage::delete('public/packages/' . $image->path);
            $image->delete();
        }
        // delete data
        $package->delete();

        return response()->json(['message' => 'Paket berhasil dihapus!']);
    }
}
