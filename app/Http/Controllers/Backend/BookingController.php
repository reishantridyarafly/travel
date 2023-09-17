<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Mail\SendMailTanggapan;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Booking;
use Illuminate\Support\Facades\Mail;

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
        $transaction->status = 'process';
        $transaction->save();

        return redirect()->back()->with('message', 'Transaksi berhasil diproses!');
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

    public function finish(Request $request)
    {
        // request booking id
        $booking_id = $request->booking_id;

        // update status
        $transaction = Transaction::where('booking_id', $booking_id)->first();
        $transaction->status = 'success';
        $transaction->save();
        
        $email = $transaction->booking->user->email;
        Mail::to($email)
        ->send(new SendMailTanggapan());

        return redirect()->back()->with('message', 'Transaksi berhasil divalidasi!');      
    }
}
