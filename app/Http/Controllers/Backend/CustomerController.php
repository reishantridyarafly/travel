<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    public function index()
    {
        // Check user role
        if (!auth()->user()->hasRole('admin')) {
            return redirect()->back();
        }

        // get data
        $customers = User::whereDoesntHave('roles', function ($query) {
                        $query->where('name', '=', 'admin')->orWhere('name', '=', 'owner');
                    })->get();

        return view('backend.customer.index', compact('customers'));
    }

    public function create()
    {
        return view('backend.customer.add');
    }

    public function store(Request $request)
    {
        // validation
        $request->validate([
            'image' => 'mimes:jpg,png,jpeg|image|max:2048',
            'name' => 'required|max:255',
            'username' => 'required|max:255|regex:/^[^\s]+$/|unique:users',
            'no_hp' => 'required|min:11|max:13',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:8|confirmed',
        ]);

        // insert to tabel users
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ])->assignRole('owner');

        return redirect('customers')->with('message', 'Pelanggan berhasil ditambahkan!');
    }

    public function edit($id)
    {
        // find data by id
        $customer = User::findOrFail($id);

        return view('backend.customer.edit', compact('customer'));
    }

    public function update(Request $request, $id)
    {
        // find data by id
        $customer = User::findOrFail($id);

        // check if email unique the user email
        if ($customer->email == $request->email) {
            $rules_email = 'required|email';
        } else {
            $rules_email = 'required|email|max:255|unique:users';
        }

        // check if username unique the user username
        if ($customer->username == $request->username) {
            $rules_username = 'required|max:255|regex:/^[^\s]+$/';
        } else {
            $rules_username = 'required|max:255|regex:/^[^\s]+$/|unique:users';
        }

        // check if the user password
        if ($request->password) {
            $rules_password = 'required|min:8|confirmed';
        } else {
            $rules_password = '';
        }

        // validation
        $request->validate([
            'image' => 'mimes:jpg,png,jpeg|image|max:2048',
            'name' => 'required|max:255',
            'username' => $rules_username,
            'no_hp' => 'required|min:11|max:13',
            'email' => $rules_email,
            'password' => $rules_password,
        ]);

        // update to table
        $customer->update([
            'name' => $request->name,
            'username' => $request->username,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $customer->password,
        ]);

        return redirect('customers')->with('message', 'Pelanggan berhasil diubah!');
    }

    public function destroy($id)
    {
        // find data by id
        $customer = User::findOrFail($id);

        // delete data
        $customer->delete();

        return response()->json(['message' => 'Pelanggan berhasil dihapus!']);
    }
}
