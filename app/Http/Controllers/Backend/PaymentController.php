<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment;

class PaymentController extends Controller
{
    public function index()
    {
        // Check user role
        if (!auth()->user()->hasRole('admin')) {
            return redirect()->back();
        }

        // get data
        $payments = Payment::all();

        return view('backend.payment.index', compact('payments'));
    }

    public function create()
    {
        return view('backend.payment.add');
    }

    public function store(Request $request)
    {
        // validation
        $request->validate([
            'name_bank/provider' => 'required|max:255',
            'no_rekening/provider' => 'required|max:255',
            'name_owner' => 'required|max:255',
        ]);

        // insert to tabel payments
        Payment::create([
            'name_bank' => $request->input('name_bank/provider'),
            'account_number' => $request->input('no_rekening/provider'),
            'name_owner' => $request->input('name_owner'),
        ]);

        return redirect('payments')->with('message', 'Payment berhasil ditambahkan!');
    }

    public function edit($id)
    {
        // find data by id
        $payment = Payment::find($id);

        return view('backend.payment.edit', compact('payment'));
    }

    public function update(Request $request,$id)
    {
        // find data by id
        $payment = Payment::find($id);

        // validation
        $request->validate([
            'name_bank/provider' => 'required|max:255',
            'no_rekening/provider' => 'required|max:255',
            'name_owner' => 'required|max:255',
        ]);

        // update to table
        $payment->update([
            'name_bank' => $request->input('name_bank/provider'),
            'account_number' => $request->input('no_rekening/provider'),
            'name_owner' => $request->input('name_owner'),
        ]);

        return redirect('payments')->with('message', 'Payment berhasil diubah!');
    }

    public function destroy($id)
    {
        // find data by id
        $payment = Payment::findOrFail($id);

        // delete data
        $payment->delete();

        return response()->json(['message' => 'Payment berhasil dihapus!']);
    }
}
