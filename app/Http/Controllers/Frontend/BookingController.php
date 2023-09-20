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
        ], [
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
        // Validasi
        $request->validate([
            'fullnames' => 'required|array',
            'fullnames.*' => 'required',
            'nik' => 'required|array',
            'nik.*' => 'required|min:16|max:16',
            'telephone' => 'required',
            'email' => 'required|email',
        ], [
            'fullnames.required' => 'Nama Lengkap harus diisi.',
            'fullnames.*.required' => 'Nama harus diisi.',
            'nik.required' => 'NIK harus diisi.',
            'nik.max' => 'Maksimal NIK 16 Karakter',
            'nik.min' => 'Minimal NIK 16 Karakter',
            'nik.*.required' => 'NIK harus diisi.',
            'telephone.required' => 'No. Telepon harus diisi.',
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Format email tidak valid.',
        ]);

        // get the currently logged in user
        $user = Auth::user();

        $booking_id = $request->booking_id;

        // Memeriksa apakah ada NIK yang telah digunakan dalam booking sebelumnya dengan status "pending" atau "proses"
        $conflictingNiks = [];
        foreach ($request->nik as $nik) {
            $existingContact = ContactDetail::where('nik', $nik)
                ->where('status', 'pending')
                ->orWhere('status', 'process')
                ->first();

            if ($existingContact) {
                // Jika ada NIK yang telah digunakan dalam booking sebelumnya dengan status "pending" atau "proses",
                // tambahkan NIK ini ke daftar konflik
                $conflictingNiks[] = $nik;
            }
        }

        if (!empty($conflictingNiks)) {
            // Ada NIK yang telah digunakan dalam booking sebelumnya dengan status "pending" atau "proses".
            // Lakukan sesuatu di sini, misalnya, tampilkan pesan kesalahan.
            Booking::where('id', $booking_id)->delete();
            return redirect()->route('booking_langkuy')->with('error', 'Beberapa NIK telah digunakan dalam booking sebelumnya dengan status tertunda atau proses.');
        } else {
            // Jika tidak ada konflik dengan NIK yang digunakan sebelumnya, Anda dapat melanjutkan penyimpanan data.

            // Simpan data kontak ke dalam database menggunakan perulangan
            for ($i = 0; $i < count($request->fullnames); $i++) {
                ContactDetail::create([
                    'booking_id' => $booking_id,
                    'user_id' => $user->id,
                    'name' => $request->fullnames[$i],
                    'nik' => $request->nik[$i],
                    'status' => 'pending',
                ]);
            }

            return redirect()->route('payment', ['id' => $booking_id]);
        }
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
        $contactDetail = ContactDetail::with('user')->where('booking_id', $id)->first();

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


        return view('frontend.booking.payment_detail', compact(
            'transaction',
            'booking',
            'payment',
            'contactDetail'
        ));
    }

    public function paymentDetailSave(Request $request, $id)
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
