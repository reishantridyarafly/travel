<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Subindikator;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    public function index()
    {
        // get the currently logged in user
        $user = Auth::user();

        // get data transaction
        $bookings = Booking::where('user_id', $user->id)->get();

        return view('frontend.histories.index', compact('bookings'));
    }

    public function print($id)
    {
        $booking = Booking::find($id);
        return view('frontend.histories.print', compact('booking'));
    }
}
