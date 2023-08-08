<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Booking;

class BookingController extends Controller
{
    
    public function index()
    {
        // get data
        $transactions = Transaction::orderBy('created_at', 'desc')->get();
        return view('backend.booking.index', compact('transactions'));
    }

    public function validated(Request $request)
    {
        // request booking id
        $booking_id = $request->booking_id;

        // update status
        $transaction = Transaction::where('booking_id', $booking_id)->first();
        $transaction->status = 'success';
        $transaction->save();
        
        return redirect()->back()->with('message', 'Transaksi berhasil divalidasi!');
    }

    public function rejected(Request $request)
    {
        // request booking id
        $booking_id = $request->booking_id;

        // update status
        $transaction = Transaction::where('booking_id', $booking_id)->first();
        $transaction->status = 'failed';
        $transaction->save();

        return redirect()->back()->with('message', 'Transaksi berhasil ditolak!');
    }
}
