<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Package;

class HomeController extends Controller
{
    public function index()
    {
        $packages = Package::all();

        return view('frontend.home.index', compact('packages'));
    }

    public function search(Request $request)
    {
        $key = $request->input('key');
        $city = $request->input('city');

        $query = Package::query();

        $city == '' ? $query->where('name', 'like', '%'.$key.'%') :
                ($key == '' ? $query->where('name', 'like', '%'.$city.'%') :
                $query->where('name', 'like', '%'.$key.'%')->orWhere('location', 'like', '%'.$city.'%'));

        $packages = $query->get();

        return view('frontend.home.index', compact('packages'));
    }
}
