<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;

class BookingController extends Controller
{
    public function pending()
    {
        // get data
        $bookings = Booking::where('status', 'pending')->orderBy('created_at', 'desc')->get();

        return view('backend.booking.index', compact('bookings'));
    }

    public function success()
    {
        // get data
        $bookings = Booking::where('status', 'success')->orderBy('created_at', 'desc')->get();

        return view('backend.booking.index', compact('bookings'));
    }

    public function failed()
    {
        // get data
        $bookings = Booking::where('status', 'failed')->orderBy('created_at', 'desc')->get();

        return view('backend.booking.index', compact('bookings'));
    }
}
