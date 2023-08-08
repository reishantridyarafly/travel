<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        return view('frontend.account.profile', compact('user'));
    }

    public function store(Request $request)
    {
        // get data
        $user = Auth::user();

        // check if email unique the user email
        if ($user->email == $request->email) {
            $rules = 'required|email';
        } else {
            $rules = 'required|email|unique:users';
        }

        // checking image
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/users');

            if ($user->image != 'default/user.png') {
                Storage::delete('public/users/' . $user->image);
            }

            $imageName = basename($imagePath);
        } else {
            $imageName = $user->image;
        }

        // validation
        $request->validate([
            'image' => 'mimes:jpg,png,jpeg|image|max:2048',
            'name' => 'required',
            'username' => 'required',
            'no_hp' => 'required',
            'email' => $rules,
        ]);

        // update to table
        $user->update([
            'image' => $imageName,
            'name' => $request->name,
            'username' => $request->username,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
        ], [
            'image.mimes' => 'File gambar harus memiliki format jpg, png, atau jpeg.',
            'image.image' => 'File yang diunggah harus berupa gambar.',
            'image.max' => 'Ukuran file gambar maksimum adalah 2MB.',
            'name.required' => 'Nama Depan harus diisi.',
            'username.required' => 'Username harus diisi.',
            'no_hp.required' => 'No. HP harus diisi.',
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Email harus berupa alamat email yang valid.',
            'email.unique' => 'Email sudah digunakan oleh pengguna lain.',
        ]);

        return redirect()->back()->with('success', 'Data berhasil diubah!');
    }
}
