<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Booking;

class BookingController extends Controller
{
    public function pending()
    {
        // get data
        $transactions = Transaction::where('status', 'pending')->orderBy('created_at', 'desc')->get();

        return view('backend.booking.index', compact('transactions'));
    }

    public function success()
    {
        // get data
        $transactions = Transaction::where('status', 'success')->orderBy('created_at', 'desc')->get();

        return view('backend.booking.index', compact('transactions'));
    }

    public function failed()
    {
        // get data
        $transactions = Transaction::where('status', 'failed')
                                ->orWhere('status', 'expired')
                                ->orWhere('status', 'cancel')
                                ->orderBy('created_at', 'desc')
                                ->get();

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

        if ($transaction) {
            // Update status order by booking id
            $order = Booking::where('id', $booking_id)->first();
            $order->status = 'success';
            $order->save();
        }

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

        if ($transaction) {
            // Update status order by booking id
            $order = Booking::where('id', $booking_id)->first();
            $order->status = 'failed';
            $order->save();
        }

        return redirect()->back()->with('message', 'Transaksi berhasil ditolak!');
    }
}
