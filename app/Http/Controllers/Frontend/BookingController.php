<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\Booking;
use App\Models\ContactDetail;
use App\Models\Payment;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BookingController extends Controller
{
    public function index()
    {
        $packages = Package::all();

        return view('frontend.booking.index', compact('packages'));
    }

    public function store(Request $request)
    {
        // get the currently logged in user
        $user = Auth::user();

        // if the user is not logged in, redirect to the login page
        if (!$user) {
            return redirect('login');
        }

        // validation
        $request->validate([
            'package' => 'required',
            'start_date' => 'required',
        ],[
            'package.required' => 'Paket harus dipilih.',
            'start_date.required' => 'Tanggal mulai harus diisi.',
        ]);

        // generate id booking
        $latestBooking = Booking::orderBy('id', 'desc')->first();
        $idBooking = '';

        if ($latestBooking) {
            $lastId = intval(substr($latestBooking->id, 2));
            $newId = $lastId + 1;
            $idBooking = 'BK' . str_pad($newId, 4, '0', STR_PAD_LEFT);
        } else {
            $idBooking = 'BK0001';
        }

        // get package by request
        $package = Package::find($request->package);

        // get duration
        $duration = $package->duration;

        // Calculates end date based on start date and duration
        $start_date = Carbon::parse($request->start_date);
        $end_date = $start_date->copy()->addDays($duration);

        // insert to tabel bookings
        Booking::create([
            'id' => $idBooking,
            'package_id' => $request->package,
            'user_id' => $user->id,
            'start_date' => $request->start_date,
            'end_date' => $end_date,
        ]);

        return redirect()->route('contact_details', ['id' => $idBooking]);
    }

    public function contactDetails($id)
    {
        // if the user is not logged in, redirect to the login page
        if (!Auth::user()) {
            return redirect('login');
        }

        // get data by id
        $booking = Booking::find($id);

        return view('frontend.booking.contact_detail', compact('booking'));
    }

    public function contactDetailsSave(Request $request)
    {
        // validation
        $request->validate([
            'no_identity' => 'required',
            'fullname' => 'required',
            'type_identity' => 'required',
            'upload_identity' => 'required|mimes:jpg,png,jpeg|image|max:2048',
            'birth_date' => 'required',
            'gender' => 'required',
            'telephone' => 'required',
            'email' => 'required',
        ],[
            'no_identity.required' => 'No. Identitas harus diisi.',
            'fullname.required' => 'Nama Lengkap harus diisi.',
            'type_identity.required' => 'Tipe Identitas harus diisi.',
            'upload_identity.required' => 'Upload Identitas harus diisi.',
            'upload_identity.mimes' => 'Tipe file yang diperbolehkan adalah jpg, png, dan jpeg.',
            'upload_identity.image' => 'File yang diunggah harus berupa gambar.',
            'upload_identity.max' => 'Ukuran file tidak boleh lebih dari 2MB.',
            'birth_date.required' => 'Tanggal Lahir harus diisi.',
            'gender.required' => 'Jenis Kelamin harus diisi.',
            'telephone.required' => 'No. Telepon harus diisi.',
            'email.required' => 'Email harus diisi.',
        ]);

        // process upload identity
        if ($request->hasFile('upload_identity')) {
            $imagePath = $request->file('upload_identity')->store('public/identities');
            $imageName = basename($imagePath);
        } else {
            $imageName = '';
        }

        // get the currently logged in user
        $user = Auth::user();

        // booking id
        $idBooking = $request->booking_id;

        // insert to tabel bookings
        ContactDetail::create([
            'booking_id' => $idBooking,
            'user_id' => $user->id,
            'no_identity' => $request->no_identity,
            'fullname' => $request->fullname,
            'type_identity' => $request->type_identity,
            'upload_identity' => $imageName,
            'birth_date' => $request->birth_date,
            'gender' => $request->gender,
            'telephone' => $request->telephone,
            'email' => $request->email,
        ]);

        return redirect()->route('payment', ['id' => $idBooking]);
    }

    public function payment($id)
    {
        // get the currently logged in user
        $user = Auth::user();

        // if the user is not logged in, redirect to the login page
        if (!$user) {
            return redirect('login');
        }

        // get data by id
        $booking = Booking::find($id);

        // get data payment
        $payments = Payment::all();

        // get data contact detail
        $contactDetail = ContactDetail::where('booking_id', $id)->first();

        return view('frontend.booking.payment', compact('booking', 'payments', 'contactDetail'));
    }

    public function paymentSave(Request $request)
    {
        $booking = $request->input('booking');
        $bank = $request->input('name_bank');
        $total = $request->input('total');

        // generate id transaction
        $latestTransaction = Transaction::orderBy('id', 'desc')->first();

        if ($latestTransaction) {
            $lastId = intval(substr($latestTransaction->id, 3));
            $newId = $lastId + 1;
            $idTransaction = 'INV' . str_pad($newId, 4, '0', STR_PAD_LEFT);
        } else {
            $idTransaction = 'INV0001';
        }

        $expired = Carbon::now()->addDay();

        Transaction::create([
            'id' => $idTransaction,
            'booking_id' => $booking,
            'name_bank' => $bank,
            'total' => $total,
            'expired_at' => $expired,
        ]);

        return redirect()->route('payment_detail', ['id' => $booking]);
    }

    public function paymentCancel(Request $request)
    {
        $booking = $request->input('booking');
        $total = $request->input('total');

        // generate id transaction
        $latestTransaction = Transaction::orderBy('id', 'desc')->first();

        if ($latestTransaction) {
            $lastId = intval(substr($latestTransaction->id, 3));
            $newId = $lastId + 1;
            $idTransaction = 'INV' . str_pad($newId, 4, '0', STR_PAD_LEFT);
        } else {
            $idTransaction = 'INV0001';
        }

        $expired = Carbon::now()->addDay();

        Transaction::create([
            'id' => $idTransaction,
            'booking_id' => $booking,
            'total' => $total,
            'status' => 'cancel',
        ]);

        return redirect('histories')->with('message', 'Pesanan anda berhasil dibatalkan!');
    }

    public function paymentDetail($id)
    {
        // get the currently logged in user
        $user = Auth::user();

        // if the user is not logged in, redirect to the login page
        if (!$user) {
            return redirect('login');
        }

        $transaction = Transaction::where('booking_id', $id)->first();

        $booking = Booking::find($id);

        $contactDetail = ContactDetail::where('booking_id', $id)->first();

        $payment = Payment::where('name_bank', $transaction->name_bank)->first();


        return view('frontend.booking.payment_detail', compact('transaction', 'booking', 'payment',
                                                        'contactDetail'));
    }

    public function paymentDetailSave(Request $request,$id)
    {
        $transaction = Transaction::find($id);

        $request->validate([
            'photo_evidence' => 'required|mimes:jpg,png,jpeg|image|max:2048',
        ], [
            'photo_evidence.required' => 'Upload Bukti Pembayaran harus diisi.',
            'photo_evidence.mimes' => 'Tipe file yang diperbolehkan adalah jpg, png, dan jpeg.',
            'photo_evidence.image' => 'File yang diunggah harus berupa gambar.',
            'photo_evidence.max' => 'Ukuran file tidak boleh lebih dari 2MB.',
        ]);

        if ($request->hasFile('photo_evidence')) {
            $imagePath = $request->file('photo_evidence')->store('public/evidences');
            $imageName = basename($imagePath);
        } else {
            $imageName = '';
        }

        $transaction->update([
            'photo_evidence' => $imageName,
        ]);

        return redirect('histories')->with('success', 'Konfirmasi anda berhasil!');
    }

    public function paymentDetailCancel($id)
    {
        $transaction = Transaction::find($id);

        $transaction->update([
            'status' => 'cancel',
        ]);

        return redirect('histories')->with('success', 'Pesanan anda berhasil dibatalkan!');
    }

    public function cancel($id)
    {
        $transaction = Transaction::where('booking_id', $id)->first();

        $transaction->update([
            'status' => 'cancel',
        ]);

        return redirect('histories')->with('success', 'Pesanan anda berhasil dibatalkan!');
    }
}
