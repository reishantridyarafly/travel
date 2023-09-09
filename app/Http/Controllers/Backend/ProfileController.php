<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        // get data
        $profile = Auth::user();

        return view('backend.profile.index', compact('profile'));
    }

    public function store(Request $request)
    {
        // get data
        $profile = Auth::user();

        // check if email unique the user email
        if ($profile->email == $request->email) {
            $rules_email = 'required|email';
        } else {
            $rules_email = 'required|email|max:255|unique:users';
        }

        // check if username unique the user username
        if ($profile->username == $request->username) {
            $rules_username = 'required|max:255|regex:/^[^\s]+$/';
        } else {
            $rules_username = 'required|max:255|regex:/^[^\s]+$/|unique:users';
        }

        // validation
        $request->validate([
            'image' => 'mimes:jpg,png,jpeg|image|max:2048',
            'name' => 'required|max:255',
            'username' => $rules_username,
            'no_hp' => 'required|min:11|max:13',
            'email' => $rules_email,
        ]);

        // checking image
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/users');

            if ($profile->image != 'default/user.png') {
                Storage::delete('public/users/' . $profile->image);
            }

            $imageName = basename($imagePath);
        } else {
            $imageName = $profile->image;
        }

        // update to table
        $profile->update([
            'image' => $imageName,
            'name' => $request->name,
            'username' => $request->username,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
        ]);

        return redirect()->back()->with('message', 'Data berhasil diubah!');
    }

    public function destroy($id)
    {
        // get data
        $profile = Auth::user();

        // delete image
        if ($profile->image) {
            Storage::delete('public/users/' . $profile->image);
        }

        // update data
        $profile->update([
            'image' => 'default/user.png',
        ]);

        return redirect()->back()->with(['message' => 'Data berhasil dihapus!']);
    }
}
