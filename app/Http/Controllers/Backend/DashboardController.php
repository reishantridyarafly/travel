<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Package;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $pending = Transaction::where('status', 'pending')->count();
        $success = Transaction::where('status', 'success')->count();
        $failed = Transaction::where('status', 'failed')
                            ->orWhere('status', 'expired')
                            ->orWhere('status', 'cancel')
                            ->count();
        $package = Package::count();
        $customer = User::whereDoesntHave('roles', function ($query) {
                            $query->where('name', '=', 'admin')->orWhere('name', '=', 'owner');
                        })->count();

        return view('backend.dashboard.index', compact('pending', 'success', 'failed', 'package', 'customer'));
    }
}
